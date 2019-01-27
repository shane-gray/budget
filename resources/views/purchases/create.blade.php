<form action="/purchases" method="post">

    @csrf

    <input type="hidden" name="budget_id" value="{{ $budget->id }}" />

    <div class="form-row">

        <div class="col">

            <input type="text" name="name" class="form-control" placeholder="Name" />

        </div>

        <div class="col">

            <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount" />

        </div>

    </div>

</form>