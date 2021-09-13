<style>
    .main-right-box .box .user-rights-list h5 {
        margin:0px  0px 15px 0px !important;
        padding:5px 0px 5px 15px !important;
        border:none !important;
        background:#f5f5f5;
        /*border-bottom:1px solid #eee !important;*/
    }
    .main-right-box .box .user-rights-list h5:before {background: #ccc !important;left:0px !important; top:10px !important;}
    .main-right-box .box .user-rights-list dl {
        padding:15px;
        overflow: hidden;
    }
    .drag-area {
        display: inline-block;
        width: 30px;
        height: 44px;
        line-height:34px;
        vertical-align: top;
        float: right;
        cursor: move;
    }

</style>


<form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
    <div class="main-right-box">
        <h5>
            {lang_admin('sidebar')}
            <!--工具栏-->
            <div class="content-eidt-nav pull-right">
                <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-frame"></i>
                    <?php echo lang_admin('container_fluid');?>
                </a>
                <span class="pull-right">


                        <input  name="submit" value="1" type="hidden">

                            <button class="btn btn-success" type="submit" name="save"
                                    onclick="this.form.action='<?php echo modify('act/add',true);?>';  returnform(this.form);">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>
                        &nbsp;
                       <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('config/index');?>" data-dataurlname="<?php echo lang_admin('set_up');?>" class="pull-right btn btn-default">
            <i class="icon-action-redo"></i>
        </a>

                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
            </div>
        </h5>
        <div class="box">
            <div class="user-rights-list">
                <ul class="drag-list" id="sortable">
                    {loop $data $i $d}
                    <li class="s_click ui-state-default"  >
                        <input type="hidden" class="hiddenfromdata" id="<?php echo $d['key'];?>"  data-prante="<?php echo $d['prante'];?>"
                               name="fromdata[<?php echo $d['key'];?>][status]" value="<?php if ($d['status']){echo 1;}else{echo 0;};?>">

                        <h5>
                            <span class="drag-area icon-pin"></span>
                            <input <?php if ($d['status']){ ?> checked <?php } ?>
                                    onclick="c_chang(this);checkfromdata(this,'<?php echo $d['key'];?>');checkfromprante(this,'<?php echo $d['key'];?>')"
                                    data-prante="<?php echo $d['prante'];?>"   type="checkbox"    class="checkbox checkbox_prante" />
                            <strong>{$d['name']}</strong>


                        </h5>


                        <?php if(isset($d['son']) && is_array($d['son'])){ ?>
                            <dl>
                                {loop $d['son'] $dl}

                                <input type="hidden" class="hiddenfromdata" id="<?php echo $dl['key'];?>"  data-prante="<?php echo $dl['prante'];?>"
                                       name="fromdata[<?php echo $dl['key'];?>][status]" value="<?php if ($dl['status']){echo 1;}else{echo 0;};?>">
                                <dd class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <input <?php if ($dl['status']){ ?> checked <?php } ?>
                                            onclick="c_chang(this);checkfromdata(this,'<?php echo $dl['key'];?>');checkfromprante(this,'<?php echo $dl['key'];?>')"
                                            data-prante="<?php echo $dl['prante'];?>"   type="checkbox"    class="checkbox checkbox_prante" />
                                    {$dl['name']}</dd>
                                </dd>

                                {/loop}
                            </dl>
                        <?php };?>


                        <div class="clearfix blank5"></div>
                    </li>

                    {/loop}
            </div>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <input type="hidden" name="submit" value="1"/>
            <input class="btn btn-primary btn-lg" type="button" value="{lang_admin('preservation')} " name="save"
                   onclick="this.form.action='<?php echo modify('act/add',true);?>';  returnform(this.form);"/>

            <div class="blank30"></div>
            <!-- <div class="line"></div>

        <div class="clear page">
            <?php /*$record_count=isset($record_count)?$record_count:0; if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); */?>
        </div>
        <div class="blank30"></div>-->
        </div>
</form>



</div>

<script type="text/javascript">
    $(function() {
        $('li').arrangeable({dragSelector: '.drag-area'});
    });
</script>
<script>
    function checkfromdata(obj,name){
        if (name =="all"){
            if($(obj).is(':checked')) {
                $(".hiddenfromdata").val(1);
            }else{
                $(".hiddenfromdata").val(0);
            }
        }else{
            if($(obj).is(':checked')) {
                $("#"+name).val(1);
            }else{
                $("#"+name).val(0);
            }
        }
    }

    //选中下属栏目
    function checkfromprante(obj,name){
        if($(obj).is(':checked')) {
            $(".hiddenfromdata").each(function () {
                if ($(this).data("prante")==name) {
                    $(this).val(1);
                }
            });
            $(".checkbox_prante").each(function () {
                if ($(this).data("prante")==name) {
                    $(this).prop("checked",true);
                }
            });
        }else{
            $(".hiddenfromdata").each(function (sonboj) {
                if ($(this).data("prante")==name) {
                    $(this).val(0);
                }
            });
            $(".checkbox_prante").each(function () {
                if ($(this).data("prante")==name) {
                    $(this).prop("checked",false);
                }
            });
        }

    }
</script>

<script src="<?php echo $base_url;?>/common/js/jquery/ui/js/jquery-ui.js"></script>
<script>
    $(function () {
        $("#sortable").sortable({
            axis: "y",  // y方向拖动
            containment: "parent",  // 约束范围为父元素内部
            cursor: "move",
            cursorAt: { left: 5 },
            // disabled: true,
            distance: 5,
            update: updateHandle
        });
        // $( "#sortable" ).disableSelection();

        var arr = [];
        function updateHandle() {
            arr=[];
            Array.prototype.slice.call($('ul li')).forEach(function (element, index) {
                arr.push(element.dataset.id)
            });
            console.log(arr.join(','));
        }
    });
</script>