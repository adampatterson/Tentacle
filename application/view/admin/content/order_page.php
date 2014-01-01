<? load::view('admin/partials/header', array('title' => 'Add a new snippet', 'assets' => array('sortable')));?>

    <div id="wrap">
        <div class="has-right-sidebar">
            <div class="contet-sidebar">
                &nbsp;
            </div>
            <div id="post-body">
                <div id="post-body-content">

                    <h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Order pages</h1>

                    <?
                    echo "<div class='cf nestable-lists'>
                        <div class='dd' id='nestableMenu'>
                            <ol class='dd-list'>";

                                foreach($pages as $page ):
                                    echo "<li class='dd-item' data-id='{$page->id}'>";
                                    echo "<div class='dd-handle'>{$page->id}: {$page->title}</div>";

                                    menu_show_nested($page->id);

                                    echo "</li>";
                                endforeach;

                      echo "</ol>
                        </div>
                    </div>"; ?>

                </div><!-- .post-body-content -->
            </div><!-- #post-body -->
        </div><!-- .full-content -->
    </div>
    <!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>