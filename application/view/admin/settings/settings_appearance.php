<? load::view('admin/template-header',array('title'=>'Appearance settings','assets'=>'application','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
	<div class="one-full">
    <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Appearance settings</h1>
		<div class="one-half">
			<p>
				Choose a Template
			</p>
			<? foreach ($themes_list as $theme): 
				clean_out($theme);
			 endforeach; ?>
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
			Links</p>
		</div>
		<div class="one-half">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vestibulum ligula eget ipsum gravida eget elementum libero volutpat. Etiam viverra sapien massa, a imperdiet purus. Aliquam porttitor lorem id ante hendrerit vitae commodo erat laoreet. Sed enim risus, lobortis vel semper at, tincidunt a enim. Nam tortor felis, vehicula vel pharetra eu, cursus in dolor. Fusce quis eros vel turpis tristique varius. Curabitur varius feugiat sollicitudin. Donec facilisis turpis eu lorem vestibulum in fermentum augue varius. Cras vitae tortor eget erat sagittis tristique eu nec erat. Mauris in risus id ligula iaculis hendrerit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse accumsan odio vitae tellus fringilla interdum. Cras quis aliquet elit. Donec quis mauris arcu. Curabitur varius sodales quam, sed ultricies nulla auctor in. Donec eget diam lorem. Integer aliquam lacus a nisl gravida congue. Pellentesque quam nisl, hendrerit vitae facilisis nec, consequat sit amet metus.
			</p>
		</div>
	</div>
</div><!-- #wrap -->
<? load::view('admin/template-footer'); ?>