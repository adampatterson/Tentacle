<?

function write_htaccess()
{	
	$htaccess = "RewriteEngine on\n\n";	
	$htaccess .= "RewriteCond $1 !^(index\.php|tentacle|favicon\.ico|storage|themes|googlec09c5f65801ea65d\.html)\n";
	$htaccess .= "RewriteRule ^(.*)$ index.php?__dingo_page=$1 [L]\n";

	$fp = @fopen('./.htaccess', 'w');

	if (!$fp):
		die("Sorry, we couldn't write to ~/.htaccess");
	else:
		fwrite($fp, $htaccess);
		fclose($fp);
	endif;
}