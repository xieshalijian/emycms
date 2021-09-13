<?php
$path = ROOT . '/template/' . config::get('template_dir') . '/visual/list/listcommenttag';
$list = front::buyscan($path
);
$names = array(
    'list.html' => '评论列表',

);
$array = array(
);
if (is_array($list) && !empty($list)) {
    foreach ($list as $t) {
        if (!strpos($t, '.')) {
            $array[$t] = $names[$t . '.html'];
        }
    }
}
return $array;