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

                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#new-purchase-modal">
                        <span class="oi oi-plus"></span> New purchase
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- New purchase modal -->
<div id="new-purchase-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New purchase</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('purchases.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save purchase</button>
            </div>
        </div>
    </div>
</div>

@endsection