<? load::view('admin/templates/template-header', array('title' => 'Upgraded', 'assets' => array('application')));?>
<? load::view('admin/templates/template-sidebar'); ?>
<div id="wrap">
	<div class="full-content">
	    <div class="one-full">
	     	<h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Welcome to Tentacle <?= TENTACLE_VERSION; ?></h1>
			<div class="alert alert-success">
				Thank you for updating to the latest version!
			</div>
			<h2>Authors</h2>
			<hr />
			<h3>Adam Patterson</h3>
			<p>
				<a href="http://twitter.com/adampatterson">http://twitter.com/adampatterson</a><br/>
				<a href="http://github.com/adampatterson">http://github.com/adampatterson</a><br/>
				<a href="http://www.adampatterson.ca">http://www.adampatterson.ca</a><br/>
			</p>
			
			<h3>Brendan Taylor</h3>
			<p>
				<a href="http://twitter.com/beect">http://twitter.com/beect</a><br/>
				<a href="https://github.com/bct">https://github.com/bct</a><br/>
				<a href="http://diffeq.com/bct">http://diffeq.com/bct</a><br/>
			</p>
			
			<h2>Hommage</h2>
			<hr />
			<ul>
				<li>jQuery</li>
				<li>Dingo Framework</li>
				<li>Bootstrap, from Twitter</li>
				<li>CKEditor</li>
				<li>Code Mirror</li>
				<li>HTML5 Shive</li>
				<li>Sisyphus</li>
				<li>Spin</li>
				<li>Modernizer</li>
				<li>jQuery History</li>
				<li>jQuery Validate</li>
				<li>jQuery Input Tags</li>
			</ul>
			
			<h2>Whats New</h2>
			<hr />
			Read the <a href="https://github.com/adampatterson/Tentacle/wiki/Changelog">release notes</a>.
		</div>
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>