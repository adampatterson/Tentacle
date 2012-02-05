<? load::view('install/template-header', array('title' => '- Step 4'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 4</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>License</a><span class="divider">/</span></li>
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Testing the config file</a><span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Testing the config file</h2>
		<? if (file_exists('application/config/deployment/db.php')): ?>
			<div class="alert-message success">
				<p><strong>✔</strong> All right everything is ready to roll, Lets install the MySQL!</p>
			</div>
			<div class="one-half">
				<a href="<?= BASE_URL; ?>install/step3/" class="btn medium danger">Back</a>
			</div>
			<div class="textright one-half">
				<a href="<?= BASE_URL; ?>install/step5/" class="btn medium primary">Next</a>
			</div>
		<? else: ?>
			<div class="alert-message error">
				<p><strong>✘</strong> Something went wrong.</p>
			</div>
			<div class="one-half">
				<a href="<?= BASE_URL; ?>install/step3/" class="btn medium secondary">Back</a>
			</div>
			<div class="textright one-half">
				<a href="#" class="btn medium primary disabled">Next</a>
			</div>
		<? endif; ?>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>