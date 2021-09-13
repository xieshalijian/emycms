<div class="main-right-box">
    <h5>
        {lang_admin('language_list')}
        <select  name="lang_open" id="lang_open" onchange="window.location.href ='{url('language/setlangopen')}&langopen='+this.value;" class="form-control select" style="width:auto; display:inline-block;">
            <option value="0"   {if !config::getadmin('lang_open')}selected{/if}>关</option>
            <option value="1"   {if config::getadmin('lang_open')}selected{/if}>开</option>
        </select>
        <!--工具栏-->
        <div class="content-eidt-nav pull-right">
            <span class="pull-right">
        <input class="btn btn-success" type="button" value=" {lang_admin('add_language')} "
               onclick="gotourl(this)"  data-dataurlname="<?php echo lang_admin('add_language');?>" data-dataurl="{url("language/langadd")}' " />
                </span>
        </div>
    </h5>
    <div class="line"></div>
    <div class="blank20"></div>
    <div class="box" id="box">

        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
                        <th class="catid text-center"><!--catid-->{lang_admin('id')}</th>
                        <th class="catname"><!--catname-->{lang_admin('language_package_name')}</th>
                        <th class="text-center"><!--htmldir-->{lang_admin('language_pack_folder')}</th>
                        <th class="isnav text-center"><!--isnav-->{lang_admin('icon')}</th>
                        <th class="isnav text-center"><!--isnav-->{lang_admin('be_the_first_choice')}</th>
                        <th class="isnav text-center"><!--isnav-->{lang_admin('state')}</th>
                        <th class="manage">{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody id="listtable">
                    {loop $data $d}
                    <tr onmouseover="m_over(this)" onmouseout="m_out(this)" >
                        <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]" {if $d['isdefault']}disabled{/if}> </td>
                        <td class="catid text-center">
                            {$d[$primary_key]}
                        </td>
                        <td class="langname">
                            <a style="float:left;" href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("language/edit/id/".$d[$primary_key]);?>">{$d['langname']}</a>
                        </td>
                        <td class="langurlname text-center">
                            <span class="hotspot"  >{$d['langurlname']}</span>
                        </td>
                        <td class="static text-center">
                            <img src="{$d['langimg']}">
                        </td>
                        <td class="isdefault text-center">
                            <span class="hotspot" >{helper::yes($d['isdefault'],false)} </span>
                        </td>
                        <td class="static text-center">
                            <span class="hotspot" >{helper::yes($d['static'],false)} </span>
                        </td>
                        <td class="manage">
                            <a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("language/langedit/id/".$d[$primary_key]); ?>" class="btn btn-gray" data-dataurlname="{lang_admin('editorial_language')}">{lang_admin('edit')}</a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {lang_admin('more')} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("language/edit/id/".$d[$primary_key]."/lang_choice/system_custom.php"); ?>" data-dataurlname="{lang_admin('user_custom_lang')}">{lang_admin('user_custom_lang')}</a>
                                    </li>
                                    <li>
                                        <a  href="#" onclick="gotourl(this)"   data-dataurl="<?php echo url("language/edit/id/".$d[$primary_key]."/lang_choice/system.php"); ?>" data-dataurlname="{lang_admin('system_language_item')}">{lang_admin('system_language_item')}</a>
                                    </li>
                                    <?php if($d['isdefault']==0){ ?>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"    data-dataurl="<?php echo url('language/delete/id/'.$d[$primary_key]);?>">{lang_admin('delete')}</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    {/loop}
                    </tbody>
                </table>
            </div>
            <input type="button" value="{lang_admin('delete')}" name="delete" onclick="if(getSelect(this.form) && confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){this.form.action='<?php echo url('language/delete');?>'+'&meanwhile='+($('#meanwhile').is(':checked')?1:0); returnform(this.form); }" class="btn btn-gray"/>
            <input  type="checkbox" name="meanwhile" id="meanwhile" style="margin-left:30px;">
            {lang_admin('meanwhile_delete_data')}
            <div class="blank30"></div>
            <div class="line"></div>
            <div class="page"><?php echo pagination::html(count($data)); ?></div>
            <input type="hidden" name="batch" value="">
        </form>

        <div class="blank30"></div>
    </div>
</div>
