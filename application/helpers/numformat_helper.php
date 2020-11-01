<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('numnegative'))
{
   function numnegative($val) 
   {
     if (strstr( $val, '(')) {
         $temp = str_replace("(", "", $val);
         $val = substr($temp, 0, (strlen($temp)-1));
        
         return '-' . $val; 
     }else{
         return $val; 
     }
   }
}