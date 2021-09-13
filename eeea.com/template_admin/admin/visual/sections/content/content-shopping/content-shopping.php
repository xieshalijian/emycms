<!-- 组件开始 -->
<div class="lyrow element-box inline-block">
    <!--层按钮-->
    {setting_butoon_commoncss}
    <div class="preview">
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/content/content-shopping/content-shopping.png" alt="<?php echo lang_admin('add_to_cart');?>">
        <p>{langadmin_add_to_cart}</p>
    </div>
    <div class="view">
        <div class="tag">
            <span class="removeClean tagname">
                &#123;tag_sections_content_content-shopping_1&#125;
            </span>
            <!--组件演示开始-->
            {tag_sections_content_content-shopping_1}
            <!--组件演示结束-->
        </div>
        <!-- 购买商品 -->
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

        <div class="clearfix"></div>
    </div>
</div>
<!-- 组件结束 -->
