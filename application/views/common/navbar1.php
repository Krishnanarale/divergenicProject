<body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo base_url('dashboard') ?>">Divergenic</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url('users') ?>">Users</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a ><span class="glyphicon glyphicon-user" id="user"></span></a></li>
					<li><a href="<?php echo base_url('adminLogout') ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
	</div>