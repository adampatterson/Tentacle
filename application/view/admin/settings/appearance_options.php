<? load::view('admin/partials/header', array('title' => 'Media settings', 'assets' => array('application')));?>

<div id="wrap">
    <h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Theme Options</h1>
    <form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
        <input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
        <div class="row">
            <div class="col-md-6">

                <div id="scaffold" class="blocks">

                    <?
                        $template = THEMES_DIR.'/'.ACTIVE_THEME.'/options.php';
                        if( file_exists( $template )): $raw_blocks = get::yaml( $template );
                            if ( $raw_blocks != null ):
                                $blocks = new blocks();

                                $blocks->populate( $raw_blocks );
                                $blocks->render();
                            endif;

                    endif; ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="actions">
                <button class="btn btn-primary" type="submit">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
