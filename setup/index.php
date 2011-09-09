<?php
/*
Created by: Adam Patterson

This is a free aplication you can change what 
ever you like as long as you keep mention of my name. 

	Copyright (c) 2009, Adam Patterson
	http://www.adampatterson.ca | http://www.studiolounge.net
	Installer is released under the GPL license
	http://www.gnu.org/licenses/gpl.txt

This script is designed to let users create a config.php file used to connect 
to a MySQL DB and install the default MySQL into the DB.
*/

if (!is_writable('../application/config/deployment/')) die("Sorry, I can't write to the directory. You'll have to either change the permissions on your installation directory or create your config.php manually.");

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installer &rsaquo; Setup Configuration File</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../assets/lib/blueprint/screen.css" media="all"/>
<style type="text/css">
  body { width: 42em; margin: 0 auto; margin-top: 30px; }
  code { font-family: monaco, monospace; }
  h3 { margin-bottom: 0px; }
  table { border-collapse: collapse; width: 100%; }
  table th,
  table td { padding: 0.4em; text-align: left; vertical-align: top; }
  table th { width: 12em; font-weight: normal; }
  table tr:nth-child(odd) { background: #eee; }
  table td.pass { color: #191; }
  table td.fail { color: #911; }
  td input { font-size: 14px; }
  #results { padding: 0.8em; color: #fff; font-size: 1.5em; }
  #results.pass { background: #191; }
  #results.fail { background: #911; }
  .step a, .step input { font-size: 14px; }
  .step, th { text-align: right; }
  #footer { text-align: center; border-top: 1px solid #ccc; padding-top: 1em; font-style: italic; }
  .step1 { text-align: right; }
</style>

</head>
<body>
<?php
switch($step) {
	case 0:
?>
<h1>Install!</h1>
<p>Welcome to your install. Before getting started we need some information on the database. You will need to know the following items before proceeding.</p>
<ol>
  <li>Database name</li>
  <li>Database username</li>
  <li>Database password</li>
  <li>Database host</li>
</ol>
<p><strong>If for any reason this automatic file creation doesn't work, don't worry. You may also open the <code>db-sample.php</code> in a text editor, fill in your information, and save it as <code>db.php</code>.</strong></p>
<p>In all likelihood, these items were supplied to you by your Hosting Company. If you do not have this information, then you will need to contact them before you can continue.</p>
<a href="?step=1">let's go!</a>
<?php
	break;

	case 1:
		
	// From Kohana Framework install.php
		
	?>
<h2>Step: 1 - Environment Tests</h2>

<p>
The following tests have been run to determine if [appname] will work in your environment.
If any of the tests have failed, consult the documentation for more information on how to correct the problem.
</p>

<?php $failed = FALSE ?>
<table cellspacing="0">
		<tr>
			<th>PHP Version</th>
			<?php if (version_compare(PHP_VERSION, '5.2.3', '>=')): ?>
				<td class="pass"><?php echo PHP_VERSION ?></td>
			<?php else: $failed = TRUE ?>
				<td class="fail">Kohana requires PHP 5.2.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
			<?php endif ?>
		</tr>
		
		<tr>
			<th>System Directory</th>
			<?php if (is_dir('../system/')): ?>
				<td class="pass">/system/</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The <code>/system/</code> directory does not exist.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Application Directory</th>
			<?php if (is_dir('../application/')): ?>
				<td class="pass">/application/</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The configured <code>application</code> directory does not exist or does not contain required files.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Storage Directory</th>
			<?php if (is_dir('../storage/') AND is_writable('../storage/')): ?>
				<td class="pass">/storage/</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The <code>/storeage/</code> directory is not writable.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Cache Directory</th>
			<?php if (is_dir('../application/cache/') AND is_writable('../application/cache/')): ?>
				<td class="pass">/application/cache/</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The <code>/application/cache/'</code> directory is not writable.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Config Directory</th>
			<?php if (is_dir('../application/config/deployment/') AND is_writable('../application/config/deployment/')): ?>
				<td class="pass">/application/config/deployment/</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The <code>/application/cache/'</code> directory is not writable.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Config File</th>
			<?php if (!file_exists('../application/config/deployment/db.php')): ?>
				<td class="pass">The <code>db.php</code> file has not been created yet.</td>
			<?php else: $failed = TRUE ?>
				<td class="fail"><p>The file <code>db.php</code> already exists. If you need to reset any of the configuration items in this file, please delete it first.</p></td>
			<?php endif ?>
		</tr>
		<tr>
			<th>Data</th>
			<?php if (file_exists('install.sql') AND file_exists('data.sql')): ?>
				<td class="pass">The <code>install.sql</code> file exists.</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">The instalation files are missing. Please make sure that <code>install.sql</code> and <code>data.sql</code> are in the setup folder. </p></td>
			<?php endif ?>
		</tr>
		<tr>
			<th>URI Determination</th>
			<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
				<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
				<td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> is available.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>cURL Enabled</th>
			<?php if (extension_loaded('curl')): ?>
				<td class="pass">Pass</td>
			<?php else: ?>
				<td class="fail">Kohana requires <a href="http://php.net/curl">cURL</a> for the Remote class.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>mcrypt Enabled</th>
			<?php if (extension_loaded('mcrypt')): ?>
				<td class="pass">Pass</td>
			<?php else: ?>
				<td class="fail">[appname] requires <a href="http://php.net/mcrypt">mcrypt</a> for the Encrypt class.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>GD Enabled</th>
			<?php if (function_exists('gd_info')): ?>
				<td class="pass">Pass</td>
			<?php else: ?>
				<td class="fail">[appname] requires <a href="http://php.net/gd">GD</a> v2 for the Image class.</td>
			<?php endif ?>
		</tr>
		<tr>
			<th>PDO Enabled</th>
			<?php if (class_exists('PDO')): ?>
				<td class="pass">Pass</td>
			<?php else: ?>
				<td class="fail">[appname] can use <a href="http://php.net/pdo">PDO</a> to support additional databases.</td>
			<?php endif ?>
		</tr>
	</table>

<?php if ($failed === TRUE): ?>
		<p id="results" class="fail">✘ Addressbook may not work correctly with your environment.</p>
	<?php else: ?>
		<p id="results" class="pass">✔ Your environment passed all requirements.<br />
			Go onto the <a href="?step=2">Next Step</a></p>
	<?php endif ?>


<?php
	break;

	case 2:
?>
<h2>Step: 2 - Database Information</h2>
<form method="post" action="index.php?step=3">
  <p>Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
  <h3>Database Name</h3>
  <p><input name="dbname" type="text" size="25" value="" /><br />
The name of the database you want to run your script in.</p>
  
  <h3>User Name</h3>
  <p><input name="uname" type="text" size="25" value="" /><br />
Your MySQL username</p>

<h3>Password</h3>
<p><input name="pwd" type="text" size="25" value="" /><br />
Your MySQL password.</p>

<h3>Database Host</h3>
<p><input name="dbhost" type="text" size="25" value="" /><br />
Most Likely  won't need to change this value.</p>
<!--
<h3>Extra Info</h3>
<p><input name="custom" type="text" size="25" value="Apples" /><br />
For other information saved to the config.php file.</p>
-->
  <h2 class="step1">
    <input name="submit" id= "fsubmit" type="submit" value="Submit" />
  </h2>
</form>
<?php
	break;	

	case 3:
  $dbname  = trim($_POST['dbname']);
  $dbuser   = trim($_POST['uname']);
  $dbpwd = trim($_POST['pwd']);
  $host  = trim($_POST['dbhost']);
  $custom  = trim($_POST['custom']);

  // We'll fail here if the values are no good.
  // Make a MySQL Connection
  $cid = mysql_connect($host,$dbuser,$dbpwd);
  if (!$cid) { print "ERROR: " . mysql_error() . "\n ";    
  }
  #select database to use
  mysql_select_db("$dbname") or die(mysql_error());
  
// Setup the Temp db.php file
  $setup_handle = fopen('db.php', 'w');

  $setup_source = array (
  "<? \n",
  "$","dbname = 'databasename'; \n",
  "$","dbuser = 'username'; \n",
  "$","dbpwd = 'password'; \n",
  "$","host = 'localhost'; \n",
  "?>" );

  $setup_search = array ( databasename, username, password, localhost);
  $setup_replace = array ($dbname, $dbuser, $dbpwd, $host);
  
  $setup_source = str_replace ( $setup_search, $setup_replace, $setup_source );
  foreach ( $setup_source as $str )
  fwrite($setup_handle, $str);
  
// Setup the Deployment db.php file
  $handle = fopen('../application/config/deployment/db.php', 'w');
  $source = array (
  "<? if(!defined('DINGO')){die('External Access to File Denied');} \n ",
  "config::set('db',array(",
  "  'default'=>array(",
      "'driver'=>'mysql',\n",
      "'host'=>'fill_host',\n",
      "'username'=>'fill_username', \n",
      "'password'=>'fill_password',  \n",
      "'database'=>'fill_databasename' \n",
    ")
  ));
  ?>" );

$search = array ( fill_databasename, fill_username, fill_password, fill_host);
$replace = array ($dbname, $dbuser, $dbpwd, $host);

$source = str_replace ( $search, $replace, $source );
foreach ( $source as $str )
	fwrite($handle, $str);
?>
<h2>Step: 3 - Test the Database</h2>
<? if (file_exists('../application/config/deployment/db.php')) { ?>
<p>All right everything is ready to roll!</p>
<a href="?step=4">let&#8217;s install the MySQL!</a>
<? } else {?>
<p>Something went wrong</p>
<? }  // End Config created?

break;	
case 4:
?>
<h2>Step: 4 - Create the file</h2>
<?php
if (file_exists('../application/config/deployment/db.php')) {
  
  require_once('db.php');
   // Make a MySQL Connection
  $cid = mysql_connect($host,$dbuser,$dbpwd);
  if (!$cid) { print "ERROR: " . mysql_error() . "\n ";    
  }
  #select database to use
  mysql_select_db("$dbname") or die(mysql_error());

	
	// Open the Install SQL file $install_sql 
	$fh = fopen('install.sql', 'r');
	$theInstall = fread($fh, filesize('install.sql'));
	fclose($fh);
	
  $sql_query = explode(';', $theInstall);

	echo "<h3>Creating tables...</h3>";
	
  foreach ($sql_query as $query) {
    if (!empty($query)) {
      $result = mysql_query($query);
      mysql_error();
      if (!$result) {
        echo "<h3>Done!</h3><br /><a href='?step=5'>Add some Data</a>";
        return false;
      }
    }
  }

	
	}
break;	
case 5: ?>
<h2>Step: 5 - Load the data</h2>
<?php
if (file_exists('../application/config/deployment/db.php')) {
	
	require_once('db.php');
  // Make a MySQL Connection
  $cid = mysql_connect($host,$dbuser,$dbpwd);
  if (!$cid) { print "ERROR: " . mysql_error() . "\n ";    
  }
  #select database to use
  mysql_select_db("$dbname") or die(mysql_error());
  
	// Open the Install SQL file $install_sql 
	$fh = fopen('data.sql', 'r');
	$theData = fread($fh, filesize('data.sql'));
	fclose($fh);
	
  $sql_query = explode(';', $theData);
  
	//echo $theData;
	echo "<h3>Adding Data...</h3>";
	
	  foreach ($sql_query as $query) {
    if (!empty($query)) {
      $result = mysql_query($query);
      mysql_error();
      if (!$result) {
          echo "<h3>Done!</h3>";
        return false;
      }
    }
  }
	}	
break;				
}
?>
<p id="footer">Installer by <a href="http://www.adampatterson.ca/?utm_source=php&utm_medium=addressbook&utm_campaign=script" target="_blank">adampatterson.ca</a></p>
</body>
</html>
