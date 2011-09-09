<?php

class category_controller {
        
    public function index($category_name = ""){
        
        echo '<h1>Category controller</h1>';
        
        $data = $category_name;
        $data2 = '';
        $data3 = '';
	
        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));
		
    }// END index
} // END Class category

?> 