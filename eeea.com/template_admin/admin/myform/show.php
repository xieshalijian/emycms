<style type="text/css">
    tr {margin:5px 0px;}
</style>
<div class="main-right-box">
    <h5>
        {lang_admin('form_data')}
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('form/listform');?>" data-dataurlname="<?php echo lang_admin('form');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div>
    </h5>
    <div class="box" id="box">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="th">
                    <th class="s_out">{lang_admin('field_name')}</th>
                    <th class="catname">{lang_admin('content')}</th>
                </tr>
                </thead>
                <tbody>
                {user_cb_data($data,$table)}
                {loop $field $f}
                <?php
                $type = setting::$var[front::$get['table']][$f['name']]['filetype'];
                $name=$f['name'];
                $aid = $data['aid'];
                if(!preg_match('/^my_/',$name)) continue;
                if(!isset($data[$name])) $data[$name]='';
                ?>
                <tr>
                    <td class="s_out">{$name|lang}</td>
                    <td class="catname">{if $type=='file'}<a href="{$data[$name]}" target="_blank" title="{lang_admin('download')}"><i class="glyphicon glyphicon-download-alt"></i></a>{elseif $type=='image'}<img src='{$data[$name]}' width="200"> {else}{$data[$name]}{/if}</td>
                </tr>
                {/loop}
                </tbody></table>
        </div>
        <div class="blank30"></div>
    </div>
</div>