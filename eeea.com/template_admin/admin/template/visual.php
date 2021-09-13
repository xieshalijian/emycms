<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>
        <?php echo lang_admin('visual_editing');?> - <?php echo get('sitename'); ?>
    </title>
    <link rel="stylesheet" href="<?php echo $base_url;?>/common/js/jquery/plugins/jquery-mloading/css/jquery.mloading.css">
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url;?>/common/font/simple/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap-submenu.css" rel="stylesheet">
    <?php if ($tempname=="top" || $tempname=="bottom" ){?>
        <link href="<?php echo $skin_path;?>/css/clear.css" rel="stylesheet">
        <link href="<?php echo $skin_path;?>/css/base.css" rel="stylesheet">
        <link href="<?php echo $skin_path;?>/css/style.css?version=<?php echo _VERCODE;?>" rel="stylesheet">
    <?php } ?>
    <link rel="stylesheet" href="<?php echo $base_url;?>/common/plugins/visual/css/visual.css?version=<?php echo _VERCODE;?>">
    <!-- JavaScript -->
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery.min.js"></script>
    <script src="<?php echo $base_url;?>/common/js/jquery/jquery-migrate.min.js"></script>
    <!--取消图片延迟-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("data-original").replaceAll("src");
        });
        //页面加载进度

        document.onreadystatechange=function(){
            if(document.readyState=="complete"){
                $(".page-loading").fadeOut();
            }
        }

    </script>
</head>
<body style="cursor: auto;" class="edit" name="body">
<div class="page-loading">
    <div id="container">
        <div class="stick"></div>
        <div class="stick"></div>
        <div class="stick"></div>
        <div class="stick"></div>
        <div class="stick"></div>
        <div class="stick"></div>

        <h1>Loading...</h1>
    </div>
</div>
<!-- 边栏展开按钮 -->
<div id="visual-left-btn" href="#tab_1" data-toggle="tab" data-name="load_modules" class="visual-left-btn" style=" <?php if(config::getadmin("open_visual_drag")){ ?>display: block;<?php }else{?>display: none;<?php }?>">
    <div>
        <i class="glyphicon glyphicon-align-justify"></i>
    </div>
</div>
<!-- 边栏展开按钮结束 -->
<!-- 顶部 -->
<div class="container-fluid">
    <div class="visual-top">
        <!-- 选择 -->
        <ul id="menu-layoutit" class="pull-left">
            <li>
                <a class="logo" href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo get('admin_dir',true);?>&site=default">
                    <img src="<?php echo $skin_admin_path;?>/images/logo.png" alt="logo">
                </a>
            </li>
            <li class="dropdown select-template">
                <div class="btn-group nav-operation">
                    <button type="button" class="btn" id="visual-select-template"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo lang_admin('choice');?>：<?php echo $tempname; ?>
                    </button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                                    <span class="caret">
                                    </span>
                        <span class="sr-only">
                                        Toggle Dropdown
                                    </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                        <li>
                            <div class="blank10"></div>
                        </li>
                        <li>
                            <a href="#" data-target="#template-add" data-toggle="modal">
                                <?php echo lang_admin('newly_build');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <li>
                            <a href="#" data-target="#template-copy" data-toggle="modal">
                                <?php echo lang_admin('copy');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <li>
                            <a href="<?php echo url('template/visual/tempname/index-index'); ?>">
                                <?php echo lang_admin('home_page');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <li>
                            <a href="<?php echo url('template/visual/tempname/top'); ?>">
                                <?php echo lang_admin('cotent_page_top');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('template/visual/tempname/bottom'); ?>">
                                <?php echo lang_admin('cotent_page_bottom');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <li>
                            <a href="<?php echo url('template/visual/tempname/top/isshopping/1'); ?>">
                                <?php echo lang_admin('shop_page_top');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('template/visual/tempname/bottom/isshopping/1'); ?>">
                                <?php echo lang_admin('shop_page_bottom');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <!--  <li>
                            <a href="<?php /*echo url('template/visual/tempname/announ-show'); */?>">
                                <?php /*echo lang_admin('announ_template');*/?>
                            </a>
                        </li>-->
                        <li role="separator" class="divider">
                        </li>
                        <?php  if(file_exists(ROOT."/lib/table/guestbook.php")) {?>
                        <li>
                            <a href="<?php echo url('guestbook/index/act/index/url/'.lang::getisadmin()); ?>">
                                <?php echo lang_admin('guestbook_template');?>
                            </a>
                        </li>
                        <?php };?>
                        <li>
                            <a href="<?php echo url('archive/sitemap', true); ?>">
                                <?php echo lang_admin('site_map');?>
                            </a>
                        </li>
                        <li role="separator" class="divider">
                        </li>
                        <li>
                            <div class="blank10"></div>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <select  onchange="setopen_visual_drag(this);" class="form-control select isnav">
                    <option value="1" <?php if(config::getadmin("open_visual_drag")){ ?>selected<?php }?>>
                        <?php echo lang_admin('developer_model');?>
                    </option>
                    <option value="0" <?php if(!config::getadmin("open_visual_drag")){ ?>selected<?php }?>>
                        <?php echo lang_admin('default_model');?>
                    </option>
                </select>
            </li>
            <li class="btn-group visual-top-function">
                <button type="button" class="btn btn-primary" id="button-download-modal"
                        data-target="#downloadModal" role="button" data-toggle="modal">
                    <?php echo lang_admin('inspect');?>
                </button>
                <button class="btn btn-primary" href="#clear" id="clear">
                    <?php echo lang_admin('empty');?>
                </button>
            </li>
            <li>&nbsp;</li>
            <li>
                <a href="#undo" id="undo">
                    <i class="icon-action-undo"></i> <?php echo lang_admin('revoke');?>
                </a>
                &nbsp;&nbsp;
                <a href="#redo" id="redo">
                    <?php echo lang_admin('redo');?> <i class="icon-action-redo"></i>
                </a>
            </li>
        </ul>
        <!-- 文本编辑器 -->
        <ul class='editControls' class="view">
            <div class='btn-group'>
                <a class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo lang_admin('typeface');?>">
                    <i class='glyphicon glyphicon-font'></i> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu setfont font-size-dropdown">
                    <li><a href="#" style="font-family: 微软雅黑;"><?php echo lang_admin('microsoft_yahei');?></a></li>
                    <li><a href="#" style="font-family: 楷体;"><?php echo lang_admin('regular_script');?></a></li>
                    <li><a href="#" style="font-family: 隶书;"><?php echo lang_admin('official_script');?></a></li>
                </ul>
            </div>
            <div class='btn-group'>
                <a  class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo lang_admin('font_size');?>">
                    <i class='glyphicon glyphicon-text-size'></i> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu setfontSize font-size-dropdown">
                    <li><a href="#" rel="1"><font size="1">1</font></a></li>
                    <li><a href="#" rel="2"><font size="2">2</font></a></li>
                    <li><a href="#" rel="3"><font size="3">3</font></a></li>
                    <li><a href="#" rel="4"><font size="4">4</font></a></li>
                    <li><a href="#" rel="5"><font size="5">5</font></a></li>
                    <li><a href="#" rel="6"><font size="6">6</font></a></li>
                    <li><a href="#" rel="7"><font size="7">7</font></a></li>
                </ul>
            </div>
            <div class='btn-group'>
                <a id="setfontColor" class="btn dropdown-toggle" aria-haspopup="true" aria-expanded="false" title="<?php echo lang_admin('color');?>">
                    <i class='glyphicon glyphicon-text-color'></i> <span class="caret"></span>
                </a>
            </div>
            <div class='btn-group'>
                <a class='btn' data-role='bold' href="#"  title="<?php echo lang_admin('thickening');?>"><strong>B</strong></a>
                <a class='btn' data-role='italic' href="#" title="<?php echo lang_admin('italics');?>"><em><strong>I</strong></em></a>
                <a class='btn' data-role='underline' href="#"  title="<?php echo lang_admin('underline');?>"><u><strong>U</strong></u></a>
                <a class='btn' data-role='strikeThrough' href="#"  title="<?php echo lang_admin('strikethrough');?>"><strike><strong>A</strong></strike></a>
            </div>
            <div class='btn-group'>
                <a class='btn' data-role='justifyLeft' href="#" ><i class='glyphicon glyphicon-align-left' title="<?php echo lang_admin('be_at_the_left_side');?>"></i></a>
                <a class='btn' data-role='justifyCenter' href="#" ><i class='glyphicon glyphicon-align-center' title="<?php echo lang_admin('centered');?>"></i></a>
                <a class='btn' data-role='justifyRight' href="#" ><i class='glyphicon glyphicon-align-right' title="<?php echo lang_admin('be_at_the_right');?>"></i></a>
                <a class='btn' data-role='justifyFull' href="#" ><i class='glyphicon glyphicon-align-justify' title="<?php echo lang_admin('alignment_at_both_ends');?>"></i></a>
                <a class='btn' data-role='createLink' href="#" ><i class='glyphicon glyphicon-link' title="<?php echo lang_admin('link');?>"></i></a>
                <a class='btn' data-role='unlink' href="#"  title="<?php echo lang_admin('delete_links');?>"><i class="glyphicon-unlink"></i></a>
            </div>
        </ul>
        <!-- 保存 -->
        <ul class="pull-right navbar-right">
            <li class="visual-save">
                <a href="#" onClick="saveLayout(true);return false;">
                    <?php echo lang_admin('preservation');?>
                </a>
            </li>
            <li class="visual-view">
                <a href="<?php echo url('index/index', false); ?>" target="_blank">
                    <?php echo lang_admin('preview');?>
                </a>
            </li>
            <!--语言切换-->
            <li class="dropdown select-template lang">
                <div class="btn-group nav-operation">
                    <button type="button" class="btn" id="visual-select-template" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo getlangimg(lang::getisadmin());?>" width="20"> <?php echo getlangurlname(lang::getisadmin());?>
                    </button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret">
                                    </span>
                        <span class="sr-only">
                                        Toggle Dropdown
                                    </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                        <li>
                            <div class="blank10"></div>
                        </li>
                        <?php if(is_array(getlang()))
                            foreach(getlang() as $d) { ?>
                                <li>
                                    <a href="<?php echo url('config/setadminlang/visual/1/langurl/'.$d['langurlname']);?>">
                                        <img src="<?php echo $d['langimg'];?>" width="20">
                                        <?php echo $d['langname'];?>
                                    </a>
                                </li>
                            <?php } ?>
                        <li>
                            <a href="<?php echo $base_url;?>/index.php?case=template&act=visual&admin_dir=<?php echo get('admin_dir',true);?>&site=default"  data-dataurlname="<?php echo lang_admin('editorial_language');?>">
                                <span class="icon-note"></span>
                                <?php echo lang_admin('editorial_language');?>
                            </a>
                        </li>
                        <li>
                            <div class="blank10"></div>
                        </li>
                    </ul>
                </div>
            </li>
            <?php if(session::get('ver') != 'corp'){ ?>
                <li>
                    <a class="btn btn-primary" href="https://www.cmseasy.cn/chm/ke-shi-hua-bian-ji/" target="_blank" title="<?php echo lang_admin('online_tutorials');?>" style="padding: 0 10px;">
                        <i class="glyphicon glyphicon-question-sign"></i>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a href="<?php echo url('index/index'); ?>" class="btn btn-primary sign-out">
                    <i class="glyphicon glyphicon-off">
                    </i>
                    <span><?php echo lang_admin('return_to_the_console');?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- 顶部结束 -->
<!-- 边栏 -->
<div id="visual-left" class="visual-left" style=" left: -280px;  <?php if(config::getadmin("open_visual_drag")){ ?>display: block;<?php }else{?>display: none;<?php }?>">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="visual-left-control">
            <div class="i-holder">
                    <span class="mw-m-menu-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
            </div>
            <!-- 布局面板开始 -->
            <ul class="nav nav-tabs visual-left-control-tabs" role="tablist">
                <li class="active nav-tabs-a" role="presentation">
                    <a href="#tab_1" data-toggle="tab" data-name="load_modules" class="tooltipcss" title="<?php echo lang_admin('assembly');?>">
                        <i class="icon-puzzle"></i>
                        <span class="tooltiptext">
                            <?php echo lang_admin('assembly');?>
                        </span>
                    </a>
                </li>
                <li class="nav-tabs-a" role="presentation">
                    <a href="#tab_2" data-toggle="tab" data-name="load_modular" class="tooltipcss"  title="<?php echo lang_admin('modular');?>">
                        <i class="icon-layers"></i>
                        <span class="tooltiptext">
                            <?php echo lang_admin('modular');?>
                        </span>
                    </a>
                </li>
                <li class="nav-tabs-a" role="presentation">
                    <a href="#tab_3" data-toggle="tab" data-name="load_layouts" class="tooltipcss" title="<?php echo lang_admin('layout');?>">
                        <i class="icon-screen-desktop"></i>
                        <span class="tooltiptext">
                            <?php echo lang_admin('layout');?>
                        </span>
                    </a>
                </li>
                <li class="nav-tabs-a" role="presentation">
                    <a href="#tab_4" data-toggle="tab" data-name="load_buymodules" class="tooltipcss" title="<?php echo lang_admin('buymodules_online');?>">
                        <i class="icon-grid"></i>
                        <span class="tooltiptext">
                            <?php echo lang_admin('buymodules_online');?>
                        </span>
                    </a>
                </li>
            </ul>
            <!-- 布局面板结束 -->
        </div>
        <!--点击加载 模块-->
        <script>
            function addmodularhtml(url,dirname,page,divname){
                $.ajax({
                    type: "get",
                    url: url,
                    async: true,
                    data:{"dirname":dirname,"page":page},
                    success: function (data) {
                        $("[name="+divname+"]").after(data);
                        $("[name="+divname+"]").remove();
                        langClass();
                        visual_init();
                        $('[name=index_lading]').attr("style","display: none;");
                    }
                });
            }
            function addmoduleshtml(url,dirname,page,divname,modulesdata){
                $.ajax({
                    type: "post",
                    url: url,
                    async: true,
                    data:{"dirname":dirname,"page":page,"modulesdata":modulesdata},
                    success: function (data) {
                        $("[name="+divname+"]").after(data);
                        $("[name="+divname+"]").remove();
                        langClass();
                        visual_init();
                    }
                });
            }
            //点击加载 模块
            function  load_modular() {
                var htmltrl=$("[name=load_modular]").html().replace(/^(\s|\xA0)+|(\s|\xA0)+$/g, '');
                if (htmltrl==undefined || htmltrl==""){
                    <?php
                    $getmodular=url('template/getmodular/ajax/1');
                    if(front::get('catid')>0){$getmodular.='&catid='.front::get('catid');}
                    if(front::get('aid')>0){$getmodular.='&aid='.front::get('aid');}
                    if(front::get('typeid')>0){$getmodular.='&typeid='.front::get('typeid');}
                    if(front::get('spid')>0){$getmodular.='&spid='.front::get('spid');}

                    if(front::$case == 'archive' && front::$act == 'list') { ?>
                    var categoryhtml='<h5 class="tab_1_h5"><?php echo lang_admin('column_module');?>：</h5>';
                    categoryhtml+='<div class="line"></div><div name="load_modular_category"></div>';
                    $("[name=load_modular]").append(categoryhtml);
                    /*先获取总数量*/
                    var countcategorymodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/category","page":0,"isshopping":<?php echo $isshopping;?>},
                        success: function (data) {
                            countcategorymodular=parseInt(data);
                        }
                    });
                    for (var category_i=1;category_i<=countcategorymodular;category_i++){
                        $("[name=load_modular_category]").append('<div class="lyrow loading" name="load_modular_category_'+category_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/category",category_i,"load_modular_category_"+category_i);
                    }
                    <?php }; ?>
                    <?php   if(front::$case == 'archive' && front::$act == 'show') { ?>
                    var archivehtml='<h5 class="tab_1_h5"><?php echo lang_admin('content_module');?>：</h5>';
                    archivehtml+='<div class="line"></div><div name="load_modular_archive"></div>';
                    $("[name=load_modular]").append(archivehtml);
                    /*先获取总数量*/
                    var countarchivemodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/content","page":0},
                        success: function (data) {
                            countarchivemodular=parseInt(data);
                        }
                    });
                    for (var archive_i=1;archive_i<=countarchivemodular;archive_i++){
                        $("[name=load_modular_archive]").append('<div class="lyrow loading" name="load_modular_archive_'+archive_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/content",archive_i,"load_modular_archive_"+archive_i);
                    }
                    <?php }; ?>
                    <?php  if(file_exists(ROOT."/lib/table/type.php")) {?>
                    <?php   if(front::$case == 'type' && front::$act == 'list') { ?>
                    var typehtml='<h5 class="tab_1_h5"><?php echo lang_admin('type_module');?>：</h5>';
                    typehtml+='<div class="line"></div><div name="load_modular_type"></div>';
                    $("[name=load_modular]").append(typehtml);
                    /*先获取总数量*/
                    var counttypemodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/type","page":0},
                        success: function (data) {
                            counttypemodular=parseInt(data);
                        }
                    });
                    for (var type_i=1;type_i<=counttypemodular;type_i++){
                        $("[name=load_modular_type]").append('<div class="lyrow loading" name="load_modular_type_'+type_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/type",type_i,"load_modular_type_"+type_i);
                    }
                    <?php }; ?>
                    <?php }; ?>
                    <?php  if(file_exists(ROOT."/lib/table/special.php")) {?>
                        <?php   if(front::$case == 'special' && front::$act == 'show' ) { ?>
                        var specialhtml='<h5 class="tab_1_h5"><?php echo lang_admin('special_module');?>：</h5>';
                        specialhtml+='<div class="line"></div><div name="load_modular_special"></div>';
                        $("[name=load_modular]").append(specialhtml);
                        /*先获取总数量*/
                        var countspecialmodular=0;
                        $.ajax({
                            type: "get",
                            url: "<?php echo $getmodular;?>",
                            async: false,
                            data:{"dirname":"sections/special","page":0},
                            success: function (data) {
                                countspecialmodular=parseInt(data);
                            }
                        });
                        for (var special_i=1;special_i<=countspecialmodular;special_i++){
                            $("[name=load_modular_special]").append('<div class="lyrow loading" name="load_modular_special_'+special_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                            addmodularhtml("<?php echo $getmodular;?>","sections/special",special_i,"load_modular_special_"+special_i);
                        }
                        <?php }; ?>
                    <?php }; ?>
                    <?php   if(front::$case == 'guestbook' && front::$act == 'index') { ?>
                    var guestbookhtml='<h5 class="tab_1_h5"><?php echo lang_admin('guestbook_module');?>：</h5>';
                    guestbookhtml+='<div class="line"></div><div name="load_modular_guestbook"></div>';
                    $("[name=load_modular]").append(guestbookhtml);
                    /*先获取总数量*/
                    var countguestbookmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/guestbook","page":0},
                        success: function (data) {
                            countguestbookmodular=parseInt(data);
                        }
                    });
                    for (var guestbook_i=1;guestbook_i<=countguestbookmodular;guestbook_i++){
                        $("[name=load_modular_guestbook]").append('<div class="lyrow loading" name="load_modular_guestbook_'+guestbook_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/guestbook",guestbook_i,"load_modular_guestbook_"+guestbook_i);
                    }
                    <?php }; ?>
                    <?php   if(front::$case == 'comment' && front::$act == 'list') { ?>
                    var commenthtml='<h5 class="tab_1_h5"><?php echo lang_admin('comment_module');?>：</h5>';
                    commenthtml+='<div class="line"></div><div name="load_modular_comment"></div>';
                    $("[name=load_modular]").append(commenthtml);
                    /*先获取总数量*/
                    var countcommentmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/comment","page":0},
                        success: function (data) {
                            countcommentmodular=parseInt(data);
                        }
                    });
                    for (var comment_i=1;comment_i<=countcommentmodular;comment_i++){
                        $("[name=load_modular_comment]").append('<div class="lyrow loading" name="load_modular_comment_'+comment_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/comment",comment_i,"load_modular_comment_"+comment_i);
                    }
                    <?php }; ?>
                    <?php if(preg_match('/^announ-/',$tempname) ||  (front::$case == 'announ' && front::$act == 'show')) { ?>
                    var announhtml='<h5 class="tab_1_h5"><?php echo lang_admin('announ_module');?>：</h5>';
                    announhtml+='<div class="line"></div><div name="load_modular_announ"></div>';
                    $("[name=load_modular]").append(announhtml);
                    /*先获取总数量*/
                    var countannounmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/announ","page":0},
                        success: function (data) {
                            countannounmodular=parseInt(data);
                        }
                    });
                    for (var announ_i=1;announ_i<=countannounmodular;announ_i++){
                        $("[name=load_modular_announ]").append('<div class="lyrow loading" name="load_modular_announ_'+announ_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/announ",announ_i,"load_modular_announ_"+announ_i);
                    }
                    <?php }; ?>
                    var commonHtml='<h5 class="tab_1_h5"><?php echo lang_admin('global_module');?>：</h5>';
                    commonHtml+='<div class="line"></div><div name="load_modular_common"></div>';
                    $("[name=load_modular]").append(commonHtml);
                    /*先获取总数量*/
                    var countcommonmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo $getmodular;?>",
                        async: false,
                        data:{"dirname":"sections/common","page":0},
                        success: function (data) {
                            countcommonmodular=parseInt(data);
                        }
                    });
                    for (var common_i=1;common_i<=countcommonmodular;common_i++){
                        $("[name=load_modular_common]").append('<div class="lyrow loading" name="load_modular_common_'+common_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo $getmodular;?>","sections/common",common_i,"load_modular_common_"+common_i);
                    }
                    $("[name=load_modular]").append('<div class="blank30"> </div>');
                }
            }
            //点击加载 布局
            function  load_layouts() {
                var htmltrl=$("[name=load_layouts]").html().replace(/^(\s|\xA0)+|(\s|\xA0)+$/g, '');
                if (htmltrl==undefined || htmltrl==""){
                    $("[name=load_layouts]").html('<div class="index-lading" name="index_lading" style="display: block;">\n' +
                        '    <div class="loadEffect">\n' +
                        '        <div><span></span></div>\n' +
                        '        <div><span></span></div>\n' +
                        '        <div><span></span></div>\n' +
                        '        <div><span></span></div>\n' +
                        '    </div>\n' +
                        '</div>');
                    var layoutshtml='<h5 class="tab_1_h5"><?php echo lang_admin('layout');?>：</h5>';
                    layoutshtml+='<div class="line"></div><div name="load_layouts_layouts"></div>';
                    $("[name=load_layouts]").append(layoutshtml);
                    /*先获取总数量*/
                    var countlayoutsmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>",
                        async: false,
                        data:{"dirname":"layouts/common","page":0},
                        success: function (data) {
                            countlayoutsmodular=parseInt(data);
                        }
                    });
                    for (var layouts_i=1;layouts_i<=countlayoutsmodular;layouts_i++){
                        $("[name=load_layouts_layouts]").append('<div class="lyrow loading" name="load_layouts_layouts_'+layouts_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo  url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>","layouts/common",layouts_i,"load_layouts_layouts_"+layouts_i);
                    }
                    var columnshtml='<div class="blank15"></div><h5 class="tab_1_h5"><?php echo lang_admin('columns');?>：</h5>';
                    columnshtml+='<div class="line"></div><div name="load_layouts_columns"></div>';
                    $("[name=load_layouts]").append(columnshtml);
                    /*先获取总数量*/
                    var countcolumnsmodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>",
                        async: false,
                        data:{"dirname":"layouts/columns","page":0},
                        success: function (data) {
                            countcolumnsmodular=parseInt(data);
                        }
                    });
                    for (var columns_i=1;columns_i<=countcolumnsmodular;columns_i++){
                        $("[name=load_layouts_columns]").append('<div class="lyrow loading" name="load_layouts_columns_'+columns_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo  url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>","layouts/columns",columns_i,"load_layouts_columns_"+columns_i);
                    }
                    var customhtml='<div class="blank15"></div><h5 class="tab_1_h5"><?php echo lang_admin('custom_columns');?>：</h5>';
                    customhtml+='<div class="line"></div><div name="load_layouts_custom"></div>';
                    $("[name=load_layouts]").append(customhtml);
                    /*先获取总数量*/
                    var countcustommodular=0;
                    $.ajax({
                        type: "get",
                        url: "<?php echo url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>",
                        async: false,
                        data:{"dirname":"layouts/custom","page":0},
                        success: function (data) {
                            countcustommodular=parseInt(data);
                        }
                    });
                    for (var custom_i=1;custom_i<=countcustommodular;custom_i++){
                        $("[name=load_layouts_custom]").append('<div class="lyrow loading" name="load_layouts_custom_'+custom_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmodularhtml("<?php echo  url('template/getlayouts/ajax/1/isshopping/'.$isshopping);?>","layouts/custom",custom_i,"load_layouts_custom_"+custom_i);
                    }
                }
            }
            //点击加载  组件
            function  load_modules() {
                var modulesdata=<?php echo json_encode($returndata['modulesdata']);?>;
                var htmltrl=$("[name=load_modules]").html().replace(/^(\s|\xA0)+|(\s|\xA0)+$/g, '');
                if (htmltrl==undefined || htmltrl==""){
                    <?php
                    $getmodulesurl=url('template/getmodules/ajax/1/isshopping/'.$isshopping);
                    if(front::get('catid')>0){$getmodulesurl.='&catid='.front::get('catid');}
                    if(front::get('aid')>0){$getmodulesurl.='&aid='.front::get('aid');}
                    if(front::get('typeid')>0){$getmodulesurl.='&typeid='.front::get('typeid');}
                    if(front::get('spid')>0){$getmodulesurl.='&spid='.front::get('spid');}
                    if(front::$case == 'archive' && front::$act == 'list') { ?>
                    var categoryhtml='<h5 class="tab_1_h5"><?php echo lang_admin('column_component');?>：</h5>';
                    categoryhtml+='<div class="line"></div><div name="load_modules_category"></div>';
                    $("[name=load_modules]").append(categoryhtml);
                    /*先获取总数量*/
                    var countcategorymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/category","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcategorymodules=parseInt(data);
                        }
                    });
                    for (var category_i=1;category_i<=countcategorymodules;category_i++){
                        $("[name=load_modules_category]").append('<div class="lyrow loading" name="load_modules_category_'+category_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/category",category_i,"load_modules_category_"+category_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(front::$case == 'archive' && front::$act == 'show') { ?>
                    var contenthtml='<h5 class="tab_1_h5"><?php echo lang_admin('content_components');?>：</h5>';
                    contenthtml+='<div class="line"></div><div name="load_modules_content"></div>';
                    $("[name=load_modules]").append(contenthtml);
                    /*先获取总数量*/
                    var countcontentmodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/content","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcontentmodules=parseInt(data);
                        }
                    });
                    for (var content_i=1;content_i<=countcontentmodules;content_i++){
                        $("[name=load_modules_content]").append('<div class="lyrow loading" name="load_modules_content_'+content_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/content",content_i,"load_modules_content_"+content_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php  if(file_exists(ROOT."/lib/table/type.php")) {?>
                      <?php   if(front::$case == 'type' && front::$act == 'list') { ?>
                    var typehtml='<h5 class="tab_1_h5"><?php echo lang_admin('type_component');?>：</h5>';
                    typehtml+='<div class="line"></div><div name="load_modules_type"></div>';
                    $("[name=load_modules]").append(typehtml);
                    /*先获取总数量*/
                    var counttypemodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/type","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            counttypemodules=parseInt(data);
                        }
                    });
                    for (var type_i=1;type_i<=counttypemodules;type_i++){
                        $("[name=load_modules_type]").append('<div class="lyrow loading" name="load_modules_type_'+type_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/type",type_i,"load_modules_type_"+type_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php }  ?>
                    <?php  if(file_exists(ROOT."/lib/table/special.php")) {?>
                        <?php   if(front::$case == 'special' && front::$act == 'show') { ?>
                            var specialhtml='<h5 class="tab_1_h5"><?php echo lang_admin('special_component');?>：</h5>';
                            specialhtml+='<div class="line"></div><div name="load_modules_special"></div>';
                            $("[name=load_modules]").append(specialhtml);
                            /*先获取总数量*/
                            var countspecialmodules=0;
                            $.ajax({
                                type: "post",
                                url: "<?php echo $getmodulesurl;?>",
                                async: false,
                                data:{"dirname":"modules/special","page":0,"modulesdata":modulesdata},
                                success: function (data) {
                                    countspecialmodules=parseInt(data);
                                }
                            });
                            for (var special_i=1;special_i<=countspecialmodules;special_i++){
                                $("[name=load_modules_special]").append('<div class="lyrow loading" name="load_modules_special_'+special_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                                addmoduleshtml("<?php echo $getmodulesurl;?>","modules/special",special_i,"load_modules_special_"+special_i,modulesdata);
                            }
                        <?php }  ?>
                    <?php }  ?>
                    <?php   if(front::$case == 'guestbook' && front::$act == 'index') { ?>
                    var guestbookhtml='<h5 class="tab_1_h5"><?php echo lang_admin('guestbook_component');?>：</h5>';
                    guestbookhtml+='<div class="line"></div><div name="load_modules_guestbook"></div>';
                    $("[name=load_modules]").append(guestbookhtml);
                    /*先获取总数量*/
                    var countguestbookmodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/guestbook","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countguestbookmodules=parseInt(data);
                        }
                    });
                    for (var guestbook_i=1;guestbook_i<=countguestbookmodules;guestbook_i++){
                        $("[name=load_modules_guestbook]").append('<div class="lyrow loading" name="load_modules_guestbook_'+guestbook_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/guestbook",guestbook_i,"load_modules_guestbook_"+guestbook_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(preg_match('/^comment-/',$tempname)) {  ?>
                    var commenthtml='<h5 class="tab_1_h5"><?php echo lang_admin('comment_component');?>：</h5>';
                    commenthtml+='<div class="line"></div><div name="load_modules_comment"></div>';
                    $("[name=load_modules]").append(commenthtml);
                    /*先获取总数量*/
                    var countcommentmodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/comment","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcommentmodules=parseInt(data);
                        }
                    });
                    for (var comment_i=1;comment_i<=countcommentmodules;comment_i++){
                        $("[name=load_modules_comment]").append('<div class="lyrow loading" name="load_modules_comment_'+comment_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/comment",comment_i,"load_modules_comment_"+comment_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php if(preg_match('/^announ-/',$tempname)) {  ?>
                    var announhtml='<h5 class="tab_1_h5"><?php echo lang_admin('announ_component');?>：</h5>';
                    announhtml+='<div class="line"></div><div name="load_modules_announ"></div>';
                    $("[name=load_modules]").append(announhtml);
                    /*先获取总数量*/
                    var countannounmodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/announ","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countannounmodules=parseInt(data);
                        }
                    });
                    for (var announ_i=1;announ_i<=countannounmodules;announ_i++){
                        $("[name=load_modules_announ]").append('<div class="lyrow loading" name="load_modules_announ_'+announ_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/announ",announ_i,"load_modules_announ_"+announ_i,modulesdata);
                    }
                    <?php }  ?>
                    <!-- 组件结束 -->
                    var commonhtml='<h5 class="tab_1_h5"><?php echo lang_admin('global_components');?>：</h5>';
                    commonhtml+='<div class="line"></div><div name="load_modules_common"></div>';
                    $("[name=load_modules]").append(commonhtml);
                    /*先获取总数量*/
                    var countcommonmodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getmodulesurl;?>",
                        async: false,
                        data:{"dirname":"modules/common","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcommonmodules=parseInt(data);
                        }
                    });
                    for (var common_i=1;common_i<=countcommonmodules;common_i++){
                        $("[name=load_modules_common]").append('<div class="lyrow loading" name="load_modules_common_'+common_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getmodulesurl;?>","modules/common",common_i,"load_modules_common_"+common_i,modulesdata);
                    }
                    $("[name=modules_lading]").append('<div class="blank30"> </div>');
                }
            }
            //点击加载  市场组件
            <?php if($returndata['static']) { ?>
            function  load_buymodules() {
                var modulesdata=<?php echo json_encode($returndata['modulesdata']);?>;
                var htmltrl=$("[name=load_buymodules]").html().replace(/^(\s|\xA0)+|(\s|\xA0)+$/g, '');
                if (htmltrl==undefined || htmltrl==""){
                    <?php    $getbuymodulesurl=url('template/getbuymodules/ajax/1');
                    if(front::get('catid')>0){$getbuymodulesurl.='&catid='.front::get('catid');}
                    if(front::get('aid')>0){$getbuymodulesurl.='&aid='.front::get('aid');}
                    if(front::get('typeid')>0){$getbuymodulesurl.='&typeid='.front::get('typeid');}
                    if(front::get('spid')>0){$getbuymodulesurl.='&spid='.front::get('spid');}
                    if(front::$case == 'archive' && front::$act == 'list') { ?>
                    var categoryhtml='<h5 class="tab_1_h5"><?php echo lang_admin('column_component');?>：</h5>';
                    categoryhtml+='<div class="line"></div><div name="load_buymodules_category"></div>';
                    $("[name=load_buymodules]").append(categoryhtml);
                    /*先获取总数量*/
                    var countcategorybuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/category","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcategorybuymodules=parseInt(data);
                        }
                    });
                    for (var category_i=1;category_i<=countcategorybuymodules;category_i++){
                        $("[name=load_buymodules_category]").append('<div class="lyrow loading" name="load_buymodules_category_'+category_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/category",category_i,"load_buymodules_category_"+category_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(front::$case == 'archive' && front::$act == 'show') { ?>
                    var contenthtml='<h5 class="tab_1_h5"><?php echo lang_admin('content_components');?>：</h5>';
                    contenthtml+='<div class="line"></div><div name="load_buymodules_content"></div>';
                    $("[name=load_buymodules]").append(contenthtml);
                    /*先获取总数量*/
                    var countcontentbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/content","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcontentbuymodules=parseInt(data);
                        }
                    });
                    for (var content_i=1;content_i<=countcontentbuymodules;content_i++){
                        $("[name=load_buymodules_content]").append('<div class="lyrow loading" name="load_buymodules_content_'+content_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/content",content_i,"load_buymodules_content_"+content_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(front::$case == 'type' && front::$act == 'list') { ?>
                    var typehtml='<h5 class="tab_1_h5"><?php echo lang_admin('type_component');?>：</h5>';
                    typehtml+='<div class="line"></div><div name="load_buymodules_type"></div>';
                    $("[name=load_buymodules]").append(typehtml);
                    /*先获取总数量*/
                    var counttypebuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/type","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            counttypebuymodules=parseInt(data);
                        }
                    });
                    for (var type_i=1;type_i<=counttypebuymodules;type_i++){
                        $("[name=load_buymodules_type]").append('<div class="lyrow loading" name="load_buymodules_type_'+type_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/type",type_i,"load_buymodules_type_"+type_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(front::$case == 'special' && front::$act == 'show') { ?>
                    var specialhtml='<h5 class="tab_1_h5"><?php echo lang_admin('special_component');?>：</h5>';
                    specialhtml+='<div class="line"></div><div name="load_buymodules_special"></div>';
                    $("[name=load_buymodules]").append(specialhtml);
                    /*先获取总数量*/
                    var countspecialbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/special","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countspecialbuymodules=parseInt(data);
                        }
                    });
                    for (var special_i=1;special_i<=countspecialbuymodules;special_i++){
                        $("[name=load_buymodules_special]").append('<div class="lyrow loading" name="load_buymodules_special_'+special_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/special",special_i,"load_buymodules_special_"+special_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php   if(front::$case == 'guestbook' && front::$act == 'index') { ?>
                    var guestbookhtml='<h5 class="tab_1_h5"><?php echo lang_admin('guestbook_component');?>：</h5>';
                    guestbookhtml+='<div class="line"></div><div name="load_buymodules_guestbook"></div>';
                    $("[name=load_buymodules]").append(guestbookhtml);
                    /*先获取总数量*/
                    var countguestbookbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/guestbook","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countguestbookbuymodules=parseInt(data);
                        }
                    });
                    for (var guestbook_i=1;guestbook_i<=countguestbookbuymodules;guestbook_i++){
                        $("[name=load_buymodules_guestbook]").append('<div class="lyrow loading" name="load_buymodules_guestbook_'+guestbook_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/guestbook",guestbook_i,"load_buymodules_guestbook_"+guestbook_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php  if(preg_match('/^comment-/',$tempname)) { ?>
                    var commenthtml='<h5 class="tab_1_h5"><?php echo lang_admin('comment_component');?>：</h5>';
                    commenthtml+='<div class="line"></div><div name="load_buymodules_comment"></div>';
                    $("[name=load_buymodules]").append(commenthtml);
                    /*先获取总数量*/
                    var countcommentbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/comment","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcommentbuymodules=parseInt(data);
                        }
                    });
                    for (var comment_i=1;comment_i<=countcommentbuymodules;comment_i++){
                        $("[name=load_buymodules_comment]").append('<div class="lyrow loading" name="load_buymodules_comment_'+comment_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/comment",comment_i,"load_buymodules_comment_"+comment_i,modulesdata);
                    }
                    <?php }  ?>
                    <?php if(preg_match('/^announ-/',$tempname)) { ?>
                    var announhtml='<h5 class="tab_1_h5"><?php echo lang_admin('announ_component');?>：</h5>';
                    announhtml+='<div class="line"></div><div name="load_buymodules_announ"></div>';
                    $("[name=load_buymodules]").append(announhtml);
                    /*先获取总数量*/
                    var countannounbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/announ","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countannounbuymodules=parseInt(data);
                        }
                    });
                    for (var announ_i=1;announ_i<=countannounbuymodules;announ_i++){
                        $("[name=load_buymodules_announ]").append('<div class="lyrow loading" name="load_buymodules_announ_'+announ_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/announ",announ_i,"load_buymodules_announ_"+announ_i,modulesdata);
                    }
                    <?php }  ?>
                    <!-- 组件结束 -->
                    var commonhtml='<h5 class="tab_1_h5"><?php echo lang_admin('global_components');?>：</h5>';
                    commonhtml+='<div class="line"></div><div name="load_buymodules_common"></div>';
                    $("[name=load_buymodules]").append(commonhtml);
                    /*先获取总数量*/
                    var countcommonbuymodules=0;
                    $.ajax({
                        type: "post",
                        url: "<?php echo $getbuymodulesurl;?>",
                        async: false,
                        data:{"dirname":"buymodules/common","page":0,"modulesdata":modulesdata},
                        success: function (data) {
                            countcommonbuymodules=parseInt(data);
                        }
                    });
                    for (var common_i=1;common_i<=countcommonbuymodules;common_i++){
                        $("[name=load_buymodules_common]").append('<div class="lyrow loading" name="load_buymodules_common_'+common_i+'" > <img src="<?php echo $base_url;?>\\common\\plugins\\visual\\images\\loading.gif" width="50"></div>');
                        addmoduleshtml("<?php echo $getbuymodulesurl;?>","buymodules/common",common_i,"load_buymodules_common_"+common_i,modulesdata);
                    }
                }
            }
            <?php } ?>
        </script>
        <!-- 库开始 -->
        <div class="visual-left-content">
            <!-- 组件开始 -->
            <div class="tab-content" id="tab_content">
                <div role="tabpanel" class="tab-pane active" id="tab_1">
                    <div class="row-fluid">
                        <div class="padding-10" name="load_modules">
                        </div>
                        <div class="blank60"></div>
                        <div class="blank30"></div>
                    </div>
                </div>
                <!-- 组件结束 -->
                <!-- 模块开始 -->
                <div role="tabpanel" class="tab-pane" id="tab_2">
                    <div class="row-fluid">
                        <div class="padding-10" name="load_modular">
                        </div>
                        <div class="blank60"></div>
                        <div class="blank30"></div>
                    </div>
                </div>
                <!-- 模块结束 -->
                <!-- 布局开始 -->
                <div class="tab-pane" id="tab_3">
                    <div class="padding-10">
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('全局背景');?>：
                        </h5>
                        <div class="line"></div>
                        <a title="<?php echo lang_admin('全局背景');?>" name="template-body-config" role="button">
                            <img src="<?php echo $skin_admin_path;?>/images/body.png">
                        </a>
                        <!-- 标签弹出框 -->
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('[name=template-body-config]').click(function() {
                                    $('.frmbody #color_body_bg_btn').val(currBody.css('background-color')!='rgba(0, 0, 0, 0)'?currBody.css('background-color'):'');
                                    $('#template-body-config').modal('show');
                                });
                            });
                        </script>
                        <div class="blank15"></div>
                        <!-- 布局栅格开始 -->
                        <div name="load_layouts"></div>
                        <!-- 布局栅格结束 -->
                        <div class="line"></div>
                        <p style="color:#d6d6d6;">
                            <?php echo lang_admin('you_can_input_raster_numbers_in_the_input_box_the_numbers_are_spaced_by_spaces_and_can_be_filled_with_12_integers');?>
                        </p>
                        <div class="line"></div>
                        <div class="alert alert-danger" role="alert"><span
                                    class="glyphicon glyphicon-warning-sign"></span> <strong><?php echo lang_admin('tips');?>：</strong>
                            <?php echo lang_admin('all_typesetting_content_must_be_placed_in_a_wide_screen_or_box');?>
                        </div>
                        <div class="blank60"></div>
                        <div class="blank30"></div>
                    </div>
                </div>
                <!-- 布局结束 -->
                <!--组件市场开始-->
                <div role="tabpanel" class="tab-pane" id="tab_4">
                    <div class="row-fluid">
                        <div class="padding-10">
                            <?php if($returndata['static']) { ?>
                                <div class="text-center" style="color:#fff;">
                                    <?php echo $returndata['userdata']['username'];?> | <span style="color:#ff9149">￥<?php echo $returndata['userdata']['menoy'];?></span>
                                    <div class="blank10"></div>
                                    <a class="btn btn-primary" href="<?php echo $base_url;?>/index.php?admin_dir=<?php echo config::getadmin('admin_dir',true);?>&site=default&gotoinurl=expansion/buymodules"
                                       target="_blank" ><?php echo lang_admin('buy');?></a>
                                    <a class="btn btn-success"  href="javascript:void(0);" name="buy_usermenoy" ><?php echo lang_admin('recharge');?></a>
                                    <a class="btn btn-gray"  href="<?php echo url('app/close/visual/1',true);?>" ><?php echo lang_admin('sign_out');?></a>
                                </div>
                                <div class="blank30"></div>
                                <div name="load_buymodules">
                                </div>
                            <?php } else { ?>
                                <div class="visual-login">
                                    <a class="btn btn-default" data-toggle="modal" data-target="#myDownloadfileModal" ><?php echo lang_admin('login');?></a>
                                    <a class="btn btn-success"  target="_blank"  href="https://u.cmseasy.cn/index.php?case=user&act=register" ><?php echo lang_admin('register');?></a>
                                    <div class="blank30"></div>
                                    <p class="tips">
                                        <i class="icon-info"></i>   <?php echo lang_admin('please_official_website_login');?>
                                    </p>
                                </div>
                            <?php } ?>
                            <div class="blank60"></div>
                            <div class="blank30"></div>
                        </div>
                    </div>
                    <div class="blank60"></div>
                </div>
                <!--组件市场结束-->
            </div>
        </div>
        <!-- 库结束 -->
    </div>
</div>
<!-- 边栏结束 -->
<!-- 校验服务端登陆Modal -->
<div class="modal fade" id="myDownloadfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                   <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('login');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-user"></i></span>
                    <input type="text" name="app_username" id="app_username" value="" class="form-control" placeholder="<?php echo lang_admin('account_number');?>">
                </div>
                <div class="blank20"></div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                    <input type="password" name="app_passwrod" id="app_passwrod" value="" class="form-control" placeholder="<?php echo lang_admin('password');?>">
                </div>
            </div>
            <div class="modal-footer">
                <span class="pull-left" style="font-size:12px;color:#ccc;">
                    <i class="icon-info"></i>   <?php echo lang_admin('please_official_website_login');?></span>
                <button type="button" class="btn btn-default" onclick="javascrtpt:window.location.href='https://u.cmseasy.cn/index.php?case=user&act=register'" target="_blank"><?php echo lang_admin('register');?></button>
                <button type="button" id="app_login" class="btn btn-success"><?php echo lang_admin('login');?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        <?php if(config::getadmin("open_visual_drag")){ ?>
        $("#visual-right").css('margin-left','50px');
        $('#visual-right').animate({'margin-left' : '50px'});
        $('#visual-top').animate({'margin-left' : '50px'});
        $('#visual-bottom').animate({'margin-left' : '50px'});
        <?php }else{?>
        $("#visual-right").css('margin-left','0px');
        $('#visual-right').animate({'margin-left' : '0px'});
        $('#visual-top').animate({'margin-left' : '0px'});
        $('#visual-bottom').animate({'margin-left' : '0px'});
        <?php }?>
    });
    function setopen_visual_drag(obj){
        var open_visual_drag=$(obj).val();
        if(open_visual_drag==1){
            $("#visual-left").css('display','block');
            $("#visual-left-btn").css('display','block');
            $("#visual-right").css('marging-left','50px');
            $('#visual-right').animate({'margin-left' : '50px'});
            $('#visual-top').animate({'margin-left' : '50px'});
            $('#visual-bottom').animate({'margin-left' : '50px'});
        }else{
            $("#visual-left").css('display','none');
            $("#visual-left-btn").css('display','none');
            $("#visual-right").css('margin-left','0px');
            $('#visual-right').animate({'margin-left' : '0px'});
            $('#visual-top').animate({'margin-left' : '0px'});
            $('#visual-bottom').animate({'margin-left' : '0px'});
        }
        $.ajax({
            type: "post",
            url: '/index.php?case=config&act=setopen_visual&admin_dir=<?php echo get('admin_dir',true);?>&site=<?php echo front::get("site")?front::get("site"):"default";?>',
            data:{"open_visual_drag":$(obj).val()},
            async: true,
            success: function (data) { }
        });
    }
    //模态框点击登陆
    $('#app_login').click(function() {
        var app_username = $("#app_username").val();
        var app_passwrod = $("#app_passwrod").val();
        $.ajax({
            type: "get",
            url: "<?php echo url('app/login',true);?>",
            data: {'app_username': app_username, "app_passwrod": app_passwrod},
            dataType: 'json',
            async: true,
            success: function (data) {
                if (data.static == 1) {
                    //关闭服务器登录弹出框
                    $('#myDownloadfileModal').modal('hide');
                    $(".modal-backdrop.fade").hide();
                    window.location.href ="<?php echo url('template/visual',true);?>";
                } else {
                    alert(data.message);
                }
            }
        });
    });
</script>
<!-- 右侧 -->
<!-- 可编辑区域 -->
<div id="visual-top">
    <?php echo $tempheader; ?>
</div>
<!--加载进度条-->
<div class="index-lading" name="template_lading" style="display: none;">
    <div class="loadEffect">
        <div><span></span></div>
        <div><span></span></div>
        <div><span></span></div>
        <div><span></span></div>
    </div>
</div>
<div class="visual-right" id="visual-right">
    <?php echo $tempcontent; ?>
</div>
<div id="visual-bottom">
    <?php echo $tempfooter; ?>
</div>
<!-- 可编辑区域结束 -->
<div class="copyritht">
    <?php echo getCopyRight();?>
</div>
<!-- 检查区 -->
<div id="download-layout">
    <div class="clearfix view-html">
        <div class="clearfix"></div>
    </div>
</div>
<!-- 模态框 -->
<!--js加载 模态框-->
<?php /*autotempdir('modals');*/ ?>
<div name="load_modals">
</div>
<script>
    var refreshrigt_url="<?php echo getSiteUrl().$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>";
    var visualcatid=<?php if(front::get('catid')){echo front::get('catid');}else{echo 0;}; ?>;
    var visualaid=<?php if(front::get('aid')){echo front::get('aid');}else{echo 0;}; ?>;
    var visualtypeid=<?php if(front::get('typeid')){echo front::get('typeid');}else{echo 0;}; ?>;
    var visualspid=<?php if(front::get('spid')){echo front::get('spid');}else{echo 0;}; ?>;
    //拖拽链接
    var template_gettag='<?php echo url("template/getmodulestag/isshopping/".$isshopping);?>';
    if (visualcatid>0){
        template_gettag+="&catid="+visualcatid;
    }
    if (visualaid>0){
        template_gettag+="&aid="+visualaid;
    }
    if (visualspid>0){
        template_gettag+="&spid="+visualspid;
    }
    if (visualtypeid>0){
        template_gettag+="&typeid="+visualtypeid;
    }

    //弹出框
    $htmltrl=$("[name=load_modals]").html().replace(/^(\s|\xA0)+|(\s|\xA0)+$/g, '');
    if ($htmltrl==undefined || $htmltrl==""){
        $.ajaxSetup ({ async: true });
        var getmodals_url="<?php echo url('template/getmodals/isshopping/'.$isshopping);?>";
        if(visualspid){
            getmodals_url=getmodals_url+"&type=special"
        }
        if(visualtypeid){
            getmodals_url=getmodals_url+"&type=type"
        }
        <?php if(front::get('case')=="comment"){ ?>
        getmodals_url=getmodals_url+"&type=comment"
        <?php }; ?>
        <?php if(front::get('case')=="guestbook"){ ?>
        getmodals_url=getmodals_url+"&type=guestbook"
        <?php }; ?>
        $.get(getmodals_url,"",function (res) {
            $("[name=load_modals]").html(res);
            closemodules();
        });
    }
</script>
<!-- 确认框Modal -->
<div class="modal fade" id="iscreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                   <span aria-hidden="true">
                        <i class="icon-close"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('please_choose');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body" style="height:auto;">
                <div class="text-center">
                    <button type="button" name="iscreateModal_template" data-template="default" class="btn default-template"><?php echo lang_admin('default_tempalte');?></button>
                    <button type="button" name="iscreateModal_template"  data-template="new" class="btn new-template"><?php echo lang_admin('new_template');?></button>
                </div>
                <div class="blank30"></div>
            </div>
            <div class="modal-footer text-left">
                <div class="tips">
                    <i class="icon-info"></i>&nbsp;&nbsp;
                    <?php echo lang_admin('tips');?>
                    <div class="clearfix"></div>
                    <?php echo lang_admin('iscreateModal_one');?>
                    <div class="clearfix"></div>
                    <?php echo lang_admin('iscreateModal_two');?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var iscreateModal_template="";
    var this_template='<?php echo $tempname;?>';;
    var isreload=false;
    function saveLayout(newisreload) {
        isreload=newisreload?true:false;
        savebackcolorl();
        //return;
        //downloadLayoutSrc();
        if (visualcatid>0) {
            var visualaid_indexOf = "_" + visualcatid;
            if (isreload && visualcatid && iscreateModal_template == "" && this_template.indexOf(visualaid_indexOf) < 0) {
                $('#iscreateModal').modal('show');
                return false;
            }
        }
        if (visualaid>0) {
            var visualaid_indexOf = "_" + visualaid;
            if (isreload && visualaid && iscreateModal_template == "" && this_template.indexOf(visualaid_indexOf) < 0) {
                $('#iscreateModal').modal('show');
                return false;
            }
        }
        if (visualspid>0) {
            var visualaid_indexOf = "_" + visualspid;
            if (isreload && visualspid && iscreateModal_template == "" && this_template.indexOf(visualaid_indexOf) < 0) {
                $('#iscreateModal').modal('show');
                return false;
            }
        }
        if (visualtypeid>0) {
            var visualaid_indexOf = "_" + visualtypeid;
            if (isreload && visualtypeid && iscreateModal_template == "" && this_template.indexOf(visualaid_indexOf) < 0) {
                $('#iscreateModal').modal('show');
                return false;
            }
        }
        $("body").mLoading({
            text:"<?php echo lang_admin('being_save');?>",
        });
        /*        cache_text = $('.visual-right').html().replace(/\(&quot;/g,"('");
                cache_text = cache_text.replace(/&quot;\)/g,"')");*/
        cache_text=getLayoutSrcTwo();
        var  savetemp_url= "<?php echo url('template/savetemp/isshopping/'.$isshopping);?>";
        if (visualcatid>0){
            savetemp_url+="&catid="+visualcatid;
        }
        if (visualaid>0){
            savetemp_url+="&aid="+visualaid;
        }
        if (visualspid>0){
            savetemp_url+="&spid="+visualspid;
        }
        if (visualtypeid>0){
            savetemp_url+="&typeid="+visualtypeid;
        }
        if(iscreateModal_template!=""){
            savetemp_url+="&iscreateModal_template="+iscreateModal_template;
        }
        $.ajax({
            type: "POST",
            url: savetemp_url,
            data: {
                'name': this_template,
                'newisreload': newisreload,
                'content': cache_text,
                'tempdata': getLayoutSrc()
            },
            success: function (data) {
                data = JSON.parse(data);  //商品信息
                //console.log(data);
                //updateButtonsVisibility();
                $("body").mLoading("hide");
                setbackcolorl();  //判断框颜色
                if (iscreateModal_template=="default" || iscreateModal_template=="new"){
                    $('#iscreateModal').modal('hide');
                    $(".modal-backdrop.fade").hide();
                }
                alert(data['message']);
                if (iscreateModal_template=="new"){
                    if (visualcatid>0){
                        this_template=this_template+"_"+visualcatid;
                    }
                    if (visualaid>0){
                        this_template=this_template+"_"+visualaid;
                    }
                }
                iscreateModal_template="";

                //判断生成缓存
                if(data['cache_make']!=""){
                    $.post("<?php echo url("cache/cache_make_all",true); ?>",data,function () {});
                }
            }
        });
    }

    $('[name=iscreateModal_template]').click(function(){
        iscreateModal_template=$(this).data("template");
        saveLayout(isreload);
    });
    $(document).on('hidden.bs.modal',
        function (e) {
            $(e.target).removeData('bs.modal');
        });
</script>
<!--检查代码-->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog"
     aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                   <span aria-hidden="true">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('check_source_code');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="download-logged" class="">
                    <p class="tips">
                        <i class="icon-info"></i>
                        <?php echo lang_admin('view_source_code');?>
                    </p>
                    <p>
                                <textarea>
                                </textarea>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!---->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/jquery/ui/js/jquery-ui.min.js"></script>
<link href="<?php echo $base_url;?>/common/js/jquery/ui/css/jquery-ui.min.css" rel="stylesheet">
<!---->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/jquery/ui/js/jquery.ui.touch-punch.min.js"></script>
<!---->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/jquery/plugins/jquery-mloading/js/jquery.mloading.js"></script>
<!--可视化保存-->
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/visual/js/jquery.htmlclean.js"></script>
<!--图片占位-->
<style>
    img {
        position: relative;
    }
    img::after {
        content: "";
        height: 100%;
        width: 100%;
        position: absolute;
        left: 0;
        top: 0;
        background: url(<?php echo get('onerror_pic');?>) no-repeat center;
    }
</style>

<!---->
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/visual/js/visual.js"></script>
<!-- 上传组件 -->
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/fileinput.min.js" type="text/javascript">
</script>
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/locales/zh.js" type="text/javascript">
</script>
<link href="<?php echo $base_url;?>/common/plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet"
      type="text/css" />
<!-- 上下移动 -->
<script type="text/javascript">
    $(function () {
        $(document).on('click', '.div-down', null, function () {
            var parentsDiv = $(this).parents(".position-move");
            if (parentsDiv.length>1)
                parentsDiv=$(parentsDiv[0]);
            var next = parentsDiv.next();
            if (next.html() != undefined) {
                //next.after(parentsDiv);
                next.fadeOut("slow", function () {
                    $(this).after(parentsDiv);
                }).fadeIn();
            } else {
                alert("<?php echo lang_admin('to_the_bottom');?>");
            }
        });
        $(document).on('click', '.div-up', function () {
            var parentsDiv = $(this).parents(".position-move");
            if (parentsDiv.length>1)
                parentsDiv=$(parentsDiv[0]);
            var prev = parentsDiv.prev();
            if (prev.html() != undefined) {
                //prev.before(parentsDiv);
                prev.fadeOut("slow", function () {
                    $(this).before(parentsDiv);
                }).fadeIn();
            } else {
                alert("<?php echo lang_admin('to_the_top');?>");
            }
        });
    });
    $(window).bind('beforeunload',function(){
        return "<?php echo lang_admin('please_confirm_whether_the_data_is_saved_or_not');?>";
    });
</script>
<!-- 导航文本编辑 -->
<script type="text/javascript">
    $(function() {
        $('.setfont a').click(function (e) {
            e.preventDefault();
            document.execCommand('fontName', false, $(this).css('font-family'));
        });
        $('.setfontSize a').click(function (e) {
            e.preventDefault();
            console.log($(this).attr('rel'));
            document.execCommand('FontSize', false, $(this).attr('rel'));
        });
        $('.setfont a').click(function (e) {
            e.preventDefault();
            document.execCommand('fontName', false, $(this).css('font-family'));
        });
        $('.editControls a').click(function(e) {
            console.log($(this).data('role'));
            switch($(this).data('role')) {
                case 'createLink':
                    url = prompt("<?php echo lang_admin('please_enter_the_link_address');?>");
                    document.execCommand($(this).data('role'), false, url);
                    break;
                default:
                    document.execCommand($(this).data('role'), false, null);
                    break;
            }
        })
    });
</script>
<!-- 导航文本编辑 -->
<!-- 非文本编辑不显示编辑器 -->
<script type="text/javascript">
    <!--
    $(function(){
        $(document).on('click',".visual-right .visual-text",function(event){
            event.stopImmediatePropagation();
            $('.editControls').fadeIn(500).show();
        });
        $('#visual-right').bind("click",function(){
            //event.stopImmediatePropagation();
            $('.editControls').fadeOut(500).hide();
        })
    });
    //-->
</script>
<!-- 非文本编辑不显示编辑器 -->
<!-- 删除布局含标签 -->
<script type="text/javascript">
    var deletemoduletag_url='<?php echo url("template/deletemoduletag");?>';
    $(function () {
        $(document).on("click",".visual-right .remove",
            function (e) {
                e.preventDefault();
                if (confirm("<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>")) {
                    html = $(this).parent().find('.view .tagname').html();
                    //获取删除的组件名称
                    $(this).parent().parent().parent().parent().find('.view .tagname').each(function () {
                        var modulesname= $(this).html();

                        modulesname = ReplaceAll(modulesname,'#[#','{');
                        modulesname = ReplaceAll(modulesname,'#]#','}');
                        //删除组件配置
                        $.post(deletemoduletag_url,{"modulesname":modulesname},function(res){});
                    });
                    $(this).parent().parent().parent().parent().remove();
                    if (!$(this).length > 0) {
                        clearDemo()
                    }
                    setbackcolorl();  //判断框颜色
                    saveLayout();
                }
            });
    });
</script>
<!-- 删除布局含标签 -->
<!-- 左侧菜单展开 -->
<script type="text/javascript">
    //边栏收缩
    function  visual_left_btn() {
        //边栏收缩
        if($("#visual-left-btn").hasClass('closed')){
            $('.visual-left').animate({left: '-280px'});
            $("#visual-left-btn").removeClass('closed');
            <?php if(config::getadmin("open_visual_drag")){ ?>
            $('#visual-right').animate({'margin-left' : '50px'});
            $('#visual-top').animate({'margin-left' : '50px'});
            $('#visual-bottom').animate({'margin-left' : '50px'});
            $('#visual-left-btn').animate({left: '50px'});
            <?php }else{?>
            $('#visual-right').animate({'margin-left' : '0px'});
            $('#visual-top').animate({'margin-left' : '0px'});
            $('#visual-bottom').animate({'margin-left' : '0px'});
            $('#visual-left-btn').animate({left: '0px'});
            <?php }?>
        }
    }

    $(document).ready(function () {
        $(".dropdown-button").dropdown();
        $("#visual-left-btn").click(function(){
            if($(this).hasClass('closed')){
                $('.visual-left').animate({left: '-280px'});
                $(this).removeClass('closed');
                $('#visual-right').animate({'margin-left' : '50px'});
                $('#visual-top').animate({'margin-left' : '50px'});
                $('#visual-bottom').animate({'margin-left' : '50px'});
                $('#visual-left-btn').animate({left: '50px'});
            }
            else{
                $(this).addClass('closed');
                $('.visual-left').animate({left: '0px'});
                $('#visual-left-btn').animate({left: '330px'});
                $('#visual-right').animate({'margin-left' : '330px'});
                $('#visual-top').animate({'margin-left' : '330px'});
                $('#visual-bottom').animate({'margin-left' : '330px'});
            }
            //组件加载
            if ($(this).data("name")=="load_modules"){
                setTimeout("load_modules()",500);
            }
        });

        $(".nav-tabs-a a").click(function(){
            if(!$("#visual-left-btn").hasClass('closed')){
                $("#visual-left-btn").addClass('closed');
                $('.visual-left').animate({left: '0px'});
                $('#visual-left-btn').animate({left: '330px'});
                <?php if(config::getadmin("open_visual_drag")){ ?>
                $('#visual-right').animate({'margin-left' : '330px'});
                $('#visual-top').animate({'margin-left' : '330px'});
                $('#visual-bottom').animate({'margin-left' : '330px'});
                <?php }else{?>
                $('#visual-right').animate({'margin-left' : '280px'});
                $('#visual-top').animate({'margin-left' : '280px'});
                $('#visual-bottom').animate({'margin-left' : '280px'});
                <?php }?>
            }
            //组件加载
            if ($(this).data("name")=="load_modules"){
                setTimeout("load_modules()",500);
            }
            //模板加载
            if ($(this).data("name")=="load_modular"){
                setTimeout("load_modular()",500);
            }
            //布局加载
            if ($(this).data("name")=="load_layouts"){
                setTimeout("load_layouts()",500);
            }
            //组件市场加载
            if ($(this).data("name")=="load_buymodules"){
                setTimeout("load_buymodules()",500);
            }
        });

    });


</script>
<!-- 左侧菜单展开 -->
<!-- 顶部多层菜单 -->
<script type="text/javascript">
    <!--
    $(function () {
        $(".visual-top .dropdown").mouseover(function () {
            $(this).addClass("open");
        });
        $(".visual-top .dropdown").mouseleave(function(){
            $(this).removeClass("open");
        })
    })
    //-->
</script>
<!-- 顶部多层菜单 -->
<script type="text/javascript">
    <!--
    //标签页
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    //去掉虚线框
    function bluring() {
        if (event.srcElement.tagName == "A" || event.srcElement.tagName == "IMG") document.body.focus();
    }
    document.onfocusin = bluring;
    //点击信息层
    function turnoff(obj) {
        document.getElementById(obj).style.display = "none";
    }
    //信息框
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    //-->
</script>
<!--划过增加class-->
<script type="text/javascript">
    <!--
    $(document).ready(function() {
        $(".cmseasyedit").hover(function() {
            $(this).addClass("set-up");
        }, function() {
            $(this).removeClass("set-up");
        });
        $(".cmseasyeditimg").hover(function() {
            $(this).addClass("set-up-img");
        }, function() {
            $(this).removeClass("set-up-img");
        });
    });
    //-->
</script>


<!--编辑按钮相对定位-->
<script type="text/javascript">
    <!--
    var editcatrgroy ={};
    function cmseasyedit(){
        $(".cmseasyedit").mouseover(function(){
            $(".visual-btn").show();
            var xx=	$(this).offset().left + $(this).width()/2 - $(".visual-btn").width()/2;
            var yy=$(this).offset().top + $(this).height()/2 - $(".visual-btn").height()/2;
            $(".visual-btn").css({"left":xx,"top":yy});
            editcatrgroy['id']=$(this).attr("cmseasy-id");
            editcatrgroy['table']=$(this).attr("cmseasy-table");
            editcatrgroy['field']=$(this).attr("cmseasy-field");
            editcatrgroy['Node']=$(this);
            editcatrgroy['module_name']=$(this).parents(".tag").eq(0).find(".tagname").html();
            if($(this).hasClass('content')){
                editcatrgroy['type']="content";
                editcatrgroy['value']=$.trim($(this).html());
            }
            else if($(this).hasClass('textarea')){
                editcatrgroy['type']="textarea";
                editcatrgroy['value']=$.trim($(this).html());
            }
            else if($(this).hasClass('time')){
                editcatrgroy['type']="time";
                editcatrgroy['value']=$(this).html();
            }
            else if($(this).hasClass('strgrade')){
                editcatrgroy['type']="strgrade";
                editcatrgroy['value']=$(this).attr("cmseasy-grade");
            }
            else {
                editcatrgroy['type']="text";
                editcatrgroy['value']=$.trim($(this).html());
            }
        });
        $(".visual-btn").mouseover(function(){
            $(".visual-btn").show();
        });
        //移除
        $(".cmseasyedit").mouseleave(function(){
            $(".visual-btn").hide();
        });
        //移除
        $(".visual-btn").mouseleave(function(){
            $(".visual-btn").hide();
        });
        //点击编辑
        $("[name=cmseasyeditbtn]").click(function(e) {
            if (editcatrgroy['type']=='content'){
                $('#editfrmcategorycontent .id').val(editcatrgroy['id']);
                $('#editfrmcategorycontent .table').val(editcatrgroy['table']);
                $('#editfrmcategorycontent .field').val(editcatrgroy['field']);
                $('#editfrmcategorycontent .type').val(editcatrgroy['type']);
                $('#editfrmcategorycontent .module_name').val(editcatrgroy['module_name']);
                ue_editcategorycontent.ready(function() {//编辑器初始化完成再赋值
                    ue_editcategorycontent.setContent('');  //赋值给UEditor
                    ue_editcategorycontent.setContent(editcatrgroy['value']);  //赋值给UEditor
                });
                $('#template-edit-category-content').modal('show');
            }
            else  if (editcatrgroy['type']=='textarea'){
                $('#editfrmcategorytextarea .id').val(editcatrgroy['id']);
                $('#editfrmcategorytextarea .table').val(editcatrgroy['table']);
                $('#editfrmcategorytextarea .field').val(editcatrgroy['field']);
                $('#editfrmcategorytextarea .type').val(editcatrgroy['type']);
                $('#editfrmcategorytextarea .textareacontent').val(editcatrgroy['value']);
                $('#editfrmcategorytextarea .module_name').val(editcatrgroy['module_name']);
                $('#template-edit-category-textarea').modal('show');
            }
            else  if (editcatrgroy['type']=='time'){
                $('#editfrmcategorytime .id').val(editcatrgroy['id']);
                $('#editfrmcategorytime .table').val(editcatrgroy['table']);
                $('#editfrmcategorytime .field').val(editcatrgroy['field']);
                $('#editfrmcategorytime .type').val(editcatrgroy['type']);
                $('#editfrmcategorytime #timecontent').val(editcatrgroy['value']);
                $('#editfrmcategorytime .module_name').val(editcatrgroy['module_name']);
                $('#template-edit-category-time').modal('show');
            }
            else  if (editcatrgroy['type']=='strgrade'){
                $('#editfrmcategorystrgrade .id').val(editcatrgroy['id']);
                $('#editfrmcategorystrgrade .table').val(editcatrgroy['table']);
                $('#editfrmcategorystrgrade .field').val(editcatrgroy['field']);
                $('#editfrmcategorystrgrade .type').val(editcatrgroy['type']);
                $('#editfrmcategorystrgrade .module_name').val(editcatrgroy['module_name']);
                $('[name=grade]').removeAttr('checked');
                $('[name=grade]').each(function(i, obj){
                    if($(this).val()==editcatrgroy['value']){
                        $(this).prop("checked",true);
                    }
                });
                $('#template-edit-category-strgrade').modal('show');
            }
            else  if (editcatrgroy['type']=='text'){
                $('#editfrmcategorytext .id').val(editcatrgroy['id']);
                $('#editfrmcategorytext .table').val(editcatrgroy['table']);
                $('#editfrmcategorytext .field').val(editcatrgroy['field']);
                $('#editfrmcategorytext .type').val(editcatrgroy['type']);
                $('#editfrmcategorytext .content').val(editcatrgroy['value']);
                $('#editfrmcategorytext .module_name').val(editcatrgroy['module_name']);
                $('#template-edit-category-text').modal('show');
            }
        });
        visual_init();
    }
    //-->
    function cmseasyeditimg(){
        $(".cmseasyeditimg").mouseover(function(){
            $(".visual-btn-img").show();
            var xx=	$(this).offset().left + $(this).width()/2 - $(".visual-btn-img").width()/2;
            var yy=$(this).offset().top + $(this).height()/10 - $(".visual-btn-img").height()/10;
            $(".visual-btn-img").css({"left":xx,"top":yy});
            editcatrgroy['id']=$(this).attr("cmseasy-id");
            editcatrgroy['table']=$(this).attr("cmseasy-table");
            editcatrgroy['field']=$(this).attr("cmseasy-field");
            editcatrgroy['Node']=$(this);
            if($(this).hasClass('cmseasyeditimg')){
                editcatrgroy['type']="cmseasyeditimg";
                editcatrgroy['value']=$(this).attr("src");
            }
        });
        $(".visual-btn-img").mouseover(function(){
            $(".visual-btn-img").show();
        });
        //移除
        $(".cmseasyeditimg").mouseleave(function(){
            $(".visual-btn-img").hide();
        });
        //移除
        $(".visual-btn-img").mouseleave(function(){
            $(".visual-btn-img").hide();
        });
        //点击编辑
        $("[name=cmseasyeditbtnimg]").click(function(e) {
            if (editcatrgroy['type']=='cmseasyeditimg'){
                $('#editfrmcategoryimg .id').val(editcatrgroy['id']);
                $('#editfrmcategoryimg .table').val(editcatrgroy['table']);
                $('#editfrmcategoryimg .field').val(editcatrgroy['field']);
                $('#editfrmcategoryimg .type').val(editcatrgroy['type']);
                $('#editfrmcategoryimg .module_name').val(editcatrgroy['module_name']);
                $('#editimage_preview').find('img').attr('src',editcatrgroy['value']);
                $('#editimage').val(editcatrgroy['value']);
                $('#template-edit-category-img').modal('show');
            }
        });
    }
    //-->
</script>
<!--文字类编辑按钮-->
<div class="visual-btn">
    <a title="<?php echo lang_admin('edit');?>" href="javascript:void(0);" name="cmseasyeditbtn">
        <span class="glyphicon glyphicon-pencil"></span>
    </a>
</div>
<!--图片编辑按钮-->
<div class="visual-btn-img">
    <a title="<?php echo lang_admin('edit');?>" href="javascript:void(0);" name="cmseasyeditbtnimg">
        <span class="glyphicon glyphicon-picture"></span>
    </a>
</div>
<!--获得元素父级-->
<script type="text/javascript">
    function span_drag(){
        $("#visual-right span.drag").click(function() {
            $(this).parent().css('z-index', '9');
            $(this).parent().parent().css('z-index', '8');
            $(this).parent().parent().parent().css('z-index', '7');
            $(this).parent().parent().parent().parent().css('z-index', '6');
            $(this).parent().parent().parent().parent().parent().css('z-index', '5');
            $(this).parent().parent().parent().parent().parent().parent().css('z-index', '4');
            $(this).parent().parent().parent().parent().parent().parent().parent().css('z-index', '3');
            $(this).parent().parent().parent().parent().parent().parent().parent().parent().css('z-index', '2');
            $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().css('z-index', '1');
        });
        $('#visual-right span.drag').mouseleave(function() {
            $(this).parent().css('z-index', '1');
        });
    }
</script>
<!-- 返回顶部 -->
<script type="text/javascript">
    $(function() {
//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function(){
                if ($(window).scrollTop()>100){
                    $("#back-top").fadeIn(1000);
                }
                else
                {
                    $("#back-top").fadeOut(500);
                }
            });
//当点击跳转链接后，回到页面顶部位置
            $("#back-top").click(function(){
                $('body,html').animate({scrollTop:0},500);
                return false;
            });
        });
    });
</script>
<a href="#" id="back-top"><i class="glyphicon glyphicon-arrow-up"></i></a>
<!-- 百度编辑器 -->
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/addCustomizeButton.js"></script>
<!-- 上传图片框 -->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ThumbAjaxFileUpload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/upimg/dialog.js"></script>
<link href="<?php echo $skin_admin_path;?>/css/dialog.css" rel="stylesheet" type="text/css" />
<!-- 字体图标库 -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/icomoon.css" />
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/fonticon/fonticon.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/plugins/fonticon/jquery.fonticonpicker.js"></script>
<!-- 字体图标库 -->
<!--取色-->
<script src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/plugins/colorpicker/css/bootstrap-colorpicker.css" type="text/css"/>
<!--如果头部或底部-->
<?php if ($tempname=="top" || $tempname=="bottom" ){?>
    <style type="text/css">
        #visual-top {visibility:hidden;}
        .visual-right .navbar {margin:0px;}
    </style>
    <script src="<?php echo $base_url;?>/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <!-- 鼠标滑过展开一级菜单/一级菜单可点击 -->
    <script type="text/javascript">
        <!--
        $(function () {
            $(".dropdown,.dropdown-submenu").mouseover(function () {
                $(this).addClass("open");
            });
            $(".dropdown,.dropdown-submenu").mouseleave(function(){
                $(this).removeClass("open");
            })
        });
        $(document).ready(function(){
            var _width = $(window).width();
            if(_width < 768){
                $("#navbar a.toogle").click(function(){
                    event.preventDefault();
                });
            }
        });
        //-->
    </script>
<?php } ?>
<!--判断商品增加右侧边距-->
<?php if($isshopping){ ?>
    <style>
        #visual-right {padding-right:25px;}
    </style>
<?php } ?>
<!-- 购买商品 -->
<script type="text/javascript">
    <!--
    $(function () {
        var url='<?php echo url("archive/getarchiveprice/aid/".$archive["aid"]);?>';
        var myfield="<?php echo $archive['my_field'];?>";
        var setfieldNameurl='<?php echo url("archive/getfieldName");?>';
        var setleixingurl='<?php echo url("archive/getarchiveType");?>';
        var aid='<?php echo $archive["aid"];?>';
        var shopingurl="<?php echo url('archive/doorders/aid/',true);?>";
        getshopping(aid,url,myfield,setfieldNameurl,setleixingurl,shopingurl);
    });
    //-->
</script>
<script>
    $(document).ready(function(){
        ready_all();
    });
    function ready_all() {
        cmseasyedit();
        cmseasyeditimg();
        span_drag();
    }
</script>


</body>
</html>