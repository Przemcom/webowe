
<html>
<head>
<title>Komunikator</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<meta charset="utf-8">


<style>
#komunikator{
	width: 800px;
	height: 300px;
	border: 2px solid black;
	overflow: scroll;
}
#active{
	margin-top:10px;
}
#nick{
	width: 100px;
	height: 30px;
	margin-top:10px;
}
#text{
	width: 416px;
	height: 150px;
	margin-top:10px;
}
#send{
	width: 60px;
	height: 30px;
	background: green;
	border: 1px solid black;
	margin-top:10px;
}

label{
	padding-right:10px;
}
p{
	margin: 0;
	padding: 0;
}
</style>
<script type="text/javascript">
    function poll() {
		$.ajax({
			url: "chat_read.php",
			method: "POST",
			data: "",
			success: function (data) {
				czytaj(data);
			},
			complete: function () {
				poll();
			}
		})
    }

    $(document).ready(function(){

	tekst = "Witaj na interaktywnym komunikatorze.<br>";

        poll();

        $("#send").click(function(){
			if($("#active")[0].checked){
				wyslij();
			}
        })

    })

    function wyslij() {
		$.ajax({
			url: "chat_send.php",
			method: "POST",
			data: "dane=" + $("#text")[0].value + "&nick=" + $("#nick")[0].value
		})
        $("#text")[0].value = "";
    }

    function czytaj(oddane) {
		if(oddane != ""){
			if(!$("#active")[0].checked){
				return;
			}
				tekst = "<p>" + oddane + "</p>";
				document.getElementById("komunikator").innerHTML = tekst;
				document.getElementById("komunikator").scrollTop = 1000000;
		}
    }

    function enter(e) {
        klawisz = e.which;
        if (klawisz == 13) {
            wyslij();
        }
    }

</script>
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

			var style_menu = document.createElement("ul");
			style_menu.setAttribute("id","style_menu");
			var last_title = "";
			for(var i = 0; i < all_styles.length; i++){
				if(last_title != all_styles[i].title){
					last_title = all_styles[i].title;
					var elem = document.createElement("li");
					elem.innerHTML = "<a href='javascript:void(0)' onclick='changeStyle(\"" + last_title + "\")'>" + all_styles[i].title + "</a>";
					style_menu.appendChild(elem);
				}

				if(all_styles[i].rel.indexOf("alternate") != -1){
					all_styles[i].disabled = true;
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
</head>
<body onkeydown="enter(event)">
<div id="witaj"></div>
<div id="komunikator">Witaj w interaktywnym komunikatorze</div>
<label>Włączony</label><input type="checkbox" id="active" checked="checked"/><br/>
<label>Nick</label><input type="text" id="nick" /><br/>
<label>Wiadomość</label><input type="text" id="text" />
<div id="send">Wyślij</div>
</body>
</html>
