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
	'paged' => 'Paged',
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
	$get_page_meta = $page->get_page_meta( $data->id );
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= $data->title; ?></title>
<meta name="description" content="">
<meta name="author" content="">
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script type="text/javascript" src="<?=TENTACLE_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=TENTACLE_JS; ?>bootstrap-dropdown.js"></script>
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>admin.css">
	<link href="<?= PATH ?>/css/bootstrap.css" rel="stylesheet">
	<style type="text/css" media="screen">
		body {
		  padding-top: 60px;
		  padding-bottom: 40px;
		}
	</style>
  </head>

  <body>
	
	<div class="container-fluid">
		<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav">
				<? nav_menu(); ?>
				<li><a href="<?= BASE_URL?>blog/">Blog</a></li>
		  </div><!--/.well -->
		</div><!--/span-->
		<div class="span9">
		  <div class="hero-unit">
			<h1><?= $data->title; ?></h1>
			<h2><?= $get_page_meta->name ?></h2>
			<h3>From <?= $get_page_meta->location ?></h3>
			<?= stripslashes( $data->content ); ?>
			<p>Follow me <a href="http://www.twitter.com<?= $get_page_meta->twitter ?>">@<?= $get_page_meta->twitter ?></a></p>
		  </div>
		</div><!--/span-->
	  </div><!--/row-->
	<footer>
		<p><a href="http://tentaclecms.com"><img src="<?= PATH ?>/images/tentacle_logo_footer.png" alt="Tentacle" /></a></p>
	</footer>

	</div><!-- /container -->	
	</body>
</html>
<? endif; ?>