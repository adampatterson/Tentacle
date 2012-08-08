<?	load::view('admin/templates/template-header', array('title' => 'Add a new user', 'assets' => 'application'));?>
<?	load::view('admin/templates/template-sidebar');?>
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
				<fieldset class="form-horizontal">
					
						<style>
							.email_cross, .user_cross{display:none}
							.email_tick, .user_tick{display:none}
						</style>
						<script type="text/javascript" charset="utf-8">

							$(document).ready(function(){
								$('#username').keyup(username_check);

								$('#useremail').keyup(useremail_check);
							});

							function username_check() {	
								var username = $('#username').val();
								if(username == "" || username.length < 4)
								{
									$('.tick').hide();
								}
								else
								{
									jQuery.ajax({
										type: "POST",
										url: "<?= BASE_URL ?>ajax/unique_user",
										data: 'username='+ username,
										cache: false,
										success: function(response){
											if(response == '1')
											{
												$('#username').css('border', '1px #C33 solid');	
												$('.user_tick').hide();
												$('.user_cross').fadeIn();
												$("#save").attr("disabled", "disabled");
											}
											else
											{
												$('#username').css('border', '1px #090 solid');
												$('.user_cross').hide();
												$('.user_tick').fadeIn();
												$("#save").removeAttr("disabled");
											}
										}
									});
								}
							}
						
							function useremail_check() {	
								var username = $('#useremail').val();
								if(username == "" || username.length < 4)
								{
									$('.email_tick').hide();
								}
								else
								{
									jQuery.ajax({
										type: "POST",
										url: "<?= BASE_URL ?>ajax/unique_user",
										data: 'username='+ username,
										cache: false,
										success: function(response){
											if(response == '1')
											{
												$('#useremail').css('border', '1px #C33 solid');	
												$('.email_tick').hide();
												$('.email_cross').fadeIn();
												$("#save").attr("disabled", "disabled");
											}
											else
											{
												$('#useremail').css('border', '1px #090 solid');
												$('.email_cross').hide();
												$('.email_tick').fadeIn();
												$("#save").removeAttr("disabled");
											}
										}
									});
								}
							}
						</script>
					
					<div class="control-group">
						<label class="control-label" for="user_name">Username <span class="description">(required)</span></label>
						<div class="controls">
							<input id="username" type="text" required="true" value="" name="user_name">
							<img class="user_tick" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
							<img class="user_cross" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="email">E-Mail <span class="description">(required)</span></label>
						<div class="controls">
							<input type="text" id="email" name="email">
							<img class="email_tick" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
							<img class="email_cross" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="first_name">First Name</label>
						<div class="controls">
							<input type="text" id="first_name" name="first_name">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="last_name">Last Name</label>
						<div class="controls">
							<input type="text" id="last_name" name="last_name">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="display_name">Display Name</label>
						<div class="controls">
							<input type="text" id="display_name" name="display_name">
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label" for="website">Website</label>
						<div class="controls">
							<input type="text" value="" class="code" id="url" name="url">
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
<? /*
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
*/ ?>
					<div class="control-group">
						<label for="editor" class="control-label">Editor</label>
						<div class="controls">	
							<label title="wysiwyg" class="radio"><input type="radio" checked="checked" value="wysiwyg" name="editor" class="radio">WYSIWYG</label>
							<label title="html" class="radio"><input type="radio" value="html" name="editor" class="radio">HTML</label>
						</div>
					</div>
					
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					
				</fieldset>
				
				<div class="form-actions">
					<input type="submit" value="Save" class="btn btn-primary" id="save" />
					<a href="<?=ADMIN;?>users_manage/" class="red">Cancel</a>
				</div>
				
			</form>
		</div>
		<div class="one-half">
			&nbsp;
		</div>
	</div>
</div>
<!-- #wrap -->
<?load::view('admin/templates/template-footer');?>