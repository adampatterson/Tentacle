<?php

class main_controller {
	public function index() {

        load::library('file');
        load::helper('class_scaffold_array'); 
        
        include(THEMES.'default/data.php');
            
        $scaffold = new scaffold();
        $scaffold->processThis($data);
        
        load::view('page_contact', array( 'contact'=>$contact[0], 'textile'=>$textile,'contacts_table'=>$contacts_table, 'profile_images'=>$profile_images, 'comments'=>$comments, 'group'=>$group[0] )); 
        
        }// END index
     
     public function view (){
         
        load::view('page_contact', array( 'contact'=>$contact[0], 'textile'=>$textile,'contacts_table'=>$contacts_table, 'profile_images'=>$profile_images, 'comments'=>$comments, 'group'=>$group[0] )); 
        
        } // END view
     
} // END Class main_controller