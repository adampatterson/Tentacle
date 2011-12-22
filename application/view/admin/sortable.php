<? load::view('admin/template-header', array('title' => 'Threaded Content', 'assets' => 'application'));?>
<style type="text/css">
	.ui-nestedSortable-error {
				background:#fbe3e4;
				color:#8a1f11;
			}

			ol {
				margin: 0;
				padding: 0;
				padding-left: 30px;
			}

			ol.sortable, ol.sortable ol {
				margin: 0 0 0 25px;
				padding: 0;
				list-style-type: none;
			}

			ol.sortable {
				margin: 4em 0;
			}

			.sortable li {
				margin: 7px 0 0 0;
				padding: 0;
			}

			.sortable li div  {
				border: 1px solid black;
				padding: 3px;
				margin: 0;
				cursor: move;
			}
</style>
<div id="wrap">
	<div class="full-content">
		<div id="post-body">
			<div class="one-full">
				<div class="title pad-right">
					<h1><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Threaded</h1>
					<?
					// http://www.jongales.com/blog/2009/01/27/php-class-for-threaded-comments/

					class Threaded_comments
					{

					    public $parents  = array();
					    public $children = array();

					    /**
					     * @param array $pages
					     */
					    function __construct($pages)
					    {
					        foreach ($pages as $comment)
					        {
					            if ($comment['parent'] === 0)
					            {
					                $this->parents[$comment['id']][] = $comment;
					            }
					            else
					            {
					                $this->children[$comment['parent']][] = $comment;
					            }
					        }
					    }

					    /**
					     * @param array $comment
					     * @param int $depth
					     */
					    private function format_comment($comment, $depth)
					    {
					        for ($depth; $depth > 0; $depth--)
					        {
					            echo "- - ";
					        } 

					        echo $comment['text'];
					        echo "<br />";
					    }

					    /**
					     * @param array $comment
					     * @param int $depth
					     */
					    private function print_parent($comment, $depth = 0)
					    {
					        foreach ($comment as $c)
					        {
					            $this->format_comment($c, $depth);

					            if (isset($this->children[$c['id']]))
					            {
					                $this->print_parent($this->children[$c['id']], $depth + 1);
					            }
					        }
					    }

					    public function print_comments()
					    {
					        foreach ($this->parents as $c)
					        {
					            $this->print_parent($c);
					        }
					    }

					}


					$pages = array(  array('id'=>1, 'parent'=>0,   'text'=>'#1 Parent'),
					                    array('id'=>2, 'parent'=>1,   'text'=>'#2 Child'),
					                    array('id'=>3, 'parent'=>2,   'text'=>'#3 Child Third level'),
					                    array('id'=>4, 'parent'=>0,   'text'=>'#4 Second Parent'),
					                    array('id'=>5, 'parent'=>4,   'text'=>'#5 Second Child'),
										array('id'=>6, 'parent'=>3,   'text'=>'#6 Child Fourth level'),
										array('id'=>7, 'parent'=>6,   'text'=>'#7 Child Fith level'),
					                );


					$threaded_comments = new Threaded_comments($pages[0]);

					$threaded_comments->print_comments();
					

					?>
					<hr />
					<? foreach ($pages as $page):
						$user_meta = $user->get_meta ( $page->author ); ?>
						<? if ($page->parent != '0'): ?> <div class="sub-page"> <? endif; ?>
						<strong class="title"><a href="<?= ADMIN ?>content_update_page/<?= $page->id;?>"><?= $page->title ?></a></strong>
						<? if ($page->parent != '0'): ?> </div> <? endif; ?>
					<? endforeach; ?>
					
					<!-- <script type="text/javascript" src="<?=TENTACLE_JS; ?>nestedSortable-1.3.4/jquery.ui.nestedSortable.js"></script>
					<script type="text/javascript">
						(document).ready(function(){

								('ol.sortable').nestedSortable({
									disableNesting: 'no-nest',
									forcePlaceholderSize: true,
									handle: 'div',
									helper:	'clone',
									items: 'li',
									maxLevels: 3,
									opacity: .6,
									placeholder: 'placeholder',
									revert: 250,
									tabSize: 25,
									tolerance: 'pointer',
									toleranceElement: '> div'
								});

								('#serialize').click(function(){
									serialized = ('ol.sortable').nestedSortable('serialize');
									('#serializeOutput').text(serialized+'\n\n');
								})
								
								// retrieve the ids of root pages so we can POST them along
								data_callback = function(even, ui) {
									// In the pages module we get a list of root pages
									root_pages = [];
									// grab an array of root page ids
									('ul.sortable').children('li').each(function(){
										root_pages.push((this).attr('id').replace('page_', ''));
									});
									return { 'root_pages' : root_pages };
								}
								
							});
					</script>
					<ol class="sortable">
						<li id="list_1"><div>Item 1</div>
						<li id="list_2"><div>Item 2</div>
							<ol>
								<li id="list_3"><div>Sub Item 2.1</div>
								<li id="list_4"><div>Sub Item 2.2</div>
								<li id="list_5"><div>Sub Item 2.3</div>
								<li id="list_6"><div>Sub Item 2.4</div>
							</ol>
						<li id="list_7" class="no-nest"><div>Item 3 (no-nesting)</div>
						<li id="list_8" class="no-nest"><div>Item 4 (no-nesting)</div>
						<li id="list_9"><div>Item 5</div>
						<li id="list_10"><div>Item 6</div>
							<ol>
								<li id="list_11"><div>Sub Item 6.1</div>
								<li id="list_12" class="no-nest"><div>Sub Item 6.2 (no-nesting)</div>
								<li id="list_13"><div>Sub Item 6.3</div>
								<li id="list_14"><div>Sub Item 6.4</div>
							</ol>
						<li id="list_15"><div>Item 7</div>
						<li id="list_16"><div>Item 8</div>
					</ol> -->
				</div>
			</div><!-- .one-full -->
		</div><!-- .post-body -->
	</div><!-- .full-content -->
</div><!-- #wrap -->
<? load::view('admin/template-footer');?>