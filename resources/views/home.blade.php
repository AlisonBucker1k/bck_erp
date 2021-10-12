@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
				<div class="card background-blue-sky color-white">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="icon-big color-white text-center">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style="font-size:22px;">
                                    <span>Net Balance </span><span class="monthname"></span>
                                    <span class="currency"></span><span id="monthbalance"></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr>
                            
                        </div>
                    </div>
                </div>
			</div>
    </div>
</div>
@endsection
