<?php
$path = ROOT.'/template/'.config::get('template_dir').'/nav/';
$tagfileList = listDirOne($path, 'html');
$names = array(
    'nav_1.html' => '文字列表',
	'nav_2.html' => '文字列表',
);
$array = array();
foreach($tagfileList as $value){
    $path = str_replace('\\', '/', $path);
    $value = str_replace($path, '', $value);
    if(substr($value,0,4)=='list'){
        $array[$value] = isset($names[$value]) && $names[$value] != '' ? $value.'('.$names[$value].')' : $value;
    }
}
return $array;