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

define('DEV_LOG'          , APPLICATION.'/logs/');
define('ERROR_VIEW'       , APPLICATION.'/view/error/');

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

define('TENTACLE_VERSION', 'v0.9.5.2');

# Holds the Tentacle DB revision, increments when changes are made to the Tentacle sql model.
define('TENTACLE_DB_VERSION', '116');

# Holds the required PHP versionw
define('REQUIRED_PHP_VERSION', '5.3.3');

# Holds the required MySQL version
define('REQUIRED_MYSQL_VERSION', '5.5');

$messages = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    507 => 'Insufficient Storage',
    509 => 'Bandwidth Limit Exceeded'
);