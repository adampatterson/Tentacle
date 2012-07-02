<? if(!defined('DINGO')){die('External Access to File Denied');}

class email_model
{

	public function send ( $subject='', $message='', $to='', $from='' ) 
	{
		
		if ($from == '') {
			$from = get_option('admin_email');
		}

		load::helper('email');
		
		$html = email_header($subject);
		$html .= $message;						
		$html .= email_footer();

		//echo $html;
	
		$mail = new email();
		$mail->to( $to );
		$mail->from( $from );
		$mail->subject( $subject );
		$mail->content( $html );
		//$mail->send();
	}
}