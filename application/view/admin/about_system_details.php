<? load::view('admin/partials/header',array('title'=>'System Details', 'assets'=> array('application') ) );?>
<div id="wrap">
	<div class="full-content">
	    <div class="one-full">
	     <h1 class='title'><img src="<?=ADMIN_URL; ?>images/icons/icon_pages_32.png" alt="" /> System Details</h1>
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
				
				if(!(function_exists('gd_info'))) {
					$gb_enabled = 'N/A';
				} else {
					$gb_enabled = 'enabled';
				}
				
				if (!class_exists('PDO')) {
					$pdo_enabled = 'N/A';
				} else {
					$pdo_enabled = 'enabled';
				}
				
				$php_info = parse_php_info();
			?>
			<table class="form-table">
				<tr>
					<td>PHP Version</td><td><?php echo phpversion(); ?></td>
				</tr>
				<tr>
					<td>PHP Safe Mode</td><td><?php echo colorify_value($safe_mode, 'Off'); ?></td>
				</tr>
				<tr>
					<td>PHP Max Upload Size</td><td><?php echo $upload_max; ?></td>
				</tr>
				<tr>
					<td>PHP Max Post Size</td><td><?php echo $post_max; ?></td>
				</tr>
				<tr>
					<td>PHP Memory Limit</td><td><?php echo $memory_limit; ?></td>
				</tr>
				<tr>
					<td>GD Enabled</td><td><?php echo colorify_value($gb_enabled, 'enabled') ?></td>
				</tr>
				<tr>
					<td>PDO Enabled</td><td><?php echo colorify_value($pdo_enabled, 'enabled') ?></td>
				</tr>
				<?php foreach ($php_info['gd'] as $key => $val) {
								if (preg_match('/(WBMP|XBM|Freetype|T1Lib)/i', $key)) {
									echo '<tr>';
									echo '<td>'.$key.'</td>';
									if (stripos($key, 'support') === false) {
										echo '<td>'.$val.'</td>';
									}
									else {					
										echo '<td>'.colorify_value($val, 'enabled').'</td>';
									}
									echo '</tr>';
								}
							}
						?>
			</table>
		</div>
		<!--
		<div class="one-full">
		<h2>Other Libraries used</h2>
			<ul>
				<li>jQuery</li>
				<li>Dingo Framework</li>
				<li>Bootstrap, from Twitter</li>
				<li>CKEditor</li>
				<li>Code Mirror</li>
				<li>HTML5 Shive</li>
				<li>Sisyphus</li>
				<li>Spin</li>
				<li>Modernizer</li>
				<li>jQuery History</li>
				<li>jQuery Validate</li>
				<li>jQuery Input Tags</li>
				<li>jQuery oEmbed</li>
			</ul>
		</div>-->
	</div><!-- .full-content -->
</div>
<!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets'=> array('') ) );?>