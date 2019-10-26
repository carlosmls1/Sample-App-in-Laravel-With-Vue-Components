@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Orden #{{$order->id}}</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$order->Recipe->name}}</li>
                            <li class="list-group-item">{{$order->Client->name}}</li>
                            <li class="list-group-item">
                                {{$order->status}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
