 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.all_reports');?></h4>
						<hr>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-lg-6" style="border-right: 1px solid #f0f0f0;">
								@if(Auth::check())
									@if (Auth::user()->isrole('11'))
								<p class="text-primary"><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/income') }}"><?php echo trans('lang.income_reports');?></a> </p>
								<hr>
									@endif
								@endif	
								@if(Auth::check())
									@if (Auth::user()->isrole('12'))
								<p class="text-primary"><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/expense') }}"><?php echo trans('lang.expense_reports');?></a> </p>
								<hr>
									@endif
								@endif		
								@if(Auth::check())
									@if (Auth::user()->isrole('13'))
								<p class="text-primary"><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/incomevsexpense') }}"><?php echo trans('lang.income_vs_expense_reports');?></a> </p>
								<hr>
									@endif
								@endif
								@if(Auth::check())
									@if (Auth::user()->isrole('19'))
								<p><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/upcomingincome') }}"><?php echo trans('lang.upcomingincome');?></a> </p>
								<hr>
									@endif
								@endif		
							</div>
							<div class="col-lg-6">
								@if(Auth::check())
									@if (Auth::user()->isrole('14'))
								<p><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/incomemonth') }}"><?php echo trans('lang.income_monthly_report');?></a> </p>
								<hr>
									@endif
								@endif
								@if(Auth::check())
									@if (Auth::user()->isrole('15'))
								<p><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/expensemonth') }}"><?php echo trans('lang.expense_monthly_report');?></a> </p>
								<hr>
									@endif
								@endif
								@if(Auth::check())
									@if (Auth::user()->isrole('16'))
								<p><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/account') }}"><?php echo trans('lang.account_transaction_report');?></a> </p>
								<hr>
									@endif
								@endif
								@if(Auth::check())
									@if (Auth::user()->isrole('20'))
								<p><i class="ti-angle-right"></i><a href="{{ URL::to( 'reports/upcomingexpense') }}"><?php echo trans('lang.upcomingexpense');?></a> </p>
								<hr>
									@endif
								@endif
							</div>
						</div>
						
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
	
</script>
@endsection