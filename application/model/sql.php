<?
class sql_model
{

    public function get_100 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        # Build Schema
        # ------------------------------------------------------------

        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `comments` (
		 						 `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `post_id` bigint(20) NOT NULL DEFAULT '0',
								  `author` text NOT NULL,
								  `author_email` varchar(100) NOT NULL DEFAULT '',
								  `author_url` varchar(200) NOT NULL DEFAULT '',
								  `author_ip` varchar(100) NOT NULL DEFAULT '',
								  `date` int(11) NOT NULL,
								  `date_gmt` int(11) NOT NULL,
								  `content` text NOT NULL,
								  `approved` varchar(20) NOT NULL DEFAULT '1',
								  `user_agent` varchar(255) NOT NULL DEFAULT '',
								  `type` varchar(20) NOT NULL DEFAULT '',
								  `parent` bigint(20) NOT NULL DEFAULT '0',
								  `user_id` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`),
								  FULLTEXT KEY `content` (`content`,`author`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `downloads` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `name` varchar(64) NOT NULL DEFAULT '',
								  `url` varchar(255) NOT NULL DEFAULT '0',
								  `date` int(11) NOT NULL DEFAULT '0',
								  `last` int(11) DEFAULT NULL,
								  `count` bigint(20) unsigned NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `download_tracking` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `download_id` bigint(20) NOT NULL,
								  `referer` varchar(255) DEFAULT NULL,
								  `ip` varchar(16) NOT NULL DEFAULT '',
								  `date` int(11) NOT NULL DEFAULT '0',
								  `user_id` bigint(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `media` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `path` varchar(255) NOT NULL DEFAULT '',
								  `title` varchar(255) NOT NULL DEFAULT '',
								  `date` int(11) NOT NULL DEFAULT '0',
								  `exif` text,
								  `alt` varchar(255) DEFAULT NULL,
								  `count` int(20) DEFAULT NULL,
								  `type` varchar(150) NOT NULL DEFAULT '',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `options` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `key` varchar(64) NOT NULL DEFAULT '',
								  `value` longtext NOT NULL,
								  `autoload` varchar(20) NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM  DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `pings` (
								  `id` bigint(20) NOT NULL AUTO_INCREMENT,
								  `referer` varchar(225) DEFAULT NULL,
								  `ip` varchar(16) NOT NULL DEFAULT '',
								  `date` int(11) NOT NULL DEFAULT '0',
								  `user_agent` varchar(225) NOT NULL DEFAULT '',
								  `post_id` int(20) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `posts` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `date` int(11) NOT NULL DEFAULT '0',
								  `modified` int(1) NOT NULL DEFAULT '0',
								  `title` text NOT NULL,
								  `content` longtext NOT NULL,
								  `excerpt` text NOT NULL,
								  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
								  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
								  `password` varchar(20) NOT NULL DEFAULT '',
								  `slug` varchar(200) NOT NULL DEFAULT '',
								  `type` varchar(20) NOT NULL DEFAULT 'post',
								  `menu_order` int(11) NOT NULL DEFAULT '0',
								  `uri` text,
								  `visible` varchar(20) DEFAULT 'public',
								  `status` varchar(20) NOT NULL DEFAULT 'draft',
								  `template` varchar(100) NOT NULL DEFAULT 'index.php',
								  PRIMARY KEY (`id`),
								  KEY `parent` (`parent`),
								  FULLTEXT KEY `content` (`content`,`title`,`excerpt`)
								) ENGINE=MyISAM  DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE `posts_meta` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `posts_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `meta_key` varchar(225) DEFAULT NULL,
								  `meta_value` longtext,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `sessions` (
								  `name` varchar(25) NOT NULL,
								  `cookie` varchar(25) NOT NULL,
								  `value` text NOT NULL,
								  `expire` int(11) NOT NULL
								) ENGINE=MyISAM DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `snippet` (
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


        $build = $pdo->exec( "CREATE TABLE `term_relationships` (
								  `page_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `term_order` int(11) DEFAULT NULL,
								  PRIMARY KEY (`page_id`,`term_id`),
								  KEY `term_id` (`term_id`)
								) ENGINE=InnoDB DEFAULT CHARSET=utf8;" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `term_taxonomy` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `taxonomy` varchar(32) NOT NULL DEFAULT '',
								  `description` longtext NOT NULL,
								  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
								  `count` int(11) NOT NULL,
								  PRIMARY KEY (`id`),
								  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
								  KEY `taxonomy` (`taxonomy`)
								) ENGINE=MyISAM  DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `terms` (
								  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
								  `name` varchar(40) NOT NULL DEFAULT '',
								  `slug` varchar(40) NOT NULL DEFAULT '',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM  DEFAULT CHARSET=utf8" );


        $build = $pdo->exec( "CREATE TABLE IF NOT EXISTS `users` (
								  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
								  `email` varchar(100) NOT NULL DEFAULT '',
								  `username` varchar(60) NOT NULL DEFAULT '',
								  `password` varchar(64) NOT NULL DEFAULT '',
								  `type` varchar(25) DEFAULT NULL,
								  `data` text,
								  `registered` int(11) NOT NULL DEFAULT '0',
								  `status` int(11) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM  DEFAULT CHARSET=utf8" );


        # Build Data
        # ------------------------------------------------------------
        $build = $pdo->exec( "INSERT INTO `terms` (`id`, `name`, `slug`)
									VALUES
										(1,'Default','default'),
										(2,'Design','design'),
										(3,'Category','category'),
										(4,'Books','books'),
										(5,'Music','music'),
										(6,'Bikes','bikes')" );


        $build = $pdo->exec( "INSERT INTO `term_taxonomy` (`id`, `term_id`, `taxonomy`, `description`, `parent`, `count`)
									VALUES
										(1,1,'category','',0,0),
										(2,2,'category','',0,0),
										(3,3,'category','',0,0),
										(4,4,'category','',0,0),
										(5,5,'category','',0,0),
										(6,5,'category','',0,0)" );

        # Options
        # ------------------------------------------------------------
        $build = $pdo->exec( "INSERT INTO `options` (`id`, `key`, `value`, `autoload`)
									VALUES
										(1, 'appearance', 'tentacle', 'yes'),
										(2, 'blogname', 'Tentacle CMS', 'yes'),
										(3, 'blogdescription', 'Just another tentacle in the sea.', 'yes'),
										(4, 'siteurl', '', 'yes'),
										(5, 'admin_email', 'admin@email.com', 'yes'),
										(6, 'image_thumb_size_w', '150', 'yes'),
										(7, 'image_medium_size_w', '300', 'yes'),
										(8, 'image_medium_size_h', '300', 'yes'),
										(9, 'image_large_size_w', '600', 'yes'),
										(10, 'image_large_size_h', '600', 'yes'),
										(11, 'image_thumb_size_h', '150', 'yes'),
										(12, 'db_version', '100', 'yes')" );


        # @todo This should be updated in the post table.
        # ------------------------------------------------------------
        $build = $pdo->exec( "ALTER TABLE  `posts` CHANGE  `guid`  `uri` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL" );

    }

    public function get_101 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }


        $build = $pdo->exec( "INSERT INTO `posts` (`id`, `parent`, `menu_order`, `author`, `date`, `modified`, `title`, `content`, `excerpt`, `comment_status`, `ping_status`, `password`, `slug`, `type`, `uri`, `visible`, `status`, `template`)
		VALUES
			(6, 0, 1, 1, 1322853969, 1328247576, 'Home', '<p><strong>Tentacle is an OpenSource Content Management System, it is free to use.</strong></p>\r\n<p>The goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p>\r\n', '', 'open', 'open', '', 'home', 'page', 'home/', 'public', 'published', 'default')" );

        $build = $pdo->exec( "INSERT INTO `posts` (`id`, `parent`, `menu_order`, `author`, `date`, `modified`, `title`, `content`, `excerpt`, `comment_status`, `ping_status`, `password`, `slug`, `type`, `uri`, `visible`, `status`, `template`)
			VALUES
				(112, 0, 0, 1, 1328502285, 1328560008, 'Welcome to Tentacle CMS', '<p>This is your first post!</p>\r\n', '', 'open', 'open', '', 'welcome-to-tentacle-cms', 'post', 'welcome-to-tentacle-cms/', 'public', 'published', 'default')" );

        $build = $pdo->exec( "INSERT INTO `posts_meta` (`id`, `posts_id`, `meta_key`, `meta_value`)
			VALUES
				(7, 6, 'scaffold_data', 'a:5:{s:4:\"save\";s:0:\"\";s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:4:\"tags\";s:0:\"\";}')" );
        $build = $pdo->exec( "	INSERT INTO `posts_meta` (`id`, `posts_id`, `meta_key`, `meta_value`)
			VALUES
				(58, 112, 'scaffold_data', 'a:6:{s:9:\"post_type\";s:9:\"type-post\";s:13:\"post_category\";a:1:{i:0;s:1:\"1\";}s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:27:\"Enter your comments here...\";s:4:\"tags\";s:0:\"\";}')" );
    }

    public function get_102 ()
    {

        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "INSERT INTO `options` (`id`, `key`, `value`, `autoload`)
		VALUES
			(NULL, 'is_blog_installed', 'true', 'yes')" );

    }

    public function get_103 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` ADD  `caption` TEXT NULL AFTER  `title` ,
		ADD  `description` TEXT NULL AFTER  `caption" );
    }

    public function get_104 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "INSERT INTO `options` (`id`, `key`, `value`, `autoload`)
		VALUES
			(NULL, 'is_agree', '', 'yes')" );
    }

    public function get_105 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "UPDATE  `options` SET  `value` =  'tentacle' WHERE  `options`.`key` = 'appearance" );
    }

    public function get_106 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` ADD  `slug` VARCHAR( 200 ) NOT NULL AFTER  `path`" );
    }

    public function get_107 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` CHANGE  `path`  `uri` VARCHAR( 255 )" );
    }

    public function get_108 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` ADD  `author` BIGINT( 20 ) NOT NULL" );
    }

    public function get_109 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` ADD  `name` VARCHAR( 250 ) NOT NULL AFTER  `slug`" );
    }

    public function get_110 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE  `media` ADD  `link` VARCHAR( 250 ) NOT NULL AFTER  `date`" );
    }

    public function get_111 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "INSERT INTO `options` (`key`, `value`, `autoload`) VALUES('active_modules', 'a:1:{i:0;s:5:\"ipsum\";}', 'yes');" );
    }

    public function get_112 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "ALTER TABLE `posts` ADD FULLTEXT(title, content);" );
    }

    public function get_113 ()
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "DROP TABLE `downloads`;" );
    }

    public function get_114 ( $version )
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "UPDATE  `options` SET  `key` =  'active_plugins' WHERE  `options`.`key` ='active_plugins';" );
    }

    public function touch_db()
    {
        $config = config::get('db');

        $server = $config['default']['host'];
        $username = $config['default']['username'];
        $password = $config['default']['password'];

        $host = $server;

        $link = @mysql_connect($host, $username, $password, TRUE);

        if (!$link)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function set_db ( $version )
    {
        $config = config::get('db');

        try {
            $pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
        } catch(PDOException $e) {
            dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
        }

        $build = $pdo->exec( "UPDATE  `options` SET  `value` =  '{$version}' WHERE  `options`.`key` ='db_version';" );
    }

}