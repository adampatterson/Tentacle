<? load::view('admin/partials/header', array('title' => 'Plugins', 'assets' => array('application')));?>

<div id="wrap">
	<div class="row">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Plugins</h1>
			<!--<a href="#" class="btn btn-primary">Install new Plugins</a>-->
		</div>
		<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
			
			<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		
			<h2>Active Plugins</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="active_plugins">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Version</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($plugins['enabled_plugins'] as $plugin_array):
					$plugin = (object)$plugin_array;

					?>
					<tr>
						<td>
							<strong><?= $plugin->name ?></strong>
						</td>
						<td >
							<?= $plugin->description ?> <br /><strong>by</strong> <?= $plugin->author['link'] ?>
						</td>
						<td >
							<span class="badge"><?= $plugin->version ?></span>
						</td>
						<td>
							<a href="<?= BASE_URL ?>action/disable_plugin/<?= $plugin->classes[0] ?>" class="btn btn-small btn-danger">Disable</a>
							<? if ($plugin->help != ''): ?>
								<a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>" class="btn btn-small">Help</a>
							<? endif; ?>	
						</td>
					</tr>
					<?endforeach;?>
				</tbody>
			</table>
		
			<h2>Inactive Plugins</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="inactive_plugins">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Version</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($plugins['disabled_plugins'] as $plugin_array):
					$plugin = (object)$plugin_array;

					?>
					<tr>
						<td>
							<strong><?= $plugin->name ?></strong>
						</td>
						<td >
							<?= $plugin->description ?> <br /><strong>by</strong> <?= $plugin->author['link'] ?>
						</td>
						<td >
							<span class="badge"><?= $plugin->version ?></span>
						</td>
						<td>
							<a href="<?= BASE_URL ?>action/enable_plugin/<?= $plugin->classes[0] ?>" class="btn btn-small btn-success">Activate</a>
							<? if ($plugin->help != ''): ?>
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
				<p>Plugins with updates.</p>
			</div>
		*/?>	
		</form>
	</div>
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>