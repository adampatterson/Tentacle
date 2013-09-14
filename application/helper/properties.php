<?
/*
 *
 * Common db builder
 *        &
 *   Model loader
 *
 * This needs to be cleaned up into something smarter, but it does the job for now.
 */

class properties
{
    public $post_table;
    public $post_meta_table;
    public $term_table;
    public $term_taxonomy_table;
    public $term_relationships;
    public $media_table;
    public $options_table;
    public $snippet_table;
    public $statistics_table;
    public $statistics_meta_table;
    public $user_table;

    public function post_table ( )
    {
        return $this->post_table = db ( 'posts' );
    }

    public function post_meta_table ( )
    {
        return $this->post_meta_table = db ( 'posts_meta' );
    }

    public function term_table ( )
    {
        return $this->term_table = db ( 'terms' );
    }

    public function term_taxonomy_table ( )
    {
        return $this->term_taxonomy_table = db ( 'term_taxonomy' );
    }

    public function term_relationship_table ( )
    {
        return $this->term_relationship_table = db ( 'term_relationship_table' );
    }

    public function media_table ( )
    {
        return $this->media_table = db ( 'media' );
    }

    public function options_table( )
    {
        return $this->options_table = db ( 'options' );
    }

    public function snippet_table( )
    {
        return $this->snippet_table = db ( 'snippet' );
    }

    public function statistics_table ( )
    {
        return $this->statistics_table = db ( 'statistics' );
    }

    public function statistics_meta_table ( )
    {
        return $this->statistics_meta_table = db ( 'statistics_meta' );
    }

    public function user_table ( )
    {
        return $this->user_table = db ( 'users' );
    }

    public $content_model;
    public $user_model;
    public $category_model;
    public $tag_model;

    public function content_model ( )
    {
        return $this->content_model = load::model( 'content' );
    }

    public function user_model ( )
    {
        return $this->user_model = load::model( 'user' );
    }

    public function category_model ( )
    {
        return $this->category_model = load::model( 'category' );
    }

    public function tag_model ( )
    {
        return $this->tag_model = load::model( 'tags' );
    }
}