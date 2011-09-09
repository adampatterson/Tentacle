CREATE TABLE IF NOT EXISTS `access` (
  `accessid` int(100) NOT NULL AUTO_INCREMENT,
  `level` varchar(250) NOT NULL DEFAULT '1',
  PRIMARY KEY (`accessid`)
);

CREATE TABLE IF NOT EXISTS `addressbook` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(100) NOT NULL DEFAULT '1',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(120) NOT NULL,
  `company_name` varchar(120) NOT NULL,
  `address` text NOT NULL,
  `address2` varchar(100) NOT NULL,
  `postalcode` varchar(12) NOT NULL DEFAULT '',
  `city` text NOT NULL,
  `province` text NOT NULL,
  `country` text NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '',
  `lat` varchar(50) NOT NULL DEFAULT '',
  `lng` varchar(50) NOT NULL DEFAULT '',
  `birthdate` varchar(20) NOT NULL DEFAULT '',
  `profile_id` int(4) NOT NULL,
  `comment_id` int(4) NOT NULL,
  `primary_contact` int(4) DEFAULT NULL,
  `access` varchar(4) NOT NULL,
  `password` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `comments` longtext,
  `comment_date` int(11) DEFAULT NULL,
  `contact_Id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`commentid`)
);

CREATE TABLE IF NOT EXISTS `contacts` (
  `contactid` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `type` varchar(25) NOT NULL DEFAULT 'other',
  `label` varchar(50) NOT NULL DEFAULT 'other',
  PRIMARY KEY (`contactid`)
);

CREATE TABLE IF NOT EXISTS `groups` (
  `gid` int(100) NOT NULL AUTO_INCREMENT,
  `groups` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`)
);

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(125) NOT NULL DEFAULT '',
  `pagesize` varchar(4) NOT NULL DEFAULT '',
  `aemail` varchar(100) NOT NULL,
  `accessid` char(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `message_templates` (
  `owner` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `template` blob NOT NULL,
  PRIMARY KEY (`owner`)
);

CREATE TABLE IF NOT EXISTS `profile_photo` (
  `profileid` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `profile_date` int(11) DEFAULT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`profileid`)
);

CREATE TABLE IF NOT EXISTS `sessions` (
  `name` varchar(25) NOT NULL,
  `cookie` varchar(25) NOT NULL,
  `value` text NOT NULL,
  `expire` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `settings` (
  `enable_portal` varchar(2) NOT NULL,
  `hash_exp` varchar(250) NOT NULL,
  `google_api` varchar(250) NOT NULL,
  `sort_order` varchar(250) NOT NULL,
  `date_format` varchar(250) NOT NULL,
  `owner` varchar(250) NOT NULL,
  PRIMARY KEY (`owner`)
);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(125) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
);
