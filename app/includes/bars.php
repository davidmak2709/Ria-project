<div class = "container">

<? foreach ($bars as $bar): ?>
<div class = "row well">
	<div class = "col-sm-4">
		<img src="img/images.png" class = "img-circle">
	</div>
	<div class = "col-sm-8">
		<h2><a><? echo $bar->getValue("ime"); ?></a></h2><br> <!-- LINK NA STRANICU S DETALJIMA -->
		<h5>Adresa: <? echo $bar->getValue("adresa"); ?></h5>
		<h5>Ocjena: <? echo $bar->getValue("ocjena"); ?></h5>
		<h5>Opis:</h5>
		<p><? echo $bar->getValue("opis"); ?></p>
		<div class="col-sm-8" align="right"> <!-- Napraviti kada se vec prati da bude unfollow -->
		<a href="index/follow/"<? echo $bar->getValue("id_Klub");?> class="btn btn-primary" style="color: white;">Prati</a>
		</div>
	</div>
</div>

<? endforeach; ?>
</div>