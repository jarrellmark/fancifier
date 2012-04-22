<?php
$api_key = "96538a1e361c4143a3d6c782b8667fc0";
$api_request = "http://words.bighugelabs.com/api/2/96538a1e361c4143a3d6c782b8667fc0/";

function tts($sentence)
{
     $fragment = array();
     $tmp = explode(" ",$sentence); 
     $tmp_ = ""; 
     $last_word = "";
     foreach ($tmp as $value) { 
          $tmp_.= "$value "; 
          $last_word = $value;
          if (strlen($tmp_) > 100) { 
               $last_tmp_.= ""; 
               array_push($fragment, $last_tmp_);
               $tmp_ = $last_word." ";
               $last_tmp_ = "";               
          } 
          $last_tmp_ = $tmp_; 
     } 
     array_push($fragment, $last_tmp_);
     foreach ($fragment as &$value)
     {
          $value = str_replace(" ","+",$value);
     }

//     $sentence = str_replace(" ","+",$sentence);
     $name = 0;
     foreach($fragment as $value)
     {
          $url = "http://translate.google.com/translate_tts?tl=en&q=".$value;
          if ($name == 0)
               $fp = fopen("./combined.mp3","w");
          else
               $fp = fopen("./temp".$name.".mp3","w");
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_FILE, $fp);
          $data = curl_exec($ch);
          curl_close($ch);
          fclose($fp);
          
          file_get_contents($url) or die("oops\n");
          $name++;
     }
     $count = 1;
     while ($count < $name)
     {
          file_put_contents('./combined.mp3',
                            file_get_contents('./combined.mp3') .
                            file_get_contents('./temp'.$count.'.mp3'));
          $count++;
     }
     $count = 1;
     while ($count < $name)
     {
          unlink("./temp".$count.".mp3");
          $count++;
     }
}


function callThesaurus($word)
{
     $api_request = "http://words.bighugelabs.com/api/2/96538a1e361c4143a3d6c782b8667fc0/";

     $request = $api_request.$word."/php";
     $data = @file_get_contents($request);
     if (strlen($data) == 0)
     {
        return NULL;
     }
     return unserialize($data);

}

//gets the fanciest/longest synonym
function getFancySynonym($word)
{
     $data = callThesaurus($word);
     if (is_null($data) == TRUE)
     {
         return $word;
     }
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
     $file = "./info.html";
     $fhandle = fopen($file, 'w') or die("cannot open file\n");
     fwrite($fhandle, "<html><body>".$sentence."</body></html>");
     fclose($fhandle);
     $query = "http://www.psyclops.com/translator/translator.cgi?url=http%3A%2F%2Fruslug.rutgers.edu%2F~jeshuang%2Ff%2Ffancifier%2Finfo.html&mode=".$mode;
//     $query = "http://www.psyclops.com/translator/translator.cgi?url=http%3A%2F%2Fruslug.rutgers.edu%2F~jeshuang%2Ff%2Ffancifier%2Finfo.html&mode=".$mode;
//     $query = "http://www.psyclops.com/translator/translator.cgi?url=http%3A%2F%2Fruslug.rutgers.edu%2Ffancifier%2Finfo.html&mode=".$mode;
     $data = file_get_contents($query);
     $front = strpos($data, "<bod");
     $end = strpos($data, "</bod");
     $result = substr($data, $front+7, $end-$front-7);
     return $result;
}

//echo getFancySynonym("bat")."\n";
//print_r(callThesaurus("angry"));
?>
