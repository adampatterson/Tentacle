<?php
/**
 * WordPress eXtended RSS file parser implementations
 *
 * @package WordPress
 * @subpackage Importer
 */

/**
 * WXR Parser that makes use of the SimpleXML PHP extension.
 * Modified from WordPress.org to work with Tentacle CMS by Adam Patterson
 */
class WXR_Parser {
    function parse( $file ) {
        $authors = $posts = $categories = $tags = $terms = array();

        $internal_errors = libxml_use_internal_errors(true);
        $xml = simplexml_load_file( $file );
        // halt if loading produces an error
        if ( ! $xml )
            return dingo_error(E_WARNING,"There was an error when reading this WXR file");


            //return dingo_error( 'SimpleXML_parse_error', 'There was an error when reading this WXR file', 'wordpress-importer', libxml_get_errors() );

        $wxr_version = $xml->xpath('/rss/channel/wp:wxr_version');
        if ( ! $wxr_version )
            return dingo_error(E_WARNING,'This does not appear to be a WXR file, missing/invalid WXR version number');

        $wxr_version = (string) trim( $wxr_version[0] );
        // confirm that we are dealing with the correct file format
        if ( ! preg_match( '/^\d+\.\d+$/', $wxr_version ) )
            return dingo_error(E_WARNING,'This does not appear to be a WXR file, missing/invalid WXR version number');

        $base_url = $xml->xpath('/rss/channel/wp:base_site_url');
        $base_url = (string) trim( $base_url[0] );

        $namespaces = $xml->getDocNamespaces();
        if ( ! isset( $namespaces['wp'] ) )
            $namespaces['wp'] = 'http://wordpress.org/export/1.1/';
        if ( ! isset( $namespaces['excerpt'] ) )
            $namespaces['excerpt'] = 'http://wordpress.org/export/1.1/excerpt/';

        // grab authors
        foreach ( $xml->xpath('/rss/channel/wp:author') as $author_arr ) {
            $a = $author_arr->children( $namespaces['wp'] );
            $login = (string) $a->author_login;
            $authors[$login] = array(
                'author_id' => (int) $a->author_id,
                'author_login' => $login,
                'author_email' => (string) $a->author_email,
                'author_display_name' => (string) $a->author_display_name,
                'author_first_name' => (string) $a->author_first_name,
                'author_last_name' => (string) $a->author_last_name
            );
        }

        // grab cats, tags and terms
        foreach ( $xml->xpath('/rss/channel/wp:category') as $term_arr ) {
            $t = $term_arr->children( $namespaces['wp'] );
            $categories[] = array(
                'term_id' => (int) $t->term_id,
                'category_slug' => (string) $t->category_nicename,
                'category_parent' => (string) $t->category_parent,
                'category_name' => (string) $t->cat_name,
                'category_description' => (string) $t->category_description
            );
        }

        foreach ( $xml->xpath('/rss/channel/wp:tag') as $term_arr ) {
            $t = $term_arr->children( $namespaces['wp'] );
            $tags[] = array(
                'term_id' => (int) $t->term_id,
                'tag_slug' => (string) $t->tag_slug,
                'tag_name' => (string) $t->tag_name,
                'tag_description' => (string) $t->tag_description
            );
        }

//        foreach ( $xml->xpath('/rss/channel/wp:term') as $term_arr ) {
//            $t = $term_arr->children( $namespaces['wp'] );
//            $terms[] = array(
//                'term_id' => (int) $t->term_id,
//                'term_taxonomy' => (string) $t->term_taxonomy,
//                'slug' => (string) $t->term_slug,
//                'term_parent' => (string) $t->term_parent,
//                'term_name' => (string) $t->term_name,
//                'term_description' => (string) $t->term_description
//            );
//        }

        // grab posts
        foreach ( $xml->channel->item as $item ) {
            $post = array(
                'post_title' => (string) $item->title
                //'guid' => (string) $item->guid,
            );

            $dc = $item->children( 'http://purl.org/dc/elements/1.1/' );
            $post['post_author'] = (string) $dc->creator;

            $content = $item->children( 'http://purl.org/rss/1.0/modules/content/' );
            $excerpt = $item->children( $namespaces['excerpt'] );
            $post['post_content'] = (string) $content->encoded;
            $post['post_excerpt'] = (string) $excerpt->encoded;

            $wp = $item->children( $namespaces['wp'] );
            $post['post_id'] = (int) $wp->post_id;
            $post['post_date'] = (string) $wp->post_date;
            //$post['post_date_gmt'] = (string) $wp->post_date_gmt;
            $post['comment_status'] = (string) $wp->comment_status;
            $post['ping_status'] = (string) $wp->ping_status;
            $post['post_name'] = (string) $wp->post_name;
            $post['status'] = (string) $wp->status;
            $post['post_parent'] = (int) $wp->post_parent;
            $post['menu_order'] = (int) $wp->menu_order;
            $post['post_type'] = (string) $wp->post_type;
            $post['post_password'] = (string) $wp->post_password;
            $post['is_sticky'] = (int) $wp->is_sticky;

            if ( isset($wp->attachment_url) )
                $post['attachment_url'] = (string) $wp->attachment_url;

            foreach ( $item->category as $c ) {
                $att = $c->attributes();
                if ( isset( $att['nicename'] ) )
                    $post['terms'][] = array(
                        'name' => (string) $c,
                        'slug' => (string) $att['nicename'],
                        'domain' => (string) $att['domain']
                    );
            }

            foreach ( $wp->postmeta as $meta ) {
                $post['postmeta'][] = array(
                    'key' => (string) $meta->meta_key,
                    'value' => (string) $meta->meta_value
                );
            }

            foreach ( $wp->comment as $comment ) {
                $meta = array();
                if ( isset( $comment->commentmeta ) ) {
                    foreach ( $comment->commentmeta as $m ) {
                        $meta[] = array(
                            'key' => (string) $m->meta_key,
                            'value' => (string) $m->meta_value
                        );
                    }
                }

                $post['comments'][] = array(
                    'comment_id' => (int) $comment->comment_id,
                    'comment_author' => (string) $comment->comment_author,
                    'comment_author_email' => (string) $comment->comment_author_email,
                    'comment_author_IP' => (string) $comment->comment_author_IP,
                    'comment_author_url' => (string) $comment->comment_author_url,
                    'comment_date' => (string) $comment->comment_date,
                    'comment_date_gmt' => (string) $comment->comment_date_gmt,
                    'comment_content' => (string) $comment->comment_content,
                    'comment_approved' => (string) $comment->comment_approved,
                    'comment_type' => (string) $comment->comment_type,
                    'comment_parent' => (string) $comment->comment_parent,
                    'comment_user_id' => (int) $comment->comment_user_id,
                    'commentmeta' => $meta,
                );
            }

            $posts[] = $post;
        }

        return array(
            'authors' => $authors,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'terms' => $terms,
            'base_url' => $base_url,
            'version' => $wxr_version
        );
    }
}

/**
 * If fetching attachments is enabled then attempt to create a new attachment
 *
 * @param array $post Attachment post details from WXR
 * @param string $url URL to fetch attachment from
 * @return int|WP_Error Post ID on success, WP_Error otherwise
 */
function process_attachment( $post, $url ) {
    if ( ! $this->fetch_attachments )
        return new WP_Error( 'attachment_processing_error',
            __( 'Fetching attachments is not enabled', 'wordpress-importer' ) );

    // if the URL is absolute, but does not contain address, then upload it assuming base_site_url
    if ( preg_match( '|^/[\w\W]+$|', $url ) )
        $url = rtrim( $this->base_url, '/' ) . $url;

    $upload = $this->fetch_remote_file( $url, $post );
    if ( is_wp_error( $upload ) )
        return $upload;

    if ( $info = wp_check_filetype( $upload['file'] ) )
        $post['post_mime_type'] = $info['type'];
    else
        return new WP_Error( 'attachment_processing_error', __('Invalid file type', 'wordpress-importer') );

    $post['guid'] = $upload['url'];

    // as per wp-admin/includes/upload.php
    $post_id = wp_insert_attachment( $post, $upload['file'] );
    wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );

    // remap resized image URLs, works by stripping the extension and remapping the URL stub.
    if ( preg_match( '!^image/!', $info['type'] ) ) {
        $parts = pathinfo( $url );
        $name = basename( $parts['basename'], ".{$parts['extension']}" ); // PATHINFO_FILENAME in PHP 5.2

        $parts_new = pathinfo( $upload['url'] );
        $name_new = basename( $parts_new['basename'], ".{$parts_new['extension']}" );

        $this->url_remap[$parts['dirname'] . '/' . $name] = $parts_new['dirname'] . '/' . $name_new;
    }

    return $post_id;
}

/**
 * Attempt to download a remote file attachment
 *
 * @param string $url URL of item to fetch
 * @param array $post Attachment details
 * @return array|WP_Error Local file location details on success, WP_Error otherwise
 */
function fetch_remote_file( $url, $post ) {
    // extract the file name and extension from the url
    $file_name = basename( $url );

    // get placeholder file in the upload dir with a unique, sanitized filename
    $upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
    if ( $upload['error'] )
        return new WP_Error( 'upload_dir_error', $upload['error'] );

    // fetch the remote url and write it to the placeholder file
    $headers = wp_get_http( $url, $upload['file'] );

    // request failed
    if ( ! $headers ) {
        @unlink( $upload['file'] );
        return new WP_Error( 'import_file_error', __('Remote server did not respond', 'wordpress-importer') );
    }

    // make sure the fetch was successful
    if ( $headers['response'] != '200' ) {
        @unlink( $upload['file'] );
        return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'wordpress-importer'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
    }

    $filesize = filesize( $upload['file'] );

    if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
        @unlink( $upload['file'] );
        return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'wordpress-importer') );
    }

    if ( 0 == $filesize ) {
        @unlink( $upload['file'] );
        return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'wordpress-importer') );
    }

    $max_size = (int) $this->max_attachment_size();
    if ( ! empty( $max_size ) && $filesize > $max_size ) {
        @unlink( $upload['file'] );
        return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', 'wordpress-importer'), size_format($max_size) ) );
    }

    // keep track of the old and new urls so we can substitute them later
    $this->url_remap[$url] = $upload['url'];
    $this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
    // keep track of the destination if the remote url is redirected somewhere else
    if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
        $this->url_remap[$headers['x-final-location']] = $upload['url'];

    return $upload;
}

/**
 * Use stored mapping information to update old attachment URLs
 */
function backfill_attachment_urls() {
    global $wpdb;
    // make sure we do the longest urls first, in case one is a substring of another
    uksort( $this->url_remap, array(&$this, 'cmpr_strlen') );

    foreach ( $this->url_remap as $from_url => $to_url ) {
        // remap urls in post_content
        $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", $from_url, $to_url) );
        // remap enclosure urls
        $result = $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key='enclosure'", $from_url, $to_url) );
    }
}