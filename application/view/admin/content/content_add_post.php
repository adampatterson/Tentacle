<? load::view('admin/template-header', array('title' => 'Write a new post', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<!--
	<script type="text/javascript">
		$(function(){
			$('#add_post').sisyphus({
				//onSaveCallback: function() {},
				//onRestoreCallback: function() {},
				//onReleaseDataCallback: function() {}
			});
		}); 
	</script>
	-->
	<form action="<?= BASE_URL ?>action/add_post/" method="post" class="form-stacked" id='add_post'>
		<div class="has-right-sidebar">
			<div class="contet-sidebar has-tabs">
				<div class="table-heading">
					<h3 class="regular">Post Settings</h3>
					<input type="button" value="Preview" class="btn small primary alignright" />
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
									<option value="live">Live</option>
								</select>
							</dd>
							<dt>
								<label>Post type</label>
							</dt>
							<dd>
								<fieldset>
									<div class="clearfix">
										<div class="input">
											<ul class="inputs-list">
												<?  $post_types = get_post_type ( get_option( 'appearance' ) );
												
													foreach ($post_types as $post_type ): ?>
														<li><label><input type="radio" name="post_type" class="post-format" value="0"> <span><?= $post_type['part_name']; ?></span></label></li>
												<?	endforeach; ?>
											</ul>
										</div>
									</div>
								</fieldset>
							</dd>
							<dt>
								<label for='page_category'>Category</label>
							</dt>
							<dd>
								<div class="category-list">
									<ul id="categorychecklist">
									<? foreach ($categories as $category): ?>
										<li id="category-<?= $category->id  ?>"><label class="selectit"><input type="checkbox" id="in-category-<?= $category->id  ?>" name="post_category[]" value="<?= $category->id  ?>"> <?= $category->name  ?></label></li>
									<? endforeach;?>
									</ul>
								</div>
							</dd>
							<dt>
								<a href="#">Select a featured image.</a>
							</dt>
						</dl>
					</fieldset>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<div class="textleft actions">
						<button type="submit" class="btn large primary">
							Save
						</button>
						<a class="red button-secondary" href="#">Move to trash</a><!--<a href="#review">Save for Review</a>-->
					</div>
				</div>
			</div>
			<div id="post-body">
				<div id="post-body-content">
					<?php if($note = note::get('post_add')): ?>
						<script type="text/javascript">
							$(document).ready(function() {
								jQuery.noticeAdd({
									text : '<?= $note['content'];?>',
									stay : false,
									type : '<?= $note['type']; ?>'
								});
							});
						</script>
					<?php endif;?>
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Write a new post</h1>
					<ul data-tabs="tabs" class="tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li class=""><a href="#options">Options</a></li>
					</ul>
					<div class="tab-content tab-body" id="my-tab-content">
						<div id="content" class="active tab-pane">
							<input type="text" name="title" placeholder='Title' class='xlarge' />
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
								<link rel="stylesheet" href="<?=TENTACLE_JS; ?>CodeMirror-2.16/codemirror.css">
								<script src="<?=TENTACLE_JS; ?>CodeMirror-2.16/codemirror-compressed.js"></script>
								<link rel="stylesheet" href="<?=TENTACLE_JS; ?>CodeMirror-2.16/theme/default.css">
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
							    </style>
							
								<p><textarea id="code" name="content" cols="40" rows="5" placeholder='Content'></textarea></p>

								<script>
								      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
								        lineNumbers: true,
								        theme: "default",
										mode: "text/html",
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
										<textarea name="meta_description" cols="40" rows="5">Enter your comments here...</textarea>
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
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?> 