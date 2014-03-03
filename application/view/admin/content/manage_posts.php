<? load::view('admin/partials/header', array('title' => 'Manage Posts', 'assets' => array('application')));?>

<div id="wrap">
	<div id="post-body">
		<div class="title">
			<h1 class="align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage posts</h1>
			<a href="<?=ADMIN;?>content_add_post/" class="btn btn-primary">Add new post</a>
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
				<a href="<?= BASE_URL ?>admin/content_manage_posts/">All</a> | <a href="<?= BASE_URL ?>admin/content_manage_posts/published/">Published</a> | <a href="<?= BASE_URL ?>admin/content_manage_posts/draft/">Drafts</a> | <a href="<?= BASE_URL ?>admin/content_manage_posts/trash">Trash</a>
			</div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage_content">
			<thead class="table-heading">
				<tr>
					<th>Title</th>
					<th>Category</th>
                    <th width="150">Date</th>
					<th width="250">Author</th>
					<th width="75">ID</th>
					<th width="200"></th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($posts as $post):
					$user_meta = $user->get_meta ( $post->author );
				?>
				<tr>
					<td>
                     <strong class="title"><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>"><?= $post->title;?></a></strong> <?= status_tag( $post->status ) ?></td>
					<td>
						<? foreach( $relations = $category->get_relations( $post->id ) as $relation ): ?>
				            	 <a href="#<?=$relation->slug ?>"><?= $relation->name ?></a>
				        <? endforeach; ?>
					</td>
                    <td ><?= date::show($post->date, 'Y/m/d g:i a');?></td>
					<td ><?= $user_meta->first_name;?> <?= $user_meta->last_name;?></td>
					<td ><?= $post->id;?></td>
					<td><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>" class="btn btn-small">Edit</a> <a href="<?= BASE_URL ?>action/trash_post/<?= $post->id;?>" class="btn btn-small btn-danger">Trash</a></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>
