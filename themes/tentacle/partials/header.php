<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= get::option('blogname').' - '.$title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<? 
/**
 * undocumented 
 *
 * @param comma,separated - located in the bundles folder
 * @author Adam Patterson
 */
theme::assets( $assets );

render_header( );
?>
</head>

<body <?= body_class(); ?>>
	<div class="container-fluid">