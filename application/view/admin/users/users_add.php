<?	load::view('admin/template-header', array('title' => 'Add a new user', 'assets' => 'application'));?>
<?	load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="one-full">
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Add a new user</h1>
		<div class="one-half">
			<?php if($note = note::get('user_add')): ?>
				<script type="text/javascript">
					$(document).ready(function() {
						jQuery.noticeAdd({
							text : '<?= $note['content'];?>',
							stay : false,
							type : '<?= $note['type']; ?>'
						});
					});
				</script>
			<?php endif;?>
			<form id='validation' action="<?= BASE_URL ?>action/add_user/" method="post">
				<fieldset>
					<div class="clearfix">
						<label for="user_name">Username <span class="description">(required)</span></label>
						<div class="input">
							<input type="text" aria-required="true" value="" id="user_name" name="user_name">
						</div>
					</div>
					<div class="clearfix">
						<label for="email">E-mail <span class="description">(required)</span></label>
						<div class="input">
							<input type="text" value="" id="email" name="email">
						</div>
					</div>
					<div class="clearfix">
						<label for="first_name">First Name</label>
						<div class="input">
							<input type="text" value="" id="first_name" name="first_name">
						</div>
					</div>
					<div class="clearfix">
						<label for="last_name">Last Name</label>
						<div class="input">
							<input type="text" value="" id="last_name" name="last_name">
						</div>
					</div>
					<div class="clearfix">
						<label for="display_name">Display Name</label>
						<div class="input">
							<input type="text" value="" id="display_name" name="display_name">
						</div>
					</div>
					<div class="clearfix">
						<label for="url">Website</label>
						<div class="input">
							<input type="text" value="" class="code" id="url" name="url">
						</div>
					</div>
					<div class="clearfix">
						<label for="password">Password <span class="description">(twice, required)</span></label>
						<div class="input">
							<input type="password" autocomplete="off" id="password" name="password" />
						</div>
						<div class="input">
							<input type="password" autocomplete="off" id="confirm_password" name="confirm_password" />
							<span class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</span>
						</div>
					</div>
					<div class="clearfix">
						<label for="send_password">Send this password to the new user by email.</label>
						<div class="input">
							<input type="checkbox" id="send_password" name="send_password">
						</div>
					</div>
					<div class="clearfix">
						<label for="type" class="alignleft">Role</label>
						<div class="input">
							<select id="type" name="type">
								<option value="subscriber" selected="selected">Subscriber</option>
								<option value="administrator">Admin</option>
								<option value="editor">Editor</option>
								<option value="author">Author</option>
								<option value="contributor">Contributor</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
				</fieldset>
				<div class="actions">
					<input type="submit" value="Save" class="btn medium primary" />
					<a href="#" class="red">Cancel</a>
				</div>
			</form>
		</div>
		<div class="one-half">
			&nbsp;
		</div>
	</div>
</div>
<!-- #wrap -->
<?load::view('admin/template-footer');?>