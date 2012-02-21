<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= get_option('blogname').' - '.$title ?></title>
<meta name="description" content="">
<meta name="author" content="">
<? 
/**
 * undocumented 
 *
 * @param comma,separated - located in the bundles folder
 * @author Adam Patterson
 */
assets::render( $assets ); ?>
</head>

<body <?= body_class(); ?>>
	<div class="container-fluid">