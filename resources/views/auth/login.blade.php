<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NOME EMPRESA</title>

	  <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/login.css') }}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet"/>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<body class="login-background">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top:15%">
            <div class="panel panel-default panel-login">
               <div class="header">
                            <div class="row">
                                    <div class="col-lg-12">
                                    <h3 class="title text-center"><?php echo trans('lang.login');?></h3>
                                    </div>
                            </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           
                            <div class="col-md-9 col-md-offset-2">
							
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong><?php echo trans('lang.email_login');?></strong>
                                    </span>
                                @endif
					<label for="email" class="control-label"><?php echo trans('lang.email');?></label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           

                            <div class="col-md-9 col-md-offset-2">
								  @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong><?php echo trans('lang.email_login');?></strong>
                                    </span>
                                @endif
					<label for="password" class="control-label"><?php echo trans('lang.password');?></label>
                                <input id="password" type="password" class="form-control" name="password" required>

                              
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-fill btn-primary text-center">
                                    <?php echo trans('lang.login');?> 
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
