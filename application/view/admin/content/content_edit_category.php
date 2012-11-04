<? load::view('admin/templates/template-header', array('title' => 'Edit category', 'assets' => array('application')));?>

<div id="wrap">
	<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Edit category</h1>
	<div class="table">

		<form action="<?= BASE_URL ?>action/update_category/<?= $id;?>" method="post">
			
			<div class="control-group">
				<label class="control-label" for="name">name</label>
				<div class="controls">
					<input type="text" name="name" id="name" value="<?= escapeStr($category -> name);?>" />
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="slug">Slug</label>
				<div class="controls">
					<input type="text" name="slug" id='slug' value="<?= $category->slug ?>">
				</div>
			</div>
		
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
			
			<div class="form-actions">
				<input type="submit" value="Save" class="btn btn-primary btn-large" />
				<a href="#" class="red">Cancel</a>
			</div>
		</form>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>