<div class="main-right-box">

    <div class="box" id="box">




        <form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return returnform(this);">
            <h5>{lang_admin('adding_announcements')}

                <!--工具栏-->
                <div class="content-eidt-nav pull-right">
                    <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                        <i class="icon-frame"></i>
                        {lang_admin('container_fluid')}
                    </a>
                    <span class="pull-right">



                    <input  name="submit" value="1" type="hidden">

                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>


                <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url ;?>/index.php?case=table&act=list&table=announcement&admin_dir=<?php echo get('admin_dir',true);?>&site=default" class="btn btn-default" >
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
                </div>

            </h5>
            <div id="content-eidt-nav"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('title')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('title',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('content')}</div>
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    {form::getform('content',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('is_to_index')}</div>
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    {form::getform('recommend',$form,$field,$data)}
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <style type="text/css">
                #content {min-height:500px;}
            </style>

            <div class="blank30"></div>

            <div class="clearfix blank20"></div>
        </form>


        <div class="blank30"></div>
    </div>
</div>


<!-- 百度编辑器 -->
<script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="{$base_url}/ueditor/addCustomizeButton.js"></script>
