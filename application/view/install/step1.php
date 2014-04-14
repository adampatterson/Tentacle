<? load::view('install/template-header', array('title' => ''));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 1</small></h1>
    </div>
	<ul class="breadcrumb">
		<li class="active"><a href='#'>Overview</a></li>
		<li>System Check</li>
		<li>Database Information</li>
		<li>Testing the config file</li>
		<li>Create User</li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="col-md-12">
        <h2>Overview</h2>
	<p>Welcome to your install. Before getting started we need some information on the database. You will need to know the following items before proceeding.</p>
	<ol>
	  <li>Database name</li>
	  <li>Database username</li>
	  <li>Database password</li>
	  <li>Database host</li>
	</ol>
	<p><strong>If for any reason this automatic file creation doesn't work, don't worry. You may also open the <code>db-sample.php</code> in a text editor, fill in your information, and save it as <code>db.php</code>.</strong></p>
	<p>In all likelihood, these items were supplied to you by your Hosting Company. If you do not have this information, then you will need to contact them before you can continue.</p>
	<div class="one-half">
		&nbsp;
	</div>
	<div class="textright one-half">
		<a href="<?= BASE_URL; ?>install/step2/" class="btn btn-primary">let's go!</a>
	</div>
  </div>
</div>
</div>
<? load::view('install/template-footer');?>