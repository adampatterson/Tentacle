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

    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>modernizr.min.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.reveal.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.inputtags.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>notifications.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-transition.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-collapse.js"></script>
    <script type="text/javascript" src="<?=ADMIN_JS; ?>bootstrap-tab.js"></script>

	<script type="text/javascript" src="<?=ADMIN_JS; ?>nestedSortable/jquery.ui.nestedSortable.js"></script>
	
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
						nav_menu_sortable ( ); ?>
                    <p>
                        <input type="submit" name="toArray" id="toArray" value="To array" />
                    <pre id="toArrayOutput"></pre>

                    <p>
                        <input type="submit" name="toHierarchy" id="toHierarchy" value="To hierarchy" />
                    <pre id="toHierarchyOutput"></pre>

					<script type="text/javascript">
						$(document).ready(function(){

								$('.sortable').nestedSortable({
									disableNesting: 'no-nest',
									forcePlaceholderSize: true,
									handle: 'div',
									helper:	'clone',
									items: 'li',
									maxLevels: 3,
									opacity: .6,
									placeholder: 'placeholder',
									revert: 250,
									tabSize: 25,
									tolerance: 'pointer',
									toleranceElement: '> div',
                                    update: function () {
                                        //list = $(this).nestedSortable('toHierarchy', {startDepthCount: 0});
                                        list = $(this).nestedSortable('toArray', {startDepthCount: 0});
                                        $.post(
                                            '<?= BASE_URL ?>/ajax/sortable',
                                            { update_sql: 'ok', list: list },
                                            function(data){
                                                $("#result").hide().html(data).fadeIn('slow')
                                            },
                                            "html"
                                        );
                                    }
								});
							});

                            $('#toArray').click(function(e){
                                arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
                                arraied = dump(arraied);
                                (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
                                    $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
                            })


                            $('#toHierarchy').click(function(e){
                                hiered = $('ol.sortable').nestedSortable('toHierarchy');
                                hiered = dump(hiered);
                                (typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
                                    $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
                            })

							function dump(arr,level) {
								var dumped_text = "";
								if(!level) level = 0;

								//The padding given at the beginning of the line.
								var level_padding = "";
								for(var j=0;j<level+1;j++) level_padding += "    ";

								if(typeof(arr) == 'object') { //Array/Hashes/Objects
									for(var item in arr) {
										var value = arr[item];

										if(typeof(value) == 'object') { //If it is an array,
											dumped_text += level_padding + "'" + item + "' ...\n";
											dumped_text += dump(value,level+1);
										} else {
											dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
										}
									}
								} else { //Strings/Chars/Numbers etc.
									dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
								}
								return dumped_text;
							}
					</script>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>