<div class="card mb-4">

    <div class="card-header">Bills</div>

    <div class="card-body">

        @if( $bills->isNotEmpty() )

            <table class="table">

                <thead>

                    <tr>

                        <th scope="col">ID</th>

                        <th scope="col">Name</th>

                        <th scrope="col">Amount</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach( $bills as $bill )

                        <tr>

                            <th scope="row">{{ $bill->id }}</th>

                            <td>{{ $bill->name }}</td>

                            <td>${{ $bill->amount($bill, $budget) ?: '0.00' }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p>You have no bills</p>

        @endif

        <a href="/bills/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New bill</a>

    </div>

</div>