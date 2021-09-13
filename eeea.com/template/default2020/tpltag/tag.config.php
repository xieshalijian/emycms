<?php
$path = ROOT . '/template/' . config::get('template_dir') . '/tpltag/';
$tagfileList = listDirOne($path, 'html');
$categoryarray = $contentarray = $specialarray = $typearray = array();
foreach ($tagfileList as $value) {
    $path = str_replace('\\', '/', $path);
    $value = str_replace($path, '', $value);
    if (substr($value, 0, 11) == 'tag_content') {
        $contentarray[$value] = $value;
    }
    if (substr($value, 0, 12) == 'tag_category') {
        $categoryarray[$value] = $value;
    }
    if (substr($value, 0, 11) == 'tag_special') {
        $specialarray[$value] = $value;
    }
    if (substr($value, 0, 8) == 'tag_type') {
        $typearray[$value] = $value;
    }
    if (substr($value, 0, 16) == 'tag_announcement') {
        $announcementarray[$value] = $value;
    }
}
return array(
    'content' => $contentarray,
    'category' => $categoryarray,
    'special' => $specialarray,
    'type' => $typearray,
    'announcement' => $announcementarray,
);
?>