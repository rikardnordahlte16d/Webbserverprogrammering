<html>
	<head>
	<title>Javascript</title>
	</head>
	
	<body>
		<button onmousedown="pressed()">Click</button>
		<br><br>
		<img onmouseover="bigger(this)" onmouseleave="smaller(this)" id="bild" src="bild.png" width=200 height=200>
		<br><br>
		<button onmousedown="hide()">Hide</button>
		<button onmousedown="changeColor()">Change color</button>
		<button onmousedown="clear()">Clear website</button>
		<script>
			function pressed() {
				alert("Pressed!");
			}
			function bigger(image) {
				image.style.height = "400px";
				image.style.width = "400px";
			}
			function smaller(image) {
				image.style.height = "200px";
				image.style.width = "200px";
			}
			function hide() {
				var image = document.getElementById("bild");
				if(image.style.display == "none") {
					image.style.display = "inline";
				} else {
					image.style.display = "none";
				}
			}
			function changeColor() {
				document.body.style.backgroundColor = "red";
			}
		</script>
	</body>
</html>