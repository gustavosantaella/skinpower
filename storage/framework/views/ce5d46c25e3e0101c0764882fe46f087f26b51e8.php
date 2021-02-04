<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reset your password</title>
	<link rel="stylesheet" href="">
</head>
<body>
	Please click <a href="<?php echo Request::root() ?>/User/resetPass?id=<?= Crypt::encryptString($datos->id)?>&tokken=<?= Crypt::encryptString($datos->tokken)?>" title="">here.</a> to reset your password. If you have not been, please ignore this email or delete it.
</body>
</html><?php /**PATH /var/www/html/theskinpower/resources/views/mails/resetPass.blade.php ENDPATH**/ ?>