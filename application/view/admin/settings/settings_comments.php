<? load::view('admin/template-header', array('title' => 'Comment settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/"  class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Comment settings</h1>
			<div class="one-half">
				<h2>Default article settings</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="checkbox" value="1" id="default_pingback_flag" name="default_pingback_flag">
										<span>Attempt to notify any blogs linked to from the article.</span> </label>
								</li>
								<li>
									<label>
										<input type="checkbox" checked="checked" value="open" id="default_ping_status" name="default_ping_status">
										<span>Allow link notifications from other blogs (pingbacks and trackbacks.)</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h2>Other comment settings</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="checkbox" checked="checked" value="1" id="require_name_email" name="require_name_email">
										<span>Comment author must fill out name and e-mail</span> </label>
								</li>
								<li>
									<label>
										<input type="checkbox" value="1" id="comment_registration" name="comment_registration">
										<span>Users must be registered and logged in to comment</span> </label>
								</li>
								<li>
									<label>
										<input type="checkbox" value="1" id="page_comments" name="page_comments">
										<span>Break comments into pages</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h2>E-mail me whenever</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="checkbox" checked="checked" value="1" id="comments_notify" name="comments_notify">
										<span>Anyone posts a comment</span> </label>
								</li>
								<li>
									<label>
										<input type="checkbox" checked="checked" value="1" id="moderation_notify" name="moderation_notify">
										<span>A comment is held for moderation</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h2>Before a comment appears</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="checkbox" value="1" id="comment_moderation" name="comment_moderation">
										<span>An administrator must always approve the comment</span> </label>
								</li>
								<li>
									<label>
										<input type="checkbox" checked="checked" value="1" id="comment_whitelist" name="comment_whitelist">
										<span>Comment author must have a previously approved comment</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h2>Comment Blacklist</h2>
				<hr />
				<fieldset>
					<div class="clearfix">
						<label for="blacklist_keys">Black List</label>
						<div class="input">
							<textarea cols="50" rows="10" name="blacklist_keys"></textarea>
							<span class="help-block">When a comment contains any of these words in its content, name, URL, e-mail, or IP, it will be marked as spam. One word or IP per line. It will match inside words, so “press” will match “WordPress”.</span>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-half">
				<h2>Avatars</h2>
				<hr />
				<p>
					An avatar is an image that follows you from weblog to weblog appearing beside your name when you comment on avatar enabled sites.  Here you can enable the display of avatars for people who comment on your site.
				</p>
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="radio" value="0" name="show_avatars">
										<span>Don’t show Avatars</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="1" name="show_avatars">
										<span>Show Avatars</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h3>Maximum Rating</h3>
				<fieldset>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="radio" checked="checked" value="G" name="avatar_rating">
										<span>G &mdash; Suitable for all audiences</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="PG" name="avatar_rating">
										<span>PG &mdash; Possibly offensive, usually for audiences 13 and above</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="R" name="avatar_rating">
										<span>R &mdash; Intended for adult audiences above 17</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="X" name="avatar_rating">
										<span>X &mdash; Even more mature than above</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<h3>Default Avatar</h3>
				<fieldset>
					<p>
						For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.
					</p>
					<div class="clearfix">
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="radio" value="blank" id="avatar_blank" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=http%3A%2F%2Fwww.adampatterson.ca%2Fwp-includes%2Fimages%2Fblank.gif&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-2"> <span>Blank</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" checked="checked" value="mystery" id="avatar_mystery" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-1"> <span>Mystery Man</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="gravatar_default" id="avatar_gravatar_default" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-3"> <span>Gravatar Logo</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="identicon" id="avatar_identicon" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=identicon&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-4"> <span>Identicon (Generated)</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="wavatar" id="avatar_wavatar" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=wavatar&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-5"> <span>Wavatar (Generated)</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="monsterid" id="avatar_monsterid" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=monsterid&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-6"> <span>MonsterID (Generated)</span> </label>
								</li>
								<li>
									<label>
										<input type="radio" value="retro" id="avatar_retro" name="avatar_default">
										<img height="32" width="32" class="avatar avatar-32 " src="http://1.gravatar.com/avatar/1606bacbd5d22e491849ebccc0ab36a9?s=32&amp;d=retro&amp;r=G&amp;forcedefault=1" alt="" id="grav-1606bacbd5d22e491849ebccc0ab36a9-7"> <span>Retro (Generated)</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<div class="one-full">
			<div class="actions">
				<input type="submit" value="Save Changes" class="btn primary medium" id="submit" name="submit">
			</div>
		</div>
	</form>
</div><!-- #wrap -->
<? load::view('admin/template-footer');?>