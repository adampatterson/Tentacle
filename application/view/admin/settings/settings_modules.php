<? load::view('admin/templates/template-header', array('title' => 'Modules', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<div class="one-full">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Modules</h1>
			<a href="<?=ADMIN;?>content_add_page/" class="btn btn-primary">Install new Modules</a>
		</div>
		<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
			
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		
			<h2>Active Modules</h2>
			<div class="well">
				<p>These would be modules that are currently installed.</p>
			</div>
		
			<h2>Inactive Modules</h2>
			<div class="well">
				<p>Modules that are not installed, but that have been downloaded.</p>
			</div>
		
			<h2>Updates Available</h2>
			<div class="well">
				<p>Modules with updates.</p>
			</div>
			
		</form>
	</div>
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>