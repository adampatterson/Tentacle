<?php

class blog_controller {
        
    public function index($post_name = ""){
        
        echo '<h1>Blog controller</h1>';
        
        $data = $post_name;
        $data2 = '';
        $data3 = '';

        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));;   
    }// END index
} // END Class blog

?> 