@extends('layouts.app')
@section('content')
    <form action="{{route('products.editAction')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Produto: <u>{{ $productData->name }} </u></h4>
        </div>
        <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
        <div class="modal-body">
            <div class="form-group">
            <input type="hidden" name="id" value='{{ $productData->id }}'>
            <label><?php echo trans('lang.name');?></label>
            <input type="text" class="form-control" name="name"  id="name" placeholder="Nome do Cliente" data-validation="required" value="{{ $productData->name }}">
            </div>
            <div class="form-group">
                <label>Referência</label>
                <input class="form-control" required="" placeholder="Referência" id="zipcode" name="ref" type="text" value="{{ $productData->ref }}">
            </div>
            <div class="form-group">
                <label>Quantidade</label>
                <input class="form-control" required="" placeholder="Quantidade em estoque" id="street" name="qt" type="text" value="{{ $productData->quantity }}">
            </div>
            <div class="form-group">
            <label>Preço de compra</label>
            <input class="form-control" required="" placeholder="Preço de compra" id="neighborhood" name="buyPrice" type="text" value="{{ $productData->buy_price }}">
            </div>
            <div class="form-group">
                <label>Preço de venda</label>
                <input class="form-control" required="" placeholder="Preço de venda" id="neighborhood" name="sellPrice" type="text" value="{{ $productData->sell_price }}">
                </div>
        </div>
        <div class="modal-footer">
            
            <input type="submit" class="btn btn-primary" value="<?php echo trans('lang.save');?>"/>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
        </div>
    </form>
@endsection