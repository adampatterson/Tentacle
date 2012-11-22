<? load::view('admin/partials/template-header', array('title' => 'Manage users', 'assets' => array('application')));?>

<div id="wrap">
	<div class="title pad-right">
		<h1 class="align-left title"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage users</h1>
		<a href="<?=ADMIN;?>users_add/" class="btn btn-primary">Add new user</a>
	</div>
	<div class="table normal">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage_content">
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
					<td class="user"><a href="<?= ADMIN ?>users_edit/<?= $user->id ?>"> <?php echo get::gravatar($user -> email, 32);?>
					<strong><?= $user->username
					?></strong></a></td>
					<td><?= $user->email ?></td>
					<td><?= $user->type ?></td>
					<td><a href="<?= ADMIN ?>users_edit/<?= $user->id ?>"class="btn btn-small">Edit</a> <a href="<?= ADMIN ?>users_delete/<?= $user->id ?>" class="btn btn-small btn-danger">Delete</a></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>