<? load::view('admin/template-header', array('title' => 'Edit category', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Edit category</h1>
	<div class="table">
		<?php if($note = note::get('category_edit')):
		?>
		<div class='flash success'>
			<?= $note['content'];?>
		</div>
		<?php endif;?>
		<form action="<?= BASE_URL ?>action/update_category/<?= $id;?>" method="post">
			<div class="clearfix">
				<label for="name">Name</label>
				<div class="input">
					<input type="text" name="name" id="name" value="<?= escapeStr($category -> name);?>" />
				</div>
			</div>
			<div class="clearfix">
				<label for="slug">Slug</label>
				<div class="input">
					<input type="text" name="slug" id='slug' value="<?= $category->slug ?>">
				</div>
			</div>
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
			<div class="actions">
				<input type="submit" value="Save" class="btn medium primary" />
				<a href="#" class="red">Cancel</a>
			</div>
		</form>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>