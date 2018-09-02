@if(Session::has('error'))
	
	<script>
		swal({
		  title: "Error",
		  text: '{{ Session::get('error') }}',
		  icon: "error",
		  buttons: false,
		});
	</script>

@endif