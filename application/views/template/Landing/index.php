<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
	<title>Page</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/css/style.css">
</head>
<body>
	<!-- Main Content -->
	<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<!-- <div class="col-md-4 text-center company__info">
				<span class="company__logo">
                    <h2><span class="fa fa-motorcycle"></span></h2>
                </span>
				<h4 class="company_title">Daeler Honda</h4>
			</div> -->
			<div class="col-md-12 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
						<h2>Input Data</h2>
					</div>
					<div class="row">
                    <form name="formlogin" id="formlogin" method="post" action="<?php echo base_url('Controller/proses'); ?>">
							<div class="row">
                                <input type="text" name="input" class="form__input" placeholder="Input Nama[Spasi]Usia[spasi]Kota" id="input" required>
                                <span class="invalid-feedback"></span>
							</div>
							<div class="row">
                                <button type="submit" class="btn" onclick="validation()" >Submit</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="container-fluid text-center footer">
		Coded with &hearts; by <a href="#">Anan</a></p>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- Custom JavaScript -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/js/script.js"></script>
</body>
</html>
