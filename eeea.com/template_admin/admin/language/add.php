<style type="text/css">
    .main .main-right-box {
        position: absolute;
        top:130px;
        right:30px;
        left:30px;
        bottom:30px;
    }
</style>
<div class="main-right-box">
    <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
        <h5>
            {lang_admin('add_language_items')}
        </h5>
        <div class="line"></div>
        <div class="blank20"></div>
        <div class="box" id="box">
            <div class="alert alert-warning alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('tips')}</strong> 	{lang_admin('add_to')}	[	<strong>{$langdata['langname']}</strong>		]	{lang_admin('language_pack')}
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{$langdata['langname']}{lang_admin('remarks')}</th>
                        <th>{lang_admin('call_item')}</th>
                        <th>{lang_admin('front_end_display_value')}</th>
                    </tr>
                    </thead>
                    <tbody id="myList" >
                    <tr>
                        <td>
                            <input type="text" name="cnnote" value="" class="form-control" />
                        </td>
                        <td>
                            <input type="text" name="key" value="" class="form-control" />
                        </td>
                        <td>
                            <input type="text" name="val" value="" class="form-control" />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="blank20"></div>
            <div class="line"></div>
            <div class="blank20"></div>
            <input  name="submit" value="1" type="hidden">
            <input type="submit" value=" {lang_admin('add_to')} "  class="btn btn-primary btn-lg" />
    </form>
    <div class="blank30"></div>
</div>
