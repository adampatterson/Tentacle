<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <title><?php echo $error['prefix']; ?> Error</title>
   <link type="text/css" rel="stylesheet" href="<?=ADMIN_CSS; ?>error.css"/>
</head>
<body>
   <div id="Frame">
      <h1><?php echo $error['prefix']; ?> Error in <?php echo route::controller(),'.',route::method() ?>();</h1>
      <div id="Content">
         <h2><?php echo $error['prefix']; ?>: <strong><?php echo $error['message']; ?></strong> In <?php echo $error['file']; ?> At Line <?php echo $error['line']; ?></h2>
			<?

			if ($error['code'] != '')
			    echo '<code>',htmlentities($error['code'], ENT_COMPAT, 'UTF-8'),"</code>\n";

			if (is_array($error['line']) && $Line > -1) {
			   echo '<h3>The error occurred on or near: <strong>',$error['file'],'</strong></h3>
			   <div class="PreContainer">';
			      $LineCount = count($ErrorLines);
			      $Padding = strlen($Line+5);
			      $Odd = FALSE;
			      $Class = '';
			      for ($i = 0; $i < $LineCount; ++$i) {
			         if ($i > $Line-6 && $i < $Line+4) {
			            $Class = $Odd === TRUE ? 'Odd' : '';
			            if ($i == $Line - 1) {
			               if ($Class != '')
			                  $Class .= ' ';

			               $Class .= 'Highlight';
			            }
			            echo '<pre',($Class == '' ? '' : ' class="'.$Class.'"'),'>',str_pad($i+1, $Padding, " ", STR_PAD_LEFT),': ',htmlentities(str_replace("\n", '', $ErrorLines[$i]), ENT_COMPAT, 'UTF-8'),"</pre>\n";
			            $Odd = $Odd == TRUE ? FALSE : TRUE;
			         }
			      }
			   echo "</div>\n";
			}

			if (is_array($error['backtrace'])) {

				$backtrace = $error['backtrace'];

			    echo '<h3><strong>Backtrace:</strong></h3>
			    <div class="PreContainer">';
			    $back_trace_count = count($backtrace);
			    $odd = FALSE;
			    for ($i = 0; $i < $back_trace_count; ++$i) {
			       echo '<pre'.($odd === FALSE ? '' : ' class="Odd"').'>';

			       if (array_key_exists('file', $backtrace[$i])) {
			          $file = '['.$backtrace[$i]['file'].':'
			          .$backtrace[$i]['line'].'] ';
			       }
			       echo $file , '<strong>'
			          ,array_key_exists('class', $backtrace[$i]) ? $backtrace[$i]['class'] : 'PHP'
			          ,array_key_exists('type', $backtrace[$i]) ? $backtrace[$i]['type'] : '::'
			          ,$backtrace[$i]['function'],'();</strong>'
			       ,"</pre>\n";
			       $odd = $odd == TRUE ? FALSE : TRUE;
			    }

			    echo "</div>\n"; ?>
                <br />
                <form id="paste" method="POST" action="http://p.tcms.me/action/add_text" accept-charset="UTF-8" target="_blank">
                    <textarea name="paste" rows="10" cols="100" id="paste"><?
                        for ($i = 0; $i < $back_trace_count; ++$i) {
                            if (array_key_exists('file', $backtrace[$i])) {
                                $file = '['.$backtrace[$i]['file'].':'
                                    .$backtrace[$i]['line'].'] ';
                            }
                            echo $file , ''
                            ,array_key_exists('class', $backtrace[$i]) ? $backtrace[$i]['class'] : 'PHP'
                            ,array_key_exists('type', $backtrace[$i]) ? $backtrace[$i]['type'] : '::'
                            ,$backtrace[$i]['function'],'();'
                            ,"\n";
                        }
                        echo "\n";
                        echo "\n";
                        if (array_key_exists('SERVER_SOFTWARE', $_SERVER))
                            echo 'Server Software: '.$_SERVER['SERVER_SOFTWARE'] ."\n";

                        if (array_key_exists('HTTP_REFERER', $_SERVER))
                            echo 'Referer:'.$_SERVER['HTTP_REFERER']."\n";

                        if (array_key_exists('HTTP_USER_AGENT', $_SERVER))
                            echo 'User Agent:'.$_SERVER['HTTP_USER_AGENT']."\n";
                        ?></textarea>
                    <p><input type="submit" name="Submit"/></p>
                </form>
            <?
            }

            require_once( APP_ROOT.'/application/helper/exception.php' );
            ?>
      </div>
</body>
</html>