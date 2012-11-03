<? load::view('install/template-header', array('title' => '- Step 4'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 4</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Testing the config file</a><span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span12">
        <h2>Testing the config file</h2>
		<? if (file_exists('application/config/deployment/db.php')): ?>
			<div class="alert alert-success">
				All right everything is ready to roll, Lets install the MySQL!
			</div>
			<div class="row">
				<div class="span6">
					<a href="<?= BASE_URL; ?>install/step3/" class="btn btn-danger">Back</a>
				</div>
				<div class="span6 pull-right">
					<a href="<?= BASE_URL; ?>install/step5/" class="btn btn-primary pull-right">Next</a>
				</div>
			</div>
		<? else: ?>
			<div class="alert alert-error">
				<p>Something went wrong.</p>
			</div>
			<div class="row">
				<div class="span6">
					<a href="<?= BASE_URL; ?>install/step3/" class="btn">Back</a>
				</div>
				<div class="span6  pull-right">
					<a href="#" class="btn btn-primary pull-right">Next</a>
				</div>
			</div>
		<? endif; ?>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>