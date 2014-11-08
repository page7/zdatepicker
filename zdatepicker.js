/*!
 * zdatepicker (a smaller and easier datepicker of jquery plugin.)
 * http://www.nolanchou.com/zdatepicker
 * https://github.com/page7/zdatepicker
 *
 * Dual licensed under the MIT licenses.
 * http://jquery.org/license
 *
 * Version:3.2.0
 * Date:2014-11
 */

;(function ($) {

$.fn.zdatepicker = function(options) {

	var _init = false;

	var opts = $.extend({}, $.fn.zdatepicker.defaults, options);

	// record input's values
	var selected = [];

	// record last select
	var lastSelected = "";

	// record view mode
	var view = [];

	// record last view click data
	var viewChange = [];

	// record all calendar
	var _calendars = [];


	// format to a date string's array.
	var toArray = function(value) {

		if(!value) return [];

		switch(typeof(value)) {
			case "number":
				var temp = new Date();
				temp.setTime(value);
				value = [temp.getFullYear(), temp.getMonth()+1, temp.getDate()];
				break;

			case "string":
				var value = value.split("-");
				for(var x in value) {
					value[x] = parseInt(value[x], 10);
					if(!value[x]) return [];
				}
				break;

			case "object":
				if(!$.isArray(value)) {
					if(value.getTime !== undefined) {
						value = [value.getFullYear(), value.getMonth()+1, value.getDate()];
					}else{
						value = getDomVal(value);
					}
				}
				break;

			case "function":
				value = value();
				value = toArray(value);
				break;
		};
		return value;
	};



	// Get dom value or content
	var getDomVal = function(dom) {
		var obj = $(dom);
		if(!obj.is("input"))
			var value = obj.text();
		else
			var value = obj.val();
		return regStr(value);
	};



	// Use regular to get value in string
	var regStr = function(str) {
		if(typeof(str) !== 'string') return [];
		var pos = [];
		var format = opts.format.date;
		pos[format.search("yyyy")] = "y";
		pos[format.search("mm")] = "m";
		pos[format.search("dd")] = "d";
		var regs = format.replace(/yyyy/, "(\\S*)").replace(/mm/, "(\\S*)").replace(/dd/, "(\\S*)"); //console.log(regs);
		var re = new RegExp(regs);
		var data = str.match(re);
		if(data){
			var date = [];
			var i = 1;
			for(var x in pos){
				switch(pos[x]){
					case "y":
						date[0] = parseInt( (opts.str2year ? opts.str2year(data[i]) : parseInt(data[i], 10)), 10);
						break;
					case "m":
						date[1] = $.inArray(data[i], opts.monthstr) + 1;
						// support number only
						if(date[1] == 0) date[1] = $.inArray("0"+data[i], opts.monthstr) + 1;
						if(date[1] == 0) return [];
						break;
					case "d":
						date[2] = parseInt(data[i], 10);
						break;
				}
				i++;
			}
			return date;
		}else{
			return [];
		}
	};


	// Get a Date object
	var getDateObj = function(arr) {
		var temp = new Date();
		temp.setFullYear(parseInt(arr[0],10), parseInt(arr[1],10)-1, parseInt(arr[2],10));
		temp.setHours(0,0,0,0);
		return temp;
	};



	// Check a date is in date ranges (rangeObj is array or obj)
	var inRange = function(year, month, day, rangeObj) {

		if(typeof(rangeObj) == "function")
			rangeObj = rangeObj();

		for(var x in rangeObj) {
			var start = typeof(rangeObj[x]) == "string" ? toArray(rangeObj[x]) : toArray(rangeObj[x][0]);
			if(!start.length) return false;

			start = getDateObj(start);
			if(typeof(rangeObj[x])=="string" || rangeObj[x][1] === undefined) {
				end = start;
			}else{
				var end = toArray(rangeObj[x][1]);
				if(!end.length) return false;

				end = getDateObj(end);
			}
			var now = getDateObj([year, month, day]);

			if(start.getTime() <= now.getTime() && now.getTime() <= end.getTime())
				return true;
		}

		return false;
	};



	// Check out a date is in AREA ( a date range of option:area or user change )
	// One zdatepicker only have one AREA.
	// Generally, AREA is made up of this input's value and the other input's value.
	var isArea = function(year, month, day, area) {
		var area = area ? area : opts.area;
		if(!area || (!area[0] && !area[1])) return false;

		var start = toArray(area[0]);
		var end = toArray(area[1]);
		var sel = toArray(lastSelected);
		if(!start.length) { start = sel ? sel : end };
		if(!end.length) { end  = sel ? sel : start };

		if(!start.length || !end.length) return false;

		start = getDateObj(start);
		end = getDateObj(end);

		if(start.getTime() > end.getTime()) return false;

		if(!checkArea(start, end)) return false;

		var now = getDateObj([year, month, day]);

		return (start.getTime() <= now.getTime() && now.getTime() <= end.getTime());
	};



	// Check out two dates that can make up a date range
	// If any date that be disabled in this a date range, return false
	var checkArea = function(start, end) {
		for(var i = start.getTime(); i <= end.getTime(); i = i+24*3600*1000) {
			var temp = new Date();
			temp.setTime(i);
			if(inRange(temp.getFullYear(), temp.getMonth()+1, temp.getDate(), opts.disable))
				return false;
		}
		return true;
	};


	// Replace the date view string.
	var dateReplace = function(year, month, day) {
		switch(typeof(opts.replace)) {
			case "object":
				var key = _format('date', [year, month, day]);
				if(opts.replace && opts.replace[key] !== undefined) {
					return opts.replace[key];
				}
				break;
			case "function":
				return opts.replace(year, month, day);
		}
		return day;
	};


	// init option:selected value
	var initSelect = function(rangeObj) {
		for(var x in rangeObj) {

			var start = toArray(rangeObj[x][0]);
			if(!start.length) continue;

			if(rangeObj[x][1] !== undefined) {
				start = getDateObj(start);
				var end = toArray(rangeObj[x][1]);
				if(!end.length) continue;

				end = getDateObj(end);
				for(var i = start.getTime(); i <= end.getTime(); i = i+24*3600*1000) {
					var t = toArray(i);
					selected.unshift(t[0] + "-" + t[1] + "-" + t[2]);
				}
			}else{
				selected.unshift(start[0] + "-" + start[1] + "-" + start[2]);
			}
		}
	};


	// init zdatepicker
	var buildCalendar = function(obj) {
		var input = $(obj);

		// use a existing dom or create one ?
		if(!opts.use) {
			var calendar = input.next("."+opts.classname);
		}else{
			var calendar = (opts.use === true) ? $("."+opts.classname).eq(0) : $(opts.use).eq(0);
		}
		_calendars.push(calendar);

		// get dom value
		var date = getDomVal(obj);

		if(!date.length || opts.selected) {
			initSelect($.extend( {}, opts.selected ));
			date = new Date();
			lastSelected = null;
			date = [date.getFullYear(), date.getMonth()+1, date.getDate()];
		}else{
			lastSelected = date.join("-");
			initSelect($.extend( {0:{0:lastSelected}}, opts.selected ));
		}

		// set a month for display.
		if(opts.initmonth) {
			var setStart = toArray(opts.initmonth);
			if(setStart.length) date = setStart;
		}

		var year = date[0];
		var month = date[1];

		// fill content
		_build(obj, calendar, year, month, 'date');

		// set width
		calendar.width(input.data("zdatepicker_width") * opts.viewmonths);
		// set position
		var _outHeight = input.outerHeight();
		var _outWidth = input.outerWidth();
		var top = opts.pos.top == "bottom" ? (-calendar.outerHeight()-_outHeight) : parseInt(opts.pos.top ? opts.pos.top : 0 );
		var left = opts.pos.left == "right" ? (-calendar.outerWidth()+_outWidth) : parseInt(opts.pos.left ? opts.pos.left : 0 );
		calendar.css({
			top : parseInt(input.position().top + _outHeight + top) + "px",
			left : parseInt(input.position().left + left) + "px"
		});
		// set z-index
		calendar.css("z-index", new Date().getTime().toString().slice(-7,-3));

		if(opts.symbiont) $(_calendars).hide();	// close other zdatepickers
		if(opts.show !== false) calendar.show();	// not need any event to show it

		input.blur(function(){
			if( !calendar.data("foc") ) calendar.hide();
		});

		input.bind(opts.event, function(){
			var date = getDomVal(obj);
			if(date.length && !opts.selected){
				lastSelected = date.join("-");
				initSelect($.extend( {0:{0:lastSelected}}, opts.selected ));
				_build(obj, calendar, date[0], date[1], 'date');
			}
			calendar.show();
		});
	};


	// Format data to a string
	// mode : date, month, year, onlymonth
	// data : [year, month, date], [year, month], year, month
	var _format = function(mode, data) {
		switch(mode) {
			case 'date':
				var string = opts.format.date;
					string = string.replace(/yyyy/, (opts.year2str ? opts.year2str(data[0]) : data[0]));
					string = string.replace(/mm/, (opts.monthstr[data[1]-1]));
					string = string.replace(/dd/, (data[2] < 10 ? "0"+data[2] : data[2]));
				return string;
			case 'month':
				var string = opts.format.month;
					string = string.replace(/yyyy/, '<a class="year" id="zdatepicker_y_'+data[0]+'" href="javascript:;">'+(opts.year2str ? opts.year2str(data[0]) : data[0])+"</a>");
					string = string.replace(/mm/, '<a class="month" id="zdatepicker_m_'+data[1]+'" href="javascript:;">'+(opts.monthstr[data[1]-1])+"</a>");
				return string;
			case 'year':
				return opts.format.year.replace(/yyyy/, (opts.year2str ? opts.year2str(data) : data));
			case 'onlymonth':
				return opts.format.onlymonth.replace(/mm/, opts.monthstr[data-1]);
		}
	};


	// Fill content in zdatepicker
	var _build = function(obj, calendar, year, month, mode) {

		var _index = opts.viewmonths % 2 ? ((opts.viewmonths - 1) / 2) : (opts.viewmonths / 2 - 1);

		calendar.html("");
		for(var i = 1; i<=opts.viewmonths; i++) {

			var prev = i==1 ? '<a class="prev" href="javascript:;">'+opts.prevbtn+'</a>' : '<span class="empty">&nbsp;</span>';
			var next = i==opts.viewmonths ? '<a class="next" href="javascript:;">'+opts.nextbtn+'</a>' : '<span class="empty">&nbsp;</span>';

			// build date picker
			if(mode == 'date'){

				var _month = month + i - 1;
				if(_month > 12){ year++; _month = _month - 12; }
				var title = _format('month', [year, _month]);

				// get num of days in the month
				var days = 0;
				if((_month <= 7 && (_month % 2 == 1)) || (_month > 7 && (_month % 2 == 0))) {
					days=31;
				}else{
					if(_month == 2 && year % 4 == 0)
						days=29;
					else if(_month == 2)
						days=28;
					else
						days=30;
				}

				var main = _dateList(year, _month, days);

				if(i == 1) {
					view = ['date', year, _month];
					viewChange = [year, _month];
				}
			}
			// build month picker
			else if(mode == 'month') {
				var _year = (year + (i-_index-1));
				var title = '<a class="year" id="zdatepicker_y_'+_year+'" href="javascript:;">' + _format('year', _year) + '</a>';

				if(i == 1) {
					view = ['month', _year];
					if(view[0] != 'month') viewChange = [year, month];
				}

				var main = _monthList(_year, viewChange[0], viewChange[1]);
			}
			// build year picker
			else if(mode == 'year') {

				var dl_first = Math.floor(year/10) * 10;
				var dl_end = dl_first + 9;

				var _first = (dl_first + (i-_index-1) * 10);
				var _last = (dl_end + (i-_index-1) * 10);
				var title = _format('year', _first) + "-" + _format('year', _last);

				if(i == 1) {
					view = ['year', _first];
					if(view[0] != 'year') viewChange[0] = year;
				}

				var main = _yearList(_first, viewChange[0]);
			}

			calendar.append("<dl><dt>"+prev+'<span>'+title+"</span>"+next+"</dt><dd>"+main+"</dd></dl>");
		}
		if(opts.closebtn !== false) calendar.append('<dl class="close"><a href="javascript:;">'+(opts.closebtn === true ? '' : opts.closebtn)+'</a></dl>');

		addEvent(obj, calendar, mode);

		if(_init == true) $(obj).trigger("focus");
	};


	// Build date list
	var _dateList = function(year, month, days) {
		// get 1th in month
		var temp = getDateObj([year, month, 1]);
		var first = temp.getDay();
		var offset = opts.weekoffset;

		// build weekstr view
		var main = '<div>';
		for(var i=0; i<=6; i++) {
			var j = offset + i;
			if(j > 6) j = j - 7;
			main += '<span class="week'+j+'">'+opts.daystr[j]+'</span>';
		}
		main += '</div>';

		// build space
		var prevdays = offset > first ? (7-offset+first) : (first-offset)
		for(var i=0; i<prevdays; i++) {
			var week = (offset + i) % 7;
			main += '<span class="empty week'+week+'"><span>&nbsp;</span></span>';
		}

		for(var i=1; i<=days; i++) {
			var date = year + "-" + month + "-" + i;
			var id  = "zdatepicker_d_" + date;
			var week  = (first + i - 1) % 7;
			var cla =  [];
			cla.push("week" + week);
			if(inRange(year, month, i, selected)) cla.push('selected');
			if(inRange(year, month, i, opts.disable))  cla.push('disable');
			if(isArea(year, month, i)) cla.push('area');
			if(opts.onFilter) cla = opts.onFilter(i, month, year, week, cla);
			var classStr = 'class="'+cla.join(' ')+'"';
			var str = dateReplace(year, month, i);
			if(opts.readonly || $.inArray('disable', cla) >= 0)
				main += '<span id="' + id + '" class="day" data-date="' + date + '"><span ' + classStr + '>' + str + '</span></span>';
			else
				main += '<span id="' + id + '" class="day" data-date="' + date + '"><a ' + classStr + ' href="javascript:;">' + str + '</a></span>';
		}

		// build space
		for(var i=0; i<42-prevdays-days; i++)
			main += '<span class="empty"><span>&nbsp;</span></span>';

		return main;
	};



	// Build month list
	var _monthList = function(year, selyear, selmonth){
		var main = '';
		for(var i = 1; i <= 12; i ++) {
			cla = (year == selyear && i == selmonth) ? 'class="selected"' : '';
			main += '<span class="month"><a id="zdatepicker_d_' + year + '-' + i + '" data-month="' + year + '-' + i + '" ' + cla + ' href="javascript:;">' + _format('onlymonth', i) + '</a></span>';
		}
		return main;
	};



	// Build year list
	var _yearList = function(start, select){
		var main = cla = '';
		for(var i = start; i < start + 10; i++) {
			cla = i == select ? 'class="selected"' : '';
			main += '<span class="year"><a id="zdatepicker_d_' + i + '" data-year="'+i+'" ' + cla + ' href="javascript:;">' + _format('year', i) + '</a></span>';
		}
		return main;
	};


	// on Return
	var _return = function(date, dateObj, input, calendar, a, selected) {
		if(opts.onReturn) {
			opts.onReturn(date, dateObj, input, calendar, a, selected);
		}else {
			$(input).val(date);
			$.fn.zdatepicker.callback('return', {date:date, dateobj:dateObj, input:input, calendar:calendar, a:a, selected:selected});
		}
	};

	// Bind Event
	var addEvent = function(obj, calendar, mode) {
		// add event for record mouse over the calendar.
		calendar.find("span,a").mouseout(function(){ calendar.data("foc", opts.symbiont ? false : true); });
		calendar.find("span,a").mouseover(function(){ calendar.data("foc", true); });
		calendar.find("dd span").click(function(){ $(obj).trigger("focus"); });

		if(!opts.symbiont) calendar.data("foc", true);

		// select month
		calendar.find("dt .month").click("click", function(){
			_build(obj, calendar, view[1], view[2], 'month');
		});

		// select year
		calendar.find("dt .year").bind("click", function(){
			var year = parseInt($(this).data("year"), 10);
			_build(obj, calendar, view[1], 1, 'year');
		});

		// close
		calendar.find(".close > a").click(function(){
			calendar.hide();
			$.fn.zdatepicker.callback("close", {input:obj, calendar:calendar, a:this});
		});

		if(mode == 'date') {
			// prev month
			calendar.find("dt .prev").click(function(){
				var year = view[1];
				var month = view[2] - 1;
				if(month == 0) {
					year = year - 1;
					month = 12;
				}
				_build(obj, calendar, year, month, 'date');
				$.fn.zdatepicker.callback("prev_month", {year:year, month:month, input:obj, calendar:calendar, a:this});
			});

			// next month
			calendar.find("dt .next").click(function(){
				var year = view[1];
				var month = view[2] + 1;
				if(month > 12) {
					year = year + 1;
					month = 1;
				}
				_build(obj, calendar, year, month, 'date');
				$.fn.zdatepicker.callback("next_month", {year:year, month:month, input:obj, calendar:calendar, a:this});
			});

			// return
			calendar.find("dd > :not(.close) > a").click(function(){
				// isset selected ?
				var select = true;
				if( $.isEmptyObject(opts.selected) && opts.selected !== true ) {
					calendar.find(".selected").removeClass("selected");
					select = false;
				}

				// get date
				var date = $(this).parent().data("date");
				var datearr = toArray(date);
				var dateObj = getDateObj(datearr);
				date = _format('date', datearr);

				// refocus
				$(obj).trigger("focus");

				// Area
				if($.isEmptyObject(opts.area)) {
					$(this).toggleClass("selected");

					// change selected value
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

					lastSelected = $(this).is(".selected") ? date : null;

					_return(date, dateObj, obj, calendar, this, selected);
				}else{
					if(!opts.area[0]) {
						var newArea = {0:date, 1:opts.area[1]};
						changeArea("start", newArea, date, dateObj, obj, calendar, this, selected);
					}else{
						var newArea = {0:opts.area[0], 1:date};
						changeArea("end", newArea, date, dateObj, obj, calendar, this, selected);
					}
				}

			});
		}
		else if(mode == 'month') {
			// prev 1 year
			calendar.find("dt .prev").click(function(){
				var year = view[1] - 1;
				_build(obj, calendar, year, 1, 'month');
				$.fn.zdatepicker.callback("prev_year", {year:year, input:obj, calendar:calendar, a:this});
			});

			// next 1 year
			calendar.find("dt .next").click(function(){
				var year = view[1] + 1;
				_build(obj, calendar, year, 1, 'month');
				$.fn.zdatepicker.callback("next_year", {year:year, input:obj, calendar:calendar, a:this});
			});

			// goto this month
			calendar.find("dd > :not(.close) > a").click(function(){
				var _id = $(this).data("month").split("-");
				var year = parseInt(_id[0], 10);
				var month = parseInt(_id[1], 10);
				_build(obj, calendar, year, month, 'date');
				$.fn.zdatepicker.callback("select_month", {year:year, month:month, input:obj, calendar:calendar, a:this});
			});
		}
		else if(mode == 'year') {
			// prev 10 years
			calendar.find("dt .prev").click(function(){
				var year = view[1] - 10;
				_build(obj, calendar, year, 1, 'year');
				$.fn.zdatepicker.callback("prev_years", {year:year, input:obj, calendar:calendar, a:this});
			});

			// next 10 years
			calendar.find("dt .next").click(function(){
				var year = view[1] + 10;
				_build(obj, calendar, year, 1, 'year');
				$.fn.zdatepicker.callback("next_years", {year:year, input:obj, calendar:calendar, a:this});
			});

			// goto this year
			calendar.find("dd > :not(.close) > a").click(function(){
				var year = parseInt($(this).data("year"), 10);
				_build(obj, calendar, year, viewChange[1], 'date');
				$.fn.zdatepicker.callback("select_year", {year:year, input:obj, calendar:calendar, a:this});
			});

		}
	};



	// select a date and change AREA (if options.area is not empty).
	var changeArea = function(type, newArea, date, dateObj, obj, calendar, a, selected) {
		newArea[0] = toArray(newArea[0]);
		newArea[1] = toArray(newArea[1]);
		var newAreaJoin = [ newArea[0].join('-') , newArea[1].join('-') ];
		var a = $(a);

		// both are empty or same.
		if(!newAreaJoin[1] || !newAreaJoin[0] || (newAreaJoin[0] == newAreaJoin[1] && newAreaJoin[0] != '')) return;

		// one of option values is empty
		if((type == 'end' && newArea[0] == '') || (type == 'start' && newArea[1] == '')) {
			calendar.find(".area").removeClass("area");
			a.addClass("area selected");
			$.fn.zdatepicker.callback("area", {date:date, dateobj:dateObj, input:obj, calendar:calendar, a:a, area:newArea});
			_return(date, dateObj, obj, calendar, a, selected);
			return;
		}

		if(!isArea(dateObj.getFullYear(), dateObj.getMonth()+1, dateObj.getDate(), newArea)) {
			// If new date and the other can't be make up a new AREA.
			// remove AREA
			calendar.find(".area").removeClass("area");
			// callback
			$.fn.zdatepicker.callback("fail_to_area", {date:date, dateobj:dateObj, input:obj, calendar:calendar, a:a, area:newArea});
			return;

		}else{
			a.addClass("area");
			var days = calendar.find("dd .day");
			if(type == 'end') {
				var start = days.index(calendar.find(".day:has(.area):first"));
				var end = days.index(a.parent());
			}else{
				var start = days.index(a.parent());
				var end = days.index(calendar.find(".day:has(.area):last"));
			}

			if(start == end && newArea[0].join('-') != newArea[1].join('-')) {
				if(type == 'end') {
					start = days.index(calendar.find("#zdatepicker_d_"+newAreaJoin[0]));
					if(start == -1) {
						var _start = getDateObj(newArea[0]);
						var _first = getDateObj(calendar.find(".day:first").data("date").split('-'));
						if(_start.getTime() < _first.getTime())
							start = 0;
					}
				}else{
					end = days.index(calendar.find("#zdatepicker_d_"+newAreaJoin[1]));
					if(end == -1) {
						var _end = getDateObj(newArea[1]);
						var _last = getDateObj(calendar.find(".day:last").data("date").split('-'));
						if(_end.getTime() > _last.getTime())
							end = days.length - 1;
					}
				}
			}

			if(start > end) {
				a.removeClass("area");
				$.fn.zdatepicker.callback("fail_to_area", {date:date, dateobj:dateObj, input:obj, calendar:calendar, a:a, area:newArea});
				return;
			}

			days.slice(0, start).children("a").removeClass("area");
			days.slice(end+1).children("a").removeClass("area");
			days.slice(start, end).children("a").addClass("area");
			a.addClass("selected");

			$.fn.zdatepicker.callback("area", {date:date, dateobj:dateObj, input:obj, calendar:calendar, a:a, area:newArea});
			_return(date, dateObj, obj, calendar, a, selected);
		}
	};



	// init the dom for filling zdatepicker
	var _initialize = function(d){
		if(!opts.use){
			$(d).next("."+opts.classname).remove();
			$(d).after('<div class="'+opts.classname+'"></div>');
			var c = $(d).next("."+opts.classname);
			$(d).data("zdatepicker_width", c.width());
		}

		if(options !== undefined && options.format !== undefined)
			opts.format = $.extend({}, $.fn.zdatepicker.defaults.format, options.format);

	};



	//init obj
	return this.each(function(){

		_initialize(this);

		if(opts.show == true) buildCalendar(this);

		// option:event is empty
		if(opts.event) $(this).one(opts.event, function(e){ buildCalendar(this); });

		_init = true;
	});

};

$.fn.zdatepicker.defaults = {
	classname	: "zdatepicker",
	event		: "click",
	viewmonths	: 2,
	format		: {date:"yyyy-mm-dd",month:"yyyy mm",year:"yyyy",onlymonth:"mm"}, //only support: yyyy-2014, mm-monthstr, dd-01. 1 digital date / 2 digital year / week please use "onReturn" to format.
	daystr		: ["Sun","Mon","Tue","Wed","Thur","Fri","Sat"],
	monthstr	: ["01","02","03","04","05","06","07","08","09","10","11","12"],
	weekoffset	: 0,
	year2str	: null,
	str2year	: null,
	initmonth	: null,
	symbiont	: true,
	readonly	: false,
	disable		: {},	   // disable, area, selected must use 1970-1-1 or 1970-01-01 string format.
	area		: {},
	selected	: false,
	replace		: null,
	pos			: {},
	use			: false,  // use option must be a jquery selector string. eq : #id or .class ..
	show		: null,
	prevbtn		: "",
	nextbtn		: "",
	closebtn	: false,
	onFilter	: null,
	onReturn	: null
};

// Callback
$.fn.zdatepicker.callback = function(type, arg){ }

})(jQuery);