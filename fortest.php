<?php 
 $c = [
          [
              [
                'key' => 'tst'
              ]
              [
                'key2' => 'test'
              ]
          ]
 ];
 
function user_f($c) { 
  $result = isset($c[0][0]['key']) ? true : false;
  if(isset($c[0][0]['key2'])) 
//     return $result;
  return false;
}
 
var_dump(user_f($c)); 
 
