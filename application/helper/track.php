<?
/**
* File: Track
*/

/**
* Function: trackback_respond
* 	Responds to a trackback request.
*
* Parameters:
*	$error - Is this an error?
*	message - Message to return.
*/
function trackback_respond($error = false, $message = "") {
    header("Content-Type: text/xml; charset=utf-8");

    if ($error) {
        echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
        echo "<response>\n";
        echo "<error>1</error>\n";
        echo "<message>".$message."</message>\n";
        echo "</response>";
        exit;
    } else {
        echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
        echo "<response>\n";
        echo "<error>0</error>\n";
        echo "</response>";
    }

    exit;
}

/**
 * Function: trackback_send
 *	Sends a trackback request.
 *
 * Parameters:
 *     $post - The post we're sending from.
 *     $target - The URL we're sending to.
 */
function trackback_send($post, $target) {
    if (empty($target)) return false;

    $target = parse_url($target);
    $title = $post->title();
    fallback($title, ucfirst($post->feather)." Post #".$post->id);
    $excerpt = strip_tags(truncate($post->excerpt(), 255));

    if (!empty($target["query"])) $target["query"] = "?".$target["query"];
    if (empty($target["port"])) $target["port"] = 80;

    $connect = fsockopen($target["host"], $target["port"]);
    if (!$connect) return false;

    $config = Config::current();
    $query = "url=".rawurlencode($post->url())."&".
             "title=".rawurlencode($title)."&".
             "blog_name=".rawurlencode($config->name)."&".
             "excerpt=".rawurlencode($excerpt);

    fwrite($connect, "POST ".$target["path"].$target["query"]." HTTP/1.1\n");
    fwrite($connect, "Host: ".$target["host"]."\n");
    fwrite($connect, "Content-type: application/x-www-form-urlencoded\n");
    fwrite($connect, "Content-length: ". strlen($query)."\n");
    fwrite($connect, "Connection: close\n\n");
    fwrite($connect, $query);

    fclose($connect);

    return true;
}

/**
 * Function: send_pingbacks
 * 	Sends pingback requests to the URLs in a string.
 *
 * Parameters:
 *     $string - The string to crawl for pingback URLs.
 *     $post - The post we're sending from.
 */
function send_pingbacks($string, $post) {
    foreach (grab_urls($string) as $url)
        if ($ping_url = pingback_url($url)) {
            require_once INCLUDES_DIR."/lib/ixr.php";

            $client = new IXR_Client($ping_url);
            $client->timeout = 3;
            $client->useragent.= " -- Chyrp/".CHYRP_VERSION;
            $client->query("pingback.ping", $post->url(), $url);
        }
}

/**
 * Function: grab_urls
 * 		Crawls a string for links.
 *
 * Parameters:
 *     	$string - The string to crawl.
 *
 * Returns:
 *     An array of all URLs found in the string.
 */
function grab_urls($string) {
    $regexp = "/<a[^>]+href=[\"|']([^\"]+)[\"|']>[^<]+<\/a>/";
    preg_match_all(Plugins::current()->filter($regexp, "link_regexp"), stripslashes($string), $matches);
    $matches = $matches[1];
    return $matches;
}

/**
 * Function: pingback_url
 * 		Checks if a URL is pingback-capable.
 *
 * Parameters:
 *     	$url - The URL to check.
 *
 * Returns:
 *     	The pingback target, if the URL is pingback-capable.
 */
function pingback_url($url) {
    extract(parse_url($url), EXTR_SKIP);
    if (!isset($host)) return false;

    $path = (!isset($path)) ? '/' : $path ;
    if (isset($query)) $path.= '?'.$query;
    $port = (isset($port)) ? $port : 80 ;

    # Connect
    $connect = @fsockopen($host, $port, $errno, $errstr, 2);
    if (!$connect) return false;

    # Send the GET headers
    fwrite($connect, "GET $path HTTP/1.1\r\n");
    fwrite($connect, "Host: $host\r\n");
    fwrite($connect, "User-Agent: Chyrp/".CHYRP_VERSION."\r\n\r\n");

    # Check for X-Pingback header
    $headers = "";
    while (!feof($connect)) {
        $line = fgets($connect, 512);
        if (trim($line) == "") break;
        $headers.= trim($line)."\n";

        if (preg_match("/X-Pingback: (.+)/i", $line, $matches))
            return trim($matches[1]);

        # Nothing's found so far, so grab the content-type
        # for the <link> search afterwards
        if (preg_match("/Content-Type: (.+)/i", $headers, $matches))
            $content_type = trim($matches[1]);
    }

    # No header found, check for <link>
    if (preg_match('/(image|audio|video|model)/i', $content_type)) return false;
    $size = 0;
    while (!feof($connect)) {
        $line = fgets($connect, 1024);
        if (preg_match("/<link rel=[\"|']pingback[\"|'] href=[\"|']([^\"]+)[\"|'] ?\/?>/i", $line, $link))
            return $link[1];
        $size += strlen($line);
        if ($size > 2048) return false;
    }

    fclose($connect);

    return false;
}