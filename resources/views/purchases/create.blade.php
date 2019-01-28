<form action="/purchases" method="post">

    @csrf

    <input type="hidden" name="budget_id" value="{{ $budget->id }}" />

    <div class="form-row">

        <div class="col">

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="purchase">Purchase</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
        
        </div>

    </div>

    <div class="form-row">

        <div class="col-sm-6">

            <div class="form-group">
                <label for="from_account">Source account</label>
                <select id="from_account" name="from_account" class="form-control" required>
                    @foreach( $accounts as $account )
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="col-sm-6 destination invisible">

            <div class="form-group">
                <label for="to_account">Destination</label>
                <select id="to_account" name="to_account" class="form-control" required>
                    @foreach( $accounts as $account )
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

    </div>

    <div class="form-row">

        <div class="col">

            <input type="text" name="name" class="form-control" placeholder="Name" required />

        </div>

        <div class="col">

            <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount" required />

        </div>

    </div>

</form>