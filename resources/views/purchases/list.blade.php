<div class="card card__purchases mb-4">

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

                        <tr data-id="{{ $purchase->id }}" data-href="/purchases/{{ $purchase->id }}/edit" data-toggle="modal" data-target="#modal">

                            <td>{{ $purchase->name }}</td>

                            <td>${{ $purchase->amount }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p>You have no purchases</p>

        @endif

        <a
            href="/purchases/create"
            class="btn btn-primary float-right"
            data-toggle="modal"
            data-target="#modal"
            data-budget_id="{{ $budget->id }}"
            {{ $accounts->isEmpty() ? 'disabled' : '' }}>
            <span class="oi oi-plus"></span> New purchase
        </a>

    </div>

</div>