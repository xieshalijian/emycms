<link href="{$template_path}/visual/modules/common/job-columns-pic/css/style-2.css" rel="stylesheet">

{loop plugins::categoryinfo($_catid,$_titlenum,$_textnum) $cat}
<div class="job-columns-pic-item job-columns-pic-item2 job-columns-pic-item2-$_id">

    <img alt="{$cat['catname']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="image" class="cmseasyeditimg lazy" src="{$cat['image']}" />

    <div class="job-columns-pic-text">

        <h4>
            <a title="{$cat['catname']}" href="{$cat['url']}" cmseasy-id="{$cat['catid']}" cmseasy-table="category" cmseasy-field="catname" class="cmseasyedit">
                {$cat['catname']}
            </a>
        </h4>

        <a class="more" title="{$cat['catname']}" href="{$cat['url']}">
            <span class="glyphicon glyphicon-menu-right"></span>
        </a>

    </div>
</div>
{/loop}

<style type="text/css">
    .job-columns-pic-item2-$_id .job-columns-pic-text h4 a {
        font-size:$_link-font-size;
        color:$_link-color;
    }
    .job-columns-pic-item2-$_id .job-columns-pic-text h4 a:hover {
        color:$_link-hover-color;
    }
    .job-columns-pic-item2-$_id .job-columns-pic-text a.more {
        font-size:$_btn-size;
        border-color:$_btn-border-color;
        border-radius: $_btn-border-radius;
        color:$_btn-text-color;
        background:$_btn-background-color;
    }
    ..job-columns-pic-item2-$_id .job-columns-pic-text a.more:hover {
        border-color:$_btn-border-hover-color;
        border-radius: $_btn-border-hover-radius;
        color:$_btn-text-hover-color;
        background:$_btn-background-hover-color;
    }
</style>

