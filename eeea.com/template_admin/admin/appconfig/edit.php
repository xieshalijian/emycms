
<div class="main-right-box">
    <h5><?php echo lang_admin('apps');?><?php echo lang_admin('config');?></h5>

    <div class="box add-category" id="box">

        <form method="post" name="form1" action="<?php  echo modify("/act/edit/appname/".front::get('appname'));?>"
              onsubmit="return returnform(this);">
            <input type="hidden" name="appfiledname" value="{$appfiledname}">
            {loop $data $d}
            {if $d['type']==1}
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $d['title'];?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php echo form::input($d['name'],$d['value']); ?>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo $d['conent']?>"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix blank20"></div>
            {/if}
            {if $d['type']==2}
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $d['title'];?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                        <?php echo form::select($d['name'],$d['value'], $d['othervalue']); ?>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo $d['conent']?>"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix blank20"></div>
            {/if}
            {if $d['type']==3}
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo $d['title'];?></div>
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

                        <?php
                        $_res="";
                        foreach ($d['othervalue'] as $key=>$res)
                            $_res .= form::radio($d['name'], $key, $key==$d['value']) . $res;
                        echo $_res;
                        ?>
                        <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="<?php echo $d['conent']?>"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix blank20"></div>
            {/if}
            {/loop}
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right wap-none">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" <?php echo lang_admin('submitted');?> " class="btn btn-primary" />
                </div>
            </div>
        </form>
        <div class="blank30"></div>
    </div>
</div>
