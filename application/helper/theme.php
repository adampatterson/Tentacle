<?php if(!defined('DINGO')){die('External Access to File Denied');}
/**
 * File: Theme
 */

class theme {

    /**
     * Function: library
     * Loads libraries specific to Tentacle
     *
     * Parameters:
     *     $folder - path
     *     $file - name
     *
     * Returns:
     *     Required library
     */
    public static function library($folder='/',$library)
    {
        return load::file(THEMES_DIR.ACTIVE_THEME.'/library/'.$folder,$library,'library');
    }


    /**
     * Function: load_part
     * Load theme parts for inclusion.
     *
     * Parameters:
     *     $part - string
     *     $data - object/array
     *
     * Returns:
     *     $string
     *
     * See Also:
     *     <render>
     */
    public static function part( $part, $data = '' )
    {
        // If theme does not exist display error
        if(!file_exists(THEMES_DIR.ACTIVE_THEME."/$part.php"))
        {
            dingo_error(E_USER_WARNING,'The requested theme part ('.THEMES_DIR.ACTIVE_THEME."/part-$part.php) could not be found.");
            return FALSE;
        } // if
        else
        {
            // If data is array, convert keys to variables

            if(is_array($data))
            {
                extract($data, EXTR_OVERWRITE);
            }

            require(THEMES_DIR.ACTIVE_THEME."/$part.php");
            return FALSE;
        } // else
    }


    // Model
    // ---------------------------------------------------------------------------
    public static function model($model,$args=array())
    {
        // Model class
        $model_class = explode('/',$model);
        $model_class = end($model_class).'_model';


        if(!class_exists($model_class))
        {
            $path = THEMES_DIR.ACTIVE_THEME."/model/$model.php";

            // If model does not exist display error
            if(!file_exists($path))
            {
                dingo_error(E_USER_ERROR,"The requested model ($path) could not be found.");
                return FALSE;
            }
            else
            {
                require_once($path);
            }
        }

        // Return model class
        return new $model_class();
    }


    // Helper
    // ---------------------------------------------------------------------------
    public static function helper($helper)
    {
        return load::file(THEMES_DIR.ACTIVE_THEME.'/helper/',$helper,'helper');
    }


    // Assets
    // ---------------------------------------------------------------------------
    /**
     * Function: render
     * 	assets() will accept an comma separated string of files that will relate to bundle files in the
     * 	tentacle admin folder, as well as an output format for normal or minify and asset type.
     *
     * 	assets() will be passed a comma separated string from the load::view that sets the header file.
     *
     * Parameters:
     *	$assets - string
     *	$format - null
     *	$type - JavaScript or CSS
     *
     * Returns:
     *	$asset_list - HTML
     *
     * See Also:
     *	<build>
     */
    public static function assets($assets = '', $format = null, $type = null)
    {
        if ($assets != ''):
            $exploded_assets = explode(',', $assets);

            // Setup the return List
            $asset_list = '';

            foreach ($exploded_assets as $asset):
                $asset_list .= self::build($asset);
            endforeach;

            echo $asset_list;
        endif;
    }


    /**
     * Function: build
     *	Builds the HTML from the bundle
     *
     * Parameters:
     *	$file - bundle file to load
     *
     * Returns:
     *	HTML
     *
     * See Also:
     *	<load>
     */
    public static function build ( $file = NULL )
    {
        $file = self::load($file);

        if (file_exists($file))
            include($file);
        elseif (DEBUG == TRUE)
            echo '<!-- Could not find: '. $file .'-->';
    }


    /**
     * Function: load
     *	Loads the single bundle file
     *
     * Parameters:
     *	$load_file - File name sent from build()
     *
     * Returns:
     *	String
     */
    public static function load ( $load_file = NULL )
    {
        return THEME_URI.'/bundles/'.$load_file.'.php';
    }
}

/**
 * Class: paginate
 *
 * Based on http://stefangabos.ro/php-libraries/zebra-pagination/
 *
 */
class paginate {

    static $settings;

    public function __construct( $total, $current_page )
    {
        if ( '/'.get::option('blog_uri').'/' == BASE_URI or '/'.get::option('blog_uri') == BASE_URI  )
            $clean_uri = get::option('blog_uri').'/';
        else
            $clean_uri = preg_replace('/\/(\w+)\/(\w+)\/(\d+)/i', '${1}/', BASE_URI);
        static::$settings = $this->calculate_pages(count($total), get::option('page_limit', 5), $current_page);

        static::$settings['url'] = BASE_URL.$clean_uri.'page';
        static::$settings['current_page'] = $current_page;
        static::$settings['selectable_pages'] = '11';
        static::$settings['padding'] = true;
        static::$settings['total_pages'] = count(static::$settings['pages']);
    }

    static function padding ( $padding = true )
    {
        static::$settings['padding'] = $padding;
    }

    static function selectable_pages ( $selectable_pages = '11' )
    {
        static::$settings['selectable_pages'] = $selectable_pages;
    }


    static function pages( )
    {

        if (static::$settings['total_pages'] <= 1) return '';

        $output = '';

        // if the total number of pages is lesser than the number of selectable pages
        if (static::$settings['total_pages'] <= static::$settings['selectable_pages']) {

            // iterate ascendingly or descendingly depending on whether we're showing links in reverse order or not)
            for ( $i = 1; $i <= static::$settings['total_pages']; $i++ )

                // render the link for each page
            $output .= '<li '.(static::$settings['current_page'] == $i ? 'class="active"' : '') . '><a href="'.static::$settings['url'].'/'.$i.'">'.

                // apply padding if required
                (static::$settings['padding'] ? str_pad($i, strlen( static::$settings['total_pages'] ), '0', STR_PAD_LEFT) : $i) .

                '</a></li>';

            // if the total number of pages is greater than the number of selectable pages
        } else {

            $output .= '<li '.(static::$settings['current_page'] == 1 ? 'class="active"' : '') . '><a href="' . static::$settings['url'].'/1" >' .

                // if padding is required
                (static::$settings['padding'] ? str_pad(1, strlen(static::$settings['total_pages']), '0', STR_PAD_LEFT) : 1 ) .

                '</a></li>';

            // compute the number of adjacent pages to display to the left and right of the currently selected page so
            // that the currently selected page is always centered
            $adjacent = floor( ( static::$settings['selectable_pages'] - 3 ) / 2 );

            // this number must be at least 1
            if ($adjacent == 0) $adjacent = 1;

            $scroll_from = static::$settings['selectable_pages'] - $adjacent;

            // get the page number from where we should start rendering
            // if displaying links in natural order, then it's "2" because we have already rendered the first page
            $starting_page =  2;

            // if the currently selected page is past the point from where we need to scroll,
            // we need to adjust the value of $starting_page
            if ( static::$settings['current_page'] >= $scroll_from ) {

                // by default, the starting_page should be whatever the current page plus/minus $adjacent
                $starting_page = static::$settings['current_page'] + -$adjacent;

                // but if that would mean displaying less navigation links than specified in $this->_properties['selectable_pages']
                if ( static::$settings['total_pages'] - $starting_page < (static::$settings['selectable_pages'] - 2) )
                    $starting_page -= (static::$settings['selectable_pages'] - 2) - (static::$settings['total_pages'] - $starting_page);

                // put the "..." after the link to the first/last page
                $output .= '<li><span>&hellip;</span></li>';

            }

            // get the page number where we should stop rendering
            $ending_page = $starting_page + (1 * (static::$settings['selectable_pages'] - 3));

            // if we're showing links in natural order and ending page would be greater than the total number of pages minus 1
            // (minus one because we don't take into account the very last page which we output automatically)
            // adjust the ending page
            if ( $ending_page > static::$settings['total_pages'] - 1)
                $ending_page = static::$settings['total_pages'] - 1;

            // render pagination links
            for ($i = $starting_page; $i <= $ending_page; $i++) {

                $output .= '<li '.

                    // highlight the currently selected page
                    ( static::$settings['current_page'] == $i ? 'class="active"' : '' ) .'><a href="'. static::$settings['url'].'/'. $i . '">' .

                    // apply padding if required
                    ( static::$settings['padding'] ? str_pad($i, strlen( static::$settings['total_pages'] ), '0', STR_PAD_LEFT) : $i) .'</a></li>';
            }


            if ( static::$settings['total_pages'] - $ending_page > 1)
                $output .= '<li><span>&hellip;</span></li>';

            $output .= '<li '.( static::$settings['current_page'] == $i ? 'class="active"' : '').'><a href="' .static::$settings['total_pages']. '">' .

                // also, apply padding if necessary
                (static::$settings['padding'] ? str_pad((static::$settings['total_pages']), strlen( static::$settings['total_pages'] ), '0', STR_PAD_LEFT) : static::$settings['total_pages'] ) .

                '</a></li>';

        }

        echo $output;
    }

    static function next()
    {
        echo '<li><a href="'.static::$settings['url'].'/'.static::$settings['next'].'" class="next">Next</a></li>';
    }


    static function previous()
    {
        echo '<li><a href="'.static::$settings['url'].'/'.static::$settings['previous'].'" class="previous">Previous</a></li>';
    }


    static function last()
    {
        echo '<li '.( static::$settings['last'] == static::$settings['current_page'] ? 'class="active"' : '').'><a href="'.static::$settings['url'].'/'.static::$settings['last'].'" class=""last>Last</a></li>';
    }


    static function first()
    {
        echo '<li '.( static::$settings['current_page'] == 1 ? 'class="active"' : '').'><a href="'.static::$settings['url'].'/1" class="first">First</a></li>';
    }


    public function calculate_pages($total_rows, $rows_per_page, $page_num)
    {
        $arr = array();
        // calculate last page

        $last_page = ceil($total_rows / $rows_per_page);
        // make sure we are within limits
        $page_num = (int) $page_num;

        if ($page_num < 1):
            $page_num = 1;
        elseif ($page_num > $last_page):
            $page_num = $last_page;
        endif;

        $upto = ($page_num - 1) * $rows_per_page;

        $arr['limit'] = 'LIMIT '.$upto.',' .$rows_per_page;
        $arr['current'] = $page_num;
        if ($page_num == 1)
            $arr['previous'] = $page_num;
        else
            $arr['previous'] = $page_num - 1;
        if ($page_num == $last_page)
            $arr['next'] = $last_page;
        else
            $arr['next'] = $page_num + 1;
        $arr['last'] = $last_page;
        $arr['info'] = 'Page ('.$page_num.' of '.$last_page.')';
        $arr['pages'] = $this->get_surrounding_pages($page_num, $last_page, $arr['next']);

        return $arr;
    }


    function get_surrounding_pages($page_num, $last_page, $next)
    {
        $arr = array();
        // @todo: this needs a control
        $show = 100; // how many boxes
        // at first
        if ($page_num == 1)
        {
            // case of 1 page only
            if ($next == $page_num) return array(1);
            for ($i = 0; $i < $show; $i++)
            {
                if ($i == $last_page) break;
                array_push($arr, $i + 1);
            }
            return $arr;
        }
        // at last
        if ($page_num == $last_page)
        {
            $start = $last_page - $show;
            if ($start < 1) $start = 0;
            for ($i = $start; $i < $last_page; $i++)
            {
                array_push($arr, $i + 1);
            }
            return $arr;
        }
        // at middle
        $start = $page_num - $show;
        if ($start < 1) $start = 0;
        for ($i = $start; $i < $page_num; $i++)
        {
            array_push($arr, $i + 1);
        }
        for ($i = ($page_num + 1); $i < ($page_num + $show); $i++)
        {
            if ($i == ($last_page + 1)) break;
            array_push($arr, $i);
        }
        return $arr;
    }
}

/**
 * Function: _cleanup_header_comment
 * 	Converts a given string to camel-case.
 *
 * Returns:
 *     String
 */
function _cleanup_header_comment($str)
{
    return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}


/**
 * Function: the_posts
 *   Pre-Processing of content done by core formatting as well as filters from plugins.
 *
 * Returns:
 *     Object - Post related content
 */
function the_posts() {
    var_dump(URI);

    $parts = explode('/', URI);
    var_dump($parts);

    # Get by date year/month
    # return load::model( 'post' )->get_by_date('1353');

    if (URI == 'category' || URI == get::option('blog_uri')) {
        return  load::model( 'post' )->get( );
    } else {
        return  load::model( 'category' )->get_by_slug( CATEGORY_NAME );
    }
}


/**
 * Function: the_content
 *   Pre-Processing of content done by core formatting as well as filters from plugins.
 *
 * Parameters:
 *	  $content - String
 *
 * Returns:
 *     $content - Slashes removed.
 */
function the_content( $content='', $editor = false )
{
    load::helper('format');
    load::library('SmartyPants', 'smartypants');

    $content = stripslashes( $content );

    if (!$editor)
    {
        if (event::exists('preview'))
            $content = event::filter( "preview", $content );

        if (event::exists('content'))
            $content = event::filter( "content", $content );

        if (event::exists('shortcode'))
            $content = event::filter( "shortcode", $content );
    }

    $content = autop( $content );

    if (!$editor)
    {
        $content = texturize( $content );
        $content = make_clickable($content);
    }

    return $content;
}


/**
 * Function: render_header
 *   Renders and plugins that would output HTML in the footer.
 *
 * Returns:
 *     $content
 */
function render_header( $location = null )
{
    if ( $location != 'admin'){

        if(event::exists("theme_header"))
            return event::filter("theme_header");

    } else {

        if(event::exists("admin_header"))
            return event::filter("admin_header");

    }
}


/**
 * Function: render_meta
 *   Renders a plugins meta HTML in the header.
 *
 * Returns:
 *     $content
 */
function render_meta( $location = null )
{
    if ( $location != 'admin' and event::exists("theme_meta"))
        return event::filter("theme_meta");

}


/**
 * Function: render_canonical
 *   Renders the pages canonical URL
 *
 * Returns:
 *     $content
 */
function render_canonical( $location = null )
{
        echo "<link rel='canonical' href='".BASE_URL.URI."' />\n";
}


/**
 * Function: render_shortlink
 *   Renders the pages short URL from page /p/#ID
 *
 * Returns:
 *     $content
 */
function render_shortlink( $location = null )
{
    if (IS_HOME)
        echo "<link rel='shortlink' href='".BASE_URL."' />\n";
    else
        echo "<link rel='shortlink' href='".BASE_URL.'p/'.ID."' />\n";

}


/**
 * Function: render_content
 *   Renders and plugins that would output HTML in the footer.
 *
 * Returns:
 *     $content
 */
function render_content( )
{
    if(event::exists("theme_content"))
        return event::filter("theme_content");
}


/**
 * Function: render_footer
 *   Renders and plugins that would output HTML in the footer.
 *
 * Returns:
 *     $content
 */
function render_footer( )
{
    if(event::exists("theme_footer"))
        return event::filter("theme_footer");

    if(event::exists("footer_admin"))
        return event::filter("footer_admin");
}


/**
 * Function: current_theme
 * 	Returns HTML for the current active theme ( sets Bootstrap Label )
 *
 * Parameters:
 *     $theme_id = INT
 *
 * Returns:
 *     HTML
 */
function current_theme( $theme_id = '' )
{
    $options = load::model( 'settings' );

    if ( $theme_id == $options->get( 'appearance' ) )
    {
        echo '<span class="label label-success">Active</span>';
    }
}


/**
 * Function: get_themes
 * 	Returns an array of theme data.
 *
 * Returns:
 *     $themes - Array
 *
 * See Also:
 *     <get_templates>
 */
function get_themes()
{
    $themes = array();
    $dir = THEMES_DIR;
    if ($handle = opendir($dir))
    {
        while (false !== ($file = readdir($handle)))
        {
            if (strpos($file, '.') !== 0 && is_dir($dir.$file))
            {

                $theme_index = glob(THEMES_DIR.$file.'/index.php');
                if (empty($theme_index)) {
                    $theme_index = array();
                    $theme_index[0] = NULL;
                }

                $theme_screenshot = glob(THEMES_DIR.$file.'/screenshot.png');
                if (empty($theme_screenshot)) {
                    $theme_screenshot = array();
                    $theme_screenshot[0] = 'http://placehold.it/210x150';
                } else {
                    $theme_screenshot[0] = THEMES_URL.'/'.$file.'/screenshot.png';
                }

                $theme_style = glob(THEMES_DIR.'/'.$file.'/style.css');
                if (empty($theme_style)) {
                    $theme_style = array();
                    $theme_style[0] = NULL;
                } else {
                    $theme_style[0] = THEMES_URL.'/'.$file.'/style.css';
                }

                $themes[$file]['index'] = $theme_index[0];
                $themes[$file]['screenshot'] = $theme_screenshot[0];
                $themes[$file]['style'] = $theme_style[0];
                $themes[$file]['theme_name'] = string::humanize($file);
                $themes[$file]['theme_id'] = $file;
            }
        }
        closedir($handle);
    }
    asort($themes);

    return(array_to_object($themes));
}


/**
 * Function: get_settings
 * 	Returns an array of themes settings parsed from style.css
 *
 * Parameters:
 *     $style_path - String ( theme name )
 *
 * Returns:
 *     $theme - Array
 */
function get_settings ( $style_path = 'default' )
{
    $style_file = THEMES_DIR.$style_path.'/style.css';
    if ( file_exists( $style_file ) )
    {
        $file = get_data($style_file, 'theme');

        $theme[$style_file]['theme_name'] = $file['Name'];
        $theme[$style_file]['theme_uri'] = $file['URI'];
        $theme[$style_file]['theme_description'] = $file['Description'];
        $theme[$style_file]['theme_author'] = $file['Author'];
        $theme[$style_file]['theme_version'] = $file['Version'];
    } else {
        $theme[$style_file]['theme_description'] = 'This theme has a missing style sheet.';
    }

    return( array_to_object( $theme ) );
} // Get Settings


/**
 * Function: get_templates
 * Returns a list of template files located in $theme_folder
 *
 * Parameters:
 *     $theme_folder - String
 *
 * Returns:
 *     $template - Array
 *
 * See Also:
 *     <get_themes>
 */
function get_templates ( $theme_folder )
{
    $php_files = glob(THEMES_DIR.$theme_folder.'/*.php');

    foreach ($php_files as $php_file):

        $file = get_data($php_file, 'template');

        $file_name = basename( $php_file );
        $file_id = explode( '.', $file_name );

        if ( $file['Name'] != '' ):
            $template[$php_file]['template_id'] = $file_id[0];
            $template[$php_file]['template_name'] = $file['Name'];
            $template[$php_file]['template_uri'] = $file['URI'];
            $template[$php_file]['template_description'] = $file['Description'];
            $template[$php_file]['template_author'] = $file['Author'];
            $template[$php_file]['template_version'] = $file['Version'];
            //$template[$php_file]['template_scaffolding'] = $file['Scaffolding'];
        endif;
    endforeach;

    return( array_to_object( $template ) );

}


/**
 * Function: get_post_type
 *
 * Parameters:
 *     $theme_folder - String
 *
 * Returns:
 *     $template - Array
 *
 * See Also:
 *     <get_templates> <get_themes>
 */
function get_post_type ( $theme_folder )
{
    $php_files = glob(THEMES_DIR.'/'.$theme_folder.'/type-*.php');

    foreach ($php_files as $php_file):

        $file = get_data($php_file, 'post_type');

        $file_name = basename( $php_file );
        $file_id = explode( '.', $file_name );

        if ( $file['Type'] != '' ):
            $template[$php_file]['part_id'] = $file_id[0];
            $template[$php_file]['part_name'] = $file['Type'];
        endif;
    endforeach;

    return( $template );
}


/*
function get_resources( $index_path = '' )
{	
	$index_file = $index_path.'/index.php';
	
	if ( file_exists( $index_file ) ):
		include $index_file;
		
		if ( isset( $resource_assets ) ):
			return $resource_assets;
		else:
			return NULL;
		endif;
	else:
		return NULL;
	endif;	
} // Get Resources
*/


/**
 * Function: get_file_data
 * 	Retrieve metadata from a file.
 * 	Modified from WordPress
 *
 * Parameters:
 *     $file -
 *	  $default_headers -
 *
 * Returns:
 *     $file_data - Array
 */
function get_file_data( $file, $default_headers )
{
    // We don't need to write to the file, so just open for reading.
    $fp = fopen( $file, 'r' );

    // Pull only the first 8kiB of the file in.
    $file_data = fread( $fp, 8192 );

    // PHP will close file handle, but we are good citizens.
    fclose( $fp );

    $all_headers = $default_headers;

    foreach ( $all_headers as $field => $regex ):
        preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, ${$field});

        if ( !empty( ${$field} ) )
            ${$field} = _cleanup_header_comment( ${$field}[1] );
        else
            ${$field} = '';
    endforeach;

    $file_data = compact( array_keys( $all_headers ) );

    return $file_data;
}


/**
 * Function: get_data
 *
 * Parameters:
 *     $theme_file - String
 *	  $data_type - theme / template / post_type
 *
 * Returns:
 *     $theme_data - Array
 */
function get_data( $theme_file, $data_type )
{
    if ( $data_type == 'template' ) {

        $default_headers = array(
            'Name' => 'Name',
            'URI' => 'URI',
            'Description' => 'Description',
            'Author' => 'Author',
            'AuthorURI' => 'Author URI',
            'Version' => 'Version',
            'Template' => 'Template',
            'Status' => 'Status'
        );

        $theme_data = get_file_data( $theme_file, $default_headers );

        $theme_data['Name'] = $theme_data['Title'] = $theme_data['Name'];
        $theme_data['URI'] = $theme_data['URI'];
        $theme_data['Description'] = $theme_data['Description'];
        $theme_data['AuthorURI'] = $theme_data['AuthorURI'];
        $theme_data['Template'] = $theme_data['Template'];
        $theme_data['Version'] = $theme_data['Version'];
        //$theme_data['Scaffolding'] = get_scaffold($theme_file);

        if ( $theme_data['Status'] == '' ):
            $theme_data['Status'] = 'publish';
        else:
            $theme_data['Status'] = $theme_data['Status'];
        endif;

        if ( $theme_data['Author'] == '' ):
            $theme_data['Author'] = $theme_data['AuthorName'] = 'Anonymous';
        else:
            $theme_data['AuthorName'] = $theme_data['Author'];
            if ( empty( $theme_data['AuthorURI'] ) ):
                $theme_data['Author'] = $theme_data['AuthorName'];
            else:
                $theme_data['Author'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', $theme_data['AuthorURI'], esc_attr__( 'Visit author homepage' ), $theme_data['AuthorName'] );
            endif;
        endif;

        // need to cean out invalid files.
        return $theme_data;

    } elseif ( $data_type == 'theme' ) {

        $default_headers = array(
            'Name' => 'Name',
            'URI' => 'URI',
            'Description' => 'Description',
            'Author' => 'Author',
            'AuthorURI' => 'Author URI',
            'Version' => 'Version',
            'Template' => 'Template',
            'Status' => 'Status'
        );

        $theme_data = get_file_data( $theme_file, $default_headers );

        $theme_data['Name'] = $theme_data['Title'] = $theme_data['Name'];
        $theme_data['URI'] = $theme_data['URI'];
        $theme_data['Description'] = $theme_data['Description'];
        $theme_data['AuthorURI'] = $theme_data['AuthorURI'];
        $theme_data['Template'] = $theme_data['Template'];
        $theme_data['Version'] = $theme_data['Version'];

        if ( $theme_data['Status'] == '' ):
            $theme_data['Status'] = 'publish';
        else:
            $theme_data['Status'] = $theme_data['Status'];
        endif;

        if ( $theme_data['Author'] == '' ):
            $theme_data['Author'] = $theme_data['AuthorName'] = 'Anonymous';
        else:
            $theme_data['AuthorName'] = $theme_data['Author'];
            if ( empty( $theme_data['AuthorURI'] ) ):
                $theme_data['Author'] = $theme_data['AuthorName'];
            else:
                $theme_data['Author'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', $theme_data['AuthorURI'], esc_attr__( 'Visit author homepage' ), $theme_data['AuthorName'] );
            endif;
        endif;

        // need to cean out invalid files.
        return $theme_data;

    } elseif ( $data_type == 'post_type' ) {

        $default_headers = array(
            'Type' => 'Type'
        );

        $theme_data = get_file_data( $theme_file, $default_headers );

        $theme_data['Type'] = $theme_data['Type'];

        // need to cean out invalid files.
        return $theme_data;
    }
}