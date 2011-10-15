<?
 /*
Name: Default - Data 	page template
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$resource_assets = array(
    'css' => 'dev_style.css',
    'js' => 'dev_javascript.js',
	'print' => 'dev_print.css:print'
);

#	type   
#   checkbox
#   file
#   image
#   password
#   radio
#   reset
#   text
#	name
#	label_name
#	checked
#	options
#	notes
#	required

	# Other options
# 
#	Posty Type: Page / Post
#	Paged?
#	Posts per page

#	<input />   Defines an input control
#	<textarea>  Defines a multi-line text input control
#	<select>    Defines a select list (drop-down list)
#	<radio/check>  Defines a group of related Radio buttons / Check Boxes

//@todo have help text (can be hidden in the admin area)

$data = array(
	'post_type' => 'Post Type',
	'paged' => 'Paged',
	'posts_per_page' => 2,
	'name' => array(				
		'name' => 'First Name',
		#'label_name' => 'first_name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	'password' => array(				
		'name' => 'Password',
		#'label_name' => 'password', // Humanize the name
		'input' => 'input',
		'type' => 'password',
        'notes' => 'This is another'
		),
	'location' => array(                
        'name' => 'Location',
        #'label_name' => 'location', // Humanixe the name
        'input' => 'option',
        'notes' => 'Option notes.',
        'options' => array ('Canada', 'USA', 'Mexico', 'UK', 'Japan')
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
?>
<p>This is loaded from what would be a template file, The forms are what would be viewed on the admin page</p>
<p>Soon the data posted from the forums will show up on this page.</p>
<?
// Load the scaffold, see addressbook page_contact and how the textile class was used

endif;
?>