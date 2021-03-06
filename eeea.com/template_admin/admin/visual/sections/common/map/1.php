<link href="<?php echo $base_url;?>/template_admin/<?php echo config::getadmin('template_admin_dir');?>/visual/sections/common/map/css/style.css" rel="stylesheet">


<div class="visual-map clearfix visual-map-$_id">

    {if config::get('ditu_APK')}
    <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak={get('ditu_APK')}&s=1"></script>
    {else}
    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    {/if}

    <div style="width:$_width;height:$_height;max-width:100%;margin:0 auto;" id="dituContent"></div>
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMarker();//向地图中添加marker
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var point = new BMap.Point({config::get('ditu_center_left')},{config::get('ditu_center_right')});//定义一个中心点坐标
            map.centerAndZoom(point,{config::get('ditu_level')});//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_RIGHT,type:BMAP_NAVIGATION_CONTROL_SMALL});
            map.addControl(ctrl_nav);
        }

        //标注点数组
        var markerArr = [{title:"{config::get('ditu_title')}",content:"{config::get('ditu_content')}",point:"{config::get('ditu_maker_left')}|{config::get('ditu_maker_right')}",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
        ];
        //创建marker
        function addMarker(){
            for(var i=0;i<markerArr.length;i++){
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0,p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point,{icon:iconImg});
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                marker.setLabel(label);
                map.addOverlay(marker);
                map.openInfoWindow(iw, map.getCenter());
                label.setStyle({
                    borderColor:"#808080",
                    color:"#333",
                    cursor:"pointer"
                });

                (function(){
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click",function(){
                        this.openInfoWindow(_iw);
                    });
                    _iw.addEventListener("open",function(){
                        _marker.getLabel().hide();
                    })
                    _iw.addEventListener("close",function(){
                        _marker.getLabel().show();
                    })
                    label.addEventListener("click",function(){
                        _marker.openInfoWindow(_iw);
                    })
                    if(!!json.isOpen){
                        label.hide();
                        _marker.openInfoWindow(_iw);
                    }
                })()
            }
        }
        //创建InfoWindow
        function createInfoWindow(i){
            var json = markerArr[i];
            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
            return iw;
        }
        //创建一个Icon
        function createIcon(json){
            var icon = new BMap.Icon("<?php echo $base_url;?>/images/map/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
            return icon;
        }

        initMap();//创建和初始化地图
    </script>
</div>


<style type="text/css">
.visual-map-$_id {
    height: $_height;
    background:$_background-color;
    border-color:$_background-border-color;
}
.visual-map-$_id:hover {
    background:$_background-hover-color;
    border-color:$_background-border-hover-color;
}
</style>