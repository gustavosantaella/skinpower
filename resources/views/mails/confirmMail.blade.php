

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	
	
</head>
<body>

	<center>	
		<div >
			
			<div class="container">
				<p>Confirm your email by clicking</p> <a href="<?php echo Request::root() ?>/Verify/email?id=<?= Crypt::encryptString($id)?>&state=<?= Crypt::encryptString(TRUE)?>&tokken=<?= Crypt::encryptString($datos->tokken)?>" title="">here.</a><p>Do not share this link. <br>

				If it wasn't you, delete or ignore this message.
</p>


			</div>
		</div>
	</center>

	
</body>
</html>

