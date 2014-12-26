<? load::view('admin/partials/header', array('title' => 'Edit '.$get_post->title, 'assets' => array('application', 'filedrop', user_editor()) ) );?>

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
	<form action="<?= BASE_URL ?>action/update_post/<?= $get_post->id ?>" method="post" role="form" id='edit_post'>
		<input type="hidden" name="page-or-post" value='post' />
		<div class="has-right-sidebar">
			<div class="contet-sidebar has-tabs">
				<div class="table-heading">
					<h3 class="regular">Post Settings</h3>
					<!--<input type="button" value="Preview" class="btn btn-small btn-primary pull-right" />-->
				</div>
				<div class="table-content">
					<fieldset>

						<div class="form-group">
							<label for="status">Status</label>
              <select id="status" name="status" class="form-control">
                  <option value="draft" <? selected( $get_post->status, 'draft' ); ?>>Draft</option>
                  <option value="published" <? selected( $get_post->status, 'published' ); ?>>Published</option>
              <!--<option value="review">Pending Review</option>-->
              </select>
						</div>

						<div class="form-group">
							<label for="status">Publish on</label>
              <input type="hidden" value="<?= $get_post->date ?>" name="date_history">
              <small><?= date('F dS\, Y \@ h:i:s A', $get_post->date ); ?></small> <a href="#" id="edit_publish" class="red button-secondary">edit</a>
						</div>

						<div class="form-group published-on">
							<? date::get('month', $get_post->date ); ?>
						</div>

						<div class="form-group published-on">
		 					<div class="inline-inputs">
								<input type="text" id="day" name="day" value="<? date::get( 'day', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
                                 - <input type="text" id="year" name="year" value="<? date::get( 'year', $get_post->date ) ?>" size="4" maxlength="4" tabindex="4" autocomplete="off" class="span1">
                                 @ <input type="text" id="hour" name="hour" value="<? date::get( 'hour', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
                                 : <input type="text" id="minute" name="minute" value="<? date::get( 'minute', $get_post->date ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
							</div>
							<a href="#" id="edit_publish" class="red button-secondary">Cancel</a>
						</div>


                        <label >Post Type</label>
                        <div class="post-type-list">
                            <? $post_types = get_post_type ( ACTIVE_THEME );
                                foreach ($post_types as $post_type ): ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="post_type" class="post-format" value="<?= $post_type['part_id']; ?>" <? checked( $get_post->template, $post_type['part_id'] ); ?>>
                                            <?= $post_type['part_name']; ?>
                                        </label>
                                    </div>
                            <? endforeach; ?>
                        </div>


                        <label for="page_category">Category</label>
                        <div class="category-list">

                            <? foreach ($categories as $category): ?>
                                <div class="checkbox">
                                    <label class="selectit">
                                        <input type="checkbox" id="in-category-<?= $category->id  ?>" name="post_category[]" value="<?= $category->id  ?>" <? checked( $category->id, (array)$category_relations ); ?>>
                                        <?= $category->name  ?>
                                    </label>
                                </div>
                            <? endforeach;?>
                        </div>

                        <input type="hidden" value="admin/content_update_post/<?= $get_post->id ?>" name="history">

                        <button type="submit" class="btn btn-large btn-primary">Save</button>
                        <a class="red button-secondary" href="<?= BASE_URL ?>action/trash_post/<?= $get_post->id;?>">Move to trash</a><!--<a href="#review">Save for Review</a>-->

					</fieldset>



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

					<input type="text" name="title" placeholder='Title' value="<?= $get_post->title ?>" class='xlarge content_title form-control' required='required' id="permalink" />
					<input type="hidden" name="permalink" value="<?= $get_post->slug ?>" id="new_uri" />

					<script type="text/javascript" charset="utf-8">
						var page_post = "post";
						var uri = "";
					</script>

				  <p class="permalink">Permalink: <?= BASE_URL ?><span id="permalink_landing"><?= $get_post->uri ?></span></p>

				<? if(user_editor() == 'wysiwyg'):?>
					<p><a href="#" id="myButton" >Insert Media</a></p>

                  <p class="wysiwyg">
                      <textarea cols="100" id="editor" name="content" rows="10" class="editor"><?= the_content( $get_post->content, true ) ?></textarea>
                  </p>
               <? endif; ?>

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Excerpt" value="<?=$get_post->excerpt?>" name='excerpt' />
              </div>

							<div class="clear"></div>
						</div>

						<div id="options" class="tab-pane">
							<fieldset>

								<div class="form-group">
									<label for='bread_crumb'>Breadcrumb title</label>
                  <input type="text" class="form-control" placeholder="Edit title" name='bread_crumb' value='<?= $get_post_meta->bread_crumb ?>' />
                  <span class="help-block">This title will appear in the breadcrumb trail.</span>
								</div>

								<div class="form-group">
									<label for="meta_keywords">Meta Keywords</label>
                  <input type="text" class="form-control" placeholder="Keywords" name='meta_keywords' value='<?= $get_post_meta->meta_keywords ?>' />
                  <span class="help-block">Separate each keyword with a comma ( , )</span>
								</div>

								<div class="form-group">
									<label for="meta_description">Meta Description</label>
                  <textarea name="meta_description" class="form-control" cols="40" rows="5" placeholder='Enter your comments here...'><?= $get_post_meta->meta_description ?></textarea>
                  <span class="help-block">A short summary of the page's content</span>
								</div>

								<div class="form-group">
									<label for="tags">Tags</label>
                  <input type="text" class="tags form-control" name="tags" id="tags" value='<?= $tag_relations ?>' />
                  <span class="help-block">Separate each keyword with a comma ( , )</span>
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
<? load::view('admin/partials/media-modal'); ?>
<? load::view('admin/partials/footer', array( 'assets' => array( 'filedrop', user_editor() ) ) ); ?>