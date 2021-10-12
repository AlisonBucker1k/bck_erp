@extends('layouts.app')
@section('content')
<div class="content">

        <div class="row">
			<div class="col-md-6">
				<div class="card">
							<div class="header">
								<h4 class="title"><?php echo trans('lang.income_transaction');?></h4> 
							</div>
							<div class="content">
							<div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
							<div id="message2" style="display:none;" class="alert alert-success"><?php echo trans('lang.income_added');?></div>
							<div id="message3" style="display:none;"  class="alert alert-warning"></div>
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
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
								  <select id="incomeaccount" class="form-control"></select>
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
							<div class="row text-center">
								<button id="incomesave" class="btn btn-info btn-fill btn-wd"/><?php echo trans('lang.save_income');?></button>
							</div>
					</div>
				</div>
			</div>
			
			<!--expense-->
			<div class="col-md-6">
				<div class="card">
							<div class="header">
								<h4 class="title"><?php echo trans('lang.expense_transaction');?></h4>
							</div>
							<div class="content">
							<div id="message6" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
							<div id="message7" style="display:none;" class="alert alert-success"><?php echo trans('lang.expense_added');?></div>
							<div id="message5" style="display:none;"  class="alert alert-warning"></div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
									  <input type="text" class="form-control" name="expensename"  id="expensename" placeholder="<?php echo trans('lang.name');?>">
									 </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="expenseamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label> 
										<div class="input-group">
											<span class="input-group-addon" id="expensecurrency" style="border: 1px solid #cecece;"></span>                                      
											<input class="form-control number" required="" placeholder="Amount" id="expenseamount" name="expenseamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									  <label><?php echo trans('lang.reference');?></label>
									  <input type="text" class="form-control" name="expensereference"  id="expensereference" placeholder="<?php echo trans('lang.reference');?>">
									</div>
								</div>
							</div>				
							<div class="row">	
								<div class="form-group col-lg-6" id="expensedate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="edate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
								  <select id="expenseaccount" class="form-control"></select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.expense_category');?></label>
								  <select id="expensecategory" class="form-control">
								  <option value=""><?php echo trans('lang.select_a_category');?></option>
								  </select>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.expense_sub_category');?></label>
								  <select id="expensesubcategory" class="form-control"></select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.note');?></label>
								  <textarea id="expensenote" class="form-control" placeholder="<?php echo trans('lang.note');?>"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.attach');?></label>
								  <input type="file" name="expensefile"  class="form-control" id="expensefile"/>
								</div>
							</div>
							<div class="row text-center">
								<button id="expensesave" class="btn btn-danger btn-fill btn-wd"/><?php echo trans('lang.save_expense');?></button>
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
			$("#currency").html(objs[0].currency);
			$("#expensecurrency").html(objs[0].currency);
			
        },
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
                $("#incomecategory").append($("<option></option>")
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
                $("#expensecategory").append($("<option></option>")
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
        url: "{{ url('incomecategory/subgetdatabycat')}}",
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
	
	//get expense sub category
	$("#expensecategory").change(function(e){
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
				$('#expensesubcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#expensesubcategory').html(options);
			},
		});
	});
  
	
	//dosave income
	$("#incomesave").click(function(e){
		var form = new FormData();
		var name=$("#incomename").val();
		var amount=$("#incomeamount").val();
		var reference=$("#incomereference").val();
		var account=$("#incomeaccount").val();
		var category=$("#incomecategory").val();
		var subcategory=$("#incomesubcategory").val();
		var date=$("#idate").val();
		var note=$("#incomenote").val();
		var file  = $('#incomefile')[0].files[0];
		
		form.append('incomename', name);
		form.append('incomeamount', amount);
		form.append('incomereference', reference);
		form.append('incomeaccount', account);
		form.append('incomecategory', category);
		form.append('incomesubcategory', subcategory);
		form.append('incomenote', note);
		form.append('incomedate', date);
		form.append('incomefile', file);
		if(name =='' || amount =='' || account =='' || account ==null || category ==null || category =='' || subcategory =='' || subcategory ==null || date =='' ){
			$("#message").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('transaction/saveincome')}}",
            data: form,
			contentType: 'multipart/form-data',
			processData: false,
            contentType: false,
            success: function(data) {
				console.log(data);
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
	
	//dosave expense
	$("#expensesave").click(function(e){
		var form = new FormData();
		var name=$("#expensename").val();
		var amount=$("#expenseamount").val();
		var reference=$("#expensereference").val();
		var account=$("#expenseaccount").val();
		var category=$("#expensecategory").val();
		var subcategory=$("#expensesubcategory").val();
		var date=$("#edate").val();
		var note=$("#expensenote").val();
		var file  = $('#expensefile')[0].files[0];
		
		form.append('expensename', name);
		form.append('expenseamount', amount);
		form.append('expensereference', reference);
		form.append('expenseaccount', account);
		form.append('expensecategory', category);
		form.append('expensesubcategory', subcategory);
		form.append('expensenote', note);
		form.append('expensedate', date);
		form.append('expensefile', file);
		if(name =='' || amount =='' || account =='' || account ==null || category ==null || category =='' || subcategory =='' || subcategory ==null || date =='' ){
			$("#message6").css({'display':"block"});
			return false;
		}
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('transaction/saveexpense')}}",
            data: form,
			contentType: 'multipart/form-data',
			processData: false,
            contentType: false,
            success: function(data) {
				console.log(data);
				$("#message7").css({'display':"block"});
				window.setTimeout(function(){location.reload()},2000)
            },
			error: function (error) {
				console.log(error);
				var errordata = error.responseJSON.expensefile[1];
				$("#message5").css({'display':"block"});
				console.log(errordata);
				$("#message5").html(errordata);
			}
		});
	});
} );

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
            todayHighlight: true
        });		
$('#edate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });		
		




</script>
@endsection