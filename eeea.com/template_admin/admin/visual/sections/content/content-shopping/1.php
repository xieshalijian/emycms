<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir'); ?>/visual/sections/content/content-shopping/css/style.css" rel="stylesheet">

<div class="content-buy-joinshoppingcart content-buy-joinshoppingcart-$_id">
    <div class="shop-box">
        <div class="shop-title">
            <h1 cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="title" class="cmseasyedit ">
                {$archive['title']}
            </h1>
            {if $archive['subtitle']}
            <p cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="subtitle" class="cmseasyedit ">
                {$archive['subtitle']}
            </p>
            {/if}
        </div>

        <div class="shop-oldprice" style="{if config::get('show_pice')==0} display:none;{/if}">
            <dt class=" cmseasyedit" cmseasy-id="price" cmseasy-table="lang" cmseasy-field="template">
                {lang('price')}
            </dt>
            <dd>
                <em class=" cmseasyedit" cmseasy-id="unit" cmseasy-table="lang" cmseasy-field="template">
                    {lang('unit')}
                </em>

                <span id="shop-oldprice"></span>

            </dd>
        </div>
        <div class="shop-price" style="{if config::get('show_pice')==0} display:none;{/if}">
            <dt class=" cmseasyedit" cmseasy-id="membership_price" cmseasy-table="lang" cmseasy-field="template">
                {lang('membership_price')}
            </dt>
            <dd>
                <em class=" cmseasyedit" cmseasy-id="unit" cmseasy-table="lang" cmseasy-field="template">
                    {lang('unit')}
                </em>
                <span id="shop-price"></span>
            </dd>
        </div>

        <div class="shop-salesnum">
            <dt class=" cmseasyedit" cmseasy-id="sales_volume" cmseasy-table="lang" cmseasy-field="template">
                {lang('sales_volume')}
            </dt>
            <dd cmseasy-id="{$archive['aid']}" cmseasy-table="archive" cmseasy-field="salesnum" class="cmseasyedit ">
                {$archive['salesnum']}
            </dd>
        </div>
        <div class="shop-salesnum">
            <dt class=" cmseasyedit" cmseasy-id="stock" cmseasy-table="lang" cmseasy-field="template">
                {lang('stock')}
            </dt>
            <dd id="shop-inventory"></dd>
        </div>
        <form>
            <div class="shop-type">
                <div id="columntype"></div>
                <div class="shop-type-info">
                    <dt class=" cmseasyedit" cmseasy-id="numbers" cmseasy-table="lang" cmseasy-field="template">
                        {lang('numbers')}
                    </dt>
                    <dd>
                        <input type=text name=amount class="shop-number" id="thisnum" value="1" onfocus=""  onblur="setthisnum($('#shop-inventory').text(),'{url('archive/getshoppinginventory/aid/'.$archive['aid'])}')">
                        <button class="shop-number-btn1" type=button value="上" onClick="setadd('{url('archive/getshoppinginventory/aid/'.$archive['aid'])}')"><span class="glyphicon glyphicon-menu-up"></span></button>
                        <button class="shop-number-btn2" type=button value="下" onClick="setmin()"><span class="glyphicon glyphicon-menu-down"></span></button>
                        <div class="clearfix"></div>
                    </dd>
                </div>
            </div>
            {if config::get('shoppingcart')==1}
            <div class="shop-buy">
                <a target="_blank" href="javascript:void(0);" onclick="getshoping({$archive['aid']},true)" name="buy" class="buy cmseasyedit" cmseasy-id="buy" cmseasy-table="lang" cmseasy-field="template">
                    {lang('buy')}
                </a>
                <a name="buy" href="javascript:void(0);" onclick="getshoping({$archive['aid']},false)"  id="dialog_link" class="btnCart shoppingcart"  data-toggle="modal" data-target=".bs-example-modal-lg-shopping" aria-hidden="true">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    <span class=" cmseasyedit" cmseasy-id="makeorders" cmseasy-table="lang" cmseasy-field="template">
                        {lang('makeorders')}
                    </span>
                </a>
            </div>
            {/if}
            <div id="buyurl">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    <!--
    $(function () {
        var url='{url("archive/getarchiveprice/aid/".$archive["aid"])}';
        var myfield="{$archive['my_field']}";
        var setfieldNameurl='{url("archive/getfieldName")}';
        var setleixingurl='{url("archive/getarchiveType")}';
        var aid='{$archive["aid"]}';
        var shopingurl="{url('archive/doorders/aid/',true)}";
        getshopping(aid,url,myfield,setfieldNameurl,setleixingurl,shopingurl);
    });
    //-->
</script>
<style type="text/css">

    .content-buy-joinshoppingcart-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .content-buy-joinshoppingcart-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-title h1 {
        font-size:$_title-size;
        color:$_title-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-title h1:hover {
        color:$_title-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-title p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-title p:hover {
        color:$_subtitle-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-oldprice dt,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-price dt {
        font-size:$_p-size;
        color:$_p-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-oldprice dt:hover,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-price dt:hover {
        color:$_p-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-oldprice dd,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-price dd {
        font-size:$_price-size;
        color:$_price-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-oldprice dd:hover,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-price dd:hover {
        color:$_price-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-info input,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-info button,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-list button {
        color:$_input-text-color;
        border-color:$_input-border-color;
        border-radius: $_input-border-radius;
        background:$_input-background-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-info input:hover,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-info button:hover,
    .content-buy-joinshoppingcart-$_id .shop-box .shop-type-list button:hover {
        color:$_input-text-hover-color;
        border-color:$_input-border-hover-color;
        border-radius: $_input-border-hover-radius;
        background:$_input-background-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-buy a.buy {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background:$_btn-background-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-buy a.buy:hover {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
    .content-buy-joinshoppingcart-$_id .shop-box .shop-buy a.btnCart {
        font-size:$_btn-size;
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        background:$_btn-background-hover-color;
    }
</style>

