<div class="modal fade bs-example-modal-lg" id="flashModel" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
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
                    <?php echo lang_admin('flash');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <iframe id="upfileFlashWindow" name="upfilewindow" src="" width="100%" height="385" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var flashHandel;

    function refileFlash(filename,autoplay,width,height){
        code = '';
        code = '<object data="'+filename+'" type="application/x-shockwave-flash" width="'+width+'" height="'+height+'">';
        code = code + '<param name="movie" value="'+filename+'" />';
        code = code + '<param name="wmode" value="transparent" />';
        if(autoplay){
            code = code + '<param name="autostart" value="1" />';
        }else{
            code = code + '<param name="autostart" value="0" />';
        }
        code = code + '</object>';
        flashHandel.html(code);
        console.log(flashHandel.html());
        closeModel('flashModel');
    }

    function closeModel(id){
        $('#'+id).modal('hide');
    }

    $(document).ready(function () {
        // alert($('#download-layout').html());

        $('body.edit .visual-right').on("click", "[data-target='#flashModel']", function (e) {
            e.preventDefault();
            flashHandel = $(this).parent().parent().parent().find('.view .visual-flash');
        });

        $('#flashModel').on('shown.bs.modal', function (e) {
            //console.log($('.upfilewindow').width());
            $('#upfileFlashWindow').attr('src','index.php?case=file&act=updialogflash&checkfrom=flashshow&max=1&admin_dir=<?php echo config::get('admin_dir');?>&width='+$('#upfileFlashWindow').width());
        });
    });
</script>