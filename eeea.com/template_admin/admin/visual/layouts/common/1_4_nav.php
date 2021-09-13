<div class="lyrow container-fluid-box position-move clearfix">
    {setting_butoon_layouts}
    <div class="preview">
        <img src="<?php echo $base_url;?>/template_admin/<?php echo get('template_admin_dir',true);?>/visual/layouts/common/1_4_nav.png">
        <p>
            {langadmin_container_fluid_nav}
        </p>
    </div>
    <div class="view">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="codearea">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">#[#get('sitename')#]#</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    </div>
                    <div class="viewarea">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">{get('sitename')}</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-brand">
                        <div class="codearea">
                            <a href="#[#$base_url#]#/" title="#[#get('sitename')#]#">
                                <img src="#[#get('site_logo')#]#" class="img-responsive cmseasyeditimg"  cmseasy-id="site_logo" cmseasy-table="config" cmseasy-field="config" alt="#[#get('sitename')#]#">
                            </a>
                        </div>
                        <div class="viewarea">
                            <a href="<?php echo $base_url;?>/" title="{get('sitename')}">
                                <img src="{get('site_logo')}" class="img-responsive cmseasyeditimg" cmseasy-id="site_logo" cmseasy-table="config" cmseasy-field="config" alt="{get('sitename')}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav navbar-nav navbar-right" rel="nav(1)">
                    <?php if (front::get('isshopping'))echo shopping_nav(1);else echo nav(1);?>
                </div>
            </div>
    </div>
    </nav>
</div>
</div>