<?
// Include tempalte files
    function get_header () {echo 'get the header';}
    function get_sidebar () {echo 'get the sidebar';}
    function get_footer () {echo 'get the footer';}
    function get_part () {echo 'get the template parts';}
    function get_search () {echo 'get the search form';}
    function get_comment () {echo 'get the comments';}
    function get_bloginfo () {echo 'get the bloginfo';}

// Blog Info
    function bloginfo() 
    {
        // http://codex.wordpress.org/Function_Reference/bloginfo
    }
   
// Author Tags
    function the_author () {}
    function get_the_author () {}
    function the_author_link () {}
    function get_the_author_link () {}
    function the_author_meta () {}
    function the_author_posts () {}
    function the_author_posts_link () {}
    function wp_dropdown_users () {}
    function wp_list_authors () {}
    function get_author_posts_url () {}
    
// Content Information
    function get_title ()  {}
    function get_titles ()  {}
    function get_menue () {}
    function single_cat_title () {
           // Single or list
           // accept before and after code IE: <li>
        }
    function get_categories ()  {}
    function single_tag_title () {
           // Single or list
           // accept before and after code IE: <li>
        }
    function get_tags () {}
    function the_search_query () {}
    function the_shortlink () {}
    
// Date and Time
    function get_date ( $d = '', $before = '', $after = '', $echo = true )  {}
    function get_modified_date ( $d = '', $before = '', $after = '', $echo = true )  {}
    function get_time( $d = '' )  {}
    function get_modified_time ($d = '')  {}

// Permalinks
    function get_permalink () {}
    function get_post_permalink () {}
    function permalink_anchor () {}
    function permalink_single_rss () {}
    function post_permalink () {}
    function the_permalink  () {}
    
// Post
    function body_class () {}
    function next_image_link () {}
    function next_post_link () {}
    function next_posts_link () {}
    function post_class () {}
    function post_password_required () {}
    function posts_nav_link () {}
    function previous_image_link () {}
    function previous_post_link () {}
    function previous_posts_link () {}
    function single_post_title () {}
    function sticky_class () {}
    function the_category () {}
    function the_category_rss () {}
    function the_content () {}
    function the_content_rss () {}
    function the_excerpt () {}
    function the_excerpt_rss () {}
    function the_ID () {}
    function the_meta () {}
    function the_shortlink () {}
    function the_tags () {}
    function the_title () {}
    function the_title_attribute () {}
    function the_title_rss () {}
    function wp_link_pages () {}
    
// Comment 
    function cancel_comment_reply_link () {}
    function comment_author () {}
    function comment_author_email () {}
    function comment_author_email_link () {}
    function comment_author_IP () {}
    function comment_author_link () {}
    function comment_author_rss () {}
    function comment_author_url () {}
    function comment_author_url_link () {}
    function comment_class () {}
    function comment_date () {}
    function comment_excerpt () {}
    function comment_form_title () {}
    function comment_form () {}
    function comment_ID () {}
    function comment_id_fields () {}
    function comment_reply_link () {}
    function comment_text () {}
    function comment_text_rss () {}
    function comment_time () {}
    function comment_type () {}
    function comments_link () {}
    function comments_number () {}
    function comments_popup_link () {}
    function comments_popup_script () {}
    function comments_rss_link () {}
    function get_avatar () {}
    function next_comments_link () {}
    function paginate_comments_links () {}
    function permalink_comments_rss () {}
    function previous_comments_link () {}
    function wp_list_comments () {}

// Post Media
    function get_post_thumbnail_id () {}
    function get_the_post_thumbnail () {}
    function has_post_thumbnail () {}
    function the_post_thumbnail () {}
    function get_attachment_link () {}
    function is_attachment () {}
    function the_attachment_link () {}
    function wp_attachment_is_image () {}
    function wp_get_attachment_image () {}
    function wp_get_attachment_image_src () {}
    function wp_get_attachment_metadata () {}
    
// Comment Tags
    function cancel_comment_reply_link () {}
    function comment_author () {}
    function comment_author_email () {}
    function comment_author_email_link () {}
    function comment_author_IP () {}
    function comment_author_link () {}
    function comment_author_rss () {}
    function comment_author_url () {}
    function comment_author_url_link () {}
    function comment_class () {}
    function comment_date () {}
    function comment_excerpt () {}
    function comment_form_title () {}
    function comment_form () {}
    function comment_ID () {}
    function comment_id_fields () {}
    function comment_reply_link () {}
    function comment_text () {}
    function comment_text_rss () {}
    function comment_time () {}
    function comment_type () {}
    function comments_link () {}
    function comments_number () {}
    function comments_popup_link () {}
    function comments_popup_script () {}
    function comments_rss_link () {}
    function get_avatar () {}
    function next_comments_link () {}
    function paginate_comments_links () {}
    function permalink_comments_rss () {}
    function previous_comments_link () {}
    function wp_list_comments () {}
    
// Link content
    function get_stylesheet() {}
    function get_template_directory() {}
    function get_feed_link () {}
    
// Edit Links
    function edit_comment_link () {}
    function edit_post_link () {}

// for plugins to load data in selected areas.
    function add_header () {}
    function add_sidebar () {}
    function add_footer () {}
?>