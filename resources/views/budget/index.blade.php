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
							<h4 class="title"><?php echo trans('lang.budget_list');?></h4>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> Add Budget</a></div>
							</div>
						</div>
                    </div>
                    <div class="content">
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
						<div class="table-responsive">
						<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th></th>
									<th>Budget ID</th>
									<th>Original</th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.month');?></th>
									<th><?php echo trans('lang.action');?></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th></th>
									<th>Budget ID</th>
									<th>Original</th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.month');?></th>
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
			  <div id="messageerror" style="display:none;" class="alert alert-warning"></div>
              <div class="modal-body">
               <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.month');?></label>
					    <select disabled id="editmonths" class="form-control">
							<option value="01"><?php echo trans('lang.jan');?></option>
							<option value="02"><?php echo trans('lang.feb');?></option>
							<option value="03"><?php echo trans('lang.mar');?></option>
							<option value="04"><?php echo trans('lang.apr');?></option>
							<option value="05"><?php echo trans('lang.may');?></option>
							<option value="06"><?php echo trans('lang.jun');?></option>
							<option value="07"><?php echo trans('lang.jul');?></option>
							<option value="08"><?php echo trans('lang.aug');?></option>
							<option value="09"><?php echo trans('lang.sep');?></option>
							<option value="10"><?php echo trans('lang.oct');?></option>
							<option value="11"><?php echo trans('lang.nov');?></option>
							<option value="12"><?php echo trans('lang.dec');?></option>
						</select>

					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.year');?></label>
					    <select disabled id="edityears" class="form-control">
						<?php
for ( $i = date( "Y" ); $i < date( "Y" )+10; $i++ ) {
	echo "<option value=$i>" . $i . "</option>";
}
?>
						</select>
					</div>
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.category');?></label>
						<select disabled id="editcategory" class="form-control">
							<option value=""><?php echo trans('lang.select_a_category');?></option>
							<optgroup label="<?php echo trans('lang.income');?>" id="income">
							</optgroup>
							<optgroup label="<?php echo trans('lang.expense');?>" id="expense">
							</optgroup>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label><small class="req text-danger">* </small><?php echo trans('lang.sub_category');?></label>
							<select disabled id="editsubcategory" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label>
					<div class="input-group">
						<span class="input-group-addon currency" style="border: 1px solid #cecece;"></span>
						<input class="form-control number" id="editamount" name="editamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
					</div>
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

<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" method="post" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.add_budget');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="exist" style="display:none;" class="alert alert-warning"><?php echo trans('lang.budget_already');?></div>
              <div class="modal-body">
			    <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.month');?></label>
					    <select id="months" class="form-control">
							<option value="01"><?php echo trans('lang.jan');?></option>
							<option value="02"><?php echo trans('lang.feb');?></option>
							<option value="03"><?php echo trans('lang.mar');?></option>
							<option value="04"><?php echo trans('lang.apr');?></option>
							<option value="05"><?php echo trans('lang.may');?></option>
							<option value="06"><?php echo trans('lang.jun');?></option>
							<option value="07"><?php echo trans('lang.jul');?></option>
							<option value="08"><?php echo trans('lang.aug');?></option>
							<option value="09"><?php echo trans('lang.sep');?></option>
							<option value="10"><?php echo trans('lang.oct');?></option>
							<option value="11"><?php echo trans('lang.nov');?></option>
							<option value="12"><?php echo trans('lang.dec');?></option>
						</select>

					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.year');?></label>
					    <select id="years" class="form-control">
						<?php
for ( $i = date( "Y" ); $i < date( "Y" )+10; $i++ ) {
	echo "<option value=$i>" . $i . "</option>";
}
?>
						</select>
					</div>
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.category');?></label>
						<select id="category" class="form-control">
							<option value=""><?php echo trans('lang.select_a_category');?></option>
							<optgroup label="<?php echo trans('lang.income');?>" id="income">
							</optgroup>
							<optgroup label="<?php echo trans('lang.expense');?>" id="expense">
							</optgroup>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label><small class="req text-danger">* </small><?php echo trans('lang.sub_category');?></label>
							<select id="subcategory" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label>
					<div class="input-group">
						<span class="input-group-addon currency" style="border: 1px solid #cecece;"></span>
						<input class="form-control number"  placeholder="Amount" id="amount" name="amount" type="text" placeholder="<?php echo trans('lang.amount');?>">
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
                $("#category #income").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#editcategory #income").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
            });
        },
    });

	//get expense category
	$.ajax({
        type: "GET",
        url: "{{ url('expensecategory/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#category #expense").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#editcategory #expense").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
            });
        },
    });

	//get  sub category
	$("select#category.form-control").change(function(){
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
				$('#subcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#subcategory').html(options);
			
			},
		});
	});

	//get  sub category
	$("select#editcategory.form-control").change(function(){
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
				$('#editsubcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#editsubcategory').html(options);
			},
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



	//dosave
	$("#save").click(function(e){
		var months=$("#months").val();
		var years=$("#years").val();
		var subcategory=$("#subcategory").val();
		var amount=$("#amount").val();

		if(months =='' || years =='' || subcategory=='' || amount==''){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('budget/save')}}",
            data: {months:months,years:years,subcategory:subcategory,amount:amount},
            dataType: "JSON",
            success: function(data) {
				console.log(data);
				if(data.message=='0'){
					$("#exist").css({'display':"block"});
					//return false;
				}
				if(data.message=='1'){
					$("#message2").css({'display':"block"});
					$('#add').modal('hide');
					window.setTimeout(function(){location.reload()},2000)
				}
            }
		});
	});
	//get data
    $('#data').DataTable( {

			processing: true,
			serverSide: true,
            ajax: "{{ url('budget/getdata')}}",
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
				{
                "class":          "details-control",
                "orderable":      false,
				"searchable":      false,
                "data":           null,
                "defaultContent": ""
				},
				{ data: 'budgetid', orderable: false, searchable: false, visible: false},
				{ data: 'originalamount', orderable: false, searchable: false, visible: false},
				{ data: 'category'},
				{ data: 'subcategory'},
				{ data: 'amount'},
				{ data: 'fromdate'},
				{data: 'action',  orderable: false, searchable: false}
			],
			dom: 'Bfrtipl',
			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.budget_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				},
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.budget_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.budget_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [3, 4, 5, 6 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				}
			]
    } );


	function format ( d ) {
	return '<div class="col-lg-6"><table cellpadding="10" cellspacing="0" border="0"  class="table-hover" style="padding-left:50px;">'+
			'<div class="">'+
				'<h4 style="font-weight: 500;color: #c7cbd5;"><?php echo trans('lang.budget_remaining');?></h4>'+
			'</div>'+
			'<h3 style="font-weight: 500;" class="text-left">'+
				'<span class="money-area"><span style="font-weight:bold;" id="currencybudget"></span><span  style="font-weight:bold;" id="remainingbudget"></span></span>'+
			'</h3>'+
			'<div class="row">'+
					'<div class="col-xs-6">'+
						'<small class="text-uppercase text-bold text-primary"><?php echo trans('lang.planned');?></small>'+
							'<h5>'+d.amount+'</h5>'+
					'</div>'+
					'<div class="col-xs-6">'+
						'<small class="text-uppercase text-bold text-success"><?php echo trans('lang.actual');?></small>'+
							'<h5><span id="actualbudget"></span></h5>'+
					'</div>'+
			'</div>'+
			'<small><?php echo trans('lang.created_by');?>: <b>'+d.user+'</b></small>'+
    '</table></div><div class="col-lg-4 pull-right"><div id="chart"></div></div>';


}

	// Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#data tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
		var table = $('#data').DataTable();
        var row = table.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );

        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
			var id = row.data().categoryid;
			var date = row.data().fromdate;
			//start search by id expense/income category detail
			$.ajax({
				type: "POST",
				url: "{{ url('budget/gettransactionbydate')}}",
				data: {id:id,date:date},
				dataType: "JSON",
				success: function(data) {
					var remaining = row.data().originalamount - data.totalamount;
					$("#currencybudget").html(data.currency);
					$("#actualbudget").html(data.amountcurrency);
					$("#remainingbudget").html( remaining.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					Morris.Donut({
					  element: 'chart',
					  data: [
						{label: "<?php echo trans('lang.planned');?>", value: row.data().originalamount},
						{label: "<?php echo trans('lang.actual');?>", value: data.totalamount}
					  ],
					  colors: ['#00E676','#82B1FF']
					});

				}
			});


            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    $('#data').on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );

	//dosave edit
	$("#saveedit").click(function(e){

		var id=$("#idedit").val();
		var months=$("#editmonths").val();
		var years=$("#edityears").val();
		var subcategory=$("#editsubcategory").val();
		var amount=$("#editamount").val();

		if(months =='' || years =='' || subcategory=='' || amount==''){
			$("#message").css({'display':"block"});
			return false;
		}

		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('budget/edit')}}",
            data: {id:id,months:months,years:years,subcategory:subcategory,amount:amount},
             success: function(data) {
				console.log(data);
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
            url: "{{ url('budget/delete')}}",
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
				url: "{{ url('budget/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#expensename").val(data.message[0].name);
					$("#editamount").val(data.message[0].amount);
					$("#editmonths").val(data.months);
					$("#edityears").val(data.years);
					$("#editcategory").val(data.message[0].realcategoryid);
					$('#editcategory').trigger("change");
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


</script>
@endsection
