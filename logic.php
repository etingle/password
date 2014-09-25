
<?php


$case="";
//default number of words
$num_word=4;

//if a post is made, makes sure that
//the number of words is within allowed values
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$num_word=$_POST["num_word"];
	if ($num_word>9 OR $num_word<1 OR (!preg_match("/[1-9]/",$num_word))){
		$num_word=4;
	}
	if ($_POST["case"]=="upper_case"){
		$case="upper_case";

	} elseif ($_POST["case"]=="camel_case"){
		$case="camel_case";
	}
} 

	
	$count=0;

	while($count<$num_word){
		//Grabs random Wikipedia page
		$handle=file_get_contents("http://en.wikipedia.org/wiki/Special:Random");

		//grabbing first image on page, and finding full-size image
		preg_match_all('/<a href="(.*?)" class="image">/',$handle,$image_page);

		//some of the images were nested in the HTML,
		//so this checks to make sure it is pulling
		//the right URL
		//if there is no image, it pulls the default
		//Wikipedia image
		if (isset($image_page[1][0])){
			if (isset($image_page[1][1])){
				$image_page_2=file_get_contents("http://en.wikipedia.org".$image_page[1][1]);
			} else {
				$image_page_2=file_get_contents("http://en.wikipedia.org".$image_page[1][0]);
			}
			preg_match('/id="file"><a href="(.*?)"><img/', $image_page_2,$image);
			$image=$image[1];
		} else {
			$image="//upload.wikimedia.org/wikipedia/en/b/bc/Wiki.png";
		}
		//Finds and Extracts Title
		preg_match('/<title>(.*?)<\/title>/', $handle,$title_array);
		$title=explode(" - ",$title_array[1]);
		$title=$title[0];

		//Finds	and extracts page link
		preg_match('/rel=\"canonical\" href=\"(.*?)\" \/>/',$handle,$link);
		$link=$link[1];

		//Grabs everything in <p> tags (everything important)
		preg_match_all('/<p>(.*?)<\/p>/', $handle, $out);
		$text=implode($out[1]);
		//removes html tags
		$text=strip_tags($text);

		//removes all non-alphebetic characters and changes
		//periods to spaces
		$text=preg_replace("/[^a-zA-Z.]/", " ", $text);
		$text=str_replace("."," ",$text);

		$text=strtolower($text);

		//converts back to array, removes empty indices
		//removes duplicate indices, re-indexes array
		$text_array=explode(" ", $text);
		$text_array=array_filter($text_array);
		$text_array=array_unique($text_array);
		$text_array=array_values($text_array);
		$count=count($text_array);
	}


	//creates blank password, and adds random words to password
	$password="";
	for ($i=0;$i<=$num_word-1;$i++){
		$password=$password." ".$text_array[rand(0,$count-1)];
		echo "\n";
	}
	//creates array of symbols, and if symbol is selected
	//it is added to password
	if (isset($_POST["symbol_add"])){
		$symbol=array("!","@","#","$","%","^","&","*");
		$password=$password.$symbol[rand(0,7)];
	}
	//if number is selected, random number is added
	if (isset($_POST["num_add"])){
		$password=$password.rand(0,9);
	}
	//based on what case is selected, password is
	//converted to that case
	//lower case is the default
	if ($case=="upper_case"){
		$password=strtoupper($password);
	} elseif ($case=="camel_case") {
		$password=ucwords($password);
	}

?>
