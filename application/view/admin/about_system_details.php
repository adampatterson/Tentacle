<? load::view('admin/template-header',array('title'=>'System Details','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			    <div class="one-full">
			     <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> System Details</h1>
					<div class="one-half">
						<strong>Server Requirements:</strong>
						<ul>
							<li>PHP 5.2</li>
							<li>MySQL 4.1.2</li>
							<li>Apache Mod URL</li>
						</ul>
						<strong>Browser Support:</strong>
						<ul>
							<li>Chrome 4+</li>
							<li>Firefox 3.5+</li>
							<li>Opera 10.5+</li>
							<li>Safari 4+</li>
							<li>IE 8+</li>
						</ul>
					</div>
					<div class="one-half">
						<strong>Other Libraries used:</strong>
						<ul>
							<li>jQuery</li>
							<li>Dingo Framework</li>
							<li>Bootstrap, from Twitter</li>
							<li>markIt Up!</li>
							<li>HTML5 Shive</li>
							<li>Sisyphus</li>
							<li>Spin</li>
							<li>Modernizer</li>
							<li>jQuery History</li>
							<li>jQuery Validate</li>
							<li>jQuery Input Tags</li>
						</ul>
					</div>
				</div>
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/template-footer'); ?>