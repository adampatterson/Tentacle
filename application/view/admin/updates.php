<? load::view('admin/templates/template-header', array('title' => 'Upgraded', 'assets' => array('application')));?>
<div id="wrap">
	<div class="full-content">
	    <div class="one-full">
	     	<h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Updates available</h1>

			<? if ( get_db_version() != get_current_db_version() ): ?>
				<a href="<?=BASE_URL; ?>action/do_db_upgrade/" class="btn btn-success">Update the Database</a>
			<? else:?>
				<a href="<?=BASE_URL; ?>action/do_core_upgrade/" class="btn btn-success">Update Tentacle</a>
			<? endif; ?>
			
			<h2>Whats new in this release</h2>
			<hr />
			<p>Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad.</p>
			
			<h2>Themes</h2>
			<div class="well">
				<p>Everything is up to date.</p>
			</div>
			
			<h2>Modules</h2>
			<div class="well">
				<p>Everything is up to date.</p>
			</div>
		</div>
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>