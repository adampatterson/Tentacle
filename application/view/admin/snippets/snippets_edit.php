<? load::view('admin/template-header',array('title'=>'Edit snippet','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
  <div class="has-right-sidebar">
    <div class="contet-sidebar">
      <h3>What is a Snippet?</h3>
      <p>Snippets are generally small pieces of content which are included in other pages or layouts.</p>
      <h3>Tag to use this snippet</h3>
      <p>Just replace <strong>snippet</strong> by the snippet name you want to include.</p>
      <p>&lt;?php $this-&gt;includeSnippet('snippet'); ?&gt;</p>
    </div>
		<div id="post-body">
			<div id="post-body-content">
		     <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Edit snippet</h1>
				<?php if($note = note::get('snippet_edit')): ?>
					<div class='flash success'>
						<?= $note['content']; ?>
					</div>
				<?php endif; ?>
				<form action="<?= BASE_URL ?>action/update_snippet/<?= $snippet->id; ?>" method="post">
					<div class="clearfix">
						<label for="name">Snippet name</label>
						<div class="input">
							<input type="text" value="<?= escapeStr($snippet->name); ?>" name="name" id='name' />
						</div>
					</div>
					<div class="clearfix">
						<div class="input">
							<textarea name="snippet_content" cols="40" rows="5" name="content"><?= escapeStr($snippet->content); ?></textarea>
						</div>
					</div>
					<div class="clearfix">
						<label for="filter">Filter</label>
						<div class="input">
							<select name='filter' id='filter'>
								<option>Text</option>
								<option>HTML</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<div class="actions">
						<input type="submit" value="Save" class="btn primary medium" />
						<a href="#" class="red">Cancel</a>
					</div>
				</form>
			</div><!-- .post-body-content -->
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/template-footer'); ?>