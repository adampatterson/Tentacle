<?
class terms_model 
{
	public function relations () 
	{
		$page_category = serialize(input::post( 'post_category' ));
		
		$terms         = db('posts');

		$page->insert(array(
			'title'		=>$title,
			'slug'		=>$slug,
			'content'	=>$content
		),FALSE);
		
	}
}