


<div class="main-right-box">
    <h5>{lang_admin('batch_import')}<!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div></h5>

    <div class="box" id="box">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a data-dataurlname="<?php echo lang_admin('batch_import');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('table/import/table/archive');?>" name="<?php echo lang_admin('batch_import');?>">
                    <?php echo lang_admin('batch_import');?>
                </a>
            </li>
            <li>
                <a data-dataurlname="<?php echo lang_admin('import_wordpress_data');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('database/wordpress');?>" name="<?php echo lang_admin('import_wordpress_data');?>">
                    <?php echo lang_admin('import_wordpress_data');?>
                </a>
            </li>
            <li class="active">
                <a data-dataurlname="<?php echo lang_admin('import_dede_data');?>" onclick="gotourl(this)"  data-dataurl="<?php echo url::create('database/inputdede');?>" name="<?php echo lang_admin('import_dede_data');?>">
                    <?php echo lang_admin('import_dede_data');?>
                </a>
            </li>

        </ul>
        <div class="blank30"></div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('tips')}</div>
            <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                <div class="alert alert-warning alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="glyphicon glyphicon-warning-sign"></span>	{lang_admin('batch_import_compatibility')}

                </div>
            </div>
        </div>
        <form action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
              method="post" enctype="multipart/form-data" name="form1"  onsubmit="return returnform(this);">
            <input type="hidden" name="onlymodify" value=""/>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('batch_import')}</div>
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    <input id="attachment_id" name="attachment_id" value="" type="hidden">
                    <input id="attachment_intro" name="attachment_intro" value="" type="hidden">
                    <input id="attachment_path" name="attachment_path" value="" type="text" class="form-control">
                    <div class="blank10"></div>
                    <a href="javascript:;" class="file">{lang_admin('select_files')}
                        <input type="file" name="excelFile" id="excelFile">
                    </a>

                    <input type="button"  name="filebuttonUpload"  id="filebuttonUpload"
                           onclick="return ajaxFileUpload('excelFile','{url('tool/uploadfile',false)}','#uploading');" value="{lang_admin('upload')}" class="btn btn-primary" />
                    <img id="uploading" src="{$base_url}/images/loading.gif" style="display:none;">
                    <input class="btn btn-danger" value="{lang_admin('delete')}" type="button" name="delbutton"  onclick="attachment_delect(get('attachment_id').value)" />
                </div>
            </div>
            <div class="blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('tips')}</div>
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    <div class="alert alert-warning alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <span class="glyphicon glyphicon-warning-sign"></span>	如需导入自定义内容字段，在对应的表格ID内输入自定义字段值！

                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('设置导入字段')}</div>
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>字段名</th>
                                <th>分类</th>
                                <th>字段说明</th>
                                <th>对应导入表格ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($field as $key=>$val){
                                $name=$val['name'];
                                if (!preg_match('/^my_/', $name) || preg_match('/^my_field/', $name)) {
                                    continue;
                                }
                                $newname="cname_".lang::getisadmin();
                                switch (setting::$var['archive'][$name]['type']){
                                    case "int":
                                        $typename=lang_admin('integer');
                                        break;
                                    case "varchar":
                                        $typename=lang_admin('one_line_text');
                                        break;
                                    case "text":
                                        $typename=lang_admin('multi_line_text');
                                        break;
                                    case "mediumtext":
                                        $typename=lang_admin('hypertext');
                                        break;
                                    case "datetime":
                                        $typename=lang_admin('date');
                                        break;
                                    case "image":
                                        $typename=lang_admin('picture');
                                        break;
                                    case "file":
                                        $typename=lang_admin('file');
                                        break;
                                    default:
                                        $typename=lang_admin('one_line_text');
                                        break;
                                };
                                ?>
                                <tr>
                                    <td>
                                        {$val['name']}
                                    </td>
                                    <td><?php echo $typename; ?></td>
                                    <td><?php echo setting::$var['archive'][$name][$newname]; ?></td>
                                    <td><input type="text" value="" name="{$val['name']}" class="form-control"></td>

                                </tr>
                            <?php };?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="blank20"></div>
            <div class="line"></div>
            <div class="blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input id="attachment_id" name="submit" value="1" type="hidden">
                    <input type="submit"  value="{lang_admin('submitted')}" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>
        <div class="blank20"></div>
    </div>
</div>

