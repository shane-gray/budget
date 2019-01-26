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
                    <table class="table">
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum</td>
                            <td>Lorem ipsum</td>
                        </tr>
                    </table>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection