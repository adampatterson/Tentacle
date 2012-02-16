<?
 /*
Name: Data page template
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

  # display
  #		Admin
  #		Front
  # paged
  # 	sinlge
  #		paged
  # posts_per_page
  #		# Per Page
  #	type   
  #     checkbox
  #     file
  #     image
  #     password
  #     radio
  #     reset
  #     text
  #  name
  #  label_name
  #  checked
  #  options
  #  notes
  #  required
  
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

$scaffold_data = array(
	'display' => 'admin',
	'paged' => 'paged',
	'posts_per_page' => 2,
	'name' => array(				
		'name' => 'Name',
		#'label_name' => 'first_name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	'location' => array(
		'name' => 'Location',
		#'label_name' => 'first_name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
	'Twitter' => array(
		'name' => 'Twitter',
		#'label_name' => 'first_name', // Humanixe the name
		'input' => 'input',
		'type' => 'text',
		'notes' => 'This is a note'
		),
/*	'password' => array(
		'name' => 'Password',
		#'label_name' => 'password', // Humanize the name
		'input' => 'input',
		'type' => 'password',
        'notes' => 'This is another'
		),
	'location' => array(                
        'name' => 'Location',
        #'label_name' => 'location', // Humanize the name
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
		*/
	);
if( !defined( 'SCAFFOLD' ) ):
	$page = load::model ( 'page' );
	$get_page_meta = $page->get_page_meta( $data->id ); ?>
	<? load_part('header',array('title'=>$data->title, 'assets'=>'default')); ?>
<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			<? load_part( 'sidebar' ); ?>
		</div><!--/.well -->
	</div><!--/span3-->
	<div class="span9">
		<div class="hero-unit">
			<h1><?= $data->title; ?></h1>
			<h2><?= $get_page_meta->name ?></h2>
			<h3>From <?= $get_page_meta->location ?></h3>
			<?= stripslashes( $data->content ); ?>
			<p>Follow me <a href="http://www.twitter.com<?= $get_page_meta->twitter ?>">@<?= $get_page_meta->twitter ?></a></p>
		</div><!-- /hero-unit -->
	</div><!--/span9-->
</div><!--/row-->
<? load_part('footer'); ?> 
<? endif; ?>