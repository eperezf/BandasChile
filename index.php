<?php

include ('config.php');
$query = "SELECT `Nombre` FROM `Operadoras`";
$result = mysqli_query($conn, $query);


?>
<html>
<head>
  <meta charset="UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="/js/bootstrap-typeahead.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/theme.min.css">
</head>
<body>
<!--Inicio Navbar-->
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Pisapapeles</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Inicio</a></li>
        <li><a href="/list.php">Volver al blog</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--Fin Navbar-->
<div class="container">
	<div class="row">
		<div class="col-md-12">
	  	<h1><p class="text-center">Revisa si tu teléfono es compatible</p></h1>
		</div>
		<div class="col-md-12">
			<h4><p class="text-center">Busca el modelo de tu teléfono y la operadora que quieres usar</p></h4>
		</div>
	</div>
	<div class="row">
		<form action="result.php" method="get">
			<div class="col-md-12 col-lg-6">
				<h4><p class="text-center">Busca tu teléfono</p></h4>
				<input class="form-control" type="text" autocomplete="off" placeholder="Ej.: Apple iPhone 6s Plus" id="Telefono" name="Telefono">
					<br/>
					<br/>
				</div>
				<div class="col-md-12 col-lg-6">
					<h4><p class="text-center">Selecciona tu operadora</p></h4>
					<select class="form-control" id="Operadora" name="Operadora">
            <?php 
              while ($row = mysqli_fetch_array($result)){
                echo "<option>" . utf8_encode($row["Nombre"]) . "</option>";
              }
            ?>
					</select>
					<br/>
					<br/>
				</div>
				<div class="col-md-12 col-lg-12">
					<button type="submit" class="btn btn-success center-block">Comparar</button>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>Un proyecto</h1><img src="http://pisapapeles.net/blog/wp-content/uploads/2014/09/logopisapapeles-copy.png" class="img-responsive">
			</div>
		</div>
	</div>
	<script type="text/javascript">
      $("#Telefono").typeahead({
      	onSelect: function(item) {
        	console.log(item);
    		},
    		ajax: {
        	url: "/search.php",
        	timeout: 500,
        	displayField: "Title",
        	triggerLength: 1,
        	method: "post",
        	loadingClass: "loading-circle",
        	preDispatch: function (query) {
            //showLoadingMask(true);
            return {
              search: query
            }
        	},
        preProcess: function (data) {
          //showLoadingMask(false);
          if (data.success === false) {
            // Hide the list, there was some error
            console.log("Woops! Something went wrong!");
            return false;
          }
          // We good!
          console.log("All OK!");
          console.log(data);
          return data;
        }
    	}
    });
	</script>
</body>
</html>

