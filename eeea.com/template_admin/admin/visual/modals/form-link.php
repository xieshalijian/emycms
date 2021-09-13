 <div class="modal fade" id="form-link-config" tabindex="-1" role="dialog" aria-labelledby="form-link-config" aria-hidden="true" data-backdrop="true" data-keyboard="false">
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
                            <a href="#form-link-config-url" aria-controls="form-link-config-url" role="tab" data-toggle="tab">
                                {lang_admin('select_form')}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="sidebar-nav-margin-input form-link-config form-inline">

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- {lang_admin('link')} -->
                            <div role="tabpanel" class="tab-pane active" id="form-link-config-url">
                                <div class="blank20">
                                </div>

                                {lang_admin('link_url')}：
                                <select name="href" id="href" class="form-control select">
                                    <option value="#" selected="">{lang_admin('please_choose')}...</option>
                                    <?php
                                    $tables=array();
                                    $forms=tdatabase::getInstance()->getTables();
                                    foreach($forms as $form) {
                                        if(preg_match('/^'.config::getdatabase('database','prefix').'(my_\w+)/xi',$form['name'],$res))
                                            $tables[]=$res[1];
                                    }
                                    foreach($tables as $t) {
                                    ?>
                                    <option value="{url('form/add/form/'.$t,false)}" >{=@setting::$var[$t]['myform']['cname_'.lang::getisadmin()]}</option>
                                    <?php }?>
                                </select>
                            </div>
                            <!-- {lang_admin('link')} -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{lang_admin('close')}</button>
                </div>
            </div>
        </div>
    </div>

<!-- button modal -->
<script type="text/javascript">
    var currButton;
    $(document).ready(function () {
        $('body.edit .visual-right').on("click", "[data-target='#form-link-config']", function (e) {
            e.preventDefault();
            currButton = $(this).parent().parent().parent().parent().find('.view>a');
            //console.log(currButton);
            $('.form-link-config #padding-top').val(parseInt(currButton.css('padding-top')));
            $('.form-link-config #padding-bottom').val(parseInt(currButton.css('padding-bottom')));
            $('.form-link-config #padding-left').val(parseInt(currButton.css('padding-left')));
            $('.form-link-config #padding-right').val(parseInt(currButton.css('padding-right')));

            $('.form-link-config #margin-top').val(parseInt(currButton.css('padding-top')));
            $('.form-link-config #margin-bottom').val(parseInt(currButton.css('padding-bottom')));
            $('.form-link-config #margin-left').val(parseInt(currButton.css('padding-left')));
            $('.form-link-config #margin-right').val(parseInt(currButton.css('padding-right')));

			$('.form-link-config #border-top-width').val(parseInt(currButton.css('border-top-width')));
            $('.form-link-config #border-right-width').val(parseInt(currButton.css('border-right-width')));
            $('.form-link-config #border-bottom-width').val(parseInt(currButton.css('border-bottom-width')));
            $('.form-link-config #border-left-width').val(parseInt(currButton.css('border-left-width')));

			//定位
            _top = isNaN(parseInt(currButton.css('top'))) ? '' : parseInt(currButton.css('top'));
            _bottom = isNaN(parseInt(currButton.css('bottom'))) ? '' : parseInt(currButton.css('bottom'));
            _left = isNaN(parseInt(currButton.css('left'))) ? '' : parseInt(currButton.css('left'));
            _right = isNaN(parseInt(currButton.css('right'))) ? '' : parseInt(currButton.css('right'));
			$('.form-link-config #top').val(_top);
            $('.form-link-config #bottom').val(_bottom);
            $('.form-link-config #left').val(_left);
            $('.form-link-config #right').val(_right);


            $('.form-link-config #font-size').val(parseInt(currButton.css('font-size')));
			$('.div-config #btn_clsFontZize').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currLayoutDiv.css('font-size','');
            });

			$('.form-link-config #z-index').val(currButton.zIndex());

			$('.form-link-config .button-position a').removeClass("on");
            $('.form-link-config .button-position').find("[rel="+currButton.css('position')+"]").addClass("on");

			$('.form-link-config .button-float a').removeClass("on");
            $('.form-link-config .button-float a').find("[rel="+currButton.css('float')+"]").addClass("on");

			$('.form-link-config .button-display a').removeClass("on");
			$('.form-link-config .button-display').find("[rel="+currButton.css('display')+"]").addClass("on");

			$('.form-link-config .button-border-style a').removeClass("on");
            $('.form-link-config .button-border-style').find("[rel="+currButton.css('border-style')+"]").addClass("on");

			//边框颜色
			$('.form-link-config #border-top-color input').val(currButton.css('border-top-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-top-color'):'');
			$('.form-link-config #border-right-color input').val(currButton.css('border-right-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-right-color'):'');
			$('.form-link-config #border-bottom-color input').val(currButton.css('border-bottom-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-bottom-color'):'');
			$('.form-link-config #border-left-color input').val(currButton.css('border-left-color')!='rgba(0, 0, 0, 0)'?currButton.css('border-left-color'):'');

            $('.form-link-config #color_bg_btn').val(currButton.css('background-color')!='rgba(0, 0, 0, 0)'?currButton.css('background-color'):'');
            $('.form-link-config #color_font').val(currButton.css('color')!='rgba(0, 0, 0, 0)'?currButton.css('color'):'');
            //currButton.css('background-color','#ff0000');
            //console.log(currButton);

			//DIV 边框上颜色
            $('.form-link-config #border-top-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-top-color')
            });
            $('.form-link-config #border-top-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-top-color', event.color.toString());
            });
            $('.form-link-config #btn_border-top-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-top-color','');
            });

			//DIV 边框右颜色
            $('.form-link-config #border-right-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-right-color')
            });
            $('.form-link-config #border-right-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-right-color', event.color.toString());
            });
            $('.form-link-config #btn_border-right-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-right-color','');
            });

			//DIV 边框下颜色
            $('.form-link-config #border-bottom-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-bottom-color')
            });
            $('.form-link-config #border-bottom-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-bottom-color', event.color.toString());
            });
            $('.form-link-config #btn_border-bottom-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-bottom-color','');
            });

			//DIV 边框左颜色
            $('.form-link-config #border-left-color').colorpicker({
                component:'.color_addion',
                color: currButton.css('border-left-color')
            });
            $('.form-link-config #border-left-color').on('changeColor', function(event) {
                //console.log(currButton);
                //console.log(event.color);
                currButton.css('border-left-color', event.color.toString());
            });
            $('.form-link-config #btn_border-left-color').on('click', function(event) {
                $(this).parent().parent().find('input').val('');
                currButton.css('border-left-color','');
            });

            $('.form-link-config #href').val(currButton.attr('href'));
            $('.form-link-config #text').val(currButton.text());
			});

			$('.form-link-config #color_bg_btn').colorpicker({
            component:'.color_addion'
			});

        $('.form-link-config #color_bg_btn').on('changeColor', function(event) {
            currButton.css('background-color', event.color.toString());
        });

        $('.form-link-config #btn_clsBgColor').on('click', function(event) {
            $(this).parent().parent().find('input').val('');
            currButton.css('background-color','');
        });

		


		$('.form-link-config #color_font').colorpicker({
            component:'.color_addion'
        });
        $('.form-link-config #color_font').on('changeColor', function(event) {
            currButton.css('color', event.color.toString());
        });
        $('.form-link-config #btn_clsFontColor').on('click', function(event) {
            $(this).parent().parent().find('input').val('');
            currButton.css('color','');
        });



        $('.form-link-config .config').keyup(function(){
            currButton.css($(this).attr('name'), $(this).val() + 'px');
            //setConfig();
        });
		

		$('.form-link-config .set_attr').keyup(function(){
            currButton.attr($(this).attr('name'), $(this).val());
            //setConfig();
        });

        $('.form-link-config .select').change(function(){
            $('.form-link-config #text').val($("#href option:checked").text());
            currButton.text($("#href option:checked").text());
            currButton.attr($(this).attr('name'), $(this).val());
            //setConfig();
        });

		//z-index
        $('.form-link-config #z-index').keyup(function(){
            currButton.css('z-index', $(this).val());
        });

        $('.form-link-config .set_val').keyup(function(){
            currButton.text($(this).val());
            //setConfig();
        });
       
	    

	   //border-style
	   $(".form-link-config").delegate(".button-border-style a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('border-style',$(this).attr("rel"));
        });

		//float
		$(".form-link-config").delegate(".button-float a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('float',$(this).attr("rel"));
        });

		//display
		$(".form-link-config").delegate(".button-display a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('display',$(this).attr("rel"));
        });

		//position
        $(".form-link-config").delegate(".button-position a", "click", function (e) {
            e.preventDefault();
            var t = $(this).parent();
            t.find("a").each(function () {
                $(this).removeClass("on");
            });
            $(this).addClass("on");
            currButton.css('position',$(this).attr("rel"));
        });

		$(".form-link-config").delegate(".text-align a", "click", function (e) {
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
        $(".form-link-config").delegate(".dropdown-menu a", "click", function (e) {
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