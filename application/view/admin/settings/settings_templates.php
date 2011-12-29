<? load::view('admin/template-header',array('title'=>'Notification Templates','assets'=>'application','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
	<div class="one-full">
		<div class="title">
	    	<h1 class="align-left"><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Notification Templates</h1>
			<a href="<?=ADMIN;?>settings_templates_add/" class="btn medium primary">Add new template</a>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead class="table-heading">
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td >Comment Notificiation</td>
					<td>Email that is sent to admin when someone creates a comment</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
				<tr>
					<td >Contact Notification</td>
					<td>Template for the contact form</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
				<tr>
					<td >New User Registered</td>
					<td>The email sent to the site contact e-mail when a new user registers</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
				<tr>
					<td >Activation Email</td>
					<td>The email which contains the activation code that is sent to a new user</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
				<tr>
					<td >Forgotten Password Email</td>
					<td>The email that is sent containing a password reset code</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
				<tr>
					<td >New Password Email</td>
					<td>After a password is reset this email is sent containing the new password</td>
					<td><a href="#edit" class="btn small">Edit</a> <a href="#delete" class="btn small danger">Delete</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div><!-- #wrap -->
<? load::view('admin/template-footer'); ?>