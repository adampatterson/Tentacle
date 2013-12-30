<?php

class comment_controller {
        
    public function index($comment_name = ""){
        
        echo '<h1>Comment controller</h1>';
        
        $data = $comment_name;
        $data2 = '';
        $data3 = '';

        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));   
        
    }// END index
} // END Class category

?> 