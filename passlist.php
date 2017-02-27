<?php

$words = array(
    'red',
    'fox',
    'walking',
    'on',
    'the',
    'street',
);

$passwords = array();
array_rand_combine($words, "", ' ', $passwords, 6);
$passwords = implode("\n", $passwords);
file_put_contents('passwords.txt', $passwords);

function array_rand_combine($arr, $temp_string, $connector = '', &$collect, $maxDepth, $deep = 0) {
   $deep++;
   if ($deep > $maxDepth)
      return;
   if ($temp_string != "")
      $collect[] = $temp_string;

   for ($i = 0; $i < sizeof($arr); $i++) {
      $arrcopy = $arr;
      $elem = array_splice($arrcopy, $i, 1);
      if (sizeof($arrcopy) > 0) {

         array_rand_combine($arrcopy, $temp_string . $connector . $elem[0], $connector, $collect, $maxDepth, $deep);
      } else {
         $collect[] = $temp_string . $connector . $elem[0];
      }
   }
}

?>