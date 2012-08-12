<? load::view('admin/templates/template-header', array('title' => 'User Profile', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<div class="one-full">
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage User</h1>
		<div class="one-half">
		<?php if($note = note::get('user_updated')): ?>
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
		<form id='edit' action="<?= BASE_URL ?>action/update_user" method="post" accept-charset="utf-8">
			<fieldset class="form-horizontal">

				<div class="control-group">
					<label class="control-label" for="user_name">Username <span class="description">(required)</span></label>
					<div class="controls">
						<input id="username" type="text" required="true" value="<?= $user->username;?>" name="user_name">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="email">E-Mail <span class="description">(required)</span></label>
					<div class="controls">
						<input type="text" value="<?= $user->email;?>" id="email" name="email">
						</p>
						<input type="hidden" value="<?= $user->email;?>" id="old_email" name="old_email">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="first_name">First Name</label>
					<div class="controls">
						<input type="text" id="first_name" name="first_name" value="<?= $user_meta->first_name;?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="last_name">Last Name</label>
					<div class="controls">
						<input type="text" id="last_name" name="last_name" value="<?= $user_meta->last_name;?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="display_name">Display Name</label>
					<div class="controls">
						<input type="text" id="display_name" name="display_name" value="<?= $user_meta->display_name;?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="website">Website</label>
					<div class="controls">
						<input type="text" value="<?= $user_meta->url ?>" class="code" id="url" name="url">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"  for="password">Password <span class="description">(twice, required)</span></label>
					<div class="controls">
						<input type="password" autocomplete="off" id="password" name="password" />
					</div>
					<div class="controls">
						<input type="password" autocomplete="off" id="confirm_password" name="confirm_password" />
						<p class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</p>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Send password?</label>
					<div class="controls">
						<label for="send_password" class="checkbox"><input type="checkbox" id="send_password" name="send_password" class="checkbox" value="yes">Send this password to the new user by email.</label>
					</div>
				</div>

				<div class="control-group">
					<label for="editor" class="control-label">Editor</label>
					<div class="controls">	
						<label title="wysiwyg" class="radio"><input type="radio" <? checked( $user_meta->editor, 'wysiwyg' ); ?> value="wysiwyg" name="editor" class="radio">WYSIWYG</label>
						<label title="html" class="radio"><input type="radio" <? checked( $user_meta->editor, 'html' ); ?>value="html" name="editor" class="radio">HTML</label>
					</div>
				</div>

				<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
				<input type="hidden" name='profile' value='true' />

			</fieldset>

			<div class="form-actions">
				<input type="submit" value="Save" class="btn btn-primary" id="save" />
				<a href="<?=ADMIN;?>users_manage/" class="red">Cancel</a>
			</div>
			
			</form>
		</div>
		<div class="one-half">
			<!--<p>System messages</p>-->
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer');