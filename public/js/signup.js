function inputDisable(){
	var pwd = document.getElementsByName("password");
	if(pwd && pwd[0].value && pwd[1].value){
		pwd[0].readOnly = true;
		pwd[1].readOnly = true;
	}

	var name = document.getElementsByClassName("name");
	if(name && name[0].value && name[1].value){
		name[0].readOnly = true;
		name[1].readOnly = true;
	}

	var name = document.getElementsByClassName("email");
	if(name && name[0].value && name[1].value){
	name[0].readOnly = true;
	name[1].readOnly = true;

	}
}

function userInput(){
	if(document.getElementById('type_user').checked){
		document.getElementById('vlasnik').style.display = 'none';
		document.getElementById('korisnik').style.display = 'block';
	} else {
		document.getElementById('korisnik').style.display = 'none';
		document.getElementById('vlasnik').style.display = 'block';
	}
						
}

window.onload = userInput;