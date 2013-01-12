<?

# Application's Base URL
if ($_SERVER["SERVER_PORT"] != '80' ):
$port = ':'.$_SERVER["SERVER_PORT"];
else:
$port = '';
endif;

if ( dirname($_SERVER['PHP_SELF'])  == '/' ):
$directory = '';
else:
$directory = dirname($_SERVER['PHP_SELF']);
endif;

define('BASE_URI'      , $_SERVER['REQUEST_URI'].$port );

# @todo BASE_URL may need some testing in other environments
//define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$port.$directory.'/' );
define('BASE_URL'      ,'http://'.$_SERVER["SERVER_NAME"].$directory.'/' );

# Application's Base Application URL
define('TENTACLE_URL'     , BASE_URL.'tentacle/');
define('TENTACLE_URI'     , APP_ROOT.'/tentacle');

# Admin's Base URL
define('ADMIN'            , BASE_URL.'admin/');
define('ADMIN_URL'        , BASE_URL.'tentacle/');
define('ADMIN_URI'        , APP_ROOT.'tentacle/');
define('ADMIN_JS'   	  , BASE_URL.'tentacle/js/');
define('ADMIN_CSS'     	  , BASE_URL.'tentacle/css/');
define('ADMIN_IMG'     	  , BASE_URL.'tentacle/images/');

define('TENTACLE_LIB'     , APP_ROOT.'/application/library/');

# Image Size
define('GRAVATAR_SIZE' 	  , "60" );

# Folders
define('STORAGE_DIR'   	  , APP_ROOT.'/storage');
define('STORAGE_URL'   	  , BASE_URL.'storage');

define('TEMP'		   	  , STORAGE_DIR.'/temp/');

define('THEMES_DIR'    	  , APP_ROOT.'/themes/');
define('THEMES_URL'    	  , BASE_URL.'themes');

define('TENTACLE_PLUGIN'  , APP_ROOT.'/plugins');

define('IMAGE_DIR'     	  , APP_ROOT.'/storage/images/');
define('IMAGE_URL'	   	  , BASE_URL.'storage/images/');
define('IMAGE_URI'	   	  , 'tentacle/storage/images/');
# See application/helper/tentacle.php for other constants set using functionality not loaded yet.

// Constants for expressing human-readable intervals
// in their respective number of seconds.
define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS',   60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS',    24 * HOUR_IN_SECONDS   );
define( 'WEEK_IN_SECONDS',    7 * DAY_IN_SECONDS    );
define( 'YEAR_IN_SECONDS',  365 * DAY_IN_SECONDS    );

define( 'ASSET_FRONT' ,1 );
define( 'ASSET_BACK'  ,2 );
define( 'ASSET_BOTH'  ,3 );

# Serpent Timeout
define( 'CHECK_TIMEOUT', 5 );

define('TENTACLE_VERSION', 'v0.9');

# Holds the Tentacle DB revision, increments when changes are made to the Tentacle sql model.
define('TENTACLE_DB_VERSION', '115');

# Holds the required PHP versionw
define('REQUIRED_PHP_VERSION', '5.3.3');

# Holds the required MySQL version
define('REQUIRED_MYSQL_VERSION', '5.5');
