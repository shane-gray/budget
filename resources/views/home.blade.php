@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            @if( session('status') )
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif

            <div class="card mb-4">

                <div class="card-header">Accounts</div>

                <div class="card-body">

                    @if( $accounts )

                        <table class="table">

                            <thead>

                                <tr>

                                    <th scope="col">ID</th>

                                    <th scope="col">Name</th>

                                    <th scrope="col">Balance</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach( $accounts as $account )

                                    <tr>

                                        <th scope="row">{{ $account->id }}</th>

                                        <td>{{ $account->name }}</td>

                                        <td>{{ $account->balance }}</td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    @endif

                    <a href="/accounts/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New account</a>

                </div>

            </div>

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
