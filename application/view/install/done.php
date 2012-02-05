<? load::view('install/template-header', array('title' => '- Done '));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Complete</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>License</a><span class="divider">/</span></li>
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li><a href='#'>Testing the config file</a><span class="divider">/</span></li>
		<li>Create User</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Done</a></li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Congratulations!</h2>
		<div class="alert-message block-message success">
			<h3>You have successfully installed Tentacle CMS.</h3>
			<ul>
				<li>Documentation</li>
				<li>Freedoms</li>
				<li>Feedback</li>
				<li>Credits</li>
			</ul>
			<div class="alert-actions">
			    <a class="btn large success" href="<?= BASE_URL ?>admin/">Log in</a>
			</div>
		</div>
		<div class="alert-message error">
		  <p>Make sure to delete the <strong>Setup</strong> folder!</p>
		</div>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>