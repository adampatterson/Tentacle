<? load::view('install/template-header', array('title' => '- Step 3'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 3</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>License</a><span class="divider">/</span></li>
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li>Testing the config file<span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Database Information</h2>
		<form method="post" action="<?= BASE_URL; ?>action/database">
		  <p>Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
		  
			<div class="clearfix">
				<label for="db_name">Database Name</label>
				<div class="input">
					<input name="db_name" type="text" size="25" value="" required='required' />
					<span class="help-block">The name of the database you want to run your script in.</span>
				</div>
			</div>
			<div class="clearfix">
				<label for="db_user">User Name</label>
				<div class="input">
					<input name="db_user" type="text" size="25" value="root" required='required' />
					<span class="help-block">Your MySQL username</span>
				</div>
			</div>
			<div class="clearfix">
				<label for="db_password">Password</label>
				<div class="input">
					<input name="db_password" type="text" size="25" value="root" required='required' />
					<span class="help-block">Your MySQL password.</span>
				</div>
			</div>
			<div class="clearfix">
				<label for="db_host">Database Host</label>
				<div class="input">
					<input name="db_host" type="text" size="25" value="localhost" required='required' />
					<span class="help-block">Most Likely  won't need to change this value.</span>
				</div>
			</div>
			<div class="one-half">
				<a href="<?= BASE_URL; ?>install/step2/" class="btn medium secondary">Back</a>
			</div>
			<div class="textright one-half">
				<input name="submit" id="submit" type="submit" value="Submit" class="btn medium primary"/>
			</div>
		</form>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>