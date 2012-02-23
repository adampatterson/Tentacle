<?
 /*
Name: Default
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

// If SCAFFOLD is not set then display the theme content.
if( !defined( 'SCAFFOLD' ) ):

/**
 * Parts is a simple way to include another file
 *
 * @param String
 * @param Array ( data ( object ) )
 * @param Array ( assets ( comma,separated ) )
 * @author Adam Patterson
 */
load_part('header',array('title'=>$data->title, 'assets'=>'default')); ?>

<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			
			<? load_part( 'sidebar' ); ?>
			
		</div><!--/.well -->
	</div><!--/span3-->
	<div class="span9">
		<div class="hero-unit">
			<h1><?= $data->title; ?></h1>
			<?  // Strip slashses will remove any special 
				// encoding used by the data base.
				//
			 	// This will be replaced by a cuntion that
			 	// will process any Shortcodes and OEMBED data.
			?>
			<?= render_content( $data->content ); ?>
			
		</div><!-- /hero-unit -->
	</div><!--/span9-->
</div><!--/row-->

<? load_part('footer'); ?> 

<? endif; ?>