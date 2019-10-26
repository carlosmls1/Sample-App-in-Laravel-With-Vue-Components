@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(Session::has('flash_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{Session::get('flash_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Orden #{{$order->id}}</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Receta: {{$order->Recipe->name}}</li>
                            <li class="list-group-item">Cliente: {{$order->Client->name}}</li>
                            <li class="list-group-item">
                                Status: @if($order->status=='Procesando')
                                    <span class="badge badge-pill badge-success">Procesando</span>
                                @elseif($order->status=='Rechazada')
                                    <span class="badge badge-pill badge-danger">Rechazada</span>
                                @elseif($order->status=='Entregada')
                                    <span class="badge badge-pill badge-secondary">Entregada</span>
                                @else
                                    <span class="badge badge-pill badge-primary">En Espera</span>
                                @endif
                            </li>
                        </ul>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ingrediente</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Existencias</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->recipe->ingredient as $key=>$ingredient)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $ingredient->name }}</td>
                                    <td>{{ $ingredient->pivot->qty }}</td>
                                    <td>{{ $ingredient->qty }}</td>
                                    <td>
                                        @if ($order->status=='Waiting')
                                            @if ($ingredient->qty < $ingredient->pivot->qty)
                                                <a  href="{{route('kitchen.buy_ingredients',$ingredient->id)}}" class="btn btn-success">Comprar</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <form action="{{route('kitchen.order_status',$order->id)}}" method="post">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if ($order->status=='Waiting')
                                    <button type="submit" class="btn btn-outline-success" name="status" value="Procesando">Aceptar</button>
                                    <button type="submit" class="btn btn-outline-danger" name="status" value="Rechazada">Rechazar</button>
                                @elseif($order->status=='Procesando')
                                    <button type="submit" class="btn btn-outline-primary" name="status" value="Entregada">Entregar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
