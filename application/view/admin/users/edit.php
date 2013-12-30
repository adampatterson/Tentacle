<? load::view('admin/partials/header', array('title' => 'User Profile', 'assets' => array('application')));?>

<div id="wrap">
  <div class="row">

    <h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> Manage User</h1>

    <div class="col-md-6">

      <form id='edit' action="<?= BASE_URL ?>action/update_user" method="post" accept-charset="utf-8">
        <fieldset class="form-horizontal">

          <div class="form-group">
            <label for="user_name">Username <span class="description">(required)</span></label>
            <input id="username" class="form-control" type="text" required="true" value="<?= $user->username;?>" name="user_name">
          </div>

          <div class="form-group">
            <label for="email">E-Mail <span class="description">(required)</span></label>
            <input type="text" class="form-control" value="<?= $user->email;?>" id="email" name="email">
            <input type="hidden" value="<?= $user->email;?>" id="old_email" name="old_email">
          </div>

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user_meta->first_name;?>">
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user_meta->last_name;?>">
          </div>

          <div class="form-group">
            <label for="display_name">Display Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" value="<?= $user_meta->display_name;?>">
          </div>

          <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" value="<?= $user_meta->url ?>" class="code" id="url" name="url">
          </div>

          <div class="form-group">
            <label  for="password">Password <span class="description">(twice, required)</span></label>
            <input type="password" class="form-control" autocomplete="off" id="password" name="password" />
            <input type="password" class="form-control" autocomplete="off" id="confirm_password" name="confirm_password" />
            <p class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).</p>
          </div>

          <div class="form-group">
            <label>Send password?</label>
            <label for="send_password" class="checkbox"><input type="checkbox" id="send_password" name="send_password" class="checkbox" value="yes">Send this password to the new user by email.</label>
          </div>
          <? /*
          <div class="form-group">
          <label for="editor">Editor</label>

          <label title="wysiwyg" class="radio"><input type="radio" <? checked( $user_meta->editor, 'wysiwyg' ); ?> value="wysiwyg" name="editor" class="radio">WYSIWYG</label>
          <label title="html" class="radio"><input type="radio" <? checked( $user_meta->editor, 'html' ); ?>value="html" name="editor" class="radio">HTML</label>
          </div>
          </div>
          */ ?>
          <input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
          <input type="hidden" name='profile' value='true' />

        </fieldset>

        <div class="actions">
          <input type="submit" value="Save" class="btn btn-primary" id="save" />
          <a href="<?=ADMIN;?>users_manage/" class="red">Cancel</a>
        </div>

      </form>
    </div>

    <div class="col-md-6">
      <!--<p>System messages</p>-->
    </div>

  </div>
</div><!-- #wrap -->
<? load::view('admin/partials/footer', array( 'assets' => array( '' ) ) ); ?>