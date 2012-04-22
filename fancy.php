<?php
$api_key = "96538a1e361c4143a3d6c782b8667fc0";
$api_request = "http://words.bighugelabs.com/api/2/96538a1e361c4143a3d6c782b8667fc0/";
function callThesaurus($word)
{
     $api_request = "http://words.bighugelabs.com/api/2/96538a1e361c4143a3d6c782b8667fc0/";

     $request = $api_request.$word."/php";
     $data = file_get_contents($request);
     return unserialize($data);

}

//gets the fanciest/longest synonym
function getFancySynonym($word)
{
     $data = callThesaurus($word);
     $pos = array_keys($data);
     $syn = array();
     foreach($data as $key => $value)
     {
          if (array_key_exists('syn', $value))
               $syn = array_merge($value['syn'],$syn);
     }
     if($syn)
     {
          $index = array_rand($syn, 1);
          return ($syn[$index]);
     }
     else
          return $word;
}

//gets the fanciest/longest antonym
function getFancyAnt($word)
{
     $data = callThesaurus($word);
     $pos = array_keys($data);
     $ant = array();

     foreach($data as $key => $value)
     {
          if (array_key_exists('ant', $value))
               $ant = array_merge($value['ant'],$ant);
     }
     if ($ant)
     {
          $index = array_rand($ant, 1);
          return ($ant[$index]);
     }
     else
          return $word;
}

function getGangster($sentence, $mode)
{
     $file = "info.html";
     $fhandle = fopen($file, 'w') or die("cannot open file\n");
     fwrite($fhandle, "<html><body>".$sentence."</body></html>");
     fclose($fhandle);
     $query = "http://www.psyclops.com/translator/translator.cgi?url=http%3A%2F%2Fruslug.rutgers.edu%2F~jeshuang%2Fhackru2012%2Finfo.html&mode=".$mode;
     $data = file_get_contents($query);
     $front = strpos($data, "<bod");
     $end = strpos($data, "</bod");
     $result = substr($data, $front+7, $end-$front-7);
     print_r($result);
}

getGangster("testing out this function.  This is my world, and I want to do my own thing.  Mr. Satterfield is hacking some code tonight at a hackathon", "pimp");
//echo getFancySynonym("bat")."\n";
//print_r(callThesaurus("angry"));
?>
