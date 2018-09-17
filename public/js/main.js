// Check for expire target every time page load
$(function(){
    $.get('/expireTarget',{}, function(data){
        if(data == 0) {
            console.log('Today is not the date');
        }
    });
});

// Search Members autosugguest 
$('#searchMembersInput').on('keypress', function(){
    
    var member = $(this).val();

    if(member !== '' || member !== null) {

        var options = {
            url: function(member) {
                return '/autosugguest/'+member;
            },
            getValue: function(element) {
                return element.first_name + ' ' + element.last_name;
            },
            ajaxSettings: {
                dataType: 'json',
                method: 'post',
                data: {
                    dataType: 'json',
                    '_token': $('input[name=_token]').val()
                }
            },
            preparePostData: function(data){
                data.member = member;
                return data;
            },
            requestDelay: 200
        };

        $(this).easyAutocomplete(options);
        
    } 
});
