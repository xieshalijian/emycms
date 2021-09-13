<span class="drag label btn-group drag-container">
   <a type="button" class="btn btn-black tooltipcss tooltipcss-right">
        <i class="icon-grid"></i>
        <span class="tooltiptext">
            {langadmin_left_mouse_button_and_drag}
        </span>
    </a>
    <button type="button" class="btn btn-gray dropdown-toggle" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
         <span>{langadmin_custom_atlas}</span>
        <span class="caret">
        </span>
    </button>
    <ul class="dropdown-menu btn-black-dropdown-menu">
        <li>
            <a data-target="#div-config"
               role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-cog">
                </i>
                <span>{langadmin_layer_attributes}</span>
            </a>
        </li>
        <li>
            <a data-target="#picturesModel"
               role="button" data-toggle="modal">
                <i class="glyphicon glyphicon-picture">
                </i>
                <span>{langadmin_atlas_settings}</span>
            </a>
        </li>
        <li>
            <a class="remove">
                <i class="glyphicon glyphicon-remove">
                </i>
                <span>{langadmin_delete}</span>
            </a>
        </li>
    </ul>
</span>