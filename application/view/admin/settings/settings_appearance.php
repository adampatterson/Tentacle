<? load::view('admin/template-header',array('title'=>'Appearance settings','assets'=>'application','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
	<div class="one-full">
    <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Appearance settings</h1>
			<ul class="theme-grid">
				<? foreach (get_themes() as $theme):  
					if ($theme->theme_id != 'empty'): ?>
					<li><a href="#">
							<img src="<?= $theme->screenshot ?>" width="210" height="150" alt="<?= $theme->theme_name ?>" class="thumbnail" />
						</a>
						<strong><?= $theme->theme_name ?></strong> <? current_theme($theme->theme_id); ?>
						<div class="well">
							<a class="btn small primary" href="<?= BASE_URL ?>action/update_settings/appearance/<?= $theme->theme_id ?>">Activate</a>
							<a class="btn small" href="#">Preview</a>
						</div>
						<? foreach (get_settings($theme->theme_id) as $setting): ?>
							<p><?= $setting->theme_description; ?></p>
						<? endforeach; ?>
					</li>
				 <? endif;
				endforeach; ?>
			</ul>
			<ul class="theme-grid">
				<? foreach (get_themes() as $theme):  
					if ($theme->theme_id == 'empty'): ?>
					<li>
						<strong><?= $theme->theme_name ?></strong> <span class="label important">Error</span>
						<? foreach (get_settings($theme->theme_id) as $setting): ?>
							<p><?= $setting->theme_description; ?></p>
						<? endforeach; ?>
					</li>
				 <? endif;
				endforeach; ?>
			</ul>
			<!--<h2>Appearance</h2>
			<hr />
			<p>Font type</p>
			<h2>Header</h2>
			<hr />
			<p>Title<br />
			Logo</p>
			<h2>Footer</h2>
			<hr />
			<p>Copyright<br />
			Links</p>-->
		</div>
	</div>
</div><!-- #wrap -->
<? load::view('admin/template-footer'); ?>