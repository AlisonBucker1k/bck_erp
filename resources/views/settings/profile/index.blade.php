@extends('layouts.app')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="card col-lg-12">
					<div class="header">
						<div class="row">
							<div class="col-lg-12">
							<h4 class="title"><?php echo trans('lang.profile_settings');?></h4>
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
								  <label><?php echo trans('lang.full_name');?></label>
								  <input type="text" class="form-control" name="name"  id="name" placeholder="<?php echo trans('lang.full_name');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.phone');?></label>
								  <input type="text" class="form-control" name="phone"  id="phone" placeholder="<?php echo trans('lang.phone');?>" data-validation="required">
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group">
								  <label><?php echo trans('lang.email');?></label>
								  <input type="email" class="form-control" name="email"  id="email" placeholder="<?php echo trans('lang.email');?>" data-validation="required">
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.password');?></label>
								  <input type="password" class="form-control" name="password"  id="password" placeholder="<?php echo trans('lang.password');?>" >
								  <p class="text-help"><?php echo trans('lang.note_password');?></p>
								</div>	
									
						</div>

						<div class="col-lg-6">
							<button type="button" class="btn btn-fill btn-info" id="save"><?php echo trans('lang.save_profile');?></button>
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
        url: "{{ url('settings/getprofile')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$("#name").val(objs[0].name);
			$("#email").val(objs[0].email);
			$("#phone").val(objs[0].phone);

        },
    });
});	

$("#save").click(function(){

		var name=$("#name").val();
		var email=$("#email").val();
		var phone=$("#phone").val();
		var password=$("#password").val();
		
		
		
		if(name =='' || email ==''){
			$("#message").css({'display':"block"});
			return false;
		}
		
		$.ajax({
			type: "POST",
            url: "{{ url('settings/saveprofile')}}",
            data: {email:email,name:name,password:password,phone:phone},
            success: function(data) {				
				$("#message2").css({'display':"block"});
				window.setTimeout(function(){location.reload()},2000)
            }
		});

});
	
</script>
@endsection		