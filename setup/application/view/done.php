<? load::view('template-header', array('title' => '- Done '));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Complete</small></h1>
    </div>
    <div class="row">
      <div class="span14">
        <h2>Done</h2>

		<p>Delete this folder</p>
		<p>Go to your admin screen</p>

		<div class="one-half">
			<a href="<?= BASE_URL; ?>setup/install/step5/" class="btn medium secondary">Back</a>
		</div>
		<div class="textright one-half">
			&nbsp;
		</div>
      </div>
    </div>
  </div>
<? load::view('template-footer');?>