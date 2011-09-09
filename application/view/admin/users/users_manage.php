<? load::view('admin/template-header', array('title' => 'Manage users', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="title pad-right">
		<h1 class="align-left title"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage users</h1>
		<a href="<?=ADMIN;?>users_add/" class="btn medium primary">Add new user</a>
	</div>
	<div class="table normal">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead class="table-heading">
				<tr>
					<th>Name / Username</th>
					<th>Email</th>
					<th>Roles</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($users as $user):
				?>
				<tr>
					<td class="user"><a href="<?= ADMIN ?>users_edit/<?= $user->id ?>"> <?php echo get_gravatar($user -> email, 32);?>
					<strong><?= $user->username
					?></strong></a></td>
					<td><?= $user->email
					?></td>
					<td><?= $user->type
					?></td>
					<td><a href="<?= ADMIN ?>users_edit/<?= $user->id ?>"><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /></a> <a href="<?= ADMIN ?>users_delete/<?= $user->id ?>"><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></a></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>