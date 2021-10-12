@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="card col-lg-12">
					<div class="header">
						<div class="row">
							<div class="col-lg-12">
							<h4 class="title"><?php echo trans('lang.application_setting');?></h4>
							</div>
						</div>
                    </div>
					<hr>
					<div class="row">
					<div id="message" style="display:none" class="alert alert-danger"><?php echo trans('lang.all_field_required');?></div>
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
						<form action=""  name="formsetting">
						<div class="col-lg-6">
								<div class="form-group">
								  <label><?php echo trans('lang.company_name');?></label>
								  <input type="text" class="form-control" name="company"  id="company" placeholder="<?php echo trans('lang.company_name');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.city');?></label>
								  <input type="text" class="form-control" name="city"  id="city" placeholder="<?php echo trans('lang.city');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.currency');?></label>
								  <input type="text" class="form-control" name="currency"  id="currency" placeholder="<?php echo trans('lang.currency');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.language');?></label>
								  <select name="language" id="language" class="form-control" required>
								  	<option value="en">English</option>
								  	<option value="es">Spanish</option>
								  	<option value="tk">Turkey</option>
								  </select>
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group">
								  <label><?php echo trans('lang.website');?></label>
								  <input type="text" class="form-control" name="website"  id="website" placeholder="<?php echo trans('lang.website');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.phone');?></label>
								  <input type="text" class="form-control" name="phone"  id="phone" placeholder="<?php echo trans('lang.phone');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.address');?></label>
								  <input type="text" class="form-control" name="address"  id="address" placeholder="<?php echo trans('lang.address');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.date_format');?></label>
								  <select name="dateformat" id="dateformat" class="form-control" required>
								  	<option value="d-m-Y">d-m-Y</option>
								  	<option value="m-d-Y">m-d-Y</option>
								  	<option value="Y-m-d">Y-m-d</option>
								  	<option value="d/m/Y">d/m/Y</option>
								  	<option value="m/d/Y">m/d/Y</option>
								  	<option value="Y/m/d">Y/m/d</option>
								  	<option value="d.m.Y">d.m.Y</option>
								  	<option value="m.d.Y">m.d.Y</option>
								  	<option value="Y.m.d">Y.m.d</option>
								  </select>
								</div>
						</div>
						<div class="col-lg-8">
								<div class="form-group">
								  <label><?php echo trans('lang.logo');?></label>
								  <input type="file" class="form-control" name="logo"  id="logo" placeholder="<?php echo trans('lang.logo');?>" required>
								</div>
						</div>
						<div class="col-lg-4">
								<img id="logoimg" src="" style="width:257px;"/>
						</div>
						<div class="col-lg-6">
							<button type="button" class="btn btn-fill btn-info" id="save"><?php echo trans('lang.save_settings');?></button>
						</div>
						</form>
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
    $.ajax({
        type: "GET",
        url: "{{ url('settings/getapplication')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$("#company").val(objs[0].company);
			$("#city").val(objs[0].city);
			$("#currency").val(objs[0].currency);
			$("#phone").val(objs[0].phone);
			$("#address").val(objs[0].address);
			$("#website").val(objs[0].website);
			$("#language").val(objs[0].languages);
			$("#dateformat").val(objs[0].dateformat);
			$("#logoimg").attr("src",'../upload/'+objs[0].logo);

        },
    });
});	

$("#save").click(function(){

		var form = new FormData();
		var name=$("#name").val();
		var company=$("#company").val();
		var city=$("#city").val();
		var currency=$("#currency").val();
		var address=$("#address").val();
		var phone=$("#phone").val();
		var website=$("#website").val();
		var language=$("#language").val();
		var dateformat=$("#dateformat").val();
		var logo  = $('#logo')[0].files[0];
		
		
		form.append('company', company);
		form.append('city', city);
		form.append('currency', currency);
		form.append('address', address);
		form.append('website', website);
		form.append('phone', phone);
		form.append('language', language);
		form.append('dateformat', dateformat);
		form.append('logo', logo);
		if(company =='' || city =='' || currency =='' || address =='' || city =='' || dateformat == ''){
			$("#message").css({'display':"block"});
			return false;
		}
		
		$.ajax({
			type: "POST",
            url: "{{ url('settings/saveapplication')}}",
            data: form,
			contentType: 'multipart/form-data',
			processData: false,
            contentType: false,
            success: function(data) {				
				$("#message2").css({'display':"block"});
				window.setTimeout(function(){location.reload()},2000)
            }
		});

});
	
</script>
@endsection		