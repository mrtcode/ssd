<?php

$tryNr = 0;

$handle = fopen("passwords.txt", "r");
if ($handle) {
   while (($line = fgets($handle)) !== false) {
      // process the line read.
      start:
      $r = tryPassword(str_replace(' ', '', $line));
      if ($r == 0)
         goto start;
      else
      if ($r == 1)
         echo "Wrong password" . PHP_EOL;
      else
      if ($r == 5)
         die("Password have been found!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");

      $tryNr++;
      echo $tryNr . PHP_EOL;
   }
} else {
   // error opening the file.
}

function tryPassword($password) {

   echo "Trying password \"$password\"" . PHP_EOL;
   $output = shell_exec("hdparm -I /dev/sdg");

   //$output=implode("\n",$output);
   //echo $output;

   if (strstr($op, "expired: security count")) {

      if (strstr($op, "not  expired: security count")) {
         echo "OKOKOK" . PHP_EOL;
      } else {
         exec('./impulse');
         return 0;
      }
   } else {
      return 0;
   }

   $op = shell_exec("hdparm --user-master u --security-unlock " . escapeshellarg($password) . " /dev/sdg 2>&1");
   //var_dump($op);

   if (strstr($op, "PASSWD too long (must be 32 chars max)")) {
      return 1;
   }

   if (!strstr($op, "SECURITY_UNLOCK: Input/output error")) {
      return 5;
   }

   if (!strstr($op, "Issuing SECURITY_UNLOCK command, password")) {
      return 0;
   }

   return 1;
}

?>