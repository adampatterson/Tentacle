<? load::view('admin/templates/template-header', array('title' => 'Resource', 'assets' => array('application')));?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
				<link href="<?=ADMIN_URL;?>css/dashboard.css" rel="stylesheet" type="text/css">
				<div class="one-full">
					<div class="title pad-right">
						<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Resource</h1>
					</div>
				</div>
				<div class="one-full">
					<section id="grid-system" class="normal">
						<div class="page-header">
							<h1>Javascript <small>General Helpers</small></h1>
						</div>
							<div class="one-full">
								<div class="one-half">
									<div class="table">
										<h2>Notifications</h2>
										<script src="<?= BASE_URL ?>tentacle/admin/js/jquery.notice.js" type="text/javascript"></script>
										<script type="text/javascript">
											$(document).ready(function() {
												jQuery.noticeAdd({
													text : 'This is a simple notification using the jQuery notice plugin. Click the X above to remove this notice.',
													stay : true
												});

												$('.add').click(function() {
													jQuery.noticeAdd({
														text : 'This is a notification that you have to remove',
														stay : true
													});
												});

												$('.add2').click(function() {
													jQuery.noticeAdd({
														text : 'This is a notification that will remove itself',
														stay : false
													});
												});

												$('.add3').click(function() {
													jQuery.noticeAdd({
														text : 'This is an error notification!',
														stay : false,
														type : 'error'
													});
												});

												$('.add4').click(function() {
													jQuery.noticeAdd({
														text : 'This is a success notification!',
														stay : false,
														type : 'success'
													});
												});

												$('.remove').click(function() {
													jQuery.noticeRemove($('.notice-item-wrapper'), 400);
												});
											});

										</script>
										<ul>
											<li class="add">
												Click here to see a notification that you have to remove
											</li>
											<li class="add2">
												Click here to see a notification that does not stay
											</li>
											<li class="add3">
												Error Notification
											</li>
											<li class="add4">
												Success Notification
											</li>
											<li class="remove">
												Remove all active notifications
											</li>
										</ul>
									</div>
								</div>
								<div class="one-half">
									<div class="table">
										<h2>Tool-Tips</h2>
										<script>
											$(document).ready(function() {

												$('[rel=tooltip]').bind('mouseover', function() {

													if($(this).hasClass('ajax')) {
														var ajax = $(this).attr('ajax');

														$.get(ajax, function(theMessage) {
															$('<div class="tooltip">' + theMessage + '</div>').appendTo('body').fadeIn('fast');
														});
													} else {

														var theMessage = $(this).attr('content');
														$('<div class="tooltip">' + theMessage + '</div>').appendTo('body').fadeIn('fast');
													}

													$(this).bind('mousemove', function(e) {
														$('div.tooltip').css({
															'top' : e.pageY - ($('div.tooltip').height() / 2) - 5,
															'left' : e.pageX + 15
														});
													});
												}).bind('mouseout', function() {
													$('div.tooltip').fadeOut('fast', function() {
														$(this).remove();
													});
												});
											});

										</script>
										<ol>
											<li>
												<a href="#" alt="Text Tooltip" rel="tooltip" content="<span>Text Title</span><br/> This is an example of a text tooltip with jquery">Text Tooltip</a>
											</li>
											<li>
												<a href="#" alt="Image Tooltip" rel="tooltip" content="<span>Image Title</span><br/> <img src='http://papermashup.com/demos/jquery-gallery/images/t2.png' width='120' height='120' class='tooltip-image'/> This is an example of an image tooltip with jquery, with a little bit of text.<br/> Remember you can follow me on twitter just search: ashleyford">Image Tooltip</a>
											</li>
											<li>
												<a href="#" alt="Image Tooltip" rel="tooltip" content="<span>Iframe Tooltip</span><br/> <iframe src='http://google.com' width='250px' height='100px' frameborder='0' scrolling='0'></iframe>">Iframe Tooltip</a>
											</li>
											<li>
												<a href="#" class="ajax" alt="Image Tooltip" rel="tooltip" ajax="http://localhost/http/dev.tcms.me/dev/ajax/">Ajax Tooltip</a>
											</li>
										</ol>
									</div>
								</div>
								<div class="one-half">
									<div class="table">
										<h2>Tags</h2>
										<section>
											<label for="tags"> Tags <small>Comma separated</small> </label>
											<div>
												<input type="text" class="tags" name="tags" id="tags" value="awesome,tags" />
											</div>
										</section>
									</div>
								</div>
								<div class="one-half auto">
									<div class="table">
										<h2>Auto Suggest</h2>
										<? #@todo update css to reflect the related field and not #country?>
										<script>
											function suggest(inputString){
												if(inputString.length == 0) {
													$('#suggestions').fadeOut();
												} else {
													$('#country').addClass('load');
													$.post("<?= BASE_URL ?>dev/suggest", {queryString: ""+inputString+""}, function(data){
														if(data.length > 0) {
															$('#suggestions').fadeIn();
															$('#suggestionsList').html(data);
															$('#country').removeClass('load');
														}
													});
												}
											}

											function fill(thisValue) {
												$('#country').val(thisValue);
												setTimeout("$('#suggestions').fadeOut();", 600);
											}

										</script>
										<form id="form" action="#" method="post">
											<div id="suggest">
												Start to type a country:
												<br />
												<input type="text" size="25" value="" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off"/>
												<div class="suggestionsBox" id="suggestions" style="display: none;">
													<img src="http://papermashup.com/demos/autosuggest/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
													<div class="suggestionList" id="suggestionsList">
														&nbsp;
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="one-half auto">
									<div class="table">
										<h2>Username Lookup</h2>
<script>

</script>
										<form action="#" method="post">
											<p>
												Ashley, John, Mark, Paul, Rich, Luke, Simon, Adam
											</p>
											Username:
											<input name="username" id="username" type="text" />
											<img id="tick" src="http://papermashup.com/demos/check-username/tick.png" width="16" height="16"/>
											<img id="cross" src="http://papermashup.com/demos/check-username/cross.png" width="16" height="16"/>
										</form>
									</div>
								</div>
								<div class="one-half check">
									<div class="table">
										<h2>AJAX Check</h2>
										<script>
											$(document).ready(function(){
												$('#ajax').click(function(event){
												jQuery.ajax({
												type: "POST",
												url: "<?= BASE_URL ?>dev/ajax_check",
													data: 'date=' + 'today',
													cache: false,
													success: function(response) {
														if(response == 1) {

															$('#result').html('This is an ajax request');
															$('#result').css('display', 'block');
														}
													}
													});
													});
													// close DOM
												});
										</script>
										<div id="result"></div>
										<div id="ajax">
											<span>Click here to make an ajax request</span>
										</div>
										<br/>
										<fieldset>
											<h3>Non AJAX Request</h3>
											<form action="<?= BASE_URL ?>dev/ajax_check" method="post">
												<input name="check" type="submit" />
											</form>
										</fieldset>
									</div>
								</div>
						</div>
				</div>
			</div>
			<div class="one-full">
				<section id="grid-system" class="normal">
					<div class="page-header">
						<h1>Grid system <small>Rock the standard 940px or roll your own</small></h1>
					</div>
					<div class="row">
						<div class="span4 columns">
							<h2>Default grid</h2>
							<p>
								The default grid system provided as part of Bootstrap is a 940px wide 16-column grid. It’s a flavor of the popular 960 grid system, but without the additional margin/padding on the left and right sides.
							</p>
						</div>
						<div class="span12 columns">
							<h3>Example grid markup</h3>
							<p>
								As shown here, a basic layout can be created with two "columns," each spanning a number of the 16 foundational columns we defined as part of our grid system. See the examples below for more variations.
							</p>
							<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"row"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">  </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"span6 columns"</span><span class="tag">&gt;</span></li><li class="L2"><span class="pln">	   ...</span></li><li class="L3"><span class="pln">	 </span><span class="tag">&lt;/div&gt;</span></li><li class="L4"><span class="pln">	 </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"span10 columns"</span><span class="tag">&gt;</span></li><li class="L5"><span class="pln">	  ...</span></li><li class="L6"><span class="pln">	</span><span class="tag">&lt;/div&gt;</span></li><li class="L7"><span class="tag">&lt;/div&gt;</span></li></ol></pre>
						</div>
					</div><!-- /row -->
					<div title="16 column layout" class="row show-grid">
						<div class="one-full column">Full</div>
					</div>
					<div title="16 column layout" class="row show-grid">
						<div class="one-full">
							<div class="one-half column">1/2</div>
							<div class="one-half column">1/2</div>
						</div>
					</div>
					<div title="16 column layout" class="row show-grid">
						<div class="one-full">
							<div class="one-quarter column">1/4</div>
							<div class="three-quarter column">3/4</div>
						</div>
					</div>
					<div title="16 column layout" class="row show-grid">
						<div class="one-full">
							<div class="one-half column">1/2</div>
							<div class="one-quarter column">1/4</div>
							<div class="one-quarter column">1/4</div>
						</div>
					</div>
					<div title="16 column layout" class="row show-grid">
						<div class="one-full">
							<div class="one-third column">1/3</div>
							<div class="two-third column">2/3</div>
						</div>
					</div>
					<div title="16 column layout" class="row show-grid">
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
						<div class="span1 column">
							1
						</div>
					</div><!-- /row -->
					<div title="8 column layout" class="row show-grid">
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
						<div class="span2 columns">
							2
						</div>
					</div><!-- /row -->
					<div title="Example uncommon layout" class="row show-grid">
						<div class="span3 columns">
							3
						</div>
						<div class="span3 columns">
							3
						</div>
						<div class="span3 columns">
							3
						</div>
						<div class="span3 columns">
							3
						</div>
						<div class="span3 columns">
							3
						</div>
						<div class="span1 column">
							1
						</div>
					</div><!-- /row -->
					<div title="Four column layout" class="row show-grid">
						<div class="span4 columns">
							4
						</div>
						<div class="span4 columns">
							4
						</div>
						<div class="span4 columns">
							4
						</div>
						<div class="span4 columns">
							4
						</div>
					</div><!-- /row -->
					<div title="Irregular three column layout" class="row show-grid">
						<div class="span4 columns">
							4
						</div>
						<div class="span6 columns">
							6
						</div>
						<div class="span6 columns">
							6
						</div>
					</div><!-- /row -->
					<div title="Half and half" class="row show-grid">
						<div class="span8 columns">
							8
						</div>
						<div class="span8 columns">
							8
						</div>
					</div><!-- /row -->
					<div title="Example uncommon two-column layout" class="row show-grid">
						<div class="span5 columns">
							5
						</div>
						<div class="span11 columns">
							11
						</div>
					</div><!-- /row -->
					<div title="Unnecessary single column layout" class="row show-grid">
						<div class="span16 columns">
							16
						</div>
					</div><!-- /row -->
					<h4>Offsetting columns</h4>
					<div class="row show-grid">
						<div class="span4 columns">
							4
						</div>
						<div class="span8 columns offset4">
							8 offset 4
						</div>
					</div><!-- /row -->
					<div class="row show-grid">
						<div class="span4 columns offset4">
							4 offset 4
						</div>
						<div class="span4 columns offset4">
							4 offset 4
						</div>
					</div><!-- /row -->
					<div class="row show-grid">
						<div class="span5 columns offset3">
							5 offset 3
						</div>
						<div class="span5 columns offset3">
							5 offset 3
						</div>
					</div><!-- /row -->
					<div class="row show-grid">
						<div class="span10 columns offset6">
							10 offset 6
						</div>
					</div><!-- /row -->
				</section>
			</div>
			<div class="one-full">
				

				<!-- Typography
				================================================== -->
				<section id="typography">
				  <div class="page-header">
					<h1>Typography <small>Headings, paragraphs, lists, and other inline type elements</small></h1>
				  </div>

				  <!-- Headings & Paragraph Copy -->
				  <div class="row">
					<div class="span4">
					  <h2>Headings &amp; copy</h2>
					  <p>A standard typographic hierarchy for structuring your webpages.</p>
					  <p>The entire typographic grid is based on two Less variables in our preboot.less file: <code>@basefont</code> and <code>@baseline</code>. The first is the base font-size used throughout and the second is the base line-height.</p>
					  <p>We use those variables, and some math, to create the margins, paddings, and line-heights of all our type and more.</p>
					</div>
					<div class="span4">
					  <h1>h1. Heading 1</h1>
					  <h2>h2. Heading 2</h2>
					  <h3>h3. Heading 3</h3>
					  <h4>h4. Heading 4</h4>
					  <h5>h5. Heading 5</h5>
					  <h6>h6. Heading 6</h6>
					</div>
					<div class="span8">
					  <h3>Example paragraph</h3>
					  <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					  <h1>Example heading <small>Has sub-heading&hellip;</small></h1>
					</div>
				  </div>

				  <!-- Misc Elements -->
				  <div class="row">
					<div class="span4">
					  <h2>Misc. elements</h2>
					  <p>Using emphasis, addresses, &amp; abbreviations</p>
					  <p>
						<code>&lt;strong&gt;</code>
						<code>&lt;em&gt;</code>
						<code>&lt;address&gt;</code>
						<code>&lt;abbr&gt;</code>
					  </p>
					</div>
					<div class="span12">
					  <h3>When to use</h3>
					  <p>Emphasis tags (<code>&lt;strong&gt;</code> and <code>&lt;em&gt;</code>) should be used to indicate additional importance or emphasis of a word or phrase relative to its surrounding copy. Use <code>&lt;strong&gt;</code> for importance and <code>&lt;em&gt;</code> for <em>stress</em> emphasis.</p>
					  <h3>Emphasis in a paragraph</h3>
					  <p><a href="#">Fusce dapibus</a>, <strong>tellus ac cursus commodo</strong>, <em>tortor mauris condimentum nibh</em>, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue.</p>
					  <p><strong>Note:</strong> It's still okay to use <code>&lt;b&gt;</code> and <code>&lt;i&gt;</code> tags in HTML5 and they don't have to be styled bold and italic, respectively (although if there is a more semantic element, use it). <code>&lt;b&gt;</code> is meant to highlight words or phrases without conveying additional importance, while <code>&lt;i&gt;</code> is mostly for voice, technical terms, etc.</p>
					  <h3>Addresses</h3>
					  <p>The <code>&lt;address&gt;</code> element is used for contact information for its nearest ancestor, or the entire body of work. Here are two examples of how it could be used:</p>

					  <div class="row">
						<div class="span4">
						  <address>
							<strong>Twitter, Inc.</strong><br />
							795 Folsom Ave, Suite 600<br />
							San Francisco, CA 94107<br />
							<abbr title="Phone">P:</abbr> (123) 456-7890
						  </address>
						</div>
						<div class="span4">
						  <address>
							<strong>Full Name</strong><br />
							<a mailto="">first.last@gmail.com</a>
						  </address>
						</div>
					  </div>

					  <p><strong>Note:</strong> Each line in an <code>&lt;address&gt;</code> must end with a line-break (<code>&lt;br /&gt;</code>) or be wrapped in a block-level tag (e.g., <code>&lt;p&gt;</code>) to properly structure the content.</p>
					  <h3>Abbreviations</h3>
					  <p>For abbreviations and acronyms, use the <code>&lt;abbr&gt;</code> tag (<code>&lt;acronym&gt;</code> is deprecated in <abbr title="HyperText Markup Langugage 5">HTML5</abbr>). Put the shorthand form within the tag and set a title for the complete name.</p>
					</div>
				  </div><!-- /row -->

				  <!-- Blockquotes -->
				  <div class="row">
					<div class="span4">
					  <h2>Blockquotes</h2>
					  <p>
						<code>&lt;blockquote&gt;</code>
						<code>&lt;p&gt;</code>
						<code>&lt;small&gt;</code>
					  </p>
					</div>
					<div class="span12">
					  <h3>How to quote</h3>
					  <p>To include a blockquote, wrap <code>&lt;blockquote&gt;</code> around <code>&lt;p&gt;</code> and <code>&lt;small&gt;</code> tags. Use the <code>&lt;small&gt;</code> element to cite your source and you'll get an em dash <code>&amp;mdash;</code> before it.</p>
					  <blockquote>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
						<small>Dr. Julius Hibbert</small>
					  </blockquote>
				<pre class="prettyprint linenums">
				&lt;blockquote&gt;
				  &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.&lt;/p&gt;
				  &lt;small&gt;Dr. Julius Hibbert&lt;/small&gt;
				&lt;/blockquote&gt;
				</pre>
					</div>
				  </div><!-- /row -->

				  <h2>Lists</h2>
				  <div class="row">
					<div class="span4">
					  <h4>Unordered <code>&lt;ul&gt;</code></h4>
					  <ul>
						<li>Lorem ipsum dolor sit amet</li>
						<li>Consectetur adipiscing elit</li>
						<li>Integer molestie lorem at massa</li>
						<li>Facilisis in pretium nisl aliquet</li>
						<li>Nulla volutpat aliquam velit
						  <ul>
							<li>Phasellus iaculis neque</li>
							<li>Purus sodales ultricies</li>
							<li>Vestibulum laoreet porttitor sem</li>
							<li>Ac tristique libero volutpat at</li>
						  </ul>
						</li>
						<li>Faucibus porta lacus fringilla vel</li>
						<li>Aenean sit amet erat nunc</li>
						<li>Eget porttitor lorem</li>
					  </ul>
					</div>
					<div class="span4">
					  <h4>Unstyled <code>&lt;ul.unstyled&gt;</code></h4>
					  <ul class="unstyled">
						<li>Lorem ipsum dolor sit amet</li>
						<li>Consectetur adipiscing elit</li>
						<li>Integer molestie lorem at massa</li>
						<li>Facilisis in pretium nisl aliquet</li>
						<li>Nulla volutpat aliquam velit
						  <ul>
							<li>Phasellus iaculis neque</li>
							<li>Purus sodales ultricies</li>
							<li>Vestibulum laoreet porttitor sem</li>
							<li>Ac tristique libero volutpat at</li>
						  </ul>
						</li>
						<li>Faucibus porta lacus fringilla vel</li>
						<li>Aenean sit amet erat nunc</li>
						<li>Eget porttitor lorem</li>
					  </ul>
					</div>
					<div class="span4">
					  <h4>Ordered <code>&lt;ol&gt;</code></h4>
					  <ol>
						<li>Lorem ipsum dolor sit amet</li>
						<li>Consectetur adipiscing elit</li>
						<li>Integer molestie lorem at massa</li>
						<li>Facilisis in pretium nisl aliquet</li>
						<li>Nulla volutpat aliquam velit</li>
						<li>Faucibus porta lacus fringilla vel</li>
						<li>Aenean sit amet erat nunc</li>
						<li>Eget porttitor lorem</li>
					  </ol>
					</div>
					<div class="span4">
					  <h4>Description <code>dl</code></h4>
					  <dl>
						<dt>Description lists</dt>
						<dd>A description list is perfect for defining terms.</dd>
						<dt>Euismod</dt>
						<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
						<dd>Donec id elit non mi porta gravida at eget metus.</dd>
						<dt>Malesuada porta</dt>
						<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
					  </dl>
					</div>
				  </div><!-- /row -->


				  <!-- Code -->
				  <div class="row">
					<div class="span4">
					  <h2>Code</h2>
					  <p>
						<code>&lt;code&gt;</code>
						<code>&lt;pre&gt;</code>
					  </p>
					  <p>Pimp your code in style with two simple tags. For even more awesomeness through javascript, drop in Google's code prettify library and you're set.</p>
					</div>
					<div class="span12">
					  <h3>Presenting code</h3>
					  <p>Code, blocks of or just snippets inline, can be displayed with style just by wrapping in the right tag. For blocks of code spanning multiple lines, use the <code>&lt;pre&gt;</code> element. For inline code, use the <code>&lt;code&gt;</code> element.</p>
					  <table class="zebra-striped">
						<thead>
						  <tr>
							<th style="width: 190px;">Element</th>
							<th>Result</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td><code>&lt;code&gt;</code></td>
							<td>In a line of text like this, your wrapped code will look like this <code>&gt;html&lt;</code> element.</td>
						  </tr>
						  <tr>
							<td><code>&lt;pre&gt;</code></td>
							<td>
				<pre>&lt;div&gt;
				  &lt;h1&gt;Heading&lt;/h1&gt;
				  &lt;p&gt;Something right here...&lt;/p&gt;
				&lt;/div&gt;</pre>
							  <p><strong>Note:</strong> Be sure to keep code within <code>pre</code> tags as close to the left as possible; it will render all tabs.</p>
							</td>
						  </tr>
						  <tr>
							<td><code>&lt;pre class="prettyprint"&gt;</code></td>
							<td>
							  <p>Using the google-code-prettify library, you're blocks of code get a slightly different visual style and automatic syntax highlighting.</p>
				<pre class="prettyprint">&lt;div&gt;
				  &lt;h1&gt;Heading&lt;/h1&gt;
				  &lt;p&gt;Something right here...&lt;/p&gt;
				&lt;/div&gt;</pre>
							  <p><a href="http://code.google.com/p/google-code-prettify/">Download google-code-prettify</a> and view the readme for <a href="http://google-code-prettify.googlecode.com/svn/trunk/README.html">how to use</a>.</p>
							</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				  </div><!-- /row -->

				  <!-- Labels -->
				  <div class="row">
					<div class="span4">
					  <h2>Inline labels</h2>
					  <p>
						<code>&lt;span class="label"&gt;</code>
					  </p>
					  <p>Call attention to or flag any phrase in your body text.</p>
					</div>
					<div class="span12">
					  <h3>Label anything</h3>
					  <p>Ever needed one of those fancy <span class="label success">New!</span> or <span class="label important">Important</span> flags when writing code? Well, now you have them. Here's what's included by default:</p>
					  <table class="zebra-striped">
						<thead>
						  <tr>
							<th style="width: 50%;">Label</th>
							<th>Result</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>
							  <code>&lt;span class="label"&gt;Default&lt;/span&gt;</code>
							</td>
							<td>
							  <span class="label">Default</span>
							</td>
						  </tr>
						  <tr>
							<td>
							  <code>&lt;span class="label success"&gt;New&lt;/span&gt;</code>
							</td>
							<td>
							  <span class="label success">New</span>
							</td>
						  </tr>
						  <tr>
							<td>
							  <code>&lt;span class="label warning"&gt;Warning&lt;/span&gt;</code>
							</td>
							<td>
							  <span class="label warning">Warning</span>
							</td>
						  </tr>
						  <tr>
							<td>
							  <code>&lt;span class="label important"&gt;Important&lt;/span&gt;</code>
							</td>
							<td>
							  <span class="label important">Important</span>
							</td>
						  </tr>
						  <tr>
							<td>
							  <code>&lt;span class="label notice"&gt;Notice&lt;/span&gt;</code>
							</td>
							<td>
							  <span class="label notice">Notice</span>
							</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				  </div><!-- /row -->

				</section>



				<!-- Media
				================================================== -->
				<section id="media">
				  <div class="page-header">
					<h1>Media <small>Displaying images and videos</small></h1>
				  </div>
				  <!-- Table structure -->
				  <div class="row">
					<div class="span4">
					  <h2>Media grid</h2>
					  <p>Display thumbnails of varying sizes on pages with a low HTML footprint and minimal styles.</p>
					</div>
					<div class="span12">
					  <h3>Example thumbnails</h3>
					  <p>Thumbnails in the <code>.media-grid</code> can be any size, but they work best when mapped directly to the built-in Bootstrap grid system. Image widths like 90, 210, and 330 combine with a few pixels of padding to equal the <code>.span2</code>, <code>.span4</code>, and <code>.span6</code> column sizes.</p>
					  <h4>Large</h4>
					  <ul class="media-grid">
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/330x230" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/330x230" alt="">
						  </a>
						</li>
					  </ul>
					  <h4>Medium</h4>
					  <ul class="media-grid">
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/210x150" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/210x150" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/210x150" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/210x150" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/210x150" alt="">
						  </a>
						</li>
					  </ul>
					  <h4>Small</h4>
					  <ul class="media-grid">
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/90x90" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/90x90" alt="">
						  </a>
						</li>
						<li>
						  <a href="#">
							<img class="thumbnail" src="http://placehold.it/90x90" alt="">
						  </a>
						</li>
					  </ul>
					  <h4>Coding them</h4>
					  <p>Media grids are easy to use and rather simple on the markup side. Their dimensions are purely based on the size of the images included.</p>
				<pre class="prettyprint linenums">
				&lt;ul class="media-grid"&gt;
				  &lt;li&gt;
					&lt;a href="#"&gt;
					  &lt;img class="thumbnail" src="http://placehold.it/330x230" alt=""&gt;
					&lt;/a&gt;
				  &lt;/li&gt;
				  &lt;li&gt;
					&lt;a href="#"&gt;
					  &lt;img class="thumbnail" src="http://placehold.it/330x230" alt=""&gt;
					&lt;/a&gt;
				  &lt;/li&gt;
				&lt;/ul&gt;
				</pre>
					</div>
				  </div><!-- /row -->
				</section>



				<!-- Tables
				================================================== -->
				<section id="tables">
				  <div class="page-header">
					<h1>Tables <small>For, you guessed it, tabular data</small></h1>
				  </div>
				  <!-- Table structure -->
				  <div class="row">
					<div class="span4">
					  <h2>Building tables</h2>
					  <p>
						<code>&lt;table&gt;</code>
						<code>&lt;thead&gt;</code>
						<code>&lt;tbody&gt;</code>
						<code>&lt;tr&gt;</code>
						<code>&lt;th&gt;</code>
						<code>&lt;td&gt;</code>
						<code>&lt;colspan&gt;</code>
						<code>&lt;caption&gt;</code>
					  </p>
					  <p>Tables are great&mdash;for a lot of things. Great tables, however, need a bit of markup love to be useful, scalable, and readable (at the code level). Here are a few tips to help.</p>
					  <p>Always wrap your column headers in a <code>&lt;thead&gt;</code> such that hierarchy is <code>&lt;thead&gt;</code> > <code>&lt;tr&gt;</code> > <code>&lt;th&gt;</code>.</p>
					  <p>Similar to the column headers, all your table’s body content should be wrapped in a <code>&lt;tbody&gt;</code> so your hierarchy is <code>&lt;tbody&gt;</code> > <code>&lt;tr&gt;</code> > <code>&lt;td&gt;</code>.</p>
					</div>
					<div class="span12">
					  <h3>Example: Default table styles</h3>
					  <p>All tables will be automatically styled with only the essential borders to ensure readability and maintain structure. No need to add extra classes or attributes.</p>
					  <table>
						<thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Language</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>1</td>
							<td>Some</td>
							<td>One</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>2</td>
							<td>Joe</td>
							<td>Sixpack</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>3</td>
							<td>Stu</td>
							<td>Dent</td>
							<td>Code</td>
						  </tr>
						</tbody>
					  </table>
				<pre class="prettyprint linenums">
				&lt;table&gt;
				  ...
				&lt;/table&gt;</pre>
					  <h3>Example: Zebra-striped</h3>
					  <p>Get a little fancy with your tables by adding zebra-striping&mdash;just add the <code>.zebra-striped</code> class.</p>
					  <table class="zebra-striped">
						<thead>
						  <tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Language</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>1</td>
							<td>Some</td>
							<td>One</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>2</td>
							<td>Joe</td>
							<td>Sixpack</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>3</td>
							<td>Stu</td>
							<td>Dent</td>
							<td>Code</td>
						  </tr>
						</tbody>
					  </table>
					  <p><strong>Note:</strong> Zebra-striping is a progressive enhancement not available for older browsers like IE8 and below.</p>
				<pre class="prettyprint linenums">
				&lt;table class="zebra-striped"&gt;
				...
				&lt;/table&gt;</pre>
					  <h3>Example: Zebra-striped w/ TableSorter.js</h3>
					  <p>Taking the previous example, we improve the usefulness of our tables by providing sorting functionality via <a href="http://jquery.com">jQuery</a> and the <a href="http://tablesorter.com/docs/">Tablesorter</a> plugin. <strong>Click any column’s header to change the sort.</strong></p>
					  <table class="zebra-striped" id="sortTableExample">
						<thead>
						  <tr>
							<th>#</th>
							<th class="yellow">First Name</th>
							<th class="blue">Last Name</th>
							<th class="green">Language</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>1</td>
							<td>Your</td>
							<td>One</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>2</td>
							<td>Joe</td>
							<td>Sixpack</td>
							<td>English</td>
						  </tr>
						  <tr>
							<td>3</td>
							<td>Stu</td>
							<td>Dent</td>
							<td>Code</td>
						  </tr>
						</tbody>
					  </table>
				<pre class="prettyprint linenums">
				&lt;script src="js/jquery/jquery.tablesorter.min.js"&gt;&lt;/script&gt;
				&lt;script &gt;
				  $(function() {
					$("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
				  });
				&lt;/script&gt;
				&lt;table class="zebra-striped"&gt;
				  ...
				&lt;/table&gt;</pre>
					</div>
				  </div><!-- /row -->
				</section>



				<!-- Forms
				================================================== -->
				<section id="forms">
				  <div class="page-header">
					<h1>Forms</h1>
				  </div>
				  <div class="row">
					<div class="span4">
					  <h2>Default styles</h2>
					  <p>All forms are given default styles to present them in a readable and scalable way. Styles are provided for text inputs, select lists, textareas, radio buttons and checkboxes, and buttons.</p>
					</div>
					<div class="span12">
					  <form>
						<fieldset>
						  <legend>Example form legend</legend>
						  <div class="clearfix">
							<label for="xlInput">X-Large input</label>
							<div class="input">
							  <input class="xlarge" id="xlInput" name="xlInput" size="30" type="text" />
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="normalSelect">Select</label>
							<div class="input">
							  <select name="normalSelect" id="normalSelect">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							  </select>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="mediumSelect">Select</label>
							<div class="input">
							  <select class="medium" name="mediumSelect" id="mediumSelect">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							  </select>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="multiSelect">Multiple select</label>
							<div class="input">
							  <select class="medium" multiple="multiple" name="multiSelect" id="multiSelect">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							  </select>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label>Uneditable input</label>
							<div class="input">
							  <span class="uneditable-input">Some value here</span>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="disabledInput">Disabled input</label>
							<div class="input">
							  <input class="xlarge disabled" id="disabledInput" name="disabledInput" size="30" type="text" placeholder="Disabled input here… carry on." disabled />
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="disabledInput">Disabled textarea</label>
							<div class="input">
							  <textarea class="xxlarge" name="textarea" id="textarea" rows="3" disabled></textarea>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix error">
							<label for="xlInput2">X-Large input</label>
							<div class="input">
							  <input class="xlarge error" id="xlInput2" name="xlInput2" size="30" type="text" />
							  <span class="help-inline">Small snippet of help text</span>
							</div>
						  </div><!-- /clearfix -->
						</fieldset>
						<fieldset>
						  <legend>Example form legend</legend>
						  <div class="clearfix">
							<label for="prependedInput">Prepended text</label>
							<div class="input">
							  <div class="input-prepend">
								<span class="add-on">@</span>
								<input class="medium" id="prependedInput" name="prependedInput" size="16" type="text" />
							  </div>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="prependedInput2">Prepended checkbox</label>
							<div class="input">
							  <div class="input-prepend">
								<label class="add-on"><input type="checkbox" name="" id="" value="" /></label>
								<input class="mini" id="prependedInput2" name="prependedInput2" size="16" type="text" />
							  </div>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="appendedInput">Appended checkbox</label>
							<div class="input">
							  <div class="input-append">
								<input class="mini" id="appendedInput" name="appendedInput" size="16" type="text" />
								<label class="add-on active"><input type="checkbox" name="" id="" value="" checked="checked" /></label>
							  </div>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="fileInput">File input</label>
							<div class="input">
							  <input class="input-file" id="fileInput" name="fileInput" type="file" />
							</div>
						  </div><!-- /clearfix -->
						</fieldset>
						<fieldset>
						  <legend>Example form legend</legend>
						  <div class="clearfix">
							<label id="optionsCheckboxes">List of options</label>
							<div class="input">
							  <ul class="inputs-list">
								<li>
								  <label>
									<input type="checkbox" name="optionsCheckboxes" value="option1" />
									<span>Option one is this and that&mdash;be sure to include why it’s great</span>
								  </label>
								</li>
								<li>
								  <label>
									<input type="checkbox" name="optionsCheckboxes" value="option2" />
									<span>Option two can also be checked and included in form results</span>
								  </label>
								</li>
								<li>
								  <label>
									<input type="checkbox" name="optionsCheckboxes" value="option2" />
									<span>Option three can&mdash;yes, you guessed it&mdash;also be checked and included in form results</span>
								  </label>
								</li>
								<li>
								  <label class="disabled">
									<input type="checkbox" name="optionsCheckboxes" value="option2" disabled />
									<span>Option four cannot be checked as it is disabled.</span>
								  </label>
								</li>
							  </ul>
							  <span class="help-block">
								<strong>Note:</strong> Labels surround all the options for much larger click areas and a more usable form.
							  </span>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label>Date range</label>
							<div class="input">
							  <div class="inline-inputs">
								<input class="small" type="text" value="May 1, 2011" />
								<input class="mini" type="text" value="12:00am" />
								to
								<input class="small" type="text" value="May 8, 2011" />
								<input class="mini" type="text" value="11:59pm" />
								<span class="help-inline">All times are shown as Pacific Standard Time (GMT -08:00).</span>
							  </div>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="textarea">Textarea</label>
							<div class="input">
							  <textarea class="xxlarge" id="textarea2" name="textarea2" rows="3"></textarea>
							  <span class="help-block">
								Block of help text to describe the field above if need be.
							  </span>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label id="optionsRadio">List of options</label>
							<div class="input">
							  <ul class="inputs-list">
								<li>
								  <label>
									<input type="radio" checked name="optionsRadios" value="option1" />
									<span>Option one is this and that&mdash;be sure to include why it’s great</span>
								  </label>
								</li>
								<li>
								  <label>
									<input type="radio" name="optionsRadios" value="option2" />
									<span>Option two can is something else and selecting it will deselect options 1</span>
								  </label>
								</li>
							  </ul>
							</div>
						  </div><!-- /clearfix -->
						  <div class="actions">
							<input type="submit" class="btn primary" value="Save changes">&nbsp;<button type="reset" class="btn">Cancel</button>
						  </div>
						</fieldset>
					  </form>
					</div>
				  </div><!-- /row -->

				  <br />

				  <div class="row">
					<div class="span4">
					  <h2>Stacked forms</h2>
					  <p>Add <code>.form-stacked</code> to your form’s HTML and you’ll have labels on top of their fields instead of to their left. This works great if your forms are short or you have two columns of inputs for heavier forms.</p>
					</div>
					<div class="span12">
					  <form action="" class="form-stacked">
						<fieldset>
						  <legend>Example form legend</legend>
						  <div class="clearfix">
							<label for="xlInput3">X-Large input</label>
							<div class="input">
							  <input class="xlarge" id="xlInput3" name="xlInput3" size="30" type="text" />
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label for="stackedSelect">Select</label>
							<div class="input">
							  <select name="stackedSelect" id="stackedSelect">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							  </select>
							</div>
						  </div><!-- /clearfix -->
						</fieldset>
						<fieldset>
						  <legend>Example form legend</legend>
						  <div class="clearfix error">
							<label for="xlInput4">X-Large input</label>
							<div class="input">
							  <input class="xlarge error" id="xlInput4" name="xlInput4" size="30" type="text" />
							  <span class="help-inline">Small snippet of help text</span>
							</div>
						  </div><!-- /clearfix -->
						  <div class="clearfix">
							<label id="optionsCheckboxes">List of options</label>
							<div class="input">
							  <ul class="inputs-list">
								<li>
								  <label>
									<input type="checkbox" name="optionsCheckboxes" value="option1" />
									<span>Option one is this and that&mdash;be sure to include why it’s great</span>
								  </label>
								</li>
								<li>
								  <label>
									<input type="checkbox" name="optionsCheckboxes" value="option2" />
									<span>Option two can also be checked and included in form results</span>
								  </label>
								</li>
							  </ul>
							  <span class="help-block">
								<strong>Note:</strong> Labels surround all the options for much larger click areas and a more usable form.
							  </span>
							</div>
						  </div><!-- /clearfix -->
						</fieldset>
						<div class="actions">
						  <button type="submit" class="btn primary">Save changes</button>&nbsp;<button type="reset" class="btn">Cancel</button>
						</div>
					  </form>
					</div>
				  </div><!-- /row -->

				  <div class="row">
					<div class="span4">
					  <h2>Form field sizes</h2>
					  <p>Customize any form <code>input</code>, <code>select</code>, or <code>textarea</code> width by adding just a few classes to your markup.</p>
					  <p>As of v1.3.0, we have added the grid-based sizing classes for form elements. <strong>Please use the these over the existing <code>.mini</code>, <code>.small</code>, etc classes.</strong></p>
					</div>
					<div class="span12">
					  <form action="">
						<div class="clearfix"><input class="span2" id="" name="" type="text" placeholder=".span2" /></div>
						<div class="clearfix"><input class="span3" id="" name="" type="text" placeholder=".span3" /></div>
						<div class="clearfix"><input class="span4" id="" name="" type="text" placeholder=".span4" /></div>
						<div class="clearfix"><input class="span5" id="" name="" type="text" placeholder=".span5" /></div>
						<div class="clearfix"><input class="span6" id="" name="" type="text" placeholder=".span6" /></div>
						<div class="clearfix"><input class="span7" id="" name="" type="text" placeholder=".span7" /></div>
						<div class="clearfix"><input class="span8" id="" name="" type="text" placeholder=".span8" /></div>
						<div class="clearfix"><input class="span9" id="" name="" type="text" placeholder=".span9" /></div>
						<div class="clearfix"><input class="span10" id="" name="" type="text" placeholder=".span10" /></div>
						<div class="clearfix"><input class="span11" id="" name="" type="text" placeholder=".span11" /></div>
						<div class="clearfix"><input class="span12" id="" name="" type="text" placeholder=".span12" /></div>
					  </form>
					</div>
				  </div>

				  <div class="row">
					<div class="span4">
					  <h2>Buttons</h2>
					  <p>As a convention, buttons are used for actions while links are used for objects. For instance, "Download" could be a button and "recent activity" could be a link.</p>
					  <p>All buttons default to a light gray style, but a number of functional classes can be applied for different color styles. These classes include a blue <code>.primary</code> class, a light-blue <code>.info</code> class, a green <code>.success</code> class, and a red <code>.danger</code> class.</p>
					</div>
					<div class="span12">
					  <h3>Example buttons</h3>
					  <p>Button styles can be applied to anything with the <code>.btn</code> applied. Typically you’ll want to apply these to only <code>&lt;a&gt;</code>, <code>&lt;button&gt;</code>, and select <code>&lt;input&gt;</code> elements. Here’s how it looks:</p>
					  <div class="well" style="padding: 14px 19px;">
						<button class="btn primary">Primary</button>&nbsp;<button class="btn">Default</button>&nbsp;<button class="btn info">Info</button>&nbsp;<button class="btn success">Success</button>&nbsp;<button class="btn danger">Danger</button>
					  </div>
					  <h3>Alternate sizes</h3>
					  <p>Fancy larger or smaller buttons? Have at it!</p>
					  <div class="well">
						<a href="#" class="btn large primary">Primary action</a>
						<a href="#" class="btn large">Action</a>
					  </div>
					  <div class="well" style="padding: 16px 19px;">
						<a href="#" class="btn small primary">Primary action</a>
						<a href="#" class="btn small">Action</a>
					  </div>
					  <h3>Disabled state</h3>
					  <p>For buttons that are not active or are disabled by the app for one reason or another, use the disabled state. That’s <code>.disabled</code> for links and <code>:disabled</code> for <code>&lt;button&gt;</code> elements.</p>
					  <h4>Links</h4>
					  <div class="well">
						<a href="#" class="btn large primary disabled">Primary action</a>
						<a href="#" class="btn large disabled">Action</a>
					  </div>
					  <h4>Buttons</h4>
					  <div class="well">
						<button class="btn large primary disabled" disabled="disabled">Primary action</button>&nbsp;<button class="btn large" disabled>Action</button>
					  </div>
					</div>
				  </div><!-- /row -->
				</section>



				<!-- Navigation
				================================================== -->
				<section id="navigation">
				  <div class="page-header">
					<h1>Navigation</h1>
				  </div>
				  
				  <div class="row">
					<div class="span5">
					  <h4>What is it</h4>
					  <p>Our topbar is a fixed bar that houses a website’s logo or name, primary navigation, and search form.</p>
					</div>
					<div class="span5">
					  <h4>Customizable</h4>
					  <p>All elements within, and the entire topbar as well, are optional. You can choose to include a logo/name, nav, search, and a secondary nav&mdash;or any combination of that.</p>
					</div>
					<div class="span6">
					  <h4>Dropdowns included</h4>
					  <p>As part of the main navigation, we’ve included the ability for you to add dropdowns to your nav. Check out the secondary nav above (right aligned) to see how it’s done. Dropdowns <code>li</code> tags also support <code>.active</code> for showing current page selection.</p>
					</div>
				  </div>
				  <p><strong>Note:</strong> When using the topbar on any page, be sure to account for the overlap it causes by adding <code>padding-top: 40px;</code> to your <code>body</code>.</p>

				  <br />

				  <div class="row">
					<div class="span4">
					  <h2>Tabs and pills</h2>
					  <p>Create simple secondary navigation with a <code>&lt;ul&gt;</code>. Swap between tabs or pills by adding the appropriate class.</p>
					  <p>Great for sub-sections of content like our account settings pages and user timelines for toggling between pages of like content. Available in tabbed or pill styles.</p>
					</div>
					<div class="span12">
					  	<ul class="tabs" data-tabs="tabs" >
				            <li class="active"><a href="#home">Home</a></li>
				            <li><a href="#profile">Profile</a></li>
				            <li><a href="#messages">Messages</a></li>
				            <li><a href="#settings">Settings</a></li>
				          </ul>
				          <div id="my-tab-content" class="tab-body tab-content">
				            <div class="active" id="home">
				              <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
				            </div>
				            <div id="profile">
				              <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
				            </div>
				            <div id="messages">
				              <p>Banksy do proident, brooklyn photo booth delectus sunt artisan sed organic exercitation eiusmod four loko. Quis tattooed iphone esse aliqua. Master cleanse vero fixie mcsweeney's. Ethical portland aute, irony food truck pitchfork lomo eu anim. Aesthetic blog DIY, ethical beard leggings tofu consequat whatever cardigan nostrud. Helvetica you probably haven't heard of them carles, marfa veniam occaecat lomo before they sold out in shoreditch scenester sustainable thundercats. Consectetur tofu craft beer, mollit brunch fap echo park pitchfork mustache dolor.</p>
				            </div>
				            <div id="settings">
				              <p>Sunt qui biodiesel mollit officia, fanny pack put a bird on it thundercats seitan squid ad wolf bicycle rights blog. Et aute readymade farm-to-table carles 8-bit, nesciunt nulla etsy adipisicing organic ea. Master cleanse mollit high life, next level Austin nesciunt american apparel twee mustache adipisicing reprehenderit hoodie portland irony. Aliqua tofu quinoa +1 commodo eiusmod. High life williamsburg cupidatat twee homo leggings. Four loko vinyl DIY consectetur nisi, marfa retro keffiyeh vegan. Fanny pack viral retro consectetur gentrify fap.</p>
				            </div>
				          </div>
					</div>
				  </div><!-- /row -->

				  <!-- Breadcrumbs -->
				  <div class="row">
					<div class="span4">
					  <h2>Breadcrumbs</h2>
					  <p>Breadcrumb navigation is used as a way to show users where they are within an app or a site, but not for primary navigation.</p>
					</div>
					<div class="span12">
					  <ul class="breadcrumb">
						<li class="active">Home</li>
					  </ul>
					  <ul class="breadcrumb">
						<li><a href="#">Home</a> <span class="divider">/</span></li>
						<li class="active">Middle page</li>
					  </ul>
					  <ul class="breadcrumb">
						<li><a href="#">Home</a> <span class="divider">/</span></li>
						<li><a href="#">Middle page</a> <span class="divider">/</span></li>
						<li class="active">Another one</li>
					  </ul>
					  <ul class="breadcrumb">
						<li><a href="#">Home</a> <span class="divider">/</span></li>
						<li><a href="#">Middle page</a> <span class="divider">/</span></li>
						<li><a href="#">Another one</a> <span class="divider">/</span></li>
						<li class="active">You are here</li>
					  </ul>
				<pre class="prettyprint linenums">
				&lt;ul class="breadcrumb"&gt;
				  &lt;li&gt;&lt;a href="#"&gt;Home&lt;/a&gt; &lt;span class="divider"&gt;/&lt;/span&gt;&lt;/li&gt;
				  &lt;li&gt;&lt;a href="#"&gt;Middle page&lt;/a&gt; &lt;span class="divider"&gt;/&lt;/span&gt;&lt;/li&gt;
				  &lt;li&gt;&lt;a href="#"&gt;Another one&lt;/a&gt; &lt;span class="divider"&gt;/&lt;/span&gt;&lt;/li&gt;
				  &lt;li class="active"&gt;You are here&lt;/li&gt;
				&lt;/ul&gt;
				</pre>
					</div>
				  </div>

				  <!-- Pagination -->
				  <div class="row">
					<div class="span4">
					  <h2>Pagination</h2>
					  <p>Ultra simplistic and minimally styled pagination inspired by Rdio. The large block is hard to miss, easily scalable, and provides large click areas.</p>
					</div>
					<div class="span12">
					  <div class="pagination">
						<ul>
						  <li class="prev disabled"><a href="#">&larr; Previous</a></li>
						  <li class="active"><a href="#">1</a></li>
						  <li><a href="#">2</a></li>
						  <li><a href="#">3</a></li>
						  <li><a href="#">4</a></li>
						  <li><a href="#">5</a></li>
						  <li class="next"><a href="#">Next &raquo;</a></li>
						</ul>
					  </div>
					  <div class="pagination">
						<ul>
						  <li class="prev"><a href="#">&larr; Previous</a></li>
						  <li class="active"><a href="#">10</a></li>
						  <li><a href="#">11</a></li>
						  <li><a href="#">12</a></li>
						  <li class="disabled"><a href="#">…</a></li>
						  <li><a href="#">19</a></li>
						  <li><a href="#">20</a></li>
						  <li><a href="#">21</a></li>
						  <li class="next"><a href="#">Next &raquo;</a></li>
						</ul>
					  </div>
					  <div class="pagination">
						<ul>
						  <li class="prev"><a href="#">&larr; Previous</a></li>
						  <li><a href="#">10</a></li>
						  <li><a href="#">11</a></li>
						  <li><a href="#">12</a></li>
						  <li><a href="#">13</a></li>
						  <li><a href="#">14</a></li>
						  <li class="active"><a href="#">15</a></li>
						  <li><a href="#">16</a></li>
						  <li><a href="#">17</a></li>
						  <li><a href="#">18</a></li>
						  <li><a href="#">19</a></li>
						  <li><a href="#">20</a></li>
						  <li class="next"><a href="#">Next &raquo;</a></li>
						</ul>
					  </div>
				<pre class="prettyprint linenums">
				&lt;div class="pagination"&gt;
				  &lt;ul&gt;
					&lt;li class="prev disabled"&gt;&lt;a href="#"&gt;&amp;larr; Previous&lt;/a&gt;&lt;/li>
					&lt;li class="active"&gt;&lt;a href="#"&gt;1&lt;/a&gt;&lt;/li&gt;
					&lt;li&gt;&lt;a href="#"&gt;2&lt;/a&gt;&lt;/li&gt;
					&lt;li&gt;&lt;a href="#"&gt;3&lt;/a&gt;&lt;/li&gt;
					&lt;li&gt;&lt;a href="#"&gt;4&lt;/a&gt;&lt;/li&gt;
					&lt;li&gt;&lt;a href="#"&gt;5&lt;/a&gt;&lt;/li&gt;
					&lt;li class="next"&gt;&lt;a href="#"&gt;Next &amp;rarr;&lt;/a&gt;&lt;/li>
				  &lt;/ul&gt;
				&lt;/div&gt;
				</pre>
					</div>
				  </div><!-- /row -->

				</section>



				<!-- Alerts & Messages
				================================================== -->
				<section id="alerts">
				  <div class="page-header">
					<h1>Alerts &amp; Errors <small>Styles for success, warning, and error messages or alerts</small></h1>
				  </div>
				  <!-- Basic alert messages -->
				  <div class="row">
					<div class="span4">
					  <h2>Basic alerts</h2>
					  <p><code>.alert-message</code></p>
					  <p>One-line messages for highlighting the failure, possible failure, or success of an action. Particularly useful for forms.</p>
					</div>
					<div class="span12">
					  <div class="alert-message warning">
						<a class="close" href="#">&times;</a>
						<p><strong>Holy guacamole!</strong> Best check yo self, you’re not looking too good.</p>
					  </div>
					  <div class="alert-message error">
						<a class="close" href="#">&times;</a>
						<p><strong>Oh snap!</strong> Change this and that and try again.</p>
					  </div>
					  <div class="alert-message success">
						<a class="close" href="#">&times;</a>
						<p><strong>Well done!</strong> You successfully read this alert message.</p>
					  </div>
					  <div class="alert-message info">
						<a class="close" href="#">&times;</a>
						<p><strong>Heads up!</strong> This is an alert that needs your attention, but it’s not a huge priority just yet.</p>
					  </div>

					  <h4>Example code</h4>
				<pre class="prettyprint linenums">
				&lt;div class="alert-message warning"&gt;
				  &lt;a class="close" href="#"&gt;&times;&lt;/a&gt;
				  &lt;p&gt;&lt;strong&gt;Holy guacamole!&lt;/strong&gt; Best check yo self, you’re not looking too good.&lt;/p&gt;
				&lt;/div&gt;
				</pre>
					</div>
				  </div><!-- /row -->
				  <!-- Block messages -->
				  <div class="row">
					<div class="span4">
					  <h2>Block messages</h2>
					  <p><code>.alert-message.block-message</code></p>
					  <p>For messages that require a bit of explanation, we have paragraph style alerts. These are perfect for bubbling up longer error messages, warning a user of a pending action, or just presenting information for more emphasis on the page.</p>
					</div>
					<div class="span12">
					  <div class="alert-message block-message warning">
						<a class="close" href="#">&times;</a>
						<p><strong>Holy guacamole! This is a warning!</strong> Best check yo self, you’re not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
						<div class="alert-actions">
						  <a class="btn small" href="#">Take this action</a> <a class="btn small" href="#">Or do this</a>
						</div>
					  </div>
					  <div class="alert-message block-message error">
						<a class="close" href="#">&times;</a>
						<p><strong>Oh snap! You got an error!</strong> Change this and that and try again.</p>
						<ul>
						  <li>Duis mollis est non commodo luctus</li>
						  <li>Nisi erat porttitor ligula</li>
						  <li>Eget lacinia odio sem nec elit</li>
						</ul>
						<div class="alert-actions">
						  <a class="btn small" href="#">Take this action</a> <a class="btn small" href="#">Or do this</a>
						</div>
					  </div>
					  <div class="alert-message block-message success">
						<a class="close" href="#">&times;</a>
						<p><strong>Well done!</strong> You successfully read this alert message. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas faucibus mollis interdum.</p>
						<div class="alert-actions">
						  <a class="btn small" href="#">Take this action</a> <a class="btn small" href="#">Or do this</a>
						</div>
					  </div>
					  <div class="alert-message block-message info">
						<a class="close" href="#">&times;</a>
						<p><strong>Heads up!</strong> This is an alert that needs your attention, but it’s not a huge priority just yet.</p>
						<div class="alert-actions">
						  <a class="btn small" href="#">Take this action</a> <a class="btn small" href="#">Or do this</a>
						</div>
					  </div>

					  <h4>Example code</h4>
				<pre class="prettyprint linenums">
				&lt;div class="alert-message block-message warning"&gt;
				  &lt;a class="close" href="#"&gt;&times;&lt;/a&gt;
				  &lt;p&gt;&lt;strong&gt;Holy guacamole! This is a warning!&lt;/strong&gt; Best check yo self, you’re not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.&lt;/p&gt;
				  &lt;div class="alert-actions"&gt;
					&lt;a class="btn small" href="#"&gt;Take this action&lt;/a&gt; &lt;a class="btn small" href="#"&gt;Or do this&lt;/a>
				  &lt;/div&gt;
				&lt;/div&gt;
				</pre>
					</div>
				  </div><!-- /row -->
				</section>


				<!-- Twipsy
				================================================== -->
				<section id="popovers">
				  <div class="page-header">
					<h1>Twipsy <small>Components for displaying content in modals, tooltips, and popovers</small></h1>
				  </div>
				
				
				
				  <!-- Twipsy -->
				  <div class="row">
					<div class="span4">
					  <h2>Twipsy</h2>
					  	<p>Based on the excellent jQuery.tipsy plugin written by Jason Frame; twipsy is an updated version, which doesn't rely on images, uses css3 for animations, and data-attributes for title storage!</p>
					
					</div>
					<div class="span12 columns">
			          <div class="well">
			            <p class="muted">Tight pants next level keffiyeh <a href="#" rel='twipsy' title='Some title text'><strong>you probably</strong></a> haven't heard of them. Photo booth beard raw denim letterpress vegan messenger bag stumptown. Farm-to-table seitan, mcsweeney's fixie sustainable quinoa 8-bit american apparel <a href="#" rel='twipsy' title='Another twipsy'><strong>have a</strong></a> terry richardson vinyl chambray. Beard stumptown, cardigans banh mi lomo thundercats. Tofu biodiesel williamsburg marfa, four loko mcsweeney's cleanse vegan chambray. A <a href="#" rel='twipsy' title='Another one here too'><strong>really ironic</strong></a> artisan whatever keytar, scenester farm-to-table banksy Austin <a href="#" rel='twipsy' title='The last tip!'><strong>twitter handle</strong></a> freegan cred raw denim single-origin coffee viral.
			            </p>
			          </div>
			        </div>
				  </div><!-- /row -->
				
				<!-- Modals -->
				  <div class="row">
					<div class="span4">
					  <h2>Modals</h2>
					  <p>Modals&mdash;dialogs or lightboxes&mdash;are great for contextual actions in situations where it’s important that the background context be maintained.</p>
					</div>
					<div class="span12">
						<!-- sample modal content -->
				          <div id="modal-from-dom" class="modal hide fade">
				            <div class="modal-header">
				              <a href="#" class="close">&times;</a>
				              <h3>Modal Heading</h3>
				            </div>
				            <div class="modal-body">
				              <p>One fine body…</p>
				            </div>
				            <div class="modal-footer">
				              <a href="#" class="btn primary">Primary</a>
				              <a href="#" class="btn ">Secondary</a>
				            </div>
				          </div><!-- /End Modal Sample -->
			  			<button data-controls-modal="modal-from-dom" data-backdrop="true" data-keyboard="true" class="btn danger">Launch Modal</button>
					</div>
				  </div><!-- /row -->

				  <!-- Popovers -->
				  <div class="row">
					<div class="span4">
					  <h2>Popovers</h2>
					  <p>Use popovers to provide subtextual information to a page without affecting layout.</p>
					</div>
					<div class="span12">
					  <div class="well">
						  <a data-content="And here's some amazing content. It's very engaging. right?" rel="popover" class="btn danger" href="#" data-original-title="A Title">hover for popover</a>
					  </div>
					</div>
				  </div><!-- /row -->	

				</section>
			</div>
	</div><!-- #wrap -->
</div>
<!-- #wrapper-admin -->
</div> <!-- #body-wrappe -->
<? load::view('admin/templates/template-footer', array( 'assets' => array( '' ) ) ); ?>