
<div class="modal fade" id="navModel" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" data-backdrop="true" data-keyboard="false">
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
<?php echo lang_admin('navigation_manage');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for=""><img src="<?php echo $skin_path;?>/images/visual/modules/nav-1.jpg" class="img-responsive"></label>
                        <input rel="<img src=''>" type="radio" name="navstyle" value="1" checked>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="saveNav" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var navHandel;

    $(document).ready(function () {

        $('body.edit .visual-right').on("click", "[data-target='#navModel']", function (e) {
            e.preventDefault();
            navHandel = $(this).parent().parent().parent().parent().parent().find('.view');
            //console.log(navHandel);
            //contenthandle.setData(eText);
        });

        $("#saveNav").click(function(e) {
            e.preventDefault();
            //alert($("input[name=navstyle]:checked").val());
            data = {'id':$("input[name=navstyle]:checked").val()};
            $.post('<?php echo url("template/getnav");?>',data,function(res){
                navHandel.html('<div class="nav" rel="nav('+$("input[name=navstyle]:checked").val()+')">'+res+'</div>');
            });

            //return false;

        });
    });

</script>