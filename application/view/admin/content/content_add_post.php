<? load::view('admin/template-header', array('title' => 'Write a new post', 'assets' => array('fancybox') ) );?>
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
					<input type="button" value="Preview" class="btn btn-small btn-primary pull-right" />
				</div>
				<div class="table-content">
					<fieldset>
						<div class="control-group">
								<label for="status" class="control-label">Status</label>
								<div class="controls">
								<select id="status" name="status">
									<option value="draft">Draft</option>
								<!--<option value="review">Pending Review</option>-->
									<option value="published">Published</option>
							    </select>
							</div>
						</div>
				
						<div class="control-group">
								<label for="status" class="control-label">Publish</label>
								<div class="controls">
									
								<select id="publish" name="publish">
									<option value="immediately">Immediately</option>
									<option value="published-on">Publish On</option>
							    </select>
							</div>
						</div>
			
						<div class="control-group published-on">
							<? current_date('month'); ?>
						</div>
						
						<div class="control-group published-on">
		 					<div class="form-inline">
								<input type="text" id="day" name="day" value="<? current_date( 'day' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1"> - <input type="text" id="year" name="year" value="<? current_date( 'year' ) ?>" size="4" maxlength="4" tabindex="4" autocomplete="off" class="span1"> @ <input type="text" id="hour" name="hour" value="<? current_date( 'hour' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1"> : <input type="text" id="minute" name="minute" value="<? current_date( 'minute' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Post type</label>
							<div class="controls">
								<div class="clearfix">
									<div class="input">
										<ul class="unstyled">
											<?  $post_types = get_post_type ( get_option( 'appearance' ) );
												foreach ($post_types as $post_type ): ?>
													<li><label class="radio"><input type="radio" name="post_type" class="post-format" value="<?= $post_type['part_id']; ?>" <? checked( $post_type['part_id'], 'type-post' ); ?>> <span><?= $post_type['part_name']; ?></span></label></li>
											<?	endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>		
								
						<div class="control-group">
							<label for='page_category' class="control-label">Category</label>
							<div class="controls">
								<div class="category-list">
									<ul id="categorychecklist">
									<? foreach ($categories as $category): ?>
										<li id="category-<?= $category->id  ?>"><label class="checkbox"><input type="checkbox" id="in-category-<?= $category->id  ?>" name="post_category[]" value="<?= $category->id  ?>" <? checked( $category->id, '1' ); ?>> <?= $category->name  ?></label></li>
									<? endforeach;?>
									</ul>
								</div>
							</div>
						</div>
						<!--	<dt>
								<a href="#">Select a featured image.</a>
							</dt>
							-->
					
					</fieldset>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<div class="form-actions">
						<button type="submit" class="btn btn-large btn-primary pull-right">
							Save
						</button>
						<!--<a class="red button-secondary" href="">Move to trash</a><a href="#review">Save for Review</a>-->
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
					<ul class="nav nav-tabs" id="content-tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li class=""><a href="#options">Options</a></li>
					</ul>
					
					<div class="tab-content tab-body">
						
						<div id="content" class="active tab-pane">
							<input type="text" name="title" placeholder='Title' class='xlarge' />
							<!--<p>
								Permalink: http://www.sitename/com/path/ <a href="#">Edit</a>
							</p>-->
							<? if(user_editor() == 'wysiwyg'): ?>

								<p class="wysiwyg">
									<textarea id="Content" name="content" rows="15" cols="80" class="tinymce"></textarea>
								</p>
                               
 								<a class="fancybox fancybox.iframe" id="insert-media" href="<?= BASE_URL ?>admin/media_insert" title="Insert Media" data-width="680" data-height="725">[ Insert Media ]</a>
							
							<? else: ?>
								<p>
									<textarea id="code" name="content" cols="40" rows="5" placeholder='Content'></textarea>
								</p>

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
<? /*
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
*/ ?>
							</fieldset>

						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>