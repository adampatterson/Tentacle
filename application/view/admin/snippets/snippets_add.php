<? load::view('admin/templates/template-header', array('title' => 'Add a new snippet', 'assets' => 'application'));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<div class="has-right-sidebar">
		<div class="contet-sidebar">
			<h3>What is a Snippet?</h3>
			<p>Snippets are generally small pieces of content which are included in other pages or layouts.</p>
			<h3>Tag to use this snippet</h3>
			<p>Just replace <strong>snippet</strong> by the snippet name you want to include.</p>
			<p>[snippet slug=<strong>slug_name</strong>]</p>
		</div>
		<div id="post-body">
			<div id="post-body-content">
				<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Add a new snippet</h1>
				<?php if( $note = note::get( 'snippet_add' ) ):
				?>
				<div class='flash success'>
					<?= $note['content'];?>
				</div>
				<?php endif;?>
				<form action="<?= BASE_URL ?>action/add_snippet/" method="post">
					
					<div class="control-group">
						<label class="control-label" for="name">Snippet Name</label>
						<div class="controls">
							<input type="text" name="name" value="" placeholder='Snippet name' />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="content">Code Block</label>
						<div class="controls">
							<textarea name="content" cols="40" rows="5" placeholder='Enter your snippet code here'></textarea>
						</div>
					</div>
					
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					
					<div class="form-actions">
						<!--<input type="button" value="Save and Close" class="button" />
						<input type="button" value="Save and Continure Editing" class="button" />-->
						<input type="submit" value="Save" class="btn btn-primary btn-large" />
						<a href="<?=ADMIN;?>snippets_manage/" class="red">Cancel</a>
					</div>
				</form>
			</div><!-- .post-body-content -->
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer');?>