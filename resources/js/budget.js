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
    $(this).find('input').val('');
});