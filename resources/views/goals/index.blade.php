 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
	
        <div class="row">

            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h4 class="title"><?php echo trans('lang.goal_list');?></h4>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_goal');?></a></div>
							</div>
						</div>
                    </div>
                    <div class="content">
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
					<div id="msgdeposit" style="display:none" class="alert alert-success"><?php echo trans('lang.deposit_added');?></div>
						<div class="table-responsive">
						<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>

									<th>Goal ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.opening');?></th>
									<th><?php echo trans('lang.target');?></th>
									<th><?php echo trans('lang.remaining');?></th>
									<th><?php echo trans('lang.date');?></th>									
									<th><?php echo trans('lang.action');?></th>
								</tr>
							</thead>
							<tfoot>
								<tr>

									<th>Goal ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.opening');?></th>
									<th><?php echo trans('lang.target');?></th>
									<th><?php echo trans('lang.remaining');?></th>
									<th><?php echo trans('lang.date');?></th>									
									<th><?php echo trans('lang.action');?></th>
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
          <h4 class="modal-title"><?php echo trans('lang.delete_data');?></h4>
        </div>
        <div class="modal-body">
		<form action="" method="POST">
          <p><?php echo trans('lang.delete_confirm');?></p>
		  <input type="hidden" value="" name="iddelete" id="iddelete"/>
		  </form>
        </div>
        <div class="modal-footer">
		   <input type="submit" class="btn btn-primary" id="dodelete" value="<?php echo trans('lang.delete_data');?>"/>
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
                <h4 class="modal-title"><?php echo trans('lang.edit');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="messageerror" style="display:none;" class="alert alert-warning"></div>
              <div class="modal-body">
               <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
					    <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?php echo trans('lang.name');?>">
					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required="" placeholder="<?php echo trans('lang.opening_balance');?>" id="editopening" name="editopening" type="text" >
						</div>
					</div>
					
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.target');?></label>
						<div class="input-group">
							<span class="input-group-addon currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required="" placeholder="<?php echo trans('lang.target');?>" id="edittarget" name="edittarget" type="text" >
						</div>
					</div>
					<div class="form-group col-lg-6" id="targetdate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.target_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="edate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
					</div>
				</div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-primary" id="saveedit"><?php echo trans('lang.save');?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
          </div>
        </div>
      </div> 
  
</div>	
<!-- Make deposit -->
<div id="deposit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <form action="" method="post" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.deposit');?></h4>
              </div>
			  <div id="errordeposit" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
			    <div class="row">
					<div class="form-group col-lg-12">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.deposit');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required="" placeholder="<?php echo trans('lang.deposit');?>" id="depositvalue" name="depositvalue" type="text" >
						</div>
					</div>
				</div>

              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="iddeposit"/>
                <input type="submit" class="btn btn-primary" id="dodeposit" value="<?php echo trans('lang.save');?>"/>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
          </div>
        </div>
      </div>  
	  
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" method="post" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.add_goal');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
			    <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
					    <input type="text" class="form-control" name="name"  id="name" placeholder="<?php echo trans('lang.name');?>">
					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required="" placeholder="<?php echo trans('lang.opening_balance');?>" id="opening" name="opening" type="text" >
						</div>
					</div>
					
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.target');?></label>
						<div class="input-group">
							<span class="input-group-addon currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required="" placeholder="<?php echo trans('lang.target');?>" id="target" name="target" type="text" >
						</div>
					</div>
					<div class="form-group col-lg-6" id="targetdate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.target_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="tdate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
					</div>
				</div>
              </div>
              <div class="modal-footer">
				
                <input type="submit" class="btn btn-primary" id="save" value="<?php echo trans('lang.save');?>"/>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
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
   

		
	//dosave
	$("#save").click(function(e){
		var name=$("#name").val();
		var opening=$("#opening").val();
		var target=$("#target").val();
		var deadline=$("#tdate").val();
		
		if(name =='' || opening =='' || target=='' || deadline==''){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('goals/save')}}",
            data: {name:name,opening:opening,target:target,deadline:deadline},
            dataType: "JSON",
            success: function(data) {
				console.log(data);

					$("#message2").css({'display':"block"});
					$('#add').modal('hide');
					window.setTimeout(function(){location.reload()},2000)
				
            }
		});
	});	
	//get data
    $('#data').DataTable( {
			
			processing: true,
			serverSide: true,
            ajax: "{{ url('goals/getdata')}}",
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
				{ data: 'goalsid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{ data: 'balance'},
				{ data: 'amount'},				
				{ data: 'remaining',  orderable: false, searchable: false},		
				{ data: 'deadline'},
				{data: 'action',  orderable: false, searchable: false}
			],
			dom: 'Bfrtipl',
			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.goal_list');?>',
					className: 'btn btn-sm btn-fill btn-info',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.goal_list');?>',
					className: 'btn btn-sm btn-fill btn-info',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.goal_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill btn-info',
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
					},
					customize : function(doc){
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.goal_list');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				}
			]
    } );
	

	
	//dosave edit
	$("#saveedit").click(function(e){
		
		var id=$("#idedit").val();
		var name=$("#editname").val();
		var opening=$("#editopening").val();
		var target=$("#edittarget").val();
		var date=$("#edate").val();
		if(name =='' || opening =='' || target=='' || date==''){
			$("#message").css({'display':"block"});
			return false;
		}

		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('goals/edit')}}",
			dataType: "JSON",
            data: {id:id,name:name,opening:opening,target:target,date:date},
            success: function(data) {
				$("#message2").css({'display':"block"});
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
            url: "{{ url('goals/delete')}}",
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				$("#message3").css({'display':"block"});
				$('#delete').modal('hide');
				//$('#data').DataTable().ajax.reload();
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	
	//deposit function
	$("#dodeposit").click(function(e){
		
		var id		=$("#iddeposit").val();
		var deposit =$("#depositvalue").val();
	
		if(deposit ==''){
			$("#errordeposit").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('goals/deposit')}}",
            data: {id:id,deposit:deposit},
            dataType: "JSON",
            success: function(data) {
				$("#msgdeposit").css({'display':"block"});
				$('#deposit').modal('hide');
				//$('#data').DataTable().ajax.reload();
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
		
		
		//for deposit to modal
		$('#deposit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#iddeposit").val(id);
        });

		//for get id to modal

		$('#delete').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#iddelete").val(id);
        });
		
		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            
			$.ajax({
				type: "POST",
				url: "{{ url('goals/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#editname").val(data.message[0].name);
					$("#edittarget").val(data.message[0].amount);
					$("#edate").val(data.message[0].deadline);
					$("#editopening").val(data.message[0].balance);
					$("#idedit").val(id);
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

$('#targetdate #tdate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });	
$('#edate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });			

</script>
@endsection