@extends('layouts.app')

@section('content')

<div class="single-budget container">

    <div class="row justify-content-center">

        <div class="col-sm-12">
            <h1>{{ $budget->created_at->format('M d Y') }}</h1>
        </div>

        <div class="list__accounts col-md-4">

            @include('accounts.list')

            <div class="card mb-4">

                <div class="card-header">Bills</div>

                <div class="card-body">

                    @if( $bills->isNotEmpty() )

                        <table class="table">

                            <thead>

                                <tr>

                                    <th scope="col">ID</th>

                                    <th scope="col">Name</th>

                                    <th scrope="col">Amount</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach( $bills as $bill )

                                    <tr>

                                        <th scope="row">{{ $bill->id }}</th>

                                        <td>{{ $bill->name }}</td>

                                        <td>${{ $bill->amount ?: '0.00' }}</td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    @else

                        <p>You have no bills</p>

                    @endif

                    <a href="/bills/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New bill</a>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            @if( session('status') )
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
            @endif

            @include('purchases.list')

        </div>

    </div>

</div>

@endsection