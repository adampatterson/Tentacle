	<h2>Need Help?</h2>
	<p>If you are a user of this website, you can report this message to a website administrator.</p>
	<p>If you are an administrator of this website, you can get help at the <a href="http://community.tentaclecms.com" target="_blank">Tentacle Community Forums</a>.</p>
</div>        
<div id="MoreInformation">
   <h2>Additional information for support personnel:</h2>
		<?
			if (ini_get('safe_mode'))
				$safe_mode = 'On';
			else
				$safe_mode = 'Off';
			
			if (!($upload_max = ini_get('upload_max_filesize')))
				$upload_max = 'N/A';

			if (!($post_max = ini_get('post_max_size')))
				$post_max = 'N/A';

			if (!($memory_limit = ini_get('memory_limit')))
				$memory_limit = 'N/A';

			$php_info = parse_php_info();
		?>
	<ul>
      <li><strong>Application:</strong> Tentacle CMS</li>
      <li><strong>Application Version:</strong> <?php echo TENTACLE_VERSION ?></li>
      <li><strong>PHP Version:</strong> <?php echo PHP_VERSION ?></li>
	  <li><strong>PHP Safe Mode</strong> <?php echo colorify_value($safe_mode, 'Off'); ?></li>
	  <li><strong>PHP Max Upload Size</strong> <?php echo $upload_max; ?></li>
	  <li><strong>PHP Max Post Size</strong> <?php echo $post_max; ?></li>
	  <li><strong>PHP Memory Limit</strong> <?php echo $memory_limit; ?></li>
	
		<?php foreach ($php_info['gd'] as $key => $val) {
				if (!preg_match('/(WBMP|XBM|Freetype|T1Lib)/i', $key)) {
					echo '<li>';
					echo '<strong>'.$key.'</strong> ';
					if (stripos($key, 'support') === false) {
						echo $val;
					}
					else {
						echo colorify_value($val, 'enabled');
					}
					echo '</li>';
				}
			}
		?>
      <li><strong>Operating System:</strong> <?php echo PHP_OS ?></li>
      <?php
         if (array_key_exists('SERVER_SOFTWARE', $_SERVER))
            echo '<li><strong>Server Software:</strong> ',$_SERVER['SERVER_SOFTWARE'],"</li>\n";

         if (array_key_exists('HTTP_REFERER', $_SERVER))
            echo '<li><strong>Referer:</strong> ',$_SERVER['HTTP_REFERER'],"</li>\n";

         if (array_key_exists('HTTP_USER_AGENT', $_SERVER))
            echo '<li><strong>User Agent:</strong> ',$_SERVER['HTTP_USER_AGENT'],"</li>\n";

         if (array_key_exists('REQUEST_URI', $_SERVER))
            echo '<li><strong>Request Uri:</strong> ',$_SERVER['REQUEST_URI'],"</li>\n";
      ?>
      <li><strong>Controller:</strong> <?php echo route::controller() ?></li>
      <li><strong>Method:</strong> <?php echo route::method() ?></li>

		</ul>