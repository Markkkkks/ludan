<?php


function my_XOR($str1)
{	
   $tmp='';
   $key='67f5ffdeb4ebf31ce2cdc17672e2bb0ab4ebf31ce2cdc176eb';
   for($i=0;$i<strlen($str1);$i++){
    $tmp.=($str1[$i]) ^ ($key[$i]);
   }
   return md5($tmp);
}
?>