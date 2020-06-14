	<div class="container">
		<h3>Dashborad</h3>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Most Hobbies</div>
					<div class="panel-body">
						<div class="list-group contain">
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Most Sub Hobbies</div>
					<div class="panel-body">
						<div class="list-group containSub">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script type="text/javascript">
		$(document).ready(function () {
			getUser();	

			$.ajax({
				url: "<?php echo base_url() ?>HobbieController/getUserOfMostHobbies",
				type: "POST",
				dataType: "json",
				data : {},
				success: function(res) {
					if (res.status === 'success') {
						$('.contain').append('<a href="#" class="list-group-item">'+ res.data[0].user +'<span class="badge">'+res.data[0].mostHobbies+'</span></a>');
					} else {
						console.log(res);
					}
				},
				error: function(err) {
					console.log(err);
				}
			});

			$.ajax({
				url: "<?php echo base_url() ?>SubHobbiesController/getUserOfMostSubHobbies",
				type: "POST",
				dataType: "json",
				data : {},
				success: function(res) {
					if (res.status === 'success') {
						$('.containSub').append('<a href="#" class="list-group-item">'+ res.data[0].userId +'<span class="badge">'+res.data[0].mostSubHobbies+'</span></a>');
					} else {
						console.log(res);
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		});

		function getUser() {
			let user = "<?php echo $this->session->userdata('admin')['name'] ?>";
			$('#user').html('<b>	'+ user +'</b>');
		}
	</script>
</body>
</html>