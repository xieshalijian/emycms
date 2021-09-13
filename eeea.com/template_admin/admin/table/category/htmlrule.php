<div class="main-right-box">
    <h5>{lang_admin('url_rules')}</h5>
    <div class="blank20"></div>
    <div class="box" id="box">

        <span class="pull-right">
             <a href="#" data-toggle="modal" data-target="#URLmyModal" data-target=".bs-example-modal-lg" class="btn btn-success">{lang_admin('url_instructions')}</a>
        </span>

        <ul class="nav nav-tabs" role="tablist">
            <li {if $cate=='category'}class="active"{/if}>
                <a href="#" onclick="gotourl(this)" data-dataurl="{url('table/htmlrule/table/category/cate/category')}" data-dataurlname="{lang_admin('column_url')}">
                    {lang_admin('column_url')}
                </a>
            </li>
            <li {if $cate=='archive'}class="archive"{/if}>
                <a href="#" onclick="gotourl(this)" data-dataurl="{url('table/htmlrule/table/category/cate/archive')}" data-dataurlname="{lang_admin('content_url')}">
                    {lang_admin('content_url')}
                </a>
            </li>
            <li {if $cate=='type'}class="archive"{/if}>
                <a href="#" onclick="gotourl(this)" data-dataurl="{url('table/htmlrule/table/category/cate/type')}" data-dataurlname="{lang_admin('type_url')}">
                    {lang_admin('type_url')}
                </a>
            </li>
            <li {if $cate=='type'}class="archive"{/if}>
                <a href="#" onclick="gotourl(this)" data-dataurl="{url('table/htmlrule/table/category/cate/special')}" data-dataurlname="{lang_admin('type_url')}">
                    {lang_admin('special_url')}
                </a>
            </li>
            <li {if $cate=='type'}class="archive"{/if}>
                <a href="#" onclick="gotourl(this)" data-dataurl="{url('table/htmlrule/table/category/cate/tag')}" data-dataurlname="{lang_admin('type_url')}">
                    {lang_admin('tag_url')}
                </a>
            </li>
            <!--<li {if $cate=='special'}class="active"{/if}>
                <a href="#" onclick="gotourl(this)"data-dataurl="{url('table/htmlrule/table/category/cate/special')}"  data-dataurlname="{lang_admin('special_url')}">
                    {lang_admin('special_url')}
                </a>
            </li>-->

        </ul>

        <div class="blank30"></div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="th">
                        <th class="s_out"><input title="{lang_admin('click_to_select_all_items_on_this_page')}"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
                        <th>{lang_admin('id')}</th>
                        <th>{lang_admin('name')}</th>
                        <th>{lang_admin('rule')}</th>
                        <th>{lang_admin('subordinate')}</th>
                        <th>{lang_admin('dosomething')}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {loop $data $id $htmlrule}
                    {php $id+=1}
                    <tr>
                        <td class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$id}" name="select[]"> </td>
                        <td >{$id}</td>
                        <td align="left" >{$htmlrule['hrname']}</td>
                        <td align="left" >{$htmlrule['htmlrule']}</td>
                        <td >{if $htmlrule['cate'] == 'archive'}{lang_admin('content')}{/if}
                            {if $htmlrule['cate'] == 'category'}{lang_admin('column')}{/if}
                            {if $htmlrule['cate'] == 'type'}{lang_admin('type')}{/if}
                            {if $htmlrule['cate'] == 'special'}{lang_admin('special')}{/if}
                            {if $htmlrule['cate'] == 'tag'}{lang_admin('tag')}{/if}
                        </td>
                        <td>
                            <a href="#"  onclick="gotourl(this)" data-dataurl="{url('table/htmlruleedit/table/category/id/'.($id-1))}" data-dataurlname="edit_url" class="btn btn-gray">
                                {lang_admin('edit')}
                            </a>
                            <a onclick="if(confirm('{lang_admin('are_you_sure_you_want_to_delete_it')}')){gotourl(this);};" href="#"   data-dataurl="<?php echo modify("/act/htmlrule/table/$table/id/$id/o/del");?>" title="{lang_admin('delete')}" class="btn btn-default">{lang_admin('delete')}</a>
                        </td>
                    </tr>
                    {/loop}

                    </tbody>
                </table>
            </div>

            <div class="blank30"></div>
            <div class="line"></div>
            <div class="blank30"></div>

            <div class="alert alert-warning alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-warning-sign"></span>	<strong>{lang_admin('added_custom_url_rules')}</strong> 	[{lang_admin('please_operate_with_caution')}]&nbsp;&nbsp;&nbsp;&nbsp;

            </div>

        <form name="listform" id="listform"  action="<?php echo uri();?>" method="post" onsubmit="return returnform(this);">
           <table class="table table-hover">
                <thead>
                <tr class="th">
                    <th>{lang_admin('name')}</th>
                    <th>{lang_admin('content')}</th>
                    <th>{lang_admin('subordinate')}</th>
                    <th>{lang_admin('dosomething')}</th>
                </tr>
                </thead>
                <tbody>

                <tr class="s_out" >
                    <td>
                        <input type="text" value="" name="hrname" id="hrname" class="form-control" /></td>
                    <td><input type="text" value="" name="htmlrule" class="form-control" />
                    </td>
                    <td>
                        <select name="cate" class="form-control select">
                            <option value="category"  {if $cate=='category'}selected{/if}>{lang_admin('column')}</option>
                            <option value="archive" {if $cate=='archive'}selected{/if}>{lang_admin('content')}</option>
                            <option value="type" {if $cate=='type'}selected{/if}>{lang_admin('type')}</option>
                            <option value="special" {if $cate=='special'}selected{/if}>{lang_admin('special')}</option>
                            <option value="tag" {if $cate=='tag'}selected{/if}>{lang_admin('tag')}</option>
                        </select>
                    </td>
                    <td>
                        <input  name="submit" value="1" type="hidden">
                        <input   type="submit" value="{lang_admin('add_to')}" class="btn btn-primary" /></td>
                </tr>
                </tbody>
            </table>

         </form>
    </div>

    <div class="blank30"></div>
</div>



<style type="text/css">
    .modal-body {font-size:0.8rem;}
    #URLmyModal .modal-body .table td {color:#d5d5d5 !important;}
    #URLmyModal .modal-body .table tr:hover .btn-gray,
    #URLmyModal .modal-body .table tr:hover td {color:#333 !important;}
</style>


<!-- Modal -->
<div class="modal fade" id="URLmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="table-responsive">
                    <h5>{lang_admin('url_function')}</h5>

                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th>{lang_admin('subordinate')}</th>
                            <th>{lang_admin('call_item')}</th>
                            <th>{lang_admin('explain')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('overall_situation')}</span></td>
                            <td>&#123;&#36;lang&#125;</td>
                            <td>{lang_admin('language_category')}</td>
                        </tr>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('column')}</span></td>
                            <td>&#123;&#36;catid&#125;</td>
                            <td>{lang_admin('column_id')}</td>
                        </tr>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('column')}</span></td>
                            <td>&#123;&#36;dir&#125;</td>
                            <td>{lang_admin('catalog_name')}</td>
                        </tr>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('column')}</span></td>
                            <td>&#123;&#36;caturl&#125;</td>
                            <td>{lang_admin('multilayer_directory')}</td>
                        </tr>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('column')}</span></td>
                            <td>&#123;&#36;page&#125;</td>
                            <td>{lang_admin('page')}</td>
                        </tr>
                        <tr>
                            <td><span class="btn btn-gray">{lang_admin('content')}</span></td>
                            <td>&#123;&#36;aid&#125;</td>
                            <td>{lang_admin('content_id')}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="blank20"></div>
                    <h5>{lang_admin('column_url')}</h5>
                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th class="col-md-5">{lang_admin('explain')}</th>
                            <th>{lang_admin('for_example')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{lang_admin('short_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/{lang_admin('page')}-{lang_admin('languages')}</td>
                            <td>&#123;&#36;caturl&#125;/&#123;&#36;page&#125;-&#123;&#36;lang&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('example_of_access')}</td>
                            <td>{lang_admin('domain_name')}/html/about/about/1-cn.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('hierarchy_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/{lang_admin('catalog')}/{lang_admin('page')}-{lang_admin('languages')}</td>
                            <td>&#123;&#36;dir&#125;/&#123;&#36;page&#125;-&#123;&#36;lang&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('example_of_access')}</td>
                            <td>{lang_admin('domain_name')}/html/about/1-cn.html</td>
                        </tr>

                        </tbody>
                    </table>



                    <div class="blank20"></div>
                    <h5>{lang_admin('content_url')}</h5>
                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th class="col-md-5">{lang_admin('explain')}</th>
                            <th>{lang_admin('for_example')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{lang_admin('short_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/show-{lang_admin('content_id')}-{lang_admin('page')}-{lang_admin('languages')}</td>
                            <td>&#123;&#36;caturl&#125;/show-&#123;&#36;aid&#125;-&#123;&#36;page&#125;-&#123;&#36;lang&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('example_of_access')}</td>
                            <td>{lang_admin('domain_name')}/html/about/show-888-1-cn.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('hierarchy_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/{lang_admin('catalog')}/show-{lang_admin('content_id')}-{lang_admin('page')}-{lang_admin('languages')}</td>
                            <td>&#123;&#36;dir&#125;/show-&#123;&#36;aid&#125;-&#123;&#36;page&#125;-&#123;&#36;lang&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('example_of_access')}</td>
                            <td>{lang_admin('domain_name')}/html/about/about/show-888-1-cn.html</td>
                        </tr>
                        </tbody>
                    </table>



                    <div class="blank20"></div>
                    <h5>{lang_admin('content_url')}</h5>
                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th class="col-md-5">{lang_admin('explain')}</th>
                            <th>{lang_admin('for_example')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{lang_admin('short_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/内容ID-{lang_admin('page')}</td>
                            <td>&#123;&#36;caturl&#125;/&#123;&#36;aid&#125;-&#123;&#36;page&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('hierarchy_url')}：{lang_admin('domain_name')}/目录/目录/内容ID-{lang_admin('page')}</td>
                            <td>&#123;&#36;dir&#125;/&#123;&#36;aid&#125;-&#123;&#36;page&#125;.html</td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="blank20"></div>


                    <!--<h5>专题URL函数</h5>
                    <table class="table table-hover">
                        <thead>
                        <tr class="th">
                            <th class="col-md-5">{lang_admin('explain')}</th>
                            <th>{lang_admin('for_example')}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{lang_admin('short_url')}：{lang_admin('domain_name')}/{lang_admin('catalog')}/内容ID-{lang_admin('page')}</td>
                            <td>&#123;&#36;caturl&#125;/&#123;&#36;aid&#125;-&#123;&#36;page&#125;.html</td>
                        </tr>
                        <tr>
                            <td>{lang_admin('hierarchy_url')}：{lang_admin('domain_name')}/目录/目录/内容ID-{lang_admin('page')}</td>
                            <td>&#123;&#36;dir&#125;/&#123;&#36;aid&#125;-&#123;&#36;page&#125;.html</td>
                        </tr>

                        </tbody>
                    </table>-->
                    <div class="blank20"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{lang_admin('close')}</button>
            </div>
        </div>
    </div>
</div>

