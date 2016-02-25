<? load::view('admin/partials/header', array('title' => 'Edit category', 'assets' => array('application')));?>

<div id="wrap">
	<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Edit category</h1>
    <div class='col-md-6'>

		<form action="<?= BASE_URL ?>action/update_category/<?= $id;?>" method="post">
			
			<div class="form-group">
				<label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= text::escape_string($category->name);?>" />
			</div>
			
			<div class="form-group">
				<label for="slug">Slug</label>
                <input type="text" name="slug" id='slug' class="form-control" value="<?= $category->slug ?>">
			</div>
		
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>

            <div class="row">
                <div class="actions">
                    <input type="submit" value="Save" class="btn btn-primary btn-large" />
                    <a href="#" class="red">Cancel</a>
                </div>
            </div>
		</form>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>