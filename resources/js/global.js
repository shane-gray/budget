/*
|-------------------------------------------------
| Modals
|-------------------------------------------------
*/

var modal_content = $('#modal .modal-content').html();

/**
 * Get modal content before show
 * 
 */
$('.modal').on('show.bs.modal', function(e) {

    var $this = $(this),
        $trigger = $(e.relatedTarget),
        data = $trigger.data(),
        href = $trigger.attr('href') ? $trigger.attr('href') : $trigger.data('href');

    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        data: data,
        success: function(response) {
            $this.find('.modal-content').replaceWith(response.html);
        },
        error: function(error) {
            response = error.responseJSON;
            $('.modal-body', $this).prepend('<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        }
    });

});

/**
 * Reset fields on modal close
 * 
 */
$('.modal').on('hidden.bs.modal', function() {
    $(this).find('.modal-content').html(modal_content);
});

/**
 * Submit modal forms with footer button
 * 
 */
$('.modal').on('click', '.js-submit', function() {
    $(this).parents('.modal').find('.alert').remove();
    $(this).parents('.modal').find('form').submit();
});

/**
 * Send ajax request for modal forms
 * 
 */
$('.modal').on('submit', 'form', function(e) {
    e.preventDefault();

    var $modal = $(this).parents('.modal');

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response) {
            $modal.find('.alert').remove();
            $modal.find('form').trigger('reset');
            $modal.find('.conditional').addClass('d-none');
            $('.modal-body', $modal).prepend('<div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        },
        error: function(error) {
            response = error.responseJSON;
            $modal.find('.alert').remove();
            $('.modal-body', $modal).prepend('<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        }
    });
});

/**
 * Send delete request
 * 
 */
$('.modal').on('click', '.js-delete', function() {

    var $modal = $(this).parents('.modal'),
        $form = $modal.find('form');

    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: {
            '_token': $form.find('[name="_token"]').val(),
            '_method': 'DELETE'
        },
        success: function(response) {
            $modal.find('.alert').remove();
            $modal.find('form').trigger('reset');
            $modal.find('.conditional').addClass('d-none');
            $('.modal-body', $modal).prepend('<div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response.message + '</div>');
        },
        error: function(error) {
            response = error.responseJSON;
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
$('#modal').on('change', '[name="amount"], [name="balance"]',  function() {
    $(this).val( parseFloat( $(this).val() ).toFixed( 2 ) );
});