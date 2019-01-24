@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
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

            <div class="card">
                <div class="card-header">Accounts</div>

                <div class="card-body">
                    @forelse( $accounts as $account )
                        <p>{{ $account->name }}</p>
                    @empty
                        <p>You have no accounts</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
