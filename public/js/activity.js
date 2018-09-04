function fetchUsers(){
    
    $('#activitySearchMember').append($('<option>', {
        value: '',
        text: '--- ZGJID ANTARIN ---'
    }));

    $.get('/getCheckInUsers', {}, function(data){
        // console.log(data); return false;
        $.each(data, function(i, item){
            $('#activitySearchMember').append($('<option>', {
                value: item.id,
                text: item.first_name + ' ' + item.last_name
            }));
        });
    });
}

fetchUsers();

$('#submitActivityForm').on('click',function(e){
    e.preventDefault();
    var member_id = $('#activitySearchMember').val();

    if(member_id == null || member_id == '') {
        swal({
          text: 'Zgjidh antarin !',
          icon: 'error',  
          buttons: false
        });
    } else {
        $.post('/checkIn/'+member_id, {
            '_token': $('input[name=_token]').val()
        }, function(data){
            if(data == 0) {
                swal({
                    icon: 'error',
                    text: 'Ky user eshte aktiv per momentin',
                    buttons: false
                });
            } else {
                $('#activitySearchMember option').remove();
                fetchUsers();
                location.reload();            
            }
        });
    }
});

$('.checkOutBtn').on('click',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    
    $.post('/checkOut/'+id, {
        _token: $('input[name=_token]').val()
    }, function(data){
        location.reload();
    });
});