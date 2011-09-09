<?
/**
 * Function: self_url
 * Returns the current URL.
 */
function self_url() {
    $split = explode("/", $_SERVER['SERVER_PROTOCOL']);
    $protocol = strtolower($split[0]);
    $default_port = ($protocol == "http") ? 80 : 443 ;
    $port = ($_SERVER['SERVER_PORT'] == $default_port) ? "" : ":".$_SERVER['SERVER_PORT'] ;
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}


function baseUrl()
{
	return BASE_URL;
}


function baseUri()
{
	return BASE_URI;
}


function redirect_to($url = '', $external = false)
{
    if ($url == '') {
        $url = baseUrl();
    }

    header('Location: ' . $url);
	exit;
}


function page_not_found() {
    header("HTTP/1.0 404 Not Found");
    exit;
}


function refresh($sec = 1)
{
    return '<meta http-equiv="refresh" content="' . $sec . '"/>';
}


function urlTitle($url)
{
    $url = str_replace(array("\xc4\x83","\xc4\x82"),"a",$url);
    $url = str_replace(array("\xc5\x9e","\xc5\x9f"),"s",$url);
    $url = str_replace(array("\xc5\xa2","\xc5\xa3"),"t",$url);
    
    $url = utf8_decode($url);
    $url = preg_replace("`\[.*\]`U","",$url);
    $url = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$url);
    $url = htmlentities($url, ENT_COMPAT, "iso-8859-1");
    $url = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i","\\1", $url );
    $url = preg_replace( "`&([a-z]+);`i","-", $url );
    $url = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $url);
    $url = strtolower(trim($url, '-'));

    return $url;
}