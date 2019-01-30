<div class="card mb-4">

    <div class="card-header">Accounts</div>

    <div class="card-body">

        @if( $accounts->isNotEmpty() )

            <table class="table">

                <thead>

                    <tr>

                        <th scope="col">ID</th>

                        <th scope="col">Name</th>

                        <th scope="col">Balance</th>

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

        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#new-account-modal">
            <span class="oi oi-plus"></span> New account
        </button>

    </div>

</div>

<!-- New account modal -->
<div id="new-account-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New account</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('accounts.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary js-submit">Save account</button>
            </div>
        </div>
    </div>
</div>