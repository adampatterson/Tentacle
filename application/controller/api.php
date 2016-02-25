<?php
load::helper( 'data_properties' );

class api_controller extends properties
{

    # All ajax calls should pass throught this controller.
    public function index ()
    {
        echo json_encode(array('status'=>503));
    }

    public function feed($format = 'json')
    {
        #header('Content-type: text/json');
        header("content-type: application/json");

        define ( 'FRONT'		,'true' );

        $feed = $this->content_model()
            ->type( 'post' )
            ->get_quantity( 6 );

        foreach ( $feed as $key => $post )
        {
             if(strlen($post->content) > 50 ) {
                $json_feed[$key]['title'] = $post->title;
                $json_feed[$key]['content'] = text::truncate(strip_tags($post->content), 300);
                $json_feed[$key]['url'] = BASE_URL.$post->uri;
            }
        }

        echo 'jsonpcallback('. json_encode($json_feed) . ')';
    }
}
