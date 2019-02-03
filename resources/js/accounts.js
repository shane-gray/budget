/**
 * Display edit account modal on
 * table row click
 * 
 */
$('.list__accounts').on('click', 'tr', function() {

    var account_id = $(this).data('id');

});

$('#new-account-modal').on('show.bs.modal', function(e) {

    console.log( $(e.relatedTarget).attr('href') );

});