<nav class="navbar navbar-default">
  	<div class = "container-fluid">
  	<div class = "navbar-header">
  		<a class = "navbar-brand" href="">Home</a>
  	</div>
		<ul class = "list-inline">  <!-- DODATI RAZNE LINKOVE -->
		  <li><a href="#">Menu 1</a></li>
		  <li><a href="events">EVENTI</a></li>
		  <li><a href="#">Menu 3</a></li>
		  <li><a href="#">Menu 4</a></li>
		</ul>
		<?php
			if (!$this->session->has("id")) {
				echo '
			<ul class = "list-inline">
				<li><a href="login"><span class = "glyphicon glyphicon-log-in">Prijava</span></a></li>	
				<li><a href="signup"><span class = "glyphicon glyphicon-user">Registracija</span></a></li>
			</ul>';
			}else{
				echo '
		<ul class = "list-inline">
			<li><a href="profile"><span class = "glyphicon glyphicon-user">
			 '.$this->session->get("ime").'</span></a></li>
			<li><a href="login/logout"><span class = "glyphicon glyphicon-log-out"> Odjava</span></a></li>
		</ul>
';
			}
		?>
	</div>
</nav>
