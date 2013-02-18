<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= get::option('blogname').' - '.$title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Tentacle CMS - Default theme">
<meta name="author" content="Adam Patterson">

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

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container hidden-phone hidden-tablet">
            <ul class="nav">
                <li>
                    <a href="<?= BASE_URL ?>" class="brand" ><?= get::option('blogname') ?></a>
                </li>
            </ul>
            <ul class="nav pull-right">
                <li>
<!--                    <a href="#" target="_blank" >@TentacleCMS</a>-->
                </li>
            </ul>
        </div>
    </div>
</div>

	<div class="container">