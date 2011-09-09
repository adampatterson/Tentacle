<p>Frontend View</p>
<hr />

<strong>URL Data:</strong> <?=$data?><br /><?=$data2?><br /><?=$data3?><br />

<ul>
<li><a href="<?=url::base(); ?>">Index</a></li>
<li><a href="<?=url::page("pagename"); ?>">Page</a></li>
<li><a href="<?=url::page("pagename/sub_page"); ?>">Sub-Page</a></li>
<li><a href="<?=url::page("pagename/sub_page/sub_sub_page"); ?>">Sub-Page</a></li>
<li><a href="<?=url::page("blog/post_name/"); ?>">Blog Post</a></li>
<li><a href="<?=url::page("category/cat_name/"); ?>">Category</a></li>
<li><a href="<?=url::page("comment/comment_name/"); ?>">Comment</a></li>
<li><a href="<?=url::page("tag/tag_name/"); ?>">Tag</a></li>
<li><a href="<?=url::page("file/file_name/"); ?>">File</a></li>
<li></li>
<li><a href="<?=url::page("admin/index/"); ?>">Admin</a></li>
</ul>