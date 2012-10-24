<? load::view('admin/templates/template-header', array('title' => 'Resource', 'assets' => array('application')));?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Test Page</h1>
				</div>
			</div>
		</div>
		<div class="one-full">
			
			<script>$(function(){$.sticky('<b>Hello!</b><p>Sticky & Nice icons is here..</p>','icon arrowdown',{p:'ptc'})})</script>
			
			<div class="btn-group">
			<a class="btn" onclick="$.sticky('<b>Default!</b><p>Default message goes here..</p>');">Default</a>
			<a class="btn icon error" onclick="$.sticky('<b>Error!</b><p>Error message goes here..</p>', 'icon error', {p:'ptr'});">Error</a>
			<a class="btn icon info" onclick="$.sticky('<b>Info!</b><p>Info message goes here..</p>', 'icon info', {p:'ptr'});">Info</a>
			<a class="btn icon success" onclick="$.sticky('<b>Success!</b><p>Success message goes here..</p>', 'icon success', {p:'ptr'});">Success</a>
			<a class="btn icon quote" onclick="$('blockquote').sticky();">Quote</a>
			<a class="btn icon new-window" onclick="$('.block-message').sticky();">Block Message</a>
			<a class="btn icon remove" onclick="$.sticky('<b>Sticky!</b><p>Sticky message goes here..</p>', 'icon remove', {x:false,p:'ptr'});">Sticky message.</a>

			<a class="btn icon arrowdown" onclick="$.sticky('<b>Position!</b><p>Position bottom-left..</p>', 'icon arrowdown', {p:'pbl'});">Position: bottom-left</a>
			<a class="btn icon arrowright" onclick="$.sticky('<b>Position!</b><p>Position bottom-right..</p>', 'icon arrowright', {p:'pbr'});">Position: bottom-right</a>
			<a class="btn icon arrowup" onclick="$.sticky('<b>Position!</b><p>Position top-left..</p>', 'icon arrowup', {p:'ptl'});">Position: top-left</a>
			<a class="btn icon arrowup" onclick="$.sticky('<b>Position!</b><p>Position top-center..</p>', 'icon arrowup', {p:'ptc'});">Position: top-center</a>
			<a class="btn icon arrowdown" onclick="$.sticky('<b>Position!</b><p>Position bottom-center..</p>', 'icon arrowdown', {p:'pbc'});">Position: bottom-center</a>
			</div>
			
			<script type="text/javascript" src="<?=TENTACLE_JS; ?>notifications.js"></script>
			<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS; ?>notifications.css" />
		</div>
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>