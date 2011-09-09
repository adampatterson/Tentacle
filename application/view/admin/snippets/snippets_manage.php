<? load::view('admin/template-header', array('title' => 'Manage snippets','assets'=>'application')); ?>
<? load::view('admin/template-sidebar'); ?>
<div id="wrap">
  <div class="has-right-sidebar">
    <div class="contet-sidebar">
      <h3>What is a Snippet?</h3>
      <p>Snippets are generally small pieces of content which are included in other pages or layouts.</p>
      <h3>Tag to use this snippet</h3>
      <p>Just replace <strong>snippet</strong> by the snippet name you want to include.</p>
      <p>&lt;?php $this-&gt;includeSnippet('snippet'); ?&gt;</p>
    </div>
    <div id="post-body">
      <div id="post-body-content">
      	<div class="title pad-right">
        	<h1 class="title align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage snippets</h1>
			<a href="<?=ADMIN; ?>snippets_add/" class="btn medium primary">Add new snippet</a>       	 	
       	</div>
        <div class="table">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead class="table-heading">
              <tr>
                <th>Title</th>
				<th>Slug</th>
                <th>ID</th>
				<th>Filter</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
				<? foreach ($snippets as $snippet): ?>
					<tr>
						<td><img src="<?=ADMIN_URL; ?>images/icons/24_script.png" width="24" height="24" alt="Page" /> <strong class="title"><?= $snippet->name; ?></strong></td>
						<td><?= $snippet->slug; ?></td>
						<td><?= $snippet->id; ?></td>
						<td><?= $snippet->filter; ?></td>                
						<td><a href="<?= ADMIN ?>snippets_edit/<?= $snippet->id ?>"><img src="<?=ADMIN_URL; ?>images/icons/16_edit.png" width="16" height="16" alt="Edit" /></a> <a href="<?= ADMIN ?>snippets_delete/<?= $snippet->id ?>"><img src="<?=ADMIN_URL; ?>images/icons/16_delete.png" width="16" height="16" alt="Delete" /></a></td>
					</tr>
				<? endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');
 ?>
