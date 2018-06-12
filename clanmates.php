<?php
$clantag = "#GCC9CPUG";

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjQ3NThlY2Q5LWE0NDAtNGUxMi1hODA4LTYzYmFjNmNiZTE4MiIsImlhdCI6MTQ5NjQwNDUzOCwic3ViIjoiZGV2ZWxvcGVyLzkyNGUyODE2LTJiMjgtYTVjOC02NTMyLTc1Yjk5Mjc3OTliYSIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjE4Mi41MC4xNTEuNTQiXSwidHlwZSI6ImNsaWVudCJ9XX0.R2up8k58MxRbcULsSEsFCZVfVwGzvQcASHUGrlVW3po2J2kw-785Zv3Akk6ahlxyB-ioXzd-mpC9-X1rNBl_BA";

$url = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag);

$ch = curl_init($url);

$headr = array();
$headr[] = "Accept: application/json";
$headr[] = "Authorization: Bearer ".$token;

curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

$res = curl_exec($ch);
$data = json_decode($res, true);
curl_close($ch);

if (isset($data["reason"])) {
  $errormsg = true;
}

$members = $data["memberList"];

?>
<html>
<head>
<title>XPLOIT</title>
<?php
  if (isset($errormsg)) {
    echo "<p>", "Failed: ", $data["reason"], " : ", isset($data["message"]) ? $data["message"] : "", "</p></body></html>";
    exit;
  }
?>
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/mobile.css" />
<link rel="stylesheet" type="text/css" href="styles/sidebar_img.css" />
<link rel="stylesheet" type="text/css" href="styles/clanmates.css" />
<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scalable=0" />
<script src="scripts/jquery-3.2.1.min.js"></script>
<script src="scripts/general.js"></script>
</head>
<body>
	<div id="header">
		<div class="logo"><a href="#">Master<span>Noobs</span></a></div>
		<div class="clan">
				<ul id="cdet">
					<li>Members: <div class="datatxt"><?php echo $data["members"]; ?>/50</div></li>
					<li>Trophy: <div class="datatxt"><?php echo $data["clanPoints"]; ?></div></li>
					<li>B.B. Trophy: <div class="datatxt"><?php echo $data["clanVersusPoints"]; ?></div></li>
				</ul>
		</div>
	</div>
	
	<a class="mobile" href="#">
		Menu
	</a>
	
	<div id="container">
		<div class="sidebar">
			<ul id="nav">
				<li><a class="selected" href="#"><img class="sb-icon" src="images/dashboard.svg">Dashboard</img></a></li>
				<li><a href="#"><img class="sb-icon" src="images/player.svg">Clanmates</img></a></li>
				<li><a href="#"><img class="sb-icon" src="images/new.svg">New Registration</img></a></li>
				<li><a href="#"><img class="sb-icon" src="images/accounts.svg">User Accounts</img></a></li>
				<li><a href="#"><img class="sb-icon" src="images/details.svg">Player Details</img></a></li>
				<li><a href="#"><img class="sb-icon" src="images/help.svg">Info and Help</img></a></li>
			</ul>
		</div>
		<div class="content">
			<div class="tsetup">
			<table id="member" border="1">
				<tr>
					<th>Rank</th>
					<th>League</th>
					<th>Exp.</th>
					<th>Name</th>
					<th>Donated</th>
					<th>Received</th>
					<th>Trophies</th>
					<th>B.Trophies</th>
				</tr>
				<?php
					foreach ($members as $member) {
				?>
				<tr id="populate">
					<td><?php echo $member["clanRank"]; ?></td>
					<td><img src="<?php echo $member["league"]["iconUrls"]["tiny"]; ?>" alt="<?php echo $member["league"]["name"]; ?>"/></td>
					<td><?php echo $member["expLevel"]; ?></td>
					<td><?php echo "<b>", $member["name"], "</b><br/>",$member["role"]; ?></td>
					<td><?php echo $member["donations"]; ?></td>
					<td><?php echo $member["donationsReceived"]; ?></td>
					<td><?php echo $member["trophies"]; ?></td>
					<td><?php echo $member["versusTrophies"]; ?></td>
				</tr>
				<?php
					}
				?>
			</table>
			</div>
		</div>	
	</div>
</body>
</html>