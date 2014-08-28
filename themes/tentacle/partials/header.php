<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="utf-8"> 
<title><?= get::option('blogname').' - '.$title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:title" content="<?= get::option('blogname'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= BASE_URL.URI ?>">
<meta property="og:image" content="<?= THEME ?>/assets/img/tentacle.png">
<meta property="og:site_name" content="<?= get::option('blogname'); ?>">
<meta property="og:description" content="<?= get::option('blogdescription'); ?>">

<? render_meta( );

    if ( isset($post_meta)):
        render_keywords( $post_meta->meta_keywords );
        render_description( $post_meta->meta_description );
    else:
        render_description( );
    endif;

render_shortlink( );

/**
 * @param comma,separated - located in the bundles folder
 * @author Adam Patterson
 */
theme::assets( $assets );

render_header( );
?>
</head>

<body <? body_class(); ?>>

<? /*
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
*/ ?>
	<div class="container">

        <div class="hero-unit">

            <h1><?= get::option('blogname') ?></h1>

            <p><?= get::option('blogdescription') ?></p>

        </div>