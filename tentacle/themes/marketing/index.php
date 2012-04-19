<?
 /*
Name: Index Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

$data = array(
	'display' => 'admin'
);

if(!defined('SCAFFOLD')):
?>
<? //load_part( 'header',array( 'title'=>'Welcome to Tentacle', 'assets'=>'marketing' ) ); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Tentacle</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="<?= PATH ?>/assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?= PATH ?>/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?= PATH ?>/style.css" rel="stylesheet">
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="../assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= PATH ?>/assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= PATH ?>/assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?= PATH ?>/assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container visible-phone visible-tablet">
				<ul class="nav pull-left">
					<li>
						<img src="<?= PATH ?>/assets/img/tentacle.png" alt="" class="brand" />
					</li>
				</ul>
			</div>
			<div class="container hidden-phone hidden-tablet">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<ul class="nav">
					<li>
						<img src="<?= PATH ?>/assets/img/tentacle.png" alt="" class="brand" />
					</li>
				</ul>
				<ul class="nav pull-right">
					<li>
						<a href="https://twitter.com/#!/TentacleCMS">@TentacleCMS</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/">Blog</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/about-tentacle/">About</a>
					</li>
					<li class="">
						<a href="http://tentaclecms.com/blog/contact/">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<header class="jumbotron subhead" id="overview">
		<div class="container">
			<div class="row visible-desktop">
				<div class="span5">
					<h1><small>Create &amp; Manage Content your way!</small></h1>
					<p class="lead">Tentacle makes it easy to Design, Develop, and Write content for the web.</p>
					<p class="lead">It’s goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p>
					<p class="lead"><a class="btn btn-large btn-success" href="http://tentaclecms.com/blog/downloads/tentacle-beta" onClick="javascript: _gaq.push(['_trackPageview', '/blog/downloads/tentacle-beta']); _gaq.push(['_trackEvent', 'Link', 'Download', 'v 0.5 Beta']);">&nbsp;&nbsp;&nbsp;Download&nbsp;&nbsp;&nbsp;</a></p>
				</div>
				<div class="span7">
					<p class="lead"><img src="<?= PATH ?>/assets/img/tentacle-app.png" alt="Tentacle" class="full" /></p>
				</div>
			</div>
			
			<div class="row visible-tablet">
				<div class="span5">
					<h1><small>Create &amp; Manage Content your way!</small></h1>
				</div>
				<div class="span7">
					<p class="lead"><img src="<?= PATH ?>/assets/img/tentacle-app.png" alt="Tentacle" class="full" /></p>
				</div>
			</div>
			<div class="row visible-tablet">
				<div class="span12">
					<p class="lead">Tentacle makes it easy to Design, Develop, and Write content for the web.</p>
					<p class="lead">It’s goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p>
					<p class="lead"><a class="btn btn-large btn-success" href="http://tentaclecms.com/blog/downloads/tentacle-beta" onClick="javascript: _gaq.push(['_trackPageview', '/blog/downloads/tentacle-beta']); _gaq.push(['_trackEvent', 'Link', 'Download', 'v 0.5 Beta']);">&nbsp;&nbsp;&nbsp;Download&nbsp;&nbsp;&nbsp;</a></p>
				</div>
			</div>
			
			<div class="row visible-phone">
				<div class="span12">
					<h1><small>Create &amp; Manage Content your way!</small></h1>
					<p class="lead">Tentacle makes it easy to Design, Develop, and Write content for the web.</p>
					<p class="lead">It’s goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p>
					<p class="lead"><a class="btn btn-large btn-success" href="http://tentaclecms.com/blog/downloads/tentacle-beta" onClick="javascript: _gaq.push(['_trackPageview', '/blog/downloads/tentacle-beta']); _gaq.push(['_trackEvent', 'Link', 'Download', 'v 0.5 Beta']);">&nbsp;&nbsp;&nbsp;Download&nbsp;&nbsp;&nbsp;</a></p>
				</div>
			</div>
<?/* 
			<div class="subnav">
				<ul class="nav nav-pills">
					<li><a href="#why">Why</a></li>
					<li><a href="#features">Features</a></li>
					<li><a href="#support">Support</a></li>
					<li><a href="#hosting">Hosting</a></li>
					<li><a href="#documentation">Documentation</a></li>
					<li><a href="#get-it">Get it</a></li>
				</ul>
			</div>
*/?>
		</div>
	</header>
	<div class="container">
		<div class="row bump" id="why">
			<div class="span12">
				<h1>Why Tentacle?</h1>
				
				<hr />
				
				<p class="lead">By focusing on the user we are able to refine the processes for every one.  By building Tentacle on a light weight flexible framework we are not imposing strict rules on you.	By working with and providing the tools you need we hope you can accomplish more in less time.</p>

				<p class="lead">Writers will be able to add custom data just as easily as filling out a web form with contextual titles, a full WYSIWYG editor, with Validation.</p>

				<p class="lead">Designers can stick to what they know and use HTML, CSS, PHP, JS to do their bidding.</p>

				<p class="lead">With an approval process in place content can be added as a draft, approved and versioned. We went another step in that you can modify approved content without publishing immediately publishing the changes to the live site.</p>
				
				<p><a class="btn btn-default btn-large" href="https://github.com/adampatterson/Tentacle/wiki/Philosophy">Read more about our Philosophy</a></p>
			</div>
		</div>
<?/* 
		<div class="row bump" id="features">
			<div class="span12">
				<h1>Core features</h1>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
		</div>
	
		<div class="row bump" id="testamonie">
			<div class="span12">
				<h1>Hook Line &amp; Sinker</h1>
				<p class="lead">We love using Tentacle but the proof is in the pudding.</p>
				
				<ul class="thumbnails">
					<li class="span4">
						<div class="thumbnail">
							<img src="http://placehold.it/260x180" alt="" class="full">
							<div class="caption">
								<h5>Thumbnail label</h5>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
							</div>
						</div>
					</li>
						<li class="span4">
							<div class="thumbnail">
								<img src="http://placehold.it/260x180" alt="" class="full">
								<div class="caption">
									<h5>Thumbnail label</h5>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								</div>
							</div>
						</li>
						<li class="span4">
							<div class="thumbnail">
								<img src="http://placehold.it/260x180" alt="" class="full">
								<div class="caption">
									<h5>Thumbnail label</h5>
									<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								</div>
							</div>
						</li>
					</ul>
			</div>
		</div>
*/ ?>
		
		<div class="row bump" id='get-it'>
			<div class="span12 center jumbotron subhead" id="overview">
				<div class="container">
					<h1><small>Use Tentacle CMS today</small></h1>
					<p><a class="btn btn-large btn-success" href="http://tentaclecms.com/blog/downloads/tentacle-beta" onClick="javascript: _gaq.push(['_trackPageview', '/blog/downloads/tentacle-beta']); _gaq.push(['_trackEvent', 'Link', 'Download', 'v 0.5 Beta']);">&nbsp;&nbsp;&nbsp;Get it!&nbsp;&nbsp;&nbsp;</a></p>
				</div>
			</div>
		</div>
		
		<div class="row bump" id="support">
			<div class="span12">
				<h1>We are here to help!</h1>
				
				<hr />
				
				<div class="row">

					<div class="span6">
						<h3>Forms</h3>
						<p class="lead">Get answers to your design and development questions from the online community.</p>
						<p><a href="#comingsoon" class="btn btn-default btn-large">Coming soon!</a></p>
					</div>
<?/* 
					<div class="span4">	
						<h3>IRC</h3>
						<p class="lead">Join us in the IRC channel from <a href="http://freenode.net/">Freenode.net</a>, A great resource for Designers and Developers.</p>
						<p><a href="http://webchat.freenode.net/?channel=tentaclecms" class="btn btn-default btn-large" >#tentaclecms</a></p>
					</div>
*/ ?>
					<div class="span6">
						<h3>Report a Bug</h3>
						<p class="lead">If you found a bug in the CMS use the <a href="https://github.com/adampatterson/Tentacle/issues">Issue Tracker</a> on GitHub to report it.</p>

						<p class="lead"><strong>Please try to provide us with as much clear information as possible.</strong></p>

						<p><a href="https://github.com/adampatterson/Tentacle/issues" class="btn btn-default btn-large">Submit and Issue</a></p>
					</div>
				</div>

			</div>
		</div>

<?/* 
		<div class="row bump" id="hosting">
			<div class="span12">
				<h1>Hosting</h1>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
		</div>
*/?>
	</div>
		<footer>
			<div class="container">
				<div class="row bump">
					<div class="span6">
						<h2>Let us know what you think.</h2>
					
						<ul class="unstyled">
							<li class="lead"><a data-toggle="modal" href="#myModal">Mailing List</a></li>
							<li class="lead"><a href="mailto:hello@tentaclecms.com">hello@tentaclecms.com</a></li>
							<li class="lead"><a href="https://twitter.com/#!/TentacleCMS">@TentacleCMS</a></li>
						</ul>
					</div>
			
					<div class="span6">	
						<p class="pull-right"><img src="<?= PATH ?>/assets/img/adam-patterson.png" alt="" /></p>
					</div>
<? /*			
					<div class="span4">
						<h3>Blog</h3>
						<? dashboard_feed("http://tentaclecms.com/blog/feed/", 4, true ); ?>
					</div>
*/ ?>
				</div>
			
			</div>
		</div> <!-- /container -->
	</footer>
	
	<div class="modal hide fade" id="myModal">
		<form method="post" action="http://www.industrymailout.com/Industry/SubscribeRedirect.aspx" >
			<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Mailing list</h3>
		</div>
		<div class="modal-body">

			<input type="hidden" name="mailinglistid" value="27205" />
			<input type="hidden" name="success" value="http://tentaclecms.com" />
			<input type="hidden" name="errorparm" value="error" />


			<div class="control-group">
				<label for="firstname">First Name</label>
				<div class="controls">
					<input type="text" name="givenname" maxlength="50" class="span3 input-xlarge" id="firstname" >
				</div>
			</div>

			<div class="control-group">
				<label for="lastname">Last Name</label>
				<div class="controls">
					<input type="text" name="familyname" maxlength="50" class="span3 input-xlarge" id="lastname" >
				</div>
			</div>

			<div class="control-group">
				<label for="email">Email</label>
				<div class="controls">
					<input type="text" name="email" required="required" value="" class="email span3 input-xlarge" id="email">
				</div>
			</div>

			<?php if($note = note::get('session')): ?>
				<input type='hidden' name='history' value="<?= $note['content'];?> " />
			<?php endif;?>
		  </div>
		  <div class="modal-footer">
		    <input type="submit" value="Join the List!" class="btn btn-default btn-large btn-primary" />
		  </div>
		</form>
	</div>

	<script type="text/javascript" charset="utf-8">
		$('#myModal').modal('hide')
	</script>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?= PATH ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?= PATH ?>/assets/js/application.js"></script>
	<a href="https://github.com/adampatterson/Tentacle/tree/beta-wip" class="visible-desktop"><img style="position: absolute; top: 60px; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/abad93f42020b733148435e2cd92ce15c542d320/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub"></a>
	
</body>
</html>

<? //load_part( 'footer' ); 
endif;
?>