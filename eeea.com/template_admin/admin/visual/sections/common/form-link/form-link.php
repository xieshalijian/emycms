<!-- 组件开始 -->
<div class="lyrow element-box inline-block">
    <!--层按钮-->
    <span class="drag label btn-group drag-container">
       <a type="button" class="btn btn-black tooltipcss tooltipcss-right">
        <i class="icon-grid"></i>
        <span class="tooltiptext">
            {langadmin_left_mouse_button_and_drag}
        </span>
    </a>
        <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu btn-black-dropdown-menu">
            <!--组件层属性-->
        <li>
            <a data-target="#div-config" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-tasks"></i>
                <span>{langadmin_layer_attributes}</span>
            </a>
        </li>
           <li>
                <a data-target="#form-link-config" role="button" data-toggle="modal">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>{langadmin_select_form}</span>
                </a>
            </li>
            <!--设置按钮-->
        <li>
            <a data-target="#template-commoncss-tag" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-cog"></i>
                        <span>{langadmin_set_up}</span>
            </a>
        </li>
            <!--删除按钮-->
        <li>
            <a class="remove">
                <i class="glyphicon glyphicon-remove"></i>
                 <span>{langadmin_delete}</span>
            </a>
        </li>


        </ul>
    </span>
    <div class="preview">
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/form-link/form-link.png" alt="<?php echo lang_admin('form_link');?>">
        <p>{langadmin_form_link}</p>
    </div>
    <div class="view">
        <div class="tag">
            <span class="removeClean tagname">
                &#123;tag_sections_common_button_1&#125;
            </span>
            {tag_sections_common_button_1}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- 组件结束 -->
