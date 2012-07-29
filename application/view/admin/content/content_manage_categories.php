<? load::view('admin/template-header', array('title' => 'Manage Categories', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id='wrap'>
	<div class='one-full'>
		<?php if( $note = note::get('category_add') or $note = note::get('category_update')): ?>
			<script type="text/javascript">
				$(document).ready(function() {
					jQuery.noticeAdd({
						text : '<?= $note['content'];?>',
						stay : false,
						type : '<?= $note['type']; ?>'
					});
				});
			</script>
		<?php endif; ?>
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage Categories</h1>
		<div class='one-half'>
			<form action='<?= BASE_URL ?>action/add_category/' method='post'>
				<div class='table-heading'>
					<h3 class='regular'>Add Categories</h3>
				</div>
				<div class='table-content'>
					<fieldset>
						
						<div class="controlgroup">
							<label for='name' class="control-label">Name</label>
							<div class="controls">
								<input type='text' name='name' id='name' required='required'>
							</div>
						</div>
						
						<div class="controlgroup">
							<label for='slug' class="control-label">Slug</label>
							<div class="controls">
								<input type='text' name='slug' id='slug' required='required'>
							</div>
						</div>
						
					</fieldset>
				</div>
				<div class='form-actions'>
					<input type='submit' value='Add new category' class='btn btn-large btn-primary' />
				</div>
			</form>
		</div>
		<div class='one-half'>
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
			<!--
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
			-->
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
