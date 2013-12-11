<? load::view('admin/partials/header', array('title' => 'Upgraded', 'assets' => array('application')));?>
<div id="wrap">
	<div class="full-content">
	    <div class="row">
	     	<h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Welcome to Tentacle <?= TENTACLE_VERSION; ?></h1>
			<div class="alert alert-success">
				Thank you for updating to the latest Code or Database version!
			</div>
			<h2>Authors</h2>
			<hr />
			<h3>Adam Patterson</h3>
			<p>
				<a href="http://twitter.com/adampatterson">http://twitter.com/adampatterson</a><br/>
				<a href="http://github.com/adampatterson">http://github.com/adampatterson</a><br/>
				<a href="http://www.adampatterson.ca">http://www.adampatterson.ca</a><br/>
			</p>

			<h2>Whats New</h2>
			<hr />
			Read the <a href="https://github.com/adampatterson/Tentacle/wiki/Changelog">release notes</a>.
		</div>
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>