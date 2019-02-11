<div class="card card__transactions mb-4">

    <div class="card-header">Transactions</div>

    <div class="card-body">

        @if( $transactions->isNotEmpty() )

            <table class="table">

                <thead>

                    <th>Name</th>

                    <th>Amount</th>

                </thead>

                <tbody>
                    
                    @foreach( $transactions as $transaction )

                        <tr data-id="{{ $transaction->id }}" data-href="/transactions/{{ $transaction->id }}/edit" data-toggle="modal" data-target="#modal">

                            <td>{{ $transaction->name }}</td>

                            <td>${{ $transaction->amount }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p>You have no transactions</p>

        @endif

        <a
            href="/transactions/create"
            class="btn btn-primary float-right"
            data-toggle="modal"
            data-target="#modal"
            data-budget_id="{{ $budget->id }}"
            {{ $accounts->isEmpty() ? 'disabled' : '' }}>
            <span class="oi oi-plus"></span> New transaction
        </a>

    </div>

</div>