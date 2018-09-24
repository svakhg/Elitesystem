$(function(){
    $('#chatUi').hide();
});

/*
* GET MESSAGES
*/
function renderMessages(){
    $('#messages').empty();
    $.get('/getMessages',{}, function(res){
        $('#msgCount').text('('+res.length+')');
        var user_id = '<?php auth()->user_id()->id ?>';
        for(var i = 0; i < res.length; i++) {
            $('#messages').append(
                '<li class="left">'+
                '<div class="messageContent">'+
                '<span class="badge">'+res[i].user_name +'</span>'+
                '<span class="pull-right sentTime">'+res[i].created_at+'</span>'+
                '<strong>'+res[i].message+'</strong>'+
                '</div>'+
                '</li>'
            );
        }
    });
}

renderMessages();

/*
 *  SEND MESSAGE
 */
$('#sendMessage').on('click', function(e){
    e.preventDefault();

    var message = {
        _token: $('input[name=_token]').val(),
        user_id: $('#user_id').val(),
        message: $('#message').val()
    };

    if($('#message').val() !== null && typeof $('#message').val() !== undefined && $('#message').val() !== '') {
    
        $.post('/addMessage', message, function(res){
            renderMessages();
            $('#message').val('');
        });
    }

});

setInterval(renderMessages, 50000);

/**
 * Toggle Chat Pannel
 */
$('#toggleBtn').on('click',function(){
    $('#chatUi').toggle(100);
});