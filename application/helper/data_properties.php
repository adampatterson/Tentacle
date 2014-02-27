<?
/*
 *
 * Common db builder
 *        &
 *   Model loader
 *
 * This needs to be cleaned up into something smarter, but it does the job for now.
 */


if ( defined( 'SETUP' ) && strpos( BASE_URI,'install' ) == true ) {
    load::library('db');
}

class properties
{
    private $post_table;
    private $post_meta_table;
    private $term_table;
    private $term_taxonomy_table;
    private $term_relationship_table;
    private $media_table;
    private $options_table;
    private $snippet_table;
    private $statistics_table;
    private $statistics_meta_table;
    private $user_table;

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
        return $this->term_relationship_table = db ( 'term_relationships' );
    }

    public function media_table ( )
    {
        return $this->media_table = db ( 'media' );
    }

    public function options_table( )
    {
        return $this->options_table = db( 'options' );
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
    public $options_model;
    public $snippet_model;

    public $email_model;
    public $serpent_model;
    public $plugin_model;
    public $media_model;
    public $migration_model;

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

    public function options_model ( )
    {
        return $this->options_model = load::model( 'settings' );
    }

    public function email_model ( )
    {
        return $this->email_model = load::model( 'email' );
    }

    public function serpent_model ( )
    {
        return $this->serpent_model = load::model( 'serpent' );
    }

    public function plugin_model ( )
    {
        return $this->plugin_model = load::model( 'plugin' );
    }

    public function snippet_model ( )
    {
        return $this->snippet_model = load::model( 'snippet' );
    }

    public function media_model ( )
    {
        return $this->media_model = load::model( 'media' );
    }

    public function migration_model ( )
    {
        return $this->migration_model = load::model( 'migration' );
    }
}