<? load::view('admin/template-header', array('title' => 'Manage media', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div id="post-body">
		<div id="post-body-content">
			<div class="title">
				<h1 class='align-left'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage media</h1>
				<a href="<?=ADMIN;?>content_add_page/" class="btn medium primary">Add new page</a>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead class="table-heading">
					<tr>
						<th>Title</th>
						<th>Size</th>
						<th>Permissions</th>
						<th>Modify</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><img src="<?=ADMIN_URL;?>images/icons/24_folder-closed.png" width="24" height="24" alt="Page" /><strong class="title">Folder Name</strong></td>
						<td >386 kb</td>
						<td>drwxr-xr-x (<a href="http://cms.mapleflow.com/frog/admin/#" onclick="toggle_chmod_popup('images'); return false;" title="Change mode">0755</a>)</td>
						<td>Fri, 19 Nov, 2010</td>
						<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
					</tr>
					<tr>
						<td><img src="<?=ADMIN_URL;?>images/icons/24_script.png" width="24" height="24" alt="Page" /><strong class="title">File Name</strong></td>
						<td >86 kb</td>
						<td>drwxr-xr-x (<a href="http://cms.mapleflow.com/frog/admin/#" onclick="toggle_chmod_popup('images'); return false;" title="Change mode">0755</a>)</td>
						<td>Fri, 19 Nov, 2010</td>
						<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
					</tr>
				</tbody>
			</table>
			<div class="actions">
				<input type="button" value="Add file" class="btn medium secondary" />
				<input type="button" value="Create new file" class="btn medium secondary" />
				<input type="button" value="Create folder" class="btn medium secondary" />
			</div>
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>