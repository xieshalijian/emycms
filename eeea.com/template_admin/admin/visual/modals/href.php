
<div class="modal fade href-config" id="hrefModel" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
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
                    <?php echo lang_admin('link');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5 class="subtitle"><?php echo lang_admin('connection_address');?></h5>
                    <input id="url" placeholder="<?php echo lang_admin('connection_address');?>" name="url" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <h5 class="subtitle"><?php echo lang_admin('open_mode');?></h5>
                    <select id="target" name="target" class="form-control">
                        <option value=""><?php echo lang_admin('default');?></option>
                        <option value="_self"><?php echo lang_admin('original_window');?></option>
                        <option value="_blank"><?php echo lang_admin('new_window');?></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="btn_saveHref" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var hrefHandel;

    $(document).ready(function () {
        // alert($('#download-layout').html());

        $('body.edit .visual-right').on("click", "[data-target='#hrefModel']", function (e) {
            e.preventDefault();
            hrefHandel = $(this).parent().parent().parent().parent().parent().find('.view img,.view i,.view em');
            $('.href-config #url').val(hrefHandel.parent().attr('href'));
            $('.href-config #target').val(hrefHandel.parent().attr('target'));
            //console.log(hrefHandel.parent());
        });

        $("#btn_saveHref").click(function(e) {
            e.preventDefault();
            if(hrefHandel.parent()[0].tagName != 'A') {
                hrefHandel.wrap('<a target="' + $('.href-config #target').val() + '" href="#" onclick="gotourl(this)"   data-dataurl="' + $('.href-config #url').val() + '"></a>');
            }else{
                hrefHandel.parent().attr('href',$('.href-config #url').val());
                hrefHandel.parent().attr('target',$('.href-config #target').val());
            }

        });
    });
</script>