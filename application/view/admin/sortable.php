<!DOCTYPE html>
<html> 
<head>
<meta charset="utf-8"> 
<meta name="description" content="">
<meta name="author" content="">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Tentacle Admin - <?= $title?></title>
<!--

	_/_/_/_/_/                      _/                          _/           
	   _/      _/_/    _/_/_/    _/_/_/_/    _/_/_/    _/_/_/  _/    _/_/    
	  _/    _/_/_/_/  _/    _/    _/      _/    _/  _/        _/  _/_/_/_/   
	 _/    _/        _/    _/    _/      _/    _/  _/        _/  _/          
	_/      _/_/_/  _/    _/      _/_/    _/_/_/    _/_/_/  _/    _/_/_/     
	======================================================================-->                                                                 

	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>bootstrap-1.4.0.min.css">
	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>general.css">
	<link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>admin.css">
	
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_JS; ?>nestedSortable-1.3.4/jquery.ui.nestedSortable.js"></script>
	
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
						    echo '<div>'.$row['title'].'</div>';
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
					
						nav_menu_sortable ( );
					?>
<!--					<ol class="sortable">
						<li id="list_1"><div>Item 1</div>
						<li id="list_2"><div>Item 2</div>
							<ol>
								<li id="list_3"><div>Sub Item 2.1</div>
								<li id="list_4"><div>Sub Item 2.2</div>
								<li id="list_5"><div>Sub Item 2.3</div>
								<li id="list_6"><div>Sub Item 2.4</div>
							</ol>
						<li id="list_7" class="no-nest"><div>Item 3 (no-nesting)</div>
						<li id="list_8" class="no-nest"><div>Item 4 (no-nesting)</div>
						<li id="list_9"><div>Item 5</div>
						<li id="list_10"><div>Item 6</div>
							<ol>
								<li id="list_11"><div>Sub Item 6.1</div>
								<li id="list_12" class="no-nest"><div>Sub Item 6.2 (no-nesting)</div>
								<li id="list_13"><div>Sub Item 6.3</div>
								<li id="list_14"><div>Sub Item 6.4</div>
							</ol>
						<li id="list_15"><div>Item 7</div>
						<li id="list_16"><div>Item 8</div>
					</ol> -->
					<p>
						</br></br>
						<input type="submit" name="toHierarchy" id="toHierarchy" value="To hierarchy" />
					<pre id="toHierarchyOutput"></pre>
					</p>
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
									toleranceElement: '> div'
								});								
							});
							
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
				</body>
				</html>