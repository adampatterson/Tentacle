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
			<div id="element-to-edit">asdsad</div>
			<script type="text/javascript" src="https://raw.github.com/PANmedia/Raptor/master/packages/raptor.0deps.min.js"></script>
			<script type="text/javascript">
			    
				$('#element-to-edit').editor({
				    autoEnable: true,            // Enable the editor automaticly
				    plugins: {                   // Plugin options
				        dock: {                  // Dock specific plugin options
				            docked: true,        // Start the editor already docked
				            dockToElement: true, // Dock the editor inplace of the element
				            persist: false       // Do not save the docked state
				        }
				    }
				});
			</script>
		</div>
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>