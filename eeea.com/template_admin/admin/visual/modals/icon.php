
<div class="modal fade" id="icon-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">
                                <i class="glyphicon glyphicon-remove"></i>
</span>
                </button>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#icon-config-attribute" aria-controls="icon-config-attribute" role="tab" data-toggle="tab">
                            <?php echo lang_admin('attribute');?>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="modal-body">

                <div class="sidebar-nav-margin-input icon-config form-inline">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- 属性 -->
                        <div role="tabpanel" class="tab-pane active" id="icon-config-attribute">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('select_icons');?>
                            </h5>
                              <!--  <input type="text" class="selector" id="cb_iconfont" name="cb_iconfont"/>  -->
                            <input type="text" id="grey-theme" name="grey-theme" value="" />
                                <div class="blank20">
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="blank30"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin('close');?></button>
            </div>
        </div>
    </div>
</div>



<!-- fontIconPicker core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/css/jquery.fonticonpicker.min.css" />

<!-- required default theme -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/themes/grey-theme/jquery.fonticonpicker.grey.min.css" />

<!-- optional themes -->
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/themes/dark-grey-theme/jquery.fonticonpicker.darkgrey.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/common/plugins/fonticon/themes/inverted-theme/jquery.fonticonpicker.inverted.min.css" />



<!-- 字体图标 -->
<script type="text/javascript">
    var iconHandel = $('.body');
    var eTexticon;
    var saveiconurl='<?php echo url("template/saveicon/isshopping/".get('isshopping'));?>';
    var saveicondata={};

    function closeModel(id){
        $('#'+id).modal('hide');
    }

    $(document).ready(function () {
        /**
         * Init the fontIconPickers on the jumbotron
         */
        $('#grey-theme').fontIconPicker({
            source: icm_icons,
            searchSource: icm_icon_search,
            useAttribute: true,
            attributeName: 'data-icomoon',
            emptyIconValue: 'none'
        });

        $('body.edit .visual-right').on("click", "[data-target='#icon-config']", function (e) {
            e.preventDefault();
            iconHandel = $(this).parent().parent().parent().parent().find('.view .visual-ico');
            var iconeditor = $(this).parent().parent().parent().parent().find('.view');
            eTexticon = iconeditor.find('.tagname').html();
            eTexticon = ReplaceAll(eTexticon,'#[#','{');
            eTexticon = ReplaceAll(eTexticon,'#]#','}');

            $("#icon-config .selected-icon").html(iconHandel.html());

            var _tag_sections=new RegExp('tag_sections');
            if(_tag_sections.test(eTexticon) )
            {
                $('#icon-config').addClass("modal-right");
                $.ajaxSetup (  { async: true });
                var getmodulestag='<?php echo url("template/getmodulestag/isshopping/".get('isshopping'));?>';
                $.post(getmodulestag, {'tag': eTexticon}, function (res) {
                    console.log(res);
                    saveicondata['newmodulesname']=res[0].newmodulesname;
                }, 'json');
            }
        });
    });
</script>


