<? load::view('admin/template-header', array('title' => 'Manage Posts', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div id="post-body">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage posts</h1>
			<a href="<?=ADMIN;?>content_add_post/" class="btn medium primary">Add new post</a>
			<div class="title-search alignright">
				<input type="text" name="search" placeholder="Search" />
			</div>
		</div>
		<div class="page-details">
			<div class="filter-links">
				<a href="#">All (197)</a> | <a href="#">Published (72)</a> | <a href="#">Drafts (125)</a> | <a href="#">Trash (1)</a>
			</div>
			<div class="pagination align-right textright">
				<em><strong>Displaying 21–40 of 197</strong></em><a href="#">«</a><a href="#">1</a><a href="#" class="current">2</a><a href="#">3</a><a href="#">»</a>
			</div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead class="table-heading">
				<tr>
					<th>
					<input type="checkbox" class="check-all" />
					Title</th>
					<th>Category</th>
					<th>&nbsp;</th>
					<th>Author</th>
					<th>ID</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($posts as $post):
					$user_meta = $user->get_meta ( $post->author );
				?>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_paper.png" width="24" height="24" alt="Page" /><strong class="title"><?= $post -> title;?></strong></td>
					<td><?= $category->get( $post->category )->name; ?></td>
					<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note-dis.png" width="16" height="16" alt="Notes" /></td>
					<td ><?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></td>
					<td ><?= $post -> id;?></td>
					<td><?= $post -> status;?></td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
		<div class="actions">
			<form name="form" id="form" action="post">
				<select name="jumpMenu" id="jumpMenu">
					<option>Actions</option>
					<option>Delete</option>
					<option>Edit</option>
				</select>
				<input type="button" value="Apply" class="btn medium" />
				<select name="jumpMenu1" id="jumpMenu1">
					<option>Show Dates</option>
				</select>
				<select name="jumpMenu2" id="jumpMenu2">
					<option>Show Categories</option>
				</select>
				<input type="button" value="Filter" class="btn medium" />
			</form>
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
