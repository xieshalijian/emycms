<?php




/*//判断目录是否存在
if(file_exists(ROOT."/lib/admin/template_.php"))
{
    unlink(ROOT."/lib/admin/template_.php");
}*/


$dirs = [
    realpath(dirname(__FILE__) . '/admin'),
    realpath(dirname(__FILE__) . '/default'),
    realpath(dirname(__FILE__) . '/inc'),
    realpath(dirname(__FILE__) . '/table'),
    realpath(dirname(__FILE__) . '/tool'),
    realpath(dirname(__FILE__) . '/plugins')
];


// 清理缓存
foreach($dirs as $dir) {
    do_rmdir($dir, false);

}

function do_rmdir($dirname, $self = true) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    if ($dir) {
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            do_rmdir($dirname . '/' . $entry);
        }
    }
    $dir->close();
    //$self && rmdir($dirname);
    @rmdir($dirname);

}



$dira = iconv("UTF-8", "GBK", "admin");
if (!file_exists($dira)){
    mkdir ($dira,0777,true);
}

$file='upgrade/admin/index.php'; //旧目录
$newFile='admin/index.php'; //新目录
copy($file,$newFile); //拷贝到新目录

$filea='upgrade/admin/init.php'; //旧目录
$newFilea='admin/init.php'; //新目录
copy($filea,$newFilea); //拷贝到新目录


