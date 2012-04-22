<?php

    include("fancy.php");
include("getTwitter.php");
    /*
    if (!isset($_POST["type"])
        $_POST["type"] = "undefined";
    if (!isset($_POST["input"])
        $_POST["input"] = "undefined";
    */

    $type = $_POST["type"];
    $input = $_POST["input"];

    $result = "";

    /* fancify */
    if (strcmp($type, "fancify") == 0)
    {
        $input_split = explode(" ", $input);
	foreach ($input_split as $word)
	{
	    if (isPunctuation($word) == True || strlen($word) <= 3)
	    {
	        $result .= $word." ";
	    }
	    else
	    {
	        $result .= getFancySynonym($word)." ";
	    }
	}
    }
    /* ghettofy */
    else if (strcmp($type, "ghettofy") == 0)
    {
        $result .= getGangster($input, "pimp"); 
    }
tts($result);
    echo $result;

    function isPunctuation($word)
    {
        if (strcmp($word, ".") == 0
	  || strcmp($word, ",") == 0 
	  || strcmp($word, "!") == 0
	  || strcmp($word, "?") == 0)
	    return True;
	return False;
    }

?>
