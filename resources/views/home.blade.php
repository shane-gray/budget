@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

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
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
