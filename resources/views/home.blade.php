@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            @if( session('status') )
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
            @endif

            @include('layouts.accounts')

            <div class="card">
                <div class="card-header">Budgets</div>

                <div class="card-body">
                    @forelse( $budgets as $budget )
                        <p>{{ $budget->created_at }}</p>
                    @empty
                        <p>You have no budgets</p>
                    @endforelse
                    <a href="/budgets/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New budget</a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
