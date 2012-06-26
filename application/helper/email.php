<?

function email_header( $subject='' ) {
	$html = '	<html>
				<head>
				<title>';
				
				if ($subject != '') {
					$html .= $subject;
				} else {
					$html .= 'Tentacle CMS';
				}
				
	$html .= 	'</title>
				<style type="text/css">
				<!--
				body {
					-webkit-text-size-adjust:none;
					font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size:20px;
					line-height:18px;
					background: #DDD url(http://tentaclecms.com/tentacle/admin/images/bg_texturetastic_gray.png);
				}
				img {
					line-height:0;
				}
				.article h2 {
					display:block;
					color:#000000;
					font-size:1.6em;
					font-weight:normal;
				}
				a {
					color:#0088CC;
					text-decoration:none;
				}
				a:hover {
					text-decoration:underline;
				}
				a.menuLink:hover {
					background:#0088CC;
					color:#ffffff;
					text-decoration:none;
				}
				.article {
					color:#000000;
				}
				.article p {
					margin: 0 auto 1em;
				}
				.trouble {
					display:none;
				}
				-->
				</style>
				</head>
				<body bgcolor="#dddddd" marginheight="0" topmargin="0" background="http://tentaclecms.com/tentacle/admin/images/tentacle_logo_large.png">
				<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#dddddd" background="http://tentaclecms.com/tentacle/admin/images/bg_texturetastic_gray.png">
					<tr>
						<td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="3"><img src="http://tentaclecms.com/tentacle/admin/images/spacer.gif" alt="" width="1" height="30" style="display:block;" /></td>
								</tr>
							<tr>
								<td width="14">&nbsp;</td>
								<td colspan="2"><strong style="display:block; color:#000000; font-size:1.8em; font-weight:normal;"><font color="#000000"><img src="http://tentaclecms.com/tentacle/admin/images/tentacle_logo_large.png" alt="Tentacle CMS" width="258" height="63" style="vertical-align:bottom; line-height:0;"></font></strong></td>
								</tr>
							<tr>
								<td colspan="3"><img src="http://tentaclecms.com/tentacle/admin/images/spacer.gif" alt="" width="1" height="30" style="display:block;" /></td>
								</tr>
							<tr>
								<td rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
								<td width="582" bgcolor="#FFFFFF">&nbsp;</td>
								<td width="4" rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">';
	return $html;
}

function email_footer( ) {
	$html ='			</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">&nbsp;</td>
								</tr>
							<tr>
								<td colspan="3"><img src="http://tentaclecms.com/tentacle/admin/images/spacer.gif" alt="" width="1" height="30" style="display:block;" /></td>
								</tr>
							<tr>
								<td><img src="http://tentaclecms.com/tentacle/admin/images/spacer.gif" alt="" width="14" height="1" style="display:block;" /></td>
								<td><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Support</a> <font color="#989898">|</font> <a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a> <font color="#989898">|</font> <a href="http://tentaclecms.com/blog/" target="_blank">Blog</a> <font color="#989898">|</font> <a href="http://community.tentaclecms.com/">Community</a> <font color="#989898"> |</font> <a href="https://github.com/adampatterson/Tentacle/">Github</a> <font color="#989898">|</font> <a href="http://twitter.com/tentaclecms" target="_blank">@tentaclecms</a></td>
								<td><img src="http://tentaclecms.com/tentacle/admin/images/spacer.gif" alt="" width="14" height="1" style="display:block;" /></td>
								</tr>
						</table></td>
					</tr>
				</table>
				</body>
				</html>';
				
	return $html;
}