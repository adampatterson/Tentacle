<? load::view('admin/template-header', array('title' => 'Create a new menu','assets'=>'application')); ?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="has-right-sidebar">
		<div class="contet-sidebar">
			<div class="table">
				<div class="table-heading">
					<h3>Custome URL</h3>
				</div>
				<div class="table-content">
					<input type="hidden" name="menu-item[-1][menu-item-type]" value="custom">
					<p >
						<label for="custom-menu-item-url" class="howto">URL</label>
						<input type="text" value="http://" class="code menu-item-textbox" name="menu-item[-1][menu-item-url]" id="custom-menu-item-url">
					</p>
					<p>
						<label for="custom-menu-item-name" class="howto"> Label</label>
						<input type="text" title="Menu Item" class="regular-text menu-item-textbox input-with-default-title" name="menu-item[-1][menu-item-title]" id="custom-menu-item-name">
					</p>
					<div class="actions">
						<img alt="" src="http://www.adampatterson.ca/wp-admin/images/wpspin_light.gif" class="waiting" style="display: none;">
						<input type="submit" id="submit-customlinkdiv" name="add-custom-menu-item" value="Add to Menu" class="button">
					</div>
				</div>
			</div>
			<div class="table">
				<div class="table-heading">
					<h3>Posts</h3>
				</div>
				<div class="table-content">
					<div class="search">
						<p>
							<input type="text" name="quick-search-posttype-post" value="" title="Search" class="quick-search input-with-default-title" autocomplete="off">
							<input type="submit" value="Search" class="button" id="submit" name="submit">
						</p>
					</div>
					<ul class="categorychecklist form-no-clear" id="postchecklist-most-recent">
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2720" name="menu-item[-2][menu-item-object-id]" class="menu-item-checkbox">
								<span>The works!</span>
							</label>
						</li>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2627" name="menu-item[-3][menu-item-object-id]" class="menu-item-checkbox">
								<span>The Creative Process, Know when to say no.</span>
							</label>
						</li>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2692" name="menu-item[-4][menu-item-object-id]" class="menu-item-checkbox">
								<span>TED - The Power of Cartoons</span>
							</label>
						</li>
					</ul>
					<div class="actions">
						<a class="select-all" href="/wp-admin/nav-menus.php?menu=687&amp;post-tab=all&amp;selectall=1#posttype-post">Select All</a>
						<input type="submit" id="submit-posttype-post" name="add-post-type-menu-item" value="Add to Menu" class="button">
					</div>
				</div>
			</div>
			<div class="table">
				<div class="table-heading">
					<h3>Page</h3>
				</div>
				<div class="table-content">
					<div class="search">
						<p>
							<input type="text" name="quick-search-posttype-post" value="" title="Search" class="quick-search input-with-default-title" autocomplete="off">
							<input type="submit" value="Search" class="button" id="submit" name="submit">
						</p>
					</div>
					<ul class="categorychecklist form-no-clear" id="postchecklist-most-recent">
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2720" name="menu-item[-2][menu-item-object-id]" class="menu-item-checkbox">
								<span>The works!</span>
							</label>
						</li>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2627" name="menu-item[-3][menu-item-object-id]" class="menu-item-checkbox">
								<span>The Creative Process, Know when to say no.</span>
							</label>
						</li>
						<li>
							<label class="menu-item-title">
								<input type="checkbox" value="2692" name="menu-item[-4][menu-item-object-id]" class="menu-item-checkbox">
								<span>TED - The Power of Cartoons</span>
							</label>
						</li>
					</ul>
					<div class="actions">
						<a class="select-all" href="/wp-admin/nav-menus.php?menu=687&amp;post-tab=all&amp;selectall=1#posttype-post">Select All</a>
						<input type="submit" id="submit-posttype-post" name="add-post-type-menu-item" value="Add to Menu" class="button">
					</div>
				</div>
			</div>
		</div>
		<div id="post-body">
			<div id="post-body-content">
				<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Create a new menu</h1>
				<p>
					<label>Menu Title</label>
					<input type="text" />
				</p>
				<p>
					<label>Menu Slug</label>
					<input type="text" />
				</p>
				<div class="flash info">
					<a href="#" class="close">
					<img src="http://tcms.me//tentacle/admin/images/close.png">
					</a> The slug is used in the menu function
					<code>custom_menu('slug')</code>.
				</div>
				<div class="menu-item">
					<div class="content-box column-right">
						<div class="content-box-header table-heading">
							<!-- Add the class "closed" to the Content box header to have it closed by
							default -->
							<h3>Menu Item</h3>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content table-content">
							<div class="tab-content default-tab">
								<h4>This box is closed by default</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.</p>
							</div> <!-- End #tab3 -->
						</div> <!-- End .content-box-content -->
					</div> <!-- End .content-box -->
					<div class="content-box column-right closed-box">
						<div class="content-box-header table-heading">
							<!-- Add the class "closed" to the Content box header to have it closed by
							default -->
							<h3>Menu Item</h3>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content table-content">
							<div class="tab-content default-tab">
								<h4>This box is closed by default</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.</p>
							</div> <!-- End #tab3 -->
						</div> <!-- End .content-box-content -->
					</div> <!-- End .content-box -->
					<div class="content-box column-right closed-box">
						<div class="content-box-header table-heading">
							<!-- Add the class "closed" to the Content box header to have it closed by
							default -->
							<h3>Menu Item</h3>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content table-content">
							<div class="tab-content default-tab">
								<h4>This box is closed by default</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.</p>
							</div> <!-- End #tab3 -->
						</div> <!-- End .content-box-content -->
					</div> <!-- End .content-box -->
					<div class="content-box column-right closed-box">
						<div class="content-box-header table-heading">
							<!-- Add the class "closed" to the Content box header to have it closed by
							default -->
							<h3>Menu Item</h3>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content table-content">
							<div class="tab-content default-tab">
								<h4>This box is closed by default</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.</p>
							</div> <!-- End #tab3 -->
						</div> <!-- End .content-box-content -->
					</div> <!-- End .content-box -->
					<div class="content-box column-right closed-box">
						<div class="content-box-header table-heading">
							<!-- Add the class "closed" to the Content box header to have it closed by
							default -->
							<h3>Menu Item</h3>
						</div> <!-- End .content-box-header -->
						<div class="content-box-content table-content">
							<div class="tab-content default-tab">
								<h4>This box is closed by default</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.</p>
							</div> <!-- End #tab3 -->
						</div> <!-- End .content-box-content -->
					</div> <!-- End .content-box -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
