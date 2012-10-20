<? load::view('admin/templates/template-header', array('title' => 'Modules', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar');?>
<div id="wrap">
	<div class="one-full">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Modules</h1>
			<a href="#" class="btn btn-primary">Install new Modules</a>
		</div>
		<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
			
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		
			<h2>Active Modules</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="active_modules">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Version</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($modules['enabled_modules'] as $module_array):
					$module = (object)$module_array;

					?>
					<tr>
						<td>
							<strong><?= $module->name ?></strong>
						</td>
						<td >
							<?= $module->description ?> <br /><strong>by</strong> <?= $module->author['link'] ?>
						</td>
						<td >
							<span class="badge"><?= $module->version ?></span>
						</td>
						<td>
							<a href="<?= BASE_URL ?>action/disable_module/<?= $module->classes[0] ?>" class="btn btn-small btn-danger">Disable</a>
							<? if ($module->help != ''): ?>
								<a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>" class="btn btn-small">Help</a>
							<? endif; ?>	
						</td>
					</tr>
					<?endforeach;?>
				</tbody>
			</table>
		
			<h2>Inactive Modules</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="inactive_modules">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Version</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($modules['disabled_modules'] as $module_array):
					$module = (object)$module_array;

					?>
					<tr>
						<td>
							<strong><?= $module->name ?></strong>
						</td>
						<td >
							<?= $module->description ?> <br /><strong>by</strong> <?= $module->author['link'] ?>
						</td>
						<td >
							<span class="badge"><?= $module->version ?></span>
						</td>
						<td>
							<a href="<?= BASE_URL ?>action/enable_module/<?= $module->classes[0] ?>" class="btn btn-small btn-success">Activate</a>
							<? if ($module->help != ''): ?>
								<a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>" class="btn btn-small">Help</a>
							<? endif; ?>	
						</td>
					</tr>
					<?endforeach;?>
				</tbody>
			</table>
		<? /* 
			<h2>Updates Available</h2>
			<div class="well">
				<p>Modules with updates.</p>
			</div>
		*/?>	
		</form>
	</div>
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>