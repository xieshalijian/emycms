<?php
$tagfrom = $_GET['tagfrom'];
if($tagfrom=='content'){
    $listname = lang_admin('content');
}elseif($tagfrom=='category'){
    $listname = lang_admin('column');
}elseif($tagfrom=='function'){
    $listname = lang_admin('function');
}elseif($tagfrom=='system'){
    $listname = lang_admin('system');
}elseif($tagfrom=='define'){
    $listname = lang_admin('custom');
}
?>
<script type="text/javascript">
    window.onload = function ()
    {
        var aP = document.getElementsByTagName("table");
        var i = 0;
        for (i = 0; i < aP.length; i++)
        {
            aP[i].getElementsByTagName("a")[0].onclick = function ()
            {
                var aSpan = this.parentNode.getElementsByTagName("span");
                aSpan[0].innerHTML = aSpan[1].style.display == "block" ? "{lang_admin('display_js')}" : "{lang_admin('hide')}";
                aSpan[1].style.display = aSpan[1].style.display == "block" ? "none" : "block";
            }
        }
    }
</script>
<div class="main-right-box">
    <form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
        <h5>
                <span class="pull-right">
                    <?php
                    $tagfrom = $_GET['tagfrom'];
                    if($tagfrom=='content'){
                        echo "<a class='btn btn-success pull-left' href='#' onclick='gotourl(this)'   data-dataurl='";
                        echo url::create('table/add/table/templatetagwap/tagfrom/content');
                        echo "' data-dataurlname=".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('content').'&nbsp;'.lang_admin('tags').">".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('content').'&nbsp;'.lang_admin('tags')."</a>";
                    }elseif($tagfrom=='category'){
                        echo "<a class='btn btn-success pull-left' href='#' onclick='gotourl(this)'   data-dataurl='";
                        echo url::create('table/add/table/templatetagwap/tagfrom/category');
                        echo "' data-dataurlname=".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('category').'&nbsp;'.lang_admin('tags').">".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('category').'&nbsp;'.lang_admin('tags')."</a>";
                    }elseif($tagfrom=='define'){
                        echo "<a class='btn btn-success pull-left' href='#' onclick='gotourl(this)'  data-dataurl='";
                        echo url::create('table/add/table/templatetagwap/tagfrom/define');
                        echo "' data-dataurlname=".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('custom').'&nbsp;'.lang_admin('tags').">".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('custom').'&nbsp;'.lang_admin('tags')."</a>";
                    }elseif($tagfrom=='special'){
                        echo "<a class='btn btn-success pull-left' href='#' onclick='gotourl(this)'   data-dataurl='";
                        echo url::create('table/add/table/templatetagwap/tagfrom/special');
                        echo "' data-dataurlname=".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('special').'&nbsp;'.lang_admin('tags').">".lang_admin('add').'&nbsp;'.lang_admin('mobile').'&nbsp;'.lang_admin('special').'&nbsp;'.lang_admin('tags')."</a>";
                    }
                    ?>
                </span>
            {lang_admin('mobile_template_tag_list')}
        </h5>
        <div class="box" id="box">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <!-- 内容标签 -->
                <li role="presentation" class="dropdown<?php
                $tagfrom = $_GET['tagfrom'];
                if($tagfrom=='content'){
                    echo " active";
                }
                ?>">
                    <a href="#" id="tag1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="tag1-contents" aria-expanded="false">
                        {lang_admin('content_label')}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tag1" id="tag1-contents">
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=content&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('wap_column_lable')}">{lang_admin('pc_content_label')}</a>
                        </li>
                        <?php if(file_exists(ROOT."/lib/table/shopping.php")) {?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopcontent&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('pc_shopping_content_label')}">{lang_admin('pc_shopping_content_label')}</a>
                        </li>
                        <?php }?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetagwap&tagfrom=content&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('wap_content_label')}">{lang_admin('wap_content_label')}</a>
                        </li>
                    </ul>
                </li>
                <!-- 栏目标签 -->
                <li role="presentation" class="dropdown<?php
                $tagfrom = $_GET['tagfrom'];
                if($tagfrom=='category'){
                    echo " active";
                }
                ?>">
                    <a href="#" id="tag2" class="dropdown-toggle" data-toggle="dropdown" aria-controls="tag2-contents" aria-expanded="false">
                        {lang_admin('column_lable')}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tag2" id="tag2-contents">
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=category&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('pc_column_lable')}">{lang_admin('pc_column_lable')}</a>
                        </li>
                        <?php if(file_exists(ROOT."/lib/table/shopping.php")) {?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopcategory&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('pc_shopping_column_lable')}">{lang_admin('pc_shopping_column_lable')}</a>
                        </li>
                        <?php }?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetagwap&tagfrom=category&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('wap_column_lable')}">{lang_admin('wap_column_lable')}</a>
                        </li>
                    </ul>
                </li>
                <!-- 自定义标签 -->
                <li role="presentation" class="dropdown<?php
                $tagfrom = $_GET['tagfrom'];
                if($tagfrom=='define'){
                    echo " active";
                }
                ?>">
                    <a href="#" id="tag3" class="dropdown-toggle" data-toggle="dropdown" aria-controls="tag3-contents" aria-expanded="false">
                        {lang_admin('custom_label')}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tag3" id="tag3-contents">
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=define&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('pc_custom_label')}">{lang_admin('pc_custom_label')}</a>
                        </li>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetagwap&tagfrom=define&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('wap_custom_label')}">{lang_admin('wap_custom_label')}</a>
                        </li>
                    </ul>
                </li>
                <!-- 其他标签 -->
                <li role="presentation" class="dropdown<?php
                $tagfrom = $_GET['tagfrom'];
                if($tagfrom=='special'){
                    echo " active";
                }
                ?>">
                    <a href="#" id="tag4" class="dropdown-toggle" data-toggle="dropdown" aria-controls="tag4-contents" aria-expanded="false">{lang_admin('other_label')}<span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="tag4" id="tag4-contents">
                        <?php if(file_exists(ROOT."/lib/table/special.php")) {?>
                            <li>
                                <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=special&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('special_label')}">{lang_admin('special_label')}</a>
                            </li>
                            <?php if(file_exists(ROOT."/lib/table/shopping.php")) {?>
                            <li>
                                <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shopspecial&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('shopping')} {lang_admin('special_label')}">{lang_admin('shopping')} {lang_admin('special_label')}</a>
                            </li>
                            <?php }?>
                        <?php }?>
                        <?php if(file_exists(ROOT."/lib/table/type.php")) {?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=type&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('type_label')}">{lang_admin('type_label')}</a>
                        </li>
                        <?php }?>
                        <?php if(file_exists(ROOT."/lib/table/shopping.php")) {?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=shoptype&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('shopping')} {lang_admin('type_label')}">{lang_admin('shopping')} {lang_admin('type_label')}</a>
                        </li>
                        <?php }?>
                        <li>
                            <a href="#" onclick="gotourl(this)"   data-dataurl="{$base_url}/index.php?case=table&act=list&table=templatetag&tagfrom=announcement&admin_dir={get('admin_dir',true)}&site=default" data-dataurlname="{lang_admin('announcement_label')}">{lang_admin('announcement_label')}</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="blank20"></div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tag1-contents-1" aria-labelledby="tag1-contents-1-tab">
                    <div class="blank30">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr class="th">
                                <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                                <th class="catname"><!--name-->{lang_admin('name')}</th>
                                <th>{lang_admin('format')}</th>
                                <th><!--tagcontent-->{lang_admin('template')}</th>
                                <th class="manage">{lang_admin('dosomething')}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {loop $data $d}
                            <tr>
                                <td class="s_out" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>
                                <td>
                                    {if $d['setting']['remarksname']}
                                    {cut($d['setting']['remarksname'])}
                                    {else}
                                    {cut($d['name'])}
                                    {/if}
                                </td>
                                <td class="catname">
                                    <table>
                                        <tr><td>{lang_admin('in_station_call')}：<span>{</span>tagwap_{cut($d['name'])}<span>}</span></td></tr>
                                        <tr><td>{lang_admin('outside_call')}：<a href="javascript:;"><span style="color:green;">{lang_admin('display_js')}</span></a><span style="display:none;margin-top:10px;">&lt;script src="{$base_url}/index.php?case=templatetag&act=get&id={cut($d['id'])}&="&gt;&lt;/script&gt;</span></td></tr>
                                    </table>
                                </td>
                                <td><?php
                                    if($d['tagcontent']=='null'){
                                        $id = $d['id'];
                                        $path=ROOT.'/config/tag/'.get('tagfrom').'_'.$id.'.php';
                                        $tag_config = array();
                                        $tag_config_content = @file_get_contents($path);
                                        $tag_config = unserialize($tag_config_content);
                                        echo $tag_config['tagtemplate'];
                                    }else{
                                        ?>
                                        {tool::cn_substr(htmlspecialchars($d['tagcontent']),20)}
                                        <?php
                                    }
                                    ?></td>
                                <td class="manage">
                                    <?php
                                    if(($_GET['tagfrom']!='function')){
                                        ?>
                                        <a href="#" onclick="gotourl(this)"   data-dataurl="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/tagfrom/$tagfrom");?>" title="{lang_admin('edit')}" data-dataurlname="{lang_admin('edit_template_tags')} " class="btn btn-gray">{lang_admin('edit')}</a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {lang_admin('more')} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href='<?php
                                                    if($tagfrom=='shopcontent'  || $tagfrom=='shopspecial'|| $tagfrom=='shoptype'   || $tagfrom=='shopcategory') {
                                                        echo url("templatetagwap/test/id/$d[$primary_key]/shopping/1", false);
                                                    }else{
                                                        echo url("templatetagwap/test/id/$d[$primary_key]/shopping/0", false);
                                                    }
                                                    ?>'
                                                       target="_blank" title="{lang_admin('see')}">{lang_admin('see')}</a>
                                                </li>
                                                <li>
                                                    <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#" data-dataurl="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>" title="{lang_admin('delete')}" >{lang_admin('delete')}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            {/loop}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="blank30"></div>
            <input type="hidden" name="batch" value="" />
            <input  class="btn btn-primary" type="button" value="{lang_admin('delete')}" name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('do_delete_id_as')}('+getSelect(this.form)+'){lang_admin('is_it_recorded')}')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; returnform(this.form);}" />
            <div class="blank30"></div>
        </div>
    </form>
</div>
