<?php
	include_once('config.php');
	$opts = array(
		'http'=>array(
			'method'	=>	"POST",
			'content'	=>	'track='.WORDS_TO_TRACK,
		)
	);
	//We're going to store the data in the database, so, let's open a connection:
	$db = mysql_connect('localhost', 'twitter_alerts', 'somepasword');
	mysql_select_db('twitter_alerts', $db);

	$context = stream_context_create($opts);
	while (1){
		$instream = fopen('http://'.TWITTER_USERNAME.':'.TWITTER_PASSWORD.'@stream.twitter.com/1/statuses/filter.json','r' ,false, $context);
		while(! feof($instream)) {
			if(! ($line = stream_get_line($instream, 20000, "\n"))) {
				continue;
			}else{
				$tweet = json_decode($line);
				//Clean the inputs before storing
				$id = mysql_real_escape_string($tweet->{'id'});
				$text = mysql_real_escape_string($tweet->{'text'});
				$screen_name = mysql_real_escape_string($tweet->{'user'}->{'screen_name'});
				$followers_count = mysql_real_escape_string($tweet->{'user'}->{'followers_count'});
				//We store the new post in the database, to be able to read it later
				$ok = mysql_query("INSERT INTO tweets (id ,text ,screen_name ,followers_count, created_at) VALUES ('$id', '$text', '$screen_name', '$followers_count', NOW())");
				if (!$ok) {echo "Mysql Error: ".mysql_error();}
				flush();
			}
		}
	}
?>
