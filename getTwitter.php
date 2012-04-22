<?php
	function getTwitterPost(){
		$input = "hackRU";
		$twResults = json_decode(file_get_contents("http://search.twitter.com/search.json?q=" .
				rawurlencode($input) .
				"&result_type=mixed&count=10&lang=en"));
		
		echo $twResults->results[0]->text;
			
	}
?>
