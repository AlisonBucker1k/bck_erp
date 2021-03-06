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
							<h4 class="title">Clientes</h4>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> Novo Cliente</a></div>
							</div>
						</div>
						<hr>
                    </div>
                    <div class="content">
                    	
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
						<div class="table-responsive">
						<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.account_id');?></th>
									<th>nome</th>
									<th>CPF</th>
									<th>Bairro</th>
									<th>Telefone</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th><?php echo trans('lang.account_id');?></th>
									<th>nome</th>
									<th>CPF</th>
									<th>Bairro</th>
									<th>Telefone</th>
									<th>
									</th>
								</tr>
							</tfoot>
							<tbody>
								@foreach ($customers as $costumer)
									<tr>
										<td>{{ $costumer->id }}</td>
										<td>{{ $costumer->name }}</td>
										<td>{{ $costumer->cpf }}</td>
										<td>{{ $costumer->neighborhood }}</td>
										<td>{{ $costumer->phone }}</td>
										<td>
											<a href="{{ route('customers.remove', $costumer->id) }}" data-toggle="modal" class="btn btn-sm btn-fill btn-danger"><i class="ti-trash"></i> Remover</a>
											<a href="{{ route('customers.edit', $costumer->id) }}" data-toggle="modal" class="btn btn-sm btn-fill btn-warning"><i class="ti-pencil"></i> Editar</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>	
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{route('customers.insert')}}" method="post">
				
				{{ csrf_field() }}

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Adicionar Novo Cliente</h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                <div class="form-group">
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="name"  id="name" placeholder="Nome do Cliente" data-validation="required">
                </div>
				<div class="form-group">
					<label>CPF</label>
					<input type="text" class="form-control" name="cpf"  id="" placeholder="CPF">
				  </div>
				<div class="form-group">
					<label>CEP</label>
					<input class="form-control"  placeholder="CEP" id="zipcode" name="zipcode" type="text">
				</div>
               	<div class="form-group">
					<label>Rua</label>
					<input class="form-control" placeholder="Rua" id="street" name="street" type="text">
				</div>
                 <div class="form-group">
                  <label>Bairro</label>
				  <input class="form-control" placeholder="Bairro" id="neighborhood" name="neighborhood" type="text">
                </div>
				<div class="form-group">
					<label>Cidade</label>
					<input class="form-control" placeholder="Cidade" id="" name="city" type="text">
				</div>
				<div class="form-group">
					<label>N??mero</label>
					<input class="form-control" placeholder="N??mero" id="number" name="number" type="text">
				</div>
				
				 <div class="form-group">
                  <label>Refer??ncias</label>
                  <textarea class="form-control" name="details" id="details" placeholder="Cidade" rows="20"></textarea>
                </div>
				<div class="form-group">
					<label>Telefone</label>
					<input class="form-control"  placeholder="Telefone" id="" name="phone" type="text">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" placeholder="Email" id="email" name="email" type="email">
				  </div>
              </div>
              <div class="modal-footer">
				
                <input type="submit" class="btn btn-primary" value="<?php echo trans('lang.save');?>"/>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
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
		  <input type="hidden" value="" name="iddelete" id="iddelete"/>
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
                <h4 class="modal-title"><?php echo trans('lang.edit');?></h4>
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
                  <label><?php echo trans('lang.account_number');?></label>
				  <input class="form-control" required="" placeholder="<?php echo trans('lang.account_number');?>" id="editaccountnumber" name="editaccountnumber" type="text">
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
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
   
   //load data
  	$('#data').DataTable();
    // $('#data').DataTable( {
		
	// 	processing: true,
	// 	serverSide: true,
	// 	ajax: "{{ url('/customers/getList')}}",
	// 	"language": {
	// 	"decimal":        "",
	// 		"emptyTable":     "<?php echo trans('lang.demptyTable');?>",
	// 		"info":           "<?php echo trans('lang.dshowing');?> _START_ <?php echo trans('lang.dto');?> _END_ <?php echo trans('lang.dof');?> _TOTAL_ <?php echo trans('lang.dentries');?>",
	// 		"infoEmpty":      "<?php echo trans('lang.dinfoEmpty');?>",
	// 		"infoFiltered":   "(<?php echo trans('lang.dfilter');?> _MAX_ <?php echo trans('lang.total');?> <?php echo trans('lang.dentries');?>)",
	// 		"infoPostFix":    "",
	// 		"thousands":      ",",
	// 		"lengthMenu":     "<?php echo trans('lang.dshow');?> _MENU_ <?php echo trans('lang.dentries');?>",
	// 		"loadingRecords": "<?php echo trans('lang.dloadingRecords');?>",
	// 		"processing":     "<?php echo trans('lang.dprocessing');?>",
	// 		"search":         "<?php echo trans('lang.dsearch');?>",
	// 		"zeroRecords":    "<?php echo trans('lang.dzeroRecords');?>",
	// 		"paginate": {
	// 			"first":      "<?php echo trans('lang.dfirst');?>",
	// 			"last":       "<?php echo trans('lang.dlast');?>",
	// 			"next":       "<?php echo trans('lang.dnext');?>",
	// 			"previous":   "<?php echo trans('lang.dprevious');?>"
	// 		}
	// 	},
	// 	columns: [
	// 		{ data: 'id', orderable: false, searchable: false},
	// 		{ data: 'name'},
	// 		{data: 'neighborhood'},
	// 		{ data: 'zipcode'},
	// 		{data: 'action',  orderable: false, searchable: false}
	// 	],
	// 	dom: 'Bfrtipl',
	// 	buttons: [
	// 		{
	// 			extend: 'copy',
	// 			text:   'Copy <i class="fa fa-files-o"></i>',
	// 			title: '<?php echo trans('lang.account_list');?>',
	// 			className: 'btn btn-sm btn-fill btn-info ',
	// 			exportOptions: {
	// 				columns: [ 1, 2, 3 ]
	// 			}
	// 		}, 
	// 		{
	// 			extend:'csv',
	// 			text:   'CSV <i class="fa fa-file-excel-o"></i>',
	// 			title: '<?php echo trans('lang.account_list');?>',
	// 			className: 'btn btn-sm btn-fill btn-info ',
	// 			exportOptions: {
	// 				columns: [  1, 2, 3 ]
	// 			}
	// 		},
	// 		{
	// 			extend:'pdf',
	// 			text:   'PDF <i class="fa fa-file-pdf-o"></i>',
	// 			title: '<?php echo trans('lang.account_list');?>',
	// 			orientation:'landscape',
	// 			className: 'btn btn-sm btn-fill btn-info ',
	// 			exportOptions: {
	// 				columns: [  1, 2, 3 ]
	// 			},
	// 			customize : function(doc){
	// 				doc.styles.tableHeader.alignment = 'left';
	// 				doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
	// 			}
	// 		},
	// 		{
	// 			extend:'print',
	// 			title: '<?php echo trans('lang.account_list');?>',
	// 			text:   'Print <i class="fa fa-print"></i>',
	// 			className: 'btn btn-sm btn-fill btn-info ',
	// 			exportOptions: {
	// 				columns: [ 1, 2, 3 ]
	// 			}
	// 		}
	// 	]
    // } );
	
	//dosave
	// $("#save").click(function(e){
		
	// 	var name=$("#name").val();
    //     var street=$("#street").val();
    //     var neighborhood=$("#neighborhood").val();
	// 	var city=$("#city").val();
	// 	var number=$("#number").val();
	// 	var details = $("#details").val();
    //     var zipcode = $("#zipcode").val();
    //     var phone = $("#phone").val();
    //     var cpf = $("#cpf").val();
    //     var email = $("#email").val();
	// 	if(name =='' || balance ==''){
	// 		$("#message").css({'display':"block"});
	// 		return false;
	// 	}
	// 	e.preventDefault();
	// 	$.ajax({
	// 		type: "POST",
    //         url: "{{ url('customer/insert')}}",
	// 		headers: {
	// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 		}
    //         data: {name:name,balance:balance,description:description,accountnumber:accountnumber},
    //         dataType: "JSON",
    //         success: function(data) {
	// 			$("#message2").css({'display':"block"});
	// 			$('#add').modal('hide');
	// 			window.setTimeout(function(){location.reload()},2000)
    //         }
	// 	});
	// });
	//dosave edit
	$("#saveedit").click(function(e){
		
		var name=$("#editname").val();
		var balance=$("#editbalance").val();
		var description=$("#editdescription").val();
		var accountnumber = $("#editaccountnumber").val();
		var id=$("#idedit").val();
		if(name =='' || balance ==''){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('account/edit')}}",
            data: {id:id,name:name,balance:balance,description:description,accountnumber:accountnumber},
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
				window.setTimeout(function(){location.reload()},2000)
            }
		});
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
				url: "{{ url('account/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#idedit").val(id);
					$("#editname").val(data.message[0].name);
					$("#editbalance").val(data.message[0].balance);
					$("#editdescription").val(data.message[0].description);
					$("#editaccountnumber").val(data.message[0].accountnumber);
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