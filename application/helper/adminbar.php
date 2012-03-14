<div class="topbar">
  <div class="fill">
	<div class="container-full">
		<a class="brand" href="<?= BASE_URL ?>">
		  <?= get_option('blogname'); ?>
		</a>
	<ul class="nav" data-dropdown="dropdown">
		<li><a href="<?= ADMIN ?>">Dashboard</a></li>
		<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Content</a>
		  <ul class="dropdown-menu">
			<li><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
	        <li><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
			<li class="divider"></li>
	        <li><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
	        <li><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
			<li class="divider"></li>
	        <li><a href="<?= ADMIN ?>content_manage_categories/">Manage categories</a></li>
		  </ul>
		</li>
		<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Snippets</a>
		  <ul class="dropdown-menu">
			<li><a href="<?= ADMIN ?>snippets_add/">Add a new snippet</a></li>
			<li><a href="<?= ADMIN ?>snippets_manage/">Manage snippets</a></li>
		  </ul>
		</li>
		<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Users</a>
		  <ul class="dropdown-menu">
			<li><a href="<?= ADMIN ?>users_manage/">Manage users</a></li>
			<li><a href="<?= ADMIN ?>users_add/">Add a new user</a></li>
			<li><a href="<?= ADMIN ?>users_profile/">Your profile</a></li>
		  </ul>
		</li>
		<li class="dropdown" data-dropdown="dropdown"><a href="#" class="dropdown-toggle">Settings</a>
		  <ul class="dropdown-menu">
			<li><a class="<? current_page('admin/settings_appearance'); ?>" href="<?= ADMIN ?>settings_appearance/">Appearance</a></li>
			<li class="<? current_page('admin/settings_general'); ?>"><a href="<?= ADMIN ?>settings_general/">General</a></li>
		  </ul>
		</li>
		<li><a href="<?= ADMIN ?>about_system_details/">About</a> </li>
	  </ul>
	<ul class="nav secondary-nav">
		<li class="dropdown" data-dropdown="dropdown" >
			<a href="#" class="dropdown-toggle">Help</a>
			<ul class="dropdown-menu">
				<li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Knowledge Base</a></li>
				<li><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Submit an Issue</a></li>
			</ul>
		</li>
		<li><a href="<?= ADMIN ?>logout/"><img src="<?= TENTACLE_URL.'/admin/images/log_out.png'; ?>" alt="Log Out" /></a> </li>
	</ul>
	<p class="pull-right">Welcome <a href="<?= ADMIN ?>users_profile/"><?= user_name(); ?></a></p>
	</div><!-- . container-full -->
  </div><!-- .fill -->
</div><!-- .topbar -->


<?
/*

#wpadminbar * {
	height:auto;
	width:auto;
	margin:0;
	padding:0;
	position:static;
	text-transform:none;
	letter-spacing:normal;
	line-height:1;
	font:normal 13px/28px sans-serif;
	color:#ccc;
	text-shadow:#444 0 -1px 0;
}
#wpadminbar ul li:before, #wpadminbar ul li:after {
	content:normal;
}
#wpadminbar a, #wpadminbar a:hover, #wpadminbar a img, #wpadminbar a img:hover {
	outline:none;
	border:none;
	text-decoration:none;
	background:none;
}
#wpadminbar {
	direction:ltr;
	color:#ccc;
	font:normal 13px/28px sans-serif;
	height:28px;
	position:fixed;
	top:0;
	left:0;
	width:100%;
	min-width:600px;
	z-index:99999;
	background-color:#464646;
	background-image:-ms-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-moz-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-o-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-webkit-gradient(linear, left bottom, left top, from(#373737), to(#464646));
	background-image:-webkit-linear-gradient(bottom, #373737, #464646 5px);
	background-image:linear-gradient(bottom, #373737, #464646 5px);
}
#wpadminbar .ab-sub-wrapper, #wpadminbar ul, #wpadminbar ul li {
	background:none;
	clear:none;
	list-style:none;
	margin:0;
	padding:0;
	position:relative;
	z-index:99999;
}
#wpadminbar .quicklinks {
	border-left:1px solid transparent;
}
#wpadminbar .quicklinks ul {
	text-align:left;
}
#wpadminbar li {
	float:left;
}
#wpadminbar .ab-empty-item {
	outline:none;
}
#wpadminbar .quicklinks>ul>li {
	border-right:1px solid #555;
}
#wpadminbar .quicklinks>ul>li>a, #wpadminbar .quicklinks>ul>li>.ab-empty-item {
	border-right:1px solid #333;
}
#wpadminbar .quicklinks .ab-top-secondary>li {
	border-left:1px solid #333;
	border-right:0;
	float:right;
}
#wpadminbar .quicklinks .ab-top-secondary>li>a, #wpadminbar .quicklinks .ab-top-secondary>li>.ab-empty-item {
	border-left:1px solid #555;
	border-right:0;
}
#wpadminbar .quicklinks a, #wpadminbar .quicklinks .ab-empty-item, #wpadminbar .shortlink-input {
	height:28px;
	display:block;
	padding:0 12px;
	margin:0;
}
#wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input {
	margin:0 0 0 -1px;
	padding:0;
	-moz-box-shadow:0 4px 4px rgba(0,0,0,0.2);
	-webkit-box-shadow:0 4px 4px rgba(0,0,0,0.2);
	box-shadow:0 4px 4px rgba(0,0,0,0.2);
	background:#fff;
	display:none;
	position:absolute;
	float:none;
	border-width:0 1px 1px 1px;
	border-style:solid;
	border-color:#dfdfdf;
}
#wpadminbar.ie7 .menupop .ab-sub-wrapper, #wpadminbar.ie7 .shortlink-input {
	top:28px;
	left:0;
}
#wpadminbar .ab-top-secondary .menupop .ab-sub-wrapper {
	right:0;
	left:auto;
	margin:0 -1px 0 0;
}
#wpadminbar .ab-sub-wrapper>.ab-submenu:first-child {
	border-top:none;
}
#wpadminbar .ab-submenu {
	padding:6px 0;
	border-top:1px solid #dfdfdf;
}
#wpadminbar .selected .shortlink-input {
	display:block;
}
#wpadminbar .quicklinks .menupop ul li {
	float:none;
}
#wpadminbar .quicklinks .menupop ul li a strong {
	font-weight:bold;
}
#wpadminbar .quicklinks .menupop ul li .ab-item, #wpadminbar .quicklinks .menupop ul li a strong, #wpadminbar .quicklinks .menupop.hover ul li .ab-item, #wpadminbar.nojs .quicklinks .menupop:hover ul li .ab-item, #wpadminbar .shortlink-input {
	line-height:26px;
	height:26px;
	text-shadow:none;
	white-space:nowrap;
	min-width:140px;
}
#wpadminbar .shortlink-input {
	width:200px;
}
#wpadminbar.nojs li:hover>.ab-sub-wrapper, #wpadminbar li.hover>.ab-sub-wrapper {
	display:block;
}
#wpadminbar .menupop li:hover>.ab-sub-wrapper, #wpadminbar .menupop li.hover>.ab-sub-wrapper {
	margin-left:100%;
	margin-top:-33px;
	border-width:1px;
}
#wpadminbar .ab-top-secondary .menupop li:hover>.ab-sub-wrapper, #wpadminbar .ab-top-secondary .menupop li.hover>.ab-sub-wrapper {
	margin-left:0;
	left:inherit;
	right:100%;
}
#wpadminbar .ab-top-menu>li:hover>.ab-item, #wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar .ab-top-menu>li>.ab-item:focus, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus {
	color:#fafafa;
	background-color:#3a3a3a;
	background-image:-ms-linear-gradient(bottom, #3a3a3a, #222);
	background-image:-moz-linear-gradient(bottom, #3a3a3a, #222);
	background-image:-o-linear-gradient(bottom, #3a3a3a, #222);
	background-image:-webkit-gradient(linear, left bottom, left top, from(#3a3a3a), to(#222));
	background-image:-webkit-linear-gradient(bottom, #3a3a3a, #222);
	background-image:linear-gradient(bottom, #3a3a3a, #222);
}
#wpadminbar.nojs .ab-top-menu>li.menupop:hover>.ab-item, #wpadminbar .ab-top-menu>li.menupop.hover>.ab-item {
	background:#fff;
	color:#333;
	text-shadow:none;
}
#wpadminbar .hover .ab-label, #wpadminbar.nojq .ab-item:focus .ab-label {
	color:#fafafa;
}
#wpadminbar .menupop.hover .ab-label {
	color:#333;
	text-shadow:none;
}
#wpadminbar .menupop li:hover, #wpadminbar .menupop li.hover, #wpadminbar .quicklinks .menupop .ab-item:focus, #wpadminbar .quicklinks .ab-top-menu .menupop .ab-item:focus {
	background-color:#eaf2fa;
}
#wpadminbar .ab-submenu .ab-item {
	color:#333;
	text-shadow:none;
}
#wpadminbar .quicklinks .menupop ul li a, #wpadminbar .quicklinks .menupop ul li a strong, #wpadminbar .quicklinks .menupop.hover ul li a, #wpadminbar.nojs .quicklinks .menupop:hover ul li a {
	color:#21759B;
}
#wpadminbar .menupop .menupop>.ab-item {
	display:block;
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:95% -20px;
	background-repeat:no-repeat;
	padding-right:2em;
}
#wpadminbar .ab-top-secondary .menupop .menupop>.ab-item {
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:5% -46px;
	background-repeat:no-repeat;
	padding-left:2em;
	padding-right:1em;
}
#wpadminbar .quicklinks .menupop ul.ab-sub-secondary {
	display:block;
	position:relative;
	right:auto;
	margin:0;
	background:#eee;
	-moz-box-shadow:none;
	-webkit-box-shadow:none;
	box-shadow:none;
}
#wpadminbar .quicklinks .menupop .ab-sub-secondary>li:hover, #wpadminbar .quicklinks .menupop .ab-sub-secondary>li.hover, #wpadminbar .quicklinks .menupop .ab-sub-secondary>li .ab-item:focus {
	background-color:#dfdfdf;
}
#wpadminbar .quicklinks a span#ab-updates {
	background:#eee;
	color:#333;
	text-shadow:none;
	display:inline;
	padding:2px 5px;
	font-size:10px;
	font-weight:bold;
	-webkit-border-radius:10px;
	border-radius:10px;
}
#wpadminbar .quicklinks a:hover span#ab-updates {
	background:#fff;
	color:#000;
}
#wpadminbar .ab-top-secondary {
	float:right;
	background-color:#464646;
	background-image:-ms-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-moz-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-o-linear-gradient(bottom, #373737, #464646 5px);
	background-image:-webkit-gradient(linear, left bottom, left top, from(#373737), to(#464646));
	background-image:-webkit-linear-gradient(bottom, #373737, #464646 5px);
	background-image:linear-gradient(bottom, #373737, #464646 5px);
}
#wpadminbar ul li:last-child, #wpadminbar ul li:last-child .ab-item {
	border-right:0;
	-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow:none;
}
#wp-admin-bar-my-account>ul {
	min-width:198px;
}
#wp-admin-bar-my-account.with-avatar>ul {
	min-width:270px;
}
#wpadminbar #wp-admin-bar-user-actions>li {
	margin-left:16px;
	margin-right:16px;
}
#wpadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions>li {
	margin-left:88px;
}
#wp-admin-bar-user-actions>li>.ab-item {
	padding-left:8px;
}
#wpadminbar #wp-admin-bar-user-info {
	margin-top:6px;
	margin-bottom:15px;
	height:auto;
	background:none;
}
#wp-admin-bar-user-info .avatar {
	position:absolute;
	left:-72px;
	top:4px;
}
#wpadminbar #wp-admin-bar-user-info a {
	background:none;
	height:auto;
}
#wpadminbar #wp-admin-bar-user-info span {
	background:none;
	padding:0;
	height:18px;
}
#wpadminbar #wp-admin-bar-user-info .display-name, #wpadminbar #wp-admin-bar-user-info .username {
	text-shadow:none;
	display:block;
}
#wpadminbar #wp-admin-bar-user-info .display-name {
	color:#333;
}
#wpadminbar #wp-admin-bar-user-info .username {
	color:#999;
	font-size:11px;
}
#wpadminbar .quicklinks li#wp-admin-bar-my-account.with-avatar>a img {
	width:16px;
	height:16px;
	border:1px solid #999;
	padding:0;
	background:#eee;
	line-height:24px;
	vertical-align:middle;
	margin:-3px 0 0 6px;
	float:none;
	display:inline;
}
#wpadminbar .quicklinks li img.blavatar {
	vertical-align:middle;
	margin:-3px 4px 0 0;
	padding:0;
}
#wpadminbar #wp-admin-bar-search .ab-item {
	padding:0;
}
#wpadminbar #wp-admin-bar-search .ab-item {
	background:transparent;
}
#wpadminbar #adminbarsearch {
	height:28px;
	padding:0 2px;
}
#wpadminbar #adminbarsearch .adminbar-input {
	font:13px/24px sans-serif;
	height:24px;
	width:24px;
	border:none;
	padding:0 3px 0 23px;
	margin:0;
	color:#ccc;
	text-shadow:#444 0 -1px 0;
	background-color:rgba(255,255,255,0);
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:3px 2px;
	background-repeat:no-repeat;
	outline:none;
	-webkit-border-radius:3px;
	border-radius:3px;
	-moz-box-shadow:none;
	-webkit-box-shadow:none;
	box-shadow:none;
	-moz-box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-ms-box-sizing:border-box;
	box-sizing:border-box;
	-webkit-transition-duration:400ms;
	-webkit-transition-property:width, background;
	-webkit-transition-timing-function:ease;
	-moz-transition-duration:400ms;
	-moz-transition-property:width, background;
	-moz-transition-timing-function:ease;
	-o-transition-duration:400ms;
	-o-transition-property:width, background;
	-o-transition-timing-function:ease;
}
#wpadminbar.ie7 #adminbarsearch .adminbar-input {
	margin-top:1px;
	width:120px;
}
#wpadminbar #adminbarsearch .adminbar-input:focus {
	color:#555;
	text-shadow:0 1px 0 #fff;
	width:200px;
	background-color:rgba(255,255,255,0.9);
}
#wpadminbar.ie8 #adminbarsearch .adminbar-input {
	background-color:#464646;
}
#wpadminbar.ie8 #adminbarsearch .adminbar-input:focus {
	background-color:#fff;
}
#wpadminbar #adminbarsearch .adminbar-input::-webkit-input-placeholder {
color:#ddd;
}
#wpadminbar #adminbarsearch .adminbar-input:-moz-placeholder {
color:#ddd;
}
#wpadminbar #adminbarsearch .adminbar-button {
	display:none;
}
#wpadminbar #wp-admin-bar-appearance {
	border-top:none;
	margin-top:-12px;
}
#wpadminbar #wp-admin-bar-appearance {
	border-top:none;
	margin-top:-12px;
}
#wpadminbar .ab-icon {
	position:relative;
	float:left;
	width:16px;
	height:16px;
	margin-top:6px;
}
#wpadminbar .ab-label {
	margin-left:4px;
}
#wp-admin-bar-wp-logo>.ab-item .ab-icon {
	width:20px;
	height:20px;
	margin-top:4px;
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:0 -76px;
	background-repeat:no-repeat;
}
#wpadminbar.nojs #wp-admin-bar-wp-logo:hover>.ab-item .ab-icon, #wpadminbar #wp-admin-bar-wp-logo.hover>.ab-item .ab-icon {
	background-position:0 -104px;
}
#wp-admin-bar-updates>.ab-item .ab-icon {
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:-2px -159px;
	background-repeat:no-repeat;
}
#wp-admin-bar-comments>.ab-item .ab-icon {
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:-1px -134px;
	background-repeat:no-repeat;
}
#wpadminbar span.count-0 {
	display:none;
}
#wpadminbar #wp-admin-bar-new-content>.ab-item .ab-icon {
	background-image:url(../images/admin-bar-sprite.png?d=20111130);
	background-position:-2px -182px;
	background-repeat:no-repeat;
}
#wpadminbar.nojs #wp-admin-bar-new-content:hover>.ab-item .ab-icon, #wpadminbar #wp-admin-bar-new-content.hover>.ab-item .ab-icon {
	background-position:-2px -203px;
}
* html #wpadminbar {
	overflow:hidden;
	position:absolute;
}
* html #wpadminbar .quicklinks ul li a {
	float:left;
}
* html #wpadminbar .menupop a span {
	background-image:none;
}


<div id="wpadminbar" class="no-grav" role="navigation">
			<div class="quicklinks">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">
		<li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.adampatterson.ca/wp-admin/about.php" title="About WordPress"><span class="ab-icon"></span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
		<li id="wp-admin-bar-about" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/about.php">About WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
		<li id="wp-admin-bar-wporg" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org">WordPress.org</a>		</li>
		<li id="wp-admin-bar-documentation" class=""><a class="ab-item" tabindex="10" href="http://codex.wordpress.org">Documentation</a>		</li>
		<li id="wp-admin-bar-support-forums" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org/support/">Support Forums</a>		</li>
		<li id="wp-admin-bar-feedback" class=""><a class="ab-item" tabindex="10" href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.adampatterson.ca/wp-admin/">Adam Patterson - Edmonton Web Design and…</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
		<li id="wp-admin-bar-dashboard" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/">Dashboard</a>		</li></ul><ul id="wp-admin-bar-appearance" class=" ab-submenu">
		<li id="wp-admin-bar-themes" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/themes.php">Themes</a>		</li>
		<li id="wp-admin-bar-menus" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/nav-menus.php">Menus</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-updates" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/update-core.php" title="5 Plugin Updates, 1 Theme Update"><span class="ab-icon"></span><span class="ab-label">6</span></a>		</li>
		<li id="wp-admin-bar-comments" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/edit-comments.php" title="298 comments awaiting moderation"><span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-298">298</span></a>		</li>
		<li id="wp-admin-bar-new-content" class="menupop"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.adampatterson.ca/wp-admin/post-new.php" title="Add New"><span class="ab-icon"></span><span class="ab-label">New</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-new-content-default" class="ab-submenu">
		<li id="wp-admin-bar-new-post" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/post-new.php">Post</a>		</li>
		<li id="wp-admin-bar-new-media" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/media-new.php">Media</a>		</li>
		<li id="wp-admin-bar-new-link" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/link-add.php">Link</a>		</li>
		<li id="wp-admin-bar-new-page" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/post-new.php?post_type=page">Page</a>		</li>
		<li id="wp-admin-bar-new-user" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/user-new.php">User</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-edit" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/post.php?post=7&amp;action=edit">Edit Page</a>		</li>
		<li id="wp-admin-bar-stats" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/admin.php?page=stats"><img style="width:95px;height:20px" src="http://www.adampatterson.ca/wp-admin/admin.php?page=stats&amp;noheader&amp;proxy&amp;chart=admin-bar-hours&amp;height=20&amp;hours=48" alt="Views over 48 hours. Click for more Site Stats." title="Views over 48 hours. Click for more Site Stats."></a>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
		<li id="wp-admin-bar-search" class=" admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="http://www.adampatterson.ca/" method="get" id="adminbarsearch"><input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150"><input type="submit" class="adminbar-button" value="Search"></form></div>		</li>
		<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" tabindex="10" aria-haspopup="true" href="http://www.adampatterson.ca/wp-admin/profile.php" title="My Account">Howdy, Adam Patterson<img alt="" src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=16&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D16&amp;r=G" class="avatar avatar-16 photo" height="16" width="16"></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class=" ab-submenu">
		<li id="wp-admin-bar-user-info" class=""><a class="ab-item" tabindex="-1" href="http://www.adampatterson.ca/wp-admin/profile.php"><img alt="" src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=64&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G" class="avatar avatar-64 photo" height="64" width="64"><span class="display-name">Adam Patterson</span><span class="username">admin</span></a>		</li>
		<li id="wp-admin-bar-edit-profile" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-admin/profile.php">Edit My Profile</a>		</li>
		<li id="wp-admin-bar-logout" class=""><a class="ab-item" tabindex="10" href="http://www.adampatterson.ca/wp-login.php?action=logout&amp;_wpnonce=088b661d27">Log Out</a>		</li></ul></div>		</li></ul>			</div>
		</div>

*/
?>