<? load::view('admin/template-header', array('title' => 'Manage comments', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div id="post-body">
		<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage comments</h1>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead class="table-heading">
				<tr>
					<th>
					<input type="checkbox" class="check-all" />
					Author</th>
					<th>Comment</th>
					<th>In response to</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_megaphone.png" width="24" height="24" alt="Megaphone" /> Adam Patterson</td>
					<td >Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<br />
					Vestibulum posuere, urna eu rhoncus consequat....</td>
					<td >Appcelerator Acquires Aptana</td>
					<td>Published</td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_megaphone.png" width="24" height="24" alt="Megaphone" /> Adam Patterson</td>
					<td >Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<br />
					Vestibulum posuere, urna eu rhoncus consequat....</td>
					<td >HTML5 To Save The Day!</td>
					<td><strong>Pending</strong></td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_megaphone.png" width="24" height="24" alt="Megaphone" /> Adam Patterson</td>
					<td >Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<br />
					Vestibulum posuere, urna eu rhoncus consequat....</td>
					<td >Vivian Maier &ndash; Unscene Photographer</td>
					<td>Published</td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_megaphone.png" width="24" height="24" alt="Megaphone" /> Adam Patterson</td>
					<td >Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<br />
					Vestibulum posuere, urna eu rhoncus consequat....</td>
					<td >TED: How YouTube is driving innovation</td>
					<td><span class="red">Spam</span></td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
				<tr>
					<td>
					<input type="checkbox" />
					<img src="<?=ADMIN_URL;?>images/icons/24_megaphone.png" width="24" height="24" alt="Megaphone" /> Adam Patterson</td>
					<td >Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<br />
					Vestibulum posuere, urna eu rhoncus consequat....</td>
					<td >We All Want To Be Young</td>
					<td><strong>Pending</strong></td>
					<td><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /><img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></td>
				</tr>
			</tbody>
		</table>
		<div class="actions">
			<form name="form" id="form" class="form-stacked">
				<select name="jumpMenu" id="jumpMenu">
					<option>Actions</option>
					<option>Delete</option>
					<option>Edit</option>
				</select>
				<input type="button" value="Apply" class="btn secondary" />
			</form>
		</div>
	</div>
	<!-- #post-body -->
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
