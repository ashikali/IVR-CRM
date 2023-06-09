<link rel="stylesheet" type="text/css" href="{{asset('css/live_monitor.css?version=1.2')}}"/>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/raphael-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/justgage.js')}}"></script>

<style>
.gauge {
   width: 290px;
   height: 220px;
}
</style>

<table width='100%'>
<tr>
<td width="25%">
<div class="agent_info">Agent Information</div>
</td>
<td width="50%" align="center">
<span class="main_heading">{{$rep_info["heading"]}}</span>
</td>
<td width="25%" align="left">
<div class="select_tags">
<form action="/admin/livedash">
        <input type="text" value="{{$exten_spy}}" name="exten_spy" size="3px">
        <select class="select_class" id="cbo_estado" name="queue_opt" >
            @foreach($queues as  $id => $queue)
                <option value="{{$id}}" {{ $queue_opt == $id ? 'selected' : '' }}>{{ $queue }}</option>
            @endforeach
        </select>
        <input type="submit" class="button" value="Go" name="submit">
</form>
</div>
</td>
</table>
<table width='100%' border=1>
<tr>
    <td width=25% align="center">
	<table border=1>
	<tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/agent_online.png')}}" width=50px height=50px></td>
        <th  width=100% class="info_head">Agent Logged In  </th></tr>
	<tr><td class="info_val"><label id="agent_logged_in">{{$rep_info["agent_logged_in"]}}</label></td></tr>
        </table>
    </td>
    <td width=25%>
    <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/agent_on_break.jpg')}}" width=50px height=50px></td>
		<th  width=100% class="info_head">Agent on Break</th></tr>
	       <tr><td class="info_val"><label id="agent_on_brk">{{$rep_info["agent_on_brk"]}}</label></td></tr>
        </table>
    </td>
    <td width=25%>
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/avg_call_time.jpg')}}" width=50px height=50px></td>
         <th  width=100% class="info_head">Avg. Call Time </th></tr>
	       <tr><td class="info_val"><span id="avg_call_time">{{$rep_info["avg_call_time"]}}</span></td></tr>
        </table>
    </td>
    <td width=25% align="center">
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/missed_call.jpg')}}" width=50px height=50px></td>
            <th  width=100% class="info_head">Maximum Call Time</th></tr>
	       <tr><td class="info_val"><label id="missed_call">{{$rep_info["max_call_time"]}}</label></td></tr>
        </table>
    </td>
</tr>
<tr>
    <td width=25%>
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/agent_ready.png')}}" width=50px height=50px></td>
           <th  width=100% class="info_head">Agent on ready</th></tr>
	       <tr><td class="info_val"><label id="agent_on_ready">{{$rep_info["agent_on_ready"]}}</label></td></tr>
        </table>
    </td>
    <td width=25%>
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/agent_on_call.png')}}" width=50px height=50px></td>
           <th  width=100% class="info_head">Agent on call</th></tr>
	       <tr><td class="info_val"><label id="agent_on_call">{{$rep_info["agent_on_call"]}}</label></td></tr>
        </table>
    </td>
    <td width=25% align="center">
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/waiting2.png')}}" width=50px height=50px></td>
           <th  width=100% class="info_head">Average Wait Time</th></tr>
	       <tr><td class="info_val"><label id="avg_wait_time">{{$rep_info["avg_wait_time"]}}</label></td></tr>
        </table>
    </td>
    <td width=25% align="center">
        <table border=1><tr><td rowspan=2 style="background-color:white"><img src="{{asset('img/waiting0.png')}}" width=50px height=50px></td>
            <th  width=100% class="info_head">Maximum Wait Time</th></tr>
	       <tr><td class="info_val"><label id="max_wait_time">{{$rep_info["max_wait_time"]}}</label></td></tr>
        </table>
    </td>
</tr>
 </table>
<br>
<div style="float:left;width:20%">
<center>
        <div id="gentered" class="gauge"></div><br/>
        <div id="gwaiting_calls" class="gauge"></div><br/>
        <div id="gabandoned" class="gauge"></div><br/>
        <div id="ganswered" class="gauge"></div><br/>
</center>
</div>
<div style="float:right;width:80%">
    <div id="agents_ring_info" class="agents_on_ring">
        {!!$rep_info["agents_ring_info"]!!}
    </div>
	<div id="agent_current_calls" class="current_calls_div">
	    {!!$rep_info["agent_current_calls"]!!}
	</div>
	<div id="agent_current_breaks" class="current_break_div">
	    {!!$rep_info["agent_current_breaks"]!!}
	</div>
</div>
<script>
$(document).ready(function () {


  window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: '#9966FF',
        grey: 'rgb(201, 203, 207)',
        dgreen:'rgb(0, 255, 43)',
        dred:'#FF0000',
        ogreen: '#b2c831',
        lgreen: '#00f2c3',

  };


  window.charts = {};

  window.charts["gentered"] = new JustGage({

	  id: "gentered",
          value: "{!! $rep_info["entered"] !!}",
          min: 0,
          max: 2000,
	  title: "Entered",
	  titleFontColor: "white",
	  valueFontColor: window.chartColors.lgreen,
	  pointer: true,
	  pointerOptions: {
	      toplength: 5,
	      bottomlength: 8,
	      bottomwidth: 5,
	      color: window.chartColors.red,
          },
	  gaugeColor: window.chartColors.yellow,
          levelColors: [window.chartColors.dgreen],
	  levelColorsGradient:true,
	 hideMinMax: true,

     });
  window.charts["gwaiting_calls"] = new JustGage({

	  id: "gwaiting_calls",
          value: "{!! $rep_info["waiting_calls"] !!}",
          min: 0,
          max: 10,
          title: "Waiting Calls",
	  titleFontColor: "white",
	  valueFontColor: window.chartColors.lgreen,
	  pointer: true,
	  pointerOptions: {
	      toplength: 5,
	      bottomlength: 8,
	      bottomwidth: 5,
	      color: window.chartColors.dgreen,
          },
	  gaugeColor: window.chartColors.yellow,
          levelColors: [window.chartColors.red],
	  levelColorsGradient:true,
	    hideMinMax: true,
     });

  window.charts["gabandoned"] = new JustGage({

	  id: "gabandoned",
          value: "{!! $rep_info["abandoned"] !!}",
          min: 0,
          max: 100,
          title: "Abandoned Calls",
	  titleFontColor: "white",
	  valueFontColor: window.chartColors.red,
	  pointer: true,
	  pointerOptions: {
	      toplength: 5,
	      bottomlength: 8,
	      bottomwidth: 5,
	      color: window.chartColors.red,
          },
	  gaugeColor: window.chartColors.yellow,
          levelColors: [window.chartColors.dred],
	  levelColorsGradient:true,
	  hideMinMax: true,
     });
  window.charts["ganswered"] = new JustGage({

	  id: "ganswered",
          value: "{!! $rep_info["answered"] !!}",
          min: 0,
          max: 2000,
	  valueFontColor: window.chartColors.lgreen,
          title: "Answered Calls",
	  titleFontColor: "white",
	  pointer: true,
	  pointerOptions: {
	      toplength: 5,
	      bottomlength: 8,
	      bottomwidth: 5,
	      color: window.chartColors.red,
          },
	  gaugeColor: window.chartColors.yellow,
          levelColors: [window.chartColors.dgreen],
	  levelColorsGradient:true,
	  hideMinMax: true,

     });

    function UpdateChart() {


        $.ajax({
                       url: "livedash?queue_opt={{$queue_opt}}&exten_spy={{$exten_spy}}",
                       method: 'GET',
                       dataType: 'json',
                       success: function (rep_info) {
		     	  window.charts["ganswered"].refresh(rep_info["answered"]);
		     	  window.charts["gabandoned"].refresh(rep_info["abandoned"]);
		     	  window.charts["gwaiting_calls"].refresh(rep_info["waiting_calls"]);
		     	  window.charts["gentered"].refresh(rep_info["entered"]);
		     	  $("#agents_ring_info").html(rep_info["agents_ring_info"]);
		     	  $("#agent_current_calls").html(rep_info["agent_current_calls"]);
		     	  $("#agent_current_breaks").html(rep_info["agent_current_breaks"]);
		     	  $("#agent_on_brk").html(rep_info["agent_on_brk"]);
		     	  $("#agent_on_call").html(rep_info["agent_on_call"]);
		     	  $("#agent_on_ready").html(rep_info["agent_on_ready"]);
			  $("#agent_logged_in").html(rep_info["agent_logged_in"]);
			  $("#missed_call").html(rep_info["missed_call"]);
			  $("#max_wait_time").html(rep_info["max_wait_time"]);
			  $("#avg_wait_time").html(rep_info["avg_wait_time"]);
			  $("#avg_call_time").html(rep_info["avg_call_time"]);
                       //window.charts["nutall"].series[0].setData([ parseInt(ti["Excellent"]),parseInt(ti["Good"]),parseInt(ti["Bad"]) ]);
                     }
     });

   }
 setInterval(UpdateChart,5000);

});
</script>
