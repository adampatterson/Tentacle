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

    public function general ( $user = '', $subject = '' )
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

    public function lost_password ( $user = '', $subject = '' )
    {

    }

    public function admin_locked_account ( $user = '', $subject = '' )
    {

    }

    public function locked_account ( $user_data = '', $subject = '' )
    {
        # From post
        $username = input::post( 'username' );

        $user_name    = $user_data->username;
        $email        = $user_data->email;

        $first_name   = $user_data->data['first_name'];
        $last_name    = $user_data->data['last_name'];

        $registered = time();
        $hashed_ip = sha1($_SERVER['REMOTE_ADDR'].$registered);

        user::update($username)
            ->data('activation_key',$hashed_ip)
            ->save();

        $hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
        $hash_address = BASE_URL.'admin/activate/'.$hashed_ip;

        $message = '<p>Hello '.$first_name.',</p>
                            <p>Recently multiple failed attempts were made while access your account at '.BASE_URL.'.</p>
                            <p>As a precaution your account has been disabled and a password reset has been issued for <strong>Username</strong>: '.$user_name.' </p>
						    <p><strong>Click the link to create a new password.</strong><br />'.BASE_URL.'admin/set_password/'.$hashed_ip.'</p>';

        $deliver = $this->send( $subject, $message, $email );
    }
}