<? load::view('admin/partials/header', array('title' => 'Manage Categories', 'assets' => array('application')));?>

<div id='wrap'>
	<div class='row'>

		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage Categories</h1>
		<div class='col-md-6'>
			<form action='<?= BASE_URL ?>action/add_category/' method='post'>
				<div class='table-heading'>
					<h3 class='regular'>Add Categories</h3>
				</div>
				<div class='table-content'>
					<fieldset>

						<div class="form-group">
							<label for='name'>Name</label>
							<div class="controls">
								<input type='text' name='name' id='name' required='required'>
							</div>
						</div>
						
						<div class="form-group">
							<label for='slug'>Slug</label>
							<div class="controls">
								<input type='text' name='slug' id='slug' required='required'>
							</div>
						</div>
						
					</fieldset>
				</div>

                <div class="row">
                    <div class="actions">
                        <input type='submit' value='Add new category' class='btn btn-large btn-primary' />
                        <a href="#" class="red">Cancel</a>
                    </div>
                </div>

			</form>
		</div>
		<div class='col-md-6'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0' class='manage_content'>
				<thead class='table-heading'>
					<tr>
						<th>
						<input type='checkbox' class='check-all' />
						Name</th>
						<th>Slug</th>
						<!-- <th>Posts</th> -->
						<th>ID</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ( $categories as $category ): ?>
					<tr>
						<td>
						<input type='checkbox' value='<?= $category->id ?>' />
						<?= $category->name
						?></td>
						<td><?= $category->slug
						?></td>
						<!-- <td><?//= ->count
						?></td> -->
						<td><?= $category->id
						?></td>
						<td><a href='<?= ADMIN ?>content_edit_category/<?= $category->id  ?>' class="btn btn-small">Edit</a> <a href='<?= ADMIN ?>content_delete_category/<?= $category->id  ?>' class="btn btn-small btn-danger">Delete</a><!--<img src='<?=ADMIN_URL; ?>images/icons/16_add.png' width='15' height='16' alt='Add' />--></td>
					</tr>
					<? endforeach;?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
