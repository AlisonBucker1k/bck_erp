@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<!--add data-->
      
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
								<input type="hidden" value={{ $id }} id="idbank"/>
							<h4 class="title bankname"></h4>
							<h5 class="accountnumber"></h5>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#delete" class="btn btn-sm btn-fill btn-danger"><i class="ti-trash"></i> <?php echo trans('lang.delete_account');?></a></div>
							<!--<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#edit" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.edit_account');?></a></div>-->

							</div>
						</div>

                    </div>
                    <div class="content">
                    	<div class="row">
                    		<div class="col-lg-4">
                    			
							<h4><span class="currency text-success"></span><span class="accountbalance text-success"></span></h4>
							<small><b><?php echo trans('lang.account_balance');?></b></small>
							</div>
							<div class="col-lg-8">
								<canvas  id="accountgraph" height="50"></canvas>
							</div>
                    	</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h5 class="title"><?php echo trans('lang.account_transaction_report');?></h5>
							</div>
							
						</div>
						<hr>
                    </div>
                    <div class="content">
                    	<div class="table-responsive">
                    	<table id="data" class="table table-striped table-bordered"  cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.income');?></th>
									<th><?php echo trans('lang.expense');?></th>										
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
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
    </div>
</div>	

<!--delete data -->
 <div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('lang.delete');?></h4>
        </div>
        <div class="modal-body">
		<form action="" method="POST">
		  <p class="text-danger"><?php echo trans('lang.delete_warning');?></p>	
          <p><?php echo trans('lang.delete_confirm');?></p>
		  <input type="hidden" value={{ $id }} name="iddelete" id="iddelete"/>
		  </form>
        </div>
        <div class="modal-footer">
		   <input type="submit" class="btn btn-primary" id="dodelete" value="<?php echo trans('lang.delete');?>"/>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
        </div>
      </div>
    </div>
  </div>
 <!--edit data -->
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" method="post" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.edit_account');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                <div class="form-group">
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?php echo trans('lang.name');?>" data-validation="required">
                </div>
                <div class="form-group">
                  <label><?php echo trans('lang.opening_balance');?></label>
                   <div class="input-group">
						<span class="input-group-addon currency" style="border: 1px solid #cecece;"></span>                                   
						<input class="form-control number" required="" placeholder="<?php echo trans('lang.opening_balance');?>" id="editbalance" name="editbalance" type="text" placeholder="Amount">
					</div>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="<?php echo $id;?>" name="id" id="idedit"/>
                <input type="submit" class="btn btn-primary" id="saveedit" value="<?php echo trans('lang.save');?>"/>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
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
			$(".currency").html(objs[0].currency);
			
        },
    });

    //get currency
    
    var id = $("#idbank").val();
	$.ajax({
        type: "GET",
        url: "{{ url('account/getdatadetail/'.$id)}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			console.log(html);
			$(".accountnumber").html(html.accountnumber);
			$(".bankname").html(html.name);
			$(".accountbalance").html(html.balance);
			
        },
    });
   
   $.ajax({
        type: "GET",
        url: "{{ url('account/accountbalancebymonth/'.$id)}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var cincomevsexpense = document.getElementById("accountgraph");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: "<?php echo trans('lang.balance');?>",
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: 'rgba(54, 162, 235, 0.2)',
						borderColor: 'rgba(54, 162, 235, 0.2)',
						borderWidth: 3
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

   //load data
   //get data
    var table = $('#data').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter : false,
            ajax: {
				url : "{{ url('account/getaccounttransaction/'.$id)}}",
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
				{ data: 'transactiondate', name:'transactiondate'},
				{ data: 'name', name:'name'},
				{ data: 'category', name:'category'},
				{ data: 'subcategory', name:'subcategory'},
				{ data: 'reference', name:'reference'},				
				{ data: 'description', name:'description'},		
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
	
	//dosave
	$("#save").click(function(e){
		
		var name=$("#name").val();
		var balance=$("#balance").val();
		var description=$("#description").val();
		
		if(name =='' || balance ==''){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('account/save')}}",
            data: {name:name,balance:balance,description:description},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message2").css({'display':"block"});
				$('#add').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	//dosave edit
	$("#saveedit").click(function(e){
		
		var name=$("#editname").val();
		var balance=$("#editbalance").val();
		var description=$("#editdescription").val();
		var id=$("#idedit").val();
		if(name =='' || balance ==''){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('account/edit')}}",
            data: {id:id,name:name,balance:balance,description:description},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message4").css({'display':"block"});
				$('#edit').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	
} );
	//delete function
	$("#dodelete").click(function(e){
		
		var id=$("#iddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('account/delete')}}",
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message3").css({'display':"block"});
				$('#delete').modal('hide');
				location.href="{{ url('account')}}";
            }
		});
	});
	

		//for get id to modal

		
		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            
			$.ajax({
				type: "POST",
				url: "{{ url('account/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#idedit").val(id);
					$("#editname").val(data.message[0].name);
					$("#editbalance").val(data.message[0].balance);
					$("#editdescription").val(data.message[0].description);
				}
			});
		
		
        });
		
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