<? load::view('install/template-header', array('title' => '- Step 3'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 3</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li>Testing the config file<span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span12">
        <h2>Database Information</h2>
		<form method="post" action="<?= BASE_URL; ?>action/database" class="form-horizontal">
		  <p>Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
		  	<div class="clearfix">
		  		<div id="confirm_db"></div>
		  	</div>
			<div class="control-group">
				<label for="db_name" class="control-label">Database Name</label>
				<div class="controls">
					<input name="db_name" type="text" size="25" value="" required='required' />
					<span class="help-block">The name of the database you want to run your script in.</span>
				</div>
			</div>
			
			<div class="control-group">
				<label for="db_host" class="control-label">Database Host</label>
				<div class="controls">
					<input name="db_host" type="text" size="25" value="localhost" required='required' />
					<span class="help-block">Most Likely  won't need to change this value.</span>
				</div>
			</div>
			
			<div class="control-group">
				<label for="db_user" class="control-label">User Name</label>
				<div class="controls">
					<input name="db_user" type="text" size="25" value="root" required='required' />
					<span class="help-block">Your MySQL username</span>
				</div>
			</div>
			
			<div class="control-group">
				<label for="db_password" class="control-label">Password</label>
				<div class="controls">
					<input name="db_password" type="text" size="25" value="root" required='required' />
					<span class="help-block">Your MySQL password.</span>
				</div>
			</div>
			
			<div class="row">
				<div class="span6">
					<a href="<?= BASE_URL; ?>install/step2/" class="btn medium secondary">Back</a>
				</div>
			
				<div class="span6 pull-right">
					<input name="submit" id="submit" type="submit" value="Submit" class="btn btn-primary pull-right"/>
				</div>
			</div>
		</form>
      </div>
    </div>
<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($) {

		$('input[name=db_password]').bind('keyup focus', function() {

			$.post(base_url + 'ajax/confirm_database', {
					server: $('input[name=db_host]').val(),
					username: $('input[name=db_user]').val(),
					password: $('input[name=db_password]').val()
				}, function(data) {
					if (data.success == 'true') {
						$('#confirm_db').html(data.message).removeClass('alert alert-error').addClass('alert alert-success');
					} else {
						$('#confirm_db').html(data.message).removeClass('alert alert-success').addClass('alert alert-error');
					}
				}, 'json'
			);
		});
	});
</script>
  </div>
<? load::view('install/template-footer');?>