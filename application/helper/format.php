<?
/**
 * Replaces double line-breaks with paragraph elements.
 *
 * A group of regex replaces used to identify text formatted with newlines and
 * replace double line-breaks with HTML paragraph tags. The remaining
 * line-breaks after conversion become <<br />> tags, unless $br is set to '0'
 * or 'false'.
 *
 * From WordPress formatting.php
 *
 * @since 0.71
 *
 * @param string $pee The text which has to be formatted.
 * @param bool $br Optional. If set, this will convert all remaining line-breaks after paragraphing. Default true.
 * @return string Text which has been converted into correct paragraph tags.
 */
function autop($pee, $br = true) {
    $pre_tags = array();

    if ( trim($pee) === '' )
        return '';

    $pee = $pee . "\n"; // just to make things a little easier, pad the end

    if ( strpos($pee, '<pre') !== false ) {
        $pee_parts = explode( '</pre>', $pee );
        $last_pee = array_pop($pee_parts);
        $pee = '';
        $i = 0;

        foreach ( $pee_parts as $pee_part ) {
            $start = strpos($pee_part, '<pre');

            // Malformed html?
            if ( $start === false ) {
                $pee .= $pee_part;
                continue;
            }

            $name = "<pre wp-pre-tag-$i></pre>";
            $pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

            $pee .= substr( $pee_part, 0, $start ) . $name;
            $i++;
        }

        $pee .= $last_pee;
    }

    $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
    // Space things out a little
    $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|noscript|samp|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
    $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
    $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
    $pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
    if ( strpos($pee, '<object') !== false ) {
        $pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
        $pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
    }
    $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
    // make paragraphs, including one at the end
    $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
    $pee = '';
    foreach ( $pees as $tinkle )
        $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
    $pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
    $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
    $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
    if ( $br ) {
        $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
        $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
    }
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
    $pee = preg_replace( "|\n</p>$|", '</p>', $pee );

    if ( !empty($pre_tags) )
        $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

    return $pee;
}


/**
 * Replaces common plain text characters into formatted entities
 *
 * As an example,
 * <code>
 * 'cause today's effort makes it worth tomorrow's "holiday"...
 * </code>
 * Becomes:
 * <code>
 * &#8217;cause today&#8217;s effort makes it worth tomorrow&#8217;s &#8220;holiday&#8221;&#8230;
 * </code>
 * Code within certain html blocks are skipped.
 *
 * From WordPress formatting.php

 * @since 0.71
 * @uses $wp_cockneyreplace Array of formatted entities for certain common phrases
 *
 * @param string $text The text to be formatted
 * @return string The string replaced with html entities
 */
function texturize($text) {

    // No need to set up these static variables more than once
    if ( ! isset( $static_characters ) ) {
        /* translators: opening curly double quote */
        $opening_quote = '&#8220;';
        /* translators: closing curly double quote */
        $closing_quote = '&#8221;';

        /* translators: apostrophe, for example in 'cause or can't */
        $apos = '&#8217;';

        /* translators: prime, for example in 9' (nine feet) */
        $prime = '&#8242;';
        /* translators: double prime, for example in 9" (nine inches) */
        $double_prime = '&#8243;';

        /* translators: opening curly single quote */
        $opening_single_quote = '&#8216;';
        /* translators: closing curly single quote */
        $closing_single_quote = '&#8217;';

        /* translators: en dash */
        $en_dash = '&#8211;';
        /* translators: em dash */
        $em_dash = '&#8212;';

        $default_no_texturize_tags = array('pre', 'code', 'kbd', 'style', 'script', 'tt');
        $default_no_texturize_shortcodes = array('code');

        $static_characters = array( '---', ' -- ', '--', ' - ', 'xn&#8211;', '...', '``', '\'\'', ' (tm)' );
        $static_replacements = array( $em_dash, ' ' . $em_dash . ' ', $en_dash, ' ' . $en_dash . ' ', 'xn--', '&#8230;', $opening_quote, $closing_quote, ' &#8482;' );

        $dynamic = array();
        if ( "'" != $apos ) {
            $dynamic[ '/\'(\d\d(?:&#8217;|\')?s)/' ] = $apos . '$1'; // '99's
            $dynamic[ '/\'(\d)/'                   ] = $apos . '$1'; // '99
        }
        if ( "'" != $opening_single_quote )
            $dynamic[ '/(\s|\A|[([{<]|")\'/'       ] = '$1' . $opening_single_quote; // opening single quote, even after (, {, <, [
        if ( '"' != $double_prime )
            $dynamic[ '/(\d)"/'                    ] = '$1' . $double_prime; // 9" (double prime)
        if ( "'" != $prime )
            $dynamic[ '/(\d)\'/'                   ] = '$1' . $prime; // 9' (prime)
        if ( "'" != $apos )
            $dynamic[ '/(\S)\'([^\'\s])/'          ] = '$1' . $apos . '$2'; // apostrophe in a word
        if ( '"' != $opening_quote )
            $dynamic[ '/(\s|\A|[([{<])"(?!\s)/'    ] = '$1' . $opening_quote . '$2'; // opening double quote, even after (, {, <, [
        if ( '"' != $closing_quote )
            $dynamic[ '/"(\s|\S|\Z)/'              ] = $closing_quote . '$1'; // closing double quote
        if ( "'" != $closing_single_quote )
            $dynamic[ '/\'([\s.]|\Z)/'             ] = $closing_single_quote . '$1'; // closing single quote

        $dynamic[ '/\b(\d+)x(\d+)\b/'              ] = '$1&#215;$2'; // 9x9 (times)

        $dynamic_characters = array_keys( $dynamic );
        $dynamic_replacements = array_values( $dynamic );
    }

    // Transform into regexp sub-expression used in _wptexturize_pushpop_element
    // Must do this every time in case plugins use these filters in a context sensitive manner
    $no_texturize_tags = '(' . implode('|', $default_no_texturize_tags ) . ')';
    $no_texturize_shortcodes = '(' . implode('|', $default_no_texturize_shortcodes ) . ')';

    $no_texturize_tags_stack = array();
    $no_texturize_shortcodes_stack = array();

    $textarr = preg_split('/(<.*>|\[.*\])/Us', $text, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ( $textarr as &$curl ) {
        if ( empty( $curl ) )
            continue;

        // Only call _wptexturize_pushpop_element if first char is correct tag opening
        $first = $curl[0];
        if ( '<' === $first ) {
            _texturize_pushpop_element($curl, $no_texturize_tags_stack, $no_texturize_tags, '<', '>');
        } elseif ( '[' === $first ) {
            _texturize_pushpop_element($curl, $no_texturize_shortcodes_stack, $no_texturize_shortcodes, '[', ']');
        } elseif ( empty($no_texturize_shortcodes_stack) && empty($no_texturize_tags_stack) ) {
            // This is not a tag, nor is the texturization disabled static strings
            $curl = str_replace($static_characters, $static_replacements, $curl);
            // regular expressions
            $curl = preg_replace($dynamic_characters, $dynamic_replacements, $curl);
        }
        $curl = preg_replace('/&([^#])(?![a-zA-Z1-4]{1,8};)/', '&#038;$1', $curl);
    }
    return implode( '', $textarr );
}


/**
 * Search for disabled element tags. Push element to stack on tag open and pop
 * on tag close. Assumes first character of $text is tag opening.
 *
 * @access private
 * @since 2.9.0
 *
 * @param string $text Text to check. First character is assumed to be $opening
 * @param array $stack Array used as stack of opened tag elements
 * @param string $disabled_elements Tags to match against formatted as regexp sub-expression
 * @param string $opening Tag opening character, assumed to be 1 character long
 * @param string $closing Tag closing character
 */
function _texturize_pushpop_element($text, &$stack, $disabled_elements, $opening = '<', $closing = '>') {
    // Check if it is a closing tag -- otherwise assume opening tag
    if (strncmp($opening . '/', $text, 2)) {
        // Opening? Check $text+1 against disabled elements
        if (preg_match('/^' . $disabled_elements . '\b/', substr($text, 1), $matches)) {
            /*
             * This disables texturize until we find a closing tag of our type
             * (e.g. <pre>) even if there was invalid nesting before that
             *
             * Example: in the case <pre>sadsadasd</code>"baba"</pre>
             *          "baba" won't be texturize
             */

            array_push($stack, $matches[1]);
        }
    } else {
        // Closing? Check $text+2 against disabled elements
        $c = preg_quote($closing, '/');
        if (preg_match('/^' . $disabled_elements . $c . '/', substr($text, 2), $matches)) {
            $last = array_pop($stack);

            // Make sure it matches the opening tag
            if ($last != $matches[1])
                array_push($stack, $last);
        }
    }
}


/**
 * Convert plaintext URI to HTML links.
 *
 * Converts URI, www and ftp, and email addresses. Finishes by fixing links
 * within links.
 *
 * @since 0.71
 *
 * @param string $text Content to convert URIs.
 * @return string Content with converted URIs.
 */
function make_clickable( $text ) {
    $r = '';
    $textarr = preg_split( '/(<[^<>]+>)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE ); // split out HTML tags
    foreach ( $textarr as $piece ) {
        if ( empty( $piece ) || ( $piece[0] == '<' && ! preg_match('|^<\s*[\w]{1,20}+://|', $piece) ) ) {
            $r .= $piece;
            continue;
        }

        // Long strings might contain expensive edge cases ...
        if ( 10000 < strlen( $piece ) ) {
            // ... break it up
            foreach ( _split_str_by_whitespace( $piece, 2100 ) as $chunk ) { // 2100: Extra room for scheme and leading and trailing paretheses
                if ( 2101 < strlen( $chunk ) ) {
                    $r .= $chunk; // Too big, no whitespace: bail.
                } else {
                    $r .= make_clickable( $chunk );
                }
            }
        } else {
            $ret = " $piece "; // Pad with whitespace to simplify the regexes

            $url_clickable = '~
				([\\s(<.,;:!?])                                        # 1: Leading whitespace, or punctuation
				(                                                      # 2: URL
					[\\w]{1,20}+://                                # Scheme and hier-part prefix
					(?=\S{1,2000}\s)                               # Limit to URLs less than about 2000 characters long
					[\\w\\x80-\\xff#%\\~/@\\[\\]*(+=&$-]*+         # Non-punctuation URL character
					(?:                                            # Unroll the Loop: Only allow puctuation URL character if followed by a non-punctuation URL character
						[\'.,;:!?)]                            # Punctuation URL character
						[\\w\\x80-\\xff#%\\~/@\\[\\]*(+=&$-]++ # Non-punctuation URL character
					)*
				)
				(\)?)                                                  # 3: Trailing closing parenthesis (for parethesis balancing post processing)
			~xS'; // The regex is a non-anchored pattern and does not have a single fixed starting character.
            // Tell PCRE to spend more time optimizing since, when used on a page load, it will probably be used several times.

            $ret = preg_replace_callback( $url_clickable, '_make_url_clickable_cb', $ret );

            $ret = preg_replace_callback( '#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', '_make_email_clickable_cb', $ret );

            $ret = substr( $ret, 1, -1 ); // Remove our whitespace padding.
            $r .= $ret;
        }
    }

    // Cleanup of accidental links within links
    $r = preg_replace( '#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i', "$1$3</a>", $r );
    return $r;
}


/**
 * Callback to convert URI match to HTML A element.
 *
 * This function was backported from 2.5.0 to 2.3.2. Regex callback for {@link
 * make_clickable()}.
 *
 * @since 2.3.2
 * @access private
 *
 * @param array $matches Single Regex Match.
 * @return string HTML A element with URI address.
 */
function _make_url_clickable_cb($matches) {
    $url = $matches[2];

    if ( ')' == $matches[3] && strpos( $url, '(' ) ) {
        // If the trailing character is a closing parethesis, and the URL has an opening parenthesis in it, add the closing parenthesis to the URL.
        // Then we can let the parenthesis balancer do its thing below.
        $url .= $matches[3];
        $suffix = '';
    } else {
        $suffix = $matches[3];
    }

    // Include parentheses in the URL only if paired
    while ( substr_count( $url, '(' ) < substr_count( $url, ')' ) ) {
        $suffix = strrchr( $url, ')' ) . $suffix;
        $url = substr( $url, 0, strrpos( $url, ')' ) );
    }

    if ( empty($url) )
        return $matches[0];

    return $matches[1] . "<a href=\"$url\" rel=\"nofollow\">$url</a>" . $suffix;
}


/**
 * Callback to convert email address match to HTML A element.
 *
 * This function was backported from 2.5.0 to 2.3.2. Regex callback for {@link
 * make_clickable()}.
 *
 * @since 2.3.2
 * @access private
 *
 * @param array $matches Single Regex Match.
 * @return string HTML A element with email address.
 */
function _make_email_clickable_cb($matches) {
    $email = $matches[2] . '@' . $matches[3];
    return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}


/**
 * Breaks a string into chunks by splitting at whitespace characters.
 * The length of each returned chunk is as close to the specified length goal as possible,
 * with the caveat that each chunk includes its trailing delimiter.
 * Chunks longer than the goal are guaranteed to not have any inner whitespace.
 *
 * Joining the returned chunks with empty delimiters reconstructs the input string losslessly.
 *
 * Input string must have no null characters (or eventual transformations on output chunks must not care about null characters)
 *
 * <code>
 * _split_str_by_whitespace( "1234 67890 1234 67890a cd 1234   890 123456789 1234567890a    45678   1 3 5 7 90 ", 10 ) ==
 * array (
 *   0 => '1234 67890 ',  // 11 characters: Perfect split
 *   1 => '1234 ',        //  5 characters: '1234 67890a' was too long
 *   2 => '67890a cd ',   // 10 characters: '67890a cd 1234' was too long
 *   3 => '1234   890 ',  // 11 characters: Perfect split
 *   4 => '123456789 ',   // 10 characters: '123456789 1234567890a' was too long
 *   5 => '1234567890a ', // 12 characters: Too long, but no inner whitespace on which to split
 *   6 => '   45678   ',  // 11 characters: Perfect split
 *   7 => '1 3 5 7 9',    //  9 characters: End of $string
 * );
 * </code>
 *
 * @since 3.4.0
 * @access private
 *
 * @param string $string The string to split.
 * @param int $goal The desired chunk length.
 * @return array Numeric array of chunks.
 */
function _split_str_by_whitespace( $string, $goal ) {
    $chunks = array();

    $string_nullspace = strtr( $string, "\r\n\t\v\f ", "\000\000\000\000\000\000" );

    while ( $goal < strlen( $string_nullspace ) ) {
        $pos = strrpos( substr( $string_nullspace, 0, $goal + 1 ), "\000" );

        if ( false === $pos ) {
            $pos = strpos( $string_nullspace, "\000", $goal + 1 );
            if ( false === $pos ) {
                break;
            }
        }

        $chunks[] = substr( $string, 0, $pos + 1 );
        $string = substr( $string, $pos + 1 );
        $string_nullspace = substr( $string_nullspace, $pos + 1 );
    }

    if ( $string ) {
        $chunks[] = $string;
    }

    return $chunks;
}


/**
 * Will only balance the tags if forced to and the option is set to balance tags.
 *
 * The option 'use_balanceTags' is used to determine whether the tags will be balanced.
 *
 * @since 0.71
 *
 * @param string $text Text to be balanced
 * @param bool $force If true, forces balancing, ignoring the value of the option. Default false.
 * @return string Balanced text
 */
function balance_tags( $text, $force = false ) {
    if ( !$force && get::option('use_balanceTags') == 0 )
        return $text;
    return force_balance_tags( $text );
}


/**
 * Balances tags of string using a modified stack.
 *
 * @since 2.0.4
 *
 * @author Leonard Lin <leonard@acm.org>
 * @license GPL
 * @copyright November 4, 2001
 * @version 1.1
 * @todo Make better - change loop condition to $text in 1.2
 * @internal Modified by Scott Reilly (coffee2code) 02 Aug 2004
 *		1.1  Fixed handling of append/stack pop order of end text
 *			 Added Cleaning Hooks
 *		1.0  First Version
 *
 * @param string $text Text to be balanced.
 * @return string Balanced text.
 */
function force_balance_tags( $text ) {
    $tagstack = array();
    $stacksize = 0;
    $tagqueue = '';
    $newtext = '';
    // Known single-entity/self-closing tags
    $single_tags = array( 'area', 'base', 'basefont', 'br', 'col', 'command', 'embed', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param', 'source' );
    // Tags that can be immediately nested within themselves
    $nestable_tags = array( 'blockquote', 'div', 'object', 'q', 'span' );

    // WP bug fix for comments - in case you REALLY meant to type '< !--'
    $text = str_replace('< !--', '<    !--', $text);
    // WP bug fix for LOVE <3 (and other situations with '<' before a number)
    $text = preg_replace('#<([0-9]{1})#', '&lt;$1', $text);

    while ( preg_match("/<(\/?[\w:]*)\s*([^>]*)>/", $text, $regex) ) {
        $newtext .= $tagqueue;

        $i = strpos($text, $regex[0]);
        $l = strlen($regex[0]);

        // clear the shifter
        $tagqueue = '';
        // Pop or Push
        if ( isset($regex[1][0]) && '/' == $regex[1][0] ) { // End Tag
            $tag = strtolower(substr($regex[1],1));
            // if too many closing tags
            if( $stacksize <= 0 ) {
                $tag = '';
                // or close to be safe $tag = '/' . $tag;
            }
            // if stacktop value = tag close value then pop
            else if ( $tagstack[$stacksize - 1] == $tag ) { // found closing tag
                $tag = '</' . $tag . '>'; // Close Tag
                // Pop
                array_pop( $tagstack );
                $stacksize--;
            } else { // closing tag not at top, search for it
                for ( $j = $stacksize-1; $j >= 0; $j-- ) {
                    if ( $tagstack[$j] == $tag ) {
                        // add tag to tagqueue
                        for ( $k = $stacksize-1; $k >= $j; $k--) {
                            $tagqueue .= '</' . array_pop( $tagstack ) . '>';
                            $stacksize--;
                        }
                        break;
                    }
                }
                $tag = '';
            }
        } else { // Begin Tag
            $tag = strtolower($regex[1]);

            // Tag Cleaning

            // If it's an empty tag "< >", do nothing
            if ( '' == $tag ) {
                // do nothing
            }
            // ElseIf it presents itself as a self-closing tag...
            elseif ( substr( $regex[2], -1 ) == '/' ) {
                // ...but it isn't a known single-entity self-closing tag, then don't let it be treated as such and
                // immediately close it with a closing tag (the tag will encapsulate no text as a result)
                if ( ! in_array( $tag, $single_tags ) )
                    $regex[2] = trim( substr( $regex[2], 0, -1 ) ) . "></$tag";
            }
            // ElseIf it's a known single-entity tag but it doesn't close itself, do so
            elseif ( in_array($tag, $single_tags) ) {
                $regex[2] .= '/';
            }
            // Else it's not a single-entity tag
            else {
                // If the top of the stack is the same as the tag we want to push, close previous tag
                if ( $stacksize > 0 && !in_array($tag, $nestable_tags) && $tagstack[$stacksize - 1] == $tag ) {
                    $tagqueue = '</' . array_pop( $tagstack ) . '>';
                    $stacksize--;
                }
                $stacksize = array_push( $tagstack, $tag );
            }

            // Attributes
            $attributes = $regex[2];
            if( ! empty( $attributes ) && $attributes[0] != '>' )
                $attributes = ' ' . $attributes;

            $tag = '<' . $tag . $attributes . '>';
            //If already queuing a close tag, then put this tag on, too
            if ( !empty($tagqueue) ) {
                $tagqueue .= $tag;
                $tag = '';
            }
        }
        $newtext .= substr($text, 0, $i) . $tag;
        $text = substr($text, $i + $l);
    }

    // Clear Tag Queue
    $newtext .= $tagqueue;

    // Add Remaining text
    $newtext .= $text;

    // Empty Stack
    while( $x = array_pop($tagstack) )
        $newtext .= '</' . $x . '>'; // Add remaining tags to close

    // WP fix for the bug with HTML comments
    $newtext = str_replace("< !--","<!--",$newtext);
    $newtext = str_replace("<    !--","< !--",$newtext);

    return $newtext;
}


/**
 * Newline preservation help function for wpautop
 *
 * @since 3.1.0
 * @access private
 * @param array $matches preg_replace_callback matches array
 * @return string
 */
function _autop_newline_preservation_helper( $matches ) {
    return str_replace("\n", "<WPPreserveNewline />", $matches[0]);
}


// normalize EOL characters and strip duplicate whitespace
function normalize_whitespace( $str ) {
    $str  = trim($str);
    $str  = str_replace("\r", "\n", $str);
    $str  = preg_replace( array( '/\n+/', '/[ \t]+/' ), array( "\n", ' ' ), $str );
    return $str;
}


/**
 * Properly strip all HTML tags including script and style
 *
 * @since 2.9.0
 *
 * @param string $string String containing HTML tags
 * @param bool $remove_breaks optional Whether to remove left over line breaks and white space chars
 * @return string The processed string.
 */
function strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags($string);

    if ( $remove_breaks )
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);

    return trim( $string );
}