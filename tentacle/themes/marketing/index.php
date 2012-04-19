<?
 /*
Name: Index Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$data = array(
	'display' => 'admin'
);

if(!defined('SCAFFOLD')):
?>
<? load_part( 'header',array( 'title'=>'Welcome to Tentacle', 'assets'=>'marketing' ) ); ?>

<div class="container">
	<h1><?= $data->title; ?></h1>
	<?  // Strip slashses will remove any special 
		// encoding used by the data base.
		//
	 	// This will be replaced by a cuntion that
	 	// will process any Shortcodes and OEMBED data.
	?>
	<?= render_content( $data->content ); ?>
</div><!-- /container -->

<? load_part( 'footer' ); 
endif;
?>