
<div class="modal fade bs-example-modal-lg" id="pictureModel" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
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
                            <?php echo lang_admin('picture_manage');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                <iframe id="upfilePicwindow" name="upfilewindow" src="" width="100%" height="535" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" style="overflow:hidden;"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var imageHandel;

    function refilediv(filename,alt,width,height){
        //循环判断带有img-responsive属性的 才加上图片
        $(imageHandel).each(function(){
            if($(this).is('.img-responsive')){
                $(this).attr('src',filename);
                $(this).attr('alt',alt);
                $(this).attr('width',width);
                $(this).attr('height',height);
            }
        });
        /*
        imageHandel.attr('src',filename);
        imageHandel.attr('alt',alt);
        imageHandel.attr('width',width);
        imageHandel.attr('height',height);
        */
    }

    function closeModel(id){
        $('#'+id).modal('hide');
    }

    $(document).ready(function () {
        // alert($('#download-layout').html());

        $('body.edit .visual-right').on("click", "[data-target='#pictureModel']", function (e) {
            e.preventDefault();
            imageHandel = $(this).parent().parent().parent().parent().find('.view img');
            //console.log(imageHandel);
            //contenthandle.setData(eText);
            insertPics()
        });

        $('#pictureModel').on('shown.bs.modal', function (e) {
            //console.log($('#upfilePicwindow'));
            //console.log($('.upfilewindow').width());
            $('#upfilePicwindow').attr('src','index.php?case=file&act=updialog1&checkfrom=divshow&max=1&admin_dir=<?php echo config::get('admin_dir');?>&width='+$('#upfilePicwindow').width());
        })
    });
</script>