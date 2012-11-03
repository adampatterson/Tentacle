<? load::view('install/template-header', array('title' => '- Step 6'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 6</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li><a href='#'>Testing the config file</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Create User</a><span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Create your admin user.</h2>
		<form method="post" action="<?= BASE_URL; ?>action/admin" class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label for="user_name" class="control-label">Username <span class="description">(required)</span></label>
					<div class="controls">
						<input type="text" required="true" value="" id="user_name" name="user_name">
					</div>
				</div>
				<div class="control-group">
					<div>
						<label for="email" class="control-label">E-mail <span class="description">(required)</span></label>
						<div class="controls">
							<input type="text" value="" id="email" name="email">
							</p>
							<input type="hidden" value="" id="old_email" name="old_email">
						</div>
					</div>
					<div class="control-group">
						<label for="first_name" class="control-label">First Name</label>
						<div class="controls">
							<input type="text" value="" id="first_name" name="first_name">
						</div>
					</div>
					<div class="control-group">
						<label for="last_name" class="control-label">Last Name</label>
						<div class="controls">
							<input type="text" value="" id="last_name" name="last_name">
						</div>
					</div>
					<div class="control-group">
						<label for="display_name" class="control-label">Display Name</label>
						<div class="controls">
							<input type="text" value="" id="display_name" name="display_name">
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Password <span class="description">(required)</span></label>
						<div class="controls">
							<input type="password" autocomplete="off" id="password" name="password" required="true" />
							<span class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</span>
						</div>
					</div>
					<div class="control-group">
						
						<div class="controls">
							<label for="send_password" class="checkbox">
								<input type="checkbox" id="send_password" name="send_password" value="yes">
								Send password?</label>
							<span class="help-block"> Send this password to the new user by email.</span>
						</div>
					</div>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<input type="hidden" name='profile' value='true' />
			</fieldset>
			<div class="row">
				<div class="span6">
					<a href="<?= BASE_URL; ?>install/step4/" class="btn btn-danger">Back</a>
				</div>
				<div class="span6 pull-right">
					<input name="submit" id= "fsubmit" type="submit" value="Submit" class="btn btn-primary pull-right"/>
				</div>
			</div>
		</form>
      </div>
   </div>
</div>
<? load::view('install/template-footer');?>