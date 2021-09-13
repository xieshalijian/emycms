
<div id="template-announ-tag" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="icon-close"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a>
                            <?php echo lang_admin('announcement_attributes');?>                   </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="clearfix blank20">
                </div>
                <form method="post" name="frmAnnoun" id="frmAnnoun" action="">
                    <?php
                    $tplarray=include(ROOT.'/template/'.config::get('template_dir').'/visual/list/listannountag/announ.config.php');
                    //$tplarray=$tplarray['category'];
                    //$tag_config=$data['setting'];
                    ?>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                           <?php echo lang_admin('number_of_caption_intercepted_words');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input type="text" name="title_len" id="title_len" value="20" class="title_len form-control">
                        </div>
                    </div>
                    <div class="clearfix blank20">
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php echo lang_admin('number_of_list_items');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input type="text" name="num" id="num" value="20" class="num form-control">
                        </div>
                    </div>
                    <div class="clearfix blank20">
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php echo lang_admin('whether_to_display_time_or_not');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="is_date" name="is_date" class="form-control is_date select">
                                <option value="0">
                                    <?php echo lang_admin('no');?>
                                </option>
                                <option value="1">
                                    <?php echo lang_admin('yes');?>
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20">
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php echo lang_admin('style_selection');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::select('annountemplate', '', $tplarray);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right"
                                  title=""
                                  title="<?php echo lang_admin('label_template_files_are_stored_in_current_background_template directory');?>">
                                    </span>
                        </div>
                    </div>
                    <div class="clearfix blank20">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                   <?php echo lang_admin('close');?>
                </button>
                <button id="saveAnnounStyle" type="button" class="btn btn-primary" data-dismiss="modal">
<?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var announHandel;

    $(document).ready(function () {

        $('body.edit .visual-right').on("click", "[data-target='#template-announ-tag']", function (e) {
            e.preventDefault();
            announHandel = $(this).parent().parent().parent().parent().find('.view');
            console.log(announHandel.find('.codearea #title_len').html());
            $('#frmAnnoun .title_len').val(announHandel.find('.codearea #title_len').html());
            $('#frmAnnoun .num').val(announHandel.find('.codearea #num').html());
            $('#frmAnnoun .is_date').val(announHandel.find('.codearea #is_date').html());
            //console.log(navHandel);
            //contenthandle.setData(eText);
        });

        $("#saveAnnounStyle").click(function (e) {
            e.preventDefault();
            //alert($("input[name=navstyle]:checked").val());
            data = $("#frmAnnoun").serialize();
            $.post('<?php echo url("template/getannounlist");?>', data, function (res) {
                announHandel.html(res);
                //navHandel.html('<div class="nav" rel="nav(' + $("input[name=navstyle]:checked").val() + ')">' + res + '</div>');
            });

            //return false;

        });
    });

</script>