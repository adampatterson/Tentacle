<? load::view('admin/partials/header', array('title' => 'Write a new post', 'assets' => array('application', 'filedrop', user_editor()) ) );?>

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
<!--					<input type="button" value="Preview" class="btn btn-small btn-primary pull-right" />-->
				</div>
				<div class="table-content">
					<fieldset>
						<div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="draft">Draft</option>
                            <!--<option value="review">Pending Review</option>-->
                                <option value="published">Published</option>
                            </select>
						</div>

						<div class="form-group">
							<label for="status">Publish on</label>
                            <select id="publish" name="publish" class="form-control">
                                <option value="immediately">Immediately</option>
                                <option value="published-on">Publish On</option>
                            </select>
						</div>

						<div class="form-group published-on">
							<? date::current('month', true); ?>
						</div>

						<div class="form-group published-on">
		 					<div class="form-inline">
								<input type="text" id="day" name="day" value="<? date::current( 'day' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1"> - <input type="text" id="year" name="year" value="<? date::current( 'year' ) ?>" size="4" maxlength="4" tabindex="4" autocomplete="off" class="span1"> @ <input type="text" id="hour" name="hour" value="<? date::current( 'hour' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1"> : <input type="text" id="minute" name="minute" value="<? date::current( 'minute' ) ?>" size="2" maxlength="2" tabindex="4" autocomplete="off" class="span1">
							</div>
						</div>


                        <label>Post type</label>
                        <div class="post-type-list">


                            <?  $post_types = get_post_type ( ACTIVE_THEME );
                                foreach ($post_types as $post_type ): ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="post_type" class="post-format" value="<?= $post_type['part_id']; ?>" <? checked( $post_type['part_id'], 'type-post' ); ?>>
                                            <?= $post_type['part_name']; ?>
                                        </label>
                                    </div>
                            <?	endforeach; ?>
                        </div>

                        <label for="page_category">Category</label>
                            <div class="category-list">
                                <? foreach ($categories as $category): ?>
                                <div class="checkbox">
                                    <label class="selectit">
                                        <input type="checkbox" id="in-category-<?= $category->id  ?>" name="post_category[]" value="<?= $category->id  ?>" <? checked( $category->id, '1' ); ?>> <?= $category->name  ?>
                                    </label>
                                </div>
                            <? endforeach;?>
                        </div>

                        <input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>

                        <button type="submit" class="btn btn-large btn-primary">
                            Save
                        </button>

					</fieldset>

				</div>
			</div>
			<div id="post-body">
				<div id="post-body-content">

					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Write a new post</h1>
					<ul class="nav nav-tabs" id="content-tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li class=""><a href="#options">Options</a></li>
					</ul>

					<div class="tab-content tab-body">

						<div id="content" class="active tab-pane">

                            <input type="text" name="title" placeholder='Title' class='xlarge content_title form-control' id="permalink" />
                            <input type="hidden" name="permalink" id="new_uri" />

                            <script type="text/javascript" charset="utf-8">
                                var page_post = "post";
                                var uri = "";
                            </script>

                            <p class="permalink">Permalink: <?= BASE_URL ?><span id="permalink_landing"></span></p>

							<? if(user_editor() == 'wysiwyg'): ?>
								<p><a href="#" id="myButton" >Insert Media</a></p>

					            <p class="wysiwyg">
					                <textarea cols="100" id="editor" name="content" rows="30" class="editor"></textarea>
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
										<textarea name="meta_description" cols="40" rows="5" placeholder="Enter your excerpt here..."></textarea>
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
<? load::view('admin/partials/media-modal'); ?>
<? load::view('admin/partials/footer', array( 'assets' => array( 'filedrop', user_editor() ) ) ); ?>