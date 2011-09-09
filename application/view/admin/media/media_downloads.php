<? load::view('admin/template-header', array('title' => 'Media downloads', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div id="post-body">
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Media downloads</h1>
			<div class="one-half">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th style="text-align: center;" scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">URL</th>
							<th scope="col">Added on</th>
							<th scope="col">Downloads</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<thead></thead>
					<tbody id="the-list">
						<tr class="alternate" id="download-1">
							<td style="text-align: center;" scope=""><strong>1</strong></td>
							<td>Test</td>
							<td><a href="http://www.adampatterson.ca/wp-content/uploads/2011/03/5206049392_154bf43547_o.jpg">Without counter</a> | <a href="http://www.adampatterson.ca/downloads/Test">With counter</a></td>
							<td>2011-03-28 20:57:42</td>
							<td>0</td>
							<td><img src="<?=ADMIN_URL;?>images/icons/16_charts-bar.png" width="16" height="16" alt="View Stats" /><img src="<?=ADMIN_URL;?>images/icons/16_refresh.png" width="16" height="16" alt="Reset views" /><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
						</tr>
						<tr class="alternate" id="download-1">
							<td style="text-align: center;" scope=""><strong>1</strong></td>
							<td>Test</td>
							<td><a href="http://www.adampatterson.ca/wp-content/uploads/2011/03/5206049392_154bf43547_o.jpg">Without counter</a> | <a href="http://www.adampatterson.ca/downloads/Test">With counter</a></td>
							<td>2011-03-28 20:57:42</td>
							<td>0</td>
							<td><img src="<?=ADMIN_URL;?>images/icons/16_charts-bar.png" width="16" height="16" alt="View Stats" /><img src="<?=ADMIN_URL;?>images/icons/16_refresh.png" width="16" height="16" alt="Reset views" /><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
						</tr>
						<tr class="alternate" id="download-1">
							<td style="text-align: center;" scope=""><strong>1</strong></td>
							<td>Test</td>
							<td><a href="http://www.adampatterson.ca/wp-content/uploads/2011/03/5206049392_154bf43547_o.jpg">Without counter</a> | <a href="http://www.adampatterson.ca/downloads/Test">With counter</a></td>
							<td>2011-03-28 20:57:42</td>
							<td>0</td>
							<td><img src="<?=ADMIN_URL;?>images/icons/16_charts-bar.png" width="16" height="16" alt="View Stats" /><img src="<?=ADMIN_URL;?>images/icons/16_refresh.png" width="16" height="16" alt="Reset views" /><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
						</tr>
						<tr class="alternate" id="download-1">
							<td style="text-align: center;" scope=""><strong>1</strong></td>
							<td>Test</td>
							<td><a href="http://www.adampatterson.ca/wp-content/uploads/2011/03/5206049392_154bf43547_o.jpg">Without counter</a> | <a href="http://www.adampatterson.ca/downloads/Test">With counter</a></td>
							<td>2011-03-28 20:57:42</td>
							<td>0</td>
							<td><img src="<?=ADMIN_URL;?>images/icons/16_charts-bar.png" width="16" height="16" alt="View Stats" /><img src="<?=ADMIN_URL;?>images/icons/16_refresh.png" width="16" height="16" alt="Reset views" /><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
						</tr>
					</tbody>
				</table>
				<div class="actions">
					<input type="submit" value="Add download" class="btn medium secondary">
				</div>
			</div>
			<div class="one-half">
				<div class="clearfix">
					<label> Use pretty links</label>
					<div class="input">
						<input type="checkbox" checked="checked" id="pretty_links" value="1" name="pretty_links">
						<span class="help-block">When this checkbox is checked, the plugin will generate URL's using the slug defined below. When this checkbox in not checked, download links will be generated as /?download=&lt;name&gt;</span>
					</div>
				</div>
				<div class="clearfix">
					<label>Download slug</label>
					<div class="input">
						<input type="text" value="downloads" id="download_slug" name="download_slug">
						<span class="help-block"> After changing this value, you should update the Permalink structure at <a href="options-permalink.php">this</a> page, before the new download slug will work. Since the download URL's created by this plugin are already changed, your visitors will receive a not found page untill you update the Permalink structure. </span>
					</div>
				</div>
				<div class="clearfix">
					<label>Items per page</label>
					<div class="input">
						<input type="text" value="500" id="items_per_page" name="items_per_page">
						<span class="help-block">Specify the amount of logs you will see on each page.</span>
					</div>
				</div>
				<div class="actions">
					<input type="submit" value="Save changes" name="submit" class="btn medium secondary">
				</div>
			</div>
		</div>
		<!-- #post-body -->
	</div>
	<!-- #wrap -->
	<? load::view('admin/template-footer');?>
