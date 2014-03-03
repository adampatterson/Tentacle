<? load::view('admin/partials/header', array('title' => 'Manage Pages', 'assets' => array('application')));?>

<div id="wrap">
	<div class="title">
		<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage pages</h1>
		<a href="<?=ADMIN;?>content_add_page/" class="btn btn-primary">Add new page</a>
		<div class="title-search alignright hidden">
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
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage_content">
		<thead>
			<tr>
				<th>Title</th>
                <th width="150">Date</th>
                <th width="250">Author</th>
				<th width="75">ID</th>
				<th width="200"></th>
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
					<strong class="title"><a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>"><?= $page->title ?></a></strong> <?= status_tag( $page->status ) ?>
					</div> 
				</td>
                <td ><?= date::show($page->date, 'Y/m/d g:i a');?></td>
				<td ><?= $user_meta->first_name?> <?= $user_meta->last_name?></td>
				<td ><?= $page->id?></td>
				<td><a href="<?= ADMIN ?>content_add_page/<?= $page->id;?>" class="btn btn-small">Add</a> <a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>" class="btn btn-small">Edit</a> <!-- <a href="#" class="btn small">Duplicate</a> --> <a href="<?= BASE_URL ?>action/trash_page/<?= $page -> id;?>" class="btn btn-small btn-danger">Trash</a></td>
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
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
