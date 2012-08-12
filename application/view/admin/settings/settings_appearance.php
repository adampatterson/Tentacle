<? load::view( 'admin/templates/template-header',array( 'title'=>'Appearance settings','assets'=>array( 'application' ) ) ); ?>
<? load::view('admin/templates/template-sidebar'); ?>
<div id="wrap">
	<div class="one-full">
    <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Appearance settings</h1>
			<ul class="theme-grid">
				<? foreach (get_themes() as $theme):  
					if ($theme->index != ''): ?>
					<li><a href="#">
							<a href="<?= BASE_URL ?>action/update_settings/appearance/<?= $theme->theme_id ?>"><img src="<?= $theme->screenshot ?>" width="210" height="150" alt="<?= $theme->theme_name ?>" class="thumbnail" /></a>
						</a>
						<strong><?= $theme->theme_name ?></strong> <? current_theme($theme->theme_id); ?>
						<div class="well">
							<a class="btn btn-small btn-primary" href="<?= BASE_URL ?>action/update_settings/appearance/<?= $theme->theme_id ?>">Activate</a>
							<!--<a class="btn small" href="#">Preview</a>-->
						</div>
						<? foreach (get_settings($theme->theme_id) as $setting): ?>
							<p><?= $setting->theme_description; ?></p>
						<? endforeach; ?>
					</li>
				 <? endif;
				endforeach; ?>
			</ul>
			<h2></h2>
			<ul class="theme-grid">
				<? foreach (get_themes() as $theme):  
					if ($theme->index == ''): ?>
					<li>
						<strong><?= $theme->theme_name ?></strong> <span class="label label-important">Error</span>
						<? foreach (get_settings($theme->theme_id) as $setting): ?>
							<p><?= $setting->theme_description; ?></p>
						<? endforeach; ?>
					</li>
				 <? endif;
				endforeach; ?>
			</ul>
			<? /* 
			<h2>Appearance</h2>
			<hr />
			<p>Font type</p>
			<h2>Header</h2>
			<hr />
			<p>Title<br />
			Logo</p>
			<h2>Footer</h2>
			<hr />
			<p>Copyright<br />
			Links</p>*/?>
		</div>
	</div>
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>