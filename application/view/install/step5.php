<? load::view('install/template-header', array('title' => '- Step 6'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 6</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>Overview</a></li>
		<li><a href='#'>System Check</a></li>
		<li><a href='#'>Database Information</a></li>
		<li><a href='#'>Testing the config file</a></li>
		<li class="active"><a href='#'>Create User</a></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="col-md-12">
        <h2>Create your admin user.</h2>
		<form method="post" action="<?= BASE_URL; ?>action/admin" class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label for="user_name">Username <span class="description">(required)</span></label>
					<input type="text" required="true" value="" class="form-control" id="user_name" name="user_name">
				</div>
				<div class="control-group">
                    <label for="email">E-mail <span class="description">(required)</span></label>
                    <input type="text" value="" id="email" class="form-control" name="email">
                </div>
                <div class="control-group">
                    <label for="first_name">First Name</label>
                    <input type="text" value="" id="first_name" class="form-control" name="first_name">
                </div>
                <div class="control-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" value="" id="last_name" class="form-control" name="last_name">
                </div>
                <div class="control-group">
                    <label for="display_name">Display Name</label>
                    <input type="text" value="" id="display_name" class="form-control" name="display_name">
                </div>
                <div class="control-group">
                    <label for="password">Password <span class="description">(required)</span></label>
                    <input type="password" autocomplete="off" id="password" class="form-control" name="password" required="true" />
                    <span class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</span>
                </div>
                <div class="control-group">
                    <label for="send_password" class="checkbox">
                        <input type="checkbox" id="send_password" name="send_password" value="yes">
                        Send password?</label>
                    <span class="help-block"> Send this password to the new user by email.</span>
                </div>
                <input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
                <input type="hidden" name='profile' value='true' />
			</fieldset>
			<div class="row">
				<div class="col-md-6">
					<a href="<?= BASE_URL; ?>install/step4/" class="btn btn-danger">Back</a>
				</div>
				<div class="col-md-6">
					<input name="submit" id= "fsubmit" type="submit" value="Submit" class="btn btn-primary pull-right"/>
				</div>
			</div>
		</form>
      </div>
   </div>
</div>
<? load::view('install/template-footer');?>