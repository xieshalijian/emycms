
<div class="search-ecoding search-ecoding-$_id">
    <form name='search' action="<?php echo $base_url;?>/index.php?case=archive&act=ecodingsearch" onsubmit="search_check();" method="post">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="<?php echo lang('security_code_search');?>">
            <span class="input-group-btn">
<button class="btn btn-default" name='submit' type="submit"><?php echo lang('search');?></button>
</span>
        </div>
    </form>
</div>