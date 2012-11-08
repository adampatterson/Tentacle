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
		
		if ( is_update( TENTACLE_VERSION, $v->version ) ):
	        _e('<p class="well"><span class="label label-important">Important</span> Currently you have <strong>'.TENTACLE_VERSION.'</strong>, There is a newer version of Tentacle CMS available, Click <a href="'.ADMIN.'updates/'.'">here</a> and Upgrade to <strong>'. $v->version.'</strong></p>');
				return true;
		endif;
	}
	
	 public static function check_core_version_footer()
	 {
		$serpent = load::model( 'serpent' );
		$v = $serpent->get_core();
		
		if ( is_update( TENTACLE_VERSION, $v->version ) ):
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


	public static function core($update) {
		// Path from Serpent API
		$client = curl_init($update);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

		$filedata = curl_exec($client);

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

					if (!is_dir($site_folder_path)) {
						echo "<li><strong>Creating folder:</strong> ".$parts['path'].'</li>';

						if (!mkdir($site_folder_path, 0755, true)) {
						    die('Failed to create folders...');
						}
					}

					if (file_exists($site_file_path)) {
						echo "<li><strong>Updated:</strong> ".$parts['full']."</li>";
					} else {
						echo "<li><strong>Added:</strong> ".$parts['full']."</li>";
					}

					$file = file_get_contents( $update_file_path.$parts['full'] );

					$fp = fopen( $site_file_path, 'w' );

					fwrite($fp, $file);
					fclose($fp);
				}

				echo '</ul>';

				# Clean up!
				delete_dir($update_path);
				unlink(STORAGE_DIR.'/upgrade/update.zip');

				note::set('success','upgrade_message','Tentacle has been successfully upgraded.');

		} else {
		    note::set('error','upgrade_message','Something went wrong!');
		}
	}
	
	
	public function theme( $theme )
	{
		
	}
	
	
	public function module( $module )
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
	if ( get_db_version() == get_current_db_version() )
		return false;

	$sql = load::model( 'sql' );
		
	$i = get_current_db_version()+1;
	while ($i <= get_db_version()):
	    echo $i;
	
		$version = 'get_'.$i;
		
		$sql->$version();
	    $i++;
	endwhile;
	
	$setting = load::model( 'settings' );
	
	$update_db = $setting->update( 'db_version', get_db_version() );

	return true;
}