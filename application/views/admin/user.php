	<style type="text/css">
		a.btn.btn-warning, a.btn.btn-danger {
			margin-right: 5px;
		}
	</style>
	<div class="container">
		<h3>Users</h3>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Eamil</th>
					<th>Hobbies</th>
					<th>Sub Hobbies</th>
				</tr>
			</thead>
		</table>
		<!-- Hobbies Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><label>Hobbies</label></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="list-group contain">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Sub Hobbie Modal -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><label>Hobbie</label></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="list-group containSub">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script type="text/javascript">
		$(document).ready(() => {
			getUser();	

			$('.table').DataTable( {
				"ajax": "<?php echo base_url() ?>AdminController/getAllUsers",
				"columns": [
				{ "data": "name" },
				{ "data": "email" },
				{ "data": function (item, index) { return "<a class='btn btn-primary' onclick='viewHobbie("+item.id+")' data-toggle='modal' data-target='#exampleModal'>View</a>"; } },
				{ "data": function (item, index) { return "<a class='btn btn-primary' onclick='viewSubHobbie("+item.id+")' data-toggle='modal' data-target='#editModal'>View</a>"; } },
				]
			});

			$('.close').click(() => {
				window.location.reload();
			});
		});

		function getUser() {
			let user = "<?php echo $this->session->userdata('admin')['name'] ?>";
			$('#user').html('<b>	'+ user +'</b>');
		}

		function viewHobbie(obj) {
			$.ajax({
				url: "<?php echo base_url() ?>HobbieController/getAllHobbiesByUser",
				type: "POST",
				dataType: "json",
				data : { id : obj},
				success: function(res) {
					if (res.status === 'success') {
						res.data.forEach(function(item, index) {
							$('.contain').append('<a href="#" class="list-group-item">'+ item.hobbie +'</a>');
						});
					} else {
						console.log(res);
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		}

		function viewSubHobbie(obj) {
			$.ajax({
				url: "<?php echo base_url() ?>SubHobbiesController/getAllSubHobbiesByUser",
				type: "POST",
				dataType: "json",
				data : { id : obj},
				success: function(res) {
					if (res.status === 'success') {
						res.data.forEach(function(item, index) {
							$('.containSub').append('<a href="#" class="list-group-item">'+item.hobbieId+' <span class="glyphicon glyphicon-circle-arrow-right"></span> '+ item.subHobbie +'</a>');
						});
					} else {
						console.log(res);
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		}
	</script>
</body>
</html>