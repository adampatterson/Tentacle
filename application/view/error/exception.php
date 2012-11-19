<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <title><?php echo $error['prefix']; ?></title>
   <style type="text/css" media="screen">
		body {
		   background: #e7e7de;
		   font-family: arial, tahoma, trebuchet ms, sans-serif;
		   margin: 0px;
		   padding: 0px;
		   text-align: center;
		   font-size: small;
		   }
		#Frame {
		   width: 980px;
		   text-align: left;
		   margin-left: auto;
		   margin-right: auto;
		   }
		#Content {
		   background: #fff;
		   padding: 0px 20px 20px 20px;
		   border-top-left-radius: 10px;
		   border-top-right-radius: 10px;
		   -moz-border-radius-topleft: 10px;
		   -moz-border-radius-topright: 10px;
		   -webkit-border-top-left-radius: 10px;
		   -webkit-border-top-right-radius: 10px;
		   }
		code {
		   display: block;
		   padding: 4px 0px 0px 4px;
		   color: #ff0084;
		   overflow: auto;
		   white-space: pre;
		   }
		.PreContainer {
		   overflow: auto;
		   }
		pre {
		   margin: 0px;
		   padding: 2px;
		   background: #ffffd3;
		   }
		pre.Odd {
		   background: #ffffb9;
		   }
		pre.Highlight {
		   color: #ff0000;
		   background: #ffff7f;
		   }
		a,
		a:link,
		a:active {
		   color: #0063dc;
		   text-decoration: none;
		   }
		a:visited {
		   color: #ff0084;
		   }
		a:hover {
		   color: #ffffff !important;
		   background: #0063dc !important;
		   }
		p {
		   padding: 4px 0px;
		   margin: 0px;
		   }
		h2 {
		   margin: 0px;
		   padding: 20px 0px 0px 0px;
		   }
		#MoreInformation {
		   background: #f3f3f3;
		   padding: 0px 20px 20px 20px;
		   border-bottom-left-radius: 10px;
		   border-bottom-right-radius: 10px;
		   -moz-border-radius-bottomleft: 10px;
		   -moz-border-radius-bottomright: 10px;
		   -webkit-border-bottom-left-radius: 10px;
		   -webkit-border-bottom-right-radius: 10px;
		   margin-bottom: 20px;
		   }
		h3 {
		   margin: 0px;
		   padding: 20px 0px 8px 0px;
		   font-weight: normal;
		   font-size: small;
		   }
		h4 {
		   margin: 0px;
		   padding: 0px;
		   font-weight: normal;
		   }
		ul {
		   margin: 0px;
		   padding: 10px 20px 0px 20px;
		   }
		ul li {
		   line-height: 160%;
		   }
</style>
</head>
<body>
   <div id="Frame">
      <h1><?php echo $error['prefix']; ?> in <?php echo route::controller(),'.',route::method() ?>();</h1>
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

			    echo "</div>\n";
			 }

		require_once( APP_ROOT.'/application/helper/exception.php' );
	?>
</div>
</body>
</html>