<? load::view('admin/partials/template-header', array('title' => 'Add a new snippet', 'assets' => array('sortable')));?>

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

                                foreach($pages as $page ){
                                    echo "<li class='dd-item' data-id='{$page->id}'>";
                                    echo "<div class='dd-handle'>{$page->id}: {$page->title}</div>";

                                    menu_show_nested($page->id);

                                    echo "</li>";
                                }

                      echo "</ol>
                        </div>
                    </div>"; ?>

                    <script>

                        $(document).ready(function()
                        {
                            $update_output = function(e)
                            {
                                var list   = e.length ? e : $(e.target),
                                    output = list.data('output');
                                if (window.JSON) {

                                    $data = list.nestable('serialize')

                                    $.post('<?= BASE_URL ?>/ajax/sortable',
                                        { data: $data },
                                        function(result){
                                            console.log(result);
                                        }
                                    );
                                } else {
                                    output.val('JSON browser support required for this demo.');
                                }
                            };

                            // activate Nestable for list menu
                            $('#nestableMenu').nestable({
                                group: 1
                            })
                                .on( 'change', $update_output) ;


                            $( '#nestable-menu' ).on( 'click', function( e )
                            {
                                $target = $( e.$target ),
                                    $action = $target.data( 'action' );
                                if ( $action === 'expand-all' ) {
                                    $('.dd').nestable('expandAll');
                                }
                                if ( $action === 'collapse-all' ) {
                                    $('.dd').nestable('collapseAll');
                                }
                            });

                            $('#nestable3').nestable();

                        });

                    </script>


                </div><!-- .post-body-content -->
            </div><!-- #post-body -->
        </div><!-- .full-content -->
    </div>
    <!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>