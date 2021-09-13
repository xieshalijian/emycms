<div class="modal fade bs-example-modal-lg" id="audioModel" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="icon-close"></i>
                            </span>
            </button>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <iframe id="upfileAudioWindow" name="upfilewindow" src="" width="100%" height="440" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var audioHandel;

    function refileAudio(filename,autoplay,width,height){
        //console.log(filename);
        audioHandel.attr('src',filename);
        if(autoplay){
            audioHandel.attr('autoplay','true');
        }
        if(width != ''){
            audioHandel.attr('width',width);
        }
        if(height != ''){
            audioHandel.attr('height',height);
        }
    }

    function closeModel(id){
        $('#'+id).modal('hide');
    }

    $(document).ready(function () {
        // alert($('#download-layout').html());

        $('body.edit .visual-right').on("click", "[data-target='#audioModel']", function (e) {
            e.preventDefault();
            audioHandel = $(this).parent().parent().parent().find('.view audio');
            //console.log(audioHandel);
            //contenthandle.setData(eText);
        });

        $('#audioModel').on('shown.bs.modal', function (e) {
            //console.log($('.upfilewindow').width());
            $('#upfileAudioWindow').attr('src','index.php?case=file&act=updialog3&checkfrom=audioshow&max=1&admin_dir=<?php echo config::get('admin_dir');?>&width='+$('#upfileAudioWindow').width());
        })
    });
</script>