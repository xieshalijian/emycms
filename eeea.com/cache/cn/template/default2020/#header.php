<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="CmsEasy 7_7_5_20210905_UTF8" />
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo getTitle(isset($archive)?$archive:"",isset($category)?$category:"",isset($catid)?$catid:"",isset($type)?$type:"",isset($special)?$special:"",isset($tags)?$tags:"",isset($announ)?$announ:"");?></title>
    <?php if(get('mobile_open')=='1') { ?><script type="text/javascript">var cmseasy_wap_tpa=1,cmseasy_wap_tpb=1,cmseasy_wap_url='<?php echo get("wap_domain");?>/wap';</script>
    <script src="<?php echo $base_url;?>/common/plugins/wap-distinguish/mobile.js" type="text/javascript"></script><?php } ?>
    <meta name="keywords" content="<?php echo getKeywords(isset($archive)?$archive:'',isset($category)?$category:'',isset($catid)?$catid:'',isset($type)?$type:'',isset($special)?$special:'',isset($tags)?$tags:'');?>" />
<meta name="description" content="<?php echo getDescription(isset($archive)?$archive:'',isset($category)?$category:'',isset($catid)?$catid:'',isset($type)?$type:'',isset($special)?$special:'',isset($tags)?$tags:'');?>" />
    <meta name="author" content="CmsEasy Team" />
    <link rel="icon" href="<?php echo get('site_ico');?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get('site_ico');?>" type="image/x-icon" />
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap-submenu.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/plugins/swiper/css/swiper.min.css" rel="stylesheet" >
    <link href="<?php echo $skin_path;?>/css/base.css?version=<?php echo _VERCODE;?>" rel="stylesheet">
    <link href="<?php echo $skin_path;?>/css/style.css" rel="stylesheet">
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js"></script>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery-migrate.min.js"></script>
    <script src="<?php echo $base_url;?>/common/plugins/swiper/js/swiper.min.js"></script>
    <?php echo template_public('common/plugins/public/header-js.html'); ?>

</head>
<?php if(get('shield_right_key')=='1') { ?>
<body oncontextmenu="return false" onselectstart="return false">
<noscript><iframe src="/*.html>";</iframe></noscript>
<script type="text/javascript">
    <!--
    function stop(){
        return false;
    }
    document.oncontextmenu=stop;
    //-->
</script>
<?php } else { ?>
<body>
<?php } ?>

<?php echo template('top.html'); ?>






<style name="body_background_color">body {background-color: #ffffff;}</style>