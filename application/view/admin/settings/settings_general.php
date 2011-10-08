<? load::view('admin/template-header', array('title' => 'General settings', 'assets' => 'application'));?>
<? load::view('admin/template-sidebar');?>
<div id="wrap">
	<form action="<?= BASE_URL ?>action/udpate_settings_post/" method="post" class="form-stacked">
		<input type="hidden" name="history" value="<?= CURRENT_PAGE ?>"/>
		<div class="one-full">
			<h1 class='title'><img src="<?=ADMIN_URL;?>images/icons/icon_pages_32.png" alt="" /> General settings</h1>
			<div class="one-half">
				<fieldset>
					<div class="clearfix">
						<label for="blogname">Site Title</label>
						<div class="input">
							<input type="text" value="Adam Patterson - Edmonton Graphic and Web Design" name="blogname">
						</div>
					</div>
					<div class="clearfix">
						<label for="custom_logo">Custom Logo</label>
						<div class="input">
							<input type="file" value="" name="custom_logo">
						</div>
					</div>
					<div class="clearfix">
						<label for="custom_favicon">Custom Favicon</label>
						<div class="input">
							<input type="file" value="" name="custom_favicon">
						</div>
					</div>
					<div class="clearfix">
						<label for="blogdescription">Tagline</label>
						<div class="input">
							<input type="text" value="Just my website" name="blogdescription">
							<span class="help-block">In a few words, explain what this site is about.</span>
						</div>
					</div>
					<div class="clearfix">
						<label for="siteurl">Base (URL)</label>
						<div class="input">
							<input type="text" class="code" value="http://www.adampatterson.ca" name="siteurl">
						</div>
					</div>
					<div class="clearfix">
						<label for="admin_email">E-mail address</label>
						<div class="input">
							<input type="text" value="hello@adampatterson.ca" name="admin_email">
							<span class="help-block">This address is used for admin purposes, like new user notification.</span>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="one-half">
				<fieldset>
					<div class="clearfix">
						<label>Membership</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label>
										<input type="hidden" value="0" name="users_can_register">
										<input type="checkbox" value="1" name="users_can_register">
										<span>Anyone can register</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="default_role">New User Default Role</label>
						<div class="input">
							<select name="default_role">
								<option value="subscriber" selected="selected">Subscriber</option>
								<option value="administrator">Administrator</option>
								<option value="editor">Editor</option>
								<option value="author">Author</option>
								<option value="contributor">Contributor</option>
							</select>
						</div>
					</div>
					<div class="clearfix">
						<label for="timezone_string">Timezone</label>
						<div class="input">
							<select name="timezone_string">
								<optgroup label="Africa">
									<option value="Africa/Abidjan">Abidjan</option>
									<option value="Africa/Accra">Accra</option>
									<option value="Africa/Addis_Ababa">Addis Ababa</option>
									<option value="Africa/Algiers">Algiers</option>
									<option value="Africa/Asmara">Asmara</option>
									<option value="Africa/Bamako">Bamako</option>
									<option value="Africa/Bangui">Bangui</option>
									<option value="Africa/Banjul">Banjul</option>
									<option value="Africa/Bissau">Bissau</option>
									<option value="Africa/Blantyre">Blantyre</option>
									<option value="Africa/Brazzaville">Brazzaville</option>
									<option value="Africa/Bujumbura">Bujumbura</option>
									<option value="Africa/Cairo">Cairo</option>
									<option value="Africa/Casablanca">Casablanca</option>
									<option value="Africa/Ceuta">Ceuta</option>
									<option value="Africa/Conakry">Conakry</option>
									<option value="Africa/Dakar">Dakar</option>
									<option value="Africa/Dar_es_Salaam">Dar es Salaam</option>
									<option value="Africa/Djibouti">Djibouti</option>
									<option value="Africa/Douala">Douala</option>
									<option value="Africa/El_Aaiun">El Aaiun</option>
									<option value="Africa/Freetown">Freetown</option>
									<option value="Africa/Gaborone">Gaborone</option>
									<option value="Africa/Harare">Harare</option>
									<option value="Africa/Johannesburg">Johannesburg</option>
									<option value="Africa/Kampala">Kampala</option>
									<option value="Africa/Khartoum">Khartoum</option>
									<option value="Africa/Kigali">Kigali</option>
									<option value="Africa/Kinshasa">Kinshasa</option>
									<option value="Africa/Lagos">Lagos</option>
									<option value="Africa/Libreville">Libreville</option>
									<option value="Africa/Lome">Lome</option>
									<option value="Africa/Luanda">Luanda</option>
									<option value="Africa/Lubumbashi">Lubumbashi</option>
									<option value="Africa/Lusaka">Lusaka</option>
									<option value="Africa/Malabo">Malabo</option>
									<option value="Africa/Maputo">Maputo</option>
									<option value="Africa/Maseru">Maseru</option>
									<option value="Africa/Mbabane">Mbabane</option>
									<option value="Africa/Mogadishu">Mogadishu</option>
									<option value="Africa/Monrovia">Monrovia</option>
									<option value="Africa/Nairobi">Nairobi</option>
									<option value="Africa/Ndjamena">Ndjamena</option>
									<option value="Africa/Niamey">Niamey</option>
									<option value="Africa/Nouakchott">Nouakchott</option>
									<option value="Africa/Ouagadougou">Ouagadougou</option>
									<option value="Africa/Porto-Novo">Porto-Novo</option>
									<option value="Africa/Sao_Tome">Sao Tome</option>
									<option value="Africa/Tripoli">Tripoli</option>
									<option value="Africa/Tunis">Tunis</option>
									<option value="Africa/Windhoek">Windhoek</option>
								</optgroup>
								<optgroup label="America">
									<option value="America/Adak">Adak</option>
									<option value="America/Anchorage">Anchorage</option>
									<option value="America/Anguilla">Anguilla</option>
									<option value="America/Antigua">Antigua</option>
									<option value="America/Araguaina">Araguaina</option>
									<option value="America/Argentina/Buenos_Aires">Argentina - Buenos Aires</option>
									<option value="America/Argentina/Catamarca">Argentina - Catamarca</option>
									<option value="America/Argentina/Cordoba">Argentina - Cordoba</option>
									<option value="America/Argentina/Jujuy">Argentina - Jujuy</option>
									<option value="America/Argentina/La_Rioja">Argentina - La Rioja</option>
									<option value="America/Argentina/Mendoza">Argentina - Mendoza</option>
									<option value="America/Argentina/Rio_Gallegos">Argentina - Rio Gallegos</option>
									<option value="America/Argentina/Salta">Argentina - Salta</option>
									<option value="America/Argentina/San_Juan">Argentina - San Juan</option>
									<option value="America/Argentina/San_Luis">Argentina - San Luis</option>
									<option value="America/Argentina/Tucuman">Argentina - Tucuman</option>
									<option value="America/Argentina/Ushuaia">Argentina - Ushuaia</option>
									<option value="America/Aruba">Aruba</option>
									<option value="America/Asuncion">Asuncion</option>
									<option value="America/Atikokan">Atikokan</option>
									<option value="America/Bahia">Bahia</option>
									<option value="America/Bahia_Banderas">Bahia Banderas</option>
									<option value="America/Barbados">Barbados</option>
									<option value="America/Belem">Belem</option>
									<option value="America/Belize">Belize</option>
									<option value="America/Blanc-Sablon">Blanc-Sablon</option>
									<option value="America/Boa_Vista">Boa Vista</option>
									<option value="America/Bogota">Bogota</option>
									<option value="America/Boise">Boise</option>
									<option value="America/Cambridge_Bay">Cambridge Bay</option>
									<option value="America/Campo_Grande">Campo Grande</option>
									<option value="America/Cancun">Cancun</option>
									<option value="America/Caracas">Caracas</option>
									<option value="America/Cayenne">Cayenne</option>
									<option value="America/Cayman">Cayman</option>
									<option value="America/Chicago">Chicago</option>
									<option value="America/Chihuahua">Chihuahua</option>
									<option value="America/Costa_Rica">Costa Rica</option>
									<option value="America/Cuiaba">Cuiaba</option>
									<option value="America/Curacao">Curacao</option>
									<option value="America/Danmarkshavn">Danmarkshavn</option>
									<option value="America/Dawson">Dawson</option>
									<option value="America/Dawson_Creek">Dawson Creek</option>
									<option value="America/Denver">Denver</option>
									<option value="America/Detroit">Detroit</option>
									<option value="America/Dominica">Dominica</option>
									<option value="America/Edmonton">Edmonton</option>
									<option value="America/Eirunepe">Eirunepe</option>
									<option value="America/El_Salvador">El Salvador</option>
									<option value="America/Fortaleza">Fortaleza</option>
									<option value="America/Glace_Bay">Glace Bay</option>
									<option value="America/Godthab">Godthab</option>
									<option value="America/Goose_Bay">Goose Bay</option>
									<option value="America/Grand_Turk">Grand Turk</option>
									<option value="America/Grenada">Grenada</option>
									<option value="America/Guadeloupe">Guadeloupe</option>
									<option value="America/Guatemala">Guatemala</option>
									<option value="America/Guayaquil">Guayaquil</option>
									<option value="America/Guyana">Guyana</option>
									<option value="America/Halifax">Halifax</option>
									<option value="America/Havana">Havana</option>
									<option value="America/Hermosillo">Hermosillo</option>
									<option value="America/Indiana/Indianapolis">Indiana - Indianapolis</option>
									<option value="America/Indiana/Knox">Indiana - Knox</option>
									<option value="America/Indiana/Marengo">Indiana - Marengo</option>
									<option value="America/Indiana/Petersburg">Indiana - Petersburg</option>
									<option value="America/Indiana/Tell_City">Indiana - Tell City</option>
									<option value="America/Indiana/Vevay">Indiana - Vevay</option>
									<option value="America/Indiana/Vincennes">Indiana - Vincennes</option>
									<option value="America/Indiana/Winamac">Indiana - Winamac</option>
									<option value="America/Inuvik">Inuvik</option>
									<option value="America/Iqaluit">Iqaluit</option>
									<option value="America/Jamaica">Jamaica</option>
									<option value="America/Juneau">Juneau</option>
									<option value="America/Kentucky/Louisville">Kentucky - Louisville</option>
									<option value="America/Kentucky/Monticello">Kentucky - Monticello</option>
									<option value="America/La_Paz">La Paz</option>
									<option value="America/Lima">Lima</option>
									<option value="America/Los_Angeles">Los Angeles</option>
									<option value="America/Maceio">Maceio</option>
									<option value="America/Managua">Managua</option>
									<option value="America/Manaus">Manaus</option>
									<option value="America/Marigot">Marigot</option>
									<option value="America/Martinique">Martinique</option>
									<option value="America/Matamoros">Matamoros</option>
									<option value="America/Mazatlan">Mazatlan</option>
									<option value="America/Menominee">Menominee</option>
									<option value="America/Merida">Merida</option>
									<option value="America/Mexico_City">Mexico City</option>
									<option value="America/Miquelon">Miquelon</option>
									<option value="America/Moncton">Moncton</option>
									<option value="America/Monterrey">Monterrey</option>
									<option value="America/Montevideo">Montevideo</option>
									<option value="America/Montreal">Montreal</option>
									<option value="America/Montserrat">Montserrat</option>
									<option value="America/Nassau">Nassau</option>
									<option value="America/New_York">New York</option>
									<option value="America/Nipigon">Nipigon</option>
									<option value="America/Nome">Nome</option>
									<option value="America/Noronha">Noronha</option>
									<option value="America/North_Dakota/Center">North Dakota - Center</option>
									<option value="America/North_Dakota/New_Salem">North Dakota - New Salem</option>
									<option value="America/Ojinaga">Ojinaga</option>
									<option value="America/Panama">Panama</option>
									<option value="America/Pangnirtung">Pangnirtung</option>
									<option value="America/Paramaribo">Paramaribo</option>
									<option value="America/Phoenix">Phoenix</option>
									<option value="America/Port-au-Prince">Port-au-Prince</option>
									<option value="America/Port_of_Spain">Port of Spain</option>
									<option value="America/Porto_Velho">Porto Velho</option>
									<option value="America/Puerto_Rico">Puerto Rico</option>
									<option value="America/Rainy_River">Rainy River</option>
									<option value="America/Rankin_Inlet">Rankin Inlet</option>
									<option value="America/Recife">Recife</option>
									<option value="America/Regina">Regina</option>
									<option value="America/Resolute">Resolute</option>
									<option value="America/Rio_Branco">Rio Branco</option>
									<option value="America/Santa_Isabel">Santa Isabel</option>
									<option value="America/Santarem">Santarem</option>
									<option value="America/Santiago">Santiago</option>
									<option value="America/Santo_Domingo">Santo Domingo</option>
									<option value="America/Sao_Paulo">Sao Paulo</option>
									<option value="America/Scoresbysund">Scoresbysund</option>
									<option value="America/Shiprock">Shiprock</option>
									<option value="America/St_Barthelemy">St Barthelemy</option>
									<option value="America/St_Johns">St Johns</option>
									<option value="America/St_Kitts">St Kitts</option>
									<option value="America/St_Lucia">St Lucia</option>
									<option value="America/St_Thomas">St Thomas</option>
									<option value="America/St_Vincent">St Vincent</option>
									<option value="America/Swift_Current">Swift Current</option>
									<option value="America/Tegucigalpa">Tegucigalpa</option>
									<option value="America/Thule">Thule</option>
									<option value="America/Thunder_Bay">Thunder Bay</option>
									<option value="America/Tijuana">Tijuana</option>
									<option value="America/Toronto">Toronto</option>
									<option value="America/Tortola">Tortola</option>
									<option value="America/Vancouver">Vancouver</option>
									<option value="America/Whitehorse">Whitehorse</option>
									<option value="America/Winnipeg">Winnipeg</option>
									<option value="America/Yakutat">Yakutat</option>
									<option value="America/Yellowknife">Yellowknife</option>
								</optgroup>
								<optgroup label="Antarctica">
									<option value="Antarctica/Casey">Casey</option>
									<option value="Antarctica/Davis">Davis</option>
									<option value="Antarctica/DumontDUrville">DumontDUrville</option>
									<option value="Antarctica/Macquarie">Macquarie</option>
									<option value="Antarctica/Mawson">Mawson</option>
									<option value="Antarctica/McMurdo">McMurdo</option>
									<option value="Antarctica/Palmer">Palmer</option>
									<option value="Antarctica/Rothera">Rothera</option>
									<option value="Antarctica/South_Pole">South Pole</option>
									<option value="Antarctica/Syowa">Syowa</option>
									<option value="Antarctica/Vostok">Vostok</option>
								</optgroup>
								<optgroup label="Arctic">
									<option value="Arctic/Longyearbyen">Longyearbyen</option>
								</optgroup>
								<optgroup label="Asia">
									<option value="Asia/Aden">Aden</option>
									<option value="Asia/Almaty">Almaty</option>
									<option value="Asia/Amman">Amman</option>
									<option value="Asia/Anadyr">Anadyr</option>
									<option value="Asia/Aqtau">Aqtau</option>
									<option value="Asia/Aqtobe">Aqtobe</option>
									<option value="Asia/Ashgabat">Ashgabat</option>
									<option value="Asia/Baghdad">Baghdad</option>
									<option value="Asia/Bahrain">Bahrain</option>
									<option value="Asia/Baku">Baku</option>
									<option value="Asia/Bangkok">Bangkok</option>
									<option value="Asia/Beirut">Beirut</option>
									<option value="Asia/Bishkek">Bishkek</option>
									<option value="Asia/Brunei">Brunei</option>
									<option value="Asia/Choibalsan">Choibalsan</option>
									<option value="Asia/Chongqing">Chongqing</option>
									<option value="Asia/Colombo">Colombo</option>
									<option value="Asia/Damascus">Damascus</option>
									<option value="Asia/Dhaka">Dhaka</option>
									<option value="Asia/Dili">Dili</option>
									<option value="Asia/Dubai">Dubai</option>
									<option value="Asia/Dushanbe">Dushanbe</option>
									<option value="Asia/Gaza">Gaza</option>
									<option value="Asia/Harbin">Harbin</option>
									<option value="Asia/Ho_Chi_Minh">Ho Chi Minh</option>
									<option value="Asia/Hong_Kong">Hong Kong</option>
									<option value="Asia/Hovd">Hovd</option>
									<option value="Asia/Irkutsk">Irkutsk</option>
									<option value="Asia/Jakarta">Jakarta</option>
									<option value="Asia/Jayapura">Jayapura</option>
									<option value="Asia/Jerusalem">Jerusalem</option>
									<option value="Asia/Kabul">Kabul</option>
									<option value="Asia/Kamchatka">Kamchatka</option>
									<option value="Asia/Karachi">Karachi</option>
									<option value="Asia/Kashgar">Kashgar</option>
									<option value="Asia/Kathmandu">Kathmandu</option>
									<option value="Asia/Kolkata">Kolkata</option>
									<option value="Asia/Krasnoyarsk">Krasnoyarsk</option>
									<option value="Asia/Kuala_Lumpur">Kuala Lumpur</option>
									<option value="Asia/Kuching">Kuching</option>
									<option value="Asia/Kuwait">Kuwait</option>
									<option value="Asia/Macau">Macau</option>
									<option value="Asia/Magadan">Magadan</option>
									<option value="Asia/Makassar">Makassar</option>
									<option value="Asia/Manila">Manila</option>
									<option value="Asia/Muscat">Muscat</option>
									<option value="Asia/Nicosia">Nicosia</option>
									<option value="Asia/Novokuznetsk">Novokuznetsk</option>
									<option value="Asia/Novosibirsk">Novosibirsk</option>
									<option value="Asia/Omsk">Omsk</option>
									<option value="Asia/Oral">Oral</option>
									<option value="Asia/Phnom_Penh">Phnom Penh</option>
									<option value="Asia/Pontianak">Pontianak</option>
									<option value="Asia/Pyongyang">Pyongyang</option>
									<option value="Asia/Qatar">Qatar</option>
									<option value="Asia/Qyzylorda">Qyzylorda</option>
									<option value="Asia/Rangoon">Rangoon</option>
									<option value="Asia/Riyadh">Riyadh</option>
									<option value="Asia/Sakhalin">Sakhalin</option>
									<option value="Asia/Samarkand">Samarkand</option>
									<option value="Asia/Seoul">Seoul</option>
									<option value="Asia/Shanghai">Shanghai</option>
									<option value="Asia/Singapore">Singapore</option>
									<option value="Asia/Taipei">Taipei</option>
									<option value="Asia/Tashkent">Tashkent</option>
									<option value="Asia/Tbilisi">Tbilisi</option>
									<option value="Asia/Tehran">Tehran</option>
									<option value="Asia/Thimphu">Thimphu</option>
									<option value="Asia/Tokyo">Tokyo</option>
									<option value="Asia/Ulaanbaatar">Ulaanbaatar</option>
									<option value="Asia/Urumqi">Urumqi</option>
									<option value="Asia/Vientiane">Vientiane</option>
									<option value="Asia/Vladivostok">Vladivostok</option>
									<option value="Asia/Yakutsk">Yakutsk</option>
									<option value="Asia/Yekaterinburg">Yekaterinburg</option>
									<option value="Asia/Yerevan">Yerevan</option>
								</optgroup>
								<optgroup label="Atlantic">
									<option value="Atlantic/Azores">Azores</option>
									<option value="Atlantic/Bermuda">Bermuda</option>
									<option value="Atlantic/Canary">Canary</option>
									<option value="Atlantic/Cape_Verde">Cape Verde</option>
									<option value="Atlantic/Faroe">Faroe</option>
									<option value="Atlantic/Madeira">Madeira</option>
									<option value="Atlantic/Reykjavik">Reykjavik</option>
									<option value="Atlantic/South_Georgia">South Georgia</option>
									<option value="Atlantic/Stanley">Stanley</option>
									<option value="Atlantic/St_Helena">St Helena</option>
								</optgroup>
								<optgroup label="Australia">
									<option value="Australia/Adelaide">Adelaide</option>
									<option value="Australia/Brisbane">Brisbane</option>
									<option value="Australia/Broken_Hill">Broken Hill</option>
									<option value="Australia/Currie">Currie</option>
									<option value="Australia/Darwin">Darwin</option>
									<option value="Australia/Eucla">Eucla</option>
									<option value="Australia/Hobart">Hobart</option>
									<option value="Australia/Lindeman">Lindeman</option>
									<option value="Australia/Lord_Howe">Lord Howe</option>
									<option value="Australia/Melbourne">Melbourne</option>
									<option value="Australia/Perth">Perth</option>
									<option value="Australia/Sydney">Sydney</option>
								</optgroup>
								<optgroup label="Europe">
									<option value="Europe/Amsterdam">Amsterdam</option>
									<option value="Europe/Andorra">Andorra</option>
									<option value="Europe/Athens">Athens</option>
									<option value="Europe/Belgrade">Belgrade</option>
									<option value="Europe/Berlin">Berlin</option>
									<option value="Europe/Bratislava">Bratislava</option>
									<option value="Europe/Brussels">Brussels</option>
									<option value="Europe/Bucharest">Bucharest</option>
									<option value="Europe/Budapest">Budapest</option>
									<option value="Europe/Chisinau">Chisinau</option>
									<option value="Europe/Copenhagen">Copenhagen</option>
									<option value="Europe/Dublin">Dublin</option>
									<option value="Europe/Gibraltar">Gibraltar</option>
									<option value="Europe/Guernsey">Guernsey</option>
									<option value="Europe/Helsinki">Helsinki</option>
									<option value="Europe/Isle_of_Man">Isle of Man</option>
									<option value="Europe/Istanbul">Istanbul</option>
									<option value="Europe/Jersey">Jersey</option>
									<option value="Europe/Kaliningrad">Kaliningrad</option>
									<option value="Europe/Kiev">Kiev</option>
									<option value="Europe/Lisbon">Lisbon</option>
									<option value="Europe/Ljubljana">Ljubljana</option>
									<option value="Europe/London">London</option>
									<option value="Europe/Luxembourg">Luxembourg</option>
									<option value="Europe/Madrid">Madrid</option>
									<option value="Europe/Malta">Malta</option>
									<option value="Europe/Mariehamn">Mariehamn</option>
									<option value="Europe/Minsk">Minsk</option>
									<option value="Europe/Monaco">Monaco</option>
									<option value="Europe/Moscow">Moscow</option>
									<option value="Europe/Oslo">Oslo</option>
									<option value="Europe/Paris">Paris</option>
									<option value="Europe/Podgorica">Podgorica</option>
									<option value="Europe/Prague">Prague</option>
									<option value="Europe/Riga">Riga</option>
									<option value="Europe/Rome">Rome</option>
									<option value="Europe/Samara">Samara</option>
									<option value="Europe/San_Marino">San Marino</option>
									<option value="Europe/Sarajevo">Sarajevo</option>
									<option value="Europe/Simferopol">Simferopol</option>
									<option value="Europe/Skopje">Skopje</option>
									<option value="Europe/Sofia">Sofia</option>
									<option value="Europe/Stockholm">Stockholm</option>
									<option value="Europe/Tallinn">Tallinn</option>
									<option value="Europe/Tirane">Tirane</option>
									<option value="Europe/Uzhgorod">Uzhgorod</option>
									<option value="Europe/Vaduz">Vaduz</option>
									<option value="Europe/Vatican">Vatican</option>
									<option value="Europe/Vienna">Vienna</option>
									<option value="Europe/Vilnius">Vilnius</option>
									<option value="Europe/Volgograd">Volgograd</option>
									<option value="Europe/Warsaw">Warsaw</option>
									<option value="Europe/Zagreb">Zagreb</option>
									<option value="Europe/Zaporozhye">Zaporozhye</option>
									<option value="Europe/Zurich">Zurich</option>
								</optgroup>
								<optgroup label="Indian">
									<option value="Indian/Antananarivo">Antananarivo</option>
									<option value="Indian/Chagos">Chagos</option>
									<option value="Indian/Christmas">Christmas</option>
									<option value="Indian/Cocos">Cocos</option>
									<option value="Indian/Comoro">Comoro</option>
									<option value="Indian/Kerguelen">Kerguelen</option>
									<option value="Indian/Mahe">Mahe</option>
									<option value="Indian/Maldives">Maldives</option>
									<option value="Indian/Mauritius">Mauritius</option>
									<option value="Indian/Mayotte">Mayotte</option>
									<option value="Indian/Reunion">Reunion</option>
								</optgroup>
								<optgroup label="Pacific">
									<option value="Pacific/Apia">Apia</option>
									<option value="Pacific/Auckland">Auckland</option>
									<option value="Pacific/Chatham">Chatham</option>
									<option value="Pacific/Chuuk">Chuuk</option>
									<option value="Pacific/Easter">Easter</option>
									<option value="Pacific/Efate">Efate</option>
									<option value="Pacific/Enderbury">Enderbury</option>
									<option value="Pacific/Fakaofo">Fakaofo</option>
									<option value="Pacific/Fiji">Fiji</option>
									<option value="Pacific/Funafuti">Funafuti</option>
									<option value="Pacific/Galapagos">Galapagos</option>
									<option value="Pacific/Gambier">Gambier</option>
									<option value="Pacific/Guadalcanal">Guadalcanal</option>
									<option value="Pacific/Guam">Guam</option>
									<option value="Pacific/Honolulu">Honolulu</option>
									<option value="Pacific/Johnston">Johnston</option>
									<option value="Pacific/Kiritimati">Kiritimati</option>
									<option value="Pacific/Kosrae">Kosrae</option>
									<option value="Pacific/Kwajalein">Kwajalein</option>
									<option value="Pacific/Majuro">Majuro</option>
									<option value="Pacific/Marquesas">Marquesas</option>
									<option value="Pacific/Midway">Midway</option>
									<option value="Pacific/Nauru">Nauru</option>
									<option value="Pacific/Niue">Niue</option>
									<option value="Pacific/Norfolk">Norfolk</option>
									<option value="Pacific/Noumea">Noumea</option>
									<option value="Pacific/Pago_Pago">Pago Pago</option>
									<option value="Pacific/Palau">Palau</option>
									<option value="Pacific/Pitcairn">Pitcairn</option>
									<option value="Pacific/Pohnpei">Pohnpei</option>
									<option value="Pacific/Port_Moresby">Port Moresby</option>
									<option value="Pacific/Rarotonga">Rarotonga</option>
									<option value="Pacific/Saipan">Saipan</option>
									<option value="Pacific/Tahiti">Tahiti</option>
									<option value="Pacific/Tarawa">Tarawa</option>
									<option value="Pacific/Tongatapu">Tongatapu</option>
									<option value="Pacific/Wake">Wake</option>
									<option value="Pacific/Wallis">Wallis</option>
								</optgroup>
								<optgroup label="UTC">
									<option value="UTC">UTC</option>
								</optgroup>
								<optgroup label="Manual Offsets">
									<option value="UTC-12">UTC-12</option>
									<option value="UTC-11.5">UTC-11:30</option>
									<option value="UTC-11">UTC-11</option>
									<option value="UTC-10.5">UTC-10:30</option>
									<option value="UTC-10">UTC-10</option>
									<option value="UTC-9.5">UTC-9:30</option>
									<option value="UTC-9">UTC-9</option>
									<option value="UTC-8.5">UTC-8:30</option>
									<option value="UTC-8">UTC-8</option>
									<option value="UTC-7.5">UTC-7:30</option>
									<option value="UTC-7">UTC-7</option>
									<option value="UTC-6.5">UTC-6:30</option>
									<option value="UTC-6">UTC-6</option>
									<option value="UTC-5.5">UTC-5:30</option>
									<option value="UTC-5">UTC-5</option>
									<option value="UTC-4.5">UTC-4:30</option>
									<option value="UTC-4">UTC-4</option>
									<option value="UTC-3.5">UTC-3:30</option>
									<option value="UTC-3">UTC-3</option>
									<option value="UTC-2.5">UTC-2:30</option>
									<option value="UTC-2">UTC-2</option>
									<option value="UTC-1.5">UTC-1:30</option>
									<option value="UTC-1">UTC-1</option>
									<option value="UTC-0.5">UTC-0:30</option>
									<option value="UTC+0" selected="selected">UTC+0</option>
									<option value="UTC+0.5">UTC+0:30</option>
									<option value="UTC+1">UTC+1</option>
									<option value="UTC+1.5">UTC+1:30</option>
									<option value="UTC+2">UTC+2</option>
									<option value="UTC+2.5">UTC+2:30</option>
									<option value="UTC+3">UTC+3</option>
									<option value="UTC+3.5">UTC+3:30</option>
									<option value="UTC+4">UTC+4</option>
									<option value="UTC+4.5">UTC+4:30</option>
									<option value="UTC+5">UTC+5</option>
									<option value="UTC+5.5">UTC+5:30</option>
									<option value="UTC+5.75">UTC+5:45</option>
									<option value="UTC+6">UTC+6</option>
									<option value="UTC+6.5">UTC+6:30</option>
									<option value="UTC+7">UTC+7</option>
									<option value="UTC+7.5">UTC+7:30</option>
									<option value="UTC+8">UTC+8</option>
									<option value="UTC+8.5">UTC+8:30</option>
									<option value="UTC+8.75">UTC+8:45</option>
									<option value="UTC+9">UTC+9</option>
									<option value="UTC+9.5">UTC+9:30</option>
									<option value="UTC+10">UTC+10</option>
									<option value="UTC+10.5">UTC+10:30</option>
									<option value="UTC+11">UTC+11</option>
									<option value="UTC+11.5">UTC+11:30</option>
									<option value="UTC+12">UTC+12</option>
									<option value="UTC+12.75">UTC+12:45</option>
									<option value="UTC+13">UTC+13</option>
									<option value="UTC+13.75">UTC+13:45</option>
									<option value="UTC+14">UTC+14</option>
								</optgroup>
							</select>
							<span class="help-block"><abbr title="Coordinated Universal Time"> UTC </abbr> time is
								<code>
									2011-04-04 4:58:48
								</code>
								<br>
								Choose a city in the same timezone as you.</span>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Date Format</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label> <label title="F j, Y">
											<input type="radio" checked="checked" value="F j, Y" name="date_format">
											<span>April 4, 2011</span> </label> </label>
								</li>
								<li>
									<label title="Y/m/d">
										<input type="radio" value="Y/m/d" name="date_format">
										<span>2011/04/04</span> </label>
								</li>
								<li>
									<label title="m/d/Y">
										<input type="radio" value="m/d/Y" name="date_format">
										<span>04/04/2011</span> </label>
								</li>
								<li>
									<label title="d/m/Y">
										<input type="radio" value="d/m/Y" name="date_format">
										<span>04/04/2011</span> </label>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="clearfix">
						<label>Time Format</label>
						<div class="input">
							<ul class="inputs-list">
								<li>
									<label title="g:i a">
										<input type="radio" checked="checked" value="g:i a" name="time_format">
										<span>4:58 am</span> </label>
								</li>
								<li>
									<label title="g:i A">
										<input type="radio" value="g:i A" name="time_format">
										<span>4:58 AM</span> </label>
								</li>
								<li>
									<label title="H:i">
										<input type="radio" value="H:i" name="time_format">
										<span>04:58</span> </label>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<label for="start_of_week">Week Starts On</label>
						<div class="input">
							<select id="start_of_week" name="start_of_week">
								<option value="0">Sunday</option>
								<option selected="selected" value="1">Monday</option>
								<option value="2">Tuesday</option>
								<option value="3">Wednesday</option>
								<option value="4">Thursday</option>
								<option value="5">Friday</option>
								<option value="6">Saturday</option>
							</select>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<div class="one-full">
			<div class="actions">
				<button class="btn medium primary" type="submit">
					Save Changes
				</button>
			</div>
		</div>
	</form>
</div>
<!-- #wrap -->
<? load::view('admin/template-footer');?>
