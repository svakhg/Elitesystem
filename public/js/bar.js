$('#buyer_select').on('input', function(){
	var member_id = $(this).val();
	$.post('/getMemberDebtById/'+ member_id, {
		'_token' : $('input[name=_token]').val()
	}, function(data) {
		if(data == 1) {
			swal({
				title: 'Error',
				text: 'Antari e ka kaluar limitin e borxhit !',
				icon: 'error',
				buttons: false,
				});
			resetMemberBuyForm();
		}
	});
});

function callGetPriceByIdFunction(obj,bt)
{
	resetValues();

	var product_id = $(obj).val();
	localStorage.setItem('product_id',product_id);

	var buyer_type = bt;

	if(product_id <= 0 || product_id == '' || product_id == null) return false;

	$.post('/getProductPriceById/'+product_id, {
			'_token': $('input[name=_token]').val(),
		},
		function(data) { 
			var price = data;
			if(buyer_type == 'member') {
				localStorage.setItem('price',price);
				$('#member_price').val(price);
			} else if (buyer_type == 'user') {
				var discount = (25 / 100) * price;
				var final = price - discount;
				localStorage.setItem('price',final); 
				$('#user_price').val(Math.floor(final));
			}	
		}
	);
}

/****************
/ Vendos cmimin /
/ ne baze sasie /
*****************/

$('#member_quantity').on('input',function() {

	if($('#member_product').val() == '' || $('#member_product').val() == null) {
		var price = 0;
	} else {
		var price = localStorage.getItem('price');
	}

	if($(this).val() == '' || $(this).val() == null) {
		var qty = 1;
	} else {
		var qty = parseInt($(this).val());
	}

	var product_id = localStorage.getItem('product_id');

	// check for product quantity 
	$.post('/getProductQtyById/'+product_id, {
		'_token': $('input[name=_token]').val(),
	}, function(data) {
		var actual_qty = parseInt(data); 
		if(qty > actual_qty) {
			resetValues();
			swal({
			  title: "Error",
			  text: 'Nuk disponohet sasia e kërkuar e produktit !',
			  icon: "error",
			  buttons: false,
			});
		} else {
			var total_price = price * qty;
			$('#member_price').val(total_price);
		} 
	});

});

$('#user_quantity').on('input',function() {

	if($('#user_product').val() == '' || $('#user_product').val() == null) {
		var price = 0;
	} else {
		var price = localStorage.getItem('price');
	}

	if($(this).val() == '' || $(this).val() == null) {
		var qty = 1;
	} else {
		var qty = $(this).val();
	}

	var product_id = localStorage.getItem('product_id');

	// check for product quantity 
	$.post('/getProductQtyById/'+product_id, {
		'_token': $('input[name=_token]').val(),
	}, function(data) {
		var actual_qty = parseInt(data); 
		if(qty > actual_qty) {
			resetValues();
			swal({
			  title: "Error",
			  text: 'Nuk disponohet sasia e kërkuar e produktit !',
			  icon: "error",
			  buttons: false,
			});
		} else {
			var total_price = price * qty;
			$('#user_price').val(Math.floor(total_price));
		} 
	});

});

/*************
/ 	 RESET   /
*************/

function resetUserBuyForm() 
{
	$('#user-buy-form').trigger('reset');
}

function resetMemberBuyForm()
{
	$('#member-buy-form').trigger('reset');
}

function resetValues()
{
	// reset values for memeber
	$('#member_quantity').val("");
	$('#member_price').val("");

	// reset values for users
	$('#user_quantity').val("");
	$('#user_price').val("");
}