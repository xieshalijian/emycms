<div class="main-right-box">
    <h5>{lang_admin('xiongzhang_id')}<!--工具栏-->
        <div class="content-eidt-nav pull-right">

        <span class="pull-right">
                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('expansion/index');?>" data-dataurlname="<?php echo lang_admin('content_manage');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>
                </span>
        </div></h5>

    <div class="box" id="box">


        <form name="frm1" id="frm1" action="" method="post" onsubmit="return returnform(this);">
            <div class="form-group">
                <label for="appid">appid</label>
                <input class="form-control" name="appid" type="text" id="appid"
                       value="<?php echo config::getadmin('xiongzhang_appid'); ?>">
            </div>
            <div class="form-group">
                <label for="token">token</label>
                <input class="form-control" name="token" type="text" id="token"
                       value="<?php echo config::getadmin('xiongzhang_token'); ?>">
            </div>
            <div class="form-group">
                <label for="token">{lang_admin('number_of_push')}</label>
                <input class="form-control" name="token" type="text" id="token"
                       value="<?php echo config::getadmin('xiongzhang_number'); ?>">
            </div>
            <div class="alert alert-warning alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('tips')}：</strong> 	[	<span>{</span>推送数量请在百度应用平台设置，否则推送无效！<span>}</span>	]
            </div>
            <div class="form-group">
                <label for="token">URLs</label>
                <textarea class="form-control" style="height: 400px;" id="urls" name="urls"><?php echo $urls; ?></textarea>
            </div>
            <div class="blank20"></div>
            <div class="line"></div>
            <div class="blank20"></div>
                <input  name="dosubmit" value="1" type="hidden">
                <input   class="btn btn-primary btn-lg" type="submit" value="{lang_admin('push')}"
                       onclick="return confirm('{lang_admin('are_you_sure_you_want_to_push_it_to_the_xiongzhang_id')}')">


        </form>

    </div>
</div>
