        
<!DOCTYPE html>
<html id="locale" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class="company"></title>

	  <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet"/>
	
	<!--  Datatables    -->
	<link href="{{ asset('plugin/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/datatables/css/buttons.dataTables.min.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/datatables/css/buttons.bootstrap.min.css') }}"  rel="stylesheet">
	<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('plugin/morris/morris.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/fullcalendar/fullcalendar.css') }}"  rel="stylesheet">
	<!-- Scripts -->

    <script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugin/fullcalendar/lib/moment.min.js') }}"></script>
	<script src="{{ asset('plugin/fullcalendar/fullcalendar.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/dataTables.bootstrap.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/buttons.bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('plugin/datatables/js/vfs_fonts.js') }}"></script>
	<script src="{{ asset('plugin/chartjs/Chart.min.js') }}"></script>
	<script src="{{ asset('plugin/morris/morris.min.js') }}"></script>
	<script src="{{ asset('plugin/jscolor/jscolor.js') }}"></script>
	<script src="{{ asset('plugin/morris/raphael-min.js') }}"></script>
	<script src="{{ asset('plugin/chartjs/Chart.PieceLabel.js') }}"></script>




</head>
<body>
 
        
<div class="sidebar">	
<div class=" sidebar-wrapper">
    <div class="logo">
                <img class="logoimg" src="" style="width:200px"/>
        </a>
    </div>
    <ul class="nav">
			
            <li class="{{ Request::is( 'home') ? 'active' : '' }}">
                <a href="{{ URL::to( 'home') }}" >
                    <i class="ti-panel"></i>
					<p><?php echo trans('lang.dashboard');?></p>
                </a>
            </li>
			@if(Auth::check())
				@if (Auth::user()->isrole('2'))
			 <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'transaction') }}" >
                    <i class="ti-direction-alt"></i>
					<p><?php echo trans('lang.transactions');?></p>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('3'))
			 <li class="{{ Request::is( 'income') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'income') }}" >
                    <i class="ti-stats-up"></i>
					<p><?php echo trans('lang.income');?></p>
                </a>
            </li>
				@endif
			@endif<!--
            @if(Auth::check())
                @if (Auth::user()->isrole('19'))
             <li class="{{ Request::is( 'upcomingincome') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingincome') }}" >
                    <i class="ti-angle-double-up"></i>
                    <p><?php echo trans('lang.upcomingincome');?></p>
                </a>
            </li>
                @endif
            @endif-->
			@if(Auth::check())
				@if (Auth::user()->isrole('4'))
			 <li class="{{ Request::is( 'expense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'expense') }}" >
                    <i class="ti-stats-down"></i>
					<p><?php echo trans('lang.expense');?></p>
                </a>
            </li>
				@endif
			@endif<!--
             @if(Auth::check())
                @if (Auth::user()->isrole('20'))
             <li class="{{ Request::is( 'upcomingexpense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingexpense') }}" >
                    <i class="ti-angle-double-down"></i>
                    <p><?php echo trans('lang.upcomingexpense');?></p>
                </a>
            </li>
                @endif
            @endif-->
			@if(Auth::check())
				@if (Auth::user()->isrole('5'))
			 <li class="{{ Request::is( 'account') ? 'active' : '' }}">
                <a href="{{ URL::to( 'account') }}" >
                    <i class="ti-wallet"></i>
					<p><?php echo trans('lang.accounts');?></p>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('6'))
			 <li class="{{ Request::is( 'budget') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'budget') }}" >
                    <i class="ti-package"></i>
					<p><?php echo trans('lang.track_budget');?> </p>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('7'))
			 <li class="{{ Request::is( 'goals') ? 'active' : '' }}">
                <a href="{{ URL::to( 'goals') }}" >
                    <i class="ti-cup"></i>
					<p><?php echo trans('lang.set_goals');?></p>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('8'))
			<li class="{{ Request::is( 'calendar') ? 'active' : '' }}">
                <a href="{{ URL::to( 'calendar') }}" >
                    <i class="ti-calendar"></i>
					<p><?php echo trans('lang.calendar');?></p>
                </a>
            </li>
				@endif
			@endif
			
			 <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
                <a href="{{ URL::to( 'reports/allreports') }}" >
                    <i class="ti-pie-chart"></i>
					<p><?php echo trans('lang.report_menu');?></p>
                </a>
            </li>
				
			 <li>
                 <a data-toggle="collapse" href="#category" class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}">
                    <i class="ti-flag-alt"></i>
                    <p><?php echo trans('lang.category');?><b class="caret"></b></p>
                </a>
				<div class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'collapse in' : 'collapse' }}" id="category" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}" style="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
						@if(Auth::check())
							@if (Auth::user()->isrole('9'))
                          <li class="{{ Request::is( 'incomecategory') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'incomecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.income_category');?></span>
                            </a>
                        </li>
							@endif
						@endif
						@if(Auth::check())
							@if (Auth::user()->isrole('10'))
						<li class="{{ Request::is( 'expensecategory') ? 'active' : '' }}">
                           <a href="{{ URL::to( 'expensecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.expense_category');?></span>
                            </a>
                        </li>
							@endif
						@endif
                    </ul>
                </div>
            </li>


			 <li>
                 <a data-toggle="collapse" href="#settings" class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'collapsed' }}" aria-expanded="{{Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}">
                    <i class="ti-settings"></i>
                    <p><?php echo trans('lang.setting_menu');?><b class="caret"></b></p>
                </a>
				<div class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'collapse in' : 'collapse' }}" id="settings" aria-expanded="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}" style="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        <li class="{{ Request::is( 'settings/profile') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/profile') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.profile_settings');?></span>
                            </a>
                        </li>
						@if(Auth::check())
							@if (Auth::user()->isrole('17'))
						<li class="{{ Request::is( 'settings/allusers') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/allusers') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.user_role');?></span>
                            </a>
                        </li>
							@endif
						@endif
						@if(Auth::check())
							@if (Auth::user()->isrole('18'))
                           <li class="{{ Request::is( 'settings/application') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/application') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.application_setting');?></span>
                            </a>
                        </li>
							@endif
						@endif	
                    </ul>
                </div>
    </ul>
</div>
</div>
<div class="main-panel">
    <nav class="navbar navbar-default" style="background: #082533;">
    <div class="container-fluid">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
            <a class="navbar-brand" href="#"><p class="company"></p></a>
        </div>

        <!--responsive-->
        <div class="collapse" id="myNavbar">
        <ul class="nav">
            
            <li  class="{{ Request::is( 'home') ? 'active' : '' }}">
                <a  href="{{ URL::to( 'home') }}" >
                    <p><?php echo trans('lang.dashboard');?></p>
                </a>
            </li>
            @if(Auth::check())
                @if (Auth::user()->isrole('2'))
             <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'transaction') }}" >
                    <p><?php echo trans('lang.transactions');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('3'))
             <li class="{{ Request::is( 'income') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'income') }}" >
                    <p><?php echo trans('lang.income');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('19'))
             <li class="{{ Request::is( 'upcomingincome') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingincome') }}" >
                    <p><?php echo trans('lang.upcomingincome');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('4'))
             <li class="{{ Request::is( 'expense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'expense') }}" >
                    <p><?php echo trans('lang.expense');?></p>
                </a>
            </li>
                @endif
            @endif
             @if(Auth::check())
                @if (Auth::user()->isrole('20'))
             <li class="{{ Request::is( 'upcomingexpense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingexpense') }}" >
                    <p><?php echo trans('lang.upcomingexpense');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('5'))
             <li class="{{ Request::is( 'account') ? 'active' : '' }}">
                <a href="{{ URL::to( 'account') }}" >
                    <p><?php echo trans('lang.accounts');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('6'))
             <li class="{{ Request::is( 'budget') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'budget') }}" >
                    <p><?php echo trans('lang.track_budget');?> </p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('7'))
             <li class="{{ Request::is( 'goals') ? 'active' : '' }}">
                <a href="{{ URL::to( 'goals') }}" >
                    <p><?php echo trans('lang.set_goals');?></p>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('8'))
            <li class="{{ Request::is( 'calendar') ? 'active' : '' }}">
                <a href="{{ URL::to( 'calendar') }}" >
                    <p><?php echo trans('lang.calendar');?></p>
                </a>
            </li>
                @endif
            @endif
            
             <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
                <a href="{{ URL::to( 'reports/allreports') }}" >
                    <p><?php echo trans('lang.report_menu');?></p>
                </a>
            </li>
                
             <li>
                 <a data-toggle="collapse" href="#categorys" class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}">
                    <p><?php echo trans('lang.category');?><b class="caret"></b></p>
                </a>
                <div class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'collapse in' : 'collapse' }}" id="categorys" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}" style="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        @if(Auth::check())
                            @if (Auth::user()->isrole('9'))
                          <li class="{{ Request::is( 'incomecategory') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'incomecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.income_category');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                        @if(Auth::check())
                            @if (Auth::user()->isrole('10'))
                        <li class="{{ Request::is( 'expensecategory') ? 'active' : '' }}">
                           <a href="{{ URL::to( 'expensecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.expense_category');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </li>


             <li>
                 <a data-toggle="collapse" href="#settingss" class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'collapsed' }}" aria-expanded="{{Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}">
                    <p><?php echo trans('lang.setting_menu');?><b class="caret"></b></p>
                </a>
                <div class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'collapse in' : 'collapse' }}" id="settingss" aria-expanded="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}" style="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        <li class="{{ Request::is( 'settings/profile') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/profile') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.profile_settings');?></span>
                            </a>
                        </li>
                        @if(Auth::check())
                            @if (Auth::user()->isrole('17'))
                        <li class="{{ Request::is( 'settings/allusers') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/allusers') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.user_role');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                        @if(Auth::check())
                            @if (Auth::user()->isrole('18'))
                           <li class="{{ Request::is( 'settings/application') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/application') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.application_setting');?></span>
                            </a>
                        </li>
                            @endif
                        @endif  
                    </ul>
                </div>
            </ul>
    </div>
        <!--end responsive-->

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo trans('lang.new');?>
                    <i class="ti-new"></i>
                    <b class="caret"></b>
                    <ul class="dropdown-menu">
                      @if(Auth::check())
                            @if (Auth::user()->isrole('2'))
                         <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
                             <a href="{{ URL::to( 'transaction') }}" >
                                <p><?php echo trans('lang.transactions');?></p>
                            </a>
                        </li>
                            @endif
                        @endif
                       @if(Auth::check())
                            @if (Auth::user()->isrole('11'))
                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
                             <a href="{{ URL::to( 'reports/income') }}" >
                                <p><?php echo trans('lang.income_reports');?></p>
                            </a>
                        </li>
                            @endif
                        @endif
                         @if(Auth::check())
                            @if (Auth::user()->isrole('12'))
                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
                             <a href="{{ URL::to( 'reports/expense') }}" >
                                <p><?php echo trans('lang.expense_reports');?></p>
                            </a>
                        </li>
                            @endif
                        @endif
                         @if(Auth::check())
                            @if (Auth::user()->isrole('16'))
                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
                             <a href="{{ URL::to( 'reports/account') }}" >
                                <p><?php echo trans('lang.account_transaction_report');?></p>
                            </a>
                        </li>
                            @endif
                        @endif
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               

				<li>
                    <a href="#">
                        <i class="ti-user"></i>
                        <p>{{ Auth::user()->name }}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to( 'settings/profile') }}">
                        <i class="ti-settings"></i>
                        <p><?php echo trans('lang.profile_settings');?></p>
                    </a>
                </li>
				<li>
                    <a href="{{ URL::to( 'logout') }}">
                        <i class="ti-back-right"></i>
                        <p><?php echo trans('lang.logout');?></p>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

        @yield('content')
<footer class="footer">
    <div class="container-fluid">
        
        <div class="copyright pull-right">
            2021 © <span class="company"></span></a>
        </div>
    </div>
</footer>
</div>

    
</body>
</html>
<script>
$(document).ready(function() {
$.ajax({
        type: "GET",
        url: "{{ url('settings/getapplication')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html.data;
			$(".company").html(objs[0].company);
			$("#city").val(objs[0].city);
			$("#currency").val(objs[0].currency);
			$("#phone").val(objs[0].phone);
			$("#address").val(objs[0].address);
            $("#locale").attr(objs[0].languages);
			$("#website").val(objs[0].website);
			$(".logoimg").attr("src",html.logo);

        },
    });
});	
</script>
