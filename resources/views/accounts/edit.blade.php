<div class="modal-content modal-account">
    <div class="modal-header">
        <h5 class="modal-title">{{ $account->name }}</h5>
        <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="/accounts/{{ $account->id }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $account->name }}" required />
                </div>
                <div class="col">
                    <input type="number" step="0.01" name="balance" class="form-control" placeholder="Balance" value="{{ $account->balance }}" required />
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger float-left">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary js-submit">Save account</button>
    </div>
</div>