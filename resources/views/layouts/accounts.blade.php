<div class="card mb-4">

    <div class="card-header">Accounts</div>

    <div class="card-body">

        @if( $accounts->isNotEmpty() )

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

                            <td>${{ $account->balance }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p>You have no accounts</p>

        @endif

        <a href="/accounts/create" class="btn btn-primary btn-primary float-right"><span class="oi oi-plus"></span> New account</a>

    </div>

</div>