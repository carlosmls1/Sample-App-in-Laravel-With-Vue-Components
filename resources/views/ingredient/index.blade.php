@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ingredients</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col" class="actions" >Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($allIngredients as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>
                                        <form action="{{route('ingredient.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('ingredient.edit',$item->id)}}" class="btn btn-outline-primary">Edit</a>
                                                <button type="submit" class="btn btn-outline-secondary">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('ingredient.create')}}" class="btn btn-outline-success">Create New</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
