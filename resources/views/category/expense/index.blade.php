@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
	
        <div class="row">
		<div class="card col-lg-12">
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cat"><?php echo trans('lang.category');?></a></li>
		  <li><a data-toggle="tab" href="#subcat"><?php echo trans('lang.sub_category');?></a></li>
		</ul>
			<div class="tab-content">
			 <div id="cat" class="tab-pane fade in active">
				<div class="col-lg-12 col-md-11">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h4 class="title"><?php echo trans('lang.expense_category_list');?></h4>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_expense_category');?></a></div>
							</div>
						</div>
						
                    </div>
                    <div class="content">
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
					<div id="message10" style="display:none" class="alert alert-danger"><?php echo trans('lang.category_cannot_deleted');?></div>
						<div class="table-responsive">
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Category ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.color');?></th>
									<th><?php echo trans('lang.action');?></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Category ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.color');?></th>
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
			<!--sub category-->
			 <div id="subcat" class="tab-pane fade">
				<div class="col-lg-12 col-md-11">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h4 class="title"><?php echo trans('lang.expense_sub_category_list');?></h4>
							</div>
							<div class="col-lg-6">
							<div class="pull-right"><a href="#'" data-toggle="modal" data-target="#addsub" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_sub_expense_category');?></a></div>
							</div>
						</div>
						
                    </div>
                    <div class="content">
					<div id="message6" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message7" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message8" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
					<div id="message9" style="display:none" class="alert alert-danger"><?php echo trans('lang.subcategory_cannot_deleted');?></div>
						<div class="table-responsive">
            <table id="datasub" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.sub_category_id');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.action');?></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th><?php echo trans('lang.sub_category_id');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
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
    </div>
</div>	
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.add_expense_category');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				
                <div class="form-group">
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="name"  id="name" placeholder="<?php echo trans('lang.name');?>" data-validation="required">
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="description" id="description" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
				<div class="form-group">
                  <label><?php echo trans('lang.color');?></label>
                  <input type="text" class="form-control jscolor" name="color"  id="color" placeholder="<?php echo trans('lang.color');?>" data-validation="required">
                </div>
              </div>
              <div class="modal-footer">
				
                <button type="button" class="btn btn-primary" id="save"><?php echo trans('lang.save');?></button>
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
            <form action="#"  id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.edit_expense_category');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                <div class="form-group">
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?php echo trans('lang.name');?>" data-validation="required">
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
				<div class="form-group">
                  <label><?php echo trans('lang.color');?></label>
                  <input type="text" class="form-control jscolor" name="editcolor"  id="editcolor" placeholder="<?php echo trans('lang.color');?>" data-validation="required">
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
<!--subcat-->	  
<!--add new data -->
<div id="addsub" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.add_sub_expense_category');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				<div class="form-group">
                  <label><?php echo trans('lang.category');?></label>
                 <select id="category" class="form-control" required>
				 </select>
                </div>
                <div class="form-group">
                  <label><?php echo trans('lang.sub_category');?></label>
                  <input type="text" class="form-control" name="name"  id="subname" placeholder="<?php echo trans('lang.sub_category');?>" data-validation="required">
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="description" id="subdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
				
                <button type="button" class="btn btn-primary" id="subsave"><?php echo trans('lang.save');?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
<!--delete data -->
 <div class="modal fade" id="deletesub" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('lang.delete');?></h4>
        </div>
        <div class="modal-body">
		<form action="" method="POST">
          <p><?php echo trans('lang.delete_confirm');?></p>
		  <input type="hidden" value="" name="iddelete" id="subiddelete"/>
		  </form>
        </div>
        <div class="modal-footer">
		   <input type="submit" class="btn btn-primary" id="subdodelete" value="<?php echo trans('lang.delete');?>"/>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
        </div>
      </div>
    </div>
  </div>
 <!--edit data -->
<div id="editsub" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#"  id="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('lang.edit_sub_expense_category');?></h4>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				<div class="form-group">
                  <label><?php echo trans('lang.category');?></label>
                 <select id="editcategory" class="form-control" required>
				 </select>
                </div>
                <div class="form-group">
                  <label><?php echo trans('lang.sub_category');?></label>
                  <input type="text" class="form-control" name="editname"  id="subeditname" placeholder="<?php echo trans('lang.sub_category');?>" data-validation="required">
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="subeditdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="subidedit"/>
                <button type="button" class="btn btn-primary" id="subsaveedit"><?php echo trans('lang.save');?></button>
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
    $.ajax({
        type: "GET",
        url: "{{ url('expensecategory/getdata')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			//var objs = jQuery.parseJSON(html);
			var objs = html.data;
            jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#addsub #category").append($("<option></option>")
                    .attr("value",id)
                    .text(name)); 
                $("#editcategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name)); 
                
            });
        },
    });

    $('#data').DataTable( {
			
			processing: true,
			serverSide: true,
            ajax: "{{ url('expensecategory/getdata')}}",
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
				{ data: 'categoryid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{ data: 'description'},
				{ data: 'color', orderable: false, searchable: false},
				{data: 'action',  orderable: false, searchable: false}
			],
			dom: 'Bfrtipl',
			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					title: '<?php echo trans('lang.expense_category_list');?>',
					exportOptions: {
						columns: [ 1, 2]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					title: '<?php echo trans('lang.expense_category_list');?>',
					exportOptions: {
						columns: [  1, 2]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					title: '<?php echo trans('lang.expense_category_list');?>',
					orientation:'landscape',
					exportOptions: {
						columns: [  1, 2]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.expense_category_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					text:   'Print <i class="fa fa-print"></i>',
					exportOptions: {
						columns: [ 1, 2]
					}
				}
			]
    } );
	
	//sub category datatables
	$('#datasub').DataTable( {
			
			processing: true,
			serverSide: true,
            ajax: "{{ url('expensecategory/subgetdata')}}",
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
				{ data: 'subcategoryid', orderable: false, searchable: false},
				{ data: 'category'},
				{ data: 'name'},
				{ data: 'description'},
				{data: 'action',  orderable: false, searchable: false}
			],
			dom: 'Bfrtipl',
			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.expense_sub_category_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 1, 2, 3]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.expense_sub_category_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [  1, 2, 3]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.expense_sub_category_list');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					orientation:'landscape',
					exportOptions: {
						columns: [  1, 2, 3]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.expense_sub_category_list');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 1, 2, 3]
					}
				}
			]
    } );
	//dosave
	$("#subsave").click(function(){
		var category=$("#addsub #category").val();
		var name=$("#subname").val();
		var description=$("#subdescription").val();
		if(category=='' || name ==''){
			$("#message").css({'display':"block"});
			return false;
		}
		$.ajax({
			method: "POST",
            url: "{{ url('expensecategory/subsave')}}",
            data: {category:category,name:name,description:description},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message6").css({'display':"block"});
				$('#addsub').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	
	//dosave
	$("#save").click(function(){
		var name=$("#name").val();
		var description=$("#description").val();
		var color=$("#color").val();
		if(name ==''|| color=='' ){
			$("#message").css({'display':"block"});
			return false;
		}
		$.ajax({
			method: "POST",
            url: "{{ url('expensecategory/save')}}",
            data: {name:name,color:color,description:description},
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
	$("#subsaveedit").click(function(e){
		
		var name=$("#subeditname").val();
		var description=$("#subeditdescription").val();
		var category=$("#editsub #editcategory").val();
		var id=$("#editsub #subidedit").val();
		if(name ==''){
			$("#editsub #message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('expensecategory/subedit')}}",
            data: {id:id,category:category,name:name,description:description},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message8").css({'display':"block"});
				$('#editsub').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	
	//dosave edit
	$("#saveedit").click(function(e){
		var name=$("#editname").val();
		var description=$("#editdescription").val();
		var color=$("#editcolor").val();
		var id=$("#idedit").val();
		if(name =='' || color ==''){
			$("#edit #message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('expensecategory/edit')}}",
            data: {id:id,color:color,name:name,description:description},
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
	$("#subdodelete").click(function(e){
		
		var id=$("#subiddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('expensecategory/subdelete')}}",
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				var success = data.success;
				if(success=='false'){
					$("#message9").css({'display':"block"});
				} 
				if(success=='true'){
					$("#message7").css({'display':"block"});
				}
				$('#deletesub').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
				
            }
		});
	});
	//delete function
	$("#dodelete").click(function(e){	
		var id=$("#iddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('expensecategory/delete')}}",
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				var success = data.success;
				if(success=='false'){
					$("#message10").css({'display':"block"});
				} 
				if(success=='true'){
					$("#message3").css({'display':"block"});
				}
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
		
		$('#deletesub').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#subiddelete").val(id);
        });
		
		//for get id to modal edit

		$('#editsub').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
			$.ajax({
				type: "POST",
				url: "{{ url('expensecategory/subgetedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#editsub #subidedit").val(id);
					$("#editsub #editcategory").val(data.message[0].categoryid);
					$("#subeditname").val(data.message[0].name);
					$("#subeditdescription").val(data.message[0].description);
				}
			});
		
        });
		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
			$.ajax({
				type: "POST",
				url: "{{ url('expensecategory/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#idedit").val(id);
					$("#editname").val(data.message[0].name);
					$("#editdescription").val(data.message[0].description);
					$("#editcolor").val(data.color);
				}
			});

        });
		



</script>
@endsection