<?php
$path = ROOT . '/template/' . config::get('template_dir') . '/visual/list/listtag';
$list = front::buyscan($path
);
$names = array(
    'list.html' => '文字列表',
    'list_ditu.html' => '百度地图',
    'list_down.html' => '下载列表',
    'list_history.html' => '历程列表',
    'list_job.html' => '招聘列表',
    'list_loop.html' => '子栏目内容列表',
    'list_loop_pic.html' => '子栏目图列表',
    'list_page.html' => '栏目单页',
    'list_pic.html' => '图片列表',
    'list_pic_a.html' => '图片列表',
    'list_products.html' => '商品列表',
    'list_text.html' => '文字描述列表',
    'list_text_pic.html' => '图片文字描述列表',

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