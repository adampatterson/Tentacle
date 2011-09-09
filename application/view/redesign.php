<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sidebar</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Le styles -->
		<link href="<?=TENTACLE_CSS;?>bootstrap-1.1.1.css" rel="stylesheet">
		<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS;?>markitup/skins/simple/style.css">
		<link media="screen" type="text/css" rel="stylesheet" href="<?=TENTACLE_JS;?>markitup/sets/textile/style.css">
		<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS;?>admin.css">
		<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS;?>general.css">
		<link type="text/css" rel="stylesheet" href="<?=TENTACLE_CSS;?>redesign.css">
	</head>
	<body lang="en" class="admin_content_add_page" id="admin-window">
		<header>
			<div class="topbar">
				<div class="fill">
					<div class="container-full">
						<h3><a href="#">Tentacle</a></h3>
						<ul>
							<li class=" active">
								<a href="http://localhost/http/dev.tcms.me/dev/redesign">Sidebar</a>
							</li>
							<li>
								<a href="http://localhost/http/dev.tcms.me/dev/redesign2">One Col</a>
							</li>
							<li>
								<a href="http://localhost/http/dev.tcms.me/dev/redesign3">Two Col</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- #header -->
		<div id="body-wrapper">
			<div id="wrap">
				<form method="post" action="http://localhost/http/dev.tcms.me/action/add_page/"	 class="form-stacked">
					<input type="hidden" value="page" name="page-or-post">
					<div class="has-right-sidebar">
						<div class="contet-sidebar has-tabs">
							<div class="table-heading">
								<h3 class="regular">Title</h3>
							</div>
							<div class="table-content">
								Content
							</div>
						</div>
						<div id="post-body">
							<div id="post-body-content">
								<div class="title">
									<h1><img alt="" src="http://localhost/http/dev.tcms.me/tentacle/admin/images/icons/icon_pages_32.png">Write a new page</h1>
									<div class="tabs">
										<ul class="tabNavigation container">
											<li>
												<a href="#first">Content</a>
											</li>
										</ul>
										<div class="tab-body" id="first" style="display: block;">
											Content
										</div>
									</div>
								</div>
							</div>
						</div>
				</form>
			</div>
			<!-- #wrap -->
		</div>
		<!-- #body-wrapper -->
	</body>
</html>