<? load::view('install/template-header', array('title' => '- Step 6'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 6</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>License</a><span class="divider">/</span></li>
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
		<form method="post" action="<?= BASE_URL; ?>action/admin">
			<fieldset>
				<div class="clearfix">
					<label for="user_name">Username <span class="description">(required)</span></label>
					<div class="input">
						<input type="text" required="true" value="" id="user_name" name="user_name">
					</div>
				</div>
				<div class="clearfix">
					<div>
						<label for="email">E-mail <span class="description">(required)</span></label>
						<div class="input">
							<input type="text" value="" id="email" name="email">
							</p>
							<input type="hidden" value="" id="old_email" name="old_email">
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
						<label for="password">Password <span class="description">(required)</span></label>
						<div class="input">
							<input autocomplete="off" id="password" name="password" required="true" />
							<span class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</span>
						</div>
					</div>
					<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
					<input type="hidden" name='profile' value='true' />
			</fieldset>
			<div class="one-half">
				<a href="<?= BASE_URL; ?>install/step4/" class="btn medium secondary">Back</a>
			</div>
			<div class="textright one-half">
				<input name="submit" id= "fsubmit" type="submit" value="Submit" class="btn medium primary"/>
			</div>
		</form>
      </div>
   </div>
</div>
<? load::view('install/template-footer');?>