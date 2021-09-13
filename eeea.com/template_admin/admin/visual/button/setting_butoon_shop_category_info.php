<span class="drag label btn-group drag-container">
    <a type="button" class="btn btn-black tooltipcss tooltipcss-right">
        <i class="icon-grid"></i>
        <span class="tooltiptext">
            {langadmin_left_mouse_button_and_drag}
        </span>
    </a>
    <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>{langadmin_column}</span>
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
            <a data-target="#template-category-shop-tag" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-cog"></i>
                        <span>{langadmin_set_up}</span>
            </a>
        </li>
        <!--栏目信息-->
        <li>
            <a data-target="#template-category-list" role="button" data-toggle="modal" data-target=".bs-example-modal-lg">
                <i class="glyphicon glyphicon-list-alt"></i>
                <span>{langadmin_information}</span>
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