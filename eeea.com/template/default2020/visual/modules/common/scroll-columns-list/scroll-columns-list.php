
<!-- 组件开始 -->
<div class="lyrow position-move container-fluid-box ">
    <!--层按钮-->
    {setting_butoon_layouts}
    <div class="preview">
        <img src="{$template_path}/visual/modules/common/scroll-columns-list/scroll-columns-list.jpg" alt="子栏目图片滚动说明">
        <p>
            {lang_sections('sub_column_picture_scrolling')}
        </p>
    </div>
    <div class="view">
        <div class="scroll-columns-list scroll-columns-list-$_id clearfix" style="padding-top: 30px; background-color:#f5f5f5; ">
            <!--宽屏部分-->
            <div class="lyrow position-absolute container-box clearfix">
                <!--层按钮-->
                {setting_butoon_layouts}
                <div class="view">
                    <!--前台模板保留宽屏部分-->
                    <div class="container">
                        <!-- column 标注可拖入位置-->
                        <div class="row">
                            <!--层按钮-->
                            {setting_butoon_layouts}
                            <div class="view">
                                <div class="column">
                                    <div class="element-box">
                                        <!--栏目组件按钮-->
                                        {setting_butoon_category}
                                        <div class="view">
                                            <div class="tag">
                                                <!--调取小组件-->
                                                <span class="removeClean tagname">&#123;tag_modules_category_common_scroll-columns-list_1&#125;</span>

                                                {tag_modules_category_common_scroll-columns-list_1}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- 组件结束 -->