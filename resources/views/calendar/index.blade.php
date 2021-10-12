@extends('layouts.app')
@section('content')
<div class="content">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.income_expense');?></h4> 
					</div>
					<div class="content">
						<div id="mycalendar"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card background-blue color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style="font-size:22px;">
                                    <span><?php echo trans('lang.income');?> </span><span class="monthname"></span>
                                    <span class="currency"></span><span id="incomemonth"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-md-4">
				<div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-stats-down"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style="font-size:22px;">
                                    <span><?php echo trans('lang.expense');?> </span><span class="monthname"></span>
                                    <span class="currency"></span><span id="expensemonth"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-md-4">
				<div class="card background-blue-sky color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style="font-size:22px;">
                                    <span><?php echo trans('lang.net_balance');?> </span><span class="monthname"></span>
                                    <span class="currency"></span><span id="monthbalance"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            
                        </div>
                    </div>
                </div>
			</div>
		</div>

</div>	  
<script>


$(document).ready(function() {
	$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
	});
   
   
	//load calendar
	 $('#mycalendar').fullCalendar({
		allDayDefault: true,
		header:{
			left: 'title',
			right: 'prev,next today,month'
		},
		monthNames: ['<?php echo trans('lang.jan');?>', '<?php echo trans('lang.feb');?>', '<?php echo trans('lang.mar');?>', '<?php echo trans('lang.apr');?>', '<?php echo trans('lang.may');?>', '<?php echo trans('lang.jun');?>', '<?php echo trans('lang.jul');?>',
    	'<?php echo trans('lang.aug');?>', '<?php echo trans('lang.sep');?>', '<?php echo trans('lang.oct');?>', '<?php echo trans('lang.nov');?>', '<?php echo trans('lang.dec');?>'],
    	dayNamesShort: ['<?php echo trans('lang.sund');?>','<?php echo trans('lang.mon');?>','<?php echo trans('lang.tue');?>','<?php echo trans('lang.wed');?>','<?php echo trans('lang.thu');?>','<?php echo trans('lang.fri');?>','<?php echo trans('lang.sat');?>'],
    	buttonText:{
    		today:    '<?php echo trans('lang.today');?>',
		    month:    '<?php echo trans('lang.month');?>',
		    week:     '<?php echo trans('lang.week');?>',
		    day:      '<?php echo trans('lang.day');?>'
    	},
		eventSources: [
			
			{
			  url: "{{ url('income/getdatacalendar')}}",
			  color: '#82B1FF',
			  textColor: 'white'
			},
			{
			  url: "{{ url('expense/getdatacalendar')}}",
			  color: '#F44336',
			  textColor: 'white'
			}
		],
		eventRender: function(event, element) {
		
			element.find(".fc-content").remove();
			element.find(".fc-event-time").remove();
			var new_description =   
				event.title + '<br/>'
				+  event.amount + '<br/>';
				element.append(new_description);
		}
    });
	
	
	//reload data on click previous date
	var moment = $('#mycalendar').fullCalendar('getDate');
	   var date = moment.format();
	   $.ajax({
			type: "POST",
            url: "{{ url('income/gettotalfilterdate')}}",
            data: {date:date},
            success: function(data) {
				$('#monthbalance').html(data.monthbalance);
				$('.monthname').html(data.monthname);
				$('#incomemonth').html(data.monthincome);
				$('#expensemonth').html(data.monthexpense);
            }
		});
	$('.fc-prev-button').click(function(){
	   var moment = $('#mycalendar').fullCalendar('getDate');
	   var date = moment.format();
	   $.ajax({
			type: "POST",
            url: "{{ url('income/gettotalfilterdate')}}",
            data: {date:date},
            success: function(data) {
				$('#monthbalance').html(data.monthbalance);
				$('.monthname').html(data.monthname);
				$('#incomemonth').html(data.monthincome);
				$('#expensemonth').html(data.monthexpense);
            }
		});
		
	});

	$('.fc-next-button').click(function(){
		var moment = $('#mycalendar').fullCalendar('getDate');
	    var date = moment.format();
		 $.ajax({
			type: "POST",
            url: "{{ url('income/gettotalfilterdate')}}",
            data: {date:date},
            success: function(data) {
				
				$('#monthbalance').html(data.monthbalance);
				$('.monthname').html(data.monthname);
				$('#incomemonth').html(data.monthincome);
				$('#expensemonth').html(data.monthexpense);
            }
		});
	});
   
	//get currency
	
	$.ajax({
        type: "GET",
        url: "{{ url('settings/getapplication')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$(".currency").html(objs[0].currency);
			
        },
    });
	
} );

//for balance support number only
$('.number').keypress(function(event) {
		var $this = $(this);
		if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
		   ((event.which < 48 || event.which > 57) &&
		   (event.which != 0 && event.which != 8))) {
			   event.preventDefault();
		}

		var text = $(this).val();
		if ((event.which == 46) && (text.indexOf('.') == -1)) {
			setTimeout(function() {
				if ($this.val().substring($this.val().indexOf('.')).length > 3) {
					$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
				}
			}, 1);
		}

		if ((text.indexOf('.') != -1) &&
			(text.substring(text.indexOf('.')).length > 2) &&
			(event.which != 0 && event.which != 8) &&
			($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
		}      
	});

	$('.number').bind("paste", function(e) {
	var text = e.originalEvent.clipboardData.getData('Text');
	if ($.isNumeric(text)) {
		if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
			e.preventDefault();
			$(this).val(text.substring(0, text.indexOf('.') + 3));
	   }
	}
	else {
			e.preventDefault();
		 }
	});
	



</script>
@endsection