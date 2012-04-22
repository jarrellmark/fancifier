<?php
	function getTwitterPost(){
		$input = "cats";
		$twResults = json_decode(file_get_contents("http://search.twitter.com/search.json?q=" .
				rawurlencode($input) .
				"&result_type=mixed&count=10&lang=en"));
		
		return $twResults->results[0]->text;
			
	}
?>
