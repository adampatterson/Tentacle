<? load::view('admin/template-header', array('title' => 'Manage Posts', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div id="post-body">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage posts</h1>
			<a href="<?=ADMIN;?>content_add_post/" class="btn medium primary">Add new post</a>
			<div class="title-search alignright">
				<script type="text/javascript">     
					function startSearch(event) {       
						document.getElementById("searchform").submit();     
					}
				</script>
				<input type="text" name="search" placeholder="Search" id="searchform" title="search" x-webkit-speech="" x-webkit-grammar="builtin:search" onwebkitspeechchange="startSearch()" />
			</div>
		</div>
		<!--<div class="page-details">
			<div class="filter-links">
				<a href="#">All (197)</a> | <a href="#">Published (72)</a> | <a href="#">Drafts (125)</a> | <a href="#">Trash (1)</a>
			</div>
			<div class="pagination align-right textright">
				<em><strong>Displaying 21–40 of 197</strong></em><a href="#">«</a><a href="#">1</a><a href="#" class="current">2</a><a href="#">3</a><a href="#">»</a>
			</div>
		</div>-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead class="table-heading">
				<tr>
					<th>
					<!-- <input type="checkbox" class="check-all" /> -->
					Title</th>
					<th>Category</th>
					<th>&nbsp;</th>
					<th>Author</th>
					<th>ID</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($posts as $post):
					$user_meta = $user->get_meta ( $post->author );
				?>
				<tr>
					<td>
					<!-- <input type="checkbox" /> -->
					<img src="<?=ADMIN_URL;?>images/icons/24_paper.png" width="24" height="24" alt="Page" /><strong class="title"><a href="<?= ADMIN ?>content_update_post/<?= $post -> id;?>"><?= $post -> title;?></a></strong></td>
					<td>
						<?
						foreach( $relations = $category->get_relations( $post->id ) as $relation ): ?>
				            	 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
				        <? endforeach; ?>
					</td>
					<td ><!--<img src="<?=ADMIN_URL; ?>images/icons/16_note-dis.png" width="16" height="16" alt="Notes" />--></td>
					<td ><?= $user_meta -> first_name;?> <?= $user_meta -> last_name;?></td>
					<td ><?= $post -> id;?></td>
					<td><?= $post -> status;?></td>
					<td><a href="<?= ADMIN ?>content_update_post/<?= $post -> id;?>" class="btn small">Edit</a> <a href="<?= BASE_URL ?>action/trash_post/<?= $post -> id;?>" class="btn small danger">Trash</a></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
		<!--
		<div class="actions">
			<form name="form" id="form" action="post">
				<select name="jumpMenu" id="jumpMenu">
					<option>Actions</option>
					<option>Delete</option>
					<option>Edit</option>
				</select>
				<input type="button" value="Apply" class="btn medium" />
				<select name="jumpMenu1" id="jumpMenu1">
					<option>Show Dates</option>
				</select>
				<select name="jumpMenu2" id="jumpMenu2">
					<option>Show Categories</option>
				</select>
				<input type="button" value="Filter" class="btn medium" />
			</form>
		</div>
		-->
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
