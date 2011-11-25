<?php

class install_controller
{	
	public function step1 ( $step )
	{
		load::view ('step1');
	}
	public function step2 ( $step )
	{
		load::view ('step2');
	}
	public function step3 ( $step )
	{
		load::view ('step3');
	}
	public function step4 ( $step )
	{
		load::view ('step4');
	}
	public function step5 ( $step )
	{
		load::config('db');
			
		$config = config::get('db');
		
		$pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);

		# Build Schema
		# ------------------------------------------------------------
		
		$build = $pdo->exec( "CREATE TABLE `comments` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `post_id` bigint(20) NOT NULL DEFAULT '0',
								  `author` text NOT NULL,
								  `author_email` varchar(100) NOT NULL DEFAULT '',
								  `author_url` varchar(200) NOT NULL DEFAULT '',
								  `author_ip` varchar(100) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `content` text NOT NULL,
								  `approved` varchar(20) NOT NULL DEFAULT '1',
								  `user_agent` varchar(255) NOT NULL DEFAULT '',
								  `type` varchar(20) NOT NULL DEFAULT '',
								  `parent` bigint(20) NOT NULL DEFAULT '0',
								  `user_id` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`),
								  FULLTEXT KEY `content` (`content`,`author`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `comments` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `post_id` bigint(20) NOT NULL DEFAULT '0',
								  `author` text NOT NULL,
								  `author_email` varchar(100) NOT NULL DEFAULT '',
								  `author_url` varchar(200) NOT NULL DEFAULT '',
								  `author_ip` varchar(100) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `content` text NOT NULL,
								  `approved` varchar(20) NOT NULL DEFAULT '1',
								  `user_agent` varchar(255) NOT NULL DEFAULT '',
								  `type` varchar(20) NOT NULL DEFAULT '',
								  `parent` bigint(20) NOT NULL DEFAULT '0',
								  `user_id` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`),
								  FULLTEXT KEY `content` (`content`,`author`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `download_tracking` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `download_id` bigint(20) NOT NULL,
								  `referer` varchar(255) DEFAULT NULL,
								  `ip` varchar(16) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `user_id` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `downloads` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `name` varchar(64) NOT NULL DEFAULT '',
								  `url` varchar(255) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `last` datetime DEFAULT '0000-00-00 00:00:00',
								  `count` bigint(20) unsigned NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `media` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `path` varchar(255) NOT NULL DEFAULT '',
								  `title` varchar(255) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `exif` text,
								  `alt` varchar(255) DEFAULT NULL,
								  `count` int(20) DEFAULT NULL,
								  `type` varchar(150) NOT NULL DEFAULT '',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `options` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `key` varchar(64) NOT NULL DEFAULT '',
								  `value` longtext NOT NULL,
								  `autoload` varchar(20) NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `pings` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `referer` varchar(225) DEFAULT NULL,
								  `ip` varchar(16) NOT NULL DEFAULT '',
								  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
								  `user_agent` varchar(225) NOT NULL DEFAULT '',
								  `post_id` int(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `posts` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `visible` varchar(20) DEFAULT 'public',
								  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
								  `title` text NOT NULL,
								  `content` longtext NOT NULL,
								  `excerpt` text NOT NULL,
								  `category` int(4) NOT NULL DEFAULT '0',
								  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
								  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
								  `password` varchar(20) NOT NULL DEFAULT '',
								  `slug` varchar(200) NOT NULL DEFAULT '',
								  `modified` datetime NOT NULL,
								  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `type` varchar(20) NOT NULL DEFAULT 'post',
								  `menu_order` int(11) NOT NULL DEFAULT '0',
								  `guid` varchar(255) NOT NULL,
								  `status` varchar(20) NOT NULL DEFAULT 'draft',
								  `template` varchar(100) NOT NULL DEFAULT 'index.php',
								  PRIMARY KEY (`id`),
								  FULLTEXT KEY `content` (`content`,`title`,`excerpt`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `posts_meta` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `posts_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `meta_key` varchar(225) DEFAULT NULL,
								  `meta_value` longtext,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `sessions` (
								  `name` varchar(25) NOT NULL,
								  `cookie` varchar(25) NOT NULL,
								  `value` text NOT NULL,
								  `expire` int(11) NOT NULL
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `snippet` (
								  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
								  `name` varchar(100) NOT NULL,
								  `slug` text NOT NULL,
								  `filter` varchar(25) NOT NULL DEFAULT '',
								  `content` longtext,
								  `created_by` int(11) NOT NULL DEFAULT '0',
								  `updated_by` int(11) NOT NULL,
								  `position` mediumint(6) unsigned NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`,`name`,`filter`,`created_by`,`position`),
								  FULLTEXT KEY `name` (`name`),
								  FULLTEXT KEY `content` (`content`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `term_relations` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `page_id` int(11) NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `term_taxonomy` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `taxonomy` varchar(32) NOT NULL DEFAULT '',
								  `description` longtext NOT NULL,
								  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `count` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`),
								  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
								  KEY `taxonomy` (`taxonomy`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `terms` (
								  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
								  `name` varchar(40) NOT NULL DEFAULT '',
								  `count` int(11) unsigned NOT NULL,
								  `slug` varchar(40) NOT NULL DEFAULT '',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


		$build = $pdo->exec( "CREATE TABLE `users` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `email` varchar(100) NOT NULL DEFAULT '',
								  `username` varchar(60) NOT NULL DEFAULT '',
								  `password` varchar(64) NOT NULL DEFAULT '',
								  `type` varchar(25) DEFAULT NULL,
								  `data` text,
								  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
								  `status` int(11) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );

		# Build Data
		# ------------------------------------------------------------
		$build = $pdo->exec( "INSERT INTO `terms` (`id`, `name`, `count`, `slug`)
								VALUES
									(3,'Design',0,'design'),
									(2,'Category',0,'category'),
									(4,'Books',0,'books'),
									(5,'Music',0,'music'),
									(7,'Bikes',0,'bikes'),
									(0,'Default',0,'default')" );

		load::view ('step5');
	}
	
	public function step6 ( $step )
	{
		load::view ( 'step6' );	
	}
	
	public function done ( $step )
	{
		load::view ( 'done' );	
	}
}