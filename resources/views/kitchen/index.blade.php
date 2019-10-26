@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ordenes</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Receta</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="actions" >Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($allOrders as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->client->name }}</td>
                                    <td>{{ $item->recipe->name }}</td>
                                    <td>
                                        @if($item->status=='Procesando')
                                            <span class="badge badge-pill badge-success">Procesando</span>
                                        @elseif($item->status=='Rechazada')
                                            <span class="badge badge-pill badge-danger">Rechazada</span>
                                        @elseif($item->status=='Entregada')
                                            <span class="badge badge-pill badge-secondary">Entregada</span>
                                        @else
                                            <span class="badge badge-pill badge-primary">En Espera</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('kitchen.order',$item->id)}}" class="btn btn-outline-primary">Ver</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
