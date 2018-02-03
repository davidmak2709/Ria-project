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
