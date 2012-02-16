<?
 /*
Name: Contact
*/

$scaffold_data = array(
	'display' => 'front',
	'paged' => 'paged',
	'posts_per_page' => 2,
	'first_name' => array(				
		'name' => 'First Name',
		'label_name' => 'First Name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	'last_name' => array(				
		'name' => 'Last Name',
		'label_name' => 'first_name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	'subject' => array(				
		'name' => 'Subject',
		'label_name' => 'password', // Humanize the name
		'input' => 'input',
		'type' => 'text',
        'notes' => 'This is another'
		),
	'message' => array(				
		'name' => 'Message',
		#'label_name' => 'message', // Humanixe the name
		'input' => 'multiline',
		'type' => 'text',
        'notes' => 'Yes, more notes.'
		),
	'button' => array(				
		'button_name' => 'Button Name',
		'type' => 'button',
		'input' => 'input'
		),
	);
	
if(!defined('SCAFFOLD')):

load::theme_part('header',array('title'=>'Add a new snippet','assets'=>'default'));

?>
<p>This is loaded from what would be a template file, The forms are what would be viewed on the admin page</p>
<p>Soon the data posted from the forums will show up on this page.</p>

<? load::theme_part('footer'); 

endif;
?>