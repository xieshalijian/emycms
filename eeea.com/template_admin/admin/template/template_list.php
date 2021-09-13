<div style="padding:0px 15px;">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('tips')}！</strong></span>
        {lang_admin('after_switching_the_template_if_the_original_data_is_not_replaced_by_the_template_data_the_label_in_the_template_needs_to_be_reset_otherwise_the_blank_will_appear_because_the_data_page_is_not_called_refer_to_the_tutorial')}&nbsp;&nbsp;<a class="btn btn-primary" href="https://www.cmseasy.cn/chm/chang-jian/show-194.html" target="_blank">{lang_admin('see')}</a>
    </div>
</div>


<style type="text/css">
    #tag1 .col-xs-8.text-right,#tag1 .col-sm-8.text-right ,#tag1 .col-md-9.text-right ,#tag1 .col-lg-10.text-right,#tag1 .text-right,#tag2 .col-xs-8.text-right,#tag2 .col-sm-8.text-right ,#tag2 .col-md-9.text-right ,#tag2 .col-lg-10.text-right,#tag2 .text-right {display:none;}
</style>
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
</div>
<div class="blank10"></div>


<style type="text/css">
    .list-group-item { min-height:188px; margin:0px 0px 10px 0px; padding:15px 5px; box-shadow: 0px 8px 15px #eee;border:1px solid #ddd;

    }
    a.list-group-item-b {background:#eee; padding:15px 30px; border:1px solid #ccc; text-align:center;

    }

    .list-group-item span.app-icon {display:block; width:50px; height:50px; font-size:26px;float:left;color:#424950; background:#eee;padding:12px;border-radius:50%;}
    .list-group-item span.app-price { display:inline-block; min-width:50px; margin:5px 0px 0px 5px;background:#28D094; border-radius: 3px; padding:0px 5px;color:#fff;}
    .list-group-item span.free { background:#eee;color:#333;text-align:center;}
    .list-group-item strong { line-height:38px; color:#000; font-weight:300; font-size:14px;}
    .list-group-item:last-child {border-radius:8px; }
    .list-group-item-b:last-child {border-radius:2px; }
    .list-group-item:hover,.glyphicon-list-alt {-moz-box-shadow:0px 8px 15px #ccc;
        -webkit-box-shadow:0px 8px 15px #aaa;
        box-shadow:0px 8px 15px #aaa;-o-transition: all 0.15s, 0.15s;
        -moz-transition: all 0.15s, 0.15s;
        -webkit-transition: all 0.15s, 0.15s;

    }
    .quick-navb-item {margin-bottom:20px;}

    .list-group-item span.expansion-price {display: inline-block; float:right; height:22px; line-height:22px; padding:0px 5px; font-size:12px; background:#ccc; border-radius: 5px; text-align:center;}
    .list-group-item p {margin:0px; font-size:12px;}
    .template_btn .btn {box-shadow:none;color:rgba(0, 0, 0, 0.45);}
    .template_btn a {color:rgba(0, 0, 0, 0.45);text-decoration:none;}
    @media (min-width: 1680px) {
        .quick-navb .col-lg-4 {
            width: 25%;
        }

    }
    .glyphicon-trash {color:rgba(0, 0, 0, 0.45);}
    .glyphicon-ok {color:#fff;}
    .btn-primary {box-shadow:none;}

</style>
<div class="quick-navb">


    {loop $item['select'] $key2 $val}
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4  quick-navb-item">
        <div class="list-group-item">
            <div class="col-md-6">
                <div class="img-wrap">
                    <img class="img-responsive" src="{$base_url}/template/{$key2}/skin/thumbnails.jpg" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <p>
                        <strong>{trim($val)}</strong>
                        <span class="app-price free">
                                                    {lang_admin('apps_free')}
                                                </span>
                    </p>
                    {if trim($item['value'])==trim($val) }
                    <p>
                        <a>管理标签</a>
                        |
                        <a>编辑模板</a>
                    </p>
                    {/if}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="template_btn">
                <div class="col-md-6">
                    <div class="row">
                        <button name="submit" type="submit"
                                {if trim($item['value'])==trim($val) }
                        class="btn btn-success" checked="checked" disabled="disabled" value="{lang_admin('used')}"{/if}
                        {if $item['value']!=$val}
                        class="btn" onclick="setTemplate_dir('{$key2}')" value="{lang_admin('application')}{/if}">

                        {if trim($item['value'])==trim($val) }
                        <i class="glyphicon glyphicon-ok"></i> {lang_admin('used')}
                        {elseif $item['value']!=$val}
                        <i class="glyphicon glyphicon-retweet"></i> {lang_admin('application')}
                        {/if}
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <a href="<?php echo url('template/del/tplname/'.$val,1);?>" onClick="return confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')"><i class="icon-action-redo"></i> 删除</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {/loop}
    <script>
        function setTemplate_dir(value){
            document.getElementById("template_dir").value=value;
        }
    </script>
    <div class="blank10"></div>

    {form::hidden($item['name'],get($item['name'],true))}