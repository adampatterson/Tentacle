<?php

/**
* 
* @author Adam Patterson
* @param  option key
* @return True / False
*/

function current_user_can () {
	
}


function user_name ( ) {
	$id = user::id( );

	$user = load::model ( 'user' );

	$user_meta = $user->get_meta( $id );

	return $user_meta->first_name.' '. $user_meta->last_name;
}


function user_editor ( ) {
	$id = user::id( );

	$user = load::model ( 'user' );

	$user_meta = $user->get_meta( $id );

	return $user_meta->editor;
}