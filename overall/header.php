<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<title>LeaguePlay.net</title>
	</head>
	<body>
		<div id="header">
			<div class="container">
				<a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
				<div class="header-menu">
					<a href="index.php" class="btn-active">Home</a>
					<a href="" class="btn">Tournaments</a>
					<a href="" class="btn">Matches</a>
					<a href="" class="btn">Ranking</a>
					<a href="" class="btn">FAQ</a>
				</div>
			</div>
		</div>
		<div class="container">
			<div id="user-menu">
				<?php if(isset($user['uid'])) { ?>
					<div class="play-button">
						<a href=""><img src="images/play-button.png" alt="play"></a>
					</div>
					<form action="" class="search">
						<input type="text" name="search" placeholder="search...">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
					<div class="user-info">
						<a href="" class="user-link">
							<img src="images/avatar.png" alt="avatar" class="avatar">
							<span class="nickname"><?php echo $user['nickname']; ?></span>
						</a>
						<span class="level"><?php echo $user['level']; ?><img src="images/level.png" alt="level" class="level-image"></span>
						<span class="points"><?php echo $user['points']; ?><img src="images/points.png" alt="points" class="points-image"></span>
						<button class="btn"><i class="fa fa-comments"></i></button>
						<a href="" class="option-link"><i class="fa fa-cog"></i></a>
						<a href="index.php?app=user&module=session&section=logout" class="option-link"><i class="fa fa-sign-out"></i></a>
					</div>
				<?php } else { ?>
					<div class="guest-menu">
						<a href="index.php?app=user&module=session&section=login" class="btn-active">Sign In</a>
						<a href="index.php?app=user&module=session&section=register" class="btn-golden">Sign Up</a>
					</div>
				<?php } ?>
			</div>
			<div id="content">