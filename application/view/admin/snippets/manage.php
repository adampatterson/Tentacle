<? load::view('admin/partials/template-header', array('title' => 'Manage snippets','assets'=>array('application'))); ?>
<div id="wrap">
  <div class="has-right-sidebar">
    <div class="contet-sidebar">
      <h3>What is a Snippet?</h3>
      <p>Snippets are generally small pieces of content which are included in other pages or layouts.</p>
      <h3>Tag to use this snippet</h3>
      <p>Just replace <strong>snippet</strong> by the snippet name you want to include.</p>
      <p>[snippet slug=<strong>slug_name</strong>]</p>
    </div>
    <div id="post-body">
      <div id="post-body-content">
      	<div class="title pad-right">

        	<h1 class="title align-left"><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage snippets</h1>
			<a href="<?=ADMIN; ?>snippets_add/" class="btn btn-primary">Add new snippet</a>       	 	
       	</div>
        <div class="table">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage_content">
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
						<td><a href="<?= ADMIN ?>snippets_edit/<?= $snippet->id ?>" class="btn btn-small">Edit</a> <a href="<?= ADMIN ?>snippets_delete/<?= $snippet->id ?>" class="btn btn-small btn-danger">Delete</a></td>
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
<? load::view('admin/partials/template-footer', array( 'assets' => array('') ) );
 ?>
