<div class="main-right-box">
    <form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
          onsubmit="return checkform(this);">
        <input type="hidden" name="onlymodify" value=""/>
        <h5>
            {lang_admin('editor_user')}
            <!--工具栏-->
            <div class="content-eidt-nav pull-right">
                <a id="fullscreen-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-frame"></i>
                    <?php echo lang_admin('container_fluid');?>
                </a>
                <span class="pull-right">
 <input  name="submit" value="1" type="hidden">
                        <button class="btn btn-success" type="submit">
                            <span class="glyphicon glyphicon-floppy-disk"></span> <?php echo lang_admin('preservation');?>
                        </button>
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('table/list/table/user');?>" data-dataurlname="<?php echo lang_admin('user_list');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                    <a id="content-eidt-nav-btn" class="btn btn-default" style="display:none;">
                    <i class="icon-close"></i>
                </a>
                </span>
            </div>
        </h5>

        <div class="box" id="box">
            <div class="tab-content">
                <!-- 基本信息 -->
                <div role="tabpanel" class="tab-pane active" id="tag1">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('username')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('username',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('password')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('passwordnew',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('balance')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <input type="text" name="menoy" id="menoy" value="{$data['menoy']}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <?php if (chkpower('user_integration')){  ?>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('integral')}</div>
                            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                                {form::getform('integration',$form,$field,$data)}
                            </div>
                        </div>
                        <div class="clearfix blank20"></div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('nickname')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('nickname',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('safety_problem')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('question',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('your_answer')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('answer',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('user_group')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('groupid',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('qq')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('qq',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('email')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('e_mail',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('mobile')}</div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            {form::getform('tel',$form,$field,$data)}
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    <!--过期时间-->
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo lang_admin('expiration_time');?></div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php
                            $field['expired_time']['type']='date';
                            $data['expired_time']=$data['expired_time']?date('Y-m-d',$data['expired_time']):0;
                            echo form::getform('expired_time',$form,$field,$data);?>
                            <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo lang_admin('outdated_content_will_be_deleted_to_the_recycle_bin');?>"></span>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                </div>
                <!--自定义信息 -->
                <div role="tabpanel" class="tab-pane" id="tag2">
                    {loop $field $f}
                    <?php
                    $name=$f['name'];
                    if(!preg_match('/^my_/',$name)) {
                        unset($field[$name]);
                        continue;
                    }
                    if(!isset($data[$name])) $data[$name]='';
                    ?>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo setting::$var['user'][$name]['cname']; ?></div>
                        <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                            <?php echo form::getform($name,$form,$field,$data); ?>
                        </div>
                    </div>
                    <div class="clearfix blank20"></div>
                    {/loop}
                </div>
            </div>
            <div class="clearfix blank30"></div>
            <div class="line"></div>
            <div class="clearfix blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input type="hidden" name="token" value="{$token}" />
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value="{lang_admin('submitted')}" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        function checkform(obj) {
            if($('#username').val()==''){
                alert("{lang_admin('user_name_cannot_be_empty')}");
                document.form1.username.focus();
                return  false;
            }
            if($('#passwordnew').val()==''){
                alert("{lang_admin('password_cannot_be_empty')}");
                document.form1.passwordnew.focus();
                return  false;
            }
            if($('#groupid').val()==''){
                alert("{lang_admin('please_select_user_group')}");
                document.form1.groupid.focus();
                return  false;
            }
            if($('#e_mail').val()=='' && !checkEmail($('#e_mail').val()) ){
                alert("{lang('please_enter_the_correct_mailbox')}");
                document.form1.e_mail.focus();
                return  false;
            }
            if($('#tel').val()=='' && !isMobile($('#tel').val()) ){
                alert("{lang('please_enter_the_correct_telephone_number')}");
                document.form1.tel.focus();
                return  false;
            }
            returnform(obj);
            return false;
        }
        function checkEmail(e_mail) {
            //对电子邮件的验证
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            return myreg.test(e_mail);
        }
        function isMobile(mobile){
            return /^1([0-9]+){5,}$/g.test(mobile);
        }
    </script>
    <div class="blank30"></div>
</div>

<!-- 日期 -->
<link rel="stylesheet" href="<?php echo $base_url;?>/common/js/jquery/ui/css/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script language="javascript" src="<?php echo $base_url;?>/common/js/jquery/ui/js/ui.datepicker.js"></script>