@if (count($errors) > 0)
	<script>
		swal({
		  title: "Error",
		  text: "@foreach($errors->all() as $error) " + 
		  		"\n"+
		  		"{{ $error }}"+   
		  		"@endforeach ",
		  icon: "error",
		  buttons: false,		
		});
	</script>
@endif