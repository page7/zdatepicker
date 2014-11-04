<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DOC &amp; DEMO - zdatepicker - a simple,light-weight datepicker plugin for jquery.</title>
    <meta name="keywords" content="zdatepicker,js,jquery,plugin,datepicker,calendar,NolanChou 周" />
    <meta name="description" content="zdatepicker - a simple,light-weight datepicker plugin for jquery." />
    <meta name="generator" content="Jquery" />

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./zdatepicker.js?v=3.1.9"></script>

    <style type="text/css">
    body{ font:12px/120% Helvetica, Geneva, Arial, sans-serif; padding:0px 30px; margin:0px; margin-left:250px; box-shadow:inset 5px 0px 5px #EEE; }
    a{ color:#0080FF; }
    a:hover{ color:#0063C6; }
    h1{ font-size:25px; color:#333; border-bottom:#CCC dashed 1px; margin:0px; padding:40px 0px; margin-bottom:0px; }
    h2{ font-size:18px; color:#555; padding:10px 0px; margin:30px 0px 20px 0px; }
    h4{ font-size:14px; color:#666; padding:0px; }
    h5{ font-size:12px; color:#666; padding:0px; margin:0px; }
    .demo{ padding:0px 10px 20px 10px; }
    .code{ background:#EEE; border:#CCC dashed 1px; padding:10px; padding-bottom:20px; margin-top:20px; }
    .code .syntaxhighlighter{ padding:15px 0px; background:#FFF; margin-bottom:0px!important; }
    input{ font:14px/120% Helvetica, Geneva, Arial, sans-serif; border:#999 solid 1px; border-radius:5px; padding:5px 10px; color:#666; }
    input:focus{ border:#0080FF solid 1px; box-shadow:inset 0px 0px 5px #999; outline:#0080FF; color:#333; }
    dl,dt,dd{ margin:0px; padding:0px; }
    ul{ margin-top:0px; }
    ul .note{ list-style:none; color:#999; margin-left:-20px; padding:5px 0px; }
    .directory{ position:fixed; top:0px; left:0px; padding:20px; width:200px; overflow:auto; }
    .directory h2{ margin:0px; }
    .directory ul{ padding-left:20px; }
    .directory ul li{ font-size:14px; line-height:20px; width:100%; }
    .directory ul li ul li{ font-size:12px; }
    .directory ul li b{ display:inline-block; color:#0080FF; width:10px; text-align:center; font-weight:normal; margin-right:2px; cursor:pointer; }
    .directory .new{ font-size:12px; line-height:100%; display:inline-block; padding:2px 5px; background:#E00; color:#FFF; margin-left:2px; margin-top:-5px; border-radius:5px 5px 5px 0px; }
    </style>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="http://agorbatchev.typepad.com/pub/sh/3_0_83/styles/shCore.css" rel="stylesheet" type="text/css" />
    <link href="http://agorbatchev.typepad.com/pub/sh/3_0_83/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="./zdatepicker.css?v=3.1.9" />
</head>

<body>

<div class="directory">
    <h2>Directory</h2>
    <ul>
        <li>
            <a href="#style">Style</a>
        </li>
        <li>
            <b>+</b><a href="#options">Options</a>
            <ul style="display:none;">
                <li><a href="#classname">classname</a></li>
                <li><a href="#event">event</a></li>
                <li><a href="#viewmonths">viewmonths</a></li>
                <li><a href="#format">format</a></li>
                <li><a href="#daystr">daystr</a></li>
                <li><a href="#monthstr">monthstr</a></li>
                <li><a href="#weekoffset">weekoffset</a></li>
                <li><a href="#year2str">year2str</a></li>
                <li><a href="#str2year">str2year</a></li>
                <li><a href="#initmonth">initmonth</a></li>
                <li><a href="#symbiont">symbiont</a></li>
                <li><a href="#readonly">readonly</a></li>
                <li><a href="#disable">disable</a></li>
                <li><a href="#area">area</a></li>
                <li><a href="#selected">selected</a></li>
                <li><a href="#replace">replace</a></li>
                <li><a href="#pos">pos</a></li>
                <li><a href="#use">use</a></li>
                <li><a href="#show">show</a></li>
                <li><a href="#prevbtn">prevbtn</a><em class="new">new</em></li>
                <li><a href="#nextbtn">nextbtn</a><em class="new">new</em></li>
                <li><a href="#closebtn">closebtn</a></li>
                <li><a href="#onFilter">onFilter</a><em class="new">new</em></li>
                <li><a href="#onReturn">onReturn</a></li>
            </ul>
        </li>
        <li>
            <b>+</b><a href="#callback">Callback</a>
            <ul style="display:none;">
                <li><a href="#type">parameter - type</a></li>
                <li><a href="#arg">parameter - arg</a></li>
            </ul>
        </li>
        <li>
            <b>-</b><a href="#demo">Demo</a>
            <ul>
                <li><a href="#demo_1-1">Simple</a></li>
                <li><a href="#demo_1-2">Show one month.</a></li>
                <li><a href="#demo_1-3">Replace a date display.</a></li>
                <li><a href="#demo_2">Pick multiple dates.</a></li>
                <li><a href="#demo_3-1">Set date ranges are disable.</a></li>
                <li><a href="#demo_3-2">Setting option use array.</a></li>
                <li><a href="#demo_4">Set dates or ranges are selected.</a></li>
                <li><a href="#demo_5-1">Set a "AREA" range.</a></li>
                <li><a href="#demo_5-2">Use a function to get ranges.</a></li>
                <li><a href="#demo_6">Change other dom's event to get zdatepicker.</a></li>
                <li><a href="#demo_7-1">Position by direction</a></li>
                <li><a href="#demo_7-2">Position by coordinate</a></li>
                <li><a href="#demo_8">Close button</a></li>
                <li><a href="#demo_9">Symbiont</a></li>
                <li><a href="#demo_10">Show after zdatepicker init.</a></li>
                <li><a href="#demo_11">Not show anything.</a></li>
                <li><a href="#demo_12">Readonly</a></li>
                <li><a href="#demo_13">Change Event for show zdatepicker.</a></li>
                <li><a href="#demo_14-1">Date format</a></li>
                <li><a href="#demo_14-2">Special era</a></li>
                <li><a href="#demo_14-3">i18n</a><em class="new">new</em></li>
                <li><a href="#demo_15">Replace return function, and use callback.</a></li>
                <li><a href="#demo_16">Advanced setting for date's status.</a><em class="new">new</em></li>
            </ul>
        </li>
    </ul>
</div>

<h1>DOC &amp; DEMO - zdatepicker</h1>

<h2 id="style">Style</h2>
<p>You can rewrite all of these:</p>
<pre class="brush:css; toolbar:false;">
/* zdatepicker main */
.zdatepicker{ position:absolute; width:280px; z-index:9998; display:none; overflow:hidden; margin:2px 0px; background:#FFF; border:1px solid rgba(0,0,0,.15); border-radius:5px; box-shadow:0 6px 12px rgba(0,0,0,.175); }
.zdatepicker dl{ width:278px; margin:0px; padding:1px; display:block; float:left; }

/* zdatepicker title (prev/next button) */
.zdatepicker dt{ width:100%; height:35px; line-height:35px; background:#fff; font-size:0px; font-weight:normal; word-spacing:0px; text-align:center; vertical-align:top; }
.zdatepicker dt a,
.zdatepicker dt .empty{ display:inline-block; width:10%; text-decoration:none; font-size:14px; color:#333; margin:0px; vertical-align:top; }
.zdatepicker dt a:hover{ background:#eee; color:#333; }
.zdatepicker dt .prev,
.zdatepicker dt .next { font-family:FontAwesome; font-weight:normal; color:#666; }
.zdatepicker dt .prev:before { content:"\f0d9"; }
.zdatepicker dt .next:before { content:"\f0da"; }

/* zdatepicker title (year/month) */
.zdatepicker dt span { display:inline-block; width:80%; font-size:14px; cursor:pointer; }
.zdatepicker dt span a { display:inline-block; width:auto; padding:0px 5px; font-size:14px; color:#333; margin:0px 2px; }
.zdatepicker dt span a:after { font-family:FontAwesome; font-size:12px; content:"\f0d7"; margin-left:2px; }

/* zdatepicker main */
.zdatepicker dd { width:98%; padding:0px 2px; padding:0 0 5px 0; font-size:0px; word-spacing:-11px; text-align:left; }

/* zdatepicker sub-title (week) */
.zdatepicker dd div { background:#fff; margin-bottom:3px; }
.zdatepicker dd div span,
.zdatepicker dd span { display:inline-block; width:14%; height:35px; line-height:32px; font-size:14px; word-spacing:normal; text-align:center; color:#666; vertical-align:top; }
.zdatepicker dd div span { font-size:12px; height:25px; line-height:25px; }

/* zdatepicker body */
.zdatepicker dd span a,
.zdatepicker dd span span { display:inline-block; width:100%; line-height:33px; margin-top:1px; text-decoration:none; color:#666; }
.zdatepicker dd span a:hover { background:#eee; color:#333; border-radius:5px; }
.zdatepicker dd span .selected,
.zdatepicker dd span .selected:hover,
.zdatepicker dd span .disable,
.zdatepicker dd span .disable:hover,
.zdatepicker dd span .area,
.zdatepicker dd span .area:hover { border-radius:0px; }
.zdatepicker dd .month,
.zdatepicker dd .year { width:25%; height:65px; margin-top:2px; margin-bottom:5px; }
.zdatepicker dd .month a,
.zdatepicker dd .year a { width:100%; height:65px; line-height:65px; overflow:hidden; }

/* zdatepicker close */
.zdatepicker .close { display:block; height:0px; width:100%; margin-top:10px; padding:0px; filter:alpha(opacity=100); opacity:1;}
.zdatepicker .close:hover { background:transparent; }
.zdatepicker .close a { position:absolute; right:5px; bottom:5px; display:inline-block; border-radius:40px; height:40px; width:40px; text-align:center; line-height:40px; text-decoration:none; box-shadow:0 3px 4px rgba(0,0,0,.175); }
.zdatepicker .close a:before { font-family:FontAwesome; content:"\f00d"; font-size:22px; }
.zdatepicker .close a:hover { }

/* bootstrap theme */
.zdatepicker dd .week0 { color:#d9534f; }
.zdatepicker dd .week6 { color:#5cb85c; }
.zdatepicker dd span a:hover { }
.zdatepicker dd span .selected { color:#fff; background:#428bca; }
.zdatepicker dd span .selected:hover { color:#fff; background:#3071a9; }
.zdatepicker dd span .disable,
.zdatepicker dd span .disable:hover { color:#ccc; background:#eee; cursor:not-allowed; }
.zdatepicker dd span .area { color:#fff; background:#5bc0de; }
.zdatepicker dd span .area.selected,
.zdatepicker dd span .area:hover { color:#fff; background:#31b0d5; }
.zdatepicker .close a { color:#fff; background:#d9534f; }
.zdatepicker .close a:hover { color:#fff; background:#c9302c; }
</pre>


<h2 id="options">Options</h2>
<h5 id="classname">classname</h5>
<ul>
    <li class="note">zdatepicker container's class name.</li>
    <li>type:string</li>
    <li>default:"zdatepicker"</li>
</ul>

<h5 id="event">event</h5>
<ul>
    <li class="note">event of show zdatepicker. (don't use 'focus' and 'blur')</li>
    <li>type:string</li>
    <li>default:"click"</li>
</ul>

<h5 id="viewmonths">viewmonths</h5>
<ul>
    <li class="note">how many months to show.</li>
    <li>type:number</li>
    <li>default:2</li>
</ul>

<h5 id="format">format</h5>
<ul>
    <li class="note">all settings of string format for view.</li>
    <li>type:object</li>
    <li>default:{date:"yyyy-mm-dd",month:"yyyy-mm",year:"yyyy",onlymonth:"mm"}</li>
</ul>

<h5 id="daystr">daystr</h5>
<ul>
    <li>type:array</li>
    <li>default:["Sun","Mon","Tue","Wed","Thur","Fri","Sat"]</li>
</ul>

<h5 id="monthstr">monthstr</h5>
<ul>
    <li>type:array</li>
    <li>default:["01","02","03","04","05","06","07","08","09","10","11","12"]</li>
</ul>

<h5 id="weekoffset">weekoffset</h5>
<ul>
    <li class="note">Select the day to start the week from. Default option is Sunday(0), but you can start a week on Friday if you want to by setting this option to 5.</li>
    <li>type:number</li>
    <li>default:0</li>
</ul>

<h5 id="year2str">year2str</h5>
<ul>
    <li class="note">format a date to return.</li>
    <li>type:function</li>
    <li>default:null</li>
</ul>

<h5 id="str2year">str2year</h5>
<ul>
    <li class="note">format a string from input's value.</li>
    <li>type:function</li>
    <li>default:null</li>
</ul>

<h5 id="initmonth">initmonth</h5>
<ul>
    <li class="note">select a month to show.</li>
    <li>type:string, microtime, Date obj, Dom, function</li>
    <li>default:null</li>
</ul>

<h5 id="symbiont">symbiont</h5>
<ul>
    <li class="note">...(i can't explain it)</li>
    <li>type:boolean</li>
    <li>default:true</li>
</ul>

<h5 id="readonly">readonly</h5>
<ul>
    <li>type:boolean</li>
    <li>default:false</li>
</ul>

<h5 id="disable">disable</h5>
<ul>
    <li class="note">set date or ranges be disable. (date must format to like "2014-01-01")</li>
    <li>type:function, array, object</li>
    <li>default:{}</li>
</ul>

<h5 id="area">area</h5>
<ul>
    <li class="note">use two date / dom's value to make up a "AREA". (date must format to like "2014-01-01")</li>
    <li>type:function, array, object</li>
    <li>default:{}</li>
</ul>

<h5 id="selected">selected</h5>
<ul>
    <li class="note">set date or ranges be selected. <br />(if setting is true, picking multiple dates is enabled. date must format to like "2014-01-01")</li>
    <li>type:boolean, object</li>
    <li>default:false</li>
</ul>

<h5 id="replace">replace</h5>
<ul>
    <li class="note">replace a date to any string. (key must be like "2014-01-01")</li>
    <li>type:object</li>
    <li>default:null</li>
</ul>

<h5 id="pos">pos</h5>
<ul>
    <li>type:object</li>
    <li>default:{}</li>
</ul>

<h5 id="use">use</h5>
<ul>
    <li class="note">use other dom (jquery selector: #id / .class ..) to build zdatepicker.</li>
    <li>type:string</li>
    <li>default:false</li>
</ul>

<h5 id="show">show</h5>
<ul>
    <li class="note">true: show when init / false: don't show on any event.</li>
    <li>type:boolean</li>
    <li>default:null</li>
</ul>

<h5 id="prevbtn">prevbtn</h5>
<ul>
    <li class="note">previous button</li>
    <li>type:string</li>
    <li>default:&lt;</li>
</ul>

<h5 id="nextbtn">nextbtn</h5>
<ul>
    <li class="note">next button</li>
    <li>type:string</li>
    <li>default:&gt;</li>
</ul>

<h5 id="closebtn">closebtn</h5>
<ul>
    <li class="note">close button</li>
    <li>type:boolean/string</li>
    <li>default:false</li>
</ul>

<h5 id="onFilter">onFilter</h5>
<ul>
    <li class="note">filter date status(disable? selected? other?). 5 args(date, month, year, day, status), return array.</li>
    <li>type:function</li>
    <li>default:null</li>
</ul>

<h5 id="onReturn">onReturn</h5>
<ul>
    <li class="note">change the default return func.</li>
    <li>type:function</li>
    <li>default:null</li>
</ul>




<h2 id="callback">Callback</h2>

<h4>$.fn.zdatepicker.callback with two parameters: type and arg.<br />It's a global function! You can rewrite it.</h4>

<h5 id="type">parameter - type</h5>
<ul>
    <li>return : after return date by 'onReturn'.</li>
    <li>close : after click close button.</li>
    <li>prev_month : after click prev month.</li>
    <li>next_month : after click next month.</li>
    <li>prev_year : after click prev year to show prev 12 months.</li>
    <li>next_year : after click next year to show next 12 months.</li>
    <li>prev_years : after click prev 10 years.</li>
    <li>next_years : after click next 10 years.</li>
    <li>select_month : after select a month in changing month.</li>
    <li>select_year : after select a year in changing year.</li>
    <li>area : after return date when get a AREA.</li>
    <li>fail_to_area : after AREA have a fail, like : one date is null or two date can't be make up a range.</li>
</ul>

<h5 id="arg">parameter - arg</h5>
<ul>
    <li>input : the dom of input.</li>
    <li>calendar : the dom of zdatepicker.</li>
    <li>a : a "A" dom at last click.</li>
    <li>date : string of date to return, if have.</li>
    <li>dateObj : a Dateobj about date, if have.</li>
    <li>area : a array of new AREA, if have.</li>
    <li>year : number of selected year, if have.</li>
    <li>month : number of selected month, if have.</li>
</ul>



<h2 id="demo">Demo</h2>

<h4 id="demo_1-1">1-1. Simple</h4>
<div class="demo">
    <input class="time1" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time1").zdatepicker();
        </pre>
        <script type="text/javascript">
            $(".time1").zdatepicker();
        </script>
    </div>
</div>

<h4 id="demo_1-2">1-2. Show one month.</h4>
<div class="demo">
    <input class="time1_2" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time1_2").zdatepicker({viewmonths:1});
        </pre>
        <script type="text/javascript">
            $(".time1_2").zdatepicker({viewmonths:1});
        </script>
    </div>
</div>

<h4 id="demo_1-3">1-3. Replace a date display.</h4>
<div class="demo">
    <input class="time1_3" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time1_3").zdatepicker({replace:{'<?=date('Y-m-d')?>':'Today'}});
        </pre>
        <script type="text/javascript">
            $(".time1_3").zdatepicker({replace:{'<?=date('Y-m-d')?>':'Today'}});
        </script>
    </div>
</div>


<h4 id="demo_2">2. Pick multiple dates.</h4>
<div class="demo">
    <input class="time2" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time2").zdatepicker({selected:true});
        </pre>
        <script type="text/javascript">
            $(".time2").zdatepicker({selected:true});
        </script>
    </div>
</div>


<h4 id="demo_3-1">3-1. Set date ranges are disable.</h4>
<div class="demo">
    <input class="time3" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time3").zdatepicker({
            disable:{
                0:{0:"<?=date('Y-m')?>-02",1:"<?=date('Y-m')?>-11"},
                1:{0:"<?=date('Y-m')?>-20",1:"<?=date('Y-m')?>-29"}
            }
        });
        </pre>
        <script type="text/javascript">
            $(".time3").zdatepicker({
                disable:{
                    0:{0:"<?=date('Y-m')?>-02",1:"<?=date('Y-m')?>-11"},
                    1:{0:"<?=date('Y-m')?>-20",1:"<?=date('Y-m')?>-29"}
                }
            });
        </script>
    </div>
</div>


<h4 id="demo_3-2">3-2. Setting option use array.</h4>
<div class="demo">
    <input class="time3_2" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time3_2").zdatepicker({
            disable:[
                ["<?=date('Y-m')?>-02","<?=date('Y-m')?>-11"],
                ["<?=date('Y-m')?>-20","<?=date('Y-m')?>-29"]
            ]
        });
        </pre>
        <script type="text/javascript">
        $(".time3_2").zdatepicker({
            disable:[
                ["<?=date('Y-m')?>-02","<?=date('Y-m')?>-11"],
                ["<?=date('Y-m')?>-20","<?=date('Y-m')?>-29"]
            ]
        });
        </script>
    </div>
</div>



<h4 id="demo_4">4. Set dates or ranges are selected.</h4>
<div class="demo">
    <input class="time4" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time4").zdatepicker({
            selected:{
                0:{0:"<?=date('Y-m')?>-05", 1:"<?=date('Y-m')?>-08"},
                1:{0:"<?=date('Y-m')?>-29"}
            }
        });
        </pre>
        <script type="text/javascript">
        $(".time4").zdatepicker({
            selected:{
                0:{0:"<?=date('Y-m')?>-05", 1:"<?=date('Y-m')?>-08"},
                1:{0:"<?=date('Y-m')?>-29"}
            }
        });
        </script>
    </div>
</div>




<h4 id="demo_5-1">5-1. Set a "AREA" range.</h4>
<div class="demo">
    <input class="time5_a" value="<?=date('Y-m')?>-15" /> -- <input class="time5_b" value="<?=date('Y-m')?>-23" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time5_a").zdatepicker({
            viewmonths:2,
            area:{
                0:'',
                1:$(".time5_b")
            },
            disable:{
                0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
            }
        });

        $(".time5_b").zdatepicker({
            viewmonths:2,
            initmonth:$(".time5_a"),
            area:{
                0:$(".time5_a"),
                1:''
            },
            disable:{
                0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
            }
        });
        </pre>
        <script type="text/javascript">
        $(".time5_a").zdatepicker({
            viewmonths:2,
            area:{
                0:'',
                1:$(".time5_b")
            },
            disable:{
                0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
            }
        });

        $(".time5_b").zdatepicker({
            viewmonths:2,
            initmonth:$(".time5_a"),
            area:{
                0:$(".time5_a"),
                1:''
            },
            disable:{
                0:{0:"<?=date('Y')?>-<?=(date('n')+1)?>-22", 1:"<?=date('Y')?>-<?=(date('n')+1)?>-25"}
            }
        });
        </script>
    </div>
</div>





<h4 id="demo_5-2">5-2. Use a function to get ranges.</h4>
<div class="demo">
    <input class="time5_2_a" value="<?=date('Y-m')?>-02" /> -- <input class="time5_2_b" value="<?=date('Y-m')?>-05"><br />
    <input class="time5_2_a" value="<?=date('Y-m')?>-09" /> -- <input class="time5_2_b" value="<?=date('Y-m')?>-12"><br />
    <input class="time5_2_a" value="<?=date('Y-m')?>-29" /> -- <input class="time5_2_b" value="<?=date('Y')?>-<?=sprintf('%02d', date('n')+1)?>-03" /><br />
    <input class="time5_2_a" value="<?=date('Y')?>-<?=sprintf('%02d', date('n')+1)?>-11" /> -- <input class="time5_2_b" value="<?=date('Y')?>-<?=sprintf('%02d', date('n')+1)?>-23" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        function getDisable(start, end){
            var date = [];
            start.siblings(".time5_2_a").each(function(i){
                date[i] = [];
                date[i][0] = $(this).val();
                date[i][1] = $(this).nextAll(".time5_2_b").eq(0).val();
            });
            return date;
        }

        $(".time5_2_a").click(function(){
            $(this).zdatepicker({
                viewmonths:2,
                show:true,
                area:{
                    0:'',
                    1:$(this).nextAll(".time5_2_b").eq(0)
                },
                disable:getDisable($(this), $(this).nextAll(".time5_2_b").eq(0))
            });
        })

        $(".time5_2_b").click(function(){
            $(this).zdatepicker({
                viewmonths:2,
                initmonth:$(this).prevAll(".time5_2_a").eq(0),
                show:true,
                area:{
                    0:$(this).prevAll(".time5_2_a").eq(0),
                    1:''
                },
                disable:getDisable($(this).prevAll(".time5_2_a").eq(0), $(this))
            });
        })
        </pre>
        <script type="text/javascript">
        function getDisable(start, end){
            var date = [];
            start.siblings(".time5_2_a").each(function(i){
                date[i] = [];
                date[i][0] = $(this).val();
                date[i][1] = $(this).nextAll(".time5_2_b").eq(0).val();
            });
            return date;
        }

        $(".time5_2_a").click(function(){
            $(this).zdatepicker({
                viewmonths:2,
                show:true,
                area:{
                    0:'',
                    1:$(this).nextAll(".time5_2_b").eq(0)
                },
                disable:getDisable($(this), $(this).nextAll(".time5_2_b").eq(0))
            });
        })

        $(".time5_2_b").click(function(){
            $(this).zdatepicker({
                viewmonths:2,
                initmonth:$(this).prevAll(".time5_2_a").eq(0),
                show:true,
                area:{
                    0:$(this).prevAll(".time5_2_a").eq(0),
                    1:''
                },
                disable:getDisable($(this).prevAll(".time5_2_a").eq(0), $(this))
            });
        })
        </script>
    </div>
</div>




<h4 id="demo_6">6. Change other dom's event to get zdatepicker.</h4>
<div class="demo">
    <input class="time6" value="<?=date('Y-m')?>-15" /><input type="button" value="click me!" onclick="dozdatepicker()" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        // "click me!!" button's onclick is "dozdatepicker()"
        function dozdatepicker(){
            var rand = Math.round(Math.random() * 28);
            var zdp = $(".time6").zdatepicker({
                event:'',
                viewmonths:1,
                selected:{0:{0:"<?=date('Y-m')?>-"+rand}},
                show:true
            });
            $(".time6").focus();
        }
        </pre>
        <script type="text/javascript">
        function dozdatepicker(){
            var rand = Math.round(Math.random() * 28);
            var zdp = $(".time6").zdatepicker({
                event:'',
                viewmonths:1,
                selected:{0:{0:"<?=date('Y-m')?>-"+rand}},
                show:true
            });
            console.log(zdp);
            $(".time6").focus();
        }
        </script>
    </div>
</div>




<h4 id="demo_7-1">7-1. Position by direction</h4>
<div class="demo">
    <input class="time7_1" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time7_1").zdatepicker({
            viewmonths:1,
            pos:{top:"bottom", left:"right"}
        });
        </pre>
        <script type="text/javascript">
        $(".time7_1").zdatepicker({viewmonths:1, pos:{top:"bottom", left:"right"}});
        </script>
    </div>
</div>


<h4 id="demo_7-2">7-2. Position by coordinate</h4>
<div class="demo">
    <input class="time7_2" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <pre class="brush:js; toolbar:false;">
        $(".time7_2").zdatepicker({
            viewmonths:1,
            pos:{top:-100, left:300}
        });
        </pre>
        <script type="text/javascript">
        $(".time7_2").zdatepicker({viewmonths:1, pos:{top:-100, left:300}});
        </script>
    </div>
</div>




<h4 id="demo_8">8. Close button</h4>
<div class="demo">
    <input class="time8" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time8").zdatepicker({
            viewmonths:2,
            closebtn:true
        });
        </pre>
        <script type="text/javascript">
        $(".time8").zdatepicker({viewmonths:2, closebtn:true});
        </script>
    </div>
</div>




<h4 id="demo_9">9. Symbiont</h4>
<div class="demo">
    <input class="time9_a" value="<?=date('Y-m')?>-15" /> -------
    <input class="time9_a" value="<?=date('Y-m')?>-15" /> -------
    <input class="time9_a" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time9_a").zdatepicker({
            viewmonths:1,
            symbiont:false,
            closebtn:true
        });
        </pre>
        <script type="text/javascript">
        $(".time9_a").zdatepicker({viewmonths:1, symbiont:false, closebtn:true});
        </script>
    </div>

    <div style="margin-top:20px"> </div>

    <input class="time9_b" value="<?=date('Y-m')?>-15" /> -------
    <input class="time9_b" value="<?=date('Y-m')?>-15" /> -------
    <input class="time9_b" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time9_b").zdatepicker({
            viewmonths:1
        });
        </pre>
        <script type="text/javascript">
        $(".time9_b").zdatepicker({viewmonths:1});
        </script>
    </div>
</div>




<h4 id="demo_10">10. Show after zdatepicker init.</h4>
<div class="demo">
    <input class="time10" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        // input's position is changed after SyntaxHighlighter init.
        $(".time10").zdatepicker({
            viewmonths:1,
            show:true
        });
        </pre>
        <script type="text/javascript">$(".time10").zdatepicker({viewmonths:1, show:true});</script>
    </div>
</div>





<h4 id="demo_11">11. Not show anything.(but zdatepicker is inited.</h4>
<div class="demo">
    <input class="time11" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time11").zdatepicker({
            viewmonths:1,
            show:false
        });
        </pre>
        <script type="text/javascript">
        $(".time11").zdatepicker({viewmonths:1, show:false});
        </script>
    </div>
</div>




<h4 id="demo_12">12. Readonly</h4>
<div class="demo">
    <input class="time12" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time12").zdatepicker({
            viewmonths:1,
            readonly:true
        });
        </pre>
        <script type="text/javascript">
        $(".time12").zdatepicker({viewmonths:1, readonly:true});
        </script>
    </div>
</div>




<h4 id="demo_13">13. Change Event for show zdatepicker.</h4>
<div class="demo">
    <input class="time13" value="<?=date('Y-m')?>-15" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time13").zdatepicker({
            viewmonths:1,
            event:"mouseover"
        });
        </pre>
        <script type="text/javascript">
        $(".time13").zdatepicker({viewmonths:1, event:"mouseover"});
        </script>
    </div>
</div>




<h4 id="demo_14-1">14-1. Date format</h4>
<div class="demo">
    <input class="time14_1" value="15,<?=date('M')?>/<?=date('Y')?>" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time14_1").zdatepicker({
            format:{date:"dd,mm\/yyyy", month:"mm\/yyyy", year:"yyyy", onlymonth:"mm."},    // use regular for replace, so you need use \ to some char.
            daystr:["S","M","T","W","Th","F","S"],
            monthstr:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        });
        </pre>
        <script type="text/javascript">
        $(".time14_1").zdatepicker({
            format:{date:"dd,mm\/yyyy", month:"mm\/yyyy", year:"yyyy", onlymonth:"mm."},
            daystr:["S","M","T","W","Th","F","S"],
            monthstr:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        });
        </script>
    </div>
</div>





<h4 id="demo_14-2">14-2. Special era</h4>
<div class="demo">
    <input class="time14_2" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;" style="height:400px;">
        // China_taiwan era.
        $(".time14_2").zdatepicker({
            format:{date:"yyyy年mm月dd日", month:"yyyy年mm月", year:"yyyy年", onlymonth:"mm月"},
            daystr:["日","一","二","三","四","五","六"],
            monthstr:["1","2","3","4","5","6","7","8","9","10","11","12"],
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
        </pre>
        <script type="text/javascript">
        $(".time14_2").zdatepicker({
            format:{date:"yyyy年mm月dd日", month:"yyyy年mm月", year:"yyyy年", onlymonth:"mm月"},
            daystr:["日","一","二","三","四","五","六"],
            monthstr:["1","2","3","4","5","6","7","8","9","10","11","12"],
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
    </div>
</div>



<h4 id="demo_14-3">14-3. i18n</h4>
<div class="demo">
    <input class="time14_3" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;" style="height:400px;">
        $(".time14_3").zdatepicker({
            /* French */
            format:{date:"dd,mm\/yyyy", month:"mm\/yyyy", year:"yyyy", onlymonth:"mm"},
            daystr:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
            monthstr:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"]
            /* German */
            //daystr:["So","Mo","Di","Mi","Do","Fr","Sa"],
            //monthstr:["Januar","Februar","Maerz","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"]
            /* Japan */
            //daystr:["日","月","火","水","木","金","土"],
            //monthstr:["睦月","如月","弥生","卯月","皐月","水无月","文月","叶月","长月","神无月","霜月","师走"]
            /* China */
            //daystr:["日","一","二","三","四","五","六"],
            //monthstr:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"]
        });
        </pre>
    </div>
        <script type="text/javascript">
        $(".time14_3").zdatepicker({
            /* French */
            format:{date:"dd,mm\/yyyy", month:"mm\/yyyy", year:"yyyy", onlymonth:"mm"},
            daystr:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
            monthstr:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"]
            /* German */
            //daystr:["So","Mo","Di","Mi","Do","Fr","Sa"],
            //monthstr:["Januar","Februar","Maerz","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"]
            /* Japan */
            //daystr:["日","月","火","水","木","金","土"],
            //monthstr:["睦月","如月","弥生","卯月","皐月","水无月","文月","叶月","长月","神无月","霜月","师走"]
            /* China */
            //daystr:["日","一","二","三","四","五","六"],
            //monthstr:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"]
        });
        </script>
</div>



<h4 id="demo_15">15. Replace return function. and use callback.</h4>
<div class="demo">
    <iframe src="./demo15.html" frameborder="0" height="330" width="450"></iframe>

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;" style="height:400px;">
        function returnSelect(){
            var timeArr = $('.time15').val().split(',');
            var sel = {}, i = 0;
            for(var x in timeArr){
                sel[x+1] = {0:timeArr[x]};
                i = x + 1;
            }
            return i > 1 ? sel : true ;
        }

        // please click next month.
        $.fn.zdatepicker.callback = function(type, arg){
            if(type == 'next_month'){
                alert("goto:"+arg.year+"-"+arg.month);
                $(arg.input).focus();
            }
        }

        $(".time15").click(function(){
            var sel = returnSelect();
            $(this).zdatepicker({
                show:true,
                viewmonths:1,
                selected:sel,
                event:false,
                onReturn:function(date, dateObj, obj, calendar, a, selected){
                    if(selected) $(obj).val( selected.join(',') );
                }
            });
        });
        </pre>
    </div>
</div>




<h4 id="demo_16">16. Advanced setting for date's status.</h4>
<div class="demo">
    <input class="time16" value="" />

    <div class="code">
        <h5>Code：</h5>
        <pre class="brush:js; toolbar:false;">
        $(".time16").zdatepicker({
            onFilter:function(d, m, y, w, cla){
                if(w == 0 || w == 6){
                    cla.push('disable');
                }
                return cla;
            }
        });
        </pre>
        <script type="text/javascript">
        $(".time16").zdatepicker({
            onFilter:function(d, m, y, w, cla){
                if(w == 0 || w == 6){
                    cla.push('disable');
                }
                return cla;
            }
        });
        </script>
    </div>
</div>


<script src="http://agorbatchev.typepad.com/pub/sh/3_0_83/scripts/shCore.js" type="text/javascript"></script>
<script src="http://agorbatchev.typepad.com/pub/sh/3_0_83/scripts/shBrushXml.js" type="text/javascript"></script>
<script src="http://agorbatchev.typepad.com/pub/sh/3_0_83/scripts/shBrushJScript.js" type="text/javascript"></script>
<script src="http://agorbatchev.typepad.com/pub/sh/3_0_83/scripts/shBrushCss.js" type="text/javascript"></script>
<script type="text/javascript">
SyntaxHighlighter.all();

$(function(){
    $(".directory").height($(window).height());

    $(window).resize(function(){
        $(".directory").height($(window).height());
    });

    $(".directory>ul>li>b").click(function(){
        var ul = $(this).next("a").next("ul");
        ul.toggle();
        $(this).text((ul.is(":visible") ? "-" : "+"));
    });
})
</script>


</body>
</html>
