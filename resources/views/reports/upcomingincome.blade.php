 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.upcoming_income_reports');?></h4>
					</div>
					<div class="content">
						<div class="row">
							<form action="" method="POST" id="form">

							<div class="col-lg-4">
							 <label><?php echo trans('lang.name');?></label>
							 <input id="name" type="text" class="form-control" name="name" placeholder="<?php echo trans('lang.name');?>"/>
							</div>	
							

							<div class="col-lg-4">
							 <label><?php echo trans('lang.category');?></label>
							 <select id="category" class="form-control" name="category" required>
							 <option value=""><?php echo trans('lang.select_a_category');?></option>
							 </select>
							</div>
							<div class="col-lg-4">
							 <label><?php echo trans('lang.sub_category');?></label>
							 <select id="subcategory" class="form-control" name="subcategory">
							 </select>
							</div>
							
						</div>	
						<div class="row">
							<div class="col-lg-4">
							<label for="date" class="control-label"> 
									<?php echo trans('lang.from_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
							</div>
							<div class="col-lg-4">
							<label for="date" class="control-label"> 
									<?php echo trans('lang.to_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="todate" name="todate" class="form-control" type="text" value=""/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
							</div>
						</div>						
						<div class="row">
								<div class="col-lg-2">
									<button type="submit" class="form-control btn btn-sm btn-fill btn-info"><i class="ti-search"></i> <?php echo trans('lang.search');?></button>
								</div>
						</div>
							</form>
						
					</div>
				 </div>
			</div> 
		</div>
		
        <div class="row">

            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<h4 class="title"><?php echo trans('lang.upcoming_income_reports');?></h4>
                    </div>
                    <div class="content">
					<div class="table-responsive">
						<table id="data" class="table table-striped table-bordered"  cellspacing="0" width="100%">
							<thead>
								<tr>

									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>									
								</tr>
							</thead>
							<tfoot>
								<tr>

									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>	
								</tr>
							</tfoot>
							<tbody>
							
							</tbody>
						</table>
					</div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="header">
						<div class="pull-left">
							<h5><b><?php echo trans('lang.12_monthly__upcoming_income_chart');?></b></h5>
						</div>
						<div class="pull-right">
							<div class="text-success">
								<b><span class="currencys"></span><span id="totalyear"></span></b><br/>
								<small><?php echo trans('lang.in_this_year');?></small>
							</div>
						</div>
					</div>
					<div class="content">
					<input type="hidden" class="currency"/>
							<canvas id="chart1"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="header">
						<h5><b><?php echo trans('lang.upcoming_income_by_category');?> (<?php echo date("Y");?>)</b></h5>
					</div>
					<div class="content">
							<canvas id="chart2"></canvas>
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
	

	//income total
	$.ajax({
        type: "GET",
        url: "{{ url('upcomingincome/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$("#totalyear").html(data.year);
			
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
			$(".currencys").html(objs[0].currency);
        },
    });
   
	//get income category
	$.ajax({
        type: "GET",
        url: "{{ url('incomecategory/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#form #category").append($("<option></option>")
                    .attr("value",id)
                    .text(name));                 
            });
        },
    });
	
	//get income sub category
	$("#form #category").change(function(e){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: "{{ url('incomecategory/subgetdatabycat')}}",
        dataType: "json",
        data: {id:id},
        success: function (html) {
				var objs = html.message;
				var options;
				if (objs.length === 0) {
					$('#form #subcategory').empty();
				}
				$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#form #subcategory').html(options);
			},
		});
	});
	
	//get data
    var table = $('#data').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter : false,
            ajax: {
				url : "{{ url('reports/gettransactionsupcoming')}}",
				data: function (d) {
					d.type 		= '3';
					d.category = $('select[name=category]').val();
					d.names = $('input[name=name]').val();
					//d.category = 'Salary';
					d.subcategory = $('select[name=subcategory]').val();
					d.fromdate = $('input[name=fromdate]').val();
					d.todate = $('input[name=todate]').val();
				},
			},
			"language": {
            "decimal":        "",
                "emptyTable":     "<?php echo trans('lang.demptyTable');?>",
                "info":           "<?php echo trans('lang.dshowing');?> _START_ <?php echo trans('lang.dto');?> _END_ <?php echo trans('lang.dof');?> _TOTAL_ <?php echo trans('lang.dentries');?>",
                "infoEmpty":      "<?php echo trans('lang.dinfoEmpty');?>",
                "infoFiltered":   "(<?php echo trans('lang.dfilter');?> _MAX_ <?php echo trans('lang.total');?> <?php echo trans('lang.dentries');?>)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "<?php echo trans('lang.dshow');?> _MENU_ <?php echo trans('lang.dentries');?>",
                "loadingRecords": "<?php echo trans('lang.dloadingRecords');?>",
                "processing":     "<?php echo trans('lang.dprocessing');?>",
                "search":         "<?php echo trans('lang.dsearch');?>",
                "zeroRecords":    "<?php echo trans('lang.dzeroRecords');?>",
                "paginate": {
                    "first":      "<?php echo trans('lang.dfirst');?>",
                    "last":       "<?php echo trans('lang.dlast');?>",
                    "next":       "<?php echo trans('lang.dnext');?>",
                    "previous":   "<?php echo trans('lang.dprevious');?>"
                }
            },
			columns: [
				{ data: 'name', name:'name'},
				{ data: 'category', name:'category'},
				{ data: 'subcategory', name:'subcategory'},
				{ data: 'amount', name:'amount'},		
				{ data: 'transactiondate', name:'transactiondate'}
			],
			dom: 'Bfrtip',

			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.upcoming_income_reports');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.upcoming_income_reports');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.upcoming_income_reports');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					orientation:'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.upcoming_income_reports');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4]
					}
				}
			]
    } );
	//do search
	$('#form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });
	
	//income graph
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var cchart1 = document.getElementById("chart1");
			var chart1 = new Chart(cchart1, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: 'Income',
						data: [data.uijan, data.uifeb, data.uimar, data.uiapr, data.uimay, data.uijun, data.uijul, data.uiags, data.uisep, data.uiokt, data.uinov, data.uides],
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 0.2)',
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
	
	//incomebycategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/upcomingincomebycategoryyearly')}}",
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
			
			var cchart2 = document.getElementById("chart2");
			var chart2 = new Chart(cchart2, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: '<?php echo trans('lang.category');?>',
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
		
} );

	$('#fromdate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });	
	$('#todate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });	

</script>
@endsection