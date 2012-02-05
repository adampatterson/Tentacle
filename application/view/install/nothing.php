<? load::view('install/template-header', array('title' => '- Done '));?>
  <div class="content">
    <div class="page-header">
      <h1>Already Installed </h1>
    </div>
    <div class="row">
      <div class="span14">
        <h2>Congratulations!</h2>
		<div class="alert-message block-message success">
			<p>Looks like Tentacle has already been installed.</p>
			<div class="alert-actions">
		    	<a class="btn large success" href="<?= BASE_URL ?>admin/">Log in</a>
		  </div>
		</div>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>