<? load::view('admin/templates/template-header', array('title' => 'Manage Pages', 'assets' => array('application')));?>

<div id="wrap">
	<div class="title">
		<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage pages</h1>
		<a href="<?=ADMIN;?>content_add_page/" class="btn btn-primary">Add new page</a>
		<div class="title-search alignright">
			<script type="text/javascript">     
				function startSearch(event) {       
					document.getElementById("searchform").submit();     
				}
			</script>
			<input type="text" name="search" placeholder="Search" id="searchform" title="search" x-webkit-speech="" x-webkit-grammar="builtin:search" onwebkitspeechchange="startSearch()" />
		</div>
	</div>
	<div class="page-details">
		<div class="filter-links">
			<a href="<?= BASE_URL ?>admin/content_manage_pages/">All</a> | <a href="<?= BASE_URL ?>admin/content_manage_pages/published/">Published</a> | <a href="<?= BASE_URL ?>admin/content_manage_pages/draft/">Drafts</a> | <a href="<?= BASE_URL ?>admin/content_manage_pages/trash">Trash</a>
		</div>
		<!--
		<div class="pagination align-right textright">
			<em><strong>Displaying 21–40 of 197</strong></em><a href="#">«</a><a href="#">1</a><a href="#" class="current">2</a><a href="#">3</a><a href="#">»</a>
		</div>-->
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage_content">
		<thead>
			<tr>
				<th>Title</th>
				<th>&nbsp;</th>
				<th>Author</th>
				<th>ID</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<? foreach ($pages as $page_array):
			
			$page = (object)$page_array;
			
			$user_meta = $user->get_meta ( $page->author );
			?>
			<tr>
				<td>
					<div class="<? if ( isset( $page->level ) ) echo offset($page->level); ?>">
					<img src="<?=ADMIN_URL;?>images/icons/24_paper.png" width="24" height="24" alt="Page" /><strong class="title"><a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>"><?= $page->title ?></a></strong>
					</div> 
				</td>
				<td ><!--img src="<?=ADMIN_URL; ?>images/icons/16_note-dis.png" width="16" height="16" alt="Notes" /--></td>
				<td ><?= $user_meta->first_name?> <?= $user_meta->last_name?></td>
				<td ><?= $page->id?></td>
				<td><?= status_tag( $page->status ) ?></td>
				<td><a href="<?= ADMIN ?>content_add_page/<?= $page->id;?>" class="btn small">Add</a> <a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>" class="btn btn-small">Edit</a> <!-- <a href="#" class="btn small">Duplicate</a> --> <a href="<?= BASE_URL ?>action/trash_page/<?= $page -> id;?>" class="btn btn-small btn-danger">Trash</a></td>
				<!--<td><a href=""><img src="<?=ADMIN_URL;?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /></a> <img src="<?=ADMIN_URL;?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <a href="<?= ADMIN ?>content_add_page/<?= $page->id;?>" title="Add sub-page"><img src="<?=ADMIN_URL;?>images/icons/16_add.png" width="15" height="16" alt="Add" /></a></td>-->
			</tr>
			<? endforeach;?>
			<!--
			<tr>
			<td><img src="<?=ADMIN_URL; ?>images/icons/24_paper.png" width="24" height="24" alt="Page" /> <strong class="title">Home Page</strong></td>
			<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note-dis.png" width="16" height="16" alt="Notes" /></td>
			<td >Adam Patterson</td>
			<td >458</td>
			<td>Published</td>
			<td><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <img src="<?=ADMIN_URL; ?>images/icons/16_add.png" width="15" height="16" alt="Add" /></td>
			</tr>
			<tr>
			<td><img src="<?=ADMIN_URL; ?>images/icons/24_folder-closed.png" width="24" height="24" alt="Folder" /> <strong class="title">About Us</strong></td>
			<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note.png" width="16" height="16" alt="Notes" /></td>
			<td >Adam Patterson</td>
			<td >4</td>
			<td><strong>Pending</strong></td>
			<td><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <img src="<?=ADMIN_URL; ?>images/icons/16_add.png" width="15" height="16" alt="Add" /></td>
			</tr>
			<tr>
			<td><img src="<?=ADMIN_URL; ?>images/icons/24_folder-open.png" width="24" height="24" alt="Open Folder" /> <strong class="title">Design Articles</strong></td>
			<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note.png" width="16" height="16" alt="Notes" /></td>
			<td >Adam Patterson</td>
			<td >73</td>
			<td>Published</td>
			<td><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <img src="<?=ADMIN_URL; ?>images/icons/16_add.png" width="15" height="16" alt="Add" /></td>
			</tr>
			<tr>
			<td><div class="sub-page"><img src="<?=ADMIN_URL; ?>images/icons/24_paper.png" width="24" height="24" alt="Page" /><strong class="title"> Graphic Design</strong></div></td>
			<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note-dis.png" width="16" height="16" alt="Notes" /></td>
			<td >Adam Patterson</td>
			<td >386</td>
			<td><span class="red">Spam</span></td>
			<td><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <img src="<?=ADMIN_URL; ?>images/icons/16_add.png" width="15" height="16" alt="Add" /></td>
			</tr>
			<tr>
			<td><div class="sub-page"><img src="<?=ADMIN_URL; ?>images/icons/24_paper.png" width="24" height="24" alt="Page" /> <strong class="title">Contact Us</strong></div></td>
			<td ><img src="<?=ADMIN_URL; ?>images/icons/16_note.png" width="16" height="16" alt="Notes" /></td>
			<td >Adam Patterson</td>
			<td >86</td>
			<td><strong>Pending</strong></td>
			<td><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /> <img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /> <img src="<?=ADMIN_URL; ?>images/icons/16_add.png" width="15" height="16" alt="Add" /></td>
			</tr>
			-->
		</tbody>
	</table>
</div>
<!-- #wrap -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>
