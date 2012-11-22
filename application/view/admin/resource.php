<? load::view('admin/partials/template-header', array('title' => 'Resource', 'assets' => array('fancybox')));?>
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

			<textarea id="element-to-edit" class="editor">asdsad</textarea>
        </div>
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/partials/template-footer', array( 'assets' => array( '' ) ) ); ?>