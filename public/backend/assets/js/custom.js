// Jquery Init
$(document).ready(function () {
    $('#alert-message').fadeTo(5000,500).slideUp(500, function () {
        $('#alert-message').slideUp(500);
    });

    // Confirm Message

    $(document).on('click','.confirm-message', function () {
        var message =  confirm('هل انت متأكد من الحذف');
        if (message){
            var id = $(this).attr('data-id');
            document.getElementById('delete-treasury-'+id).submit();
            return true;
        }else {
            return false;
        }
    });

});
