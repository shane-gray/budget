@extends('layouts.app')

@section('content')

<div class="single-budget container">

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

            <div class="card mb-4">

                <div class="card-header">{{ $budget->created_at->format('M d Y') }}</div>

                <div class="card-body"></div>

            </div>

        </div>

    </div>

</div>

@endsection