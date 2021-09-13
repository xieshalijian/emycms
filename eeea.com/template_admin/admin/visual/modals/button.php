<!-- button modal -->

<div class="modal fade" id="button-config" tabindex="-1" role="dialog" aria-labelledby="button-config" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="icon-close"></i>
                        </span>
                </button>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#button-config-attribute" aria-controls="button-config-attribute" role="tab"
                           data-toggle="tab">
                            <?php echo lang_admin('attribute');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#button-config-txt" aria-controls="button-config-txt" role="tab" data-toggle="tab">
                            <?php echo lang_admin('text');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#button-config-position" aria-controls="button-config-position" role="tab" data-toggle="tab">
                            <?php echo lang_admin('position');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#button-config-margin" aria-controls="button-config-margin" role="tab" data-toggle="tab">
                            <?php echo lang_admin('margin');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#button-config-border" aria-controls="button-config-border" role="tab" data-toggle="tab">
                            <?php echo lang_admin('border');?>
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#button-config-background" aria-controls="button-config-background" role="tab"
                           data-toggle="tab">
                            <?php echo lang_admin('background');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#button-config-url" aria-controls="button-config-url" role="tab" data-toggle="tab">
                            <?php echo lang_admin('link');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="sidebar-nav-margin-input button-config form-inline">

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- 属性 -->
                        <div role="tabpanel" class="tab-pane active" id="button-config-attribute">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                Display
                            </h5>
                            <div class="button-display">
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
                            <div class="blank30">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('btn_size');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('width');?>：
                                    <input type="input" name="width" id="width" value="" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('height');?>：
                                    <input type="input" name="height" id="height" value="0" class="config">
                                    PX
                                </div>
                            </div>
                        </div>
                        <!-- 属性 -->
                        <!-- 文字 -->
                        <div role="tabpanel" class="tab-pane" id="button-config-txt">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('text_align');?>
                            </h5>
                            <div class="dropdown-menu div-text-typesetting">
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
                            <div class="dropdown-menu div-text-typesetting">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                    <i class="glyphicon glyphicon-font">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="#" rel="text-bold" title="<?php echo lang_admin('thickening');?>">
                                    <i class="glyphicon glyphicon-bold">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="#" rel="text-italic" title="<?php echo lang_admin('italics');?>">
                                    <i class="glyphicon glyphicon-italic">
                                    </i>
                                </a>
                                &nbsp;
                            </div>
                            <div class="blank20">
                            </div>
                            <!-- <h5 class="tab_1_h5">
                                垂直对齐
                                </h5>
                                <div class="dropdown-menu div-text-typesetting">
                                <a href="#" rel="" title="<?php echo lang_admin('default');?>">
                                None
                                </a>
                                &nbsp;
                                <a href="#" rel="top" title="居上">
                                Top
                                </a>
                                &nbsp;
                                <a href="#" rel="middle" title="<?php echo lang_admin('centered');?>">
                                Middle
                                </a>
                                &nbsp;
                                <a href="#" rel="bottom" title="居下">
                                Bottom
                                </a>
                                &nbsp;
                                </div> -->
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('font_size');?>
                            </h5>
                            <input type="input" name="font-size" id="font-size" value="" class="config">
                            PX
                            <button id="btn_clsFontZize" class="btn btn-default">
                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                </i>
                            </button>
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('font_color');?>
                            </h5>
                            <div class="input-group" style="width: 200px" id="color_font">
                                <input type="text" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-default color_addion">
                                        <i class="glyphicon glyphicon-adjust">
                                        </i>
                                    </button>
                                    <button id="btn_clsFontColor" class="btn btn-default">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                        </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- 文字 -->
                        <!-- 定位 -->
                        <div role="tabpanel" class="tab-pane" id="button-config-position">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('float');?>
                            </h5>
                            <div class="button-float">
                                <a href="#" rel="none" title="<?php echo lang_admin('default');?>">
                                    <?php echo lang_admin('default');?>
                                </a>

                                &nbsp;
                                <a href="#" rel="left" title="<?php echo lang_admin('be_at_the_left_side');?>">
                                    <?php echo lang_admin('be_at_the_left_side');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="right" title="<?php echo lang_admin('be_at_the_right');?>">
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
                            <h5 class="tab_1_h5">
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
                                <a href="#" rel="left" title="<?php echo lang_admin('be_at_the_left_side');?>">
                                    <?php echo lang_admin('be_at_the_left_side');?>
                                </a>
                                &nbsp;
                                <a href="#" rel="right" title="<?php echo lang_admin('be_at_the_right');?>">
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
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('position');?>
                            </h5>
                            <div class="div-text-typesetting button-position">
                                <a href="#" rel="static" title="<?php echo lang_admin('default');?>">
                                    static
                                </a>
                                &nbsp;
                                <a href="#" rel="absolute" title="<?php echo lang_admin('absolute');?>">
                                    absolute
                                </a>
                                &nbsp;
                                <a href="#" rel="fixed" title="<?php echo lang_admin('fixed');?>">
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
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('z_index');?>
                            </h5>
                            <div class="blank10">
                            </div>
                            Z-index：
                            <input type="input" name="z-index" id="z-index" value="" class="config">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('positions');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('top');?>：
                                    <input type="input" name="top" id="top" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('bottom');?>：
                                    <input type="input" name="bottom" id="bottom" value="0" class="config">
                                    PX
                                </div>
                                <div class="clearfix blank10">
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('left');?>：
                                    <input type="input" name="left" id="left" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('right');?>：
                                    <input type="input" name="right" id="right" value="0" class="config">
                                    PX
                                </div>
                            </div>
                        </div>
                        <!-- 定位 -->
                        <!-- 外边距 -->
                        <div role="tabpanel" class="tab-pane" id="button-config-margin">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('padding');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('top');?>：
                                    <input type="input" name="padding-top" id="padding-top" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('bottom');?>：
                                    <input type="input" name="padding-bottom" id="padding-bottom" value="0"
                                           class="config">
                                    PX
                                </div>
                                <div class="clearfix blank10">
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('left');?>：
                                    <input type="input" name="padding-left" id="padding-left" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('right');?>：
                                    <input type="input" name="padding-right" id="padding-right" value="0"
                                           class="config">
                                    PX
                                </div>
                            </div>
                            <div class="blank30">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('margin');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('top');?>：
                                    <input type="input" name="margin-top" id="margin-top" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('bottom');?>：
                                    <input type="input" name="margin-bottom" id="margin-bottom" value="0"
                                           class="config">
                                    PX
                                </div>
                                <div class="clearfix blank10">
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('left');?>：
                                    <input type="input" name="margin-left" id="margin-left" value="0" class="config">
                                    PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('right');?>：
                                    <input type="input" name="margin-right" id="margin-right" value="0" class="config">
                                    PX
                                </div>
                            </div>
                        </div>
                        <!-- 外边距 -->
                        <!-- 边框 -->
                        <div role="tabpanel" class="tab-pane" id="button-config-border">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('border_type');?>
                            </h5>

                            <div class="button-border-style">
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
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('border_color');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('top');?>：

                                    <div class="input-group" style="width: 200px" id="border-top-color">
                                        <input type="text" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default color_addion">
                                                <i class="glyphicon glyphicon-adjust">
                                                </i>
                                            </button>
                                            <button id="btn_border-top-color" class="btn btn-default">
                                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('right');?>：
                                    <div class="input-group" style="width: 200px" id="border-right-color">
                                        <input type="text" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default color_addion">
                                                <i class="glyphicon glyphicon-adjust">
                                                </i>
                                            </button>
                                            <button id="btn_border-right-color" class="btn btn-default">
                                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix blank10">
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('bottom');?>：
                                    <div class="input-group" style="width: 200px" id="border-bottom-color">
                                        <input type="text" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default color_addion">
                                                <i class="glyphicon glyphicon-adjust">
                                                </i>
                                            </button>
                                            <button id="btn_border-bottom-color" class="btn btn-default">
                                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('left');?>：
                                    <div class="input-group" style="width: 200px" id="border-left-color">
                                        <input type="text" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default color_addion">
                                                <i class="glyphicon glyphicon-adjust">
                                                </i>
                                            </button>
                                            <button id="btn_border-left-color" class="btn btn-default">
                                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('border_size');?>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo lang_admin('top');?>：
                                    <input type="input" name="border-top-width" id="border-width-top" value="0"
                                           class="config">PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('bottom');?>：
                                    <input type="input" name="border-bottom-width" id="border-width-bottom"
                                           value="0" class="config">PX
                                </div>
                                <div class="clearfix blank10">
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('left');?>：
                                    <input type="input" name="border-left-width" id="border-width-left" value="0"
                                           class="config">PX
                                </div>
                                <div class="col-md-6">
                                    <?php echo lang_admin('right');?>：
                                    <input type="input" name="border-right-width" id="border-width-right"
                                           value="0" class="config">PX
                                </div>
                            </div>
                            <div class="blank30">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('btn_radius');?>
                            </h5>
                            <?php echo lang_admin('radius');?>：
                            <input type="input" name="border-radius" id="border-radius" value="" class="config">
                            PX

                        </div>
                        <!-- 边框 -->

                        <!-- 背景 -->
                        <div role="tabpanel" class="tab-pane" id="button-config-background">
                            <div class="blank20">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('background_color');?>：
                            </h5>
                            <div class="input-group" style="width: 200px" id="color_bg_btn">
                                <input type="text" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-default color_addion">
                                        <i class="glyphicon glyphicon-adjust">
                                        </i>
                                    </button>
                                    <button id="btn_clsBgColor" class="btn btn-default">
                                        <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                        </i>
                                    </button>
                                </div>
                            </div>
                            <div class="blank30">
                            </div>
                            <h5 class="tab_1_h5">
                                <?php echo lang_admin('background_image');?>：
                            </h5>
                            <img src="/common/js/ajaxfileupload/pic.png" id="bgurl_url" style="max-width:90px;" />
                            <input id="bgurl" type="file" data-preview-file-type="text">
                            <!-- <button id="btn_clsBgimg">移除<?php echo lang_admin('background');?>图</button> -->
                            <script type="text/javascript">
                                $(function() {
                                    $(".button-config #bgurl").fileinput({
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
                                    }).on('fileerror',
                                        function(event, data, msg) {
                                            console.log(data.id);
                                            console.log(data.index);
                                            console.log(data.file);
                                            console.log(data.reader);
                                            console.log(data.files);
                                            // get message
                                            alert(msg);
                                            $(".button-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
                                        }).on('fileuploaded',
                                        function(event, data, previewId, index) {
                                            response = data.response;
                                            if (response.file_data.code == '0') {
                                                console.log(response.file_data.name);
                                                currButton.css('background-image', 'url(' + response.file_data.name + ')');
                                                $(".button-config #bgurl_url").attr("src",response.file_data.name);
                                            } else {
                                                alert(response.file_data.msg);
                                            }
                                            console.log(response);
                                        }).on('filecleared',
                                        function(event) {
                                            currButton.css('background-image', '');
                                            $(".button-config #bgurl_url").attr("src","/common/js/ajaxfileupload/pic.png");
                                        });

                                });
                            </script>
                            <div class="clearfix">
                            </div>
                        </div>
                        <!-- 背景 -->
                        <!-- <?php echo lang_admin('link');?> -->
                        <div role="tabpanel" class="tab-pane" id="button-config-url">
                            <div class="blank20">
                            </div>
                            <?php echo lang_admin('link_txt');?>：
                            <input type="input" name="text" id="text" value="<?php echo lang_admin('default');?>" class="set_val form-control">
                            <div class="blank20">
                            </div>
                            <?php echo lang_admin('link_url');?>：
                            <input type="input" name="href" id="href" value="http://" class="set_attr form-control">
                        </div>
                        <!-- <?php echo lang_admin('link');?> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_admin('close');?></button>
            </div>
        </div>
    </div>
</div>

<!-- button modal -->
<script type="text/javascript">
    var currButton;
    $(document).ready(function () {
        $('body.edit .visual-right').on("click", "[data-target='#button-config']", function (e) {
            e.preventDefault();
            currButton = $(this).parent().parent().parent().parent().find('.view>a');

            $(".button-config #bgurl_url").attr("src","/images/pic.png"); //缩略图清空
            //console.log(currButton);
            $('.button-config #padding-top').val(parseInt(currButton.css('padding-top')));
            $('.button-config #padding-bottom').val(parseInt(currButton.css('padding-bottom')));
            $('.button-config #padding-left').val(parseInt(currButton.css('padding-left')));
            $('.button-config #padding-right').val(parseInt(currButton.css('padding-right')));

            $('.button-config #margin-top').val(parseInt(currButton.css('padding-top')));
            $('.button-config #margin-bottom').val(parseInt(currButton.css('padding-bottom')));
            $('.button-config #margin-left').val(parseInt(currButton.css('padding-left')));
            $('.button-config #margin-right').val(parseInt(currButton.css('padding-right')));

            $('.button-config #border-top-width').val(parseInt(currButton.css('border-top-width')));
            $('.button-config #border-right-width').val(parseInt(currButton.css('border-right-width')));
            $('.button-config #border-bottom-width').val(parseInt(currButton.css('border-bottom-width')));
            $('.button-config #border-left-width').val(parseInt(currButton.css('border-left-width')));

//定位
            _top = isNaN(parseInt(currButton.css('top'))) ? '' : parseInt(currButton.css('top'));
            _bottom = isNaN(parseInt(currButton.css('bottom'))) ? '' : parseInt(currButton.css('bottom'));
            _left = isNaN(parseInt(currButton.css('left'))) ? '' : parseInt(currButton.css('left'));
            _right = isNaN(parseInt(currButton.css('right'))) ? '' : parseInt(currButton.css('right'));
            $('.button-config #top').val(_top);
            $('.button-config #bottom').val(_bottom);
            $('.button-config #left').val(_left);
            $('.button-config #right').val(_right);


            $('.button-config #font-size').val(parseInt(currButton.css('font-size')));
            $('.div-config #btn_clsFontZize').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('font-size','');
            });

            $('.button-config #z-index').val(currButton.zIndex());

            $('.button-config .button-position a').removeClass("on");
            $('.button-config .button-position').find("[rel="+currButton.css('position')+"]").addClass("on");

            $('.button-config .button-float a').removeClass("on");
            $('.button-config .button-float a').find("[rel="+currButton.css('float')+"]").addClass("on");

            $('.button-config .button-display a').removeClass("on");
            $('.button-config .button-display').find("[rel="+currButton.css('display')+"]").addClass("on");

            $('.button-config .button-border-style a').removeClass("on");
            $('.button-config .button-border-style').find("[rel="+currButton.css('border-style')+"]").addClass("on");

//边框颜色
            $('.button-config #border-top-color input').val(currButton.css('border-top-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-top-color'):'');
            $('.button-config #border-right-color input').val(currButton.css('border-right-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-right-color'):'');
            $('.button-config #border-bottom-color input').val(currButton.css('border-bottom-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-bottom-color'):'');
            $('.button-config #border-left-color input').val(currButton.css('border-left-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-left-color'):'');

            $('.button-config #color_bg_btn').val(currButton.css('background-color')!='rgba(0, 0, 0, 0)'?currButton.css('background-color'):'');
            $('.button-config #color_font').val(currButton.css('color')!='rgba(0, 0, 0, 0)'?currButton.css('color'):'');
            //currButton.css('background-color','#ff0000');
            //console.log(currButton);

//DIV 边框上颜色
            $('.button-config #border-top-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-top-color')
            });
            $('.button-config #border-top-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-top-color', event.color.toString());
            });
            $('.button-config #btn_border-top-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-top-color','');
            });

//DIV 边框右颜色
            $('.button-config #border-right-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-right-color')
            });
            $('.button-config #border-right-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-right-color', event.color.toString());
            });
            $('.button-config #btn_border-right-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-right-color','');
            });

//DIV 边框下颜色
            $('.button-config #border-bottom-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-bottom-color')
            });
            $('.button-config #border-bottom-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-bottom-color', event.color.toString());
            });
            $('.button-config #btn_border-bottom-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-bottom-color','');
            });

//DIV 边框左颜色
            $('.button-config #border-left-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-left-color')
            });
            $('.button-config #border-left-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-left-color', event.color.toString());
            });
            $('.button-config #btn_border-left-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-left-color','');
            });

            $('.button-config #href').val(currButton.attr('href'));
            $('.button-config #text').val(currButton.text());
        });

        $('.button-config #color_bg_btn').colorpicker({
            component:'.color_addion'
        });

        $('.button-config #color_bg_btn').on('changeColor', function(event) {
            currButton.css('background-color', event.color.toString());
        });

        $('.button-config #btn_clsBgColor').on('click', function(event) {
            $(this).parent().parent().find('input').val('');
            currButton.css('background-color','');
        });




        $('.button-config #color_font').colorpicker({
            component:'.color_addion'
        });
        $('.button-config #color_font').on('changeColor', function(event) {
            currButton.css('color', event.color.toString());
        });
        $('.button-config #btn_clsFontColor').on('click', function(event) {
            $(this).parent().parent().find('input').val('');
            currButton.css('color','');
        });



        $('.button-config .config').keyup(function(){
            currButton.css($(this).attr('name'), $(this).val() + 'px');
            //setConfig();
        });


        $('.button-config .set_attr').keyup(function(){
            currButton.attr($(this).attr('name'), $(this).val());
            //setConfig();
        });

//z-index
        $('.button-config #z-index').keyup(function(){
            currButton.css('z-index', $(this).val());
        });

        $('.button-config .set_val').keyup(function(){
            currButton.text($(this).val());
            //setConfig();
        });



        //border-style
        $(".button-config").delegate(".button-border-style a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('border-style',$(this).attr("rel"));
        });

//float
        $(".button-config").delegate(".button-float a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('float',$(this).attr("rel"));
        });

//display
        $(".button-config").delegate(".button-display a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('display',$(this).attr("rel"));
        });

//position
        $(".button-config").delegate(".button-position a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('position',$(this).attr("rel"));
        });

        $(".button-config").delegate(".text-align a", "click", function (e) {
            //console.log(currButton);
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('text-align',$(this).attr("rel"));
        });



//class
        $(".button-config").delegate(".dropdown-menu a", "click", function (e) {
            //console.log(currButton);
            e.preventDefault();
            var t = $(this).parent();
            //console.log(t);
            var n = currButton;
            var r = "";
            t.find("a").each(function () {
                r += $(this).attr("rel") + " ";
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            n.removeClass(r);
            n.addClass($(this).attr("rel"));
        });



    });
</script>