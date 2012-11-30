<?php
/**
 * MyBB 1.6
 * Copyright 2010 MyBB Group, All Rights Reserved
 *
 * Website: http://mybb.com
 * License: http://mybb.com/about/license
 *
 * $Id: functions_serverstats.php 5297 2010-12-28 22:01:14Z Tomm $
 *
 * Modified for Tentacle CMS by Adam Patterson
 */

function build_server_stats($is_install=1, $prev_version='', $charset='')
{
	load::library('uaparser');
	$ua = UA::parse();
	
	$geo_meta = maybe_encoded(get::url_contents('http://geo.tentaclecms.com/'));
	
	$info = array();
	
	// Is this an upgrade or an install?
	if($is_install == 1)
	{
		$info['is_install'] = 1;
	}
	else
	{
		$info['is_install'] = 0;
	}
	
	// If we are upgrading....
	if($info['is_install'] == 0)
	{
		// What was the previous version?
		$info['prev_version'] = $prev_version;
	}
	
	// What's our current version?
	$info['current_version'] = TENTACLE_VERSION;
	
	// What is our current charset?
	$info['charset'] = $charset;

	// Parse phpinfo into array
	$phpinfo = parse_php_info();
	
	// PHP Version
	$info['phpversion'] = phpversion();

	// MySQL Version
	$info['mysql'] = 0;
	if(array_key_exists('mysql', $phpinfo))
	{
		$info['mysql'] = $phpinfo['mysql']['Client API version'];
	}

	// PostgreSQL Version
	$info['pgsql'] = 0;
	if(array_key_exists('pgsql', $phpinfo))
	{
		$info['pgsql'] = $phpinfo['pgsql']['PostgreSQL(libpq) Version'];
	}

	// SQLite Version
	$info['sqlite'] = 0;
	if(array_key_exists('sqlite', $phpinfo))
	{
		$info['sqlite'] = $phpinfo['sqlite']['SQLite Library'];
	}
	
	// Iconv Library Extension Version
	$info['iconvlib'] = 0;
	if(array_key_exists('iconv', $phpinfo))
	{
		$info['iconvlib'] = html_entity_decode($phpinfo['iconv']['iconv implementation'])."|".$phpinfo['iconv']['iconv library version'];
	}

	// Check GD & Version
	$info['gd'] = 0;
	if(array_key_exists('gd', $phpinfo))
	{
		$info['gd'] = $phpinfo['gd']['GD Version'];
	}

	// CGI Mode
	$sapi_type = php_sapi_name();

	$info['cgimode'] = 0;
	if(strpos($sapi_type, 'cgi') !== false)
	{
		$info['cgimode'] = 1;
	}
	
	// Server Software
	$info['server_software'] = $_SERVER['SERVER_SOFTWARE'];
	
	// Allow url fopen php.ini setting
	$info['allow_url_fopen'] = 0;
	if(ini_get('safe_mode') == 0 && ini_get('allow_url_fopen'))
	{
		$info['allow_url_fopen'] = 1;
	}
	
	// Check classes, extensions, php info, functions, and php ini settings
	$classes = array(
		'dom' 					=> 'DOMElement',
		'soap' 					=> 'SoapClient',
		'xmlwriter' 			=> 'XMLWriter',
		'imagemagick' 			=> 'Imagick');

	$extensions = array(
		'zendopt' 				=> 'Zend Optimizer',
		'xcache' 				=> 'XCache',
		'eaccelerator' 			=> 'eAccelerator',
		'ioncube' 				=> 'ionCube Loader',
		'PDO' 					=> 'PDO',
		'pdo_mysql' 			=> 'pdo_mysql',
		'pdo_pgsql' 			=> 'pdo_pgsql',
		'pdo_sqlite' 			=> 'pdo_sqlite',
		'pdo_oci' 				=> 'pdo_oci',
		'pdo_odbc' 				=> 'pdo_odbc');
	
	$phpinfo = array(
		'zlib' 					=> 'zlib',
		'mbstring' 				=> 'mbstring',
		'exif' 					=> 'exif',
		'zlib' 					=> 'zlib');
	
	$functions = array(
		'sockets' 				=> 'fsockopen',
		'mcrypt' 				=> 'mcrypt_encrypt',
		'simplexml' 			=> 'simplexml_load_string',
		'ldap' 					=> 'ldap_connect',
		'mysqli' 				=> 'mysqli_connect',
		'imap' 					=> 'imap_open',
		'ftp' 					=> 'ftp_login',
		'pspell' 				=> 'pspell_new',
		'apc' 					=> 'apc_cache_info',
		'curl' 					=> 'curl_init',
		'iconv' 				=> 'iconv');
	
	$php_ini = array(
		'post_max_size' 		=> 'post_max_size',
		'upload_max_filesize' 	=> 'upload_max_filesize',
		'safe_mode' 			=> 'safe_mode',
		'memory_limit'			=> 'memory_limit',
		'get_browser'			=> 'get_browser',
		'short_open_tag'		=> 'short_open_tag');

		$classe_string = '';
		foreach($classes as $name => $what)
		{		
			if(class_exists($what))
			{
			$classe_string .= $name.'|';
			}
		}
		$info['classes'] = $classe_string;
		

		$extension_string = '';
		foreach($extensions as $name => $what)
		{
			if(extension_loaded($what))
			{
			$extension_string .= $name.'|';
			}
		}
		$info['extensions'] = $extension_string;


		$phpinfo_stirng = '';
		foreach($phpinfo as $name => $what)
		{
			if(array_key_exists($what, $phpinfo))
			{
			$phpinfo_stirng .= $name.'|';
			}
		}
		$info['phpinfo'] = $phpinfo_stirng;


		$function_string = '';
		foreach($functions as $name => $what)
		{
			if(function_exists($what))
			{
			$function_string .= $name.'|';
			}
		}
		$info['functions'] = $function_string;


		foreach($php_ini as $name => $what)
		{
			if(ini_get($what) != 0)
			{
				$info[$name] = ini_get($what);
			}
			else
			{
				$info[$name] = 0;
			}
		}	
	
	// Host URL & hostname
	$info['hosturl'] = $info['hostname'] = "unknown/local";
	if($_SERVER['HTTP_HOST'] == 'localhost')
	{
		$info['hosturl'] = $info['hostname'] = "localhost";
	}

	// Check the hosting company
	if(strpos($_SERVER['HTTP_HOST'], ".") !== false)
	{
		$host_url = "http://www.whoishostingthis.com/".str_replace(array('http://', 'www.'), '', $_SERVER['HTTP_HOST']);

		$hosting = get::url_contents($host_url);
		
		if($hosting)
		{
			preg_match('#We believe \<a href\="http:\/\/www.whoishostingthis.com\/linkout\/\?t\=[0-9]&url\=?([^"]*)" (title="([^"]*)" )target\=\_blank\>([^<]*)\<\/a\>#ism', $hosting, $matches);
			
			$info['hosturl'] = "unknown/no-url";
			if(isset($matches[1]) && strlen(trim($matches[1])) != 0 && strpos($matches[1], '.') !== false)
			{
				$info['hosturl'] = strtolower($matches[1]);
			}
			else if(isset($matches[3]) && strlen(trim($matches[3])) != 0 && strpos($matches[3], '.') !== false)
			{
				$info['hosturl'] = strtolower($matches[3]);
			}

			if(isset($matches[4]) && strlen(trim($matches[4])) != 0)
			{
				$info['hostname'] = $matches[4];
			}
			elseif(isset($matches[3]) && strlen(trim($matches[3])) != 0)
			{
				$info['hostname'] = $matches[3];
			}
			elseif(isset($matches[2]) && strlen(trim($matches[2])) != 0)
			{
				$info['hostname'] = str_replace(array('title=', '"'), '', $matches[2][0]);
			}
			elseif(strlen(trim($info['hosturl'])) != 0 && $info['hosturl'] != "unknown/no-url")
			{
				$info['hostname'] = $info['hosturl'];
			}
			else
			{
				$info['hostname'] = "unknown/no-name";
			}
		}
	}
	
	if (isset($geo_meta)) {
		$info['country'] 	= $geo_meta->countryName;
		$info['region'] 	= $geo_meta->regionName;
		$info['city'] 		= $geo_meta->cityName;
	}

	if(isset($_SERVER['HTTP_USER_AGENT']))
	{
		$info['useragent'] = $ua->full;
	}
	
	// We need a unique ID for the host so hash it to keep it private and send it over
	if($_SERVER['HTTP_HOST'] == "localhost")
	{
		$id = $_SERVER['HTTP_HOST'].time();
	}
	else
	{
		$id = $_SERVER['HTTP_HOST'];
	}

	if(function_exists('sha1'))
	{
		$info['id'] = sha1($id);
	}
	else
	{
		$info['id'] = md5($id);
	}
	
	$string = "";
	$amp = "";
	foreach($info as $key => $value)
	{
		$string .= $amp.$key."=".urlencode($value);
		$amp = "&amp;";
	}

	$server_stats_url = 'http://stats.tentaclecms.com/?'.$string;

	$return = array();
	$return['info_sent_success'] = false;
	
	if(get::url_contents($server_stats_url) !== false)
	{
		$return['info_sent_success'] = true;
	}
	
	$return['info_image'] = "<img src='http://stats.tentaclecms.com/?{$string}&amp;img=1' />";
	$return['info_get_string'] = $string;
	
	return $return;
}