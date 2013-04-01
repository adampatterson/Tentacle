<?
 /*
Name: Home Page
URI: http://tcms.me/
Description: This is the Tentacle default theme.
Author: Tentacle
Version: 1.0
License: GNU General Public License
License URI: license.txt
*/

theme::part( 'partials/header',array( 'title'=>'Thanks for downloading Tentacle CMS', 'assets'=>'marketing', 'download'=>true) ); ?>

<div class="container">
    <div class="bump">&nbsp;</div>

        <div class="row">

            <div class="span6">
                <h1>Thanks!</h1>
                <div class="alert alert-error">
                  <strong>Notice!</strong> We are in early beta, because of this updates are constant and errors might be a common occurrence.
                </div>

                <p class="lead">Click <a href="http://api.tentaclecms.com/get/download"  onClick="mixpanel.track('Content', { 'link': 'Download', 'version': 'v 0.9.5.1 Beta' });">here</a> if your download does not automatically start.</p>
                <p class="lead">Tentacle CMS is a new, and with that we rely of your feedback. If you have any issues at all please contact ups, or Submit an issue buy following <a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug">these steps</a>.</p>

                <div class="row">

                    <div class="span3">
                        <h2>Requirements</h2>
                        <ul>
                            <li>PHP 5.3 or greater</li>
                            <li>MySQL with PDO compatible</li>
                            <li>cURL</li>
                            <li>Apache Mod URL</li>
                        </ul>
                    </div>

                    <div class="span3">
                        <h2>Installation</h2>
                        <ul>
                            <li>Download</li>
                            <li>Extract the Tentacle archive and upload the contents to your web server.</li>
                            <li>Navigate to your application in a web browser.</li>
                            <li>Follow the setup!</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="span5 offset1">
                <h1>Keep in touch</h1>
                <p class="lead">Get the lowdown on announcements and cool new features.</p>

                <form method="post" id="newsletter" action="http://www.industrymailout.com/Industry/SubscribeRedirect.aspx" >

                    <input type="hidden" name="mailinglistid" value="27205" />
                    <input type="hidden" name="success" value="http://tentaclecms.com" />
                    <input type="hidden" name="errorparm" value="error" />

                    <div class="control-group">
                        <label for="firstname">First Name</label>
                        <div class="controls">
                            <input type="text" name="givenname" maxlength="50" class="span3 input-xlarge input-small" id="firstname" >
                        </div>

                        <label for="lastname">Last Name</label>
                        <div class="controls">
                            <input type="text" name="familyname" maxlength="50" class="span3 input-xlarge" id="lastname" >
                        </div>

                        <label for="email">Email</label>
                        <div class="controls">
                            <input type="text" name="email" required="required" value="" class="email span3 input-xlarge" id="email">
                        </div>
                    </div>

                    <?php if($note = note::get('session')): ?>
                        <input type='hidden' name='history' value="<?= $note['content'];?> " />
                    <?php endif;?>

                    <input type="submit" value="Join" class="btn btn-primary" onClick="_gaq.push(['_trackEvent', 'Download Page', 'Button', 'Mailing List']);" />

                </form>
            </div>
        </div>

    </div>
</div>

<? theme::part( 'partials/footer', array('track' => 'Download') ); ?>