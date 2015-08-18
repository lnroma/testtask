<?php
/**
 * this variable include modules config
 */
$modules = array();
$controllers = array();

// routing  controllerName => moduleName
//this default controllers value
$controllers['default'] = 'Shapes';
//this section set for routing key this controller parameters and value is Code pool name
$controllers['shapes'] = 'Shapes';
// this section declaration enable modules on system
$modules[] = array (
    'name' => 'Shapes',
);