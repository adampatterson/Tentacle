<?php 
/**
* File: Notification
*/

/**
* Function: notification
*	Displays a notification on the admin side
*
* Returns:
*	HTML
*/
function notification( ){
	if ($notes = note::all()):
		foreach ($notes as $note): ?>
		
			<script>$(function(){
					$.sticky(
						'<p><?= $note['content'];?></p>','icon <?= $note['type']; ?>',{p:'ptr'}
					)})
			</script>
		<?
		endforeach;
	endif;
}
