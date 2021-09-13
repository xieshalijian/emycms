
<div class="modal fade" id="template-list-tag" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('list_style');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div style="padding:30px;">
                        <form method="post" name="frmclisttag" id="frmclisttag" action="">
                            <?php
                              if (get("isshopping")){
                                    $template_dir=config::get('template_shopping_dir');
                              }else{
                                    $template_dir=config::get('template_dir');
                              }

                              if (front::get("type")=="special"){
                                  $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listspecialtag/list.config.php');
                                  $img_url="/template/".$template_dir."/visual/list/listspecialtag/";
                              }
                              else if (front::get("type")=="type"){
                                  $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listtypetag/list.config.php');
                                  $img_url="/template/".$template_dir."/visual/list/listtypetag/";
                              }
                              else if (front::get("type")=="comment"){
                                  $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listcommenttag/list.config.php');
                                  $img_url="/template/".$template_dir."/visual/list/listcommenttag/";
                              }
                              else if (front::get("type")=="guestbook"){
                                  $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listguestbooktag/list.config.php');
                                  $img_url="/template/".$template_dir."/visual/list/listguestbooktag/";
                              }
                              else{
                                  $tplarray=include(ROOT.'/template/'.$template_dir.'/visual/list/listtag/list.config.php');
                                  $img_url="/template/".$template_dir."/visual/list/listtag/";
                              }

                            $tplarray_announ=include(ROOT.'/template/'.$template_dir.'/visual/list/listannountag/announ.config.php');

                            ?>
                                <input name="listnewmodulesname"  id="listnewmodulesname" type="hidden" value="">
                                <input name="listmodules_id" class="tagtemplate" id="listmodules_id" type="hidden" value="">
                                <input name="tagtemplate" class="tagtemplate" id="listtemplate" type="hidden" value="">

                                <?php if (is_array($tplarray)) foreach ($tplarray as $key=>$val){ $tagimg=str_replace(".html","",$key);?>
                                    <div class="tag-preview listtag" name="listtagimglist">
                                        <img src="<?php echo $img_url;?><?php echo $tagimg;?>/<?php echo $tagimg;?>.jpg" alt="<?php echo $val;?>"
                                             data-tagname="<?php echo $key;?>" name="listtagimg" />
                                        <div class="listtagimgtitle">
                                        <?php echo $val;?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php if (is_array($tplarray_announ)) foreach ($tplarray_announ as $key=>$val){ $tagimg=str_replace(".html","",$key);?>
                                    <div class="tag-preview announ" name="listtagimglist">
                                        <img src="/template/<?php echo $template_dir;?>/visual/list/listannountag/<?php echo $tagimg;?>/<?php echo $tagimg;?>.jpg" alt="<?php echo $val;?>"
                                             data-tagname="<?php echo $key;?>" name="listtagimg" />
                                        <div class="listtagimgtitle">
                                        <?php echo $val;?>
                                        </div>
                                    </div>
                                <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="saveListStyle" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var listHandel;
    var tag_sections_list=false;
    var template_type="listtemplate";
    $(document).ready(function () {

        //图片选择
        $("[name=listtagimg]").click(function(e) {
            $("#listtemplate").val($(this).data("tagname"));
            $("[name=listtagimglist]").removeClass("active");
            $(this).parent().addClass("active");
        });


        $('body.edit .visual-right').on("click", "[data-target='#template-list-tag']", function (e) {
            e.preventDefault();
            var type=$(this).data("type");
            if (type=="announ"){
                $("[name='frmclisttag'] .announ").attr("style","display: block;");
                $("[name='frmclisttag'] .listtag").attr("style","display: none;");
            }else{
                $("[name='frmclisttag'] .listtag").attr("style","display: block;");
                $("[name='frmclisttag'] .announ").attr("style","display: none;");
            }
            listHandel = $(this).parent().parent().parent().parent().find('.view');
            var eText = listHandel.find('.tag .tagname').html();
            eText = ReplaceAll(eText,'#[#','{');
            eText = ReplaceAll(eText,'#]#','}');
            var _tag_sections=new RegExp('tag_sections');
            if(_tag_sections.test(eText) )
            {
                tag_sections_list=true; //最新 模块样式修改
                $('#template-list-tag').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                var getlisttag='<?php echo url("template/getmodulestag/isshopping/".get('isshopping'));?>';
                if (visualcatid>0){
                    getlisttag+="&catid="+visualcatid;
                }
                $.post(getlisttag, {'tag': eText}, function (res) {
                    console.log(res);
                    var templatename="list";
                    <?php if (get("isshopping")){  ?>
                        if (res[0].hasOwnProperty('shoplisttemplate')){
                            templatename=res[0].shoplisttemplate;
                            template_type="shoplisttemplate";
                        }
                        else if (res[0].hasOwnProperty('shopannountemplate')){
                            templatename=res[0].shopannountemplate;
                            template_type="shopannountemplate";
                        }
                        else if (res[0].hasOwnProperty('shopcommentagtemplate')){
                            templatename=res[0].shopcommentagtemplate;
                            template_type="shopcommentagtemplate";
                        }
                        else if (res[0].hasOwnProperty('shoptypetemplate')){
                            templatename=res[0].shoptypetemplate;
                            template_type="shoptypetemplate";
                        }
                        else if (res[0].hasOwnProperty('shopspecialtemplate')){
                            templatename=res[0].shopspecialtemplate;
                            template_type="shopspecialtemplate";
                        }
                    <?php }else{ ?>
                        if (res[0].hasOwnProperty('listtemplate')){
                            templatename=res[0].listtemplate;
                            template_type="listtemplate";
                        } else if (res[0].hasOwnProperty('annountemplate')){
                            templatename=res[0].annountemplate;
                            template_type="annountemplate";
                        } else if (res[0].hasOwnProperty('commentagtemplate')){
                            templatename=res[0].commentagtemplate;
                            template_type="commentagtemplate";
                        } else if (res[0].hasOwnProperty('typetemplate')){
                            templatename=res[0].typetemplate;
                            template_type="typetemplate";
                        } else if (res[0].hasOwnProperty('specialtemplate')){
                            templatename=res[0].specialtemplate;
                            template_type="specialtemplate";
                        }

                    <?php };?>

                    $('#listnewmodulesname').val(res[0].newmodulesname);
                    $('#listtemplate').val(templatename);
                    $('#listmodules_id').val(res[0].id);
                    checkimg(templatename);
                }, 'json');
            }
            //console.log(navHandel);
            //contenthandle.setData(eText);
        });

        $("#saveListStyle").click(function (e) {
            e.preventDefault();
            //alert($("input[name=navstyle]:checked").val());

            if(template_type=="listtemplate"){
                data = {'listtemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="shoplisttemplate"){
                data = {'shoplisttemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="annountemplate"){
                data = {'annountemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="shopannountemplate"){
                data = {'shopannountemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="commentagtemplate"){
                data = {'commentagtemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="shopcommentagtemplate"){
                data = {'shopcommentagtemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="typetemplate"){
                data = {'typetemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="shoptypetemplate"){
                data = {'shoptypetemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="specialtemplate"){
                data = {'specialtemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }
            else if(template_type=="shopspecialtemplate"){
                data = {'shopspecialtemplate': $("#listtemplate").val(),'newmodulesname':$("#listnewmodulesname").val(),
                    'id': $('#listmodules_id').val()};
            }

            if (tag_sections_list){
                $.ajaxSetup({
                    async: false
                });
                var savemoduletagurl='<?php echo url("template/savelistmoduletag/isshopping/".get('isshopping'));?>';
                if (visualcatid>0){
                    savemoduletagurl+="&catid="+visualcatid;
                }
                if (visualaid>0){
                    savemoduletagurl+="&aid="+visualaid;
                }
                if (visualspid>0){
                    savemoduletagurl+="&spid="+visualspid;
                }
                if (visualtypeid>0){
                    savemoduletagurl+="&typeid="+visualtypeid;
                }
                $.post(savemoduletagurl, data, function (res) {
                    listHandel.html(res);
                });
            }
            else{
                $.ajaxSetup({
                    async: false
                });
                $.post('<?php echo url("template/getlist");?>', data, function (res) {
                    listHandel.html(res);
                });
            }
            cmseasyeditimg();
            cmseasyedit();
            //return false;
            saveLayout();
            window.location.reload();

        });
        cmseasyedit();
    });

    function  checkimg(tagtemplatename) {
        $("[name=listtagimglist]").removeClass("active");
        $("[name=listtagimg]").each(function () {
            if ($(this).data("tagname") ==tagtemplatename) {
                $(this).parent().addClass("active");
            }
        })
    }
</script>