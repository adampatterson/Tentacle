<? load::view( 'admin/partials/header',array( 'title'=>'Appearance settings','assets'=>array( 'application' ) ) ); ?>
<div id="wrap">
	<div class="title">
		<h1 class='align-left'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Appearance settings</h1>
		<a href="<?=ADMIN;?>content_add_page/" class="btn btn-primary">Install new Themes</a>
	</div>
	<div class="row">
		<h2>Installed Themes</h2>
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
		<h2>Broken themes.</h2>
		<ul class="theme-grid well">

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
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>