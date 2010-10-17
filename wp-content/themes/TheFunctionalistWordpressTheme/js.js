	function openAndHide(id){
		var a = document.getElementsByTagName('div');
		for(b=0;a[b];b++){
			if(a[b].getAttribute('class') == 'hidden' || a[b].getAttribute('className') == 'hidden'){
				a[b].style.display = "none";
			}
		}
		document.getElementById(id).style.display = "block";
	}