<? load::view('template-header', array('title' => '- Done '));?>
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
		<li><a href='#'>Build Database</a><span class="divider">/</span></li>
		<li>Create User</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>Done</a></li>
	</ul>
    <div class="row">
      <div class="span14">
        <h2>Done</h2>

		<p>Delete this folder</p>
		<p>Go to your <a href="<?= BASE_URL ?>admin/">admin screen</a></p>

		<div class="one-half">
			&nbsp;
		</div>
		<div class="textright one-half">
			&nbsp;
		</div>
      </div>
    </div>
  </div>
<? load::view('template-footer');?>