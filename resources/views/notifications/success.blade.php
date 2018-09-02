@if(Session::has('success'))
	
	<script>
		swal({
		  title: "Success",
		  text: '{{ Session::get('success') }}',
		  icon: "success",
		  buttons: false,
		});
	</script>

@endif