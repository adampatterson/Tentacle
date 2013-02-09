<? load::view('admin/partials/template-header', array('title' => 'Edit snippet', 'assets' => array('application')));?>
<div id="wrap">
  <div class="has-right-sidebar">
    <div class="contet-sidebar">
      <h3>What is a Snippet?</h3>
      <p>Snippets are generally small pieces of content which are included in other pages or layouts.</p>
      <h3>Tag to use this snippet</h3>
      <p>Just replace <strong>snippet</strong> by the snippet name you want to include.</p>
      <p>[snippet <strong>slug_name</strong>]</p>
    </div>
		<div id="post-body">
			<div id="post-body-content">
		     <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Edit snippet</h1>

				<form action="<?= BASE_URL ?>action/update_snippet/<?= $snippet->id; ?>" method="post">
					<fieldset>
						
						<div class="control-group">
							<label class="control-label" for="name">Snippet Name</label>
							<div class="controls">
								<input type="text" value="<?= string::escape_string($snippet->name); ?>" name="name" id='name' />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="content">Code Block</label>
							<div class="controls">
								<textarea name="content" cols="40" rows="5" name="content"><?= string::escape_string($snippet->content); ?></textarea>
							</div>
						</div>
						
					</fieldset>
					
					<? /* 
						<div class="clearfix">
							<label for="filter">Filter</label>
							<div class="input">
								<select name='filter' id='filter'>
									<option>Text</option>
									<option>HTML</option>
								</select>
							</div>
						</div>
					*/ ?>
					
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<div class="form-actions">
						<input type="submit" value="Save" class="btn btn-primary btn-large" /> 
						<a href="<?=ADMIN;?>snippets_manage/" class="red">Cancel</a>
					</div>
				</form>
			</div><!-- .post-body-content -->
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>