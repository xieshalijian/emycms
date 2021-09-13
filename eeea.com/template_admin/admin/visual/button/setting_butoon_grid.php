<span class="drag label btn-group container-box-menu container-box-menu-tipcss">
     <a type="button" class="btn btn-black tooltipcss tooltipcss-right">
        <i class="icon-grid"></i>
        <span class="tooltiptext">
            {langadmin_left_mouse_button_and_drag}
        </span>
    </a>
    <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <span>{langadmin_layout}</span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu btn-black-dropdown-menu">
        <!--层设置-->
        <li>
            <a data-target="#div-config" role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-cog"></i>
                <span>{langadmin_layer_attributes}</span>
            </a>
        </li>
        <!--上移按钮-->
        <li>
            <a class="div-up">
                <i class="glyphicon glyphicon-arrow-up"></i>
                <span>{langadmin_move_up}</span>
            </a>
        </li>
        <!--下移按钮-->
        <li>
            <a class="div-down">
                <i class="glyphicon glyphicon-arrow-down"></i>
                <span>{langadmin_move_down}</span>
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