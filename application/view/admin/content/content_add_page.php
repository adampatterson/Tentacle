<? load::view('admin/template-header', array('title' => 'Write a new page', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<!--
	<script type="text/javascript">
		$(function(){
			$('form#add_page').sisyphus({
				//onSaveCallback: function() {},
				//onRestoreCallback: function() {},
				//onReleaseDataCallback: function() {}
			});
		}); 
	</script>
	-->
	<form action="<?= BASE_URL ?>action/add_page/" method="post" class="form-stacked" id='add_page'>
		<input type="hidden" name="page-or-post" value='page' />
		<div class="has-right-sidebar">
			<div class="contet-sidebar has-tabs">
				<div class="table-heading">
					<h3 class="regular">Page Settings</h3>
					<input type="button" value="Preview" class="btn small primary alignright" name='preview' />
				</div>
				<div class="table-content">
					<fieldset>
						<dl>
							<dt>
								<label for="status">Status</label>
							</dt>
							<dd>
								<select name="status" id="status" size="1">
									<option value="draft">Draft</option>
									<option value="published">Published</option>
								</select>
							</dd>
							<dt>
								<label for="parent_page">Parent page</label>
							</dt>
							<dd>
								<select id="parent_page" name="parent_page">
									<option value="0">None</option>
									<? foreach ($pages as $page_array): 
										$page = (object)$page_array; ?>
										<option value="<?= $page->id?>" <? selected( $page->id, $parent_page_id ); ?>><?= offset($page->level, 'list').$page->title;?></option>
									<? endforeach;?>
								</select>
							</dd>
							<dt>
								<label for="page_template">Page template</label>
							</dt>
							<dd>
								<select id="page_template" name="page_template" onchange="location = this.options[this.selectedIndex].value;">
									<option value="<?= BASE_URL ?>action/render_admin/add_page/default" selected='selected'>Default</option>
									<? $templates = get_templates( get_option( 'appearance' ) ); 
									foreach ( $templates as $template ): ?>
										<option value="<?= BASE_URL ?>action/render_admin/add_page/<?= $template->template_id ?>" <? selected( session::get( 'template' ), $template->template_id ); ?>><?= $template->template_name ?></option>
									<? endforeach; ?>
								</select>
							</dd>
							<!--<dt>
								<a href="#">Select a featured image.</a>
							</dt>-->
						</dl>
					</fieldset>
					<input type="hidden" value="admin/content_add_page" name="history">
					<div class="textleft actions">
						<button type="submit" class="btn large primary" name='save'>Save</button><!--<a href="#review">Save for Review</a>-->
					</div>
				</div>
			</div>
			<div id="post-body">
				<div id="post-body-content">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Write a new page</h1>
					<ul data-tabs="tabs" class="tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li><a href="#options">Options</a></li>
						<!--<li class=""><a href="#revisions">Revisions</a></li>
						<li class=""><a href="#tasks">Task's</a></li>-->
					</ul>
					<div class="tab-content tab-body" id="my-tab-content">
						<div id="content" class="active tab-pane">
							<input type="text" name="title" placeholder='Title' class='xlarge' required='required' />
							<!--<p>
								Permalink: http://www.sitename/com/path/ <a href="#">Edit</a>
							</p>-->
							<? if (user_editor() == 'wysiwyg'): ?>
								<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/ckeditor.js"></script>
								<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/config.js"></script>
								<script type="text/javascript" src="<?=TENTACLE_JS; ?>ckeditor/ckeditor.utils.js"></script>
								<p>
									<textarea name="content" id="cke" cols="40" rows="5" class="jquery_ckeditor" placeholder='Content'></textarea>
								</p>
							<? else: ?>
								<link rel="stylesheet" href="<?=TENTACLE_JS; ?>CodeMirror-2.2/lib/codemirror.css">
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/lib/codemirror.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/xml/xml.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/css/css.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/javascript/javascript.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/clike/clike.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/php/php.js"></script>
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.2/mode/htmlmixed/htmlmixed.js"></script>
								<style type="text/css">
								      .CodeMirror-scroll {
										height: auto;
										min-height: 450px;
										max-height: 900px;
										overflow-y: hidden;
										overflow-x: auto;
										width: 100%;
									}

									.CodeMirror {
										border-top: 1px solid black; 
										border-bottom: 1px solid black;
									}

									.activeline {
										background: #f0fcff !important;
									}
									.cm-tab:after {
									        content: "\21e5";
									        display: -moz-inline-block;
									        display: -webkit-inline-block;
									        display: inline-block;
									        width: 0px;
									        position: relative;
									        overflow: visible;
									        left: -1.4em;
									        color: #aaa;
									      }
							    </style>
							
								<p><textarea id="code" name="content" cols="40" rows="5" placeholder='Content'></textarea></p>

								<script>
								      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
										lineNumbers: true,
										tabSize: 4,
										indentUnit: 4,
										indentWithTabs: true,
										theme: "default",
										mode: "application/x-httpd-php",
										onCursorActivity: function() {
										    editor.setLineClass(hlLine, null);
											hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
										},
										onKeyEvent: function(cm, e) {
											// Hook into ctrl-space
											if (e.keyCode == 32 && (e.ctrlKey || e.metaKey) && !e.altKey) {
												e.stop();
												return CodeMirror.simpleHint(cm, CodeMirror.javascriptHint);
											}
										}
									});
									var hlLine = editor.setLineClass(0, "activeline");
								    </script>
							<? endif; ?>
							<div class="clear"></div>
							<div id="scaffold">
								<?
								define( 'SCAFFOLD' , 'TRUE' );
								
								if ( session::get( 'template' ) != 'index' && session::get( 'template' ) != ''   ) {
									
									@include(THEMES_DIR.'/default/'.session::get('template').'.php');

									$scaffold = new Scaffold ();
									$scaffold->processThis( $data );
								}
								?>
								<div class="clear"></div>
							</div>
						</div>
						<div id="options" class="tab-pane">
							<fieldset>
								<div class="clearfix">
									<label>Breadcrumb title</label>
									<div class="input">
										<input type="text" placeholder="Edit title" name='bread_crumb' />
										<span class="help-block">This title will appear in the breadcrumb trail.</span>
									</div>
								</div>
								<div class="clearfix">
									<label>Meta Keywords</label>
									<div class="input">
										<input type="text" placeholder="Keywords" name='meta_keywords' />
										<span class="help-block">Separate each keyword with a comma ( , )</span>
									</div>
								</div>
								<div class="clearfix">
									<label>Meta Description</label>
									<div class="input">
										<textarea name="meta_description" cols="40" rows="5" placeholder='Enter your comments here...'></textarea>
										<span class="help-block">A short summary of the page's content</span>
									</div>
								</div>
								<div class="clearfix">
									<label>Tags</label>
									<div class="input">
										<input type="text" class="tags" name="tags" id="tags" />
										<span class="help-block">Separate each keyword with a comma ( , )</span>
									</div>
								</div>
								<div class="clearfix">
									<label>Meta Robot Tags</label>
									<div class="input">
										<ul class="inputs-list">
											<li>
												<label>
													<input type="checkbox" name='meta_robot[]' value='no_index'>
													Noindex: Tell search engines not to index this webpage.</label>
											</li>
											<li>
												<label>
													<input type="checkbox" name='meta_robot[]' value='no_follow'>
													Nofollow: Tell search engines not to spider this webpage.</label>
											</li>
										</ul>
									</div>
								</div>
								<div class="clearfix">
									<label>Discussion</label>
									<div class="input">
										<ul class="inputs-list">
											<li>
												<label>
													<input type="checkbox" name='discussion[]' value='discussion'>
													Allow comments</label>
											</li>
											<li>
												<label>
													<input type="checkbox" name='discussion[]' value='trackback'>
													Allow trackbacks and pingbacks on this page.</label>
											</li>
										</ul>
									</div>
								</div>
							</fieldset>
							<div class="clear"></div>
						</div>
						<!--<div id="revisions" class="">
							<h4>Feb 7, 2011</h4>
							<div class="small-row">
								<input type="radio" checked="checked" />
								<input type="radio" />
								#8 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row">
								<input type="radio" />
								<input type="radio" />
								#9 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row">
								<input type="radio" />
								<input type="radio" checked="checked" />
								#10 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row last">
								<input type="radio" />
								<input type="radio" />
								#11 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<h4>Feb 6, 2011</h4>
							<div class="small-row">
								<input type="radio" checked="checked" />
								<input type="radio" />
								#8 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row">
								<input type="radio" />
								<input type="radio" />
								#9 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row">
								<input type="radio" />
								<input type="radio" checked="checked" />
								#10 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="small-row last">
								<input type="radio" />
								<input type="radio" />
								#11 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_roll-back.png" width="16" height="16" alt="Revert" />
								</div>
							</div>
							<div class="actions">
								<input type="btn medium secondry" value="Compare revision" class="button" />
							</div>
							<p class="red">
								Revision code to be added when a suitable diff has been found.
							</p>
							<div class="clear"></div>
						</div>
						<div id="tasks" class="">
							<h4>Task's</h4>
							<div class="small-row"><img src="<?=ADMIN_URL;?>images/icons/16_star.png" width="16" height="16" alt="Star" />
								<input type="checkbox" />
								#8 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
								</div>
							</div>
							<div class="small-row"><img src="<?=ADMIN_URL;?>images/icons/16_star.png" width="16" height="16" alt="Star" />
								<input type="checkbox" />
								#9 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
								</div>
							</div>
							<div class="small-row"><img src="<?=ADMIN_URL;?>images/icons/16_star.png" width="16" height="16" alt="Star" />
								<input type="checkbox" />
								#10 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
								</div>
							</div>
							<div class="small-row last"><img src="<?=ADMIN_URL;?>images/icons/16_star.png" width="16" height="16" alt="Star" />
								<input type="checkbox" />
								#11 Created 14:22 by Adam Patterson
								<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
								</div>
							</div>
							<h4>Completed</h4>
							<div class="completed grey">
								<div class="small-row">
									<input type="checkbox" checked="checked" />
									#8 Created 14:22 by Adam Patterson
									<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
									</div>
								</div>
								<div class="small-row ">
									<input type="checkbox" checked="checked" />
									#9 Created 14:22 by Adam Patterson
									<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
									</div>
								</div>
								<div class="small-row ">
									<input type="checkbox" checked="checked" />
									#10 Created 14:22 by Adam Patterson
									<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
									</div>
								</div>
								<div class="small-row last ">
									<input type="checkbox" checked="checked" />
									#11 Created 14:22 by Adam Patterson
									<div class="alignright"><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" />
									</div>
								</div>
							</div>
							<p class="center">
								<a href="#"><strong>Show archived tasks</strong></a>
							</p>
							<div class="actions">
								<button type="text" class="btn medium secondary">
									Add Task
								</button>
							</div>
							<div class="clear"></div>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?> 