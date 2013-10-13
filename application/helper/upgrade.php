<?
load::helper('file');

/**
* File: Upgrade
*/
class upgrade {
	/**
	* Function: check_core_version
	* Checks what the latest Tentacle version is that is available at tentaclecms.com
	* 
	* Returns:
	*     A string containing a message and a link to the latest version of Tentacle.
	*/
	 public static function check_core_version()
	 {
		$serpent = load::model( 'serpent' );
		$v = $serpent->get_core();
		
		if ( is::update( TENTACLE_VERSION, $v->version ) ):
	        _e('<p class="well"><span class="label label-important">Important</span> You currently have version <strong>'.TENTACLE_VERSION.'</strong>, There is a newer version of Tentacle CMS available, Click <a href="'.ADMIN.'updates/'.'">here</a> and Upgrade to <strong>'. $v->version.'</strong></p>');
				return true;
		endif;
	}
	
	 public static function check_core_version_footer()
	 {
		$serpent = load::model( 'serpent' );
		$v = $serpent->get_core();
		
		if ( is::update( TENTACLE_VERSION, $v->version ) ):
			_e('<a href="'.ADMIN.'updates/" class="badge badge-success">Get '.$v->version.'</a>');        
			return true;
		else:
			_e(TENTACLE_VERSION);			
			return false;
		endif;
	}
	
	
	public static function make_nodeload($url)
	{
		return str_replace("https://", "http://nodeload.", $url);
	}


	public static function core( $update ) {

        $prev_tentacle_version = TENTACLE_VERSION;

		$filedata = get::url_contents($update);

		if (!is_dir(STORAGE_DIR.'/upgrade/')) {
			if (!mkdir(STORAGE_DIR.'/upgrade/', 0755, true)) {
			    die('Failed to create folders...');
			}
		}

		file_put_contents(STORAGE_DIR.'/upgrade/update.zip', $filedata);

		if (file_exists(STORAGE_DIR.'/upgrade/update.zip')) {
			echo '<p>File downloaded!</p>';
		}

		$zip = new ZipArchive;

		if ($zip->open(STORAGE_DIR.'/upgrade/update.zip') === TRUE) {
		    $zip->extractTo(STORAGE_DIR.'/upgrade/');
		    $zip->close();

				$archive_folder = '';

				chdir(STORAGE_DIR.'/upgrade');
				$update_path = array_filter(glob('*'), 'is_dir');
				$update_path = $update_path[0];

				chdir(STORAGE_DIR.'/upgrade/'.$update_path);
				$update_files = recursive_glob('*.*');

				echo '<ul class="list">';

				foreach ($update_files as $file) {
					$parts = string_to_parts($file);

					$update_file_path = STORAGE_DIR.'/upgrade/'.$update_path.'/';
					$site_folder_path = APP_ROOT.'/'.$parts['path'];
					$site_file_path = APP_ROOT.'/'.$parts['full'];

                    if (file_exists($site_file_path)) {

                        if (compare_file( $site_file_path, $update_file_path.$parts['full'] ) ){
                            echo "<li><strong>No Change:</strong> ".$parts['full']."</li>";
                        } else {
                            echo "<li><strong>Updated:</strong> ".$parts['full']."</li>";

                            $file = file_get_contents( $update_file_path.$parts['full'] );

                            $fp = fopen( $site_file_path, 'w' );

                            fwrite($fp, $file);
                            fclose($fp);
                        }
                    } else {
                        echo "<li><strong>Added:</strong> ".$parts['full']."</li>";

                        $file = file_get_contents( $update_file_path.$parts['full'] );

                        $fp = fopen( $site_file_path, 'w' );

                        fwrite($fp, $file);
                        fclose($fp);
                    }
				}

				echo '</ul>';

				# Clean up!
				delete_dir($update_path);
				unlink(STORAGE_DIR.'/upgrade/update.zip');

				note::set('success','upgrade_message','Tentacle has been successfully upgraded.');

                return $prev_tentacle_version;

		} else {
		    note::set('error','upgrade_message','Something went wrong!');
		}
	}
	
	
	public function theme( $theme )
	{
		
	}
	
	
	public function plugin( $plugin )
	{
		
	}
}

/**
* Function: tentacle_upgrade
* Upgrade process will load SQL from within the SQL model.
*
* Returns:
* 		bool
*/
function upgrade_db() {
	// current db version is stored in the database
	// DB version is saved in the config file in TENTACLE_DB_VERSIONdf
	upgrade_all();
}


/**
* Function: upgrade_all
* Functions to be called in install and upgrade scripts.
*
* Returns:
* 		bool
*/
function upgrade_all() {
	
	// We are up-to-date.  Nothing to do.
	if ( get::db_version() == get::current_db_version() )
		return false;

	$sql = load::model( 'migration' );
		
	$i = get::current_db_version()+1;
	while ($i <= get::db_version()):
	    echo $i;
	
		$version = 'get_'.$i;
		
		$sql->$version();
	    $i++;
	endwhile;
	
	$setting = load::model( 'settings' );
	
	$update_db = $setting->update( 'db_version', get::db_version() );

	return true;
}

/*
function rollback($back)
{
    foreach($back as $b)
    {
        $f = FCPATH . $b;
        @rename($f, str_replace('.off', '', $f));
    }
}


// Move these to off position in case we need to rollback
$movers = array('admin', 'app', 'api.php', 'i.php', 'index.php', 'preview.php', 'dl.php');
$moved = array();

foreach($movers as $m) {
    $path = FCPATH . $m;
    $to = $path . '.off';
    if (file_exists($to))
    {
        delete_files($to, true, 1);
    }
    if (file_exists($path))
    {
        if (rename($path, $to))
        {
            $moved[] = basename($to);
        }
        else
        {
            rollback($moved);
            umask($old_mask);
            fail();
        }
    }
}

$this->unzip->extract($core);

@unlink($core);

foreach($movers as $m)
{
    if (!file_exists($m))
    {
        rollback($moved);`
        umask($old_mask);
        fail('Koken did not update properly. Please refresh the page and try again. If you continue to have issues, contact support.');
    }
}

foreach($moved as $m)
{
    $path = FCPATH . $m;
    if (is_dir($path))
    {
        delete_files($path, true, 1);
    }
    else if (file_exists($to))
    {
        unlink($path);
    }
}

die(
    json_encode(
        array('migrations' => array_values(
            array_diff(
                scandir($this->migrate_path), $migrations_before)
            )
        )
    )
);

*/