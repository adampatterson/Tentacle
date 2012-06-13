<?php
/**
* File: User
*/


/**
* Function: current_user_can
* 
*/
function current_user_can () {
	
}


/**
* Function: user_name
* Returns a joined first and last name
*
* Returns:
*     	string - first_name last_name
*/
function user_name ( ) {
	$id = user::id( );

	$user = load::model( 'user' );

	$user_meta = $user->get_meta( $id );

	return $user_meta->first_name.' '. $user_meta->last_name;
}


/**
* Function: user_email
* Recursively converts a SimpleXML object (and children) to an array.
*
* Returns:
*     	string - users email address
*/
function user_email ( ) {
	$id = user::id( );

	$user = load::model( 'user' );

	$user_meta = $user->get( $id );

	return $user_meta->email;
}


/**
* Function: user_editor
* Returns what editor the user has chosen.
*
* Returns:
*     	string
*/
function user_editor ( ) {
	$id = user::id( );

	$user = load::model( 'user' );

	$user_meta = $user->get_meta( $id );

	return $user_meta->editor;
}