<?php

class page_controller {
        
    public function index($page_name = ""){
        
        $data = 'index page';
        $data2 = '';
        $data3 = '';

		load::library ('file');
		$scaffold = new Scaffold ();
		//load::view('admin_view', array( 'scaffold'=>$scaffold, 'data'=>$data));
		tentacle::render ('home', array ('scaffold' => $scaffold));
                      
        }// END index
    
    
    public function article($page_name = "", $subpage_name = "", $subpage_name2 = ""){
        
        echo '<h1>Page article controller</h1>';
        
        $data = $page_name;
        $data2 = $subpage_name;
        $data3 = $subpage_name2;
		  
		// look throught the URL data and attach a template theme to the view.
        load::view('front_view', array( 'data'=>$data, 'data2'=>$data2, 'data3'=>$data3 ));   
        }// END index
    
} // END Class page

?> 