 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
		<input type="hidden" class="currency"/>
			<div class="col-lg-4">
				<div class="card ">
					<div class="header">	
					</div>
					<div class="content">
						<h4 class="title text-center"><?php echo trans('lang.income');?></h4>
						<div class="text-primary text-center">
							<h3><span class="currency"></span><span class="incomeyear"></span></h3>
							<small><?php echo trans('lang.in_this_year');?></small>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card ">
					<div class="header">	
					</div>
					<div class="content">
						<h4 class="title text-center">Expense</h4>
						<div class="text-danger text-center">
							<h3><span class="currency"></span><span class="expenseyear"></span></h3>
							<small><?php echo trans('lang.in_this_year');?></small>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card ">
					<div class="header">	
					</div>
					<div class="content">
						<h4 class="title text-center">Balance</h4>
						<div class="text-success text-center">
							<h3><span class="currency"></span><span class="totalbalance">3.259,12</span></h3>
							<small>in This Year</small>
						</div>

					</div>
				</div>
			</div>
		</div>
		
        <div class="row">
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<h4 class="title">Income vs Expense Reports</h4>
                    </div>
                    <div class="content">
						<canvas id="incomevsexpense"></canvas>
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
	


	//get currency
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
	
	//income total
	$.ajax({
        type: "GET",
        url: "{{ url('income/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$(".incomeyear").html(data.year);
        },
    });
	
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$(".expenseyear").html(data.year);
			
        },
    });
	
	//balance
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('reports/getbalance')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$(".totalbalance").html(data.year);
			
        },
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
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
					datasets: [
					{
						label: 'Income',
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijun, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 0.2)',
						borderWidth: 1
					},{
						label: 'Expense',
						data: [data.ejan, data.efeb, data.emar, data.eapr, data.emay, data.ejun, data.ejun, data.ejun, data.ejul, data.eags, data.esep, data.eokt, data.enov, data.edes],
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
		
} );

</script>
@endsection