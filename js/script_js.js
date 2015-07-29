function getXhr(){
	var xhr = null; 
	
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
		try {
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else { // XMLHttpRequest non supporté par le navigateur 
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
		xhr = false; 
	} 
	
	return xhr;
}


function go(){
	var xhr = getXhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
	
			document.getElementById('inputSousCategorie').innerHTML = leselect;
		}
	}
	
	
	xhr.open("POST","load_sous_categories.php",true);
	
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	sel = document.getElementById('inputCategorie');
	idcategorie = sel.options[sel.selectedIndex].value;
	xhr.send("id_categorie="+idcategorie);
}

function go_tri(){
	var xhr = getXhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
	
			document.getElementById('selectTriSousMatrice').innerHTML = leselect;
		}
	}
	
	
	xhr.open("POST","load_sous_categories.php",true);
	
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	sel = document.getElementById('selectTriMatrice');
	idcategorie = sel.options[sel.selectedIndex].value;
	xhr.send("id_categorie="+idcategorie);
}