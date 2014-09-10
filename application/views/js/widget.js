//选择框
function WidgetSelect(opt)
{
    var options = {
        parent : null,
        width : null,
        height : null,
        value : ['sel1', 'sel2', 'sel3'],
        callback : function(){},
        isCallback : true
    };

    if(opt != null)
    {
        options = $.extend({}, options, opt);
    }

    //边框宽度
    var b = 1;

    var parent = options.parent;
    var isCallBack = options.isCallback;
    parent.append(
            "<div class='widget-select-box'><span></span>" +
            "<div class='widget-select-btn'></div>" +
            "<div class='widget-select-value'></div>" +
            "</div>");

    var $box = parent.find(".widget-select-box");
    var $boxValue = parent.find(".widget-select-box span");
    var $values = parent.find(".widget-select-value");
    var $btn = parent.find(".widget-select-btn");

    $box.css('width', options.width- b*2 +'px').css('height', options.height- b*2 +'px');
    $boxValue.css('line-height', options.height- b*2 +'px');

    $values.css('top', options.height-1+'px').css('width', options.width+'px').css('left', -b + 'px');

    $btn.css('width', options.height+'px').css('height', options.height-2+'px');

    $boxValue.html(options.value[0]);
    for(var i = 0; i< options.value.length; i++)
    {
        $values.append("<li>"+ options.value[i] +"</li>")
    }

    $box.click(function(event){
        event.cancelBubble = true;
        event.stopPropagation();
        $(".widget-select-value").slideUp();
        $values.stop(true,false);
        $values.slideToggle(300);
    });

    var $eachli;
    function liClick()
    {
        $eachli = $values.find("li");
        $eachli.click(function(event){
            var sel = $eachli.index($(this));
            $boxValue.html(options.value[sel]);
            $values.slideUp(300);
            if(isCallBack == true)
            {
                options.callback(sel + 1, options.value[sel]);
            }
            event.cancelBubble = true;
            event.stopPropagation();
        });
    }
    liClick();

    this.ChangeOptions = function(v)
    {
        $values.empty();
        for(var i = 0; i< v.length; i++)
        {
            $values.append("<li>"+ v[i] +"</li>")
        }
        liClick();
    };
    this.SetSelectIndex = function(index, isCall)
    {
        if(isCall == null)
        {
            isCall = true;
        }
        isCallBack = isCall;
        $eachli.eq(index).click();
        isCallBack = options.isCallback;
    };

    if(typeof WidgetSelect._init == 'undefined')
    {
        WidgetSelect._init = true;
    }
}