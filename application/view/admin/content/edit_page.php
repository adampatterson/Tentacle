<? load::view('admin/partials/header', array('title' => 'Edit '.$get_page->title, 'assets' => array('application', 'filedrop', user_editor()) ) );?>

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
	<form action="<?= BASE_URL ?>action/update_page/<?= $get_page->id ?>" method="post" class="form-stacked" id='edit_page'>
		<input type="hidden" name="page-or-post" value='page' />
		<input type='hidden' name='page_template' value='<?= $get_page->template?>' />
		<div class="has-right-sidebar">
			<div class="contet-sidebar has-tabs">
				<div class="table-heading">
					<h3 class="regular">Page Settings</h3>
<!--					<input type="button" value="Preview" class="btn btn-small btn-primary pull-right" />-->
				</div>
				<div class="table-content">
					<fieldset>
						<div class="form-group">
							<label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                  <option value="draft" <? selected( $get_page->status, 'draft' ); ?>>Draft</option>
                  <option value="published" <? selected( $get_page->status, 'published' ); ?>>Published</option>
              </select>
						</div>

						<div class="form-group">
							<label for="parent_page">Parent Page</label>
              <select id="parent_page" name="parent_page" class="form-control">
                  <option value="0">None</option>
                  <? foreach ($pages as $page_array):
                      $page = (object)$page_array; ?>
                      <option value="<?= $page->id?>" <? selected( $page->id, $get_page->parent  ); ?>><?= offset($page->level, 'list').$page->title;?></option>
                  <? endforeach;?>
              </select>
            </div>

            <label for="page_template">Page template</label>
            <p>
            <? $templates = get_templates( ACTIVE_THEME );

            foreach ( $templates as $template ):
                if ( $get_page->template == $template->template_id )
                    echo $template->template_name;
            endforeach; ?>
            </p>
          <? /*
            @todo Figure out a way to change templates after one has been saved.

              <label for="page_template">Page template</label>

              <select id="page_template" name="page_template" onchange="location = this.options[this.selectedIndex].value;">
                <option value="<?= BASE_URL ?>action/render_admin/update_page/default/<?= $get_page->id ?>" <? if ($get_page->template == 'default') echo 'selected' ?>>Default</option>
                <? $templates = get_templates( get::option( 'appearance' ) );
                foreach ( $templates as $template ):
                ?>
                  <option value="<?= BASE_URL ?>action/render_admin/update_page/<?= $template->template_id ?>/<?= $get_page->id ?>" <? selected( $get_page->template, $template->template_id ); ?>><?= $template->template_name ?></option>
                <? endforeach; ?>
              </select>
            */?>

              <input type="hidden" value="admin/content_update_page/<?= $get_page->id ?>" name="history">

              <button type="submit" class="btn btn-large btn-primary">Save</button>
              <a class="red button-secondary" href="<?= BASE_URL ?>action/trash_page/<?= $get_page->id;?>">Move to trash</a><!--<a href="#review">Save for Review</a>-->

					</fieldset>

				</div>
			</div>

			<div id="post-body">
				<div id="post-body-content">

					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Update <small><?= $get_page->title ?></small></h1>

					<ul class="nav nav-tabs" id="content-tabs">
						<li class="active"><a href="#content">Content</a></li>
						<li class=""><a href="#options">Options</a></li>
					</ul>

					<div class="tab-content tab-body">

						<div id="content" class="active tab-pane">

							<input type="text" name="title" placeholder='Title' value='<?= $get_page->title ?>' class='xlarge content_title form-control' required='required' id="permalink" />
							<input type="hidden" name="permalink" id="new_uri" />

                            <script type="text/javascript" charset="utf-8">
                                var page_post = "page";
                                var uri = "<?= parent_page_slug( $get_page->parent ); ?>";
                            </script>

							<p class="permalink">Permalink: <?= BASE_URL.parent_page_slug( $get_page->parent ); ?><span id="permalink_landing"><?= $get_page->slug ?></span></p>

                            <? if(user_editor() == 'wysiwyg'):?>
								<p><a href="#" id="myButton" >Insert Media</a></p>

					            <p class="wysiwyg">
					                <textarea cols="100" id="editor" name="content" rows="10" class="editor"><?= the_content( $get_page->content, true ) ?></textarea>
					            </p>

                            <? endif; ?>

							<div id="scaffold">
                                <? if ( $get_page->template != '' && $get_page->template != 'default' ):

									$template = THEMES_DIR.'/'.ACTIVE_THEME.'/'.$get_page->template.'.php';

									// Load the saved template, then if the user changes override the saved template.
									if( file_exists( $template )):

                                        $data = get::yaml( $template );

                                        #var_dump($data);

										if ( $data != null ):
											$scaffold = new scaffold();

											$scaffold->populate_this( $data, $get_page_meta );
                                        endif;

									else: ?>

										<br/><br/>
										<div class="alert-message warning">
											<p><strong>A template file appears to be a missing from your theme:</strong> <br />
											<?= '/themes/'.ACTIVE_THEME.'/'.$get_page->template.'.php'?></p>
										</div>

									<? endif;
                                endif; ?>

							</div>
						</div>

						<div id="options" class="tab-pane">
							<fieldset>

								<div class="form-group">
									<label for='bread_crumb'>Breadcrumb title</label>
                  <input type="text" placeholder="Edit title" name='bread_crumb' value='<?= $get_page_meta->bread_crumb ?>' />
                  <span class="help-block">This title will appear in the breadcrumb trail.</span>
								</div>

								<div class="form-group">
									<label for="meta_keywords">Meta Keywords</label>
                  <input type="text" class="form-control" placeholder="Keywords" name='meta_keywords' value='<?= $get_page_meta->meta_keywords ?>' />
                  <span class="help-block">Separate each keyword with a comma ( , )</span>
								</div>

								<div class="form-group">
									<label for="meta_description">Meta Description</label>
                  <textarea name="meta_description" class="form-control" cols="40" rows="5" placeholder='Enter your comments here...'><?= $get_page_meta->meta_description ?></textarea>
                  <span class="help-block">A short summary of the page's content</span>
								</div>

								<div class="form-group">
									<label for="tags">Tags</label>
                  <input type="text"  class="form-control tags" name="tags" id="tags" value='<?= $tag_relations ?>' />
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
