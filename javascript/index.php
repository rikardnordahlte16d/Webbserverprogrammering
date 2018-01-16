<html>
	<head>
	<title>Javascript</title>
	<style>
		#colorbox {
			width:50px;
			height:50px;
			background-color:red;
		}
	</style>
	</head>
	
	<body>
		<div id="page">
			<button onmousedown="pressed()">Click</button>
			<br><br>
			<img onmouseover="bigger(this)" onmouseleave="smaller(this)" id="bild" src="bild.png" width=200 height=200>
			<br><br>
			<button onmousedown="hide()">Hide/Show</button>
			<button onmousedown="changeColor()">Change color</button>
			<button onmousedown="clearPage()">Clear website</button>
			<br><br>
			<div id="colorbox" onmousedown="changeColorBox()"></div>
			<br><br>
			
			<div id="counter">
				<p id="number">0</p>
				<button onmousedown="increase(1)">1</button>
				<button onmousedown="increase(10)">10</button>
				<button onmousedown="increase(100)">100</button>
				<br>
				<button onmousedown="resetcounter()">Reset</button>
			</div>
		</div>
		<p id="cleartext"></p>
		
		<script>
			var counter = 0;
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
				document.body.style.backgroundColor = "purple";
			}
			function clearPage() {
				document.getElementById("page").style.display = "none";
				document.getElementById("cleartext").innerHTML = "Page cleared!";
			}
			function changeColorBox() {
				var box = document.getElementById("colorbox");
				if(box.style.backgroundColor == "" || box.style.backgroundColor == "red") {
					box.style.backgroundColor = "blue";
				} else if (box.style.backgroundColor == "blue") {
					box.style.backgroundColor = "green";
				} else if (box.style.backgroundColor == "green") {
					box.style.backgroundColor = "red";
				}
			}
			function increase(x) {
				counter += x;
				document.getElementById("number").innerHTML = counter;
			}
			function resetcounter() {
				counter = 0;
				document.getElementById("number").innerHTML = counter;
			}
		</script>
	</body>
</html>