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
if( !defined( 'SCAFFOLD' ) ):?>
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
			<?= stripslashes( $data->content ); ?>
		</div><!-- /hero-unit -->
	</div><!--/span9-->
</div><!--/row-->
<? load_part('footer'); ?> 
<? endif; ?>