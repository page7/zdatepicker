//传说中的时间插件
/*!
 * ICalendar (Calendar Plug-in for jQuery)  v2.1
 * http://www.interidea.org/
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Date: Fri Mar 19 00:00:00 2013 -0500
 */

;(function ($) {

$.fn.icalendar = function(options){

    $.fn.icalendar.defaults = {
        className  : "icalendar",
        event      : "click",
        showMonths : 2,
        startDate  : null,
        symbiont   : false,
        readonly   : false,
        disable    : {},
        area       : {},
        selected   : false,          //v1.0.6 修正上次错误定义
		show       : null,
        closeButton : false,
        pos        : {},
        format     : {date:"Ｙ-ｍ-ｄ",month:"Ｙ-ｍ",year:"Ｙ年",onlymonth:"ｍ月"}, //v1.0.4 全角 v2.0.1 追加onlymonth
        day_str    : ["日","一","二","三","四","五","六"],
        month_str  : ["1","2","3","4","5","6","7","8","9","10","11","12"],
        year2str   : null,
        str2year   : null,
        replace    : null,    //v1.0.7 日期替换，用于特殊日期
        use        : false    //v1.0.7 直接利用已有元素进行扩展，若为true，则根据className调用
    };

    //debug mode
    var debug = 0;


	var opts = $.extend({}, $.fn.icalendar.defaults, options);

    //记录已选择点  *切换月份使用
    var selected = [];

    //记录最后选择的值 *切换月份时使用    v1.0.2 删除domdate
    var lastSelected = "";


    //格式化成数组形式
    var toArray = function(value){
        if(!value) return "";
        switch(typeof(value)){
            case "number":
                var temp = new Date();
                temp.setTime(value);
                value = [temp.getFullYear(), temp.getMonth()+1, temp.getDate()];
                break;
            case "string":
                value = value.split("-");
                break;
            case "object":
                if(!$.isArray(value)){
                    if(value.getTime){
                        value = [value.getFullYear(), value.getMonth()+1, value.getDate()];
                    }else{
                        value = getDomVal(value);
                    }
                }
                break;
            case "function":
                value = value();
                return toArray(value);
        }
        if(value.length != 3 || !parseInt(value[0],10) || !parseInt(value[1],10) || !parseInt(value[2],10)) return "";
        return [parseInt(value[0],10), parseInt(value[1],10), parseInt(value[2],10)];
    }
    //o


    // 获取 Dom 值/内容 格式不正确返回空
    var getDomVal = function(obj){
        var value = $(obj).val();
        var html = $(obj).html();
        if(!value && html) value = html;
        value = regStr(value);
        if(value.length != 3 || !parseInt(value[0],10) || !parseInt(value[1],10) || !parseInt(value[2],10)) return "";
        return value;
    }
    //o


    //通过正则恢复字符串内容 v1.0.4
    var regStr = function(str){
        if(typeof(str) !== 'string') return ''; //v1.0.5
        var pos = [];
        var format = opts.format.date;
        if(format.search("Ｙ") != -1) pos[format.search("Ｙ")] = "Y";
        if(format.search("ｍ") != -1) pos[format.search("ｍ")] = "m";
        if(format.search("ｄ") != -1) pos[format.search("ｄ")] = "d";
        var regs = "/"+ format.replace(/[Ｙｍｄ]/g, "(\\S*)") +"/";
        var re = eval(regs);
        var data = str.match(re);
        if(data){
            //输出
            var date = [];
            var i = 1;
            for(x in pos){
                if(pos[x] == "Y") date[0] = parseInt( opts.str2year ? opts.str2year(data[i]) : parseInt(data[i],10) , 10);
                if(pos[x] == "m"){ date[1] = $.inArray(data[i], opts.month_str) + 1;}
                if(pos[x] == "d") date[2] = parseInt(data[i],10);
                i++;
            }
            return date;
        }else{
            return "";
        }
    }
    //o


    //将时间格式转成输出内容
    var date2str = function(date){
        date = toArray(date);
        if(date)
        {
            var string = opts.format.date;
            string = string.replace(/[Ｙ]/g, (opts.year2str ? opts.year2str(date[0]) : date[0]));
            string = string.replace(/[ｍ]/g, (opts.month_str[date[1]-1]));
            string = string.replace(/[ｄ]/g, date[2]);
            return string;
        }else{
            return "";
        }
    }
    //o


    // 根据时间，提供标准Date对象 ( 输入月份为 1 to 12 )
    var getDateObj = function(year, month, date){
        var temp = new Date();
        temp.setFullYear(parseInt(year,10), parseInt(month,10)-1, parseInt(date,10));
        temp.setHours(0,0,0,0);
        return temp;
    }
    //o


    //check date in date's area(areaObj)
    var inArea = function(year, month, day, areaObj){
        if(typeof(areaObj) == "function")
            areaObj = areaObj();
        for(x in areaObj){
            var start = typeof(areaObj[x])=="string" ? toArray(areaObj[x]) : toArray(areaObj[x][0]);
            start = getDateObj(start[0], start[1], start[2]);
            if(areaObj[x][1] === undefined || typeof(areaObj[x])=="string"){
                end = start;
            }else{
                var end = toArray(areaObj[x][1]);
                end = getDateObj(end[0], end[1], end[2]);
            }
            var now = getDateObj(year, month, day);

            if(start.getTime() <= now.getTime() && now.getTime() <= end.getTime())
                return true;
        }
        return false;
    }
    //o

    //检测是否构成时间段
    var isArea = function(year, month, day, area){
        var area = area ? area : opts.area;
        if(!area || (!area[0] && !area[1])) return;
        var start = toArray(area[0]);
        var end = toArray(area[1]);
        var sel = toArray(lastSelected);
        if(!start){ start = sel ? sel : end};
        if(!end){ end  = sel ? sel : start};

        if(!start && !end) return;
        start = getDateObj(start[0], start[1], start[2]);
        end = getDateObj(end[0], end[1], end[2]);

        if(start.getTime() > end.getTime()) return false;
        //检测该段是否能够形成区域
        if(!checkArea(start, end)) return false;
        //判断
        var now = getDateObj(year, month, day);

        return (start.getTime() <= now.getTime() && now.getTime() <= end.getTime());
    }
    //o


    //选择区间是否成立
    var checkArea = function(start, end){
        for(var i = start.getTime(); i <= end.getTime(); i = i+24*3600*1000){
            var temp = new Date();
            temp.setTime(i);
            if(inArea(temp.getFullYear(), temp.getMonth()+1, temp.getDate(), opts.disable))
                return false;
        }
        return true;
    };
    //o

    //v1.0.7 替换日期符号
    var dateReplace = function(year, month, day){
        switch(typeof(opts.replace)){
            case "object":
                if(opts.replace && opts.replace[year+"-"+month+"-"+day] !== undefined){
                    return opts.replace[year+"-"+month+"-"+day];
                }
                break;
            case "function":
                return opts.replace(year, month, day);
        }
        return day;
    }
    //o

    //初始化selected函数，对象转数组
    var initSelect = function(areaObj){
        for(x in areaObj){
            //起点
            var start = toArray(areaObj[x][0]);
            //终点
            if(areaObj[x][1] !== undefined){
                start = getDateObj(start[0], start[1], start[2]);
                var end = toArray(areaObj[x][1]);
                end = getDateObj(end[0], end[1], end[2]);
                for(var i=start.getTime(); i<=end.getTime(); i=i+24*3600*1000){
                    var t = toArray(i);
                    selected.unshift(t[0] + "-" + t[1] + "-" + t[2]);
                }
            }else{
                selected.unshift(start[0] + "-" + start[1] + "-" + start[2]);
            }
        }
    }
    //o


    //建立日历内容区
    var buildCalendar = function(obj){
        //定义日历dom
        if(!opts.use){
            var calendar = $(obj).next("."+opts.className);
        }else{
            var calendar = (opts.use === true) ? $("."+opts.className).eq(0) : $(opts.use).eq(0);
        }

        //获取已填日期
        var date = getDomVal(obj);

        if(!date || opts.selected){  //v1.0.5
            initSelect($.extend( {}, opts.selected ));
            date = new Date();
            lastSelected = null;
            date = new Array(date.getFullYear(), date.getMonth()+1, date.getDate());
        }else{
            lastSelected = date.join("-");
            initSelect($.extend( {0:{0:lastSelected}}, opts.selected )); //v1.0.2修正
        }

        //设定起始第一栏日期
        if(opts.startDate){
            var setStart = toArray(opts.startDate);
            if(setStart) date = setStart;
        }

        var year = date[0];
        var month = date[1];
        var day = date[2];

        //生成数据
        _build(obj, calendar, year, month);

        //设置宽度
        calendar.width($(obj).data("ic_width") * opts.showMonths);
        //设置位置
        var top = opts.pos.top == "bottom" ? (-calendar.outerHeight()-$(obj).outerHeight()) : parseInt(opts.pos.top ? opts.pos.top : 0 );
        var left = opts.pos.left == "right" ? (-calendar.outerWidth()+$(obj).outerWidth()) : parseInt(opts.pos.left ? opts.pos.left : 0);
        calendar.css({
            top : parseInt($(obj).position().top + $(obj).outerHeight() + top) + "px",
            left : parseInt($(obj).position().left + left) + "px"
        });
        //层
        calendar.css("z-index", new Date().getTime().toString().slice(-7,-3));

        //关闭其他dom
        if(opts.symbiont == false) $("."+opts.className).hide();
        if(opts.show !== false) calendar.show();

        $(obj).blur(function(){
            if( !calendar.data("foc") ) calendar.hide();
        });
	};
    //over


    //填充日历，并添加事件   v1.0.2
    var _build = function(obj, calendar, year, month){

        calendar.html("");
        for(var i = 1; i<=opts.showMonths; i++){
            if(month+i-1 > 12){ year++; month = month - 12;}
            var main = getDate(year, month+i-1);
            var prev = i==1 ? "<a href=\"javascript:;\">&lt;</a>" : '<span class="empty">&nbsp;</span>';
            var next = i==opts.showMonths ? "<a href=\"javascript:;\">&gt;</a>" : '<span class="empty">&nbsp;</span>';
            // 不解，year和(month+i-1)就可以获取时间了 - -|| -feng
            // 鄙视 = =|| 看案例14-2 -page7
            var title = opts.format.month;
            title = title.replace(/[Ｙ]/g, "<a href=\"javascript:;\">"+(opts.year2str ? opts.year2str(year) : year)+"</a>");
            title = title.replace(/[ｍ]/g, "<a href=\"javascript:;\">"+(opts.month_str[month+i-2])+"</a>");
            calendar.append("<dl><dt>"+prev+"<span id=\"ic_"+year+"-"+(month+i-1)+"\">"+title+"</span>"+next+"</dt><dd>"+main+"</dd></dl>");
        }
        if(opts.closeButton) calendar.append('<dl class="close"><a href="javascript:;">x</a></dl>');

        addEvent(obj, calendar);

        //prev month
        calendar.find("dt a:first").unbind("click").click(function(){
            goMonth(-1, obj, calendar);
            addEvent(obj, calendar);
            $(obj).focus();
        });

        //next month
        calendar.find("dt a:last").unbind("click").click(function(){
            goMonth(1, obj, calendar);
            addEvent(obj, calendar);
            $(obj).focus();
        });
    }
    //o


    // 事件委派
    var addEvent = function(obj, calendar){
        //不自动关闭
        calendar.find("span,a").mouseout(function(){ calendar.data("foc", opts.symbiont ? true : false); });
        calendar.find("span,a").mouseover(function(){ calendar.data("foc", true); });
        if(opts.symbiont) calendar.data("foc", true);

        //any other
        calendar.find("span").click(function(){$(obj).focus();});  //v1.01

        //change month -feng
        calendar.find("dt > span > a:last-child").unbind("click").click("click", function(){   //v2.0
            monthList(calendar, obj, $(this).parent());
        });

        //change year -feng
        calendar.find("dt > span > a:first-child").unbind("click").bind("click", function(){  //v2.0
            yearList(calendar, obj, $(this).parent());
            //触发对象由span 改成 span下的 a ，即年的位置
        });


        //close
        calendar.find(".close > a").click(function(){
            calendar.hide();
            $.fn.icalendar.callback("close", {date:"", dateobj:"", obj:obj, calendar:calendar, a:calendar.find("selected").get()});
        });


        //return
        calendar.find("dd > :not(.close) > a").unbind("click").click(function(){
            var select = true;
            if( $.isEmptyObject(opts.selected) && opts.selected !== true ) {
                calendar.find(".selected").removeClass("selected");
                select = false;
            }
            $(this).toggleClass("selected");

            var date = $(this).closest("dl").find("dt > span:not(.empty)").attr("id").substr(3) + "-" + $(this).html();
            var dateobj = toArray(date);
            dateobj = getDateObj(dateobj[0], dateobj[1], dateobj[2]);
            date = date2str(date);

            // v1.0.2
            lastSelected = $(this).is(".selected") ? date : null;
            if(select) {
                if($(this).is(".selected")){
                    selected.unshift(date);
                }else{
                    selected = $.map(selected, function(n){
                        return n != date ? n : null;
                    });
                }
            }else{
                selected = new Array(date);
            }

            //focus
            $(obj).focus();

            if($.isEmptyObject(opts.area)){
                $.fn.icalendar.onReturn(date, dateobj, obj, calendar, this, selected);
            }else{
                if(!opts.area[0]) {
                    var newArea = {0:date, 1:opts.area[1]};
                    changeArea("start", newArea, date, dateobj, obj, calendar, this);
                }else{
                    var newArea = {0:opts.area[0], 1:date};
                    changeArea("end", newArea, date, dateobj, obj, calendar, this);
                }
            }

        });
    }
    //over


    //生成年份列表
    var yearList = function(calendar, obj, but){
        var year = $(but).attr("id").substr(3).split('-');
        year = parseInt(year[0], 10);
        var dl = $(but).closest("dl");
        var nowstart = Math.floor((year - 4)/12) * 12 + 4;
        var nowend = nowstart + 12;
        var nowi = dl.prevAll("dl").length;
        gotoYear(calendar, obj, nowstart, nowend, nowi);

        //prev year
        calendar.find("dt > a:eq(0)").unbind("click").click(function(){
            var year = $(this).closest("dt").find("span:not(.empty)").attr("id").substr(3).split('-');
            start = parseInt(year[0], 10) - 12;
            gotoYear(calendar, obj, start, start+12, 0);
            $(obj).focus();
        });

        //next year
        calendar.find("dt > a:eq(1)").unbind("click").click(function(){
            var year = $(this).closest("dt").find("span:not(.empty)").attr("id").substr(3).split('-');
            start = parseInt(year[0], 10) + 12;
            gotoYear(calendar, obj, start, start+12, calendar.children("dl:not(.close)").length-1);
            $(obj).focus();
        });
    }
    //o


    //年份跳转
    var gotoYear = function(calendar, obj, nstart, nend, n){
        calendar.children("dl").each(function(i){
            var start = (nstart+(i-n)*12);
            var end = (nend+(i-n)*12)-1;
            var title = opts.format.year.replace(/[Ｙ]/g, (opts.year2str ? opts.year2str(start) : start)) +
                         "-" + opts.format.year.replace(/[Ｙ]/g, (opts.year2str ? opts.year2str(end) : end));
            $(this).find("dt > span:not(.empty)").attr("id", "ic_"+start+"-"+end).html( title );
            var main = '';
            for(var j = start; j <= end; j++){
                title = opts.format.year.replace(/[Ｙ]/g, (opts.year2str ? opts.year2str(j) : j));
                main += '<span class="year"><a id="ic_'+j+'" href="javascript:;">'+title+'</a></span>';
            }
            $(this).find("dd").html(main);
        });

        calendar.find("span,a").mouseout(function(){ calendar.data("foc", opts.symbiont ? true : false); });
        calendar.find("span,a").mouseover(function(){ calendar.data("foc", true); });
        if(opts.symbiont) calendar.data("foc", true);

        calendar.find("dd > :not(.close) > a").unbind("click").click(function(){
            var year = parseInt($(this).attr("id").substr(3), 10);
            var month = 6;
            _build(obj, calendar, year, month);
            $(obj).focus();
        });
    }
    //o


    //生成月份份列表 -feng  v2.0
    var monthList = function(calendar, obj, but){
        var date = $(but).attr("id").substr(3).split('-');
        var year = parseInt(date[0], 10);
        var dl = $(but).closest("dl");
        var nowi = dl.prevAll("dl").length;
        gotoMonth(calendar, obj, year, nowi);

        //prev year
        calendar.find("dt > a:eq(0)").unbind("click").click(function(){
            var year = parseInt($(this).closest("dt").find("span:not(.empty)").attr("id").substr(3), 10) - 1;
            if(year <= 0){ year = 1; }
            gotoMonth(calendar, obj, year, nowi);
            $(obj).focus();
        });

        //next year
        calendar.find("dt > a:eq(1)").unbind("click").click(function(){
            var year = parseInt($(this).closest("dt").find("span:not(.empty)").attr("id").substr(3), 10) + 1;
            gotoMonth(calendar, obj, year, nowi);
            $(obj).focus();
        });
    }
    //o


    //月份跳转 -feng v2.0
    var gotoMonth = function(calendar, obj, nowyear, n){
        calendar.children("dl").each(function(i){
            nowyear += i;
            var start = 1;
            var end = 12;
            var title = opts.format.year.replace(/[Ｙ]/g, "<a href=\"javascript:;\">"+(opts.year2str ? opts.year2str(nowyear) : nowyear)+"</a>"); // -page v2.0.1
            $(this).find("dt span:not(.empty)").attr("id", "ic_"+nowyear).html( title );
            var main = '';
            for(var j = start; j <= end; j++){
                var mstr = opts.format.onlymonth.replace(/[ｍ]/g, opts.month_str[j-1]);
                main += '<span class="month"><a id="ic_'+j+'" href="javascript:;">'+mstr+'</a></span>';
            }
            $(this).find("dd").html(main);
        });

        //change year
        calendar.find("dt > span > a:first-child").unbind("click").bind("click", function(){
            yearList(calendar, obj, $(this).parent());
        });

        calendar.find("span,a").mouseout(function(){ calendar.data("foc", opts.symbiont ? true : false); });
        calendar.find("span,a").mouseover(function(){ calendar.data("foc", true); });
        if(opts.symbiont) calendar.data("foc", true);

        calendar.find("dd :not(.close) a").unbind("click").click(function(){
            var year = parseInt($(this).closest("dl").find("dt span:not(.empty)").attr("id").substr(3), 10);
            var month = parseInt($(this).attr("id").substr(3), 10);
            _build(obj, calendar, year, month);
            $(obj).focus();
        });
    }
    //o


    // 生成单月份日期列表
    var getDate = function(year, month){
        //获取当月1日
        var temp = getDateObj(year, month, 1);
        var day = temp.getDay();
        //添加星期
        var main = '<div>';
        for(var i=0; i<=6; i++)
            main += '<span class="week'+i+'">'+opts.day_str[i]+'</span>';
        main += '</div>';
        for(var i=1; i<=day; i++){
            var week = i % 7;
            main += '<span class="empty week'+week+'"><span>&nbsp;</span></span>';
        }
        //获取月份天数
        var days = 0;
        if((month<=7 && (month%2==1)) || (month>7 && (month%2==0))){
            days=31;
        }else{
            if(month==2 && year%4==0){ days=29 }else if(month==2){ days=28 }else{ days=30; }
        }
        //读取当前时间
        for(var i=1; i<=days; i++)
        {
            var dis =  inArea(year, month, i, opts.disable);
            var cla = "week" + ((day + i -1) % 7);
            cla +=  inArea(year, month, i, selected) ? ' selected' : '';
            cla +=  dis ?  ' disable' : '';
            cla +=  isArea(year, month, i) ? ' area' : '';
            cla = 'class="'+cla+'"';
            var str = dateReplace(year, month, i);
            if(opts.readonly || dis)
                main += '<span class="day"><span '+cla+'>'+str+'</span></span>';
            else
                main += '<span class="day"><a '+cla+' href="javascript:;">'+str+'</a></span>';
        }
        //if(((day+days)%7) != 0)
        for(var i=1; i<=7-((day+days)%7); i++)
            main += '<span class="empty"><span>&nbsp;</span></span>';
        return main;
    }
    //o


    //月份翻页 v1.0.3 优化代码
    var goMonth = function(num, obj, calendar){
        var date = calendar.find("dl:eq(0) dt span:not(.empty)").attr("id").substr(3).split("-");
        var year = parseInt(date[0], 10);
        var month = parseInt(date[1], 10);
        var temp = getDateObj(year, month, 1);
        if( month + num < 1 ){  // v1.0.3
            year = year - Math.ceil((month + num)/12) - 1;
            month = 12 + (month + num);
        }else if(month + num > 12){
            year  =  year + Math.ceil((month + num)/12) - 1;
            month = (month + num)-12;
        }else{
            month = month + num;
        }
        _build(obj, calendar, year, month);
    }
    //over


    //选择区域使用的函数
    var changeArea = function(type, newArea, date, dateObj, obj, calendar, a){
        newArea[0] = toArray(newArea[0]);
        newArea[1] = toArray(newArea[1]);
        //初始日期值为空
        if((type == 'end' && newArea[0] == '') || (type == 'start' && newArea[1] == '')){
            calendar.find(".area").removeClass("area");
            $(a).addClass("area");
            $.fn.icalendar.onReturn(date, dateObj, obj, calendar, a, selected);
            return;
        }
        //都为空
        if(!newArea[1] || !newArea[0] || (newArea[0] == newArea[1] && newArea[0] != '')) return;
        //当前时间是否在原时间段内
        if(!isArea(dateObj.getFullYear(), dateObj.getMonth()+1, dateObj.getDate(), newArea)){
            $(a).removeClass("selected");
            calendar.find(".area").last().addClass("selected");
            $.fn.icalendar.callback("changeError", {date:date, dateobj:dateObj, obj:obj, calendar:calendar, a:a});
            //不在时间段内，根据给定的设置，判断是否清空其数据 v1.0.2
            for(var i=0; i<=1; i++){
                if(opts.area[i] !== undefined && opts.area[i] && opts.area[i].get && opts.area[i].get()){
                    opts.area[i].val('');
                    calendar.find(".selected").removeClass("selected");
                    calendar.find(".area").removeClass("area");
                    $(a).addClass("selected area");
                    $.fn.icalendar.onReturn(date, dateObj, obj, calendar, a, selected);
                }
            }
        }else{
            calendar.find(".selected").removeClass("selected");
            $(a).addClass("selected area");
            var dl = $(a).closest("dl");
            if(type == 'end'){
                dl.nextAll("dl").find(".area").removeClass("area");
                dl.prev("dl").find("span:has(.area)").eq(0).nextAll().children("a").addClass("area");
                $(a).parent().nextAll(":has(.area)").children("a").removeClass("area");
                if(newArea[0].join("-") != date) $(a).parent().prevUntil(":has(.area)").children("a").addClass("area");
            }else{
                dl.prevAll("dl").find(".area").removeClass("area");
                dl.next("dl").find("span:has(.area)").eq(0).prevAll(a).children("a").addClass("area");
                $(a).parent().prevAll(":has(.area)").children("a").removeClass("area");
                if(newArea[1].join("-") != date) $(a).parent().nextUntil(":has(.area)").children("a").addClass("area");
            }
            $.fn.icalendar.onReturn(date, dateObj, obj, calendar, a, selected);
        }
    }
    //over




    //初始化函数
    var _initialize = function(d){
        if(!opts.use){
            $(d).next("."+opts.className).remove();
            $(d).after('<div class="'+opts.className+'"></div>');//外层dl换为div -feng  v2.0
            var c = $(d).next("."+opts.className);
            $(d).data("ic_width", c.width());
        }

        //v2.0.1 向下兼容 -page7
        if(options !== undefined && options.format !== undefined)
            opts.format = $.extend({}, $.fn.icalendar.defaults.format, options.format);

    }
    //over


    //init obj
    return this.each(function(){

        _initialize(this);

        if(opts.show == true) buildCalendar(this);

        //v1.0.5 增加无事件触发
        if(opts.event) $(this).unbind(opts.event).bind(opts.event, function(){ buildCalendar(this); });

        return this;
    });

};

//v1.0.5 修正：移出函数外...

//常规返回函数
$.fn.icalendar.onReturn = function(date, dateObj, obj, calendar, a, selected){
    $(obj).val(date);
    $.fn.icalendar.callback("return", {date:date, dateobj:dateObj, obj:obj, calendar:calendar, a:a});
}
//over


//回调函数
$.fn.icalendar.callback = function(type, arg){ }



})(jQuery);