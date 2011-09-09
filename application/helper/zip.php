<?php	
/**
 * extract_zip function
 *
 * @param string $filename 
 * @return true
 * @author Adam Patterson
 *
 * @todo set the extraction location. Make a function for moving files around.
 */	
function extract_zip( $filename, $extract_to = '/' )
{
    if ( class_exists( 'ZipArchive' ) )
    {
        $zip = new ZipArchive;
        $result = $zip->open( $filename );
        if ( $result === true )
        {
            $zip->extractTo( $extract_to );
            $zip->close();
        }
        # otherwise, try PCLzip - there are occasionally some issues with ZipArchive::open.
    }
	else
	{
	    tentacle::library( '/pclZip', 'pclzip' );
	    $zip = new PclZip( $filename );
	    if ($zip->extract() == 0)
	    {
	        return $archive->errorName();
	    }
	    else
	    {
	        return true;
	    }
	}
}


/**
 * download_and_extract_zip function
 *
 * @param string $appname 
 * @param string $appdata 
 * @return void
 * @author Adam Patterson
 */
function download_and_extract_zip( $appname, $appdata )
{
	$zipped = file_get_contents( $appdata );
    if (!$zipped) {
    	echo 'Download error.';
    }

    $f = fopen("$appname.zip", 'w+');
    if (!is_resource($f)) 
	{
    	echo 'Possible permissions error.';
    }

    $result = fwrite($f, $zipped);
    fclose($f);
    $unzip_result = extract_zip("$appname.zip", STORAGE_DIR.'/');
    unlink("$appname.zip");

    if ($unzip_result !== true)
    {
        return $unzip_result;
    }
}