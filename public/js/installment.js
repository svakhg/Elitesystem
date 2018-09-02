$('#member_installment').on('input', function(){

	$('#debt').val('');

	var user_id = $(this).val();
	
	$.post('getUserDebtById/'+user_id , {
		'_token': $('input[name=_token]').val()
	}, function(data){
		if(data !== null || typeof(data) !== undefined) 
			var subscription_id = data[0].subscription_id;
			$('#subscription_id').val(subscription_id);
			var debt = parseInt(data[0].price) - parseInt(data[0].payed);
			localStorage.setItem('debt',debt);
			$('#debt').val(debt);
	});	
});

$('#sum').on('input',function(){

	var debt = localStorage.getItem('debt');

	if(parseInt($(this).val()) > debt) {
		$(this).val('');
	} 
});

$('#submitFormBtn').on('click', function(e){
	e.preventDefault();
	if($('#member_installment').val() == '' || $('#member_installment').val() == null) {
		swal({
			  title: "Error",
			  text: 'Zgjidh Antarin',
			  icon: "error",
			  buttons: false,
			});
	} else {
		var subscription_id = parseInt($('#subscription_id').val());
		var sumToRecieve = parseInt($('#sum').val());
	}
	if(subscription_id !== null && subscription_id !== '' && sumToRecieve !== '' && sumToRecieve !== null){
		$.post('addRecievmentBySubscriptionId/'+subscription_id, {
			'_token': $('input[name=_token]').val(),
			'sum': sumToRecieve
		}, function(data){
			swal({
				title: 'Success',
				text: 'Shuma ' + sumToRecieve + ' u arkëtua',
				icon: 'success',
				buttons: false
			});

			resetForm();

			if(data == 0) 
				location.reload();
		});
	} else {
		return false;
	}
});

function resetForm(){
	$('#addRecievmentForm').trigger('reset');
}