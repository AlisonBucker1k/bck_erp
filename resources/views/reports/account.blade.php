 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.account_transaction_report');?></h4>
					</div>
					<div class="content">
						<div class="row">
							<form action="" method="POST" id="form">
							<div class="col-lg-3">
							 <label><?php echo trans('lang.name');?></label>
							 <input id="name" type="text" class="form-control" name="name" placeholder="<?php echo trans('lang.name');?>"/>
							</div>	

							<div class="col-lg-3">
							 <label><?php echo trans('lang.account');?></label>
							 <select id="account" class="form-control" name="account" required>
							 <option value=""><?php echo trans('lang.select_a_account');?></option>
							 </select>
							</div>
							
							<div class="col-lg-3">
							<label for="date" class="control-label"> 
									<?php echo trans('lang.from_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
							</div>
							<div class="col-lg-3">
							<label for="date" class="control-label"> 
									<?php echo trans('lang.to_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="todate" name="todate" class="form-control" type="text" value=""/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
							</div>
							<div class="col-lg-2">
									<label>.</label> 
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
						<h4 class="title"><?php echo trans('lang.account_transaction_report');?></h4>
                    </div>
                    <div class="content">
					<div class="table-responsive">
						<table id="data" class="table table-striped table-bordered"  cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo trans('lang.income');?></th>
									<th><?php echo trans('lang.expense');?></th>										
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo trans('lang.income');?></th>
									<th><?php echo trans('lang.expense');?></th>	
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
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<div class="pull-left">
							<h5><b><?php echo trans('lang.account_chart');?></b></h5>
						</div>
						<div class="pull-right">
							<div class="text-danger">
								<b><span></span></b><br/>
								<small></small>
							</div>
						</div>
					</div>
					<div class="content">
					<input type="hidden" class="currency"/>
							<canvas id="accountbalance"></canvas>
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
        },
    });
   
	//get account
	$.ajax({
        type: "GET",
        url: "{{ url('account/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var options;
			var objs = html.data;
			$.each(objs, function(index, object) {
					options += '<option value="' + object.accountid + '">' + object.name + '</option>';
				});
				$('#form #account').html(options);
        },
    });
	
	
	
	//get data
    var table = $('#data').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter : false,
            ajax: {
				url : "{{ url('reports/getaccounttransaction')}}",
				data: function (d) {
					d.account = $('select[name=account]').val();
					d.fromdate = $('input[name=fromdate]').val();
					d.todate = $('input[name=todate]').val();
					d.names = $('input[name=name]').val();
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
				{ data: 'reference', name:'reference'},				
				{ data: 'description', name:'description'},		
				{ data: 'transactiondate', name:'transactiondate'},
				{ data: 'income', name:'income'},
				{ data: 'expense', name:'expense'}
			],
			dom: 'Bfrtip',

			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					orientation:'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
					}
				}
			]
    } );
	//do search
	$('#form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });
	
	//accountbalance
	$.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];			
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
						label: '<?php echo trans('lang.account');?>',
						data: amount,
						backgroundColor: '#A5DFDF',
						borderColor: '#A5DFDF',
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