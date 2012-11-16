<? load::view('install/template-header', array('title' => '- Step 2'));?>
  <div class="content">
    <div class="page-header">
      <h1>Install <small>Step 2</small></h1>
    </div>
	<ul class="breadcrumb">
		<li><a href='#'>Overview</a><span class="divider">/</span></li>
		<li class="active"><a href='#'>System Check</a><span class="divider">/</span></li>
		<li>Database Information<span class="divider">/</span></li>
		<li>Testing the config file<span class="divider">/</span></li>
		<li>Create User<span class="divider">/</span></li>
		<li>Done</li>
	</ul>
    <div class="row">
      <div class="span12">
        <h2>System Check</h2>
		<p>
		The following tests have been run to determine if <strong>Tentacle CMS</strong> will work in your environment.
		If any of the tests have failed, consult the documentation for more information on how to correct the problem.
		</p>
		<?php $failed = FALSE ?>
		<table cellspacing="0">
			<tr>
				<th>PHP Version</th>
				<?php if (version_compare(PHP_VERSION, '5.3.3', '>=')): ?>
					<td class="pass"><?php echo PHP_VERSION ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">Tentacle requires PHP 5.2.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
				<?php endif; ?>
			</tr>

			<tr>
				<th>Application Directory</th>
				<?php if (is_dir('application/')): ?>
					<td class="pass">/application/</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The configured <code>application</code> directory does not exist or does not contain required files.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>Storage Directory</th>
				<?php if (is_dir('storage/') AND is_writable('tentacle/storage/')): ?>
					<td class="pass">/storage/</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code>/tentacle/storage/</code> directory is not writable.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>Config Directory</th>
				<?php if (is_dir('application/config/deployment/') AND is_writable('application/config/deployment/')): ?>
					<td class="pass">/application/config/deployment/</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code>/application/config/deployment/'</code> directory is not writable.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>Config File</th>
				<?php if (!file_exists('application/config/deployment/db.php')): ?>
					<td class="pass">The <code>db.php</code> file has not been created yet.</td>
				<?php else: $failed = TRUE ?>
					<td class="fail"><p>The file <code>db.php</code> already exists. If you need to reset any of the configuration items in this file, please delete it first.</p></td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>URI Determination</th>
				<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> is available.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>cURL Enabled</th>
				<?php if (extension_loaded('curl')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Tentacle requires <a href="http://php.net/curl">cURL</a> for the Remote class.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>mcrypt Enabled</th>
				<?php if (extension_loaded('mcrypt')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Tentacle requires <a href="http://php.net/mcrypt">mcrypt</a> for the Encrypt class.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>GD Enabled</th>
				<?php if (function_exists('gd_info')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Tentacle requires <a href="http://php.net/gd">GD</a> v2 for the Image class.</td>
				<?php endif; ?>
			</tr>
			<tr>
				<th>PDO Enabled</th>
				<?php if (class_exists('PDO')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Tentacle can use <a href="http://php.net/pdo">PDO</a> to support additional databases.</td>
				<?php endif; ?>
			</tr>
		</table>

		<?php if ($failed === TRUE): ?>
			<div class="alert-message error">
				<p>Tentacle may not work correctly with your environment.</p>
			</div>
			<div class="row">
				<div class="span6">
					<a href="<?= BASE_URL; ?>/" class="btn btn-danger">Back</a>
				</div>
				<div class="span6 pull-right">
					<a href="#" class="btn disabled pull-right">Next</a>
				</div>
			</div>
		<?php else: 
			url::redirect('install/step3');
		?>
			<div class="alert-message success">
				<p><strong>✔</strong> Your environment passed all requirements.</p>
			</div>
			<div class="span6">
				<a href="<?= BASE_URL; ?>install/step1" class="btn btn-danger">Back</a>
			</div>
			<div class="span6 pull-right">
				<a href="<?= BASE_URL; ?>install/step3/" class="btn btn-primary pull-right">Next</a>
			</div>
		<?php endif; ?>
      </div>
    </div>
  </div>
<? load::view('install/template-footer');?>