<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEMO - icalendar - a Jquery plugin that easy to develop and use.</title>
<meta name="keywords" content="ICalendar,jQuery插件,JS日历,Calendar" />
<meta name="description" content="ICalendar Plug-in for jQuery | 一款便捷开发的日历jQuery插件，具有较高的开发自由度，提供完整的解决方案。" />
<meta name="generator" content="Jquery" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="./icalendar_min.js"></script>
<link type="text/css" rel="stylesheet" href="./icalendar.css" />

<style type="text/css">
body{font-size:12px;}
textarea{border:none; border-bottom:#666 dashed 1px; font-size:12px; width:400px; height:200px; color:#666;}
dt{font-size:12px; font-weight:bold;}
</style>
</head>

<body>

<h2><a name="demo">DEMO</a></h2>
<h3>Style:</h3>
<textarea style="width:100%; height:450px;">
.icalendar{ position:absolute; width:210px; z-index:9998; display:none; background:#FFF; border:#999 solid 1px; overflow:hidden; margin:1px 0px;}
.icalendar dl{ width:208px; margin:0px; padding:1px; display:block; float:left;}
.icalendar dl dt{ width:100%; height:25px; line-height:25px; background:#EEE; font-size:0px; word-spacing:0px; text-align:center; vertical-align:top; }
.icalendar dl dt a,.icalendar dl dt .empty{ display:inline-block; width:10%; text-decoration:none; font-size:11px; color:#333; }
.icalendar dl dt a:hover{ background:#CCC; color:#FFF; }
.icalendar dl dt span{ display:inline-block; width:80%; font-size:12px; cursor:pointer; }
.icalendar dl dt span a{ display:inline; width:auto; font-size:12px; font-weight:bold; color:#333; margin:0px 2px; text-decoration:underline; }
.icalendar dl dt span a:hover{ background:none; color:#F05400; }
.icalendar dd { width:100%; margin:0px; padding:0px; font-size:0px; word-spacing:-11px; text-align:left; vertical-align:top; text-align:center;}
.icalendar dd div{background:#FAFAFA;}
.icalendar dd div span,
.icalendar dd span{ display:inline-block; width:14%; height:25px; line-height:25px; font-size:12px; word-spacing:normal; text-align:center; color:#666; vertical-align:top; }
.icalendar dd span a, .icalendar dd span span{ display:inline-block; width:100%; line-height:25px; text-decoration:none; color:#666;}
.icalendar dd span a:hover{color:#F05400; background:#FFDFBF;}
.icalendar dd span .selected{background:#FFFF66;}
.icalendar dd span .disable{color:#BBB; background:#EEE;}
.icalendar dd span .area{color:#F05400; background:#FFDFBF;}
.icalendar dd .month,
.icalendar dd .year {width:25%; height:50px; }
.icalendar dd .month a,
.icalendar dd .year a{width:100%; height:50px; line-height:50px; overflow:hidden;}
.icalendar dd .week0 {color:#FF4400; }
.icalendar dd .week6 {color:#88CC00; }
.icalendar .close { display:block; font-size:10px; text-align:right; background:#EEE; width:100%; }
.icalendar .close a{ display:inline-block; line-height:14px; width:14px; margin-right:5px; text-align:center; text-decoration:none; color:#333;}
.icalendar .close a:hover{ background:#CCC;}
</textarea><br />


<h3>1. 简单应用：</h3>
<input class="time" value=""><br />
<h5>代 码：</h5>
<textarea>$(".time").icalendar();</textarea><br />
<script type="text/javascript">
    $(".time").icalendar();
</script>


<h3>2. 多选应用：</h3>
<input class="time2" value=""><br />
<h5>代 码：</h5>
<textarea>$(".time2").icalendar({showMonths:1, selected:true});</textarea><br />
<script type="text/javascript">
    $(".time2").icalendar({showMonths:1, selected:true});
</script>





<h3>3-1. 禁用区域：</h3>
<input class="time3" value="<?=date('Y-n')?>-15"><br />
<h5>代 码：</h5>
<textarea>$(".time3").icalendar({
    disable:{
        0:{0:"<?=date('Y-n')?>-2",1:"<?=date('Y-n')?>-11"},
        1:{0:"<?=date('Y-n')?>-20",1:"<?=date('Y-n')?>-29"}
    }
});
</textarea><br />
<script type="text/javascript">
    $(".time3").icalendar({
        disable:{
            0:{0:"<?=date('Y-n')?>-2",1:"<?=date('Y-n')?>-11"},
            1:{0:"<?=date('Y-n')?>-20",1:"<?=date('Y-n')?>-29"}
        }
    });
</script>


<h3>3-2. 数组数据</h3>
<input class="time3_1" value="<?=date('Y-n')?>-15"><br />
<h5>代 码：</h5>
<textarea>$(".time3_1").icalendar({
    disable:[
        ["<?=date('Y-n')?>-2","<?=date('Y-n')?>-11"],
        ["<?=date('Y-n')?>-20","<?=date('Y-n')?>-29"]
    ]
});
</textarea><br /><br />
<script type="text/javascript">
$(".time3_1").icalendar({
    disable:[
        ["<?=date('Y-n')?>-2","<?=date('Y-n')?>-11"],
        ["<?=date('Y-n')?>-20","<?=date('Y-n')?>-29"]
    ]
});
</script>






<h3>4. 已选区域：</h3>
<input class="time4" value="<?=date('Y-n')?>-15"><br />
<h5>代 码：</h5>
<textarea>$(".time4").icalendar({
    selected:{
        0:{0:"<?=date('Y-n')?>-5",1:"<?=date('Y-n')?>-8"},
        1:{0:"<?=date('Y-n')?>-29"}
    }
});
</textarea><br />
<script type="text/javascript">
    $(".time4").icalendar({
        selected:{
            0:{0:"<?=date('Y-n')?>-5",1:"<?=date('Y-n')?>-8"},
            1:{0:"<?=date('Y-n')?>-29"}
        }
    });
</script>





<h3>5-1. 选区区域：<a name="f5"> </a></h3>
<input class="time5_1" value="<?=date('Y-n')?>-15"> -- <input class="time5_2" value="<?=date('Y-n')?>-23"><br />
<h5>代 码：</h5>
<textarea style="height:500px;">$(".time5_1").icalendar({
    showMonths:2,
    area:{
        0:'',
        1:$(".time5_2")
    },
    disable:{
        0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
    }
});

$(".time5_2").icalendar({
    showMonths:2,
    startDate:$(".time5_1"),
    area:{
        0:$(".time5_1"),
        1:''
    },
    disable:{
        0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
    }
});
</textarea><br /><br />
<script type="text/javascript">
$(".time5_1").icalendar({
    showMonths:2,
    area:{
        0:'',
        1:$(".time5_2")
    },
    disable:{
        0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
    }
});

$(".time5_2").icalendar({
    showMonths:2,
    startDate:$(".time5_1"),
    area:{
        0:$(".time5_1"),
        1:''
    },
    disable:{
        0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
    }
});
</script>





<h3>5-2. 动态选区</h3>
<input class="time5_3" value="<?=date('Y-n')?>-2"> -- <input class="time5_4" value="<?=date('Y-n')?>-5"><br /><br />
<input class="time5_3" value="<?=date('Y-n')?>-9"> -- <input class="time5_4" value="<?=date('Y-n')?>-12"><br /><br />
<input class="time5_3" value="<?=date('Y-n')?>-29"> -- <input class="time5_4" value="<?=date('Y')?>-<?=(date('n')+1)?>-3"><br /><br />
<input class="time5_3" value="<?=date('Y')?>-<?=(date('n')+1)?>-11"> -- <input class="time5_4" value="<?=date('Y')?>-<?=(date('n')+1)?>-23"><br /><br />
<h5>代 码：</h5>
<textarea style="height:700px;">function getDisable(start, end){
    var date = [];
    start.siblings(".time5_3").each(function(i){
        date[i] = [];
        date[i][0] = $(this).val();
        date[i][1] = $(this).nextAll(".time5_4").eq(0).val();
    });
    return date;
}

$(".time5_3").click(function(){
    $(this).icalendar({
        showMonths:2,
        show:true,
        area:{
            0:'',
            1:$(this).nextAll(".time5_4").eq(0)
        },
        disable:getDisable($(this), $(this).nextAll(".time5_4").eq(0))
    });
})

$(".time5_4").click(function(){
    $(this).icalendar({
        showMonths:2,
        startDate:$(this).prevAll(".time5_3").eq(0),
        show:true,
        area:{
            0:$(this).prevAll(".time5_3").eq(0),
            1:''
        },
        disable:getDisable($(this).prevAll(".time5_3").eq(0), $(this))
    });
})
</textarea><br />
<script type="text/javascript">
    function getDisable(start, end){
        var date = [];
        start.siblings(".time5_3").each(function(i){
            date[i] = [];
            date[i][0] = $(this).val();
            date[i][1] = $(this).nextAll(".time5_4").eq(0).val();
        });
        return date;
    }

    $(".time5_3").click(function(){
        $(this).icalendar({
            showMonths:2,
            show:true,
            area:{
                0:'',
                1:$(this).nextAll(".time5_4").eq(0)
            },
            disable:getDisable($(this), $(this).nextAll(".time5_4").eq(0))
        });
    })

    $(".time5_4").click(function(){
        $(this).icalendar({
            showMonths:2,
            startDate:$(this).prevAll(".time5_3").eq(0),
            show:true,
            area:{
                0:$(this).prevAll(".time5_3").eq(0),
                1:''
            },
            disable:getDisable($(this).prevAll(".time5_3").eq(0), $(this))
        });
    })

</script>









<h3>6. 事件触发：</h3>
<input class="time6" value="<?=date('Y-n')?>-15"> <input type="button" value="click me!" onclick="doicalendar()" /><br />
<h5>代 码：</h5>
<textarea>
function doicalendar(){
    var rand = Math.round(Math.random() * 28);
    $(".time6").icalendar({
        showMonths:1,
        selected:{0:{0:"<?=date('Y-n')?>-"+rand}},
        show:true
    });
    $(".time6").focus();
}
</textarea><br />
<script type="text/javascript">
function doicalendar(){
    var rand = Math.round(Math.random() * 28);
    $(".time6").icalendar({
        showMonths:1,
        selected:{0:{0:"<?=date('Y-n')?>-"+rand}},
        show:true
    });
    $(".time6").focus();
}
</script>




<h3>7. 位 置：</h3>
<input class="time7_1" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time7_1").icalendar({
    showMonths:1,
    pos:{top:"bottom", left:"right"}
});
</textarea><br />
<script type="text/javascript">
$(".time7_1").icalendar({showMonths:1, pos:{top:"bottom", left:"right"}});
</script>

<br />
<input class="time7_2" value="<?=date('Y-n')?>-15" ><br />
<textarea>
$(".time7_2").icalendar({
    showMonths:1,
    pos:{top:-300, left:200}
});
</textarea><br />
<script type="text/javascript">
$(".time7_2").icalendar({showMonths:1, pos:{top:-300, left:200}});
</script>





<h3>8. 关闭按钮：</h3>
<input class="time8" value="<?=date('Y-n')?>-15" >  <br />
<h5>代 码：</h5>
<textarea>
$(".time8").icalendar({
    showMonths:2,
    closeButton:true
});
</textarea><br />
<script type="text/javascript">
$(".time8").icalendar({showMonths:2, closeButton:true});
</script>






<h3>9. 窗口共存：</h3>
<input class="time9" value="<?=date('Y-n')?>-15" > --
<input class="time9" value="<?=date('Y-n')?>-15" > --
<input class="time9" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time9").icalendar({
    showMonths:1,
    symbiont:true
});
</textarea><br />
<script type="text/javascript">
$(".time9").icalendar({showMonths:1, symbiont:true});
</script>






<h3>10. 初始化即显示：</h3>
<input class="time10" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time10").icalendar({
    showMonths:1,
    show:true
});
</textarea><br />
<script type="text/javascript">
$(".time10").icalendar({showMonths:1, show:true});
</script>




<h3>11. 窗口触发事件不显示，但已初始化：</h3>
<input class="time11" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time11").icalendar({
    showMonths:1,
    show:false
});
</textarea><br />
<script type="text/javascript">
$(".time11").icalendar({showMonths:1, show:false});
</script>




<h3>12. 只读表</h3>
<input class="time12" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time12").icalendar({
    showMonths:1,
    readonly:true
});
</textarea><br />
<script type="text/javascript">
$(".time12").icalendar({showMonths:1, readonly:true});
</script>



<h3>13. 切换事件</h3>
<input class="time13" value="<?=date('Y-n')?>-15" ><br />
<h5>代 码：</h5>
<textarea>
$(".time13").icalendar({
    showMonths:1,
    event:"mouseover"
});
</textarea><br />
<script type="text/javascript">
$(".time13").icalendar({showMonths:1, event:"mouseover"});
</script>


<h3>14-1. 数据格式<a name="f14"> </a></h3>
<input class="time14_1" value="2011年10月28日" ><br />
<h5>代 码：</h5>
<textarea>
$(".time14_1").icalendar({
    format:{date:"Ｙ年ｍ月ｄ日", month:"Ｙ年ｍ月", year:"Ｙ年"}
});
//注意：这里是全角Ｙｍｄ
</textarea><br />
<script type="text/javascript">
$(".time14_1").icalendar({format:{date:"Ｙ年ｍ月ｄ日", month:"Ｙ年ｍ月", year:"Ｙ年"}});
</script>

<h3>14-2. 年份转换<a name="f14"> </a></h3>
<input class="time14_2" value="" ><br />
<h5>代 码：</h5>
<textarea style="height:400px;">
$(".time14_2").icalendar({
    format:{date:"Ｙ年ｍ月ｄ日", month:"Ｙ年ｍ月", year:"Ｙ年"},
    year2str : function(year){
        if(year - 1911 > 0){
            if(year == 1912) return "民國元";
            return '民國'+(year-1911);
        }else{
            return '民國前'+(1912-year);
        }
    },
    str2year : function(str){
        var n = str.match(/\d+/);
        if(str.match("前")){
            return 1912 - n;
        }else{
            if(!n) return 1912;
            return 1911 + n;
        }
    }
});
</textarea><br />
<script type="text/javascript">
$(".time14_2").icalendar({
    format:{date:"Ｙ年ｍ月ｄ日", month:"Ｙ年ｍ月", year:"Ｙ年"},
    year2str : function(year){
        if(year - 1911 > 0){
            if(year == 1912) return "民國元";
            return '民國'+(year-1911);
        }else{
            return '民國前'+(1912-year);
        }
    },
    str2year : function(str){
        var n = parseInt(str.match(/\d+/), 10);
        if(str.match("前")){
            return 1912 - n;
        }else{
            if(!n) return 1912;
            return 1911 + n;
        }
    }
});
</script>



<h3>15. 综合案例<a name="f15"> </a></h3>
<a href="./demo15.html">点击这里查看</a><br />
<textarea readonly="readonly" style="height:10px;"></textarea>


<h3>16. 日期替换<a name="f16"> </a></h3>
<input class="time16" value="" ><br />
<h5>代 码：</h5>
<textarea style="height:400px;">
$(".time16").icalendar({
    replace:{'<?=date('Y-n-j')?>':'今'}
});
</textarea><br />
<script type="text/javascript">
$(".time16").icalendar({
    replace:{'<?=date('Y-n-j')?>':'今'}
});
</script>
<br />
<hr />


</body>
</html>
