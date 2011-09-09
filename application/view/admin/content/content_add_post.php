<? load::view('admin/template-header', array('title' => 'Write a new post', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<form action="<?= BASE_URL ?>action/add_post/" method="post" class="form-stacked">
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
								<label>Post template</label>
							</dt>
							<dd>
								<select name='page_template'>
									<option value='default'>Default</option>
								</select>
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
					<?php if($note = note::get('post_add')):
					?>
					<div class='flash success'>
						<?= $note['content'];?>
					</div>
					<?php endif;?>
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Write a new post</h1>
					<div class="tab-container">
						<ul class="tabs container">
							<li>
								<a href="#first">Content</a>
							</li>
							<li>
								<a href="#second">Option's</a>
							</li>
							<!--<li>
							<a href="#third">Revisions</a>
							</li>
							<li>
							<a href="#fourth">To-Do's</a>
							</li>-->
						</ul>
						<div id="first" class="tab-body">
							<input type="text" name="title" placeholder='Title' class="xlarge"/>
							<p>
								Permalink: http://www.sitename/com/path/ <a href="#">Edit</a>
							</p>
							<p>
								<textarea name="content" cols="40" rows="5" class="markItUp" placeholder='Content'></textarea>
</p>							<!--<p><label>Custom data</label>
							<input type="text" /></p>-->
							<!--<div class="alignleft actions">
							<input type="submit" value="Save" class="button" /><a href="#" class="red">Cancel</a>
							<input type="button" value="Save and Close" class="button" /><input type="button" value="Save and Continure Editing" class="button" /><a href="#" class="red">Cancel</a>
							</div>-->
							<div class="clear"></div>
						</div>
						<div id="second" class="tab-body">
							<fieldset>
								<div class="clearfix">
									<label>Breadcrumb</label>
									<div class="input">
										<input type="text" value="Edit title" />
									</div>
								</div>
								<div class="clearfix">
									<label>Keywords</label>
									<div class="input">
										<input type="text" value="Keywords" />
									</div>
								</div>
								<div class="clearfix">
									<label>Description</label>
									<div class="input">
										<textarea name="comments" cols="40" rows="5">Enter your comments here...</textarea>
									</div>
								</div>
								<div class="clearfix">
									<label>Tags</label>
									<div class="input">
										<input type="text" value="Edit title" />
									</div>
								</div>
								<div class="clearfix">
									<label>Meta Robot Tags</label>
									<div class="input">
										<ul class="inputs-list">
											<li>
												<label>
													<input type="checkbox">
													Noindex: Tell search engines not to index this webpage.</label>
											</li>
											<li>
												<label>
													<input type="checkbox">
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
													<input type="checkbox">
													Allow comments</label>
											</li>
											<li>
												<label>
													<input type="checkbox">
													Allow trackbacks and pingbacks on this page.</label>
											</li>
										</ul>
									</div>
								</div>
							</fieldset>
							<div class="clear"></div>
						</div>
						<div id="third" class="tab-body">
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
							<div class="alignleft actions">
								<input type="button" value="Compare revision" class="button" />
							</div>
							<p class="red">
								Revision code to be added when a suitable diff has been found.
							</p>
							<div class="clear"></div>
						</div>
						<div id="fourth" class="tab-body">
							<h4>To-Do's</h4>
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
							<div class="alignleft actions">
								<input type="button" value="Add Task" class="button" />
							</div>
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