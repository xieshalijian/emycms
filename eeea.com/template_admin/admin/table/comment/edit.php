<div class="main-right-box">
<h5>
    {lang_admin('respond_to_comments')}
    <!--工具栏-->
    <div class="content-eidt-nav pull-right">

        <span class="pull-right">



                        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('table/list/table/comment');?>" data-dataurlname="<?php echo lang_admin('comment');?>" class="btn btn-default">
                        <i class="icon-action-redo"></i>
                    </a>


                </span>
    </div>
</h5>

<div class="box" id="box">
    <div class="line"></div>
    <div class="blank30"></div>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"
      onsubmit="return returnform(this);">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('content')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('content',$form,$field,$data)} 
</div>
</div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('username')}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('username',$form,$field,$data)} 
</div>
</div>
    <div class="clearfix blank20"></div>

<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('reply')}</div>
    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
        {form::getform('reply',$form,$field,$data)}
    </div>
</div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
    <input  name="submit" value="1" type="hidden">
    <input type="submit"  value=" {lang_admin('submitted')} " class="btn btn-primary btn-lg"/>

</form>
<div class="blank30"></div>
</div>
</div>

