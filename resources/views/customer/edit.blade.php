@extends('layouts.app')
@section('content')
    <form action="{{route('customers.editAction')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Cliente: <u>{{ $customerData->name }} </u></h4>
        </div>
        <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
        <div class="modal-body">
            <div class="form-group">
            <input type="hidden" name="id" value='{{ $customerData->id }}'>
            <label><?php echo trans('lang.name');?></label>
            <input type="text" class="form-control" name="name"  id="name" placeholder="Nome do Cliente" value="{{ $customerData->name }}">
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{ $customerData->cpf }}"  id="" placeholder="CPF">
            </div>
            <div class="form-group">
                <label>CEP</label>
                <input class="form-control" placeholder="CEP" id="zipcode" name="zipcode" type="text" value="{{ $customerData->zipcode }}">
            </div>
            <div class="form-group">
                <label>Rua</label>
                <input class="form-control" placeholder="Rua" id="street" name="street" type="text" value="{{ $customerData->street }}">
            </div>
            <div class="form-group">
            <label>Bairro</label>
            <input class="form-control" placeholder="Bairro" id="neighborhood" name="neighborhood" type="text" value="{{ $customerData->neighborhood }}">
            </div>
            <div class="form-group">
                <label>Cidade</label>
                <input class="form-control" placeholder="Cidade" name="city" type="text" value="{{ $customerData->city }}">
            </div>
            <div class="form-group">
                <label>Número</label>
                <input class="form-control" placeholder="Número" id="number" name="number" type="text" value="{{ $customerData->number }}">
            </div>
            
            <div class="form-group">
            <label>Referências</label>
            <textarea class="form-control" name="details" id="details" placeholder="" rows="20">{{ $customerData->details }}</textarea>
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input class="form-control" placeholder="Telefone"  name="phone" type="text" value="{{ $customerData->phone }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" placeholder="Email" id="email" name="email" type="email" value="{{ $customerData->email }}">
            </div>
        </div>
        <div class="modal-footer">
            
            <input type="submit" class="btn btn-primary" value="<?php echo trans('lang.save');?>"/>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
        </div>
    </form>
@endsection