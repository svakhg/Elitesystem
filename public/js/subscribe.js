/******************/
/* AJAX FUNCTIONS */ 
/******************/
$('#member_id').on('input', function(){
	var member_id = $(this).val();

	 $.post('checkIfAlreadySybscribed/'+member_id,{
	 	'_token': $('input[name=_token]').val()
	 }, function(data){
	 	if(data > 0) {
	 		swal({
	 			'title': 'Error',
	 			'text': 'Ky antar ka nje abonim aktiv',
	 			'icon': 'error',
	 			'buttons': false
	 		});	
	 		resetForm();
	 	}
	 });
});

$('#datepicker').datepicker();

/***********************/
/* VALIDATE DATEPICKER */
/***********************/
$('#datepicker').on('blur', function(){
	var dateObj = new Date();

	var year = parseInt(dateObj.getFullYear());
	var month = parseInt(dateObj.getMonth() + 1);
	var day = parseInt(dateObj.getDate());

	var date = $(this).val();
	var choosedYear = parseInt(date.split('-')[0]);
	var choosedMonth = parseInt(date.split('-')[1]);
	var choosedDay = parseInt(date.split('-')[2]);

	if(choosedYear > year || choosedMonth > month) {
		swal({
			'title': 'Error',
			'text': 'Data e zgjedhur nuk është e vlefshme',
			'icon': 'error',
			'buttons': false
		});
	}

});

/*******/
/*RESET*/
/*******/
function resetForm()
{
	$('#add_subscription').trigger('reset');
}