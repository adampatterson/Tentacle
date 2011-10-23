<? load::view('admin/template-header', array('title' => 'Writing settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Writing settings</h1>
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<div class="one-half">
				<div class="table">
					<h2>Formatting</h2>
					<hr />
					<div class="clearfix">
						<label for="default_category">Default Post Category</label>
						<div class="input">
							<select class="postform" id="default_category" name="default_category">
								<option value="21" class="level-0">Accessibility</option>
								<option value="22" class="level-0">Best Of</option>
								<option value="23" class="level-0">Biking</option>
								<option value="3" class="level-0">Books</option>
								<option selected="selected" value="1" class="level-0">Uncategorized</option>
								<option value="46" class="level-0">Usability</option>
								<option value="10" class="level-0">Web</option>
								<option value="47" class="level-0">Wordpress</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="one-half">
				<div class="table">
					<h2>Update Services</h2>
					<hr />
					<div class="clearfix">
						<label for="ping_sites">Ping Sites</label>
						<div class="input">
							<textarea rows="3" class="large-text code" id="ping_sites" name="ping_sites">
http://api.feedster.com/ping
http://api.moreover.com/ping
http://api.moreover.com/RPC2
http://api.my.yahoo.com/rss/ping
http://bblog.com/ping.php
http://bblog.com/ping.php
http://blog.goo.ne.jp/XMLRPC
http://blogsearch.google.com/ping/RPC2
http://bulkfeeds.net/rpc
http://ping.amagle.com/
http://ping.bitacoras.com
http://ping.blo.gs/
http://ping.bloggers.jp/rpc/
http://ping.fakapster.com/rpc
http://ping.feedburner.com
http://ping.myblog.jp
http://ping.rootblog.com/rpc.php
http://ping.syndic8.com/xmlrpc.php
http://ping.weblogalot.com/rpc.php
http://pinger.blogflux.com/rpc
http://pingoat.com/goat/RPC2
http://rcs.datashed.net/RPC2/
http://rpc.blogbuzzmachine.com/RPC2
http://rpc.blogrolling.com/pinger/
http://rpc.britblog.com
http://rpc.icerocket.com:10080/
http://rpc.newsgator.com/
http://rpc.pingomatic.com
http://rpc.tailrank.com/feedburner/RPC2
http://rpc.technorati.com/rpc/ping
http://rpc.weblogs.com/RPC2
http://rpc.wpkeys.com
http://topicexchange.com/RPC2
http://www.bitacoles.net/ping.php
http://www.blogdigger.com/RPC2
http://www.blogoole.com/ping/
http://www.blogoon.net/ping/
http://www.blogpeople.net/servlet/weblogUpdates
http://www.blogsnow.com/ping
http://www.blogstreet.com/xrbin/xmlrpc.cgi
http://www.lasermemory.com/lsrpc/
http://www.newsisfree.com/RPCCloud
http://www.popdex.com/addsite.php
http://www.snipsnap.org/RPC2
http://www.wasalive.com/ping/
http://www.weblogues.com/RPC/
http://xping.pubsub.com/ping
		</textarea>
								<span class="help-block">When you publish a new post, Tentacle automatically notifies the following site update services. For more about this, see <a href="http://codex.wordpress.org/Update_Services">Update Services</a> on the Codex. Separate multiple service <abbr title="Universal Resource Locator"> URL </abbr>s with line breaks.</span>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<div class="one-full">
				<div class="actions">
					<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
				</div>
			</div>
		</div>
	</form>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
