<? load::view('admin/partials/template-header', array('title' => 'Edit '.$get_post->title, 'assets' => array('application') ) );?>

<div id="wrap">
	<!--
	<script type="text/javascript">
		$(function(){
			$('form#edit_page').sisyphus({
				//onSaveCallback: function() {},
				//onRestoreCallback: function() {},
				//onReleaseDataCallback: function() {}
			});
		}); 
	</script>
	-->
	<form action="<?= BASE_URL ?>action/update_post/<?= $get_post->id ?>" method="post" class="form-stacked" id='edit_post'>
		<input type="hidden" name="page-or-post" value='post' />
		<div class="has-right-sidebar">
			<div class="contet-sidebar has-tabs">
				<div class="table-heading">
					<h3 class="regular">Page Settings</h3>
					<input type="button" value="Preview" class="btn btn-small btn-primary pull-right" />
				</div>
				<div class="table-content">
					<fieldset>
						
						<div class="control-group">
							<label class="control-label" for="status">Status</label>
							<div class="controls">
								<select id="status" name="status">
									<option value="draft" <? selected( $get_post->status, 'draft' ); ?>>Draft</option>
									<option value="published" <? selected( $get_post->status, 'published' ); ?>>Published</option>
								<!--<option value="review">Pending Review</option>-->
							    </select>
							</div>
						</div>

						<div class="control-group">
							<label for="status" class="control-label">Publish on</label>
                            <div class="controls">

                                <input type="hidden" value="<?= $get_post->date ?>" name="date_history">

                            </div>

							<div class="controls">
								<small><?= date('F dS\, Y \@ h:i:s A', $get_post->date ); ?></small> <a href="#" id="edit_publish" class="red button-secondary">edit</a>
							</div>
						</div>
			
						<div class="control-group published-on">
							<? date::get('month', $get_post->date ); ?>
						</div>
						
						<div class="control-group published-on">
		 					<div class="inline-inputs">
								<input type="text" id="day" name="day" value="<? date::get( 'day', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
                                 - <input type="text" id="year" name="year" value="<? date::get( 'year', $get_post->date ) ?>" size="4" maxlength="4" tabindex="4" autocomplete="off" class="span1">
                                 @ <input type="text" id="hour" name="hour" value="<? date::get( 'hour', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
                                 : <input type="text" id="minute" name="minute" value="<? date::get( 'minute', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
							</div>
							<a href="#" id="edit_publish" class="red button-secondary">Cancel</a>
						</div>
							
						<div class="control-group">
							<label class="control-label" >Post Type</label>

							<div class="controls">
								<ul class="unstyled">
									<? $post_types = get_post_type ( get::option( 'appearance' ) );
										foreach ($post_types as $post_type ): ?>
											<li><label><input type="radio" name="post_type" class="post-format" value="<?= $post_type['part_id']; ?>" <? checked( $get_post->template, $post_type['part_id'] ); ?>> <span><?= $post_type['part_name']; ?></span></label></li>
									<? endforeach; ?>
								</ul>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="page_category">Category</label>
							<div class="controls category-list">
								<ul id="categorychecklist">
								<? 
									foreach ($categories as $category): ?>
										<li id="category-<?= $category->id  ?>">
											<label class="selectit">
											<input type="checkbox" id="in-category-<?= $category->id  ?>" name="post_category[]" value="<?= $category->id  ?>" <? checked( $category->id, (array)$category_relations ); ?>> <?= $category->name  ?>
										</label>
									</li>
						        <? ?>
								<? endforeach;?>
								</ul>
							</div>
						</div>

						<!--<dt>
							<a href="#">Select a featured image.</a>
						</dt>-->
					</fieldset>
					<input type="hidden" value="admin/content_update_post/<?= $get_post->id ?>" name="history">
					<div class="form-actions">
						<button type="submit" class="btn btn-large btn-primary">Save</button>
						<a class="red button-secondary" href="<?= BASE_URL ?>action/trash_post/<?= $get_post->id;?>">Move to trash</a><!--<a href="#review">Save for Review</a>-->
					</div>
				</div>
			</div>
			<div id="post-body">
				<div id="post-body-content">

					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Update <small><?= $get_post->title ?></small></h1>
					
					<ul class="nav nav-tabs" id="content-tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li class=""><a href="#options">Options</a></li>
					</ul>
					
					<div class="tab-content tab-body">
						
						<div id="content" class="active tab-pane">
							<? //clean_out($get_post_meta ) ?>
							<input type="text" name="title" placeholder='Title' value='<?= $get_post->title ?>' class='xlarge' required='required' />
							<!--<p>Permalink: http://www.sitename/com/path/ <a href="#">Edit</a></p>-->
							
							<? if(user_editor() == 'wysiwyg'):?>
								
								<p class="wysiwyg">
									<textarea id="Content" name="content" rows="15" cols="80" class="editor"><?= the_content( $get_post->content, true ) ?></textarea>
								</p>

							<? else: ?>
								
								<p>
									<textarea id="code" name="content" cols="40" rows="5" placeholder='Content' class='CodeMirror-scroll'><?= stripslashes($get_post->content) ?></textarea>
								</p>

							<? endif; ?>
							<div class="clear"></div>
						</div>
						
						<div id="options" class="tab-pane">
							<fieldset>
								
								<div class="control-group">
									<label class="control-label" for='bread_crumb'>Breadcrumb title</label>
									<div class="controls">
											<input type="text" placeholder="Edit title" name='bread_crumb' value='<?= $get_post_meta->bread_crumb ?>' />
											<span class="help-block">This title will appear in the breadcrumb trail.</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="meta_keywords">Meta Keywords</label>
									<div class="controls">
										<input type="text" placeholder="Keywords" name='meta_keywords' value='<?= $get_post_meta->meta_keywords ?>' />
										<span class="help-block">Separate each keyword with a comma ( , )</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="meta_description">Meta Description</label>
									<div class="controls">
										<textarea name="meta_description" cols="40" rows="5" placeholder='Enter your comments here...'><?= $get_post_meta->meta_description ?></textarea>
										<span class="help-block">A short summary of the page's content</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="tags">Tags</label>
									<div class="controls">
										<input type="text" class="tags" name="tags" id="tags" value='<?= $tag_relations ?>' />
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
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>