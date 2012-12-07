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

/**
 * Function: maybe_encoded
 *	Unserialize value only if it was serialized.
 *	JSON Decode value only if it was JSON encoded
 *
 * Parameters:
 *	$original - string $original Maybe unserialized or json encoded
 *
 * Returns:
 *	$original - mixed Unserialized/json_decoded data.
 */
function maybe_encoded( $original ) {
    if ( is_serialized( $original ) ) // don't attempt to unserialize data that wasn't serialized going in
        return @unserialize( $original );

    if ( is_json( $original ) ) // don't attempt to unserialize data that wasn't serialized going in
        return @json_decode( $original );

    return $original;
}
