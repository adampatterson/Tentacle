<?php	
/**
* File: Zip
*/


/**
* Function: extract_zip
* extract_zip function
*
* Parameters:
*     $filename - String
*
* Returns:
*     Bool
*
* See Also:
*     <download_and_extract_zip>
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
	    tentacle::library( 'pclZip' );
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
* Function: download_and_extract_zip
* download_and_extract_zip function
*
* Parameters:
* 	  $appname - Path to archive file.
* 	  $appdata - 
* 
* Returns:
*     void
*
* See Also:
*     <extract_zip>
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