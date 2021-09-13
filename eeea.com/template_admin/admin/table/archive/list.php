<!-- 多选框 -->
<link rel="stylesheet" href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap-select.css">
<script type="text/javascript" src="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap-select.js"></script>

<style type="text/css">
    .archive-list-side {
        display: block;
        position: absolute;
        left:0px;
        top:0px;
        bottom:0px;
        padding:0px ;
        border-right:1px solid #eee;
    }
    .archive-list-side-content {position: relative; height:460px; padding-right:30px;}
    .archive-list-side .table { }
    .archive-list-side .table td.manage {min-width:auto;color:#333;}
    .archive-list-side .table td.manage a {color:#333;}
    .archive-list-side .table td.manage .glyphicon {color:#00b7ee}
    .archive-list-side .table td a.child {float:none;display:inline-block; margin-left:0px; color:#ccc;}
    .archive-list-side .table td a.child:before {
        content: '\e258';
        font-family: "glyphicons halflings";
        font-size: 0.6rem;
        display: inline-block;
        position: absolute;
        right: 10px;
        top: 10px;
        -webkit-transform: rotate(0);
        -moz-transform: rotate(0);
        -ms-transform: rotate(0);
        -o-transform: rotate(0);
        transform: rotate(0);
        transition: -webkit-transform 0.2s ease-in-out;
    }
    .archive-list-side .table td a.checked:before {
        webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    @media(max-width:468px) {
        .archive-list {margin:0px;}
        .archive-list-side {width:100%; clear:both; position: inherit; }
        #listform {clear:both;}

    }


    input#search_title,input#ecoding_title { padding-right:29px; text-overflow: ellipsis;}

    #archive-list-side-btn i, #archive-list-side-close i {margin:17px 0px;}
    @media(max-width:1366px) {
        .htmldir {
            display: none;
        }
    }

    .archive-list-side-content-box, .outer-container {
        width: 100%;
        height: 460px;
    }

    .outer-container {
        position: relative;
        overflow: hidden;

    }


    .inner-container {
        position: absolute;
        left: 0;
        right:0;
        padding-right:15px;
        overflow: scroll;
        overflow-y: scroll;
    }

    .inner-container::-webkit-scrollbar {

    }


    .ps-scrollbar-x {
        display:none;
    }


</style>

<script>
    $(function() {
        $('.inner-container').perfectScrollbar();
    });

    function  setForm() {
        var action=$("#searchform").attr("action")+'&sorting='+$("#sorting").val();
        $("#searchform").attr("action",action);
    }
</script>
<!--子栏目展开状态-->
<script type="text/javascript">
    $(function(){
        $('.child').click(function(){
            $('.child').removeClass('checked');
            $(this).toggleClass('checked');
        });
    });
</script>




<div class="main-right-box">
    <h5>
        <?php if (isset($shopping) && $shopping){?>
            <?php echo lang_admin('shopping_list');?>
        <?php  }else{ ?>
        <?php echo lang_admin('content_list');?>
        <?php } ?>
    </h5>
    <div class="blank20"></div>
    <div class="box" id="box">

        <div class="listform" style="position: relative;">
            <!-- 内容列表 -->
            <form name="listform" id="listform"  action="<?php echo uri();?>" method="post"  onsubmit="return returnform(this)">

                <!-- 内容列表 -->
                <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9 pull-right archive-list" id="archive-list">
                    <div class="row">

                        <div class="pull-right">
                            <?php if(chkpower('archive_check')) { ?>
                                <?php if (isset($shopping) && $shopping){?>
                                    <a href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo $base_url;?>/index.php?case=config&act=system&set=shopping&admin_dir=<?php echo get('admin_dir');?>"  class="btn btn-info" data-dataurlname="<?php echo lang_admin('shopping').lang_admin('set_up');?>">
                                        <?php echo lang_admin('shopping').lang_admin('set_up');?>
                                    </a>
                                    <input type="button" value="<?php echo lang_admin('modified_unit_price_for_input');?>" name="updateprice" onclick="var newprice = prompt ('<?php echo lang_admin('modified_unit_price_for_input');?>:','0'); if(getSelect(this.form) && newprice!=''){this.form.action='<?php echo modify('act/updateprice/catid/'.get('catid'),true);?>';this.form.batch.value=newprice;  returnform(this.form);}" class="btn btn-gray"/>

                                    &nbsp;<a href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo url::create('table/list/table/archive/needcheck/1/shopping/1');?>"  class="btn btn-gray" data-dataurlname="<?php echo lang_admin('unaudited_shopping');?>">
                                        <?php echo lang_admin('unaudited_shopping');?>
                                    </a>&nbsp;
                                <?php  }else{ ?>
                                    <a href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo url::create('table/list/table/archive/needcheck/1');?>"  class="btn btn-gray" data-dataurlname="<?php echo lang_admin('unaudited_content');?>">
                                        <?php echo lang_admin('unaudited_content');?>
                                    </a>
                                <?php  } ?>
                            <?php } ?>
                            <?php if (isset($shopping) && $shopping){?>
                                <a href="#"  onclick="gotourl(this)"  data-dataurl='<?php echo url::modify("table/".get('table')."/deletestate/1/page/1/shopping/1",true);?>'  class="btn btn-gray" data-dataurlname="<?php echo lang_admin('recycle_bin');?>">
                                    <?php echo lang_admin('recycle_bin');?>
                                </a>

                            <?php  }else{ ?>
                                <a href="#"  onclick="gotourl(this)"  data-dataurl='<?php echo url::modify("table/".get('table')."/deletestate/1/page/1",true);?>'  class="btn btn-gray" data-dataurlname="<?php echo lang_admin('recycle_bin');?>">
                                    <?php echo lang_admin('recycle_bin');?>
                                </a>
                            <?php  } ?>
                        </div>

                        <div class="pull-left">
                            <?php if (isset($shopping) && $shopping){?>

                                <a href="#"  onclick="gotourl(this)"  data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=add&table=archive&shopping=1&admin_dir=<?php echo get('admin_dir');?>"  class="btn btn-success" data-dataurlname="<?php echo lang_admin('adding_shopping');?>">
                                    <?php echo lang_admin('adding_shopping');?>
                                </a>

                            <?php  }else{ ?>
                                <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo $base_url;?>/index.php?case=table&act=add&table=archive&admin_dir=<?php echo get('admin_dir');?>"  class="btn btn-info" data-dataurlname="<?php echo lang_admin('adding_content');?>">
                                    <?php echo lang_admin('adding_content');?>
                                </a>
                            <?php  } ?>
                        </div>

                        <div class="blank10"></div>
                        <div class="line"></div>
                        <div class="blank20"></div>

                        <select id="sorting"  onchange="setPX()" name="pxType" class="form-control select" style="display: inline; width:auto;">
                            <option value="0" ><?php echo lang_admin('modification_time_positive_order');?></option>
                            <option value="1" ><?php echo lang_admin('modification_time_reverse_order');?></option>
                            <option value="2"><?php echo lang_admin('add_time_positive_order');?></option>
                            <option value="3"><?php echo lang_admin('add_time_reverse_order_');?></option>
                            <option value="4"><?php echo lang_admin('browsing_volume_positive_order');?></option>
                            <option value="5"><?php echo lang_admin('browse_volume_reverse_order');?></option>
                            <option value="6"><?php echo lang_admin('by_serial_number_positive_order');?></option>
                            <option value="7"><?php echo lang_admin('number_in_reverse_order');?></option>
                            <option value="8"><?php echo lang_admin('by_id_positive_order');?></option>
                            <option value="9"><?php echo lang_admin('by_id_in_reverse_order');?></option>
                            <?php if (isset($shopping) && $shopping){?>
                                <option value="10"><?php echo lang_admin('by_salesnum_reverse_order');?></option>
                                <option value="11"><?php echo lang_admin('by_salesnum_in_reverse_order');?></option>
                            <?php  } ?>
                        </select>
                        <div class="blank10"></div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr class="th">
                                    <th class="s_out text-center"><input title="<?php echo lang_admin('click_to_select_all_items_on_this_page');?>"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                                    <th class="htmldir text-center"><!--id--><?php echo lang_admin('ID');?></th>
                                    <th class="sort text-center"><abbr title="<?php echo lang_admin('the_smaller_the_value_the_higher');?>"><?php echo lang_admin('sort');?></abbr></th>
                                    <th class="catname"><!--title--><?php echo lang_admin('title');?></th>
                                    <?php if ((isset($shopping) &&  $shopping) || get('manage_spid') || get('typeid')){?>
                                        <th class=""><?php echo lang_admin('stock');?></th>
                                    <?php  } ?>
                                    <th class="htmldir text-center"><!--view--><?php echo lang_admin('browse');?></th>
                                    <th class="htmldir text-center"><!--adddate--><?php echo lang_admin('add_time');?></th>

                                    <th class="htmldir text-center"><!--checked--><?php echo lang_admin('to_examine');?></th>

                                    <th class="manage"><?php echo lang_admin('dosomething');?></th>
                                </tr>

                                </thead>
                                <tbody>
                                <?php if(is_array($data))
                                    foreach($data as $d) { ?>
                                        <tr>

                                            <td class="s_out text-center"><input onclick="c_chang(this)" type="checkbox" value="<?php echo $d[$primary_key];?>" name="select[]" class="checkbox" /> </td>
                                            <td class="htmldir text-center"><?php echo cut($d['aid']);?></td>
                                            <td class="sort text-center"><?php echo form::input("listorder[$d[$primary_key]]",$d['listorder'],'class="input_c"');?></td>
                                            <td align="left" class="catname"><?php echo cut($d['title']);?></td>

                                            <?php if (( isset($shopping) && $shopping) || get('manage_spid') || get('typeid')){?>
                                                <td><?php echo cut($d['inventory']);?></td>
                                            <?php  } ?>
                                            <td class="htmldir text-center"><?php echo cut($d['view']);?></td>
                                            <td class="htmldir text-center"><?php echo cut($d['adddate']);?></td>
                                            <td class="htmldir text-center"><?php echo helper::yes($d['checked']);?></td>
                                            <td class="manage">

                                                <?php if(chkpower('archive_check') || $d['checked']==0){?><a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/deletestate/".front::get('deletestate'));?>" title="<?php echo lang_admin('edit');?>" class="btn btn-gray" data-dataurlname="<?php echo lang_admin('edit_content');?>"><?php echo lang_admin('edit');?></a><?php } ?>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php echo lang_admin('more');?> <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href='<?php if($d['linkto']){echo $d['linkto'];}elseif(front::get('site')!='default'){echo config::get('site_url').'index.php?case=archive&act=show&aid='.$d[$primary_key];}else{echo url("archive/show/aid/$d[$primary_key]",false);}?>' target="_blank" title="<?php echo lang_admin('see');?>"><?php echo lang_admin('see');?></a></li>
                                                        <li><a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("/act/copy/table/$table/id/$d[$primary_key]");?>" title="<?php echo lang_admin('copy');?>" data-dataurlname="<?php echo lang_admin('copy_content');?>"><?php echo lang_admin('copy');?></a></li>
                                                        <li role="separator" class="divider"></li>
                                                        <li><a onclick="if(confirm('<?php echo lang_admin('deleted_to_the_recycle_bin');?>')){gotourl(this);}" href="#"  data-dataurl="<?php echo modify("/act/deletestate/table/$table/id/$d[$primary_key]/token/$token/catid/".get('catid'));?>" title="<?php echo lang_admin('deleted_to_the_recycle_bin');?>"><?php echo lang_admin('delete');?></a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>

                        <div class="blank10"></div>
                        <p style="color:#c0c0c0;"><i class="icon-info"></i> <?php echo lang_admin('the_smaller_the_value_the_higher');?></p>
                        <div class="blank10"></div>
                        <!--复制到其他语言-->
                        <?php if(config::get('lang_open')=='1') { ?>
                            <span class="pull-right">
                                 <input type="hidden" name="copylangcatid" value="">
                                 <input type="hidden" name="langurlname" value="">
                                 <select  id="copytolang" name="copytolang" class="selectpicker" multiple data-max-options="1" data-live-search="true">
                                        <option value="0" selected><?php echo lang_admin('please_select_language');?></option>
                                        <?php if(is_array(getlang()))
                                            foreach(getlang() as $i => $d) { ?>
                                                <option value="<?php echo $d['langurlname'];?>"><?php echo $d['langname'];?></a></option>
                                            <?php } ?>
                                    </select>
                                    <input type="button" value="<?php echo lang_admin('copy');?>"
                                       onclick="copylang(this.form)" class="btn btn-gray pull-right" style="margin-left:5px;">
                                    <script>
                                        function copylang(thisfrom){
                                            if(!getSelect(thisfrom)){
                                                alert('<?php echo lang_admin('please_choose');?><?php echo lang_admin('content');?>');
                                            }else{
                                                var checkParam = $('#copytolang').find('option:selected');
                                                // 选中的ID集合
                                                var checkId = [];
                                                for (var i=0;i<checkParam.length;i++) {
                                                    checkId.push($(checkParam[i]).val());
                                                }
                                                var copytolang_id = checkId.join(',');
                                                if(copytolang_id==0){
                                                    alert('<?php echo lang_admin('please_select_language');?>');
                                                }else{
                                                    thisfrom.action='<?php echo url('table/batch/table/'.$table,true);?>';
                                                    thisfrom.batch.value='copytolang';
                                                    thisfrom.langurlname.value=copytolang_id;
                                                    get_copylang(copytolang_id);
                                                    $('#mycopyModal').modal('show');/*returnform(this.form);*/
                                                }
                                            }
                                        }
                                    </script>
                            </span>
                        <?php } ?>
                        <input type="hidden" name="batch" value="">
                        <?php  if(!front::get('deletestate') && chkpower('archive_check')) {?>
                            <input  class="btn btn-gray" type="button" value=" <?php echo lang_admin('sort');?> " name="order" onclick="this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>'; this.form.batch.value='listorder'; returnform(this.form)"/>



                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo lang_admin('to_examine');?> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-del">


                                    <?php  if(!front::get('deletestate') && chkpower('archive_check')) {?>
                                        <li>
                                            <input type="button" value=" <?php echo lang_admin('to_examine');?> " name="check" onclick="if(getSelect(this.form)  && confirm('<?php echo lang_admin('are_audits_confirmed');?>')){ this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>';this.form.batch.value='check';returnform(this.form);}" class="btn btn-default" />
                                        </li>
                                    <?php } ?>

                                    <?php  if(!front::get('deletestate') && chkpower('archive_check')) {?>
                                        <li>
                                            <input type="button" value=" <?php echo lang_admin('cancellation_of_audit');?> " name="check" onclick="if(getSelect(this.form)  && confirm('<?php echo lang_admin('are_you_sure_to_cancel_the_audit');?>')){ this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>';this.form.batch.value='nocheck';returnform(this.form);}" class="btn btn-default" />
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                        <?php } ?>

                        <?php if(chkpower('archive_del')){ ?>

                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo lang_admin('delete');?> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-del">
                                <li>
                                    <?php if(!front::get('deletestate')) {?>
                                        <input type="button" value="<?php echo lang_admin('deleted_to_the_recycle_bin');?>" name="delete" onclick="if(getSelect(this.form) && confirm('<?php echo lang_admin('deleted_to_the_recycle_bin');?>')){this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>'; this.form.batch.value='deletestate'; returnform(this.form);}" />
                                    <?php } ?>
                                </li>
                                <li>
                                    <input type="button" value="<?php if(get('table')=='archive') {?><?php echo lang_admin('thorough_del');?><?php } ?>" name="delete" onclick="if(getSelect(this.form) && confirm('<?php echo lang_admin('are_you_sure_you_want_to_delete_it');?>')){this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>'; this.form.batch.value='delete'; returnform(this.form);}" />
                                </li>
                            </ul>
                            <?php } ?>
                        </div>

                        <?php if(get('table')=='archive' && front::get('deletestate')) {?>
                            <div class="btn-group dropup">
                                <input type="button" value=" <?php echo lang_admin('reduction');?> " name="restore" onclick="if(getSelect(this.form) && confirm('<?php echo lang_admin('are_you_sure_about_reduction');?>')){this.form.action='<?php echo modify('act/batch/catid/'.get('catid'),true);?>'; this.form.batch.value='restore';  returnform(this.form);}" class="btn btn-gray" />
                            </div>
                        <?php } ?>



                        <!-- 多选 -->
                        <style type="text/css">
                            .blank30-1450 {display:none; }
                            .multiple-selection {float:right;}
                            @media(max-width:1450px) {
                                .blank30-1450 {
                                    display: block; claer:both; height:10px;
                                }
                                .multiple-selection {float:left;}
                            }
                            .multiple-selection select {margin-bottom:10px;}
                        </style>
                        <div class="blank30-1450"></div>

                        <script type="text/javascript">
                            $("#specialid option:eq(0)").text("<?php echo lang_admin('multiple_choices_to_join_the_theme');?>");
                            $("#typeid option:eq(0)").text("<?php echo lang_admin('multiple_choices_to_join_the_type');?>");
                            $("#catid option:eq(0)").text("<?php echo lang_admin('multiple_selection_move_to_column');?>");
                            $("#attr1 option:eq(0)").text(" <?php echo lang_admin('setting_recommendation_bits_by_multiple_choices');?>");
                        </script>

                        <div class="form-inline multiple-selection">
                            <?php  if(!front::get('deletestate') && chkpower('archive_check')) {?>
                            <div class="form-group" name="archive_group">

                                    <?php if(chkpower('archive_setting')){?>
                                        <?php
                                        preg_match_all('/\(([\d\w]+)\)(\S+)/im', isset($settings['attr1'])?$settings['attr1']:"", $result, PREG_SET_ORDER);
                                        foreach($result as $val){
                                            $result[$val['1']]=$val['2'];
                                        }
                                        $result['0']=lang_admin('please_choose').' ...';
                                        if(count($result)>1){
                                            $option='multiple data-max-options="1" data-live-search="true" class="selectpicker" ';
                                            $option.="onchange=\"if(getSelect(this.form)  && confirm('".lang_admin('are_you_sure_about_the_settings')."')){ this.form.action='".modify('act/batch/catid/'.get('catid'),true)."';this.form.batch.value='recommend';returnform(this.form);}\"";
                                            echo form::select('attr1',0,$result,$option);
                                        }
                                        ?>
                                    <?php } ?>
                                <!-- 多选结束 -->
                                <?php
                                    $option="onchange=\"if(getSelect(this.form)  && confirm('".lang_admin('are_you_sure_you_want_to_move')."')){this.form.action='". modify('act/batch/catid/'.get('catid'),true)."';this.form.batch.value='movelist';returnform(this.form);}\"";
                                ?>
                                <select  id="catid" name="catid" class="selectpicker" multiple data-max-options="1" data-live-search="true" {$option}>
                                    <option>option1</option>
                                </select>
                                <?php  if(file_exists(ROOT."/lib/table/type.php")) { ?>
                                    <?php
                                        $option="onchange=\"if(getSelect(this.form)  && confirm('".lang_admin('are_you_sure_you_want_to_join_us')."')){ this.form.action='".modify('act/settype/catid/'.get('catid'),true)."';this.form.batch.value='settype';returnform(this.form);}\"";
                                    ?>
                                    <select  id="typeid" name="typeid" class="selectpicker" multiple data-max-options="1" data-live-search="true" {$option}>
                                        <option>option1</option>
                                    </select>
                                <?php  } ?>
                                <?php  if(file_exists(ROOT."/lib/table/special.php")) { ?>
                                <?php
                                    $option="onchange=\"if(getSelect(this.form)  && confirm('".lang_admin('are_you_sure_you_want_to_join_us')."')){ this.form.action='".modify('act/setspecial/catid/'.get('catid'),true)."';this.form.batch.value='setspecial';returnform(this.form);}\"";
                                ?>
                                <select  id="specialid" name="specialid" class="selectpicker" multiple data-max-options="1" data-live-search="true" {$option}>
                                    <option>option1</option>
                                </select>
                                <?php  } ?>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="blank20"></div>
                        <div class="line"></div>

                        <div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::adminhtml($record_count); ?></div>

                        <div class="clearfix blank30"></div>
                    </div>
                </div>
            </form>

            <!-- 内容列表侧边栏 -->
            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 pull-left archive-list-side" id="archive-list-side">

                <div class="archive-list-side-content">
                    <div class="outer-container">
                        <div class="inner-container">
                            <div class="archive-list-side-content-box">
                                <form name="searchform" id="searchform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this)">
                                    <a class="search-criteria-btn" style="text-decoration:underline;"><i class="icon-info"></i> <?php echo lang_admin('search_criteria');?></a>
                                    <div class="search-criteria" style="display:none;" name="archive_search">
                                        <div class="blank10"></div>
                                        {lang_admin('column')}  ：
                                        <select id="search_catid" name="search_catid" class="form-control select search_catid">
                                            <option value="0" selected="">{lang_admin('please_choose')}...</option>
                                        </select>
                                        <div class="blank10"></div>
                                        {lang_admin('type')}  ：
                                        <select id="search_typeid" name="search_typeid" class="form-control select search_typeid">
                                            <option value="0" selected="">{lang_admin('please_choose')}...</option>
                                        </select>
                                        <div class="blank10"></div>
                                        {lang_admin('special')}  ：
                                        <select id="search_spid" name="search_spid" class="form-control select search_spid">
                                            <option value="0" selected="">{lang_admin('please_choose')}...</option>
                                        </select>
                                        <div class="blank10"></div>
                                        {lang_admin('author')}  ：
                                        <select id="search_userid" name="search_userid" class="form-control select search_userid">
                                            <option value="0" selected="">{lang_admin('please_choose')}...</option>
                                        </select>
                                    </div>
                                    <div class="blank10"></div>
                                    <div class="backstage-search">
                                        <input type="text" class="form-control" name="search_title" id="search_title" placeholder="<?php echo lang_admin('please_fill_in_the_title');?>" value="" />
                                        <input type="hidden" name="search_static" value="1">
                                        <button type="submit" class="btn btn-default search-btn" name="search_static" onclick="this.form.action='<?php if(isset($shopping) && $shopping){ echo url::modify('table/'.get('table').'/type/search/shopping/1',true); }else{ echo url::modify('table/'.get('table').'/type/search',true);}?>'" >
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>

                                </form>

                                <?php if (isset($shopping) && $shopping){?>
                                    <?php if(config::getadmin('isecoding')=='1') { ?>
                                        <div class="blank10"></div>
                                        <div class="backstage-search">
                                            <form name='search' action="<?php echo uri(); ?>" onsubmit="return returnform(this)" method="post">
                                                <input type="text" name="ecoding_title" id="ecoding_title" value="" placeholder="<?php echo lang_admin('security_code_search');?>" class="form-control" />
                                                <input type="hidden" name="search_static" value="1">
                                                <button type="submit" class="btn btn-default search-btn" name="submit" onclick="this.form.action='<?php if(isset($shopping) && $shopping){ echo url::modify('table/'.get('table').'/type/search/shopping/1',true); }else{ echo url::modify('table/'.get('table').'/type/search',true);}?>'" >
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>

                                            </form>
                                        </div>
                                    <?php } ?>
                                <?php  } ?>
                                <div class="blank30"></div>
                                <div class="btn btn-default">
                                    <?php echo lang_admin('by_column_manage');?>
                                </div>

                                <div class="blank10"></div>
                                <form name="leftlistform" id="leftlistform"  action="<?php echo uri();?>" method="post">

                                        <div class="blank30"></div>
                                        <div class="blank30"></div>
                                        <div class="blank30"></div>
                                    <center>
                                        <img name="loading_type" src="<?php echo $base_url;?>/images/loading.gif" style="max-width:128px;" />
                                    </center>
                                </form>

                                <div class="blank10"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank10"></div>
    </div>
    <div class="clearfix"></div>
</div>



<!-- 当前页面的js -->
<script type="text/javascript" src="<?php echo $base_url.'/template_admin/'.front::$view->_style;?>/table/archive/list.js"></script>
<!-- 复制框Modal -->
<div class="modal fade" id="mycopyModal" tabindex="-1" role="dialog" aria-labelledby="mycopyModal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang_admin('copy');?></h4>
            </div>
            <div class="modal-body" style="margin: 0px 35px 0px 35px;overflow:hidden;">

                <label style="font-size:14px;"><?php echo lang_admin("please_select_the_column");?></label>
                <input name="copytolang_catid" type="hidden" value="">
                <select  id="copytolang_catid" class="selectpicker" multiple data-max-options="1" data-live-search="true" >
                    <option>option1</option>
                </select>

                <div class="blank20"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="archive_copy"  name="archive_copy" class="btn btn-success"><?php echo lang_admin('copy');?></button>
                <button type="button" id="closmode" name="app_clos" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin("close");?></button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {
        //选中
        $("#sorting option[value='<?php echo $sorting;?>']").prop("selected",true);
    });
    function setPX() {
        var path= '<?php if(isset($shopping) && $shopping){ echo modify("act/list/table/archive/shopping/1/catid/".get('catid')); }else{ echo modify("act/list/table/archive/catid/".get('catid')); }  ?>&sorting='+$("#sorting").val();
        gotoinurl(path);
    }

    //复制框加载 下拉栏目
    function get_copylang(langurlname) {
        var shopping = 0;
        <?php if (isset($shopping) && $shopping){?>
        shopping = 1;
        <?php  } ?>
        $.ajax({
            url: "<?php echo url('table/getcopylangcatory/table/archive' , true);?>&langurlname=" + langurlname + "&shopping=" + shopping,
            type: 'GET',
            dataType: 'text',
            timeout: 10000,
            success: function (data) {
                var codedata = JSON.parse(data);
                $("#copytolang_catid").html(codedata);
                $('#copytolang_catid').selectpicker("refresh");
                $('#copytolang_catid').selectpicker('render');
                /* $("#tag7").html(codedata[1]);*/
            }
        });
    }
</script>

