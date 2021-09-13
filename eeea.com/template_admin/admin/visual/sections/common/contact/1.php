<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/blank/css/style.css" rel="stylesheet">


<div class="visual-contact visual-contact-$_id">
    <p>
        <h5 class="cmseasyedit" cmseasy-id="address" cmseasy-table="lang" cmseasy-field="template">
            {lang('address')}
        </h5>
        <span class="custtag address cmseasyedit" cmseasy-id="address" cmseasy-table="config" rel="config::getadmin('address')">
            <?php echo config::getadmin('address');?>
        </span>
    </p>
    <p>
    <h5 class="cmseasyedit" cmseasy-id="postcode" cmseasy-table="lang" cmseasy-field="template">
            {lang('postcode')}
        </h5>
        <span class="custtag postcode cmseasyedit" cmseasy-id="postcode" cmseasy-table="config" rel="config::getadmin('postcode')">
            <?php echo config::getadmin('postcode');?>
        </span>
    </p>
    <p>
        <h5 class="cmseasyedit" cmseasy-id="tel" cmseasy-table="lang" cmseasy-field="template">
            {lang('tel')}
        </h5>
        <span class="custtag tel cmseasyedit" cmseasy-id="tel" cmseasy-table="config" rel="config::getadmin('tel')">
            <?php echo config::getadmin('tel');?>
        </span>
    </p>
    <p>
        <h5 class="cmseasyedit" cmseasy-id="fax" cmseasy-table="lang" cmseasy-field="template">
            {lang('fax')}
        </h5>
        <span class="custtag fax cmseasyedit" cmseasy-id="fax" cmseasy-table="config" rel="config::getadmin('fax')">
            <?php echo config::getadmin('fax');?>
        </span>
    </p>
    <p>
        <h5 class="cmseasyedit" cmseasy-id="mobile" cmseasy-table="lang" cmseasy-field="template">
            {lang('mobile')}
        </h5>
        <span class="custtag mobile cmseasyedit" cmseasy-id="mobile" cmseasy-table="config" rel="config::getadmin('mobile')">
            <?php echo config::getadmin('mobile');?>
        </span>
    </p>
    <p>
        <h5 class="cmseasyedit" cmseasy-id="email" cmseasy-table="lang" cmseasy-field="template">
            {lang('email')}
        </h5>
        <span class="custtag email cmseasyedit" cmseasy-id="email" cmseasy-table="config" rel="config::getadmin('email')">
            <?php echo config::getadmin('email');?>
        </span>
    </p>
    <p>
        <h5 class="cmseasyedit" cmseasy-id="complaint_email" cmseasy-table="lang" cmseasy-field="template">
            {lang('complaint_email')}
        </h5>
        <span class="custtag complaint_email cmseasyedit" cmseasy-id="complaint_email" cmseasy-table="config" rel="config::getadmin('complaint_email')">
            <?php echo config::getadmin('complaint_email');?>
        </span>
    </p>
</div>


<style type="text/css">
.visual-contact-$_id {
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual-contact-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
.visual-contact-$_id p h5 {
    font-size:$_title-size;
    color:$_title-color;
}
.visual-contact-$_id p h5:hover {
    color:$_title-hover-color;
}
.visual-contact-$_id p span {
    font-size:$_p-size;
    color:$_p-color;
}
.visual-contact-$_id p span:hover {
    color:$_p-hover-color;
}
</style>