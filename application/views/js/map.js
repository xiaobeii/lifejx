
function CreateMap()
{
    AddSmall();
}

function AddSmall()
{
    var mapObj;
    //初始化地图对象，加载地图
    mapObj = new AMap.Map("small-map",{
        rotateEnable:false,
        dragEnable:false,
        zoomEnable:false,
        //二维地图显示视口
        view: new AMap.View2D({
            center:new AMap.LngLat(120.756666,30.754525),//地图中心点
            zoom:13 //地图显示的缩放级别
        }),
        lang:"zh_cn"//设置语言类型，中文简体
    });

    $("#small-map").click(function(){
        if($("#big-map-box").length == 0)
        {
            AddBigMap();
        }
    })
}
function AddBigMap()
{
    $('body').append("<div class='big-map-box' id='big-map-box'>" +
        "<div class='big-map-bg'><div class='close-btn' id='close-btn'></div>" +
        "<div class='search-box'><input></div>" +
        "<div class='big-map-amap'></div></div></div>");

    $("#close-btn").click(function(){
        alert(22);
    })
}
