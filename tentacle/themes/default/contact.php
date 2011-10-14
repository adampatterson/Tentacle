<?
 /*
Name: Contact template
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/
$data = array(
	'post_type' => 'Page',
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

/**
* @todo Make a template header and footer to include, then use the assets() pointing to the themes dundle folder. 
* assets( @array, minify, css)
*/

$resource_assets = array(
    'css' => 'dev_style.css',
    'js' => 'dev_javascript.js',
	'print' => 'dev_print.css:print'
);

load::theme_part('header',array('title'=>'Add a new snippet','assets'=>'application'));
?>
<p>This is loaded from what would be a template file, The forms are what would be viewed on the admin page</p>
<p>Soon the data posted from the forums will show up on this page.</p>
<?
// Load the scaffold, see addressbook page_contact and how the textile class was used
echo $scaffold->constructForm();
echo $scaffold->processThis($data);
echo $scaffold->destructForm();
?>

<?	load::theme_part('footer'); ?>