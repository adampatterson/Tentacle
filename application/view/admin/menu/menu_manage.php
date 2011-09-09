<? load::view('admin/template-header', array('title' => 'Manage menus', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="one-full">
		<div class="title pad-right">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage menus</h1>
			<input type="button" class="button" value="Add new menu" name="new_menu">
		</div>
		<hr class="space"/>
		<div class="one-half">
			<div class="table">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vestibulum ligula eget ipsum gravida eget elementum libero volutpat. Etiam viverra sapien massa, a imperdiet purus. Aliquam porttitor lorem id ante hendrerit vitae commodo erat laoreet. Sed enim risus, lobortis vel semper at, tincidunt a enim. Nam tortor felis, vehicula vel pharetra eu, cursus in dolor. Fusce quis eros vel turpis tristique varius. Curabitur varius feugiat sollicitudin. Donec facilisis turpis eu lorem vestibulum in fermentum augue varius. Cras vitae tortor eget erat sagittis tristique eu nec erat. Mauris in risus id ligula iaculis hendrerit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse accumsan odio vitae tellus fringilla interdum. Cras quis aliquet elit. Donec quis mauris arcu. Curabitur varius sodales quam, sed ultricies nulla auctor in. Donec eget diam lorem. Integer aliquam lacus a nisl gravida congue. Pellentesque quam nisl, hendrerit vitae facilisis nec, consequat sit amet metus.
				</p>
			</div>
		</div>
		<div class="one-half">
			<div class="table">
				<div id="post-body-content2">
					<div>
						<p>
							To create a custom menu, give it a name above and click Create Menu. Then choose items like pages,   categories or custom links from the left column to add to this menu.
						</p>
						<p>
							After   you have added your items, drag and drop to put them in the order you   want. You can also click each item to reveal additional configuration   options.
						</p>
						<p>
							When you have finished building your custom menu, make sure you click the Save Menu button.
						</p>
					</div>
				</div>
				<p>
					&nbsp;
				</p>
			</div>
		</div>
	</div>
</div><!-- #wrap -->
<? load::view('admin/template-footer');?>