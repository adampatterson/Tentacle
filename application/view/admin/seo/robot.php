<? load::view('admin/partials/header', array('title' => 'Robots','assets'=>'application')); ?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div id="post-body-content">
				<div class="one-full">
					<h1><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> Robots</h1>
					<div class="one-half">
						<div class="table">
							<label for="">Spider</label>
							<input type="checkbox" value="1" id="noodp" name="noodp"> Don’t use this site’s Open Directory description in search results.<br />
							<input type="checkbox" value="1" id="noydir" name="noydir"> Don’t use this site’s Yahoo! Directory description in search results.<br />
							<input type="checkbox" value="1" id="noarchive" name="noarchive"> Don’t cache or archive this site.<br />
						</div>
					</div>
					<div class="one-half">
						<div class="table">
							<label for="">Noindex</label>
							<input type="checkbox" value="1" id="noindex_admin" name="noindex_admin"> Administration back-end pages<br />
							<input type="checkbox" value="1" id="noindex_author" name="noindex_author"> Author archives<br />
							<input type="checkbox" value="1" id="noindex_search" name="noindex_search"> Blog search pages<br />
							<input type="checkbox" value="1" id="noindex_category" name="noindex_category"> Category archives<br />
							<input type="checkbox" value="1" id="noindex_comments_feed" name="noindex_comments_feed"> Comment feeds<br />
							<input type="checkbox" value="1" id="noindex_cpage" name="noindex_cpage"> Comment subpages<br />
							<input type="checkbox" value="1" id="noindex_date" name="noindex_date"> Date-based archives<br />
							<input type="checkbox" value="1" id="noindex_home_paged" name="noindex_home_paged"> Subpages of the homepage<br />
							<input type="checkbox" value="1" id="noindex_tag" name="noindex_tag"> Tag archives<br />
							<input type="checkbox" value="1" id="noindex_login" name="noindex_login"> User login/registration pages<br />
						</div>
					</div>
				</div>
			</div><!-- .post-body-content -->
		</div><!-- #post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/partials/footer');
 ?>