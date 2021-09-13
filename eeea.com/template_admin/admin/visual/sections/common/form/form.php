
<!-- 模块样例一 -->
<div class="lyrow element-box position-move clearfix">
    <span class="drag label btn-group drag-container">
        <a type="button" class="btn btn-black tooltipcss tooltipcss-right">
        <i class="icon-grid"></i>
        <span class="tooltiptext">
            {langadmin_left_mouse_button_and_drag}
        </span>
    </a>
        <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
        <ul class="dropdown-menu btn-black-dropdown-menu">
            <li>
                <a data-target="#div-config" role="button" data-toggle="modal">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>{langadmin_layer_attributes}</span>
                </a>
            </li>
<li>
    <a data-target="#formModel" role="button" data-toggle="modal">
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
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/sections/common/form/form.png">
        <p>{langadmin_form}</p>
    </div>
    <div class="view">
        <div class="content-form">
            <div class=" tag">
             <span class="removeClean tagname">
                &#123;tag_form_my_yingpin&#125;
             </span>
                {tag_form_my_yingpin1}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- 模块样例一结束 -->