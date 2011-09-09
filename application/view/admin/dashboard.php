<? load::view('admin/template-header', array('title' => 'Dashboard', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
				<link href="http://localhost/http/dev.tcms.me/tentacle/admin/css/dashboard.css" rel="stylesheet" type="text/css">
				<div class="one-full">
					<div class="title pad-right">
						<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" />Dashboard</h1>
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
										<script type="text/javascript">
											/*  Tags in input fields */
											$('.tags').tagsInput();

										</script>
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
$.post("<?= BASE_URL ?>
	dev / suggest", {queryString: ""+inputString+""}, function(data){
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
											$(document).ready(function(){
$('#username').keyup(username_check);
});

function username_check(){
var username = $('#username').val();
if(username == "" || username.length < 4){
$('#username').css('border', '3px #CCC solid');
$('#tick').hide();
}else{

jQuery.ajax({
type: "POST",
url: "<?= BASE_URL ?>
	dev / username_check / ",
	data: 'username='+ username,
	cache: false,
	success: function(response) {
		if(response == 1) {
			$('#username').css('border', '3px #C33 solid');
			$('#tick').hide();
			$('#cross').fadeIn();
		} else {
			$('#cross').hide();
			$('#tick').fadeIn();
		}
	}
	});
	}
	}
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
url: "<?= BASE_URL ?>
	dev / ajax_check",
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
							<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"row"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">  </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"span6 columns"</span><span class="tag">&gt;</span></li><li class="L2"><span class="pln">    ...</span></li><li class="L3"><span class="pln">  </span><span class="tag">&lt;/div&gt;</span></li><li class="L4"><span class="pln">  </span><span class="tag">&lt;div</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"span10 columns"</span><span class="tag">&gt;</span></li><li class="L5"><span class="pln">    ...</span></li><li class="L6"><span class="pln">  </span><span class="tag">&lt;/div&gt;</span></li><li class="L7"><span class="tag">&lt;/div&gt;</span></li></ol></pre>
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
				<section id="typography" class="normal">
					<div class="page-header">
						<h1>Typography <small>Headings, paragraphs, lists, and other inline type elements</small></h1>
					</div>
					<!-- Headings & Paragraph Copy -->
					<div class="row">
						<div class="span4 columns">
							<h2>Headings &amp; copy</h2>
							<p>
								A standard typographic hierarchy for structuring your webpages.
							</p>
							<p>
								The entire typographic grid is based on two Less variables in our preboot.less file: <code>
									@basefont</code>
								and <code>
									@baseline</code>
								. The first is the base font-size used throughout and the second is the base line-height.
							</p>
							<p>
								We use those variables, and some math, to create the margins, paddings, and line-heights of all our type and more.
							</p>
						</div>
						<div class="span4 columns">
							<h1>h1. Heading 1</h1>
							<h2>h2. Heading 2</h2>
							<h3>h3. Heading 3</h3>
							<h4>h4. Heading 4</h4>
							<h5>h5. Heading 5</h5>
							<h6>h6. Heading 6</h6>
						</div>
						<div class="span8 columns">
							<h3>Example paragraph</h3>
							<p>
								Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
							<h1>Example heading <small>Has sub-heading…</small></h1>
						</div>
					</div>
					<!-- Misc Elements -->
					<div class="row">
						<div class="span4 columns">
							<h2>Misc. elements</h2>
							<p>
								Using emphasis, addresses, &amp; abbreviations
							</p>
							<p>
								<code>
									&lt;strong&gt;</code>
								<code>
									&lt;em&gt;</code>
								<code>
									&lt;address&gt;</code>
								<code>
									&lt;abbr&gt;</code>
							</p>
						</div>
						<div class="span12 columns">
							<h4>When to use</h4>
							<p>
								Emphasis tags (<code>
									&lt;strong&gt;</code>
								and <code>
									&lt;em&gt;</code>
								) should be used to indicate additional importance or emphasis of a word or phrase relative to its surrounding copy. Use <code>
									&lt;strong&gt;</code>
								for importance and <code>
									&lt;em&gt;</code>
								for <em>stress</em> emphasis.
							</p>
							<h3>Emphasis in a paragraph</h3>
							<p>
								<a href="#">Fusce dapibus</a>, <strong>tellus ac cursus commodo</strong>, <em>tortor mauris condimentum nibh</em>, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue.
							</p>
							<p>
								<strong>Note:</strong> It's still okay to use <code>
									&lt;b&gt;</code>
								and <code>
									&lt;i&gt;</code>
								tags in HTML5 and they don't have to be styled bold and italic, respectively (although if there is a more semantic element, use it). <code>
									&lt;b&gt;</code>
								is meant to highlight words or phrases without conveying additional importance, while <code>
									&lt;i&gt;</code>
								is mostly for voice, technical terms, etc.
							</p>
							<h3>Addresses</h3>
							<p>
								The <code>
									&lt;address&gt;</code>
								element is used for contact information for its nearest ancestor, or the entire body of work. Here’s how it looks:
							</p>
							<address>
								<strong>Twitter, Inc.</strong>
								<br>
								795 Folsom Ave, Suite 600
								<br>
								San Francisco, CA 94107
								<br>
								<abbr title="Phone">P:</abbr> (123) 456-7890
							</address>
							<p>
								<strong>Note:</strong> Each line in an <code>
									&lt;address&gt;</code>
								must end with a line-break (<code>
									&lt;br /&gt;</code>
								) or be wrapped in a block-level tag (e.g., <code>
									&lt;p&gt;</code>
								) to properly structure the content.
							</p>
							<h3>Abbreviations</h3>
							<p>
								For abbreviations and acronyms, use the <code>
									&lt;abbr&gt;</code>
								tag (<code>
									&lt;acronym&gt;</code>
								is deprecated in <abbr title="HyperText Markup Langugage 5">HTML5</abbr>). Put the shorthand form within the tag and set a title for the complete name.
							</p>
						</div>
					</div><!-- /row -->
					<!-- Blockquotes -->
					<div class="row">
						<div class="span4 columns">
							<h2>Blockquotes</h2>
							<p>
								<code>
									&lt;blockquote&gt;</code>
								<code>
									&lt;p&gt;</code>
								<code>
									&lt;small&gt;</code>
							</p>
						</div>
						<div class="span12 columns">
							<h4>How to quote</h4>
							<p>
								To include a blockquote, wrap <code>
									&lt;blockquote&gt;</code>
								around <code>
									&lt;p&gt;</code>
								and <code>
									&lt;small&gt;</code>
								tags. Use the <code>
									&lt;small&gt;</code>
								element to cite your source and you'll get an em dash <code>
									&amp;mdash;</code>
								before it.
							</p>
							<blockquote>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.
								</p>
								<small>Dr. Julius Hibbert</small>
							</blockquote>
						</div>
					</div><!-- /row -->
					<h2>Lists</h2>
					<div class="row">
						<div class="span4 columns">
							<h4>Unordered <code>
								&lt;ul&gt;</code></h4>
							<ul>
								<li>
									Lorem ipsum dolor sit amet
								</li>
								<li>
									Consectetur adipiscing elit
								</li>
								<li>
									Integer molestie lorem at massa
								</li>
								<li>
									Facilisis in pretium nisl aliquet
								</li>
								<li>
									Nulla volutpat aliquam velit
									<ul>
										<li>
											Phasellus iaculis neque
										</li>
										<li>
											Purus sodales ultricies
										</li>
										<li>
											Vestibulum laoreet porttitor sem
										</li>
										<li>
											Ac tristique libero volutpat at
										</li>
									</ul>
								</li>
								<li>
									Faucibus porta lacus fringilla vel
								</li>
								<li>
									Aenean sit amet erat nunc
								</li>
								<li>
									Eget porttitor lorem
								</li>
							</ul>
						</div>
						<div class="span4 columns">
							<h4>Unstyled <code>
								&lt;ul.unstyled&gt;</code></h4>
							<ul class="unstyled">
								<li>
									Lorem ipsum dolor sit amet
								</li>
								<li>
									Consectetur adipiscing elit
								</li>
								<li>
									Integer molestie lorem at massa
								</li>
								<li>
									Facilisis in pretium nisl aliquet
								</li>
								<li>
									Nulla volutpat aliquam velit
									<ul>
										<li>
											Phasellus iaculis neque
										</li>
										<li>
											Purus sodales ultricies
										</li>
										<li>
											Vestibulum laoreet porttitor sem
										</li>
										<li>
											Ac tristique libero volutpat at
										</li>
									</ul>
								</li>
								<li>
									Faucibus porta lacus fringilla vel
								</li>
								<li>
									Aenean sit amet erat nunc
								</li>
								<li>
									Eget porttitor lorem
								</li>
							</ul>
						</div>
						<div class="span4 columns">
							<h4>Ordered <code>
								&lt;ol&gt;</code></h4>
							<ol>
								<li>
									Lorem ipsum dolor sit amet
								</li>
								<li>
									Consectetur adipiscing elit
								</li>
								<li>
									Integer molestie lorem at massa
								</li>
								<li>
									Facilisis in pretium nisl aliquet
								</li>
								<li>
									Nulla volutpat aliquam velit
								</li>
								<li>
									Faucibus porta lacus fringilla vel
								</li>
								<li>
									Aenean sit amet erat nunc
								</li>
								<li>
									Eget porttitor lorem
								</li>
							</ol>
						</div>
						<div class="span4 columns">
							<h4>Description <code>
								dl</code></h4>
							<dl>
								<dt>
									Description lists
								</dt>
								<dd>
									A description list is perfect for defining terms.
								</dd>
								<dt>
									Euismod
								</dt>
								<dd>
									Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
								</dd>
								<dd>
									Donec id elit non mi porta gravida at eget metus.
								</dd>
								<dt>
									Malesuada porta
								</dt>
								<dd>
									Etiam porta sem malesuada magna mollis euismod.
								</dd>
							</dl>
						</div>
					</div><!-- /row -->
				</section>
			</div>
			<div class="one-full">
				<section id="tables" class="normal">
					<div class="page-header">
						<h1>Tables <small>For, you guessed it, tabular data</small></h1>
					</div>
					<!-- Table structure -->
					<div class="row">
						<div class="span4 columns">
							<h2>Building tables</h2>
							<p>
								<code>
									&lt;table&gt;</code>
								<code>
									&lt;thead&gt;</code>
								<code>
									&lt;tbody&gt;</code>
								<code>
									&lt;tr&gt;</code>
								<code>
									&lt;th&gt;</code>
								<code>
									&lt;td&gt;</code>
								<code>
									&lt;colspan&gt;</code>
								<code>
									&lt;caption&gt;</code>
							</p>
							<p>
								Tables are great&mdash;for a lot of things. Great tables, however, need a bit of markup love to be useful, scalable, and readable (at the code level). Here are a few tips to help.
							</p>
							<p>
								Always wrap your column headers in a <code>
									&lt;thead&gt;</code>
								such that hierarchy is <code>
									&lt;thead&gt;</code>
								&gt; <code>
									&lt;tr&gt;</code>
								&gt; <code>
									&lt;th&gt;</code>
								.
							</p>
							<p>
								Similar to the column headers, all your table’s body content should be wrapped in a <code>
									&lt;tbody&gt;</code>
								so your hierarchy is <code>
									&lt;tbody&gt;</code>
								&gt; <code>
									&lt;tr&gt;</code>
								&gt; <code>
									&lt;td&gt;</code>
								.
							</p>
						</div>
						<div class="span12 columns">
							<h3>Example: Default table styles</h3>
							<p>
								All tables will be automatically styled with only the essential borders to ensure readability and maintain structure. No need to add extra classes or attributes.
							</p>
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
							<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;table&gt;</span></li><li class="L1"><span class="pln">  ...</span></li><li class="L2"><span class="tag">&lt;/table&gt;</span></li></ol></pre>
							<h3>Example: Zebra-striped</h3>
							<p>
								Get a little fancy with your tables by adding zebra-striping&mdash;just add the <code>
									.zebra-striped</code>
								class.
							</p>
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
							<p>
								<strong>Note:</strong> Zebra-striping is a progressive enhancement not available for older browsers like IE8 and below.
							</p>
							<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;table</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"zebra-striped"</span><span class="tag">&gt;</span></li><li class="L1"><span class="pln">...</span></li><li class="L2"><span class="tag">&lt;/table&gt;</span></li></ol></pre>
							<h3>Example: Zebra-striped w/ TableSorter.js</h3>
							<p>
								Taking the previous example, we improve the usefulness of our tables by providing sorting functionality via <a href="http://jquery.com">jQuery</a> and the <a href="http://tablesorter.com/docs/">Tablesorter</a> plugin. <strong>Click any column’s header to change the sort.</strong>
							</p>
							<table id="sortTableExample" class="zebra-striped">
								<thead>
									<tr>
										<th class="header">#</th>
										<th class="yellow header headerSortDown">First Name</th>
										<th class="blue header">Last Name</th>
										<th class="green header">Language</th>
									</tr>
								</thead>
								<tbody>
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
									<tr>
										<td>1</td>
										<td>Your</td>
										<td>One</td>
										<td>English</td>
									</tr>
								</tbody>
							</table>
							<pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="tag">&lt;script</span><span class="pln"> </span><span class="atn">src</span><span class="pun">=</span><span class="atv">"js/jquery/jquery.tablesorter.min.js"</span><span class="tag">&gt;&lt;/script&gt;</span></li><li class="L1"><span class="tag">&lt;script</span><span class="pln"> </span><span class="tag">&gt;</span></li><li class="L2"><span class="pln">  $</span><span class="pun">(</span><span class="kwd">function</span><span class="pun">()</span><span class="pln"> </span><span class="pun">{</span></li><li class="L3"><span class="pln">    $</span><span class="pun">(</span><span class="str">"table#sortTableExample"</span><span class="pun">).</span><span class="pln">tablesorter</span><span class="pun">({</span><span class="pln"> sortList</span><span class="pun">:</span><span class="pln"> </span><span class="pun">[[</span><span class="lit">1</span><span class="pun">,</span><span class="lit">0</span><span class="pun">]]</span><span class="pln"> </span><span class="pun">});</span></li><li class="L4"><span class="pln">  </span><span class="pun">});</span></li><li class="L5"><span class="tag">&lt;/script&gt;</span></li><li class="L6"><span class="tag">&lt;table</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"zebra-striped"</span><span class="tag">&gt;</span></li><li class="L7"><span class="pln">  ...</span></li><li class="L8"><span class="tag">&lt;/table&gt;</span></li></ol></pre>
						</div>
					</div><!-- /row -->
				</section>
			</div>
			<div class="one-full">
				<section id="forms" class="normal">
					<div class="page-header">
						<h1>Forms</h1>
					</div>
					<div class="row">
						<div class="span4 columns">
							<h2>Default styles</h2>
							<p>
								All forms are given default styles to present them in a readable and scalable way. Styles are provided for text inputs, select lists, textareas, radio buttons and checkboxes, and buttons.
							</p>
						</div>
						<div class="span12 columns">
							<form>
								<fieldset>
									<legend>
										Example form legend
									</legend>
									<div class="clearfix">
										<label for="xlInput">X-Large Input</label>
										<div class="input">
											<input type="text" size="30" name="xlInput" id="xlInput" class="xlarge">
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="normalSelect">Select</label>
										<div class="input">
											<select id="normalSelect" name="normalSelect">
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
											<select id="mediumSelect" name="mediumSelect" class="medium">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
											</select>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label>Uneditable Input</label>
										<div class="input">
											<span class="uneditable-input">Some Value Here</span>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="disabledInput">Disabled Input</label>
										<div class="input">
											<input type="text" disabled="" placeholder="Disabled input here… carry on." size="30" name="disabledInput" id="disabledInput" class="xlarge disabled">
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix error">
										<label for="xlInput">X-Large Input</label>
										<div class="input">
											<input type="text" size="30" name="xlInput" id="xlInput" class="xlarge error">
											<span class="help-inline">Small snippet of help text</span>
										</div>
									</div><!-- /clearfix -->
								</fieldset>
								<fieldset>
									<legend>
										Example form legend
									</legend>
									<div class="clearfix">
										<label for="prependedInput">Prepended Text</label>
										<div class="input">
											<div class="input-prepend">
												<span class="add-on">@</span>
												<input type="text" size="16" name="prependedInput" id="prependedInput" class="medium">
											</div>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="prependedInput2">Prepended Checkbox</label>
										<div class="input">
											<div class="input-prepend">
												<label class="add-on">
													<input type="checkbox" value="" id="" name="">
												</label>
												<input type="text" size="16" name="prependedInput2" id="prependedInput2" class="mini">
											</div>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="appendedInput">Appended Checkbox</label>
										<div class="input">
											<div class="input-append">
												<input type="text" size="16" name="appendedInput" id="appendedInput" class="mini">
												<label class="add-on active">
													<input type="checkbox" checked="checked" value="" id="" name="">
												</label>
											</div>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="xlInput">File Input</label>
										<div class="input">
											<input type="file" name="fileInput" id="fileInput" class="input-file">
										</div>
									</div><!-- /clearfix -->
								</fieldset>
								<fieldset>
									<legend>
										Example form legend
									</legend>
									<div class="clearfix">
										<label id="optionsCheckboxes">List of Options</label>
										<div class="input">
											<ul class="inputs-list">
												<li>
													<label>
														<input type="checkbox" value="option1" name="optionsCheckboxes">
														<span>Option one is this and that&mdash;be sure to include why it’s great</span> </label>
												</li>
												<li>
													<label>
														<input type="checkbox" value="option2" name="optionsCheckboxes">
														<span>Option two can also be checked and included in form results</span> </label>
												</li>
												<li>
													<label>
														<input type="checkbox" value="option2" name="optionsCheckboxes">
														<span>Option three can&mdash;yes, you guessed it&mdash;also be checked and included in form results</span> </label>
												</li>
												<li>
													<label class="disabled">
														<input type="checkbox" disabled="" value="option2" name="optionsCheckboxes">
														<span>Option four cannot be checked as it is disabled.</span> </label>
												</li>
											</ul>
											<span class="help-block"> <strong>Note:</strong> Labels surround all the options for much larger click areas and a more usable form. </span>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label>Date Range</label>
										<div class="input">
											<div class="inline-inputs">
												<input type="text" value="May 1, 2011" class="small">
												<input type="text" value="12:00am" class="mini">
												to
												<input type="text" value="May 8, 2011" class="small">
												<input type="text" value="11:59pm" class="mini">
												<span class="help-inline">All times are shown as Pacific Standard Time (GMT -08:00).</span>
											</div>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="textarea">Textarea</label>
										<div class="input">
											<textarea name="textarea" id="textarea" class="xxlarge"></textarea>
											<span class="help-block"> Block of help text to describe the field above if need be. </span>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label id="optionsRadio">List of Options</label>
										<div class="input">
											<ul class="inputs-list">
												<li>
													<label>
														<input type="checkbox" value="option1" name="optionsCheckboxes">
														<span>Option one is this and that&mdash;be sure to include why it’s great</span> </label>
												</li>
												<li>
													<label>
														<input type="checkbox" value="option2" name="optionsCheckboxes">
														<span>Option two can also be checked and included in form results</span> </label>
												</li>
											</ul>
										</div>
									</div><!-- /clearfix -->
									<div class="actions">
										<button class="btn primary" type="submit">
											Save Changes
										</button>
										&nbsp;
										<button class="btn" type="reset">
											Cancel
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div><!-- /row -->
					<br>
					<div class="row">
						<div class="span4 columns">
							<h2>Stacked forms</h2>
							<p>
								Add <code>
									.form-stacked</code>
								to your form’s HTML and you’ll have labels on top of their fields instead of to their left. This works great if your forms are short or you have two columns of inputs for heavier forms.
							</p>
						</div>
						<div class="span12 columns">
							<form class="form-stacked" action="">
								<fieldset>
									<legend>
										Example form legend
									</legend>
									<div class="clearfix">
										<label for="xlInput">X-Large Input</label>
										<div class="input">
											<input type="text" size="30" name="xlInput" id="xlInput" class="xlarge">
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label for="stackedSelect">Select</label>
										<div class="input">
											<select id="stackedSelect" name="stackedSelect">
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
									<legend>
										Example form legend
									</legend>
									<div class="clearfix error">
										<label for="xlInput">X-Large Input</label>
										<div class="input">
											<input type="text" size="30" name="xlInput" id="xlInput" class="xlarge error">
											<span class="help-inline">Small snippet of help text</span>
										</div>
									</div><!-- /clearfix -->
									<div class="clearfix">
										<label id="optionsCheckboxes">List of Options</label>
										<div class="input">
											<ul class="inputs-list">
												<li>
													<label>
														<input type="checkbox" value="option1" name="optionsCheckboxes">
														<span>Option one is this and that&mdash;be sure to include why it’s great</span> </label>
												</li>
												<li>
													<label>
														<input type="checkbox" value="option2" name="optionsCheckboxes">
														<span>Option two can also be checked and included in form results</span> </label>
												</li>
											</ul>
											<span class="help-block"> <strong>Note:</strong> Labels surround all the options for much larger click areas and a more usable form. </span>
										</div>
									</div><!-- /clearfix -->
								</fieldset>
								<div class="actions">
									<button class="btn primary" type="submit">
										Save Changes
									</button>
									&nbsp;
									<button class="btn" type="reset">
										Cancel
									</button>
								</div>
							</form>
						</div>
					</div><!-- /row -->
					<div class="row">
						<div class="span4 columns">
							<h2>Buttons</h2>
							<p>
								As a convention, buttons are used for actions while links are used for objects. For instance, "Download" could be a button and "recent activity" could be a link.
							</p>
							<p>
								All buttons default to a light gray style, but a number of functional classes can be applied for different color styles. These classes include a blue <code>
									.primary</code>
								class, a light-blue <code>
									.info</code>
								class, a green <code>
									.success</code>
								class, and a red <code>
									.danger</code>
								class. Plus, rolling your own styles is easy peasy.
							</p>
						</div>
						<div class="span12 columns">
							<h3>Example buttons</h3>
							<p>
								Button styles can be applied to anything with the <code>
									.btn</code>
								applied. Typically you’ll want to apply these to only <code>
									&lt;a&gt;</code>
								, <code>
									&lt;button&gt;</code>
								, and select <code>
									&lt;input&gt;</code>
								elements. Here’s how it looks:
							</p>
							<div style="padding: 14px 19px;" class="well">
								<button class="btn primary">
									Primary
								</button>
								<button class="btn">
									Default
								</button>
								<button class="btn info">
									Info
								</button>
								<button class="btn success">
									Success
								</button>
								<button class="btn danger">
									Danger
								</button>
							</div>
							<h3>Alternate sizes</h3>
							<p>
								Fancy larger or smaller buttons? Have at it!
							</p>
							<div class="well">
								<a class="btn large primary" href="#">Primary action</a>
								<a class="btn large" href="#">Action</a>
							</div>
							<div style="padding: 16px 19px;" class="well">
								<a class="btn small primary" href="#">Primary action</a>
								<a class="btn small" href="#">Action</a>
							</div>
							<h3>Disabled state</h3>
							<p>
								For buttons that are not active or are disabled by the app for one reason or another, use the disabled state. That’s <code>
									.disabled</code>
								for links and <code>
									:disabled</code>
								for <code>
									&lt;button&gt;</code>
								elements.
							</p>
							<h4>Links</h4>
							<div class="well">
								<a class="btn large primary disabled" href="#">Primary action</a>
								<a class="btn large disabled" href="#">Action</a>
							</div>
							<h4>Buttons</h4>
							<div class="well">
								<button disabled="" class="btn large primary disabled">
									Primary action
								</button>
								&nbsp;
								<button disabled="" class="btn large">
									Action
								</button>
							</div>
						</div>
					</div><!-- /row -->
				</section>
			</div>
			<div class="one-full">
				<section id="alerts" class="normal">
					<div class="page-header">
						<h1>Alerts &amp; Errors <small>Styles for success, warning, and error messages or alerts</small></h1>
					</div>
					<!-- Basic alert messages -->
					<div class="row">
						<div class="span4 columns">
							<h2>Basic alerts</h2>
							<p>
								<code>
									div.alert-message</code>
							</p>
							<p>
								One-line messages for highlighting the failure, possible failure, or success of an action. Particularly useful for forms.
							</p>
						</div>
						<div class="span12 columns">
							<div class="alert-message warning">
								<a href="#" class="close">×</a>
								<p>
									<strong>Holy gaucamole!</strong> Best check yo self, you’re not looking too good.
								</p>
							</div>
							<div class="alert-message error">
								<a href="#" class="close">×</a>
								<p>
									<strong>Oh snap!</strong> Change this and that and try again.
								</p>
							</div>
							<div class="alert-message success">
								<a href="#" class="close">×</a>
								<p>
									<strong>Well done!</strong> You successfully read this alert message.
								</p>
							</div>
							<div class="alert-message info">
								<a href="#" class="close">×</a>
								<p>
									<strong>Heads up!</strong> This is an alert that needs your attention, but it’s not a huge priority just yet.
								</p>
							</div>
						</div>
					</div><!-- /row -->
					<!-- Block messages -->
					<div class="row">
						<div class="span4 columns">
							<h2>Block messages</h2>
							<p>
								<code>
									div.alert-message.block-message</code>
							</p>
							<p>
								For messages that require a bit of explanation, we have paragraph style alerts. These are perfect for bubbling up longer error messages, warning a user of a pending action, or just presenting information for more emphasis on the page.
							</p>
						</div>
						<div class="span12 columns">
							<div class="alert-message block-message warning">
								<a href="#" class="close">×</a>
								<p>
									<strong>Holy gaucamole! This is a warning!</strong> Best check yo self, you’re not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
								</p>
								<div class="alert-actions">
									<a href="#" class="btn small">Take this action</a><a href="#" class="btn small">Or do this</a>
								</div>
							</div>
							<div class="alert-message block-message error">
								<a href="#" class="close">×</a>
								<p>
									<strong>Oh snap! You got an error!</strong> Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
								</p>
								<div class="alert-actions">
									<a href="#" class="btn small">Take this action</a><a href="#" class="btn small">Or do this</a>
								</div>
							</div>
							<div class="alert-message block-message success">
								<a href="#" class="close">×</a>
								<p>
									<strong>Well done!</strong> You successfully read this alert message. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas faucibus mollis interdum.
								</p>
								<div class="alert-actions">
									<a href="#" class="btn small">Take this action</a><a href="#" class="btn small">Or do this</a>
								</div>
							</div>
							<div class="alert-message block-message info">
								<a href="#" class="close">×</a>
								<p>
									<strong>Heads up!</strong> This is an alert that needs your attention, but it’s not a huge priority just yet.
								</p>
								<div class="alert-actions">
									<a href="#" class="btn small">Take this action</a><a href="#" class="btn small">Or do this</a>
								</div>
							</div>
							<div class="flash error">
								<a class="close" href="#"><img src="<?=ADMIN_URL;?>images/close.png" /></a> This is a &lt;div&gt; with the class <strong>.error</strong>. <a href="#">Link</a>.
							</div>
							<div class="flash notice">
								<a class="close" href="#"><img src="<?=ADMIN_URL;?>images/close.png" /></a> This is a &lt;div&gt; with the class <strong>.notice</strong>. <a href="#">Link</a>.
							</div>
							<div class="flash info">
								<a class="close" href="#"><img src="<?=ADMIN_URL;?>images/close.png" /></a> This is a &lt;div&gt; with the class <strong>.info</strong>. <a href="#">Link</a>.
							</div>
							<div class="flash success">
								<a class="close" href="#"><img src="<?=ADMIN_URL;?>images/close.png" /></a> This is a &lt;div&gt; with the class <strong>.success</strong>. <a href="#">Link</a>.
							</div>
						</div>
					</div><!-- /row -->
				</section>
			</div>
	</div><!-- #wrap -->
</div>
<!-- #wrapper-admin -->
</div> <!-- #body-wrappe -->
<? load::view('admin/template-login-footer');?>
w