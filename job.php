<?php
	$result = "";

	if (isset($_POST['submit'])) {

		require 'phpmailer/PHPMailerAutoload.php';

		function sendemail($to, $from, $fromName, $body, $attachment) {
			$mail = new PHPMailer();
			$mail->setFrom($from, $fromName);
			$mail->addAddress($to);
			$mail->addAttachment($attachment);
			$mail->Subject = 'Jauns darba pieteikums';
			$mail->Body = $body;
			$mail->CharSet = 'UTF-8';
			$mail->isHTML(false);

			return $mail->send();
		}

		if(!$_POST['name']){
			$nameErr = 'Ievadiet vārdu un uzvārdu!';
			$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
		};
		if(!$_POST['email']){
			$emailErr = 'Ievadiet e-pastu!';
			$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
		};
		if(!$_POST['phone']){
			$phoneErr = 'Ievadiet telefonu!';
			$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
		}else{
			if(!is_numeric($_POST['phone'])){
				$phoneErr = 'Ievadiet derīgu telefonu!';
				$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
			};
		};
		if(!$_POST['message']){
			$messageErr = 'Ievadiet motivācijas vēstuli!';
			$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
		};

		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$phone = $_POST['phone'];
		$body = "Ir saņemts jauns darba pieteikums, kas tikka nosūtīts no mājaslapas darba pieteikuma formas!\n\n".
			"Vārds, uzvārds: $name\n".
			"E-pasts: $email\n".
			"Telefons: $phone\n\n".
			"Motivācijas vēstule\n\n$message\n\n\n".
			"CV skatīt pielikumā!\n\n\n".
			"Waterfilter.lv automātiskais sūtītājs";
		$file = "uploads/" . basename($_FILES['attachment']['name']);
		if (move_uploaded_file($_FILES['attachment']['tmp_name'], $file)) {
			if (!$nameErr && !$emailErr && !$phoneErr && !$messageErr && !$attachmentErr) {
				if (sendemail('info@waterfilter.lv', 'te_ir_darbs', $name, $body, $file)) {
					$result = 'Paldies, esam saņēmuši jūsu darba pieteikumu!';
				}else{
					$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
				}
			}else{
				$result = 'Neizdevās nosūtīt jūsu darba pieteikumu! Mēģiniet vēlreiz!';
			}
		}else{
			$attachmentErr = "Lūdzu pārbaudiet jūsu pielikumu!";
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
<title>Waterfilter | Ūdens filtri | Te ir darbs</title>

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
        		<h1>TE IR DARBS</h1>
				<p style="padding-top: 10px; font-size: 15px;">Meklējam konsultantu/-ti ātri augošā uzņēmumā ar izaugsmes iespējām. Dinamisks darbs ar iespēju plānot savu laiku.</p>
				<p>Mēs meklējam:</p>
				<ul style="list-style-type: circle">
					<li>Jaunu un enerģisku cilvēku</li>
					<li>Runātīgu</li>
					<li>Sabiedrisku</li>
				</ul>
				<p>Mēs piedāvājam:</p>
				<ul style="list-style-type: circle">
					<li>Konkurētspējīgu atalgojumu ar bonusa sistēmu</li>
					<li>Lielisku kolektīvu</li>
					<li>Apmācības, komandējumi</li>
					<li>Saliedēšanās pasākumi</li>
				</ul>
				<p>Iesūti savu pieteikumu vēstulē vai uz info@waterfilter.lv</p>
				<br>
	  		</div>
	  		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	  			<h2 id="form">Aizpildi pieteikuma vēstuli šeit</h2>
	  		</div>
      		<form method="post" name="myemailform" action="job.php#form" enctype="multipart/form-data">
      			<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
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
        				<label for="tel">Telefons</label>
        				<input type="tel" class="form-control" name="phone" placeholder="22002248">
        				<div class="error"><?php echo $phoneErr;?></div>
    				</div>
    			</div>
    			<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
    				<div class="form-group">
    					<label for="message">Motivācijas vēstule</label>
    					<textarea name="message" class="form-control" placeholder="Kāpēc jūs esat labākais?" style="resize: vertical; min-height: 58px"></textarea>
    					<div class="error"><?php echo $messageErr;?></div>
    				</div>
    				<div class="form-group">
    					<label for="file">CV</label>
    					<input type="file" name="attachment" class="filestyle" data-buttonText="Augšuplādē savu CV" data-placeholder="Nav atzīmēta faila">
    					<div class="error"><?php echo $attachmentErr;?></div>
    				</div>
    				<div class="form-group btn-result">
    					<button type="submit" name="submit" value="Send Email" class="btn btn-default">Sūtīt ziņu</button>
						<div class="result"><?php echo $result;?></div>
    				</div>
				</div>
			</form>
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
 		<a title="Nodod analīzes" href="/udens_parbaude" style="text-decoration: none"><p>Piesakies nodot ūdens analīzes</p></a>
	</div>
	<div class="side-button" id="te-ir-darbs">
 		<a title="Te ir darbs" href="#" style="text-decoration: none"><p>Te ir darbs</p></a>
	</div><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/js/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
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
