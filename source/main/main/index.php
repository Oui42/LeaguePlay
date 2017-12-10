<?php
$tournaments_list = array();
$sql = "SELECT * FROM `lp_tournaments` WHERE `status` != '".$__tournament['deleted']."' ORDER BY `date` DESC LIMIT 5";
$query = query($sql);
if(mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		if($row['status'] == $__tournament['started'])
			$row['status_text'] = "<i class='fa fa-fw fa-play' style='color: #57e53b;'></i>";
		else if($row['status'] == $__tournament['open'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-o'></i>";
		else if($row['status'] == $__tournament['closed'])
			$row['status_text'] = "<i class='fa fa-fw fa-calendar-check-o' style='color: #f35151;'></i>";

		$tournaments_list[] = $row;
	}
}
?>

<div class="home-left">
	<div class="news">
		<div class="news-head">
			<span class="news-title"><a href="">Lorem Ipsum</a></span>
			<span class="news-date">01-01-1970</span>
			<div class="clear"></div>
		</div>
		<div class="news-content">
			<div class="news-text">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui <a href="">officia deserunt</a> mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed <a href="">quia consequuntur</a> magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
			</div>
			<div class="news-image">
				<img src="images/news-image.png" alt="news-image">
			</div>
			<div class="clear"></div>
			<div class="news-button">
				<a href="" class="btn-active">Read more...</a>
			</div>
		</div>
	</div>
	<div class="news">
		<div class="news-head">
			<span class="news-title"><a href="">Lorem Ipsum</a></span>
			<span class="news-date">01-01-1970</span>
			<div class="clear"></div>
		</div>
		<div class="news-content">
			<div class="news-text">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in <a href="">reprehenderit in voluptate</a> velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta <a href="">sunt explicabo</a>. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur <a href="">magni dolores</a> eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
			</div>
			<div class="news-image">
				<img src="images/news-image.png" alt="news-image">
			</div>
			<div class="clear"></div>
			<div class="news-button">
				<a href="" class="btn-active">Read more...</a>
			</div>
		</div>
	</div>
</div>
<div class="home-right">
	<div class="panel">
		<div class="panel-head">
			Tournaments
		</div>
		<div class="panel-body">
			<?php
			if(!empty($tournaments_list)) {
				foreach($tournaments_list as $tl) {
				?>
					<span class="home-tournaments-name"><a href="index.php?app=main&module=tournaments&section=view&id=<?php echo $tl['tournament_id']; ?>"><?php echo $tl['name']; ?></a></span>
					<span class="home-tournaments-info">
						<span class="points"><?php echo $tl['award']; ?><img src="images/points.png" alt="points" class="points-image"></span>
						<?php echo date('d-m H:i', $tl['date'])." ".$tl['status_text']; ?>
					</span>
					<div class="clear"></div>
					<hr>
				<?php
				}
			} else {
				alert("info", "Tournaments list are empty.");
			}
			?>
		</div>
	</div>
	<div class="panel">
		<div class="panel-head">
			Matches
		</div>
		<div class="panel-body">
			<a href="" class="home-matches-user matches-user1">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<span class="matches-vs"><a href="">VS.</a></span>
			<a href="" class="home-matches-user matches-user2">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<div class="clear"></div>
			<hr>
			<a href="" class="home-matches-user matches-user1">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<span class="matches-vs"><a href="">VS.</a></span>
			<a href="" class="home-matches-user matches-user2">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<div class="clear"></div>
			<hr>
			<a href="" class="home-matches-user matches-user1">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<span class="matches-vs"><a href="">VS.</a></span>
			<a href="" class="home-matches-user matches-user2">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<div class="clear"></div>
			<hr>
			<a href="" class="home-matches-user matches-user1">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<span class="matches-vs"><a href="">VS.</a></span>
			<a href="" class="home-matches-user matches-user2">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<div class="clear"></div>
			<hr>
			<a href="" class="home-matches-user matches-user1">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<span class="matches-vs"><a href="">VS.</a></span>
			<a href="" class="home-matches-user matches-user2">
				<img src="images/avatar.png" alt="avatar" class="avatar">
				<span class="nickname">Nickname</span>
			</a>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="clear"></div>