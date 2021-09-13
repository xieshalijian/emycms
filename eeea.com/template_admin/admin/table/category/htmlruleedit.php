
<style type="text/css">
    @media(max-width:468px) {
        input#title {width:100%;}
        .add-category .text-left {margin:0px; padding:0px 5px;}
    }
    span.hotspot {float:right; padding-left:10px;}
    #URLmyModal .modal-body .table td {color:#d5d5d5 !important;}
    #URLmyModal .modal-body .table tr:hover .btn-gray,
    #URLmyModal .modal-body .table tr:hover td {color:#333 !important;}
</style>

<div class="main-right-box">
    <h5>{lang_admin('edit_url')}</h5>
    <div class="blank20"></div>
    <div class="box add-category" id="box">

        <a href="#" onclick="gotourl(this)" data-dataurl="<?php echo url('table/htmlrule/table/category',true);?>" class="btn btn-secondary">{lang_admin('url_rules')}</a>
        <div class="blank20"></div>
        <div class="line"></div>
        <div class="blank20"></div>

        <form method="post" name="form1" action="{uri()}"  enctype="multipart/form-data" onsubmit="return returnform(this);">
            <input type="hidden" name="onlymodify" value=""/>


            <script type="text/javascript">
                var base_url = '{$base_url}';
            </script>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('name')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('hrname',$form,$field,$data)}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('name')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>

            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('rule')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    {form::getform('htmlrule',$form,$field,$data)}
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('rule')}"></span>
                </div>
            </div>
            <div class="clearfix blank20"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{lang_admin('subordinate')}</div>
                <div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                    <select id="cate" name="cate" class="form-control select catid">
                        <option value="category" selected>{lang_admin('column')}</option>
                        <option value="archive">{lang_admin('content')}</option>
                        <option value="type">{lang_admin('type')}</option>
                        <option value="special">{lang_admin('special')}</option>
                    </select>
                    <span class="tips icon-info" data-toggle="tooltip" data-html="ture" data-placement="right" title="{lang_admin('rule')}"></span>
                </div>
            </div>

            <div class="clearfix blank20"></div>




            <div class="line"></div>
            <div class="blank30"></div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5 text-left">
                    <input  name="submit" value="1" type="hidden">
                    <input type="submit"   value=" {lang_admin('submitted')} " class="btn btn-primary btn-lg" />
                </div>
            </div>
        </form>

    </div>

    <div class="blank30"></div>
</div>



<script>
    $(function () {
        $("#cate").val("{$data['cate']}");
    });
</script>