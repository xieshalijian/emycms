<style type="text/css">
    .img-container {
        margin-bottom: 50px;
    }
    .img-container .img-box {
        display: inline-block;
        position: relative;
        height:250px;
        display: table-cell;
        vertical-align: middle;
        text-align:center;
    }
    .img-container .img-box:hover span {
        visibility: visible;
    }
    .img-container img {
        border: 4px solid #f5f5f5;
        border-radius: 3px;
        cursor: pointer;
        max-height:150px;
    }
    .img-container .title {
        margin-top: 5px;
        font-size: 13px;
    }
    .img-container .glyphicon {
        position: absolute;
        background: rgba(56, 156, 240, 0.8);
        height: 48px;
        width: 48px;
        visibility: hidden;
        left: 41%;
        border-radius: 100%;
        cursor: pointer;
        text-align: center;
        color:white;line-height:48px;-moz-box-shadow:0px 8px 15px #999;
        -webkit-box-shadow:0px 8px 15px #999;
        box-shadow:0px 8px 15px #999;
    }
    .img-container span {
        display: inline-block;
        margin-top: 14px;
    }
    .img-container span.glyphicon-eye-open {
        top: 28%;
    }
    .img-container span.glyphicon-trash {
        top: 52%;
    }
</style>

<div class="main-right-box">
    <h5>{lang_admin('picture_list')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo $base_url ;?>/index.php?case=image&act=listdir&admin_dir=<?php echo get('admin_dir',true);?>&site=default" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div>
    </h5>
    <div class="blank20"></div>
    <div class="box" id="box">

        <div class="padding10">


            <div class="blank20"></div>
            <div class="line"></div>


            <div class="row">


                {loop $list_img_arr $i $t}
                {if $i%4==0}<div class="clearfix"></div>{else}{/if}
                <?php $info = @getimagesize(substr(config::getadmin('html_prefix'),1)."/upload/images/".front::get('dir')."/$t");?>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 img-container">

                    <div class="img-box">
                        <span class="icon img-box-pic">
                            <a class="enlargeImg" title="{lang_admin('view_original_image')}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </span>
                        <span class="icon trash">
                           <a class="enlargeImg" title="{lang_admin('view_original_image')}"  src="{get('html_prefix')}/upload/images/{front::get('dir')}/{$t}"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </span>
                        <center><img class="img-responsive" src="{get('html_prefix')}/upload/images/{front::get('dir')}/{$t}"></center>
                        <p>{lang_admin('resolving_power')}:<?php echo($info[0].'x'.$info[1])?></p>
                        <a href="#" onclick="gotourl(this)"   data-dataurl="{url('image/deleteimg/dir/'.front::get('dir').'/imgname/'.str_replace('.','___',$t))}" class="img-del"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>

                </div>
                {/loop}

                <div class="line"></div>
                <div class="blank20"></div>
                <div class="page">{$link_str}</div>
            </div>
            <div class="blank30"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".img-del").click(function(){
            if(confirm("{lang_admin('are_you_sure_you_want_to_delete_it')}")){
                return true;
            }
            return false;
        });
    });
</script>


<!-- 图片发大 -->
<style type="text/css">
    .enlargeImg_wrapper {
        display: none;
        position: fixed;
        z-index: 999;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(52, 52, 52, 0.8);
        text-align:center;
        line-height:100vh;
    }
    img:hover {
        cursor: zoom-in;
    }
    .enlargeImg_wrapper:hover {
        cursor: zoom-out;
    }
    .enlargeImg_wrapper img {
        width:auto;
        height:100%;
        margin:0px auto;
        border:none;
    }
</style>
<script type="text/javascript">
    $(function() {
        enlargeImg();
    })
    //查看大图
    function enlargeImg() {
        $(".enlargeImg").click(function() {
            var imgSrc = $(this).attr('src');
            $(this).after("<div onclick='closeImg()' class='enlargeImg_wrapper'><img src='" + imgSrc + "'</div>");
            $('.enlargeImg_wrapper').fadeIn(200);
        })
    }
    //关闭并移除图层
    function closeImg() {
        $('.enlargeImg_wrapper').fadeOut(200).remove();
    }

</script>


