
<div class="modal fade" id="template-tel-tag" tabindex="-1" role="dialog"
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
                    <?php echo lang_admin('contact_information');?>
                    </a>
                    </li>
                    </ul>
            </div>
            <div class="modal-body">
                <form method="post" name="frmTel" id="frmTel" action="">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('tel');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="tel" name="tel" class="form-control select tel">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('fill_in_the_menu_and_click_on_the_jump_address_in_http_address');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="address" name="address" class="form-control select address">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('postcode');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="postcode" name="postcode" class="form-control select postcode">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('mobile');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="mobile" name="mobile" class="form-control select mobile">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('fax');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="fax" name="fax" class="form-control select fax">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('email');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="email" name="email" class="form-control select email">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3 text-right">
<?php echo lang_admin('complaint_email');?>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-md-7 col-lg-8 text-left">
                            <select id="complaint_email" name="complaint_email" class="form-control select complaint_email">
                                <option value="1">
<?php echo lang_admin('yes');?>
                                </option>
                                <option value="0">
<?php echo lang_admin('no');?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <button id="saveTelStyle" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang_admin('preservation');?>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var telHandel;

    $(document).ready(function () {

        $('body.edit .visual-right').on("click", "[data-target='#template-tel-tag']", function (e) {
            e.preventDefault();
            telHandel = $(this).parent().parent().parent().parent().find('.view');
            //console.log(telHandel.find('.custtag.tel').length);
            $('#frmTel .tel').val(telHandel.find('.custtag.tel').length);
            $('#frmTel .address').val(telHandel.find('.custtag.address').length);
            $('#frmTel .postcode').val(telHandel.find('.custtag.postcode').length);
            $('#frmTel .mobile').val(telHandel.find('.custtag.mobile').length);
            $('#frmTel .fax').val(telHandel.find('.custtag.fax').length);
            $('#frmTel .email').val(telHandel.find('.custtag.email').length);
            $('#frmTel .complaint_email').val(telHandel.find('.custtag.complaint_email').length);
            //console.log(navHandel);
            //contenthandle.setData(eText);
        });

        $("#saveTelStyle").click(function (e) {
            e.preventDefault();
            //alert($("input[name=navstyle]:checked").val());
            //data = {'listtemplate': $("#listtemplate").val()};
            data = $('#frmTel').serialize();
            $.post('<?php echo url("template/getTel");?>', data, function (res) {
                //console.log(telHandel.html());
                telHandel.html(res);
                //navHandel.html('<div class="nav" rel="nav(' + $("input[name=navstyle]:checked").val() + ')">' + res + '</div>');
            });

            //return false;

        });
    });

</script>