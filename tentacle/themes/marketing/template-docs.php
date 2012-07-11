<?
 /*
Name: Docs
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$scaffold_data = array();

// If SCAFFOLD is not set then display the theme content.
if( !defined( 'SCAFFOLD' ) ):?>
<? load_part('partials/header',array('title'=>$post->title, 'assets'=>'docs')); ?>

<div class="container">
	<div class="row bump" id="why">
	
			<?= render_content( $post->content ); ?>
			
	</div><!--/span12-->
</div><!--/row-->

<? load_part('partials/footer'); ?> 

<? endif; ?>