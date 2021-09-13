<!-- 多选框 -->
<link rel="stylesheet" href="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/css/bootstrap-select.css">
<script type="text/javascript" src="{$base_url}/common/css/bootstrap/bootstrap-3.3.7/js/bootstrap-select.js"></script>
<style type="text/css">
    @media(max-width:468px) {
        input#title {width:100%;}
        .edit-category .text-left {margin:0px; padding:0px 5px;}
    }
    span.hotspot {float:right; padding-left:10px;}
    .content-nav-tabs .dropdown-menu>.active>a, .content-nav-tabs .dropdown-menu>.active>a:focus, .content-nav-tabs .dropdown-menu>.active>a:hover {
        background:#3b3b3b;
        color:#fff;
    }
</style>
<div class="main-right-box">
    <div class="box edit-category" id="box">
        <form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
              onsubmit="return checkform(this);">
            <input type="hidden" name="onlymodify" value=""/>
            <h5>
                <?php if($shopping  && file_exists(ROOT."/lib/table/shopping.php")){ ?>
                    <?php echo lang_admin('edit_shopping_column');?>
                <?php }else{ ?>
                    <?php echo lang_admin('edit_content_column');?>
                <?php } ?>
                <!--工具栏-->
                <div class="content-eidt-nav pull-right">
                    <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                        <i class="icon-frame"></i>
                        <?php echo lang_admin('container_fluid');?>
                    </a>
                    <span class="pull-right">
                    <div class="btn-group">
                       <select id="isnav" name="isnav" class="form-control select isnav">
                            <option value="1" <?php  if($data['isnav']){?>selected=""<?php  }?>><?php echo lang_admin('show');?></option>
                            <option value="0" <?php  if(!$data['isnav']){?>selected=""<?php  }?>><?php echo lang_admin('no_show');?></option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select id="isshow" name="isshow" class="form-control select isshow">
                            <option value="1" selected="">
                                <?php echo lang_admin('to_examine');?>
                            </option>
                            <option value="0">
                                <?php echo lang_admin('cancellation_of_audit');?>
                            </option>
                        </select>
                    </div>
                    <input  name="submit" value="1" type="hidden">
                        <button class="btn btn-success" type="submit" onclick="mysave()">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>
                   <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url('table/list/table/category');?>" data-dataurlname="<?php echo lang_admin('column_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                     <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
</a>
                </span>
                </div>
            </h5>

            <!--所属栏目-->
            <?php if(isset($shopping) && $shopping && file_exists(ROOT."/lib/table/shopping.php")){
                $data['catidshopping']=$data['parentid'];  ?>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('subordinate_columns');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input name="catidshopping" type="hidden" value="">
                        <select  id="catidshopping" class="selectpicker" multiple data-max-options="1" data-live-search="true" >
                            <option>option1</option>
                        </select>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_its_a_first_level_column_you_dont_need_to_choose_it');?>"></span>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('subordinate_columns');?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <input name="parentid" type="hidden" value="">
                        <select  id="parentid" class="selectpicker" multiple data-max-options="1" data-live-search="true" >
                            <option>option1</option>
                        </select>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_its_a_first_level_column_you_dont_need_to_choose_it');?>"></span>
                    </div>
                </div>
            <?php } ?>
            <div class="clearfix blank20"></div>
            <!--栏目名-->
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><span class="icon-note"></span>&nbsp;<?php echo lang_admin('name');?></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="text" class="form-control"  value="<?php echo $data['catname'];?>" name="catname" id="catname" />
                    <p name="messagecatname" style="color: red"></p>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('please_fill_in_the_column_name');?>"></span>
                </div>
            </div>
            <div class="clearfix blank10"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-10 text-left">
                    <ul class="nav nav-tabs content-nav-tabs" role="tablist">
                        <!--信息-->
                        <li role="presentation"><a href="#tag1" aria-controls="#tag1" role="tab" data-toggle="tab"><?php echo lang_admin('information');?></a></li>
                        <!--图片-->
                        <li role="presentation"><a href="#tag3" aria-controls="#tag4" role="tab" data-toggle="tab"><?php echo lang_admin('picture');?></a></li>
                        <!--高级-->
                        <li role="presentation" class="dropdown">
                            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">
                                <?php echo lang_admin('senior');?>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                <!--seo-->
                                <li role="presentation"><a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab">SEO</a></li>
                                <!--权限-->
                                <li role="presentation"><a href="#tag4" aria-controls="#tag4" role="tab" data-toggle="tab"><?php echo lang_admin('jurisdiction');?></a></li>
                                <!--自定义-->
                                <li role="presentation"><a href="#tag5" aria-controls="#tag5" role="tab" data-toggle="tab"><?php echo lang_admin('custom');?></a></li>
                                <!--字段-->
                                <li role="presentation"><a href="#tag6" aria-controls="#tag6" role="tab" data-toggle="tab"><?php echo lang_admin('field');?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="tab-content">
                <!-- 信息 -->
                <div role="tabpanel" class="tab-pane active" id="tag1">
                    <!-- 封面内容 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('news_coverage');?></div>
                        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 text-left">
                            <?php echo form::getform('categorycontent',$form,$field,$data);?>
                            <p><i class="icon-info"></i> <?php echo lang_admin('if_you_use_the_settings_section_cover_please_select_the_list_page_html_template_for_this_section_at_the_template');?></p>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <style type="text/css">
                        #categorycontent {min-height:500px;}
                        @media(max-width:468px) {
                            #categorycontent {min-height:300px;}
                            #categorycontent #edui1 {width:100%;}
                        }
                    </style>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input name="savehttppic" type="checkbox" value="1" id="pic1" />&nbsp;<?php echo lang_admin('save_remote_images');?>&nbsp;
                        </div>
                    </div>
                </div>
                <!-- SEO -->
                <div role="tabpanel" class="tab-pane" id="tag2">
                    <!-- 网页标题 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('page_title');?>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('meta_title',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('it_can_fill_in_keywords_different_from_content_names_which_is_beneficial_to_search_optimization');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 网页关键词 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                            <span class="icon-note"></span>&nbsp;<?php echo lang_admin('key_word');?>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('keyword',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('the_keywords_information_in_meta_information_can_be_filled_in_the_keywords_related_to_the_content_separated_by_commas_in_english_which_is_conducive_to_search_optimization');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 网页描述 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><span class="icon-note"></span>&nbsp;<?php echo lang_admin('page_description');?>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('description',$form,$field,$data,'');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('description_information_in_meta_information_can_fill_in_content_related_profiles_which_is_conducive_to_search_optimization');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 链接属性 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('no_collection');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('nofollow',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_link_properties_are_enabled');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- html -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">HTML</div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('ishtml',$form,$field,$data);?>
                            <p class="tips-p"><?php echo lang_admin('when_html_is_generated_by_separate_settings_columns_in_dynamic_and_static_settings_must_be_selected_as_specified_and_columns_in_dynamic_and_static_generation_need_to_generate_html');?></p>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('select_whether_the_column_is_static_such_as_setting_the_browse_and_download_permissions_must_be_dynamic_the_default_is_to_inherit_the_static_and_dynamic_settings_of_the_website');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="alert alert-warning alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <span class="glyphicon glyphicon-warning-sign"></span>	<strong>URL</strong>	[<?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?>]
                            </div>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 当前url规则 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('list_url');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <!--  <input name="htmlrule1" type="text" class="form-control" value="<?php echo $data['htmlrule'];?>"/>
                              <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?>"></span>
                              <div class="clearfix blank20"></div>-->
                            <?php echo form::getform('htmlrule',$form,$field,$data,'');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 子列表url规则 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('sublist_url');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <!-- <input name="listhtmlrule1" type="text" class="form-control" value="<?php echo $data['listhtmlrule'];?>"/>
                             <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('select_whether_the_content_is_generated_static_such_as_setting_the_browsing_and_downloading_permissions_must_be_dynamic_display_the_default_is_static_and_dynamic_settings_for_inheritance_columns');?>"></span>
                             <div class="clearfix blank20"></div>-->
                            <?php echo form::getform('listhtmlrule',$form,$field,$data,'');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('select_whether_the_content_is_generated_static_such_as_setting_the_browsing_and_downloading_permissions_must_be_dynamic_display_the_default_is_static_and_dynamic_settings_for_inheritance_columns');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 内容url规则 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('content_url');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('showhtmlrule',$form,$field,$data,'class=""');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 自定义url -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('custom_url');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-9 col-lg-5 text-left">
                            <?php echo form::getform('set_htmlrule',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('if_you_are_not_familiar_with_the_operation_please_do_not_modify_the_following_options');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>
                <!-- 图片 -->
                <div role="tabpanel" class="tab-pane" id="tag3">
                    <!-- 栏目图片 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('column_pictures');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('image',$form,$field,$data);?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 栏目banner -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('column_banner');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('banner',$form,$field,$data);?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>
                <!-- 权限 -->
                <div role="tabpanel" class="tab-pane" id="tag4">
                    <?php if(session::get('ver') == 'corp'){ ?>
                        <!-- 阅读收费 -->
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('read_menoy');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('readmenoy',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('read_menoy');?>"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <!-- 下载收费 -->
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('domw_menoy');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('domwmenoy',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('domw_menoy');?>"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <script type="text/javascript">
                            $(function () {
                                if(parseInt( $("#readmenoy").val())>0){
                                    $("#domwmenoy").val('0');
                                    $("#domwmenoy").attr("disabled","disabled");
                                }else{
                                    $("#readmenoy").val('0');
                                    $("#domwmenoy").removeAttr("disabled");
                                }
                            });
                            //阅读收费和下载收费校验
                            $("#readmenoy").change(function(){
                                if(parseInt($(this).val())>0){
                                    $("#domwmenoy").val('0');
                                    $("#domwmenoy").attr("disabled","disabled");
                                }else{
                                    $("#readmenoy").val('0');
                                    $("#domwmenoy").removeAttr("disabled");
                                }
                            });
                        </script>
                    <?php }  ?>
                    <!-- 浏览下载权限 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('jurisdiction');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="th">
                                        <th><?php echo lang_admin('user_group');?></th>
                                        <th class="text-center"><?php echo lang_admin('browse');?></th>
                                        <th class="text-center"><?php echo lang_admin('download');?></th>
                                    </tr>
                                    <thead>
                                    <tbody>
                                    <?php if(is_array(usergroup::getInstance()->group))
                                        foreach(usergroup::getInstance()->group as $group) { ?>
                                            <?php if($group['groupid']=='888') continue; ?>
                                            <tr>
                                                <td><?php echo $group['name'];?></td>
                                                <td class="text-center"><?php echo form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view']);?></td>
                                                <td class="text-center"><?php echo form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down']);?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="blank30"></div>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <span class="glyphicon glyphicon-warning-sign"></span>	 <?php echo lang_admin('check_to_prohibit_browsing_or_downloading_for_this_user_group');?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 自定义 -->
                <div role="tabpanel" class="tab-pane" id="tag5">
                    <!--副标题-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('subtitle');?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('subtitle',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('column_custom_subtitle');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!--栏目目录-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('catalog_name');?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('htmldir',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('catalogues_must_be_english_names_if_left_blank_the_pinyin_names_will_be_used_automatically_do_not_mix_symbols');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 绑定语言 -->
                    <div class="row" style="display: none;">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('language_package_binding');?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-10 text-left">
                            <?php echo form::getform('langid',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title=""></span>
                        </div>
                    </div>
                    <!-- 排序 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('sort');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('listorder',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('column_sorting');?>" onmouseout="tooltip.hide();">
</span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 手机导航是否显示 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('mobile_navigation');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('ismobilenav',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_it_displayed_in_navigation');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 内容排序 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('content_sorting');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('contentrank',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('column_subordinate_content_ranking');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 栏目模板 -->
                    <?php if(isset($shopping) && $shopping && file_exists(ROOT."/lib/table/shopping.php")){ ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('commodity_template');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php $data['templateshopping']=isset($data['template'])?$data['template']:"";?>
                                <?php echo form::getform('templateshopping',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('the_template_style_used_in_the_current_column');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('column_template');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('template',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('the_template_style_used_in_the_current_column');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                    <?php }?>
                    <div class="clearfix blank20"></div>
                    <!-- 子列表模板 -->
                    <?php if(isset($shopping) && $shopping && file_exists(ROOT."/lib/table/shopping.php")){
                        $data['listshoppingtemplate']=isset($data['listtemplate'])?$data['listtemplate']:"";
                        $data['showshoppingtemplate']=isset($data['showtemplate'])?$data['showtemplate']:"";?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('sublist');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('listshoppingtemplate',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('subordinate_columns_of_the_column_apply_template_style');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <!-- 内容模板 -->
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('commodity_content');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('showshoppingtemplate',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('column_subordinate_content_page_template_style');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('sublist');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('listtemplate',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('subordinate_columns_of_the_column_apply_template_style');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('content');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('showtemplate',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('column_subordinate_content_page_template_style');?>" onmouseout="tooltip.hide();"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php }?>
                    <!-- 手机模板 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('wap_template');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('templatewap',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('after_enabling_the_independent_mobile_version_template_the_current_column_template_style');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 手机子列表模板 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('wap_sublistwap');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('listtemplatewap',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('after_enabling_the_independent_mobile_version_template_the_subordinate_subcolumn_template_style');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 手机内容模板 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('wap_content');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('showtemplatewap',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('after_enabling_the_independent_mobile_version_template_the_template_style_of_the_subordinate_content_page');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 是否新窗口 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('new_window_opens');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('isblank',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('is_it_open_in_the_new_window');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>

                    <!-- 绑定表单 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('does_the_content_page_bind_the_form');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('showform',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('does_the_content_page_bind_the_form');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 是否筛选 -->
                    <?php if(session::get('ver') == 'corp'){ ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('screening_or_not');?></div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                <?php echo form::getform('isscreening',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('whether_to_join_the_screening');?>"></span>
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php } ?>
                    <!-- 分页 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('paging');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <td><?php echo form::getform('ispages',$form,$field,$data);?>
                                <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('select_whether_the_column_is_paginated');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 分页值 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('paging_value');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('attr3',$form,$field,$data,'class="input_c"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('leave_blank_to_display_according_to_the_number_of_global_settings');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 防伪码前缀 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('anti_counterfeiting_code_prefix');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('ecoding',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('set_anti_counterfeiting_code_prefix');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 列表是否包含子栏目内容 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('subcontent');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('includecatarchives',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('select_whether_the_column_list_contains_the_contents_of_the_subordinate_columns');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 跳转链接 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('jump');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('linkto',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('after_filling_in_the_external_link_address__the_access_column_will_jump_to_the_completed_address');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!-- 是否作为首页 -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('home_page');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform('isindex',$form,$field,$data,'class="form-control"');?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('setting_home');?>" onmouseout="tooltip.hide();"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <?php if(isset($shopping) && $shopping && file_exists(ROOT."/lib/table/shopping.php")){ ?>
                        <input type="hidden" name="isshopping" id="isshopping" value="1" />
                    <?php }else{ ?>
                        <input type="hidden" name="isshopping" id="isshopping" value="0" />
                    <?php } ?>
                    <script type="text/javascript">

                        function mysave() {
                            if (<?php echo $shopping;?>) {
                                $('#parentid').val($('#catidshopping').val());
                            }
                        }
                    </script>
                </div>
                <!-- 字段 -->
                <div role="tabpanel" class="tab-pane" id="tag6">
                    <?php if(is_array($field))
                        foreach($field as $f) { ?>
                            <?php
                            $name=$f['name'];
                            if (!preg_match('/^my_/', $name) || preg_match('/^my_field/', $name)) {
                                unset($field[$name]);
                                continue;
                            }
                            $category = category::getInstance();
                            setting::$var['archive'][$name]['catid']=isset(setting::$var['archive'][$name]['catid'])?setting::$var['archive'][$name]['catid']:"";
                            $sonids = $category->sons(setting::$var['archive'][$name]['catid']);
                            if(setting::$var['archive'][$name]['catid'] != $data['catid'] && !in_array($data['catid'],$sonids)
                                && (setting::$var['archive'][$name]['catid'])){
                                unset($field[$name]);
                                continue;
                            }
                            $category = category::getInstance();
                            $adminlang=lang::getisadmin();
                            setting::$var['category'][$name]['catid_'.$adminlang]=setting::$var['category'][$name]['catid_'.$adminlang]==""?0:setting::$var['category'][$name]['catid_'.$adminlang];
                            $sonids = $category->sons(setting::$var['category'][$name]['catid_'.$adminlang]);
                            $file_parentid=$data['parentid']==0?$data['catid']:$data['parentid'];
                            if(setting::$var['category'][$name]['catid_'.$adminlang] != $file_parentid && !in_array($file_parentid,$sonids)
                                && (setting::$var['category'][$name]['catid_'.$adminlang]) ){
                                unset($field[$name]);
                                continue;
                            }
                            if (!isset($data[$name]))
                                $data[$name]='';
                            ?>
                            <?php if( ((setting::$var['category'][$name]['isshoping'] == '0')|| (setting::$var['category'][$name]['isshoping'] == '')) ){?>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php
                                        $newcname='cname_'.lang::getisadmin();
                                        echo setting::$var['category'][$name][$newcname];
                                        $newselect='select_'.lang::getisadmin();
                                        $form[$name]['select']=setting::$var['category'][$name][$newselect];
                                        ?></div>
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                                        <?php echo"<style>div#$name.edui-default {width:100%;min-height:500px;}@media(max-width:468px) {div#$name.edui-default {width:100%;min-height:300px;}}</style>";?>
                                        <?php echo form::getform($name,$form, $field, $data); ?>
                                    </div>
                                </div>
                                <div class="clearfix blank20"></div>
                            <?php }?>
                        <?php } ?>
                </div>
            </div>
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" <?php echo lang_admin('submitted');?> "  onclick="mysave();" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>
        <div class="blank30"></div>
    </div>
</div>

<script type="text/javascript">
    var search_catid='<?php echo $data['parentid'];?>';
    var this_catid='<?php echo $data['catid'];?>';
    var base_url = '<?php echo $base_url;?>';
    function attachment_delect(id) {
        $.ajax({
            url: '<?php echo url('tool/deleteattachment/site/'.front::get('site'),false);?>&id='+id,
            type: 'GET',
            dataType: 'text',
            timeout: 1000,
            error: function(){
//	alert('Error loading XML document');
            },
            success: function(data){
                document.form1.attachment_id.value=0;
                get('attachment_path').innerHTML='';
                get('file_info').innerHTML='';
            }
        });
    }
    function get_field(catid) {
        $.ajax({
            url: '<?php echo url('table/getfield/table/category/thiscatid/'.$data['catid'],true);?>&catid='+catid,
            type: 'GET',
            dataType: 'text',
            timeout: 10000,
            error: function(){
                //alert('Error loading XML document');
            },
            success: function(data){
                var codedata=JSON.parse(data);
                $("#tag6").html(codedata[0]);
            }
        });
    }
</script>
<!-- 当前页面的js -->
<script type="text/javascript" src="<?php echo $base_url.'/template_admin/'.front::$view->_style;?>/table/category/edit.js"></script>

<!-- 上传 -->
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/ajaxfileupload/ThumbAjaxFileUpload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/common/js/upimg/dialog.js"></script>
<link href="<?php echo $skin_admin_path;?>/css/dialog.css" rel="stylesheet" type="text/css" />
<!-- 上传框 -->
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url;?>/common/plugins/fileinput/js/locales/zh.js" type="text/javascript"></script>
<link href="<?php echo $base_url;?>/common/plugins/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">
<!-- 百度编辑器 -->
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $base_url;?>/ueditor/addCustomizeButton.js"></script>
