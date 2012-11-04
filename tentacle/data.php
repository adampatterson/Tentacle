<?
#type   
#   checkbox
#   file
#   image
#   password
#   radio
#   reset
#   text
#name
#label_name
#checked
#options
#notes
#required

#<input />   Defines an input control
#<textarea>  Defines a multi-line text input control
#<select>    Defines a select list (drop-down list)
#<optgroup>  Defines a group of related options in a select list

//@todo have help text (can be hidden in the admin area)

$data = array(
	"name" => array(				
		'name' => 'First Name',
		'label_name' => 'first_name',
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	"password" => array(				
		'name' => 'Password',
		'label_name' => 'password',
		'input' => 'input',
		'type' => 'password',
        'notes' => 'This is another'
		),
	"location" => array(                
        'name' => 'Location',
        'label_name' => 'location',
        'input' => 'option',
        'notes' => 'Option notes.',
        'options' => array ('Canada', 'USA', 'Mexico', 'UK')
        ),
	"message" => array(				
		'name' => 'Message',
		'label_name' => 'message',
		'input' => 'multiline',
		'type' => 'text',
        'notes' => 'Yes, more notes.'
		),

	);
?>
<p>Admin View</p>
<?
// Load the scaffold, see addressbook page_contact and how the textile class was used
echo $scaffold->constructForm();
echo $scaffold->processThis($data);
echo $scaffold->createButton('send');
echo $scaffold->destructForm();
?>	
<hr />
<a href="<?=url::page("front/index/"); ?>">Front</a>