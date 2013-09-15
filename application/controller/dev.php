<?php

class my
{
    static function method_name ( $text = '' )
    {
        echo 'my class method name is '.$text;
    }
}

class dev_controller {

	public function index()
	{
        var_dump(get::option('missing_key', 'default') );

        var_dump(is::mobile());
		var_dump(is::blackberry());
		var_dump(is::ipad());
		var_dump(is::ipod());
		var_dump(is::iphone());
		var_dump(is::palmpre());
		var_dump(is::android());
	}

    public function routs () {
        //route::dump_routs();
    }

    public function logger(){
        $array = array( 'one'=>'test', 'two'=>'value' );

        logger::file('Array', $array, 2);
        logger::file('Memory', '5 mb');
        logger::file('Execution Time', 'extra speedy');

        echo 'logged stuff';
    }

    public function post_type () {
        $post = load::model('content');

        $posts = $post->type( 'post' )->get_by_type('video');

        var_dump($posts);
    }


    public function error(){

        function inverse($x) {
            if (!$x) {
                throw new Exception('Division by zero.');
            }
            else return 1/$x;
        }

        try {
            echo inverse(5) . "\n";
            echo inverse(0) . "\n";
        } catch (Exception $e) {
            dingo_exception($e);
        }
    }

    public function scaffolding () {
        echo '<h2>Scaffolding Test</h2>';

        $data = get::yaml( THEMES_DIR.'/'.ACTIVE_THEME.'/template-job-application.php' );

        var_dump( $data );
    }

    public function url(){
        load::library('uaparser');
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $parser = new UAParser;
        $result = $parser->parse($ua);

        $meta['browser']                = $result->ua->family;
        $meta['browser_full']           = $result->ua->toString;
        $meta['version']                = $result->ua->toVersionString;
        $meta['user_agent']             = $result->uaOriginal;
        $meta['os']                     = $result->os->family;
        $meta['os_version']             = $result->os->toVersionString;

        var_dump($meta);
    }


    public function image() {
        $file_meta = string_to_parts('6173971608_80a56b6eb3_o.jpg');

#        chmod(IMAGE_DIR.$file_meta['name'], 0664);
        $image = new image(IMAGE_DIR.$file_meta['name']);
        $image->resize(250,200);
        $image->show();
        $image->close();
    }


    public function dispatcher(){
        $pages = load::model( 'content' )->type( 'page' )->get();

        dispatcher::set( 'pages', $pages );

        function test_function()
        {
            return dispatcher::get( 'pages' );
        }

        var_dump(test_function());
    }


    public function plugin()
    {

        function method_sad ( $text = '' )
        {
            $nav[] = array(
                'title'     => 'One'
            );

            return $nav;
        }

        function method_happy ( $text = '' )
        {
            $nav[] = array(
                'title'     => 'Two'
            );

            return $nav;
        }

        function method_fine ( $text = '' )
        {
            $nav[] = array(
                'title'     => 'Three',
            );

            return $nav;
        }

        event::on('navigation', 'method_sad', 1);
        event::on('navigation', 'method_happy', 2);
        event::on('navigation', 'method_fine', 3);

        var_dump( event::filter('navigation') );

        die;

        function method_one (){
            echo 'one ';
        }

        function method_two (){
            echo 'two ';
        }

        event::on('event_chain', 'method_one', 2);
        event::on('event_chain', 'method_two', 1);

        event::trigger('event_chain');


        echo '<h3>event::$_events after off</h3>';
        #event::off('event_chain');

        #event::off('event_chain', 'method_two');

        event::off(null, 'method_one');

        var_dump(event::$_events);


        echo '<h3>event::has()</h3>';
        var_dump(event::exists('event_chain'));


        echo "<h3>event::trigger('method_name')</h3>";

        function method_name ( )
        {
            echo 'my method name';
        }

        event::on('event_name', 'method_name');

        event::trigger('event_name');


        echo "<h3>event::trigger('event_data', 'this')</h3>";

        function method_data ( $text = '' )
        {
            echo ' 1  my method data is '.$text;
        }

        function method_data_two ( $text = '' )
        {
            echo ' 2 my method data is '.$text;
        }

        event::on('event_data', 'method_data', 1);
        event::on('event_data', 'method_data_two', 2);


        event::trigger('event_data', 'this');


        echo "<h3>event::trigger('event_class', 'that')</h3>";


        event::on('event_class', 'my::method_name');

        event::trigger('event_class', 'that');

        echo "<h3>Event chaining</h3>";

        function method_sad ( $text = '' )
        {
            return str_replace('blah', "sad", $text);
        }

        function method_happy ( $text = '' )
        {
            return str_replace('sad', "happy", $text);
        }

        function method_fine ( $text = '' )
        {
            return str_replace('happy', "fine", $text);
        }

        event::on('event_mood', 'method_sad', 1);
        event::on('event_mood', 'method_happy', 2);
        event::on('event_mood', 'method_fine', 3);

        echo event::filter('event_mood', 'I am blah!');
    }


    public function assets ()
    {
 		load::library('assets');

        script::on('codemirror', BASE_URL.'admin/template/js/codemirror/lib/codemirror-compressed.js', '0.2.0', FALSE);

        style::on('codemirror-css', BASE_URL.'admin/template/js/codemirror/lib/codemirror.css','screen', FALSE);
        style::on('codemirror-theme', BASE_URL.'admin/template/js/codemirror/theme/default.css','screen', FALSE);

        script::queue('codemirror', ASSET_BACK);

        style::queue('codemirror-css', ASSET_BACK);
        style::queue('codemirror-theme', ASSET_BACK);

        script::get_backend();
        style::get_backend();
    }


    public function url_mapper()
    {
        $urls = array(
           '/slug',
           '/slug/page/2',
           '/tag',
           '/tag/slug',
           '/tag/page/2',
           '/category',
           '/category/slug',
           '/category/page/2',
		   '/blog',
           '/blog/slug',
           '/blog/page/2',
		   '/blog/2013/12',
           '/blog/2013/12/page/2',
           '/blog/2013/12/my-name'
        );

		$routs = array(
			'tag'							=> 'tag.index',
			'tag/:alpha-numeric'			=> 'tag.slug',
			'tag/page/:int'					=> 'tag.paged',
			'category'						=> 'category.index',
			'category/:alpha-numeric'		=> 'category.slug',
			'category/page/:int'			=> 'category.paged',
			'blog'							=> 'blog.index',
			'blog/:alpha-numeric' 			=> 'blog.slug',
			'blog/page/:int'				=> 'blog.paged',
			'blog/:int/:int'				=> 'blog.date',
			'blog/:int/:int/page/:int'		=> 'blog_date.paged',
            'blog/:int/:int/:alpha-numeric'	=> 'blog_date.slug',
			':alpha-numeric' 			    => 'page.index',
			':alpha-numeric/page/:int'		=> 'page.paged'
		);

        url_map::add($routs);

        foreach($urls as $key => $url )
        {
            var_dump( $url );
            // var_dump(preg_match('/^([a-zA-Z0-9\.]+)$/',$url));
            var_dump( url_map::get( $url ) );
			echo '<hr />';
        }
    }


	public function speed($test='')
	{
		echo '<h1>Speed Test</h1>';
		# Stop output from code to be tested
			function output_buffer() { return NULL; }
			ob_start('output_buffer');

			$loops = 100;
			$exact_timer = true;

			ob_flush();
			flush();

/*
Test one
*/
				$start_time1 = microtime($exact_timer); # Start the first timer
				for($int = 0; $int < $loops; $int++):

/* ========================== */



/* ========================== */

				endfor;
				$total_time = microtime($exact_timer) - $start_time1; # Stop the first timer, and figure out the total
				$total_memory = memory_usage();

			ob_flush();
			flush();

/*
Test two
*/
				$start_time2 = microtime($exact_timer); # Start the second timer
				for($int = 0; $int < $loops; $int++):

/* ========================== */



/* ========================== */	

				endfor;
				$total_time2 = microtime($exact_timer) - $start_time2; # Stop the second timer, and figure out the total
				$total_memory2 = memory_usage();

			ob_end_flush(); # Enable output again

			# Echo the results for AJAX
			$results = array(
				'total_time1' => $total_time,
				'total_time2' => $total_time2
			);

			if($total_time < $total_time2):
				$res = ( ( $total_time / $total_time2 ) * 100 ) - 100;

				echo '<p>your first test was faster by <strong>'.abs(round($res)).'%</strong>, it took <strong>'.$total_time.'</strong> seconds to execute vs <strong>'.$total_time2.'</strong>.</p>';
				echo '<p>Your first test used <strong>'.$total_memory.'</strong> vs <strong>'.$total_memory2.'</strong></p>';

			elseif($total_time > $total_time2):
				$res = ( ( $total_time2 / $total_time ) * 100 ) - 100;

				echo '<p>Your second test was faster by <strong>'.abs(round($res)).'%</strong>, it took <strong>'.$total_time2.'</strong> seconds to execute vs <strong>'.$total_time.'</strong>.</p>';
				echo '<p>Your second test used <strong>'.$total_memory2.'</strong> vs <strong>'.$total_memory.'</strong></p>';

			elseif($total_time === $total_time2):
				echo '<p>The code samples scored equal times. Use either.</p>';
			endif;
	}


	public function demo_clean()
	{
		$config = config::get('db');

		try {
			$pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
		} catch(PDOException $e) {
			dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
		}

		$build = $pdo->exec( "TRUNCATE TABLE  `posts`" );

		$build = $pdo->exec( "TRUNCATE TABLE `post_meta`" );

		$build = $pdo->exec( "TRUNCATE TABLE `users`" );

        user::create(array(
            'username'=>'demo',
            'email'=>'demo@tentaclecms.com',
            'password'=>'demo',
            'type'=>'administrator'
        ));

		$build = $pdo->exec( "UPDATE  `users` SET `data` = '{\"first_name\":\"Demo\",\"last_name\":\"User\",\"activity_key\":\"\",\"url\":\"\",\"display_name\":\"Demo User\",\"editor\":\"wysiwyg\"}', `registered` = 1340063724, `status` = 1 WHERE  `users`.`username` = 'demo';" );

		$build = $pdo->exec( "INSERT INTO `posts` (`id`, `parent`, `author`, `date`, `modified`, `title`, `content`, `excerpt`, `comment_status`, `ping_status`, `password`, `slug`, `type`, `menu_order`, `uri`, `visible`, `status`, `template`)
			VALUES
				(6, 0, 1, 1322853969, 1328247576, 'Home', '<p><strong>Tentacle is an OpenSource Content Management System, it is free to use.</strong></p>\r\n<p>The goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p><p><strong>Username:</strong> demo<br /><strong>Password:</strong> demo<br /><a href=\'http://demo.tentaclecms.com/admin/\'>Admin</a></p>\r\n', '', 'open', 'open', '', 'home', 'page', 1, 'home/', 'public', 'published', 'default'),
				(112, 0, 1, 1328502285, 1328560008, 'Welcome to Tentacle CMS', '<p>This is your first post!</p>\r\n', '', 'open', 'open', '', 'welcome-to-tentacle-cms', 'post', 0, 'welcome-to-tentacle-cms/', 'public', 'published', 'default'),
				(113, 0, 1, 1340070422, 1340070422, 'Blog', '', '', 'open', 'open', '', 'blog', 'page', 2, 'blog/', 'public', 'published', 'template-blog');" );

		$build = $pdo->exec( "INSERT INTO `posts_meta` (`id`, `posts_id`, `meta_key`, `meta_value`)
			VALUES
				(7, 6, 'scaffold_data', 'a:5:{s:4:\"save\";s:0:\"\";s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:4:\"tags\";s:0:\"\";}'),
				(58, 112, 'scaffold_data', 'a:6:{s:9:\"post_type\";s:9:\"type-post\";s:13:\"post_category\";a:1:{i:0;s:1:\"1\";}s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:27:\"Enter your comments here...\";s:4:\"tags\";s:0:\"\";}');" );
	}


	public function email()
	{
		$send_email = load::model( 'email' );

		$user_email = $send_email->general( 'hello@adampatterson.ca' );
	}

	/**
	* pull function
	*
	* The pull function is triggered by GitHub's Post-Receive URL.
	* Every time a push to GitHub is done staging.tcms.me will be updated.
	*
	* @return string
	* @author Adam Patterson
	*/
	public function pull()
	{
		load::helper ('git');

		echo '<pre>';
		echo pull();
		echo '</pre>';
	}


	public function relations ()
	{
		$categories = load::model( 'tags' );

		clean_out( $categories->get_all_tags( ) );
	}


	/**
	 * ========================= Google Analytics
	 * http://code.google.com/p/gapi-google-analytics-php-interface/wiki/GAPIDocumentation
	 * http://richardneililagan.com/2010/06/accessing-google-analytics-using-php-via-gapi/
	 */


	public function script_cache()
	{
		load::helper('cache');

		cache::css();
		//cache::script();

	}


	public function system ()
	{
        if (function_exists('fopen')) {
            echo 'fopen exists<br>';
        }

        if (function_exists( 'fsockopen' )) {
            echo 'fsockopen exists<br>';
        }

        if (function_exists('fopen') || (function_exists('ini_get') && ini_get('allow_url_fopen') != true) ) {
            echo 'fopen ini_get allow_url_fopen<br>';
        }

        if ( function_exists('curl_init') && function_exists('curl_exec') ){
            echo 'curl_init curl_exec exists<br>';
        }

        echo '<h3>$_SERVER</h3><hr />';
			var_dump($_SERVER);
		echo '<h3>$GLOBALS</h3><hr />';
			var_dump($GLOBALS);
		echo '<h3>$_GET</h3><hr />';
			var_dump($_GET);
		echo '<h3>$_POST</h3><hr />';
			var_dump($_POST);
		echo '<h3>$_REQUEST</h3><hr />';
			var_dump($_REQUEST);
		echo '<h3>$_SESSION</h3><hr />';
			var_dump($_SESSION);
		echo '<h3>$_ENV</h3><hr />';
			var_dump($_ENV);
		echo '<h3>$HTTP_RAW_POST_DATA</h3><hr />';
			var_dump($HTTP_RAW_POST_DATA);
		echo '<h3>$argv</h3><hr />';
			var_dump($argv);
	}


    /**
	 * theme functions
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function theme()
    {
        var_dump(get_scaffold(THEMES_DIR.'tentacle/template-profile.php'));

        define( 'SCAFFOLD' , 'TRUE' );

		echo '<h2>Detected Themes</h2>';

		var_dump(get_themes());

		echo '<h2>Valid Template Files</h2>';
        var_dump(get_templates('tentacle'));

		echo '<h2>Themes Settings</h2>';
        var_dump(get_settings('tentacle'));
	}


	/**
	* define_test function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function define_test ($admin_var ="")
	{
		//echo dirname($_SERVER['PHP_SELF']). '<br />';

		echo '<strong>DS:</strong> ' .DS . '<br />';

		echo "<strong>realpath(''):</strong>" .realpath('') . '<br />';

		echo '<strong>APP_ROOT:</strong> ' . APP_ROOT . '<br />';
		echo '<strong>STORAGE_DIR:</strong> ' . STORAGE_DIR . '<br />';
		echo '<strong>STORAGE_URL:</strong> ' . STORAGE_URL . '<br />';
		echo '<strong>THEMES_DIR:</strong> ' . THEMES_DIR . '<br />';
		echo '<strong>THEMES_URL:</strong> ' . THEMES_URL . '<br />';
		echo '<strong>IMAGE_DIR:</strong> ' . IMAGE_DIR . '<br />';
		echo '<strong>IMAGE_URL:</strong> ' . IMAGE_URL . '<br />';
		echo '<strong>IMAGE_URI:</strong> ' . IMAGE_URI . '<br /><br />';

		echo '<strong>CONFIG:</strong> ' . CONFIG . '<br />';

		echo '<strong>BASE_URL:</strong> ' . BASE_URL . '<br />';
		echo '<strong>BASE_URI:</strong> ' . BASE_URI . '<br />';
		echo '<strong>URI:</strong> ' . URI . '<br />';

		echo '<br /><strong>Admin variable:</strong> ' . $admin_var . '<br />';

		echo "<strong>CMS Details:</strong><br />";
		echo "SERVER_NAME: ". $_SERVER['SERVER_NAME'] ."<br />";
		echo "SERVER_ADDR: ". $_SERVER['SERVER_ADDR'] ."<br />";
		echo "SERVER_PORT: ". $_SERVER['SERVER_PORT'] ."<br />";


		echo "<strong>Server details:</strong><br />";
		echo "TENTACLE_URL: ". TENTACLE_URL ."<br />";
		echo "TENTACLE_URI: ". TENTACLE_URI ."<br />";
		echo "ADMIN_URL: ". ADMIN_URL ."<br />";
		echo "ADMIN_URI: ". ADMIN_URI ."<br />";
		echo "TENTACLE_LIB: ". TENTACLE_LIB ."<br />";
		echo "TENTACLE_PLUGIN: ". TENTACLE_PLUGIN ."<br />";
		echo "ADMIN_JS: ". ADMIN_JS ."<br />";
		echo "ADMIN_CSS: ". ADMIN_CSS ."<br />";
		echo "MINIFY: ". MINIFY ."<br />";
		echo "<br />";

		echo "<strong>Page details:</strong><br />";
		echo "PHP_SELF: ". $_SERVER['PHP_SELF'] ."<br />";
		echo "SCRIPT_FILENAME: ". $_SERVER['SCRIPT_FILENAME'] ."<br />";
		echo "<br />";

		echo "<strong>Request details:</strong><br />";
		echo "REMOTE_ADDR: ". $_SERVER['REMOTE_ADDR'] ."<br />";
		echo "REMOTE_PORT: ". $_SERVER['REMOTE_PORT'] ."<br />";
		echo "REQUEST_URI: ". $_SERVER['REQUEST_URI'] ."<br />";
		echo "QUERY_STRING: ". $_SERVER['QUERY_STRING'] ."<br />";
		echo "REQUEST_METHOD: ". $_SERVER['REQUEST_METHOD'] ."<br />";
		echo "REQUEST_TIME: ". $_SERVER['REQUEST_TIME'] ."<br />";
		echo "HTTP_REFERER: ". $_SERVER['HTTP_REFERER'] ."<br />";
		echo "HTTP_USER_AGENT: ". $_SERVER['HTTP_USER_AGENT'] ."<br />";

	}


	/**
	* diff function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function diff ()
	{
		//http://svn.kd2.org/svn/misc/libs/diff/example.php
		?>
		<style type="text/css">.ins { background: #cfc; }.del { background: #fcc; }ins { background: #9f9; }
		del { background: #f99; }hr { background: none; border: none; border-top: 2px dotted #000; color: #fff; }
		</style>
		<h1>LibDiff</h1>
		<hr />
		<?php

		// Include the diff class
		load::library('diff');

			$a_raw = '<html>
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
					<title>Hello World!</title>
				</head>
				<body>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

					<h2>A heading well be removing</h2>

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</body>
			</html>';

			$b_raw = '<html>
			<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
					<title>Goodbye Cruel World!</title>
				</head>
				<body>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

					<p>Just a small amount of new text...</p>
				</body>
			</html>';

		// Include two sample files for comparison
		$a = explode("\n", $a_raw);
		$b = explode("\n", $b_raw);

		// Options for generating the diff
		$options = array(
		);

		// Initialize the diff class
		$diff = new Diff($a, $b, $options);

		?><h2>Side By Side</h2> <?

		// Generate a side by side diff
		load::file(APPLICATION.'/library/diff/Renderer/Html','SideBySide');
		$renderer = new Diff_Renderer_Html_SideBySide;
		echo $diff->Render($renderer);

		?><h2>Inline</h2> <?

		// Generate an inline diff
		load::file(APPLICATION.'/library/diff/Renderer/Html','Inline');
		$renderer = new Diff_Renderer_Html_Inline;
		echo $diff->render($renderer);

	} // END DIFF


	public function hash ()
	{

		/*
		* create a hash from a users domain name an email address
		* send hash to remote servier for verification.
		*/
		load::library('hash');

		$hash = new Crypt_Hash('sha512');

		$email 		= 'adamapatterson@gmail.com';
		$domain 	= 'tentaclecms.com';
		$token 		= '&@?(l?95jl!rxxknfzc!';

		$hash_string = '7oHB0wNEzMsXmeQStp3wHgFOutaT0in3FvVnZbXJ0NjV7rEJHfYBbfrsfPpnADPPQs0xka9tTJ+eZaTBbGN/ow==';

		$hash->setKey($email.$token);

		if (base64_encode($hash->hash($domain)) == $hash_string )
		{
			echo 'We have a match!<br>';
		}

	} // END Hash


	public function smushit ()
	{
		echo 'smushIt';

		load::helper ('smushIt');

		$sample = 'http://a0.twimg.com/profile_images/1079746338/profile-adam-large.jpg';

		$smushed = new smushit();

		$raw = $smushed->compress($sample);

		echo '<pre>';
		print_r($raw);
		echo '</pre>';

		echo '<img src="'.$sample.'" alt="Raw" title="Raw"/>';

		echo '<img src="'.$raw->dest.'" alt="Smushed" title="Smushed" />';

	}// END SmushIt


	# counting logic, used to increment update totals in the site.
	public function counting()
	{
        echo increment('themes')."<br />";

        deincrement('template');

		echo increment('plugins')."<br />";

        deincrement('test');

		echo 'themes '.total_update('themes')."<br />";
		echo 'plugins '.total_update('plugins')."<br />";
		echo total_update();
	}


	/**
	 * inflector function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function inflector ()
	{
		echo '<h2>Inflector</h2>';

		$string = 'In pellentesque faucibus vestibulum';
		$camel = 'inPellentesqueFaucibusVestibulum';
		$upper = 'UPPER';
		$lower = 'lower';

		echo '<strong>Camelize Turned</strong> '. $string .' <strong>to</strong> '. camelize($string).'<br />';

		echo '<strong>Underscore Turned</strong> '. $camel .' <strong>to</strong> '. underscore($camel).'<br />';

		echo '<strong>Dash Turned</strong> '. $camel .' <strong>to</strong> '. dash($camel).'<br />';

		echo '<strong>Humanize Turned</strong> '. $string .' <strong>to</strong> '. humanize($string).'<br />';

		if (is_upper($upper)) {
			echo '<strong>is_upper</strong> says '. $upper .' is all upper case.<br />';
		}

		if (is_lower($lower)) {
			echo '<strong>is_upper</strong> says '. $lower.' is all lower case.<br />';
		}
	}// END inflector

	/**
	 * string function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function string ()
	{
		echo '<h2>String</h2>';

		$long_string = 'In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed molestie augue sit amet leo consequat posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel ante a orci.';
		$string = 'In pellentesque faucidsdsbus vestibulum@';';[;4]';
		$html_string = '<strong>Strings & Stuff</strong>';
		$san_string = '&lt;strong&gt;Strings &amp; Stuff&lt;/strong&gt;';
		$slash_string = 'Is your name O\'reilly?';
		echo '<h4>truncate()</h4> '.string::truncate($long_string, 30).'<br />';
		echo '<h4>truncate_middle()</h4> '.string::truncate_middle($long_string, 30).'<br />';
		echo '<h4>fix()</h4> '.string::fix($html_string, true).'<br />';
		echo '<h4>unfix()</h4> '.string::unfix($san_string).'<br />';
		echo '<h4>sanitize()</h4> '.string::sanitize($string).'<br />';
		echo '<h4>random()</h4> '.string::random(20, true).'<br />';
		echo '<h4>normalize()</h4> '.string::normalize($string).'<br />';
		echo '<h4>pluralize()</h4>'.string::pluralize(3, 'bean','beans');
		echo '<h4>string::escape_string()</h4> '.string::escape_string($slash_string).'<br />';
		echo '<h4>widont()</h4> '.string::widont($long_string).'<br />';
		echo '<h4>highlight()</h4>'.highlight($long_string, 'faucibus').'<br />';

	}// END Function

	/**
	 * numbers function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function numbers()
	{
		echo '<h2>Numbers</h2>';

		load::helper ('numbers');

		echo '<h4>number_to_phone()</h4>'. number_to_phone(1235551234, array('areaCode' => true,'extension' => 555,'countryCode' => 1)).'<br />';
		echo '<h4>number_to_currency()</h4>'. number_to_currency(1234567890.50) .'<br />';
		echo '<h4>number_to_percentage()</h4>'. number_to_percentage(100) .'<br />';
		echo '<h4>number_with_delimiter()</h4>'. number_with_delimiter(12345678.05, ".").'<br />';
		echo '<h4>number_with_precision()</h4>'. number_with_precision(111.2345, 2). '<br />';
		echo '<h4>number_to_human_size()</h4>'. number_to_human_size(1234567890123). '<br />';

	}// END Function


	/**
	 * date functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function date( $date='' )
	{
		echo '<h2>Date</h2>';

		$date = new date();

		$minute	= 30;
		$hour	= 11;
		$day 	= 18;
		$month 	= 'DEC';
		$year	= 1982;

		//2012-02-08 14:16:05
		//$year.'-'.$month.'-'.$day.' '.$hour.':'.$min

		//echo date('l dS \o\f F Y h:i:s A', strtotime( $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00' ));


        echo date::human_time_diff(strtotime( $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00' ), time());

	}// END Function

	/**
	 * time functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function time()
	{
		echo '<h2>Time</h2>';

		echo '<h4>time_in_timezone()</h4>'.date::time_in_timezone('Pacific/Chatham');

		echo '<h4>date::timezones()</h4>';
		//print_r(timezones());

		echo '<h4>date::set_timezone()</h4><p>Used in date::time_in_timezone()</p>';

		echo '<h4>date::get_timezone()</h4>'.date::get_timezone();

		echo '<h4>date::relative_time()</h4><p>Does not work.</p>';

		echo '<h4>now()</h4><p>'.date::now().'</p>';

        echo '<h4>now(\'+1 day\')</h4><p>'.date::now('+1 day').'</p>';

		echo date::current('year');
        echo date::current('month');
        echo date::current('day');
        echo date::current('hour');

	}// END Function


	/**
	 * state function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function state()
	{
		echo '<h2>State</h2><p>Auto Loaded</p>';

		echo 'CURRENT_PAGE'.CURRENT_PAGE;

		echo '<h4>odd_even()</h4>';
		echo odd_even();

		echo '<h4>even_odd()</h4>';
		echo even_odd();

	}// END Function


	/**
	 * track function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function track()
	{
		echo '<h2>Track</h2>';
		load::helper('track');
	}// END Function


	public function navigation ()
	{
		load::helper('navigation');

		$args = array();

		define ( 'FRONT'		,'true' );
        define ( 'IS_POST'      , FALSE );

		$page = load::model( 'content' );
		$pages = $page->type( 'page' )->get( );
		// Current URI to be used with .current page
		$uri = URI;

		$get_page_level = 0;

		$page_tree = $page->get_page_tree( $pages );
		#_e('<h3>Page Tree - $page->get_page_tree( $pages )</h3>');
		#var_dump( $page_tree );

		$page_array = $page->get_page_children( 0, $pages, 0 );
		#_e('<h3>Page Array - $page->get_page_children( 0, $pages, 0 )</h3>');
		#var_dump( $page_array );

		$page_object = (object)$page_array;

		$get_page_level = $page->get_page_level( $page_object, 'portfolio/design/' );
		//_e('<h3>Page Array - $page->get_page_level( $page_object, \'portfolio/design/print/\' )</h3>');
		//var_dump( $get_page_level );

		$get_page_by_level = $page->get_page_by_level( $page_object, $get_page_level );
		#_e('<h3>Page Array - $page->get_page_by_level( $page_object, $get_page_level )</h3>');
		#var_dump( $get_page_by_level );


		$get_home = $page->get_home( );

		$get_flat_page_hierarchy = $page->get_flat_page_hierarchy( $pages );

		$get_descendant_ids = $page->get_page_descendant_ids(  );

		$get_descendant_pages = $page->get_page_descendants( 2 );

		$page_children = $page->get_page_children( 0, $pages );

        load::helper('template');

        var_dump($get_descendant_pages);
		// Generate the HTML output.
		#echo nav_generate_new( $page_tree );

        #var_dump($page_tree);
        #menu( $page_tree );

        #var_dump((array)$page_array);
	}


    public function wordpress_import()
    {
        load::library('import', 'wordpress');
        load::helper('image');

        $wordpress_xml = TEMP.'tentaclecms.wordpress.2012-12-24.xml';

        $parser = new WXR_Parser();
        $import = $parser->parse( $wordpress_xml );

        $post           = load::model('content');
        $categories     = load::model('category');
        $tags           = load::model('tags');
        $media          = load::model( 'media' );

        # import new categories
        foreach ($import['categories'] as $import_category )
        {
            $categories->add($import_category);
        }

        # import new tags
        foreach ($import['tags'] as $import_tag )
        {
            $tags->add($import_tag);
        }

        # Only work with post content, we don't want pages, file attachments, or empty posts.
        foreach ($import['posts'] as $import_post )
        {
            if ($import_post['post_type'] == 'post' && $import_post['post_content'] != '')
            {
                # This is  the base media upload URL from the old WordPress site.
                $regexp_url = preg_quote($import['base_url'].'/wp-content/uploads/', "/");

                # This will return all URL matches as $media
                preg_match_all("/{$regexp_url}([^\.\!,\?;\"\'<>\(\)\[\]\{\}\s\t ]+)\.([a-zA-Z0-9]+)/",
                    $import_post['post_content'],
                    $remote_media);

                $content_modified = null;

                foreach ($remote_media[0] as $matched_url) {
                    $url_parts = string_to_parts($matched_url);

                    # download a copy of the old content ( because it might be sized differently than our newly processed images.
                    $content_image = get::url_contents($matched_url);
                    file_put_contents(STORAGE_DIR.'/images/'.$url_parts['name'], $content_image);

                    # Replace the old URL with our new URL
                    $content_modified = str_replace($matched_url, IMAGE_URL.$url_parts['name'], $import_post['post_content']);
                }

                if(!$content_modified == ''){
                    $import_post['post_content'] = $content_modified;
                }

                # Import the post and return the new ID
                $post_id = $post->type( 'post' )->add_by_import($import_post);

                # assosiate tags, and categories with the new post.
                if(array_key_exists("terms", $import_post))
                {
                    foreach($import_post['terms'] as $term )
                    {
                        if ( $term['domain'] == 'post_tag' )
                        {
                            $tag_id = $tags->lookup($term['slug']);

                            $tag_relations = $tags->relations( $post_id, $tag_id );
                        }
                        elseif( $term['domain'] == 'category' )
                        {
                            $category_id = $categories->lookup($term['slug']);

                            $category_relations = $categories->relations( $post_id, $category_id );
                        }
                    }
                }
            }
        }

        # Bring over all images that are attachments, This is independent of any content manipulation that takes place.
        foreach ($import['posts'] as $import_post )
        {
            if ( $import_post['post_type'] == 'attachment' )
            {
                $url_parts = string_to_parts($import_post['attachment_url']);

                $attachment_image = get::url_contents($import_post['attachment_url']);

                if (!file_exists(STORAGE_DIR.'/images/'.$url_parts['name'])) {
                    file_put_contents(STORAGE_DIR.'/images/'.$url_parts['name'], $attachment_image);

                    $add_image = $media->add( $url_parts['name'] );

                    process_image( $url_parts['name'] );
                }
            }
        }
    }


    public function import_test(){
        load::library('import', 'wordpress');
        load::library('SmartyPants', 'smartypants');
        load::helper('format');

        $wordpress_xml = TEMP.'tentaclecms.wordpress.2012-12-24.xml';

        $parser = new WXR_Parser();
        $import = $parser->parse( $wordpress_xml );

        load::helper('image');

        function convert_smart_quotes($string)
        {
            /**
             *  â€˜  8216  curly left single quote
             *  â€™  8217  apostrophe, curly right single quote
             *  â€œ  8220  curly left double quote
             *  â€  8221  curly right double quote
             *
             *  â€”  8212  em dash
             *  â€“  8211  en dash
             *  â€¦  8230  ellipsis  */
            $search = array(
                '&#8217;'
            );

            $replace = array(

                'P'
            );

            return str_replace($search, $replace, $string);
        }

        foreach ($import['posts'] as $import_post )
        {
            # Bring over all images that are attachments
            if ( $import_post['post_type'] == 'post' )
            {
                var_dump($import_post['post_content']);
            }
        }

    }


    public function user_stats(){

        $stats = load::model('statistics');

        $number_array = array();
        foreach ( $stats->get_by_date() as $stats )
        {
            $number_array[] = (string) round(date("g.i" ,$stats->date), 1, PHP_ROUND_HALF_DOWN);
        }

//        var_dump($number_array);
      var_dump(array_count_values($number_array));

    }


    public function serverstats()
	{
        load::helper('serverstats');
		build_server_stats(0, '', 'utf8');
	}


    public function category(){
        $category = load::model('category');

		$get_by_slug = $category->get_by_slug('design');
		var_dump($get_by_slug);

		$get_page_ids = $category->get_page_ids(1);
		var_dump($get_page_ids);

		$get_relations = $category->get_relations(112);
		var_dump($get_relations);

		$get_all_categories = $category->get_all_categories();
		var_dump($get_all_categories);
    }


    public function search($term = ''){
        echo "<h1>Fulltext search test</h1>";

        $posts = db::query("SELECT *, MATCH
            (title,content,excerpt) AGAINST('portfolio') AS
  	        relevance FROM posts WHERE MATCH
            (title,content,excerpt) AGAINST('portfolio') > 0 ORDER BY relevance DESC");

        var_dump($posts);
    }

    public function content_model () {

        $page = load::model( 'content' );

        $pages = $page->type('page')->get_by_parent_id( 0 );


        $pages = $page->type( 'page' )->get_parent_ids( $parent_id );

//        $get_post = $content->type('post')->get();
//        var_dump($get_post);
//
//        $get_page = $content->type('page')->get();
//        var_dump($get_page);

    }
}
