/**
 * Display destination account for transfers
 * 
 */
$('#type').on('change', function() {
    var type = $(this).find('option:selected').val();

    $('.destination, .bill').addClass('d-none');

    if( type == 'transfer')
        $('.destination').removeClass('d-none');

    else if( type == 'bill' )
        $('.bill').removeClass('d-none');
});

/**
 * Allow two decimals form amount field
 * 
 */
$('[name="amount"]').on('change', function() {
    $(this).val( parseFloat( $(this).val() ).toFixed( 2 ) );
});

/**
 * Reset fields on modal close
 * 
 */
$('#new-purchase-modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('.destination, .bill').addClass('d-none');
});

/**
 * Submit form with footer button
 * 
 */
$('#new-purchase-modal .js-submit').on('click', function() {
    $(this).parents('.modal').find('.alert').remove();
    $(this).parents('.modal').find('form').submit();
});

/**
 * Send ajax request for new purchase
 * 
 */
$('#new-purchase-modal form').submit(function(e) {
    e.preventDefault();

    var $modal = $(this).parents('.modal');

    $.ajax({
        url: '/purchases',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(data) {
            response = data.responseJSON;
            $modal.find('.alert').remove();
            $modal.find('form').trigger('reset');
            $modal.find('.destination').addClass('invisible');
            $('.modal-body', $modal).prepend('<div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>New purchase added</div>');
        },
        error: function(data) {
            response = data.responseJSON;
            $modal.find('.alert').remove();
            $('.modal-body', $modal).prepend('<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        }
    });
});