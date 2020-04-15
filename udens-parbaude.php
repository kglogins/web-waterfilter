<?php
if (isset($_POST["submit"]))
{
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	$district = $_POST['district'];
	$method = $_POST['method'];
	
	$email_from = 'udens_analizu_forma';
	$to = 'info@waterfilter.lv';
	$subject = "Jauns pieteikums ūdens pārbaudei no klienta $name mājaslapā";
	$email_body = "Jūs esat saņēmis jauno pieteikumu ūdens pārbaudei no klienta $name.\n".
    "Klienta e-pasts: $visitor_email \n".
	"Klienta telefons: $phone \n".
	"Pilsēta: $city \n".
	"Rajons: $district \n".
	"Ūdens ieguves veids: $method \n\n";
	
	$headers = "From: $email_from \r\n";
	$headers .= "Reply-To: $visitor_email \r\n";
	
	if(!$_POST['name']){
		$nameErr = 'Ievadiet vārdu un uzvārdu.';
	};
	if(!$_POST['email'] || IsInjected('email')){
		$emailErr = 'Ievadiet e-pastu.';
	};
	if(!$_POST['phone']){
		$phoneErr = 'Ievadiet telefonu.';
	};
	if(!$_POST['city']){
		$cityErr = 'Ievadiet pilsētu.';
	};
	if(!$_POST['district']){
		$districtErr = 'Ievadiet rajonu.';
	};
	if(!$_POST['method']){
		$methodErr = 'Ievadiet ūdens ieguves veidu.';
	};
	
	if (!$nameErr && !$emailErr && !$phoneErr && !$cityErr && !$districtErr && !$methodErr) {
		if (mail ($to, $subject, $email_body, $headers)) {
			$result='<div class="alert alert-success" role="alert"><b>Paldies!</b> Jūsu pieteikums tika nosūtīts speciālistiem. Tuvākajā laikā ar jums sazināsies mūsu uzņēmuma darbinieks.</div>';
		}else{
			$result='Nesanāca!';
		}
		
	}
}


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?> 

<!DOCTYPE html>
<html lang="lv-lv">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="waterfilter,ūdens filtri,filtri,ūdens attīrīšanas sistēmas,ūdens analīzes">
<meta name="author" content="KGLogins">
<title>Waterfilter | Ūdens filtri | Paldies</title>

<!-- favicon images-->
<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


<!-- Bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default" style="position: fixed; width: 100%; z-index: 2">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myDefaultNavbar1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="/sakums"><img src="/images/waterfilterlogo.png"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="myDefaultNavbar1">
      <ul class="nav navbar-nav">
        <li><a href="/sakums">Sākums</a></li>
        <li><a href="/par_mums">Par mums</a></li>
        <li><a href="/produkti">Produkti</a></li>
        <li><a href="/serviss">Serviss</a></li>
        <li class="active"><a href="/kontakti">Kontakti<span class="sr-only">(current)</span></a></li>
        <!--<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>     -->
      </ul>
</div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<section>
  <div class="jumbotron text-center" style="background-image: url(/images/header2.jpg); height: 300px; width: auto; background-size: cover"></div>
</section>
<section style="margin-bottom: 30px">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      	<h1>Piesakies nodot ūdens analīzes</h1>
      	<br>
      	<div class="row">
       	<form method="post" name="myemailform" action="udens-parbaude.php">
       	<div class="col-md-6 col-lg-6">
    <div class="form-group">
        <label for="name">Vārds, uzvārds</label>
        <input type="text" class="form-control" name="name" placeholder="Mārtiņš Bērziņš">
        <div class="error"><?php echo $nameErr;?></div>
    </div>
    <div class="form-group">
        <label for="email">E-pasts</label>
        <input type="email" class="form-control" name="email" placeholder="martins.berzins@inbox.lv">
        <div class="error"><?php echo $emailErr;?></div>
    </div>
    <div class="form-group">
    	<label for="phone">Telefons</label>
    	<input type="text" class="form-control" name="phone" placeholder="+371 22002248">
    	<div class="error"><?php echo $phoneErr;?></div>
    </div>
    </div>
    <div class="col-md-6 col-lg-6">
    <div class="form-group">
    	<label for="city">Pilsēta</label>
    	<input type="text" class="form-control" name="city" placeholder="Rīga">
    	<div class="error"><?php echo $cityErr;?></div>
    </div>
    <div class="form-group">
    	<label for="district">Rajons</label>
    	<input type="text" class="form-control" name="district" placeholder="Centrs">
    	<div class="error"><?php echo $districtErr;?></div>
    </div>
    <div class="form-group">
    	<label for="method">Ūdens ieguves veids</label>
    	<input type="text" class="form-control" name="method" placeholder="No akas">
    	<div class="error"><?php echo $methodErr;?></div>
    </div>
    </div>
    <div class="col-md-6 col-lg-6">
    <button type="submit" name="submit" value="submit" class="btn btn-default">Sūtīt ziņu</button>
    </div>
    <div class="col-md-6 col-lg-6">
    	<?php echo $result;?>
    </div>
    </div>
	   </form>
     </div>
      </div>
    </div>
  </div>
</section>
<div class="section well">
    <div class="container">
   	  <div class="row">
		<div class="col-md-6 col-lg-6">
		  <h3 class="text-center">Oficiālais izplatītājs</h3>
          <address class="text-left">
  			<strong>SIA "WH Latvija"</strong><br>
			Reģistrācijas Nr. 40203045683<br>
			Juridiskā adrese : Kadiķu iela 15, Dreiliņi, Stopiņu nov., LV-2130<br>
			Faktiskā adrese : Elijas iela 11-6, LV-1050<br>
			Banka : A/S SWEDBANK<br>
			KONTS : LV80HABA0551043082194<br>
			SWIFT : HABALV22<br>
		  </address>
		 <h3>Tālrunis: &nbsp;+371 22002248</h3><br>
		</div>
		<div class="col-md-offset-0 col-lg-offset-0 col-sm-2 col-md-3 col-lg-3 col-xs-6" style="padding: 0px"><p style="text-align: center"><img src="/images/25GSG.png" style="width: 100px"></p>
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3 col-xs-6" style="padding: 0px"><p style="text-align: center"><img src="/images/5_GGLOGO.png" style="width: 100px"></p>
       	 </div>
		<div class="col-md-2 col-lg-2 col-sm-3 col-xs-6" style="padding: 0px"><p style="text-align: center"><img src="/images/aqua_espana.jpg" style="width: 130px"></p>
         </div>
		<div class="col-md-2 col-lg-2 col-sm-2 col-xs-6" style="padding: 0px"><p style="text-align: center"><img src="/images/logo_oca.jpg" style="width: 130px"></p>
        </div>
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12" style="padding: 0px"><p style="text-align: center"><img src="/images/water_quality.jpg" style="width: 130px"></p>
		</div>
      </div>
  	</div>
	<div class="side-button" id="udens-analizes">
 		<a title="Nodod analīzes" href="#" style="text-decoration: none"><p>Piesakies nodot ūdens analīzes</p></a>
	</div>
	<div class="side-button" id="te-ir-darbs">
 		<a title="Te ir darbs" href="/te_ir_darbs" style="text-decoration: none"><p>Te ir darbs</p></a>
	</div><!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="/js/jquery-3.2.1.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="/js/bootstrap.js"></script>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p>© 2017 Water & Health</p>
      </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="https://www.facebook.com/karlis.gustavs.l" target="_blank" class="madebykglogins">MADE BY <j class="kglogins">KGLOGINS</j></a></div>
    </div>
  </div>
</footer>
</body>
</html>