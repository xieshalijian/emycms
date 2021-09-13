<!-- 幻灯片组件 -->
<div class="lyrow element-box position-move clearfix">
    <span class="drag label btn-group drag-container absolute-center">
        <a type="button" class="btn btn-black tooltipcss tooltipcss-right"><i class="icon-grid"></i></a>
        <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
        <ul class="dropdown-menu btn-black-dropdown-menu">
            <li>
                <a data-target="#div-config" role="button" data-toggle="modal">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>{langadmin_layer_attributes}</span>
                </a>
            </li>
            <li>
                <a data-target="#template-slide" role="button" data-toggle="modal">
                    <i class="glyphicon glyphicon-pencil"></i>
                    <span>{langadmin_set_up}</span>
                </a>
            </li>
            <li>
                <a class="remove">
                    <i class="glyphicon glyphicon-remove"></i>
                     <span>{langadmin_delete}</span>
                </a>
            </li>
        </ul>
    </span>
    <div class="preview">
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/slide/slide.png" alt="<?php echo lang_admin('slide');?>">
        <p>{langadmin_slide}</p>
    </div>
    <div class="view">
        <div class="visual-slide">

            <div class="tag">

                <span class="removeClean tagname">
                &#123;tag_sections_slide_common_slide_1&#125;
            </span>
                <!--组件演示开始-->
                {tag_sections_slide_common_slide_1}
                <!--组件演示结束-->

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- 组件结束 -->