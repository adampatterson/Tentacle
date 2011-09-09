<?php

class tag_controller {
        
    public function index($tag_name = ""){
        
        echo '<h1>Tag controller</h1>';
        
        $data = $tag_name;
        $data2 = '';
        $data3 = '';

        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));   
    }// END index
} // END Class tag

?> 