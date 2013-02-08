<?php
class api_controller {

    # All ajax calls should pass throught this controller.

    public function index ()
    {

        echo json_encode(array('status'=>503));

    }

    public function feed($format = 'json')
    {
        header('Content-type: text/json');
        header('Content-type: application/json');

        define ( 'FRONT'		,'true' );

        echo json_encode( load::model('post')->get_quantity( 5 ) );
    }
}
