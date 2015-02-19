<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		
		body {
			background-color: #636363;
			background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAIAAAD91JpzAAAAFklEQVQImWNOTk7+/Pkz8+fPn+3t7QE3kQefhyY+9gAAAABJRU5ErkJggg==');
			font-family: helvetica;
		}

		.cf {
			clear: both;
		}

		.top-bar {
			height: 30px;
			color: #fff;
		}
		.top-bar .left {
			float: left;
			width: 15%;
		}

		.top-bar .middle {
			float: left;
			width: 60%;
			padding-top: 20px;
		}

		.top-bar .right {
			float: left;
			width: 15%;
			padding-top: 25px
		}

		.center {
			margin-top: 5px;
			background-color: #fff;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.container {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}

		.container a {
			color: #000;
		}

		.footer {
			height: 25px;
			font-size: 8pt;
			padding-top: 4px;
			padding-bottom: 4px;
		}
		.footer a {
			color: #fff;
		}

		h2 {
			font-size: 16pt;
		}



	</style>
</head>
<body>
<div class="top-bar">
	<div class="left">
		<img src="cid:logo1"/>
	</div>
	<div class="middle">
		<h2>{$title_overbod}</h2>
	</div>
	<div class="right">
		opgeslagen email:<br/> {$email_overbod}
	</div>
</div>
<br class="cf"/>
<div class="center">
	<div class="container">
	<br/>
		<h3>Beste {$name_overbod}</h3>
		<p>Helaas bent u overboden, waardoor u niet langer het hoogste bod heeft! Dit houdt in dat u een hoger bod moet plaatsen om in aanmerking te komen voor dit product<br/>Plaats snel een nieuw bod!</p>
		<p>Geboden product: <bold>{$auction_link}</bold></p>
		<br/>
	</div>
</div>
<div class="footer">
	<div class="container">
		<a href="http://veiling.npoict.nl/">NPOICT Veilingen |</a>
		<a href="http://veiling.npoict.nl/index.php?page=vragen">Vragen? |</a>
		<a href="http://veiling.npoict.nl/index.php?page=voorwaarden">Voorwaarden |</a>
	</div>
</div>
</body>
</html>