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
						<label for="username">Username <span class="description">(required)</span></label>
						<div class="input">
							<input id="username" type="text" required="true" value="" name="user_name">
							<img class="user_tick" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
							<img class="user_cross" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
						</div>
					</div>
					<div class="clearfix">
						<label for="useremail">E-mail <span class="description">(required)</span></label>
						<div class="input">
							<input type="text" value="" id="useremail" name="email">
							<img class="email_tick" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
							<img class="email_cross" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
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
							<input type="password" autocomplete="off" id="password" name="password" required />
						</div>
						<div class="input">
							<input type="password" autocomplete="off" id="confirm_password" name="confirm_password" required />
							<span class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</span>
						</div>
					</div>
<? /*
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
*/ ?>
					<div class="clearfix">
						<label for="editor" class="alignleft">Editor</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label title="wysiwyg">
										<input type="radio" checked="checked" value="wysiwyg" name="editor">
										<span>WYSIWYG</span> </label>
								</li>
								<li>
									<label title="html">
										<input type="radio" value="html" name="editor">
										<span>HTML</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
				</fieldset>
				<div class="actions">
					<input type="submit" value="Save" class="btn medium primary" id="save" />
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
<?load::view('admin/template-footer');?>