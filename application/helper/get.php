<?
    // From Chyrp
    
    /**
     * Function: upload_from_url
     * Copy a file from a specified URL to their upload directory.
     *
     * Parameters:
     *     $url - The URL to copy.
     *     $extension - An array of valid extensions (case-insensitive).
     *     $path - A sub-folder in the uploads directory (optional).
     *
     * See Also:
     *     <upload>
     */
    function upload_from_url($url, $extension = null, $path = "") {
        $file = tempnam(null, "chyrp");
        file_put_contents($file, get_remote($url));

        $fake_file = array("name" => basename(parse_url($url, PHP_URL_PATH)),
                           "tmp_name" => $file);

        return upload($fake_file, $extension, $path, true);
    }
	 
	  /**
     * Function: get_remote
     * Grabs the contents of a website/location.
     *
     * Parameters:
     *     $url - The URL of the location to grab.
     *
     * Returns:
     *     The response from the remote URL.
     */
    function get_remote($url) {
        extract(parse_url($url), EXTR_SKIP);

        if (ini_get("allow_url_fopen")) {
            $content = @file_get_contents($url);
            if ($http_response_header[0] != "HTTP/1.1 200 OK")
                $content = "Server returned a message: $http_response_header[0]";
        } elseif (function_exists("curl_init")) {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_TIMEOUT, 60);
            $content = curl_exec($handle);
            $status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            curl_close($handle);
            if ($status != 200)
                $content = "Server returned a message: $status";
        } else {
            $path = (!isset($path)) ? '/' : $path ;
            if (isset($query)) $path.= '?'.$query;
            $port = (isset($port)) ? $port : 80 ;

            $connect = @fsockopen($host, $port, $errno, $errstr, 2);
            if (!$connect) return false;

            # Send the GET headers
            fwrite($connect, "GET ".$path." HTTP/1.1\r\n");
            fwrite($connect, "Host: ".$host."\r\n");
            fwrite($connect, "User-Agent: Chyrp/".CHYRP_VERSION."\r\n\r\n");

            $content = "";
            while (!feof($connect)) {
                $line = fgets($connect, 128);
                if (preg_match("/\r\n/", $line)) continue;

                $content.= $line;
            }

            fclose($connect);
        }

        return $content;
    }