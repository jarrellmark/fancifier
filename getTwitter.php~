<?php
	function getTwitterPost(){
		$input = "cats";
		$twResults = json_decode(file_get_contents("http://search.twitter.com/search.json?q=" .
				rawurlencode($input) .
				"&result_type=mixed&count=20&lang=en"));
		$random = rand(0, sizeof($twResults) - 1);
		return $twResults->results[$random]->text;
		
	}
	//echo getTwitterPost();
?>
