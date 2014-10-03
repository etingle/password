<!DOCTYPE html>
<html>
<head>
	
	<meta charset='utf-8'>
	<title>P2 - XKCD/Wiki Password Generator</title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	<link rel="stylesheet" type="text/css" href="http://purecss.io/css/layouts/side-menu.css">
	<link rel="stylesheet" type="text/css" href="p2.css" >

	<?php require('logic.php');?>

</head>
<body>

	<div id="main">
	<div class="header">
<h1> P2 - XKCD/Wiki Password Generator</h1>
</div>
<div class="content">
<!--Creating Form-->
<form class="pure-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	
		Number of Words (1-9): <input type="text" size="1" name="num_word" id="num_word" value="">
		<label for="num_add" class="pure-checkbox">
			Add Number?: 
			<input type="checkbox" name="num_add" id="num_add">
		</label>
		<label for="num_add" class="pure-checkbox">
			Add Symbol?:
			<input type="checkbox" name="symbol_add" id="symbol_add">
		</label>
		<legend>Capitalization:</legend>
		<label for="upper_case" class="pure-radio">
			All Caps
			<input type="radio" name="case" id="upper_case" value="upper_case">
		</label>
		<label for="camel_case" class="pure-radio">
			Camel Case
			<input type="radio" name="case" id="camel_case" value="camel_case">
		</label>
		<label for="lower_case" class="pure-radio">
			Lower Case
			<input type="radio" name="case" id="lower_case" value="lower_case" checked>
		</label>
		<br/>
		<input class="pure-button pure-button-active" type="submit" value="Generate">
	</p>
</form>

<div class="password_block">
<p id="link">Password generated from the<br/><a href="<?=$link?>"\><?=$title?></a><br/>Wikipedia page</p>

<img src="http:<?=$image?>">

<div id="password">
<p><?=$password?></p>
</div>
</div>
<p id="description"><a href="http://xkcd.com/936/">XKCD passwords</a> are random words pieced together to create a long (and therefore hard to guess) but memorable password. My password generator creates a password with random words from a random Wikipedia page. Learn something new AND stay secure!</p>
</div>
</div>
</body>
</html>