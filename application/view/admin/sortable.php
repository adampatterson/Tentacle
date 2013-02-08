<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Tentacle Admin</title>
    <!--

        _/_/_/_/_/                      _/                          _/
           _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/
          _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/
         _/    _/        _/    _/    _/      _/    _/  _/        _/  _/
        _/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/
        ======================================================================-->


    <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>application.css">
    <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">

    <style type="text/css">
        .cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
        * html .cf { zoom: 1; }
        *:first-child+html .cf { zoom: 1; }

        html { margin: 0; padding: 0; }
        body { font-size: 100%; margin: 0; padding: 1.75em; font-family: 'Helvetica Neue', Arial, sans-serif; }

        h1 { font-size: 1.75em; margin: 0 0 0.6em 0; }

        a { color: #2996cc; }
        a:hover { text-decoration: none; }

        p { line-height: 1.5em; }
        .small { color: #666; font-size: 0.875em; }
        .large { font-size: 1.25em; }

            /**
             * Nestable
             */

        .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

        .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
        .dd-list .dd-list { padding-left: 30px; }
        .dd-collapsed .dd-list { display: none; }

        .dd-item,
        .dd-empty,
        .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

        .dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd-handle:hover { color: #2ea8e5; background: #fff; }

        .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
        .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
        .dd-item > button[data-action="collapse"]:before { content: '-'; }

        .dd-placeholder,
        .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
        .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
        .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        }

            /**
             * Nestable Extras
             */

        .nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

        #nestable-menu { padding: 0; margin: 20px 0; }

        #nestable-output,
        #nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }
        #nestableMenu-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background:         linear-gradient(top, #bbb 0%, #999 100%);
        }
        #nestable2 .dd-handle:hover { background: #bbb; }
        #nestable2 .dd-item > button:before { color: #fff; }

        @media only screen and (min-width: 700px) {

            .dd { float: left; width: 48%; }
            .dd + .dd { margin-left: 2%; }

        }

        .dd-hover > .dd-handle { background: #2ea8e5 !important; }

            /**
             * Nestable Draggable Handles
             */

        .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd3-content:hover { color: #2ea8e5; background: #fff; }

        .dd-dragel > .dd3-item > .dd3-content { margin: 0; }

        .dd3-item > button { margin-left: 30px; }

        .dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:         linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
        .dd3-handle:hover { background: #ddd; }
    </style>

    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.nestable.js"></script>

    <meta name="viewport"/>
</head>
<body id="admin-window">
<style type="text/css">
    .ui-nestedSortable-error {
        background:#fbe3e4;
        color:#8a1f11;
    }

    ol {
        margin: 0;
        padding: 0;
        padding-left: 30px;
    }

    ol.sortable, ol.sortable ol {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }

    ol.sortable {
        margin: 4em 0;
    }

    .sortable li {
        margin: 7px 0 0 0;
        padding: 0;
    }

    .sortable li div  {
        border: 1px solid black;
        padding: 3px;
        margin: 0;
        cursor: move;
    }
</style>
<div id="wrap">
    <div class="full-content">
        <div id="post-body">
            <div class="one-full">
                <div class="title pad-right">
                    <h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Threaded</h1>
                    <hr />
                    <?
                    function nav_generate_sortable ( $tree )
                    {
                        $depth = -1;
                        $flag = false;
                        foreach ($tree as $row) {
                            while ($row['level'] > $depth) {
                                echo '<ol class="sortable"><li id="list_'.$row['id'].'">';
                                $flag = false;
                                $depth++;
                            }
                            while ($row['level'] < $depth) {
                                echo "</li></ol>";
                                $depth--;
                            }
                            if ($flag) {
                                echo '</li><li id="list_'.$row['id'].'">';
                                $flag = false;
                            }
                            echo '<div>'.$row['title'].' <strong>'.$row['id'].'</strong></div>';
                            $flag = true;
                        }
                        echo '</li></ol>';
                    }

                    /**
                     * Process the page object.
                     *
                     * @author Adam Patterson
                     */

                    function nav_menu_sortable ( )
                    {
                        define ( 'FRONT'		,'true' );

                        $page = load::model( 'page' );
                        $pages = $page->get( );
                        // Current URI to be used with .current page
                        $uri = URI;


                        $page_tree = $page->get_page_tree( $pages );

                        $page_object = $page->get_page_children( 0, $pages );

                        nav_generate_sortable ( (array)$page_object );

                    }

                    #nav_menu_sortable ( );

                    define ( 'FRONT'		,'true' );
                    /* Function menu_showNested
                    * @desc Create inifinity loop for nested list from database
                    * @return echo string
                    */
                    function menu_showNested( $parentID ) {

                        $page = load::model( 'page' );
                        $pages = $page->get_by_parent_id( $parentID );

                        if ($pages > 0) {
                            echo "\n";
                            echo "<ol class='dd-list'>\n";
                            foreach($pages as $page ) {
                                echo "\n";

                                echo "<li class='dd-item' data-id='{$page->id}'>\n";
                                echo "<div class='dd-handle'>{$page->id}: {$page->title}</div>";

                                // Run this function again (it would stop running when the mysql_num_result is 0
                                menu_showNested($page->id);

                                echo "</li>\n";
                            }
                            echo "</ol>\n";
                        }
                    }


                    ## Show the top parent elements from DB
                    ######################################

                    $page = load::model( 'page' );
                    $pages = $page->get_by_parent_id( 0 );

                    echo "<div class='cf nestable-lists'>\n";
                    echo "<div class='dd' id='nestableMenu'>\n\n";
                    echo "<ol class='dd-list'>\n";

                    foreach($pages as $page ){
                        echo "\n";

                        echo "<li class='dd-item' data-id='{$page->id}'>";
                        echo "<div class='dd-handle'>{$page->id}: {$page->title}</div>";


                        menu_showNested($page->id);

                        echo "</li>\n";
                    }

                    echo "</ol>\n\n";
                    echo "</div>\n";
                    echo "</div>\n\n";

                    ?>

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

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>