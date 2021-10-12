@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
			
			<div class="col-lg-4 col-sm-6">
                <div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style="font-size:22px;">
                                    <p><?php echo trans('lang.due_this_month');?></p>
                                    <span class="currency"></span><span id="month"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>

                        </div>
                    </div>
                </div>
            </div>

			<div class="col-lg-4 col-sm-6">
                <div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div style="font-size:22px;">
                                    <p><?php echo trans('lang.due_this_week');?></p>
                                    <span class="currency"></span><span id="week"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>

                        </div>
                    </div>
                </div>
            </div>

			<div class="col-lg-4 col-sm-6">
                <div class="card background-red color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-stats-up"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div style="font-size:22px;">
                                    <p><?php echo trans('lang.due_today');?></p>
                                    <span class="currency"></span><span id="today"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h4 class="title"><?php echo trans('lang.upcomingexpense');?></h4>
							</div>
							<div class="col-lg-6">

							<div class="pull-right"><a href="#" class="btn btn-sm btn-fill btn-info" data-toggle="modal" data-target="#imports"><i class="ti-plus"></i> <?php echo trans('lang.add_new_expense');?></a></div>
							</div>
						</div>

                    </div>
                    <div class="content">
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
                        <div class="table-responsive">
						<table id="data" class="table  table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th></th>
									<th>ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>
									<th><?php echo trans('lang.category');?></th>

									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.action');?></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th></th>
									<th>ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>
									<th><?php echo trans('lang.category');?></th>

									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
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

<!--import data -->
 <div class="modal fade" id="imports" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('lang.add_new_upcoming_expense');?></h4>
        </div>
        <div class="modal-body">
        <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
        <div id="message2" style="display:none;" class="alert alert-success"><?php echo trans('lang.income_added');?></div>
        <div id="message3" style="display:none;"  class="alert alert-warning"></div>
		<form action="" method="POST">
          	 <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                      <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
                                      <input type="text" class="form-control" name="name"  id="incomename" placeholder="<?php echo trans('lang.name');?>">
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="incomeamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label> 
                                        <div class="input-group">
                                            <span class="input-group-addon" id="currency" style="border: 1px solid #cecece;"></span>                                      
                                            <input class="form-control number" required="" placeholder="Amount" id="incomeamount" name="incomeamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label><?php echo trans('lang.reference');?></label>
                                      <input type="text" class="form-control" name="incomereference"  id="incomereference" placeholder="<?php echo trans('lang.reference');?>">
                                    </div>
                                </div>
                            </div>              
                            <div class="row">   
                                <div class="form-group col-lg-6" id="incomedate">
                                    <label for="date" class="control-label"> 
                                    <small class="req text-danger">* </small><?php echo trans('lang.date');?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                        <input id="idate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>"/>
                                        <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                  <label><small class="req text-danger">* </small><?php echo trans('lang.income_category');?></label>
                                  <select id="incomecategory" class="form-control">
                                  <option value=""><?php echo trans('lang.select_a_category');?></option>
                                  </select>
                                </div>
                                <div class="form-group col-lg-6">
                                  <label><small class="req text-danger">* </small><?php echo trans('lang.income_sub_category');?></label>
                                  <select id="incomesubcategory" class="form-control"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                  <label><?php echo trans('lang.note');?></label>
                                  <textarea id="incomenote" class="form-control" placeholder="<?php echo trans('lang.note');?>"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                  <label><?php echo trans('lang.attach');?></label>
                                  <input type="file" name="incomefile"  class="form-control" id="incomefile"/>

                                </div>
                            </div>
                            
		  </form>
        </div>
        <div class="modal-footer">
		   <input type="submit" class="btn btn-primary" id="saveupcoming" value="<?php echo trans('lang.save_income');?>"/>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
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

<!--pay -->
 <div class="modal fade" id="pay" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('lang.pay_bill');?></h4>
        </div>
        <div class="modal-body">
           <div id="messagedopay" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
    <form action="" method="POST">
      <div class="row">
         <div class="form-group col-lg-12">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
                  <select id="incomeaccount" class="form-control">
                  <option value=""><?php echo trans('lang.account');?></option>
                  </select>
                </div>
        <input type="hidden" value="" name="idupcomingincome" id="idupcomingincome"/>
      </form>
        </div>
      </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-primary" id="dopay" value="<?php echo trans('lang.save');?>"/>
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
								<div class="col-lg-12">
									<div class="form-group">
									  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
									  <input type="text" class="form-control" name="editincomename"  id="editincomename" placeholder="<?php echo trans('lang.name');?>">
									 </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="editincomeamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label>
										<div class="input-group">
											<span class="input-group-addon" class="currency" id="editcurrency" style="border: 1px solid #cecece;"></span>
											<input class="form-control number" required="" placeholder="<?php echo trans('lang.amount');?>" id="editincomeamount" name="editincomeamount" type="text">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									  <label><?php echo trans('lang.reference');?></label>
									  <input type="text" class="form-control" name="editincomereference"  id="editincomereference" placeholder="<?php echo trans('lang.reference');?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6" id="editincomedate">
									<label for="date" class="control-label">
									<small class="req text-danger">* </small><?php echo trans('lang.date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="editidate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
		
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.income_category');?></label>
								  <select id="editincomecategory" class="form-control">
								  <option value=""><?php echo trans('lang.select_a_category');?></option>
								  </select>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.income_sub_category');?></label>
								  <select id="editincomesubcategory" class="form-control"></select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.note');?></label>
								  <textarea id="editincomenote" class="form-control" placeholder="<?php echo trans('lang.note');?>"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.attach');?></label>
								  <input type="file" name="editincomefile"  class="form-control" id="editincomefile"/>
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
        url: "{{ url('expensecategory/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#incomecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
                $("#editincomecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
            });
        },
    });


	//get income sub category
	$("#incomecategory").change(function(e){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: "{{ url('expensecategory/subgetdatabycat')}}",
        dataType: "json",
        data: {id:id},
        success: function (html) {
			var objs = html.message;
			var options;
			if (objs.length === 0) {
				$('#incomesubcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#incomesubcategory').html(options);
			},
		});
	});


  //get income sub category
  $("#editincomecategory").change(function(e){
    var id = $(this).val();
    $.ajax({
        type: "POST",
        url: "{{ url('expensecategory/subgetdatabycat')}}",
        dataType: "json",
        data: {id:id},
        success: function (html) {
      var objs = html.message;
      var options;
      if (objs.length === 0) {
        $('#editincomesubcategory').empty();
      }
      $.each(objs, function(index, object) {
          options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
        });
        $('#editincomesubcategory').html(options);
      },
    });
  });

	//get account
	$.ajax({
        type: "GET",
        url: "{{ url('account/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.accountid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#incomeaccount").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#expenseaccount").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
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
			$(".currency").html(objs[0].currency);
			$("#currency").html(objs[0].currency);
      $("#editcurrency").html(objs[0].currency);
        },
    });

	//get income

	$.ajax({
        type: "GET",
        url: "{{ url('upcomingexpense/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html;
			console.log(objs.day[0].totalday);
			$("#overall").html(objs.totalbalance);
			$("#month").html(objs.month);
			$("#today").html(objs.day);
			$("#week").html(objs.week);


        },
    });

	//get data
    $('#data').DataTable( {

			processing: true,
			serverSide: true,
            ajax: "{{ url('upcomingexpense/getdataupcoming')}}",
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
				{ data: 'transactionid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{ data: 'amount'},
				{ data: 'transactiondate'},
				{ data: 'category'},

				{ data: 'subcategory', orderable: false, searchable: false, visible: false},
				{ data: 'reference', orderable: false, searchable: false, visible: false},
				{ data: 'description', orderable: false, searchable: false, visible: false},
				{data: 'action',  orderable: false, searchable: false}
			],
			dom: 'Bfrtipl',
			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.income_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 2, 3, 4, 5, 6, 7, 8 ]
					}
				},
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.income_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [   2, 3, 4, 5, 6, 7, 8 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.income_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [   2, 3, 4, 5, 6, 7, 8 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.income_list');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [  2, 3, 4, 5, 6, 7, 8 ]
					}
				}
			]
    } );


	function format ( d ) {
	return '<table cellpadding="10" cellspacing="0" border="0"  class="table-hover" style="padding-left:50px;">'+

		'<tr class="info" height="30">'+
            '<td width="300"><?php echo trans('lang.reference');?>:</td>'+
            '<td>'+d.reference+'</td>'+
        '</tr >'+
		'<tr class="info" height="30">'+
            '<td><?php echo trans('lang.category');?>:</td>'+
            '<td>'+d.category+'</td>'+
        '</tr>'+
		'<tr class="info" height="30">'+
            '<td><?php echo trans('lang.sub_category');?>:</td>'+
            '<td>'+d.subcategory+'</td>'+
        '</tr>'+
		'<tr class="info" height="30">'+
            '<td><?php echo trans('lang.note');?>:</td>'+
            '<td>'+d.description+'</td>'+
        '</tr>'+
		'<tr class="info" height="30">'+
            '<td><small><i><?php echo trans('lang.created_by');?>:</i></small></td>'+
            '<td><small><i>'+d.user+'</i></small></td>'+
        '</tr>'+
    '</table>';


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


//dosave saveupcoming
    $("#saveupcoming").click(function(e){
        var form = new FormData();
        var name=$("#incomename").val();
        var amount=$("#incomeamount").val();
        var reference=$("#incomereference").val();
        var category=$("#incomecategory").val();
        var subcategory=$("#incomesubcategory").val();
        var date=$("#idate").val();
        var note=$("#incomenote").val();
        var file  = $('#incomefile')[0].files[0];
        
        form.append('incomename', name);
        form.append('incomeamount', amount);
        form.append('incomereference', reference);
        form.append('incomecategory', category);
        form.append('incomesubcategory', subcategory);
        form.append('incomenote', note);
        form.append('incomedate', date);
        form.append('incomefile', file);
        if(name =='' || amount =='' ||   category ==null || category =='' || subcategory =='' || subcategory ==null || date =='' ){
            $("#message").css({'display':"block"});
            return false;
        }
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('upcomingexpense/saveupcoming')}}",
            data: form,
            contentType: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function(data) {
                //console.log(data);
                $('#imports').modal('hide');
                $("#message2").css({'display':"block"});
                window.setTimeout(function(){location.reload()},2000)
            },
            error: function (error) {
                var errordata = error.responseJSON.incomefile[1];
                console.log(errordata);
                $("#message3").css({'display':"block"});
                $("#message3").html(errordata);
            }
        });
    });


	//dosave edit
	$("#saveedit").click(function(e){

		var form = new FormData();
		var id=$("#idedit").val();
		var name=$("#editincomename").val();
		var amount=$("#editincomeamount").val();
		var reference=$("#editincomereference").val();
		var category=$("#editincomecategory").val();
		var subcategory=$("#editincomesubcategory").val();
		var date=$("#editidate").val();
		var note=$("#editincomenote").val();
		var file  = $('#editincomefile')[0].files[0];

		form.append('id', id);
		form.append('editincomename', name);
		form.append('editincomeamount', amount);
		form.append('editincomereference', reference);
		form.append('editincomecategory', category);
		form.append('editincomesubcategory', subcategory);
		form.append('editincomenote', note);
		form.append('editincomedate', date);
		form.append('editincomefile', file);
		if(name =='' || amount =='' || category ==null || category =='' || subcategory =='' || subcategory ==null || date =='' ){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('upcomingexpense/edit')}}",
            data: form,
			contentType: 'multipart/form-data',
			processData: false,
            contentType: false,
             success: function(data) {
				
				$("#message2").css({'display':"block"});
        $('#edit').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            },
			error: function (error) {
				var errordata = error.responseJSON.incomefile[1];
				$("#messageerror").css({'display':"block"});
				$("#messageerror").html(errordata);
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
            url: "{{ url('expense/delete')}}",
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


    //delete function
  $("#dopay").click(function(e){

    var id=$("#idupcomingincome").val();
    var account=$("#incomeaccount").val();

    if(account==''){
      $("#messagedopay").css({'display':"block"});
      return false;
    }

    e.preventDefault();
    $.ajax({
      type: "POST",
            url: "{{ url('upcomingexpense/dopay')}}",
            data: {idincome:id,account:account},
            dataType: "JSON",
            success: function(data) {
        //$("#message").html(data);
        $("#message4").css({'display':"block"});
        $('#pay').modal('hide');
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

    $('#pay').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#idupcomingincome").val(id);
        });


		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');

			$.ajax({
				type: "POST",
				url: "{{ url('upcomingexpense/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#editincomename").val(data.message[0].name);
					$("#editincomeamount").val(data.message[0].amount);
					$("#editincomereference").val(data.message[0].reference);
					$("#editincomecategory").val(data.message[0].categoryid2);
					$('#editincomecategory').trigger("change");
					//$("#incomesubcategory").val(data.message[0].categoryid);
					$("#editidate").val(data.message[0].transactiondate);
					$("#editincomenote").val(data.message[0].description);
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

$('#idate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true,
            minDate: "0",
            maxDate: "+2Y",
            defaultDate: "+1w",
            numberOfMonths: 1 
        });
$('#editidate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true,
            minDate: "0",
            maxDate: "+2Y",
            defaultDate: "+1w",
            numberOfMonths: 1 
        });
</script>
@endsection
