<?
class email_model
{
	public function send ( $subject, $message, $to, $from='' )
	{
		
		if ($from == '') {
			$from = get::option('admin_email');
		}

		load::helper('email');
		
		$html = email_header($subject);
		$html .= $message;						
		$html .= email_footer();
	
		$mail = new email();
		$mail->to( $to );
		$mail->from( $from );
		$mail->subject( $subject );
		$mail->content( $html );
		$mail->send();
	}

    public function general ( $email)
    {
        load::helper('email');

        $user_name    = 'user_name';
        $password     = 'password';
        $email        = 'hello@adampatterson.ca';

        $first_name   = 'Adam';
        $last_name    = 'Patterson';

        $hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
        $hash_address = BASE_URL.'admin/activate/'.$hashed_ip;


        $message = '<p>Hello '.$first_name.' '.$last_name.'<br /></p>
					<p><strong>Username</strong>: '.$user_name.'<br />
					<strong>Password</strong>: '.$password.'</p>
					<p><strong>Click the link to activate your account.</strong><br /><a href="'.$hash_address.'">'.$hash_address.'</a></p>
					<a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';

        echo $message;

        $user_email = $this->send( 'Tentacle CMS', $message, $email, $email );
    }

    public function lost_password ( $subject, $to )
    {

    }

    public function admin_locked_account ( $subject, $to )
    {

    }

    public function locked_account ( $subject, $to )
    {

    }
}