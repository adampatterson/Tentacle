<? load::view('admin/template-header', array('title' => 'Manage Categories', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id='wrap'>
	<div class='one-full'>
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage Categories</h1>
		<div class='one-half'>
			<form action='<?= BASE_URL ?>action/add_category/' method='post'>
				<?php if( $note = note::get( 'category_add' ) ):
				?>
				<div class='flash success'>
					<?= $note['content'];?>
				</div>
				<?php endif;?>
				<div class='table-heading'>
					<h3 class='regular'>Add Categories</h3>
				</div>
				<div class='table-content'>
					<fieldset>
						<div class="clearfix">
							<label for='name'>Name</label>
							<div class="input">
								<input type='text' name='name' id='name' required='required'>
							</div>
						</div>
						<div class="clearfix">
							<label for='slug'>Slug</label>
							<div class="input">
								<input type='text' name='slug' id='slug' required='required'>
							</div>
						</div>
					</fieldset>
				</div>
				<div class='actions'>
					<input type='submit' value='Add new category' class='btn medium primary' />
				</div>
			</form>
		</div>
		<div class='one-half'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				<thead class='table-heading'>
					<tr>
						<th>
						<input type='checkbox' class='check-all' />
						Name</th>
						<th>Slug</th>
						<th>Posts</th>
						<th>ID</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($categories as $category):
					?>
					<tr>
						<td>
						<input type='checkbox' value='<?= $category->id ?>' />
						<?= $category->name
						?></td>
						<td><?= $category->slug
						?></td>
						<td><?= $category->count
						?></td>
						<td><?= $category->id
						?></td>
						<td><a href='<?= ADMIN ?>content_category_edit/<?= $category->id  ?>'><img src='<?=ADMIN_URL;?>images/icons/16_edit.png' width='16' height='16' alt='Edit' /></a> <a href='<?= ADMIN ?>content_category_delete/<?= $category->id  ?>'><img src='<?=ADMIN_URL;?>images/icons/16_delete.png' width='16' height='16' alt='Delete' /></a><!--<img src='<?=ADMIN_URL; ?>images/icons/16_add.png' width='15' height='16' alt='Add' />--></td>
					</tr>
					<? endforeach;?>
				</tbody>
			</table>
			<div class='actions'>
				<form name='form' id='form'>
					<select name='jumpMenu' id='jumpMenu'>
						<option>Actions</option>
						<option>Delete</option>
						<option>Edit</option>
					</select>
					<input type='button' value='Apply' class='btn medium secondary' />
				</form>
			</div>
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
