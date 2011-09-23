<?php
class dev_controller {	
	
	/**
	* index function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function index()
	{
		//echo '<h3>Dev Land</h3>';
		//echo route::controller().'_'. route::method() .'<br />';
		
		# Domain Name Variable
		$domainName = "" ;
		function Visit($url){
		       $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
		       curl_setopt ($ch, CURLOPT_URL,$url );
		       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		       curl_setopt ($ch,CURLOPT_VERBOSE,false);
		       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		       curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
		       curl_setopt($ch,CURLOPT_SSLVERSION,3);
		       curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
		       $page=curl_exec($ch);
		       //echo curl_error($ch);
		       $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		       curl_close($ch);
		       if($httpcode>=200 && $httpcode<300) return true;
		       else return false;
		}
		if (Visit("http://www.adampatterson.ca"))
		       echo "Website OK";
		else
		       echo "Website DOWN";
	
	}
	
	
	/**
	* ajax function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function ajax()
	{
		echo "This content is in the Dev controller under Ajax function.";
	}

  
	/**
	 * mobile function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function mobile ()
	{
		echo '<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
		<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>';
	}
	
	
	/**
	 * suggest function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function suggest ()
	{
		/* Mod for Database use
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);

			if(strlen($queryString) >0) {

				$query = $db->query("SELECT country FROM countries WHERE country LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->country).'\');">'.$result->country.'</li>';
	         		}
				echo '</ul>';

				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}*/
		
		# Temp non dynamic Data
		echo '<ul>';
   			echo '<li onClick="fill(\'One\');">One</li>';
			echo '<li onClick="fill(\'Two\');">Two</li>';
			echo '<li onClick="fill(\'Three\');">Three</li>';
			echo '<li onClick="fill(\'Four\');">Four</li>';
			echo '<li onClick="fill(\'Five\');">Five</li>';
			echo '<li onClick="fill(\'Six\');">Six</li>';
			echo '<li onClick="fill(\'Seven\');">Seven</li>';
			echo '<li onClick="fill(\'Eight\');">Eight</li>';
			echo '<li onClick="fill(\'Nine\');">Nine</li>';
			echo '<li onClick="fill(\'Ten\');">Ten</li>';
		echo '</ul>';
	}
	
	
	/**
	 * ajax_check functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function ajax_check ()
	{	
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			// If its an ajax request execute the code below	
			echo '1';	
			exit;
		}

		//if it's not an ajax request echo the below.
		echo 'This is clearly not an ajax request!';
	}
	
	
	/**
	 * username_check function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function username_check($username = '')
	{		
		$username = trim( strtolower( input::post ( 'username') ) );
		
		# Query the database and then return the number of rows (1 == taken, 0 = availible. )
		
		# Static demo
		switch ($username) {
			case 'ashley':
		    case 'adam':
			case 'john':
			case 'mark':
			case 'paul':
			case 'rick':
			case 'luke':
			case 'simon':
		        echo '1';
		        break;
		}
	}
	
	
	/**
	* firephp function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function firephp()
	{
		echo 'Check the Console';
		
		$groups = array('contacts'=>'adam');
	  		
	  	$firephp = FirePHP::getInstance(TRUE);
		$firephp->fb('Debugging is enabled!');
		$firephp->dump('key', 'value');
		$firephp->log($groups, 'Log Label');
		$firephp->info($groups, 'Information Label');
		$firephp->warn($groups, 'Warning Label');
		$firephp->error($groups, 'Error Label');
		$firephp->trace('Trace to here');
	}

	
	/**
	* function_test function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function function_test ()
	{
		load::helper ('template');
	}

	
	/**
	* scaffold function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function scaffold ()
	{
		load::library ('file');
		$scaffold = new Scaffold ();
		define ('ACTIVE_THEME', '/default');
		//load::view('admin_view', array( 'scaffold'=>$scaffold, 'data'=>$data));
		tentacle::render ('data', array ('scaffold' => $scaffold));
		
	}// END scaffold

	/**
	 * theme functions
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function theme()
	{ 
		echo '<h2>Themes</h2>';
		
		load::helper ('theme');
		
		echo '<h2>Detected Themes</h2>';
		
		load::helper ('inflector');
		load::helper ('theme');
		load::helper ('tentacle');
		
		clean_out(get_themes());
		
		echo '<h2>Valid Template Files</h2>';
			clean_out(get_templates(THEMES_DIR.'/default'));
		
		echo '<h2>Themes Settings</h2>';
			clean_out(get_settings('/default'));
		
		echo '<h2>Themes Resources</h2>';
			clean_out(get_resources(THEMES_DIR.'/default'));

		
	}
	
	
	/**
	* define_test function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function define_test ($admin_var ="")
	{
		echo '<strong>CORE_ROOT:</strong> ' . CORE_ROOT . '<br />';
		echo '<strong>APP_PATH:</strong> ' . APP_PATH . '<br />';
		echo '<strong>STORAGE_DIR:</strong> ' . STORAGE_DIR . '<br />';
		echo '<strong>THEMES_DIR:</strong> ' . THEMES_DIR . '<br />';
		echo '<strong>ADMIN_DIR:</strong> ' . ADMIN_DIR . '<br />';
		echo '<strong>IMAGE_DIR:</strong> ' . IMAGE_DIR . '<br />';

		echo '<strong>CONFIG:</strong> ' . CONFIG . '<br />';

		echo '<strong>BASE_URI:</strong> ' . BASE_URI . '<br />';
		echo '<strong>BASE_URL:</strong> ' . BASE_URL . '<br />';

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
		echo "TENTACLE_JS: ". TENTACLE_JS ."<br />";
		echo "TENTACLE_CSS: ". TENTACLE_CSS ."<br />";
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
		tentacle::library('/diff','diff');

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
		tentacle::file(TENTACLE_LIB.'/diff/Diff/Renderer/Html','SideBySide');
		$renderer = new Diff_Renderer_Html_SideBySide;
		echo $diff->Render($renderer);
		
		?><h2>Inline</h2> <?

		// Generate an inline diff
		tentacle::file(TENTACLE_LIB.'/diff/Diff/Renderer/Html','Inline');
		$renderer = new Diff_Renderer_Html_Inline;
		echo $diff->render($renderer);
		
	} // END DIFF


	/**
	* bench function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function bench () 
	{
        ?><h2>Bench</h2><?
        
		/*        
        mySerialize( $obj ) {
           return base64_encode(gzcompress(serialize($obj)));
        }
        
        myUnserialize( $txt ) {
           return unserialize(gzuncompress(base64_decode($txt)));
        } 
		*/

        function random_string ( $len = 1000 ){
            $base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
            $max=strlen($base)-1;
            $activatecode='';
            mt_srand((double)microtime()*1000000);
            while (strlen($activatecode)<$len+1)
              $activatecode.=$base{mt_rand(0,$max)};

            return $activatecode; }

        $number_tests = 10;

        echo '<ol>';

        $i   = 0;
        while($i < $number_tests) {

            $time_start = microtime(true);
            $fuse =  random_string(0);
            $random_array = explode($fuse, random_string('20000'));

            $compress = gzcompress( base64_encode( serialize( $random_array ) ) );
            /*
            $insert = db('testing')->insert(array(
				'data'=>$compress
				));

			$select = db('testing')->select('*')->where('id','=',$insert->id)->execute();
            */
            $decompress =  unserialize( base64_decode( gzuncompress( $compress ) ) );

            echo '<li>'. $time.' <strong>$insert->id</strong></li>';

            ++$i;
            $time_end = microtime(true);
            $time = $time_end-$time_start;

        }

        echo '</ol>';

	} // END Bench


	/**
	* hash function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function hash () 
	{
		load::helper ('hash');

		$hash = new Crypt_Hash('sha512');

		$hash->setKey('abcdefg');

		echo base64_encode($hash->hash('abcdefg'));
	} // END Hash
 

	/**
	 * json function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/

	function json () 
	{
		load::helper ('json');
		
		// create a new instance of Services_JSON
		$json = new Services_JSON();

		// convert a complexe value to JSON notation, and send it to the browser
		$value = array('foo', 'bar', array(1, 2, 'baz'), array(3, array(4)));
		$output = $json->encode($value);

		print($output);
		// prints: ["foo","bar",[1,2,"baz"],[3,[4]]]

		// accept incoming POST data, assumed to be in JSON notation
		$input = file_get_contents('php://input', 1000000);
		$value = $json->decode($input);

	} // END JSON
	
	
	/**
	* smushit function
	*
	* @return void
	* @author Adam Patterson
	**/

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
	
	/**
	 * array function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/

	public function array_mod ()
	{
		$array = array(
			'post_type' => 'Post Type',
			'paged' => 'Paged',
			'posts_per_page' => 2,
			'name' => array(				
				'name' => 'First Name',
				'input' => 'input',
				'type' => 'text',
				'notes' => 'This is a note'
				));
		
		load::helper ('array');

		$object = arrayToObject ( $array );
		echo '<h2>Array to Object</h2><pre>';
			print_r($object);
		echo '</pre>';
		
		$array = objectToArray ( $object );
		echo '<h2>Array to Object</h2><pre>';
			print_r($array);
		echo '</pre>';
		
	}
	
	
	/**
	* tentacle function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function tentacle ()
	{
		load::helper ('tentacle');
		load::helper ('url');

		echo '<h2>Tentacle</h2>';
		echo '<h4>get_url()</h4>'.clean_out(get_url());
		
		echo '<h4>get_request_method()</h4>'.clean_out(get_request_method());
		
		echo '<h4>html_encode()</h4>';
		$dirty = "this & that";
		echo html_encode($dirty);
		
		echo '<h4>convert_size()</h4>'.convert_size(1070041824);
		
		echo '<h4>memory_usage()</h4>'. memory_usage();
			}
	
	
	/**
	* url function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function url ()
	{	
		echo '<h2>URL</h2>';
		
		load::helper ('url');

		echo '<h4>self_url()</h4>'.self_url();
		
		echo '<h4>baseUrl()</h4>'.baseUrl();
		
		echo '<h4>baseUri()</h4>'.baseUri();
		
		#echo '<strong>Page nasdaot found</strong>'. page_not_found();
		
		echo '<h4>refresh()</h4>'.refresh(30);
		
		echo '<h4>urlTitle()</h4>'. urlTitle('http://www.google.ca');
	}
	
	
	/**
	* gravatar function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function gravatar ()
	{
		load::helper ('gravatar');
		
		echo '<h2>get_gravatar()</h2>';
		
		echo get_gravatar('adamapatterson@gmail.com');
	}
	
	/**
	* xml function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function xml ()
	{
		
		$array = array(
			'post_type' => 'Post Type',
			'paged' => 'Paged',
			'posts_per_page' => 2,
			'name' => array(				
				'name' => 'First Name',
				'input' => 'input',
				'type' => 'text',
				'notes' => 'This is a note'
				));
				
		echo '<h2>XML</h2>';
		load::helper ('xml');

		$xml = "<note>
		<to>Tove</to>
		<from>Jani</from>
		<heading>Reminder</heading>
		<body>Don't forget me this weekend!</body>
		</note>";

		echo '<pre>';
		print_r(xml2arr($xml));
		echo '</pre>';
		
		#arr2xml(&$object, $array);
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
	
		load::helper ('inflector');
	
		$inflector = new inflector();
	
		$string = 'In pellentesque faucibus vestibulum';
		$camel = 'inPellentesqueFaucibusVestibulum';
		$upper = 'UPPER';
		$lower = 'lower';
	
		echo '<strong>Camelize Turned</strong> '. $string .' <strong>to</strong> '. $inflector->camelize($string).'<br />';
	
		echo '<strong>Underscore Turned</strong> '. $camel .' <strong>to</strong> '. $inflector->underscore($camel).'<br />';

		echo '<strong>Dash Turned</strong> '. $camel .' <strong>to</strong> '. $inflector->dash($camel).'<br />';
	
		echo '<strong>Humanize Turned</strong> '. $string .' <strong>to</strong> '. $inflector->humanize($string).'<br />';
	
		if ($inflector::is_upper($upper)) {
			echo '<strong>is_upper</strong> says '. $upper .' is all upper case.<br />';
		}
	
		if ($inflector::is_lower($lower)) {
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
		
		load::helper ('string');

		$long_string = 'In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed molestie augue sit amet leo consequat posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel ante a orci.';
		$string = 'In pellentesque faucidsdsbus vestibulum@';';[;4]';
		$html_string = '<strong>Strings & Stuff</strong>';
		$san_string = '&lt;strong&gt;Strings &amp; Stuff&lt;/strong&gt;';
		$slash_string = 'Is your name O\'reilly?';
		echo '<h4>truncate()</h4> '.truncate($long_string, 30).'<br />';
		echo '<h4>truncate_middle()</h4> '.truncate_middle($long_string, 30).'<br />';
		echo '<h4>fix()</h4> '.fix($html_string, true).'<br />';
		echo '<h4>unfix()</h4> '.unfix($san_string).'<br />';
		echo '<h4>sanitize()</h4> '.sanitize($string).'<br />';
		echo '<h4>random()</h4> '.random(100, true).'<br />';
		echo '<h4>normalize()</h4> '.normalize($string).'<br />';
		echo '<h4>pluralize()</h4>'.pluralize(3, 'bean','beans');
		echo '<h4>escapeStr()</h4> '.escapeStr($slash_string).'<br />';
		echo '<h4>widont()</h4> '.widont($long_string).'<br />';
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
	 * status function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function status ()
	{
		echo '<h2>Status</h2>';
		load::helper ('status');

	}// END Function
	
	/**
	 * date functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function date() 
	{
		echo '<h2>Date</h2>';
		load::helper ('date');
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
		load::helper ('time');

		echo '<h4>time_in_timezone()</h4>'.time_in_timezone('Pacific/Chatham');
		
		echo '<h4>timezones()</h4>';
		//print_r(timezones());
		
		echo '<h4>set_timezone()</h4><p>Used in time_in_timezone()</p>';
		
		echo '<h4>get_timezone()</h4>'.get_timezone();
		
		echo '<h4>relative_time()</h4><p>Does not work.</p>';
		
		echo '<h4>now()</h4>'.now('+1 day');
		
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
	 * spyc function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function spyc()
	{	
		echo '<h2>Spyc</h2>';
		
		tentacle::library('/spyc','spyc');
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
		load::helper ('track');
	}// END Function
	
	
	/**
	 * zip function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function zip()
	{	
		echo '<h2>Zip</h2>';
		load::helper ('zip');
		
		echo '<a href="?app=file" class="button">Unzip File!</a>';
		
		$app = input::request ( 'app' );
		
		$appdata = STORAGE_DIR.'/file.zip';
		$appname = '$app.zip';
		
		if (file_exists($appdata)) {
			if (isset($app)) {
			    $result = download_and_extract_zip($appname,$appdata);
			}
			else
			{
			   // ob_end_clean();
			 echo '<a href="?app=file" class="button">Unzip File!</a>';
			 }
		}
		else
		{
			echo 'Can not load the file.';			
		}
	}// END Function
	/*
	public funstion object_variable () {
		# @todo test this with template data.
		extract($data, EXTR_OVERWRITE);
	}*/

# lib/glip
# lib/htmlLawed
# lib/jquery-uplaodify
# lib/markit up
# lib/min
# lib/pclZip
# lib/PHPExcel
# lib/phpseclib
# lib/pgp
# lib/smartypants
# lib/spyc
# lib/xmlrpc

	/**
	 * create_user function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function create_user ()
	{
		/*user::create(array(
			'username'=>'adampatterson',
			'email'=>'adamapatterson@gmail.com',
			'password'=>'pineapple23',
			'type'=>'admin'
		));
	
		user::update('adamapatterson@gmail.com')
			->data('first_name','Adam')
	        ->data('last_name','Patterson')
			->data('activity_key','')
			->data('url','http://www.adampatterson.ca')
			->data('display_name','Adam Patterson')
			->save(); */
	}
	
	public function redesign () 
	{
		load::view ( 'redesign' );
	}
	
	public function redesign2 () 
	{
		load::view ( 'redesign2' );
	}

	public function redesign3 () 
	{
		load::view ( 'redesign3' );
	}


}// END Dev