<link href="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/search-ecoding/css/style.css" rel="stylesheet">


<div class="search-ecoding search-ecoding-$_id">
    <form name='search' action="<?php echo $base_url;?>/index.php?case=archive&act=ecodingsearch" onsubmit="search_check();" method="post">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="{lang('security_code_search')}">
            <span class="input-group-btn">
                <button class="btn btn-default cmseasyedit" cmseasy-id="search" cmseasy-table="lang" cmseasy-field="template" name='submit' type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
</div>

<style type="text/css">

    .search-ecoding-$_id {
        background:$_background-color;
        border-color:$_background-border-color;
    }
    .search-ecoding-$_id:hover {
        background:$_background-hover-color;
        border-color:$_background-border-hover-color;
    }
    .search-ecoding-$_id .input-group .input-group-btn button.btn-default {
          font-size:$_btn-size;
          color:$_btn-text-color;
          border-color:$_btn-border-color;
          border-radius: $_btn-border-radius;
          background:$_btn-background-color;
      }
    .search-ecoding-$_id .input-group .input-group-btn button.btn-default:hover {
          color:$_btn-text-hover-color;
          border-color:$_btn-border-hover-color;
          border-radius: $_btn-border-hover-radius;
          background:$_btn-background-hover-color;
      }

    .search-ecoding-$_id .input-group .form-control {
          font-size:$_input-size;
          color:$_input-text-color;
          border-color:$_input-border-color;
          border-radius: $_input-border-radius;
          background:$_input-background-color;
      }

    .search-ecoding-$_id .input-group .form-control:hover {
          color:$_input-text-hover-color;
          border-color:$_input-border-hover-color;
          border-radius: $_input-border-hover-radius;
          background:$_input-background-hover-color;
      }


</style>



