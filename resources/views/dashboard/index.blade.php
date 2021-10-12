@extends('layouts.app')
@section('content')
<div class="content">
		<div class="row">
			
			<div class="col-lg-3 col-sm-6">
                        <div class="card background-blue color-white">
                       <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div class="numbers">
                                    <p><?php echo trans('lang.income');?></p>
                                    <span class="currency"></span><span class="incomethismonth"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="ti-reload color-white"></i> <span class="color-white"><?php echo trans('lang.in_this_month');?> <span>(<?php echo date("M")?>)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-stats-down"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p><?php echo trans('lang.expense');?></p>
                                    <span class="currency"></span><span class="expensemonth"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="ti-reload color-white"></i> <span class="color-white"><?php echo trans('lang.in_this_month');?> <span>(<?php echo date("M")?>)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="card background-blue color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p><?php echo trans('lang.income');?></p>
                                    <span class="currency"></span><span class="incomeday"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats color-white">
                                <i class="ti-reload color-white"></i> <span class="color-white"><?php echo trans('lang.today');?> <span>(<?php echo date("d M Y")?>)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-stats-down"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p><?php echo trans('lang.expense');?></p>
                                    <span class="currency"></span><span class="expenseday"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="ti-reload color-white"></i> <span class="color-white"><?php echo trans('lang.today');?> <span>(<?php echo date("d M Y")?>)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title"> <?php echo trans('lang.income_vs_expense').' '. date("Y");?><h4>
                        <p class="category"><?php echo trans('lang.monitoring_income_expense_this_year');?></p>
						<input type="hidden" class="currency"/>
                    </div>
                    <div class="content">
                        <canvas id="incomevsexpense" height="100"></canvas>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-5">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?php echo trans('lang.account_balance').' '. date("Y");?><h4>
                        <p class="category"><?php echo trans('lang.monitoring_account_balance_this_year');?></p>
                    </div>
                    <div class="content">
                        <canvas id="accountbalance" height="100"></canvas>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.expense_by_category').' '.date("M Y");?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_expense_this_month');?></p>
						<input type="hidden" class="currency"/>
                    </div>
                    <div class="content">
                        <canvas id="expensebycategory" height="200"></canvas>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.income_by_category').' '.date("M Y");?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_income_this_month');?></p>
                    </div>	
                    <div class="content">
                        <canvas id="incomebycategory" height="200"></canvas>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
			
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.budget').' '.date("M Y");?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_budget_this_month');?></p>
                    </div>
					
                    <div class="content">
							 <canvas id="budgethismonth" height="200"></canvas>
						<div class="footer">
						<hr>
							<div class="stats">  
								<i class="ti-plus"></i>
							<a href ="{{url('budget/index')}}" class="text-primary"><?php echo trans('lang.more');?></a>
                            </div>
						</div>	
                    </div>
                </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.latest_income');?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_latest_income_this_month');?></p>
                    </div>	
                    <div class="content">
						<div class="table-responsive">
							<table id="dataincome" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><?php echo trans('lang.name');?></th>
										<th><?php echo trans('lang.account');?></th>
										<th><?php echo trans('lang.amount');?></th>
										<th><?php echo trans('lang.date');?></th>									
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th><?php echo trans('lang.name');?></th>
                                        <th><?php echo trans('lang.account');?></th>
                                        <th><?php echo trans('lang.amount');?></th>
                                        <th><?php echo trans('lang.date');?></th>   
									</tr>
								</tfoot>
								<tbody>
								
								</tbody>
							</table>
						</div>	
                        <div class="footer">
                            <hr>
                            <div class="stats">  
								<i class="ti-plus"></i>
								<a href ="{{url('income/index')}}" class="text-primary"><?php echo trans('lang.more');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.latest_expense');?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_latest_expense_this_month');?></p>
                    </div>	
                    <div class="content">
                        <div class="table-responsive">
							<table id="dataexpense" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><?php echo trans('lang.name');?></th>
                                        <th><?php echo trans('lang.account');?></th>
                                        <th><?php echo trans('lang.amount');?></th>
                                        <th><?php echo trans('lang.date');?></th>								
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th><?php echo trans('lang.name');?></th>
                                        <th><?php echo trans('lang.account');?></th>
                                        <th><?php echo trans('lang.amount');?></th>
                                        <th><?php echo trans('lang.date');?></th>
									</tr>
								</tfoot>
								<tbody>
								
								</tbody>
							</table>
						</div>	
                        <div class="footer">
                            <hr>
                            <div class="stats">  
								<i class="ti-plus"></i>
								<a href ="{{url('expense/index')}}" class="text-primary"><?php echo trans('lang.more');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="row">
			<div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.calendar');?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_latest_income_expense_this_month');?></p>
                    </div>	
                    <div class="content">
                       <div id="mycalendar"></div>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h5 class="title"><?php echo trans('lang.goals_summary');?><h5>
                        <p class="category"><?php echo trans('lang.monitoring_latest_goals');?></p>
                    </div>	
                    <div class="content">
                       <div class="goalsprogress"></div>
                        <div class="footer">
                            <hr>
                            <div class="stats">  
                            </div>
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
	
	/*random color
	function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }*/
	
	$.ajax({
        type: "GET",
        url: "{{ url('home/budgetlist')}}",
        dataType: "json",
        success: function (data) {
			/*jQuery.each( dt, function( i, val ) {
				$(".progresscat").append('<b>'+dt[i].name+'</b><br/>'+dt[i].remaining+'<br/><br/>');
			});*/
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].name);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cbudget = document.getElementById("budgethismonth");
			var budgethismonth = new Chart(cbudget, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return $('.currency').val()+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  return '(' + percent + '%)';
						}
					  },
					}
				}
			});	
			
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
	
	
	//accountbalance
	$.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			for(var i in data) {
				label.push(data[i].name);
				amount.push(data[i].balance);

			}
			
			var caccountbalance = document.getElementById("accountbalance");
			var accountbalance = new Chart(caccountbalance, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.account');?>",
						data: amount,
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 0.2)',
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return $('.currency').val()+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						}
					  },
					}
				}
			});
		}
	});	
	
	
	//expensecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/expensebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cexpensecategory = document.getElementById("expensebycategory");
			var expensecategory = new Chart(cexpensecategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return $('.currency').val()+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + percent + '%)';
						}
					  },
					}
				}
			});
		}
	});	
	
	//incomecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cincomebycategory = document.getElementById("incomebycategory");
			var incomebycategory = new Chart(cincomebycategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return $('.currency').val()+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  console.log(dataset);
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + dataset + '%)';
						}
					  },
					}
				}
			});
		}
	});	
	//incomevsexpense
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var cincomevsexpense = document.getElementById("incomevsexpense");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: "<?php echo trans('lang.income');?>",
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 0.2)',
						borderWidth: 1
					},{
						label: "<?php echo trans('lang.expense');?>",
						data: [data.ejan, data.efeb, data.emar, data.eapr, data.emay, data.ejun, data.ejul, data.eags, data.esep, data.eokt, data.enov, data.edes],
						backgroundColor: 'rgba(255, 99, 132, 0.2)',
						borderColor:	'rgba(255,99,132,1)',
						borderWidth: 1
					}
					]
				},
				options: {
					 pieceLabel: {
					  // render 'label', 'value', 'percentage' or custom function, default is 'percentage'
					  render: 'label'
					 }, 
					legend: {
						   position: 'bottom',
						},
					tooltips: {
							mode: 'index',
							intersect: false,
							callbacks: {
								label: function(tooltipItem, data) {
									return $('.currency').val()+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								},
							}
						},
					hover: {
							mode: 'nearest',
							intersect: true
						},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true,
								callback: function(value, index, values) {
								  if(parseInt(value) >= 1000){
									return  $('.currency').val()+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								  } else {
									return $('.currency').val() + value;
								  }
								}
							}
						}]
					}
				}
			});
			
        },
    });

	//load calendar
	 $('#mycalendar').fullCalendar({
		allDayDefault: true,
		header:{
			left: 'title',
			right: 'prev,next today,month'
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
	
	//latest income 
	//get data
    $('#dataincome').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter:false,
			paging: false,
			bInfo: false ,
            ajax: "{{ url('home/latestincome')}}",
            order: [[ 3, "desc" ]],
			columns: [
				{ data: 'name'},		
				{ data: 'account'},		
				{ data: 'amount'},
				{ data: 'transactiondate'}
			]
			
    } );
	
	//latest expense 
	//get data
    $('#dataexpense').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter:false,
			paging: false,
			bInfo: false ,
            ajax: "{{ url('home/latestexpense')}}",
			columns: [
				{ data: 'name'},		
				{ data: 'account'},		
				{ data: 'amount'},
				{ data: 'transactiondate'}
			]
			
    } );
   
	
	
	
	//latest goals
	$.ajax({
        type: "GET",
        url: "{{ url('goals/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var dt = data.data;
			jQuery.each( dt, function( i, val ) {
				$(".goalsprogress").append('<b>'+dt[i].name+'</b><br/>'+dt[i].remaining+'<br/><br/>');
			});
        },
    });
	
	//get currency
	$.ajax({
        type: "GET",
        url: "{{ url('settings/getapplication')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$(".currency").val(objs[0].currency);
			
        },
    });
	
	//income total
	$.ajax({
        type: "GET",
        url: "{{ url('income/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$(".incomeday").html(data.day);
			$(".incomethismonth").html(data.month);
			
        },
    });
	
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$(".expenseday").html(data.day);
			$(".expensemonth").html(data.month);
			
        },
    });
	
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('settings/getapplication')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$(".currency").val(objs[0].currency);
			$(".currency").html(objs[0].currency);
			
        },
    });
} );



</script>
@endsection