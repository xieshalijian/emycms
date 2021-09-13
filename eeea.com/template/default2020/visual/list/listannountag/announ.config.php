<?php
$path = ROOT.'/template/'.config::get('template_dir').'/visual/list/listannountag';
$list = front::buyscan($path
);
$names = array(
    'list.html' => '公告列表',
    'swiper-auunou.html' => '滚动公告',

);
$array = array(
);
if (is_array($list) && !empty($list)) {
    foreach ($list as $t) {
        if(!strpos($t,'.')){
            $array[$t] =$names[$t.'.html'];
        }
    }
}
return $array;