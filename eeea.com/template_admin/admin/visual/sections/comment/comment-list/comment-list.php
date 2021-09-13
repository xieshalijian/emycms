<!-- 组件开始 -->
<div class="lyrow element-box position-move clearfix">
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
        <!--设置按钮-->
        <li>
            <a data-target="#template-commoncss-tag" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-cog"></i>
                <span>{langadmin_set_up}</span>
            </a>
        </li>
        <!--列表样式-->
        <li>
            <a  data-target="#template-list-tag" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-eye-open"></i>
                <span>{langadmin_style}</span>
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
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/comment/comment-list/comment-list.png">
        <p>{langadmin_list}</p>
    </div>
    <div class="view">
        <div class="tag">
            <span class="removeClean tagname">
                &#123;tag_sections_comment_comment-list_1&#125;
            </span>
            <!--组件演示开始-->
            {tag_sections_comment_comment-list_1}
            <!--组件演示结束-->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- 组件结束 -->
