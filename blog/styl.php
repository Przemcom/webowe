<link rel="stylesheet" type="text/css" href="styl_1.css" title="bialy ekran">
<link rel="alternate stylesheet" type="text/css" href="styl_2.css" title="czerwony ekran">
<link rel="alternate stylesheet" type="text/css" href="styl_3.css" title="hiperlacze1">
<link rel="alternate stylesheet" type="text/css" href="styl_4.css" title="zielony ekran">
<link rel="alternate stylesheet" type="text/css" href="styl_5.css" title="hiperlacze2">
<link rel="alternate stylesheet" type="text/css" href="styl_6.css" title="czerwony zmieniajacy">

<script type="text/javascript">
	var bodyLoaded = setInterval(function() {
		if (document.readyState === "complete") {
			var all_styles = document.getElementsByTagName("link");
			//document.head.innerHTML.match(/<link[^>]*>/g)[1].indexOf("alternate");
			var style_menu = document.createElement("ul");
			style_menu.setAttribute("id","style_menu");
			var last_title = "";
			for(var i = 0; i < all_styles.length; i++){
				if(last_title != all_styles[i].title){ //gdy nazwa tego stylu inna niż poprzedniego, to dodajemy do menu
					last_title = all_styles[i].title;
					var elem = document.createElement("li");
					elem.innerHTML = "<a href='javascript:void(0)' onclick='changeStyle(\"" + last_title + "\")'>" + all_styles[i].title + "</a>";
					style_menu.appendChild(elem);
				}
				
				if(all_styles[i].rel.indexOf("alternate") != -1){ //styl alterantywny
					all_styles[i].disabled = true; //domyślnie niby jest ukryty, ale gdy się czyta disabled to ono mówi false zawsze
				}
			}
			document.body.prepend(style_menu);
			var tmp = document.createElement("h2");
			tmp.innerHTML = "Różne style:";
			document.body.prepend(tmp);
			checkCookie();
			clearInterval(bodyLoaded);
		}
	},100)
	
	function changeStyle(name){
		var all_styles = document.getElementsByTagName("link");
		for(var i = 0; i < all_styles.length; i++){
			if(all_styles[i].title == name){
				all_styles[i].disabled = false;
			}
			else{
				all_styles[i].disabled = true;
			}
		}
		var styled = getCookie("styled");
		if(styled != name){
			setCookie("styled",name,365);
		}
	}
	
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	
	function checkCookie() {
		var styled = getCookie("styled");
		if (styled != "") {
			changeStyle(styled);
		}
	}
	
</script>
