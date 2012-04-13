<?
/**
 * Upgrade process will load SQL from within the SQL model.
 *
 * @author Adam Patterson
 */
function tentacle_upgrade() {
	// current db version is stored in the database
	// DB version is saved in the config file in TENTACLE_DB_VERSION
	if ( get_db_version() == get_current_db_version() )
		return;

	upgrade_all();
}

/**
 * Functions to be called in install and upgrade scripts.
 *
 * @since 1.0.0
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