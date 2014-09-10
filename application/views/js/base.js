/**
 * Created by lusilence on 14-7-17.
 */
//判断手机还是PC
//返回0为电脑，返回1为手机
function Device(){
    if(window.screen.width>1000)
        return 0;
    else
        return 1;
}

//动态滚动
function SlideAction(){
    $('a[href*=#]').click(function()
    {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname)
        {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body').animate({scrollTop: targetOffset}, 1000);
                return false;
            }
        }
    });
}

//获取浏览器版本号
function BrowserVersion(){
    var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
    var isOpera = userAgent.indexOf("Opera") > -1; //判断是否Opera浏览器
    var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera ; //判断是否IE浏览器
    var isFF = userAgent.indexOf("Firefox") > -1 ; //判断是否Firefox浏览器
    var isSafari = userAgent.indexOf("Safari") > -1 ; //判断是否Safari浏览器
    var isChrome = userAgent.indexOf("Chrome") > -1 ; //判断是否Safari浏览器

    if(isIE){
        var IE5 = IE55 = IE6 = IE7 = IE8 = false;
        var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
        reIE.test(userAgent);
        var fIEVersion = parseFloat(RegExp["$1"]);

        IE55 = fIEVersion == 5.5 ;
        IE6 = fIEVersion == 6.0 ;
        IE7 = fIEVersion == 7.0 ;
        IE8 = fIEVersion == 8.0 ;

        if(IE55){ return "IE55"; }
        if(IE6){ return "IE6"; }
        if(IE7){ return "IE7"; }
        if(IE8){ return "IE8"; }
    }
    else if(isFF){ return "FF"; }
    else if(isOpera){ return "Opera"; }
    else if(isChrome){ return "Chrome";}
    else {return "other"}
}

//加载不同的css
function IncludeCss(pc, phone){
    var IE = top.execScript?1:0;
    var style = document.createElement('link');
    style.rel = 'stylesheet';
    style.type = 'text/css';

    var head = document.getElementsByTagName('head')[0];
    if(IE){
        style.href = pc;
    }else{
        if(device()==0)
            style.href = pc;
        else
            style.href = phone;
    }
    head.appendChild(style);
}

//网页间通过url传值
function GetUrlValue(){
    var tmpArr;
    var QueryString;
    var URL = document.location.toString();
    if(URL.lastIndexOf("?")!=-1){
        QueryString= URL.substring(URL.lastIndexOf("?")+1,URL.length);
        tmpArr=QueryString.split("&");
        return tmpArr;
    }
    else{
        return 'NaN';
    }
}

//cookie操作
function SetCookie(name,value,time){
    //var Days = 60;   //cookie 将被保存两个月
    var exp  = new Date();  //获得当前时间
    exp.setTime(exp.getTime() + time*1000);  //换成毫秒
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function GetCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
    if(arr != null)
        return unescape(arr[2]);
    return null;

}
function DelCookie(name){
    var exp = new Date();  //当前时间
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}


//数值转换成数值字符串 NumberToArray(2345, false)
//isPositive = true : 输入2345，返回[2, 3, 4, 5]
//isPositive = true : 输入2345，返回[5, 4, 3, 2]
function NumToArray(value)
{
    var m = 100000000;      //可处理的最大数值
    var array = [];
    var isPositive = arguments[1]!=undefined ? arguments[1]:true;

    while(m >= 1 )
    {
        var v = parseInt(value / m);
        value = value - v * m;
        m = m/10;
        if(v == 0 && array[0] == null)
        {
            continue;
        }
        if(isPositive == true)
        {
            array.push(v);
        }
        else
        {
            array.unshift(v);
        }
    }
    return array;
}

//加载等待框
var Loading = function()
{
    return Loading.prototype.init();
};
Loading.prototype = {
    init : function(){
        $('body').append("<div class='loading-layer' id='loading-layer'></div>");
        this.obj = $("#loading-layer");
        this.remove();
        return this;
    },
    add : function(){
        this.obj.css('display', 'block');
    },
    remove : function(){
        this.obj.css('display', 'none');
    }
};
Loading.prototype.init.prototype = Loading.prototype;
var loading = new Loading();

//ajax请求
//'main/xlActionGetAvgTest.action'
function Ajax(isShowLoading, url, type, callback, data)
{
    if(url == null || url == '')
        return;

    if(isShowLoading == true)
    {
        loading.add();
    }

    type = type ? type : 'post';
    callback = callback ? callback : null;
    data = data ? data : '';

    $.ajax({
        type : type,
        url : url,
        data : data,
        dataType : 'json',
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        error : function(){ loading.remove(); alert('数据刷新失败，请重试。')},
        success : function(json){ loading.remove(); callback(json); }
    })
}
//打印
function Log(str)
{
    console.log(str);
}
