	<style type="text/css">
		a.btn.btn-warning, a.btn.btn-danger {
			margin-right: 5px;
		}
	</style>
	<div class="container">
		<h3>Hobbies</h3>
		<button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#exampleModal">Add Hobbie</button>
		<table class="table table-bordered">
			<thead>
				<tr>
					<!-- <th>Sr</th> -->
					<th>Hobbie</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><label>Hobbie</label></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="add">
							<div class="form-group editFrom">
								<label for="hobbie">Hobbie:</label>
								<input type="text" class="form-control" id="hobbie" name="hobbie">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary addHobbie">Add</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Delete Modal -->
		<!-- Modal -->
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
						<form>
							<div class="form-group editFrom">
								<label for="id">Are you sure to delete!</label>
								<input type="hidden" class="form-control" id="id" name="id">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger">Delete</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script type="text/javascript">
		$(document).ready(function () {
			getUser();	

			$('.table').DataTable( {
				"ajax": "<?php echo base_url() ?>HobbieController/getAllHobbies",
				"columns": [
				// { "data": "id" },
				{ "data": "hobbie" },
				{ "data": function (item, index) { return "<a class='btn btn-warning' onclick='editHobbie("+item.id+")' data-toggle='modal' data-target='#exampleModal'>Edit</a><a class='btn btn-danger' onclick='deleteHobbie("+item.id+")' data-toggle='modal' data-target='#editModal'>Delete</a>"; } },
				]
			});

			$('.addHobbie').click(function() {
				if ($('#hobbie').val() === '') {
					alert('Hobbie can not be empty.');
				} else {
					let data = $("#add").serialize();
					let id = $('#hobbie').attr('alt');
					let url = '';
					if ($('#hobbie').hasClass('editMode')) {
						url = "<?php base_url() ?>HobbieController/updateHobbie/"+id;
					} else {
						url = "<?php base_url() ?>HobbieController/addHobbie";
					}
					$.ajax({
						url: url,
						type: "POST",
						dataType: "json",
						data : data,
						success: function(res) {
							if (res.status === 'success') {
								window.location.reload();
							} else {
								alert(res.error);
								console.log(res);
							}
						},
						error: function(err) {
							console.log(err);
						}
					});
				}
			});

			$('.btn-danger').click(function() {
				$.ajax({
					url: "<?php echo base_url() ?>HobbieController/deleteHobbie",
					type: "POST",
					dataType: "json",
					data : { id : $('#id').val()},
					success: function(res) {
						if (res.status === 'success') {
							window.location.reload();
						} else {
							console.log(res);
						}
					},
					error: function(err) {
						console.log(err);
					}
				});
			});
		});

		function getUser() {
			let user = "<?php echo $this->session->userdata('user')['name'] ?>";
			$('#user').html('<b>	'+ user +'</b>');
		}

		function editHobbie(obj) {
			$.ajax({
				url: "<?php base_url() ?>HobbieController/getHobbie",
				type: "POST",
				dataType: "json",
				data : {id : obj},
				success: function(res) {
					if (res.status === 'success') {
						$('#hobbie').val(res.data[0].hobbie);
						$('#hobbie').attr('alt', res.data[0].id);
						$('#hobbie').addClass('editMode');
					} else if (res.status === 'failed') {
						console.log(res);
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		}

		function deleteHobbie(obj) {
			$('#id').val(obj);
		}

	</script>
</body>
</html>