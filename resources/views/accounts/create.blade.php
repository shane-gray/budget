<form action="/accounts" method="post">

    @csrf

    <div class="form-row">

        <div class="col">

            <input type="text" name="name" class="form-control" placeholder="Name" required />

        </div>

        <div class="col">

            <input type="number" step="0.01" name="balance" class="form-control" placeholder="Balance" required />

        </div>

    </div>

</form>