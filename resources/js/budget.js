/**
 * Display destination account for transfers
 * 
 */
$('.modal').on('change', '#type', function() {
    var type = $(this).find('option:selected').val();

    $('.destination, .bill').addClass('d-none');

    if( type == 'transfer')
        $('.destination').removeClass('d-none');

    else if( type == 'bill' )
        $('.bill').removeClass('d-none');
});