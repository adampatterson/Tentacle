<?php
/**
* Class: Smushit
*/


/**
 * Description: Compresses images using Smush.it
 * 
 * @license MIT
 * @author  Mathew Davies <thepixeldeveloper@googlemail.com>
 */
class smushit 
{
    const user_agent = 'Smush.it PHP Class (+http://mathew-davies.co.uk)';

    private $curl = NULL;

    /**
     * Smush.it request URL
     */
    const url = 'http://www.smushit.com/ysmush.it/ws.php';

    /**
     * Make sure any prerequisite are installed.
     */
    public function __construct() {
        if ( ! extension_loaded( 'json' ) ) {
            throw new RuntimeException('The json extension was not found');
        }
        if ( ! extension_loaded( 'curl' ) ) {
            throw new RuntimeException('The cURL extension was not found.');
        }

        // cURL handler
        $this->curl = curl_init();

        // Return HTTP response
        curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, TRUE );
    }
    
    /**
     * Compress image using smush.it. Image must be available online
     *
     * @param  string url to image.
     * @throws Smush_exception
     * @return object
     * 
     *  src       = source location of input image
     *  src_size  = size of the source image in bytes
     *  dest      = temporary location of the compressed image
     *  dest_size = size of compressed image in bytes
     *  percent   = how much smaller the compressed image is
     */
    public function compress($image) {
        // Set appropriate URL.
        curl_setopt( $this->curl, CURLOPT_URL, self::url.'?'.http_build_query( array('img' => $image ) ) );

        // Set user agent
        curl_setopt( $this->curl, CURLOPT_USERAGENT, self::user_agent );

        // Execute the HTTP request
        $request = curl_exec($this->curl);

        // JSON response
        $result = json_decode($request);

        if ( isset ( $result->error ) ) {
            throw new Smush_exception($result->error, $image);
        }
        
        $result->dest = urldecode($result->dest);
        
        // Return response data
        return $result;
    }
}

/**
 * Custom exception handler
 */
class Smush_exception extends Exception {

    /**
     * Path to image
     * @var string $image
     */
    private $image = '';

    /**
     * Overload the exception construct so we can provide an image name
     * @param string $message
     * @param string $image
     */
    public function  __construct($message, $image) {
        $this->image = $image;
        parent::__construct($message);
    }

    // Return image path.
    final function getImage() {
        return $this->image;
    }
}

?>