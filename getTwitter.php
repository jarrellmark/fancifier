<?php
	function getTwitterPost(){
		$input = "cats";
		$twResults = json_decode(file_get_contents("http://search.twitter.com/search.json?q=" .
				rawurlencode($input) .
				"&result_type=mixed&count=100&lang=en"));
		$random = rand(0, 100);
		return $twResults->results[$random]->text;
	}
?>
