<?php 
function notEmpty($arg){
   //echo "<li>notEmpty instantitated! with argument=".$arg."<br>";
   $response = array(
   				'Error'=>True,
   				'ErrorMsg'=>'00001'
   				);
   return $response;
}
function character($arg, $arg2, $arg3)
{
    echo "arg1= ".$arg."arg2 ".$arg2."arg3 ".$arg3."<br>";
}
function isNumber($arg1, $arg2)
{

    echo "arg1= ".$arg1."arg2 ".$arg2."<br>";
}