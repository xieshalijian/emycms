
<div class="modal fade modal-right" id="div-config" tabindex="-1" role="dialog" aria-labelledby="div-config-label" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="glyphicon glyphicon-align-justify"></i>
                    </span>
                </button>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a class="tooltipcss tooltipcss-right">
                            <i class="icon-puzzle"></i>
                            <span class="tooltiptext">
                            <?php echo lang_admin('set_up');?>
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">

                <!-- Tab panes -->
                <ul class="nav nav-tabs visual-right-control-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#visual-right-css" aria-controls="visual-right-css" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="CSS类">
                            <i class="icon-layers"></i>
                            <span class="tooltiptext">
                                    CSS类
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-text" aria-controls="visual-right-text" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="文字">
                            <i class="icon-list"></i>
                            <span class="tooltiptext">
                                    文字
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-position" aria-controls="visual-right-position" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="定位">
                            <i class="icon-pin"></i>
                            <span class="tooltiptext">
                                    定位
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-margin" aria-controls="visual-right-margin" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="边距">
                            <i class="icon-size-actual"></i>
                            <span class="tooltiptext">
                                    边距
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-border" aria-controls="visual-right-border" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="边框">
                            <i class="icon-frame"></i>
                            <span class="tooltiptext">
                                    边框
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-background" aria-controls="visual-right-background" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="背景">
                            <i class="icon-picture"></i>
                            <span class="tooltiptext">
                                    背景
                                </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#visual-right-animation" aria-controls="visual-right-animation" role="tab" data-toggle="tab" class="tooltipcss tooltipcss-right" title="动画">
                            <i class="icon-refresh"></i>
                            <span class="tooltiptext">
                                    动画
                                </span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- 属性 -->
                    <div role="tabpanel" class="tab-pane active" id="visual-right-css">
                        <div class="sidebar-nav-margin-input div-config">
                            <div id="div-config-attribute">

                                <h5 class="title">
                                    CSS类:
                                </h5>
                                <div class="input-group">
                                    <span class="input-group-addon">class = </span>
                                    <input type="input" name="class" id="class" value="" class="config-attr form-control">
                                </div>
                                <div class="blank10">
                                </div>

                                <p class="tips">
                                    <i class="icon-info"></i>
                                    <?php echo lang_admin('get_the_value_automatically_do_not_modify_it_if_you_don_t_need_it');?>
                                </p>
                                <div class="blank20">
                                </div>


                                <div class="input-group">
                                        <span class="input-group-addon">
                                        <?php echo lang_admin('width');?>
                                            </span>
                                    <input type="input" name="width" id="width" class="config form-control">
                                    <span class="input-group-addon">PX</span>
                                    <span class="input-group-addon" name="btn_clsWidthHeight" id="btn_clsWidthHeight">
                                            <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('empty');?>">
                                            </i>
                                        </span>
                                </div>

                                <div class="blank10"></div>

                                <div class="input-group">
                                        <span class="input-group-addon" >
                                        <?php echo lang_admin('height');?>
                                            </span>
                                    <input type="input" name="height" id="height" class="config form-control">
                                    <span class="input-group-addon" >PX</span>
                                    <span class="input-group-addon" name="btn_clsWidthHeight" id="btn_clsWidthHeight">
                                            <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                            </i>
                                        </span>
                                </div>

                                <div class="blank15"></div>





                                <div class="blank10">
                                </div>
                                <div>
                                    <p class="tips">
                                        <i class="icon-info"></i>

                                        <?php echo lang_admin('get_the_value_automatically_do_not_modify_it_if_you_don_t_need_it');?>
                                    </p>
                                </div>
                                <div class="blank20">
                                </div>
                                <h5 class="title">
                                    Display
                                </h5>
                                <div class="div-display">
                                    <a href="#" rel="" title="<?php echo lang_admin('nothing');?>">
                                        clear
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="none" title="<?php echo lang_admin('this_element_will_not_be_displayed');?>">
                                        none
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="block" title="<?php echo lang_admin('this_element_will_be_displayed_as_a_blocklevel_element_with_line_breaks_around_it');?>">
                                        block
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="inline" title="<?php echo lang_admin('default_this_element_is_displayed_as_an_inline_element_with_no_line_breaks_around_it');?>">
                                        inline
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="inline-block" title="<?php echo lang_admin('inline_block_elements');?>">
                                        inline-block
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="list-item" title="<?php echo lang_admin('this_element_is_displayed_as_a_list');?>">
                                        list-item
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="run-in" title="<?php echo lang_admin('this_element_is_displayed_as_a_blocklevel_element_or_inline_element_based_on_the_context');?>">
                                        run-in
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="table" title="<?php echo lang_admin('this_element_is_displayed_as_a_blocklevel_table_similar_to_table_with_line_breaks_around_the_table');?>">
                                        table
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="inline-table" title="<?php echo lang_admin('this_element_is_displayed_as_an_inline_table_similar_to_table_with_no_line_breaks_around_the_table');?>">
                                        inline-table
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="inherit" title="规定应该从父元素<?php echo lang_admin('inherit');?> display <?php echo lang_admin('attribute');?>的值。">
                                        inherit
                                    </a>
                                    &nbsp;
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- 属性 -->
                    <!-- 文字 -->
                    <div role="tabpanel" class="tab-pane" id="visual-right-text">
                        <div class="sidebar-nav-margin-input div-config">
                            <div id="div-config-txt">
                                <div class="blank20">
                                </div>
                                <h5 class="title">
                                    <?php echo lang_admin('text_align');?>
                                </h5>
                                <div class="div-text-typesetting div-text-align">

                                    <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                        <i class="glyphicon glyphicon-align-justify">
                                        </i>
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="text-left" title="<?php echo lang_admin('be_at_the_left_side');?>">
                                        <i class="glyphicon glyphicon-align-left">
                                        </i>
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="text-center" title="<?php echo lang_admin('centered');?>">
                                        <i class="glyphicon glyphicon-align-center">
                                        </i>
                                    </a>
                                    &nbsp;
                                    <a href="#" rel="text-right" title="<?php echo lang_admin('be_at_the_right');?>">
                                        <i class="glyphicon glyphicon-align-right">
                                        </i>
                                    </a>

                                    &nbsp; &nbsp; &nbsp;
                                </div>
                                <div class="blank20">
                                </div>
                                <!--<h5 class="title">
                                垂直对齐
                            </h5>
                            <div class="dropdown-menu div-text-typesetting">
                                <a href="#" rel="" title="<?php /*echo lang_admin('default');*/?>">
                                    <i class="glyphicon glyphicon-align-justify">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="#" rel="table-cell" title="垂直<?php /*echo lang_admin('be_at_the_right');*/?>">
                                    <i class="glyphicon glyphicon-resize-vertical">
                                    </i>
                                </a>
                            </div>
                            <div class="dropdown-menu div-text-typesetting">
                                <a href="#" rel="" title="<?php /*echo lang_admin('default');*/?>">
                                    <i class="glyphicon glyphicon-font">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="#" rel="text-bold" title="<?php /*echo lang_admin('thickening');*/?>">
                                    <i class="glyphicon glyphicon-bold">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="#" rel="text-italic" title="<?php /*echo lang_admin('italics');*/?>">
                                    <i class="glyphicon glyphicon-italic">
                                    </i>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>-->
                                <h5 class="title">
                                    <?php echo lang_admin('font_size');?>
                                </h5>

                                <div class="input-group">

                                    <input type="input" name="font-size" id="font-size" class="config form-control">
                                    <span class="input-group-addon">PX</span>
                                    <span class="input-group-addon" name="btn_clsFontZize" id="btn_clsWidthHeight">
                                            <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('empty');?>">
                                            </i>
                                        </span>
                                </div>

                                <div class="blank20">
                                </div>
                                <h5 class="title">
                                    <?php echo lang_admin('font_color');?>
                                </h5>
                                <div class="input-group" id="color_font">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                    <span class="input-group-addon" id="btn_clsFontColor">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 文字 -->
                    <!-- 定位 -->
                    <div role="tabpanel" class="tab-pane" id="visual-right-position">
                        <div id="div-config-position" class="div-config">
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('float');?>
                            </h5>
                            <div class="div-float">
                                <a href="#" rel="none" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="left" title="左">
                                    <?php echo lang_admin('be_at_the_left_side');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="right" title="<?php echo lang_admin('absolute');?>">
                                    <?php echo lang_admin('be_at_the_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="inherit" title="<?php echo lang_admin('inherit');?>">
                                    <?php echo lang_admin('inherit');?>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('eliminate');?>
                            </h5>
                            <div class="div-clear">
                                <a href="#" rel="none" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="both" title="<?php echo lang_admin('eliminate');?>">
                                    <?php echo lang_admin('eliminate');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="left" title="左">
                                    <?php echo lang_admin('be_at_the_left_side');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="right" title="<?php echo lang_admin('absolute');?>">
                                    <?php echo lang_admin('be_at_the_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="inherit" title="<?php echo lang_admin('inherit');?>">
                                    <?php echo lang_admin('inherit');?>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('position');?>
                            </h5>
                            <div class="div-text-typesetting div-position">
                                <a href="#" rel="static" title="<?php echo lang_admin('default');?>">
                                    static
                                </a>
                                &nbsp;
                                <a href="#" rel="absolute" title="<?php echo lang_admin('absolute');?>">
                                    absolute
                                </a>
                                &nbsp;
                                <a href="#" rel="fixed" title="<?php echo lang_admin('absolute');?>">
                                    fixed
                                </a>
                                &nbsp;
                                <a href="#" rel="relative" title="<?php echo lang_admin('relative');?>">
                                    relative
                                </a>
                                &nbsp;
                                <a href="#" rel="inherit" title="<?php echo lang_admin('inherit');?>">
                                    inherit
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('z_index');?>
                            </h5>
                            <div class="blank10">
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">Z-index</span>
                                <input type="input" name="z-index" id="z-index" value="" class="config-attr form-control">
                            </div>

                            <div class="blank20"></div>
                            <h5 class="title">
                                <?php echo lang_admin('positions');?>
                            </h5>

                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('top');?></span>
                                <input type="input" name="top" id="top" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>

                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('right');?></span>
                                <input type="input" name="right" id="right" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('bottom');?></span>
                                <input type="input" name="bottom" id="bottom" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('left');?></span>
                                <input type="input" name="left" id="left" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>


                        </div>
                    </div>
                    <!-- 定位 -->
                    <!-- 外边距 -->
                    <div role="tabpanel" class="tab-pane" id="visual-right-margin">
                        <div id="div-config-margin" class="div-config">
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('padding');?>
                            </h5>



                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('top');?></span>
                                <input type="input" name="padding-top" id="padding-top" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>

                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('right');?></span>
                                <input type="input" name="padding-right" id="padding-right" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('bottom');?></span>
                                <input type="input" name="padding-bottom" id="padding-bottom" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('left');?></span>
                                <input type="input" name="padding-left" id="padding-left" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>

                            <div class="blank30">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('margin');?>
                            </h5>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('top');?></span>
                                <input type="input" name="margin-top" id="margin-top" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>

                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('right');?></span>
                                <input type="input" name="margin-right" id="margin-right" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('bottom');?></span>
                                <input type="input" name="margin-bottom" id="margin-bottom" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo lang_admin('left');?></span>
                                <input type="input" name="margin-left" id="margin-left" value="" class="config-attr form-control">
                                <span class="input-group-addon">PX</span>
                            </div>
                        </div>
                    </div>
                    <!-- 外边距 -->
                    <!-- 边框 -->
                    <div role="tabpanel" class="tab-pane" id="visual-right-border">
                        <div id="div-config-border" class="div-config">
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('border_type');?>
                            </h5>
                            <div class="div-border-style">
                                <a href="#" rel="none" title="<?php echo lang_admin('nothing');?>">
                                    none
                                </a>
                                <a href="#" rel="hidden" title="<?php echo lang_admin('hide');?>">
                                    hidden
                                </a>
                                &nbsp;
                                <a href="#" rel="dotted" title="<?php echo lang_admin('dotted');?>">
                                    dotted
                                </a>
                                &nbsp;
                                <a href="#" rel="dashed" title="<?php echo lang_admin('dashed');?>">
                                    dashed
                                </a>
                                &nbsp;
                                <a href="#" rel="solid" title="<?php echo lang_admin('solid');?>">
                                    solid
                                </a>
                                &nbsp;
                                <a href="#" rel="double" title="<?php echo lang_admin('double');?>">
                                    double
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('border_color');?>
                            </h5>



                            <div class="input-group" id="border-top-color">
                        <span class="input-group-addon">
                        <?php echo lang_admin('top');?>
                            </span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                <span class="input-group-addon" id="btn_border-top-color">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                        </i>
                                    </span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group" id="border-right-color">
                        <span class="input-group-addon">
                        <?php echo lang_admin('right');?>
                            </span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                <span class="input-group-addon" id="btn_border-right-color">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                        </i>
                                    </span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group" id="border-bottom-color">
                        <span class="input-group-addon">
                        <?php echo lang_admin('bottom');?>
                            </span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                <span class="input-group-addon" id="btn_border-bottom-color">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                        </i>
                                    </span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group" id="border-left-color">
                        <span class="input-group-addon">
                        <?php echo lang_admin('left');?>
                            </span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                <span class="input-group-addon" id="btn_border-left-color">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                                        </i>
                                    </span>
                            </div>



                            <div class="blank20"></div>
                            <h5 class="title">
                                <?php echo lang_admin('border_size');?>
                            </h5>

                            <div class="input-group">
                        <span class="input-group-addon">
                        <?php echo lang_admin('top');?>
                            </span>
                                <input type="text" name="border-top-width" id="border-top-width" value="" class="config-attr form-control">
                                <span class="input-group-addon color_addion">
                                     PX
                                    </span>
                            </div>
                            <div class="blank10"></div>

                            <div class="input-group">
                        <span class="input-group-addon">
                        <?php echo lang_admin('right');?>
                            </span>
                                <input type="text" name="border-right-width" id="border-right-width" value="" class="config-attr form-control">
                                <span class="input-group-addon color_addion">
                                     PX
                                    </span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                        <span class="input-group-addon">
                        <?php echo lang_admin('bottom');?>
                            </span>
                                <input type="text" name="border-bottom-width" id="border-bottom-width" value="" class=" config-attr form-control">
                                <span class="input-group-addon color_addion">
                                     PX
                                    </span>
                            </div>
                            <div class="blank10"></div>
                            <div class="input-group">
                        <span class="input-group-addon">
                        <?php echo lang_admin('left');?>
                            </span>
                                <input type="text" name="border-left-width" id="border-left-width" value="" class="config-attr form-control">
                                <span class="input-group-addon color_addion">
                                     PX
                                    </span>
                            </div>

                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('border_radius');?>
                            </h5>

                            <div class="input-group">
                                <input type="text" name="border-radius" id="border-radius" value="" class="config-attr form-control">
                                <span class="input-group-addon color_addion">
                                     PX
                                    </span>
                            </div>


                        </div>
                    </div>
                    <!-- 边框 -->
                    <!-- 背景 -->
                    <div role="tabpanel" class="tab-pane" id="visual-right-background">
                        <div id="div-config-background" class="div-config">
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('background_color');?>：
                            </h5>

                            <div class="input-group" id="color_bg">
                                <input type="text" class="form-control">
                                <span class="input-group-addon color_addion">
                                        <i>
                                        </i>
                                    </span>
                                <span class="input-group-addon" id="btn_clsBgColor">
                                        <i class="glyphicon-remove glyphicon" title="eliminate">
                                        </i>
                                    </span>
                            </div>

                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('background_image');?>：
                            </h5>

                            <div class="input-group">
                                <img src="/common/js/ajaxfileupload/pic.png" id="bgurl_url" style="max-width:90px;" />
                                <div class="input-group-btn">
                                    <input id="bgurl" type="file" data-preview-file-type="text" value="<?php echo lang_admin('upload');?>">
                                </div>
                                <button id="btn_clsBgurl" class="btn btn-default">
                                    <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>"></i>
                                </button>
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('positions');?>：
                            </h5>
                            <div class="div-background-position">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="left" title="<?php echo lang_admin('be_at_the_left_side');?>">
                                    <?php echo lang_admin('be_at_the_left_side');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="center" title="<?php echo lang_admin('centered');?>">
                                    <?php echo lang_admin('centered');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="right" title="<?php echo lang_admin('be_at_the_right');?>">
                                    <?php echo lang_admin('be_at_the_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="top" title="<?php echo lang_admin('be_ahead_of');?>">
                                    <?php echo lang_admin('be_ahead_of');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="bottom" title="<?php echo lang_admin('be_content_to_follow');?>">
                                    <?php echo lang_admin('be_content_to_follow');?>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('background_fixation');?>：
                            </h5>
                            <div class="div-background-attachment">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="fixed" title="<?php echo lang_admin('fixed');?>">
                                    <?php echo lang_admin('fixed');?>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('background_repeat');?>：
                            </h5>
                            <div class="div-background-repeat">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="no-repeat" title="<?php echo lang_admin('no_repeat');?>">
                                    <?php echo lang_admin('no_repeat');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="repeat-x" title="<?php echo lang_admin('repeat_x');?>">
                                    <?php echo lang_admin('repeat_x');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="repeat-y" title="<?php echo lang_admin('repeat_y');?>">
                                    <?php echo lang_admin('repeat_y');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="repeat" title="<?php echo lang_admin('repeat');?>">
                                    <?php echo lang_admin('repeat');?>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('size');?>：
                            </h5>
                            <div class="div-background-size">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="auto" title="<?php echo lang_admin('auto');?>">
                                    <?php echo lang_admin('auto');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="cover" title="<?php echo lang_admin('container_fluid');?>">
                                    <?php echo lang_admin('container_fluid');?>
                                </a>
                                &nbsp;
                            </div>


                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- 背景 -->
                    <!--动画-->
                    <div role="tabpanel" class="tab-pane" id="visual-right-animation">
                        <div id="div-config-wow" class="div-config">
                            <div class="blank20">
                            </div>
                            <h5 class="title">
                                <?php echo lang_admin('animation_time');?>：
                            </h5>

                            <div class="input-group">
                                <input type="text" name="data-wow-delay" id="data-wow-delay" value="" class="form-control">
                                <span class="input-group-addon color_addion">
                                     <?php echo lang_admin('seconds');?>
                                    </span>
                                <span class="input-group-addon color_addion" id="btn_clsdelay">
                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('eliminate');?>">
                        </i>
                    </span>
                            </div>
                            <p class="tips">
                                <i class="icon-info"></i>
                                <?php echo lang_admin('decimal_can_be_entered');?>
                            </p>



                            <div class="blank20">
                            </div>
                            <!--淡入-->
                            <h5 class="title">
                                <?php echo lang_admin('animation_fade');?>：
                            </h5>
                            <div class="animation-fade">
                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="on">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated fadeIn" title="<?php echo lang_admin('fadeIn');?>">
                                    <?php echo lang_admin('fadeIn');?>
                                </a>
                                <a href="#" rel="animated fadeInDown" title="<?php echo lang_admin('fade_in_down');?>">
                                    <?php echo lang_admin('fade_in_down');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated fadeInLeft" title="<?php echo lang_admin('fade_in_right');?>">
                                    <?php echo lang_admin('fade_in_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated fadeInRight" title="<?php echo lang_admin('fade_in_left');?>">
                                    <?php echo lang_admin('fade_in_left');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="animated fadeInUp" title="<?php echo lang_admin('fade_in_up');?>">
                                    <?php echo lang_admin('fade_in_up');?>
                                </a>
                                &nbsp;


                                <!--弹跳-->
                                <h5 class="title">
                                    <?php echo lang_admin('animation_bounce');?>：
                                </h5>

                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="on">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated bounceIn" title="bounceIn">
                                    <?php echo lang_admin('bounce');?>
                                </a>
                                <a href="#" rel="animated bounceInDown" title="<?php echo lang_admin('bounce_in_down');?>">
                                    <?php echo lang_admin('bounce_in_down');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated bounceInLeft" title="<?php echo lang_admin('bounce_in_right');?>">
                                    <?php echo lang_admin('bounce_in_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated bounceInRight" title="<?php echo lang_admin('bounce_in_left');?>">
                                    <?php echo lang_admin('bounce_in_left');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="animated bounceInUp" title="<?php echo lang_admin('bounce_in_up');?>">
                                    <?php echo lang_admin('bounce_in_up');?>
                                </a>
                                &nbsp;


                                <!--缩放-->
                                <h5 class="title">
                                    <?php echo lang_admin('animation_zoom');?>：
                                </h5>

                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="non">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated zoomIn" title="<?php echo lang_admin('zoom_in');?>">
                                    <?php echo lang_admin('zoom_in');?>
                                </a>
                                <a href="#" rel="animated zoomInDown" title="<?php echo lang_admin('zoom_in_down');?>">
                                    <?php echo lang_admin('zoom_in_down');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated zoomInLeft" title="<?php echo lang_admin('zoom_in_right');?>">
                                    <?php echo lang_admin('zoom_in_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated zoomInRight" title="<?php echo lang_admin('zoom_in_left');?>">
                                    <?php echo lang_admin('zoom_in_left');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="animated bounceInUp" title="<?php echo lang_admin('zoom_in_up');?>">
                                    <?php echo lang_admin('zoom_in_up');?>
                                </a>
                                &nbsp;


                                <!--旋转-->
                                <h5 class="title">
                                    <?php echo lang_admin('animation_rotate');?>：
                                </h5>

                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="on">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated rotateIn" title="<?php echo lang_admin('rotate_in');?>">
                                    <?php echo lang_admin('rotate_in');?>
                                </a>
                                <a href="#" rel="animated rotateInDownLeft" title="<?php echo lang_admin('rotate_in_down_left');?>">
                                    <?php echo lang_admin('rotate_in_down_left');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated rotateInDownRight" title="<?php echo lang_admin('rotate_in_down_right');?>">
                                    <?php echo lang_admin('rotate_in_down_right');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated rotateInUpLeft" title="<?php echo lang_admin('rotate_in_up_left');?>">
                                    <?php echo lang_admin('rotate_in_up_left');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="animated rotateInUpRight" title="<?php echo lang_admin('rotate_in_up_right');?>">
                                    <?php echo lang_admin('rotate_in_up_right');?>
                                </a>
                                <!--翻转-->
                                <h5 class="title">
                                    <?php echo lang_admin('animation_flip');?>：
                                </h5>

                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="on">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated flipInX" title="<?php echo lang_admin('flip_in_x');?>">
                                    <?php echo lang_admin('flip_in_x');?>
                                </a>
                                <a href="#" rel="animated flipInY" title="<?php echo lang_admin('flip_in_y');?>">
                                    <?php echo lang_admin('flip_in_y');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated flipOutX" title="<?php echo lang_admin('flip_out_x');?>">
                                    <?php echo lang_admin('flip_out_x');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="animated flipOutY" title="<?php echo lang_admin('flip_out_y');?>">
                                    <?php echo lang_admin('flip_out_y');?>
                                </a>

                                <!--强调类-->
                                <h5 class="title">
                                    <?php echo lang_admin('animation_strong');?>：
                                </h5>
                                <a href="#" rel="" title="<?php echo lang_admin('cancel');?>" class="on">
                                    <?php echo lang_admin('cancel');?>
                                </a>
                                <a href="#" rel="animated bounce" title="<?php echo lang_admin('bounce');?>">
                                    <?php echo lang_admin('bounce');?>
                                </a>
                                <a href="#" rel="animated flash" title="<?php echo lang_admin('twinkle');?>">
                                    <?php echo lang_admin('twinkle');?>
                                </a>
                                <a href="#" rel="animated pulse" title="<?php echo lang_admin('pulse');?>">
                                    <?php echo lang_admin('pulse');?>
                                </a>
                                <a href="#" rel="animated rubberBand" title="<?php echo lang_admin('rubber_band');?>">
                                    <?php echo lang_admin('rubber_band');?>
                                </a>
                                <a href="#" rel="animated shake" title="<?php echo lang_admin('shake');?>">
                                    <?php echo lang_admin('shake');?>
                                </a>
                                <a href="#" rel="animated swing" title="<?php echo lang_admin('jello');?>">
                                    <?php echo lang_admin('jello');?>
                                </a>
                                <a href="#" rel="animated tada" title="<?php echo lang_admin('scale_swing');?>">
                                    <?php echo lang_admin('scale_swing');?>
                                </a>
                                <a href="#" rel="animated wobble" title="<?php echo lang_admin('wobble');?>">
                                    <?php echo lang_admin('wobble');?>
                                </a>
                                <a href="#" rel="animated jello" title="<?php echo lang_admin('jello');?>">
                                    <?php echo lang_admin('jello');?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--动画-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-black" data-dismiss="modal"><?php echo lang_admin('close');?></button>
            </div>
        </div>
    </div>
</div>
<!-- 属性 -->

<script type="text/javascript">
    var currLayoutDiv;
    $(document).ready(function () {
        $('body.edit .visual-right').on("click", "[data-target='#div-config']", function (e) {
            e.preventDefault();
            visual_left_btn();//边栏收缩
            var viewfirst=$(this).parent().parent().parent().parent().find('.view:first>div').eq(0);
            var eText=viewfirst.find('.tagname').html();
            var _tag=new RegExp('tag_');
            if(_tag.test(eText) && viewfirst.hasClass('tag')) {
                currLayoutDiv = $(this).parent().parent().parent().parent().find('.tag');
            }else{
                currLayoutDiv = $(this).parent().parent().parent().parent().find('.view:first>div,.view:first>audio,.view:first>iframe');
            }

            $('.div-config .div-position a').removeClass("on");
            $('.div-config .div-position').find("[rel="+currLayoutDiv.css(' gposition')+"]").addClass("on");

            $('.div-config .div-float a').removeClass("on");
            $('.div-config .div-float').find("[rel="+currLayoutDiv.css('float')+"]").addClass("on");

            $('.div-config .div-text-align a').removeClass("on");
            $('.div-config .div-text-align').find("[rel="+currLayoutDiv.css('float')+"]").addClass("on");


            //淡入动画
            $('.div-config .animation-fade a,.animation-bounce a,.animation-zoom a,.animation-rotate a,.animation-flip a,.animation-strong a').removeClass("on");
            $('.div-config .animation-fade, .div-config.animation-bounce, .div-config.animation-zoom, .div-config.animation-rotate, .div-config.animation-flip,.animation-strong').addClass("on");


            $('.div-config .div-clear a').removeClass("on");
            $('.div-config .div-clear').find("[rel="+currLayoutDiv.css('clear')+"]").addClass("on");

            $('.div-config .div-border-style a').removeClass("on");
            $('.div-config .div-border-style').find("[rel="+currLayoutDiv.css('border-style')+"]").addClass("on");


            $('.div-config .div-background-repeat a').removeClass("on");
            $('.div-config .div-background-repeat').find("[rel="+currLayoutDiv.css('background-repeat')+"]").addClass("on");

            $('.div-config .div-background-size a').removeClass("on");
            $('.div-config .div-background-size').find("[rel="+currLayoutDiv.css('background-size')+"]").addClass("on");

            $('.div-config .div-background-attachment a').removeClass("on");
            $('.div-config .div-background-attachment').find("[rel="+currLayoutDiv.css('background-attachment')+"]").addClass("on");

            $('.div-config .div-display a').removeClass("on");
            $('.div-config .div-display').find("[rel="+currLayoutDiv.css('display')+"]").addClass("on");

            $('.div-config #width').val(parseInt(currLayoutDiv.css('width')));
            $('.div-config #height').val(parseInt(currLayoutDiv.css('height')));

            $('.div-config #class').val(currLayoutDiv.attr('class'));

            $('.div-config #padding-top').val(parseInt(currLayoutDiv.css('padding-top')));
            $('.div-config #padding-bottom').val(parseInt(currLayoutDiv.css('padding-bottom')));
            $('.div-config #padding-left').val(parseInt(currLayoutDiv.css('padding-left')));
            $('.div-config #padding-right').val(parseInt(currLayoutDiv.css('padding-right')));

            $('.div-config #margin-top').val(parseInt(currLayoutDiv.css('margin-top')));
            $('.div-config #margin-bottom').val(parseInt(currLayoutDiv.css('margin-bottom')));
            $('.div-config #margin-left').val(parseInt(currLayoutDiv.css('margin-left')));
            $('.div-config #margin-right').val(parseInt(currLayoutDiv.css('margin-right')));

            $('.div-config #border-top-width').val(parseInt(currLayoutDiv.css('border-top-width')));
            $('.div-config #border-right-width').val(parseInt(currLayoutDiv.css('border-right-width')));
            $('.div-config #border-bottom-width').val(parseInt(currLayoutDiv.css('border-bottom-width')));
            $('.div-config #border-left-width').val(parseInt(currLayoutDiv.css('border-left-width')));


            $('.div-config #border-radius').val(parseInt(currLayoutDiv.css('border-radius')));

            //定位
            _top = isNaN(parseInt(currLayoutDiv.css('top'))) ? '' : parseInt(currLayoutDiv.css('top'));
            _bottom = isNaN(parseInt(currLayoutDiv.css('bottom'))) ? '' : parseInt(currLayoutDiv.css('bottom'));
            _left = isNaN(parseInt(currLayoutDiv.css('left'))) ? '' : parseInt(currLayoutDiv.css('left'));
            _right = isNaN(parseInt(currLayoutDiv.css('right'))) ? '' : parseInt(currLayoutDiv.css('right'));
            $('.div-config #top').val(_top);
            $('.div-config #bottom').val(_bottom);
            $('.div-config #left').val(_left);
            $('.div-config #right').val(_right);

            //动画时间
            $('.div-config #data-wow-delay').val(parseInt(currLayoutDiv.attr('data-wow-delay'))>0?parseInt(currLayoutDiv.attr('data-wow-delay')):'');

            $('.div-config #btn_clsdelay').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.removeAttr('data-wow-delay');
            });

            //字体大小
            $('.div-config #font-size input').val(parseInt(currLayoutDiv.css('font-size')));
            $('.div-config #btn_clsFontZize').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('font-size','');
            });

            //层级
            $('.div-config #z-index').val(currLayoutDiv.zIndex());

            //背景色
            $('.div-config #color_bg').val(currLayoutDiv.css('background-color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('background-color'):'');
            //DIV 背景颜色
            $('.div-config #color_bg').colorpicker({
                component:'.color_addion',
                //是否支持透明度选择
                alpha: false,
                //是否支持色彩选择
                 hue: true,
                //是否显示推荐的颜色预设
                recommend: false,
                //颜色的格式，可选值为 hsl、hsv、hex、rgb,开启 alpha 时为 rgb，其它为 hex
                format:"hex",
                color: currLayoutDiv.css('background-color')
            });
            //字体颜色
            $('.div-config #color_font').val(currLayoutDiv.css('color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('color'):'');

            //边框颜色
            $('.div-config #border-top-color input').val(currLayoutDiv.css('border-top-color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('border-top-color'):'');
            $('.div-config #border-right-color input').val(currLayoutDiv.css('border-right-color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('border-right-color'):'');
            $('.div-config #border-bottom-color input').val(currLayoutDiv.css('border-bottom-color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('border-bottom-color'):'');
            $('.div-config #border-left-color input').val(currLayoutDiv.css('border-left-color')!='rgba(0, 0, 0, 0)'?currLayoutDiv.css('border-left-color'):'');

            $('.div-config #color_bg').on('changeColor', function(event) {
                currLayoutDiv.css('background-color', event.color.toString());
            });

            //清除背景色
            $('.div-config #btn_clsBgColor').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('background-color','');
            });


            //DIV 边框上颜色
            $('.div-config #border-top-color').colorpicker({
                component:'.color_addion',
                color: currLayoutDiv.css('border-top-color')
            });
            $('.div-config #border-top-color').on('changeColor', function(event) {
                //console.log(currLayoutDiv);
                //console.log(event.color);
                currLayoutDiv.css('border-top-color', event.color.toString());
            });
            $('.div-config #btn_border-top-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('border-top-color','');
            });
            //DIV 边框右颜色
            $('.div-config #border-right-color').colorpicker({
                component:'.color_addion',
                color: currLayoutDiv.css('border-right-color')
            });
            $('.div-config #border-right-color').on('changeColor', function(event) {
                //console.log(currLayoutDiv);
                //console.log(event.color);
                currLayoutDiv.css('border-right-color', event.color.toString());
            });
            $('.div-config #btn_border-right-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('border-right-color','');
            });

            //DIV 边框下颜色
            $('.div-config #border-bottom-color').colorpicker({
                component:'.color_addion',
                color: currLayoutDiv.css('border-bottom-color')
            });
            $('.div-config #border-bottom-color').on('changeColor', function(event) {
                //console.log(currLayoutDiv);
                //console.log(event.color);
                currLayoutDiv.css('border-bottom-color', event.color.toString());
            });
            $('.div-config #btn_border-bottom-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('border-bottom-color','');
            });

            //DIV 边框左颜色
            $('.div-config #border-left-color').colorpicker({
                component:'.color_addion',
                color: currLayoutDiv.css('border-left-color')
            });
            $('.div-config #border-left-color').on('changeColor', function(event) {
                //console.log(currLayoutDiv);
                //console.log(event.color);
                currLayoutDiv.css('border-left-color', event.color.toString());
            });
            $('.div-config #btn_border-left-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('border-left-color','');
            });


            $('.div-config #color_font').colorpicker({
                component:'.color_addion',
                color: currLayoutDiv.css('color')
            });
            $('.div-config #color_font').on('changeColor', function(event) {
                currLayoutDiv.css('color', event.color.toString());
            });
            $('.div-config #btn_clsFontColor').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('color','');
            });


            //背景图
            $(".div-config #bgurl").fileinput({
                uploadUrl: '<?php echo url('tool/uploadimage3',false);?>',
                // you must set a valid URL here else you will get an error
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                maxFileSize: <?php echo intval(config::get('upload_max_filesize'));?> * 1024,
                language: 'zh',
                maxFilesNum: 1,
                maxFileCount: 1,
                showPreview: false,
                showCaption: false,
                showUploadedThumbs: false
            }).on('fileerror',function(event, data, msg) {
                console.log(data.id);
                console.log(data.index);
                console.log(data.file);
                console.log(data.reader);
                console.log(data.files);
                // get message
                alert(msg);
                $(".div-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
            }).on('fileuploaded',function(event, data, previewId, index) {
                response = data.response;
                if (response.file_data.code == '0') {
                    //console.log(response.file_data.name);
                    currLayoutDiv.css('background-image', 'url(' + response.file_data.name + ')');
                    $(".div-config #bgurl_url").attr("src",response.file_data.name);
                } else {
                    alert(response.file_data.msg);
                }
                //console.log(response);
            }).on('filecleared', function (event) {
                currLayoutDiv.css('background-image', 'url("")');
                $(".div-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
            });
            //$(".div-config #bgurl").fileinput('reset');
            //console.log($(".div-config #bgurl"));

            //currLayoutDiv.css('background-color','#ff0000');
            //console.log(currLayoutDiv);

            //图片
           var image_url=currLayoutDiv.css("backgroundImage").replace('url(','').replace(')','');
            image_url = image_url.replace("\"","").replace("\"","");
           if (image_url=="none") {
               $(".div-config .fileinput-remove-button").trigger("click");
               $(".div-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
           }else{
               currLayoutDiv.css('background-image', 'url(' + image_url + ')');
               $(".div-config #bgurl_url").attr("src",image_url);
           }

        });

        //清除背景图
        $('.div-config #btn_clsBgurl').on('click', function(event) {
            $(this).parent().parent().find('input').val('');
            currLayoutDiv.css('background-image','');
            $(".div-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
        });


        //width and height
        $('.div-config #btn_clswidth').click(function () {
            $('.div-config #width').val('');
            currLayoutDiv.css('width','');
        });
        $('.div-config #btn_clsheight').click(function () {
            $('.div-config #height').val('');
            currLayoutDiv.css('height','');
        });
        $('.div-config #btn_clsWidthHeight').on('click', function(event) {
            $('.div-config #width,.div-config #height').val("");
        });

        //文字 color
        $('#setfontColor').colorpicker({
            component:'.color_addion'
        });
        $('#setfontColor').on('changeColor', function(event) {
            document.execCommand("ForeColor",false,event.color.toString())
        });

        //属性(css)
        $('.div-config .config').keyup(function(){
            currLayoutDiv.css($(this).attr('name'), $(this).val() + 'px');
        });

        //属性(class)
        $('.div-config .config-attr').change(function(){
            currLayoutDiv.css($(this).attr('name'),$(this).val()+"px");
        });

        //z-index
        $('.div-config #z-index').keyup(function(){
            currLayoutDiv.css('z-index', $(this).val());
        });


        //class
        $(".div-config").delegate(".dropdown-menu a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            //console.log(t);
            var n = currLayoutDiv;
            var r = "";
            t.find("a").each(function () {
                r += $(this).attr("rel") + " ";
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            n.removeClass(r);
            n.addClass($(this).attr("rel"));
        });

        //position
        $(".div-config").delegate(".div-position a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('position',$(this).attr("rel"));
        });


        //border-style
        $(".div-config").delegate(".div-border-style a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('border-style',$(this).attr("rel"));
        });


        //float
        $(".div-config").delegate(".div-float a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('float',$(this).attr("rel"));
        });

        $(".div-config").delegate(".div-text-align a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            if (!$(this).hasClass('on')){
                t.find("a").each(function () {
                    $(this).removeClass("on");
                    currLayoutDiv.removeClass($(this).attr("rel"));
                });
                $(this).addClass("on");
                currLayoutDiv.addClass($(this).attr("rel"));
            }else{
                t.find("a").each(function () {
                    $(this).removeClass("on");
                    currLayoutDiv.removeClass($(this).attr("rel"));
                });
            }
        });



        //animation-fade
        $(".div-config").delegate(".animation-fade a,.animation-bounce a,.animation-zoom a,.animation-rotate a,.animation-flip a,.animation-strong a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            if (!$(this).hasClass('on')){
                t.find("a").each(function () {
                    $(this).removeClass("on");
                    currLayoutDiv.removeClass($(this).attr("rel"));
                });
                $(this).addClass("on");
                currLayoutDiv.addClass($(this).attr("rel"));
            }else{
                t.find("a").each(function () {
                    $(this).removeClass("on");
                    currLayoutDiv.removeClass($(this).attr("rel"));
                });
            }

        });

        //animation_time
        $("[name=data-wow-delay]").change(function(){
            var time = $(this).val();
            time.replace("s","");
            time=time+'s';
            currLayoutDiv.attr('data-wow-delay',time);
            $(this).val(time);
        });

        //clear
        $(".div-config").delegate(".div-clear a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('clear',$(this).attr("rel"));
        });

        //display
        $(".div-config").delegate(".div-display a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('display',$(this).attr("rel"));
        });

        //background position
        $(".div-config").delegate(".div-background-position a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('background-position',$(this).attr("rel"));
        });

        //background size
        $(".div-config").delegate(".div-background-size a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('background-size',$(this).attr("rel"));
        });

        //background repeat
        $(".div-config").delegate(".div-background-repeat a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('background-repeat',$(this).attr("rel"));
        });

        //background attachment
        $(".div-config").delegate(".div-background-attachment a", "click", function (e) {
            //console.log(currLayoutDiv);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currLayoutDiv.css('background-attachment',$(this).attr("rel"));
        });
    });
</script>
<!-- 属性 -->