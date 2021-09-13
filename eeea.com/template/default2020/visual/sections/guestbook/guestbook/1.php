<?php if(config::get('guestbook_enable')=='1'){?>
<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/guestbook/guestbook/css/style.css" rel="stylesheet">


<div class="guestbook guestbook-$_id custtag">
    <!-- 上传组件 -->
    <script src="<?php echo $base_url;?>/common/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="<?php echo $base_url;?>/common/plugins/fileinput/js/locales/zh.js" type="text/javascript"></script>
    <link href="<?php echo $base_url;?>/common/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css">

    <script>
        $(function(){
            $('#frmGuestbookSubmit').submit(function() {
                if($('#nickname').val() == ''){
                    alert("<?php echo lang('please_enter_your_user_name');?>！");
                    $('#nickname').focus();
                    return false;
                }
                if($('#title').val() == ''){
                    alert("<?php echo lang('please_enter_the_title');?>！");
                    $('#title').focus();
                    return false;
                }

                if($('#content').val() == ''){
                    alert("<?php echo lang('p_content');?>");
                    $('#content').focus();
                    return false;
                }
            });
        });
    </script>

    <form id="frmGuestbookSubmit" method="post" action="<?php echo url('guestbook/index/aid/'.front::get('aid'));?>" name="frmGuestbookSubmit" class="form_message guestbook">

        <?php  if(count(cate::option())>0){ ?>
            <div class="form-group">
                <label for="comment"><?php echo lang('type');?></label>
                <select name="catid" id="catid" class="form-control guestbook_select">
                    <?php echo helper::htmlOption(cate::option(),'');?>
                </select>
            </div>
        <?php  } ?>



        <div class="form-group">
            <input name="nickname" id="nickname" value="" class="form-control guestbook_input" placeholder="<?php echo lang('name');?>" />
        </div>

        <div class="form-group">
            <input type="text" name="title" id="title" value="" class="form-control guestbook_input" placeholder="<?php echo lang('title');?>" />
        </div>

        <!--自定义字段 begin-->
        <?php
        $guestbookfielddata=guestbookfield::getInstance()->getrows(' isshow=1 ',0);
        foreach ($guestbookfielddata as $key=>$val){

            $newcname='showname_'.lang::getistemplate();
            $showname=unserialize($val['showname']);
            $val['showname']=is_array($showname)?$showname[$newcname]:$val['showname'];

            ?>
            <?php
            if($val['type'] == 'varchar'){
                ?>
                <div class="form-group">
                    <input name="<?php echo $val['name'] ?>" id="<?php echo $val['name'] ?>" value="" class="form-control guestbook_input" placeholder="<?php echo $val['showname'] ?>"/>
                </div>
            <?php
            }else
            if($val['type'] == 'text' || $val['type'] == 'mediumtext') {
            ?>
                <div class="form-group">
                    <textarea name="<?php echo $val['name'] ?>" id="<?php echo $val['name'] ?>" class="form-control guestbook_textarea"  placeholder="<?php echo $val['showname'] ?>"></textarea>
                </div>
            <?php
            }else
            if($val['type'] == 'int'){
            ?>
                <div class="form-group">
                    <input name="<?php echo $val['name'] ?>" id="<?php echo $val['name'] ?>" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"
                           onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"  class="form-control guestbook_input" placeholder="<?php echo $val['showname'] ?>"/>
                </div>
            <?php
            }else
            if($val['type'] == 'datetime'){
            ?>
                <div class="form-group">
                    <input type="text" name="<?php echo $val['name'] ?>" id="<?php echo $val['name'] ?>"
                           value="<?php echo date('Y-m-d H:i:s');?>" class="form-control hasDatepicker">
                </div>
            <?php
            }else
            if($val['type'] == 'radio'){
            ?>
                <span id="form_<?php echo $val['name'] ?>"></span>
            <?php
            $result = preg_split('/[;\r\n]+/s', $val['fieldvalue'][$newfieldvalue]);
            foreach ($result as $resultval){
            ?>
                <script>
                    select = '';
                    var nameval="<?php echo $val['name'] ?>";
                    subject = "<?php echo $resultval?>";
                    var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                    var match = myregexp.exec(subject);
                    while (match != null) {
                        select += match[2] + '<input type="radio" value="' + match[1] + '" name="' +nameval+ '">&nbsp;&nbsp;';
                        match = myregexp.exec(subject);
                    }
                    $('#form_'+nameval).append(select);
                </script>
            <?php
            }
            }else
            if($val['type'] == 'checkbox'){
            ?>
                <span id="form_<?php echo $val['name'] ?>"></span>
            <?php
            $result = preg_split('/[;\r\n]+/s', $val['fieldvalue'][$newfieldvalue]);
            foreach ($result as $resultval){
            ?>
                <script>
                    select = '';
                    var nameval="<?php echo $val['name'] ?>";
                    subject = "<?php echo $resultval?>";
                    var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                    var match = myregexp.exec(subject);
                    while (match != null) {
                        select += match[2]+'<input type="checkbox" value="'+match[1]+'" name="'+nameval+ '[]">&nbsp;&nbsp;';
                        match = myregexp.exec(subject);
                    }
                    $('#form_'+nameval).append(select);
                </script>
            <?php
            }
            }else
            if($val['type'] == 'select'){
            ?>
                <span id="form_<?php echo $val['name'] ?>"></span>
                <script>
                    var nameval="<?php echo $val['name'];?>";
                    select='<select name="'+nameval+ '">';
                </script>
            <?php
            $result = preg_split('/[;\r\n]+/s', $val['fieldvalue'][$newfieldvalue]);
            foreach ($result as $resultval) {
            ?>
                <script>
                    subject="<?php echo $resultval;?>";
                    var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                    var match = myregexp.exec(subject);
                    while (match != null) {
                        select += '<option value="'+match[1]+'">'+match[2]+'</option>';
                        match = myregexp.exec(subject);
                    }
                </script>
            <?php }?>
                <script>
                    select +='</select>';
                    $('#form_'+nameval).html(select);
                </script>
            <?php
            }else
            if($val['type'] == 'image'){
                echo form::upload_image($val['name'],'');
            }else{
            ?>
            <input name="<?php echo $val['name'] ?>" id="<?php echo $val['name'] ?>" value="" class="guestbook_input" />
            <?php };?>
        <?php };?>
        <!--自定义字段 end-->



        <div class="form-group">
            <textarea id="content" name="content" class="form-control guestbook_textarea" placeholder="<?php echo lang('content');?>"></textarea>
        </div>



        <div class="checkbox">
            <label>
                <input type="checkbox" name="issee" id="issee" value="1" onclick="if(this.checked){this.value=1;}else{this.value=0;};" > <?php echo lang('is_mysee');?>
            </label>
        </div>








        <?php if(config::get('verifycode')=='1'){?>
            <input type='text' id="verify"  tabindex="3"  name="verify" /><?php echo verify();?>
        <?php } ?>


        <?php if(config::get('verifycode') == 2){?>
            <div class="blank10"></div>
            <div id="verifycode_guest"></div>
            <script src="http://api.geetest.com/get.php"></script>
            <script>
                var loadGeetest1 = function(config) {
                    window.gt_captcha_obj = new window.Geetest({
                        gt : config.gt,
                        challenge : config.challenge,
                        product : 'float',
                        offline : !config.success
                    });
                    gt_captcha_obj.appendTo("#verifycode_guest");
                };

                $.ajax({
                    url : '<?php echo url('tool/geetest');?>',
                    type : "get",
                    dataType : 'JSON',
                    success : function(result) {
                        //console.log(result);
                        loadGeetest1(result)
                    }
                });
            </script>
        <?php } ?>

        <div class="blank20"></div>


        <div class="form-group">
            <input type="submit" name="submit" value="<?php echo lang('submit_on');?>" class="btn">
        </div>
    </form>
</div>

<style type="text/css">
    .guestbook-$_id .guestbook_input,
    .guestbook-$_id .guestbook_textarea{
        font-size:$_input-size;
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }
    .guestbook-$_id .guestbook_content_item .guestbook_input:hover,
    .guestbook-$_id .guestbook_textarea:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
    .guestbook-$_id .checkbox label {
        font-size:$_p-size;
        color:$_p-color;
    }
    .guestbook-$_id .checkbox label:hover {
        color:$_p-hover-color;
    }
    .guestbook-$_id .btn {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .guestbook-$_id .btn:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>
<?php } ?>