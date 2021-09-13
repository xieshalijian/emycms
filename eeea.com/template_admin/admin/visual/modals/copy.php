
<div class="modal fade" id="template-copy" tabindex="-1" role="dialog"
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
                    <?php echo lang_admin('copy_template');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="blank20">
                </div>
                <form method="post" name="frmcopytemplate" id="frmcopytemplate" action="">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                        <?php echo lang_admin('template_file_name');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input placeholder="<?php echo lang_admin('please_enter_the_name_of_the_template_file');?>" type="text" name="name" value="" class="name form-control" onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g,'')">
                            <input name="oldname" type="hidden" id="oldname" value="<?php echo front::get('tempname');?>" onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g,'')" />
<div class="blank10">
            </div>
            <div class="clearfix alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <strong>
                    <?php echo lang_admin('tips');?>：
                </strong>
                <?php echo lang_admin('naming_must_be_in_english_or_pinyin');?>
            </div>
                        </div>

                    </div>

                    <div class="clearfix blank20">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
                            <?php echo lang_admin('template_description');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <input placeholder="<?php echo lang_admin('please_briefly_enter_the_template_description');?>" type="text" name="notename" value="<?php echo help::tpl_name(str_replace('-','/',front::get('tempname').'_html'));;?>" class="notename form-control" >

                        </div>
                    </div>
                    <div class="clearfix blank20">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('mold');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <?php echo form::select('type', '', templatetag::typeoption());?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="btn_copyTemplate" type="button" class="btn btn-primary"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_copyTemplate').click(function (e) {
            if($('#frmcopytemplate .name').val()==''){
                alert("<?php echo lang_admin('please_fill_in_the_template_name');?>");
                $('#frmcopytemplate .name').focus();
                return false;
            }
            $.post('<?php echo url('template/copytemplate');?>',$('#frmcopytemplate').serialize(),function(res){
                console.log(res);
                if(res.code != '0'){
                    alert(res.info);
                }else{
                    window.location.href = '<?php echo url('template/visual');?>&tempname='+res.info;
                }
            },'json');
        });
    });
</script>