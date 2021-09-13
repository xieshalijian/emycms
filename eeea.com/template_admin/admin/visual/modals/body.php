
<div class="modal fade" id="template-body-config" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="icon-close"></i>
                            </span>
                </button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tag-body-config" aria-controls="tag-body-config" role="tab" data-toggle="tab">
                            <?php echo lang_admin('background_color');?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <!-- 设置 -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active frmbody" id="tag-body-config">
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('color');?>：
                        </h5>
                        <div class="input-group" style="width: 200px" id="color_body_bg_btn">
                            <input type="text" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-default color_addion">
                                    <i class="glyphicon glyphicon-adjust">
                                    </i>
                                </button>
                                <button id="btn_clsbodyBgColor" class="btn btn-default">
                                    <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>">
                                    </i>
                                </button>
                            </div>
                        </div>
                        <script>
                            var currBody;
                            $(document).ready(function () {
                                currBody = $(document.body);
                                $('.frmbody #color_body_bg_btn').val(currBody.css('background-color')!='rgba(0, 0, 0, 0)'?currBody.css('background-color'):'');

                                $('.frmbody #color_body_bg_btn').colorpicker({
                                    component:'.color_addion'
                                });
                                $('.frmbody #color_body_bg_btn').on('changeColor', function(event) {
                                    /*if($("#body_background_color").length>0){
                                        var html='body {';
                                        html+='background-color: '+event.color.toString()+';';
                                        html+='}';
                                        $("#body_background_color").html(html);
                                    }else{*/
                                    var html=' <style name="body_background_color">';
                                    html+='body {';
                                    html+='background-color: '+event.color.toString()+';';
                                    html+='}';
                                    html+='</style>';
                                    $.post("<?php echo url('template/editbody/color/1/isshopping/'.front::get('isshopping'));?>",{"appendhtml":html},function(res){
                                        console.log(res);
                                    });
                                    //currBody.append(html);
                                    currBody.css('background-color', event.color.toString());
                                });
                            });

                            $('.frmbody #btn_clsbodyBgColor').on('click', function(event) {
                                $(this).parent().parent().find('input').val('#ffffff');
                                currBody.css('background-color','#ffffff');
                                $('.frmbody #color_body_bg_btn').colorpicker('setValue', '#ffffff');
                                $.get("<?php echo url('template/deletebody/color/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                    console.log(res);
                                });
                            });

                        </script>
                        <div class="blank20">
                        </div>
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('positions');?>
                        </h5>
                        <div class="button-positions">
                            <a href="#" rel="none" title="<?php echo lang_admin('default');?>" class="on">
                                <?php echo lang_admin('default');?>
                            </a>
                            <a href="#" rel="left" title="<?php echo lang_admin('be_at_the_left_side');?>">
                                <?php echo lang_admin('be_at_the_left_side');?>
                            </a>
                            <a href="#" rel="center" title="<?php echo lang_admin('centered');?>">
                                <?php echo lang_admin('centered');?>
                            </a>
                            <a href="#" rel="right" title="<?php echo lang_admin('be_at_the_right');?>">
                                <?php echo lang_admin('be_at_the_right');?>
                            </a>
                            <a href="#" rel="top" title="<?php echo lang_admin('be_ahead_of');?>">
                                <?php echo lang_admin('be_ahead_of');?>
                            </a>
                            <a href="#" rel="bottom" title="<?php echo lang_admin('be_content_to_follow');?>">
                                <?php echo lang_admin('be_content_to_follow');?>
                            </a>
                        </div>
                        <script>
                            $(document).ready(function (){
                                $('.frmbody .button-positions a').removeClass("on");
                                $('.frmbody .button-positions a').find("[rel="+currBody.css('background-position')+"]").addClass("on");
                            });
                            $(".frmbody").delegate(".button-positions a", "click", function (e) {
                                e.preventDefault();
                                var t = $(this).parent();
                                t.find("a").each(function () {
                                    $(this).removeClass("on");
                                });
                                $(this).addClass("on");
                                var positions=$(this).attr("rel");
                                if (positions=="none") {
                                    currBody.css('background-position',"");
                                    $.get("<?php echo url('template/deletebody/positions/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                        console.log(res);
                                    });
                                }else{
                                    var html=' <style name="body_background_positions">';
                                    html+='body {';
                                    html+='background-position: '+positions+';';
                                    html+='}';
                                    html+='</style>';
                                    $.post("<?php echo url('template/editbody/positions/1/isshopping/'.front::get('isshopping'));?>",{"appendhtml":html},function(res){
                                        console.log(res);
                                    });
                                    currBody.css('background-position',positions);
                                }


                            });

                        </script>
                        <div class="blank20">
                        </div>
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('background_repeat');?>
                        </h5>
                        <div class="body-repeat">
                            <a href="#" rel="none" title="<?php echo lang_admin('default');?>" class="on">
                                <?php echo lang_admin('default');?>
                            </a>
                            <a href="#" rel="repeat-y" title="<?php echo lang_admin('repeat-y');?>">
                                <?php echo lang_admin('repeat-y');?>
                            </a>
                            <a href="#" rel="repeat-x" title="<?php echo lang_admin('repeat-x');?>">
                                <?php echo lang_admin('repeat-x');?>
                            </a>
                            <a href="#" rel="repeat" title="<?php echo lang_admin('repeat');?>">
                                <?php echo lang_admin('repeat');?>
                            </a>
                            <a href="#" rel="no-repeat" title="<?php echo lang_admin('no_repeat');?>">
                                <?php echo lang_admin('no_repeat');?>
                            </a>
                        </div>
                        <script>
                            $(document).ready(function (){
                                $('.frmbody .body-repeat a').removeClass("on");
                                $('.frmbody .body-repeat a').find("[rel="+currBody.css('background-repeat')+"]").addClass("on");
                            });
                            $(".frmbody").delegate(".body-repeat a", "click", function (e) {
                                e.preventDefault();
                                var t = $(this).parent();
                                t.find("a").each(function () {
                                    $(this).removeClass("on");
                                });
                                $(this).addClass("on");
                                var repeat=$(this).attr("rel");
                                if (repeat=="none") {
                                    currBody.css('background-repeat',"");
                                    $.get("<?php echo url('template/deletebody/repeat/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                        console.log(res);
                                    });
                                }else{
                                    var html=' <style name="body_background_repeat">';
                                    html+='body {';
                                    html+='background-repeat: '+repeat+';';
                                    html+='}';
                                    html+='</style>';
                                    $.post("<?php echo url('template/editbody/repeat/1/isshopping/'.front::get('isshopping'));?>",{"appendhtml":html},function(res){
                                        console.log(res);
                                    });
                                    currBody.css('background-repeat',repeat);
                                }


                            });

                        </script>
                        <div class="blank20">
                        </div>
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('background_fixation');?>
                        </h5>
                        <div class="body-attachment">
                            <a href="#" rel="none" title="<?php echo lang_admin('default');?>" class="on">
                                <?php echo lang_admin('default');?>
                            </a>
                            <a href="#" rel="fixed" title="<?php echo lang_admin('fixed');?>">
                                <?php echo lang_admin('fixed');?>
                            </a>
                        </div>
                        <script>
                            $(document).ready(function (){
                                $('.frmbody .body-attachment a').removeClass("on");
                                $('.frmbody .body-attachment a').find("[rel="+currBody.css('background-attachment')+"]").addClass("on");
                            });
                            $(".frmbody").delegate(".body-attachment a", "click", function (e) {
                                e.preventDefault();
                                var t = $(this).parent();
                                t.find("a").each(function () {
                                    $(this).removeClass("on");
                                });
                                $(this).addClass("on");
                                var attachment=$(this).attr("rel");
                                if (attachment=="none") {
                                    currBody.css('background-attachment',"");
                                    $.get("<?php echo url('template/deletebody/attachment/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                        console.log(res);
                                    });
                                }else{
                                    var html=' <style name="body_background_attachment">';
                                    html+='body {';
                                    html+='background-attachment: '+attachment+';';
                                    html+='}';
                                    html+='</style>';
                                    $.post("<?php echo url('template/editbody/attachment/1/isshopping/'.front::get('isshopping'));?>",{"appendhtml":html},function(res){
                                        console.log(res);
                                    });
                                    currBody.css('background-attachment',attachment);
                                }


                            });

                        </script>
                        <div class="blank30">
                        </div>
                        <h5 class="tab_1_h5">
                            <?php echo lang_admin('background_image');?>：
                        </h5>
                        <img src="/images/pic.png" id="bodybg_url" style="max-width:90px;" />
                        <div class="clearfix"></div>
                        <div class="blank15"></div>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <input id="bodybgurl" type="file" data-preview-file-type="text">
                            </div>
                            <button id="btn_clsbodybgurl" class="btn btn-default">
                                <i class="glyphicon-remove glyphicon" title="<?php echo lang_admin('delete');?>"></i>
                            </button>
                        </div>
                        <!-- <button id="btn_clsBgimg">移除<?php echo lang_admin('background');?>图</button> -->
                        <script type="text/javascript">
                            $('#btn_clsbodybgurl').click(function() {
                                $("#bodybg_url").attr("src","/images/pic.png");
                                currBody.css('background-image', 'url("")');
                                $.get("<?php echo url('template/deletebody/image/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                    console.log(res);
                                });
                            });
                            $(function() {
                                var bgbodyurl=currBody.css('background-image');
                                bgbodyurl= bgbodyurl.replace('url("','').replace('")','');
                                $("#bodybg_url").attr("src",(bgbodyurl==undefined || bgbodyurl=="none")?"/images/pic.png":bgbodyurl);
                                $(".frmbody #bodybgurl").fileinput({
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
                                    }).on('fileuploaded',
                                    function(event, data, previewId, index) {
                                        response = data.response;
                                        if (response.file_data.code == '0') {
                                            console.log(response.file_data.name);
                                            /* if($("#body_background_image").length>0){
                                                 var html='body {';
                                                 html+='background-image: url('+response.file_data.name+');';
                                                 html+='}';
                                                 $("#body_background_image").html(html);
                                             }else{
                                                 var html=' <style name="body_background_image">';
                                                 html+='body {';
                                                 html+='background-image: url('+response.file_data.name+');';
                                                 html+='}';
                                                 html+='</style>';
                                                 currBody.append(html);
                                             }*/
                                            var html=' <style name="body_background_image">';
                                            html+='body {';
                                            html+='background-image: url('+response.file_data.name+');';
                                            html+='}';
                                            html+='</style>';
                                            $.post("<?php echo url('template/editbody/image/1/isshopping/'.front::get('isshopping'));?>",{"appendhtml":html},function(res){
                                                console.log(res);
                                            });
                                            $("#bodybg_url").attr("src",response.file_data.name);
                                            currBody.css('background-image', 'url(' + response.file_data.name + ')');
                                        } else {
                                            alert(response.file_data.msg);
                                        }
                                        console.log(response);
                                    }).on('filecleared',
                                    function(event) {
                                        $("#bodybg_url").attr("src","/images/pic.png");
                                        currBody.css('background-image', 'url("")');
                                        $.get("<?php echo url('template/deletebody/image/1/isshopping/'.front::get('isshopping'));?>",{},function(res){
                                            console.log(res);
                                        });
                                        /*  if($("#body_background_image").length>0){
                                              $("#body_background_image").remove();
                                          }*/
                                    });
                            });
                        </script>
                        <div class="clearfix"></div>
                        <div class="blank20"></div>
                        <div class="blank20"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang_admin('close');?>
                </button>
                <!--   <button id="savebodyconfig" type="button" class="btn btn-primary" data-dismiss="modal">--><?php /*echo lang_admin('preservation');*/?>
                </button>
            </div>
        </div>
    </div>
</div>
