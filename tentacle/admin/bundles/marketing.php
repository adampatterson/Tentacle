<? if (CONFIGURATION == 'deployment'): ?>
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/bootstrap-1.3.0.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?=MINIFY; ?>f=tentacle/admin/css/general.css" rel="stylesheet" type="text/css" />
<? else: ?>
	<link href="<?=TENTACLE_CSS; ?>bootstrap-1.3.0.min.css" rel="stylesheet">
	<link href="<?=ADMIN_URL; ?>css/admin.css" rel="stylesheet" type="text/css" />
	<link href="<?=ADMIN_URL; ?>css/general.css" rel="stylesheet" type="text/css" />
<? endif; ?>