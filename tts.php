<?php
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
tts("I like poop.  It tastes bad.  The world is mine for the taking and I do what I want sometimes.");
//tts("I'm sexy and I know it", "temp2.mp3");
//file_put_contents('./combined.mp3',
//                  file_get_contents('./temp1.mp3') .
//                  file_get_contents('./temp2.mp3'));
?>