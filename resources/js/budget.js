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