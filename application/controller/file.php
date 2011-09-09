<?php

class file_controller {
        
    public function index($file_name = ""){
        
        echo '<h1>File controller</h1>';
                         
        $data = $file_name;
        $data2 = '';
        $data3 = '';

        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));   
    }// END index
} // END Class file

?> 