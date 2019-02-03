/*
|-------------------------------------------------
| Modals
|-------------------------------------------------
*/

/**
 * Get modal content before show
 * 
 */
$('.modal').on('show.bs.modal', function(e) {

    var $this = $(this),
        $trigger = $(e.relatedTarget);

    $.get($trigger.attr('href'), function(html) {
        $this.find('.modal-content').replaceWith(html);
    });

});

/**
 * Reset fields on modal close
 * 
 */
$('.modal').on('hidden.bs.modal', function() {
    $(this).find('.alert').remove();
    $(this).find('form').trigger('reset');
    $(this).find('.conditional').addClass('d-none');
});

/**
 * Submit modal forms with footer button
 * 
 */
$('.modal .js-submit').on('click', function() {
    $(this).parents('.modal').find('.alert').remove();
    $(this).parents('.modal').find('form').submit();
});

/**
 * Send ajax request for modal forms
 * 
 */
$('.modal form').submit(function(e) {
    e.preventDefault();

    var $modal = $(this).parents('.modal');

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(data) {
            response = data.responseJSON;
            $modal.find('.alert').remove();
            $modal.find('form').trigger('reset');
            $modal.find('.conditional').addClass('d-none');
            $('.modal-body', $modal).prepend('<div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>New purchase added</div>');
        },
        error: function(data) {
            response = data.responseJSON;
            $modal.find('.alert').remove();
            $('.modal-body', $modal).prepend('<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        }
    });
});

/*
|-------------------------------------------------
| Fields
|-------------------------------------------------
*/

/**
 * Allow two decimals form amount field
 * 
 */
$('[name="amount"], [name="balance"]').on('change', function() {
    $(this).val( parseFloat( $(this).val() ).toFixed( 2 ) );
});