<? load::view('template-header', array('title' => '- Step 5'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 5</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>License</a><span class="divider">/</span></li>
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li><a href='#'>System Check</a><span class="divider">/</span></li>
		<li><a href='#'>Database Information</a><span class="divider">/</span></li>
		<li><a href='#'>Testing the config file</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Build Database</a><span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Creating Database Schema.</h2>
		<div class="one-half">
			<a href="<?= BASE_URL; ?>setup/install/step4/" class="btn medium secondary">Back</a>
		</div>
		<div class="textright one-half">
			<a href="<?= BASE_URL; ?>setup/install/step6/" class="btn medium primary">Next</a>
		</div>
      </div>
    </div>
  </div>
<? load::view('template-footer');?>