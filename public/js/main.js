// Check for expire target every time page load
$(function(){
    $.get('/expireTarget',{}, function(data){
        if(data == 0) {
            console.log('Today is not the date');
        }
    });
});