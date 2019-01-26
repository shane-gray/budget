@extends('layouts.app')

@section('content')

<div class="single-budget container">

    <div class="row justify-content-center">

        <div class="col-sm-12">
            <h1>{{ $budget->created_at->format('M d Y') }}</h1>
        </div>

        <div class="list__accounts col-md-4">

            @include('layouts.accounts')

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

            <div class="card mb-4">

                <div class="card-header">Purchases</div>

                <div class="card-body">

                    @if( $purchases->isNotEmpty() )

                        <table class="table">

                            <thead>

                                <th>Name</th>

                                <th>Amount</th>

                            </thead>

                            <tbody>
                                
                                @foreach( $purchases as $purchase )

                                    <tr>

                                        <td>{{ $purchase->name }}</td>

                                        <td>${{ $purchase->amount }}</td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    @else

                        <p>You have no purchases</p>

                    @endif

                    <a id="new-purchase" href="/purchases/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New purchase</a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection