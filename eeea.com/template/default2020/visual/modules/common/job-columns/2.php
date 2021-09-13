<link href="{$template_path}/visual/modules/common/job-columns/css/style.css" rel="stylesheet">


{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="col-md-4">
    <div class="job-columns-left job-columns-left-$_id">
        <h4>
            <a href="{$cat['url']}" title="{$cat['catname']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$cat['catname']}
            </a>
        </h4>
        {if $cat['subtitle']}
        <p cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="htmldir" class="cmseasyedit">
            {$cat['subtitle']}
        </p>
        {/if}
    </div>
</div>

<div class="col-md-8">
    <div class="job-columns-right job-columns-right-$_id">
        <div class="row">

            <div class="col-sm-6">

                <div class="job-columns-right-text">
                    <h4 class=" cmseasyedit" cmseasy-id="servertel" cmseasy-table="lang" cmseasy-field="template">
                        {lang('servertel')}
                    </h4>
                    <span class="job-columns-tel cmseasyedit" cmseasy-id="tel" cmseasy-table="lang" cmseasy-field="template">
                                {get('tel')}
                            </span>
                    <p class="job-columns-email">
                        <i class="icon-envelope"></i>
                        <span class=" cmseasyedit" cmseasy-id="email" cmseasy-table="lang" cmseasy-field="template">
                                {get('email')}
                                </span>
                    </p>
                    <a href="{$cat['url']}" class="more">
                        <span class="glyphicon glyphicon-menu-right"></span>
                    </a>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="job-columns-right-img">
                    <img src="{$cat['image']}" width="344" height="226" alt="{$cat['catname']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" class="cmseasyeditimg " />
                </div>
            </div>
        </div>
    </div>
</div>
{/loop}


<style type="text/css">
    .job-columns-right-$_id {
        background:$_background-color;
    }
    .job-columns-right-$_id:hover {
        background:$_background-hover-color;
    }
    .job-columns-left-$_id h4 a {
        font-size:$_title-size;
        color:$_title-color;
    }
    .job-columns-left-$_id h4 a:hover {
        color:$_title-hover-color;
    }
    .job-columns-left-$_id h4 p {
        font-size:$_subtitle-size;
        color:$_subtitle-color;
    }
    .job-columns-left-$_id h4 p:hover {
        color:$_subtitle-hover-color;
    }
    .job-columns-right-$_id .job-columns-right-text a.more {
        font-size:$_btn-size;
        color:$_btn-text-color;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        background-color:$_btn-background-color ;
    }

    .job-columns-right-$_id h4 {
        font-size:$_right-title-size;
        color:$_right-title-color;
    }
    .job-columns-right-$_id h4:hover {
        color:$_right-title-hover-color;
    }

    .job-columns-right-$_id .job-columns-right-text a.more:hover,
    .job-columns-right-$_id .job-columns-right-text:hover a.more {
        color:$_btn-text-hover-color;
        border-color:$_btn-border-hover-color;
        background-color:$_btn-background-hover-color;
    }
    .job-columns-right-$_id .job-columns-right-text a.more .glyphicon {
        font-size:$_btn-size;
    }

    .job-columns-right-$_id .job-columns-tel {
        font-size:$_tel-size;
        color:$_tel-color;
    }
    .job-columns-right-$_id .job-columns-tel:hover {
        color:$_tel-hover-color;
    }
    .job-columns-right-$_id .job-columns-email {
        font-size:$_email-size;
        color:$_email-color;
    }
    .job-columns-right-$_id .job-columns-email:hover {
        color:$_email-hover-color;
    }
</style>
