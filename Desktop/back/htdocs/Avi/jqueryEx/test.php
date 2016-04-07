<html>
<head>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("button").click(function(){
    //$("p").hide();
	//$("div.main_div").find('p.intro').css({"background-color":"yellow","font-size":'30px'});
	//$("p").toggle(1000);
	/* $("p").hide(1000,function(){
  alert("The paragraph is now hidden");
  }); */
	$("div.main_div").text('Hello my name is vijay.')
  });
});
</script>
</head>

<body>
<h2 class="intro" >This is a heading</h2>
<p class="intro" >This is a paragraph.</p>
<p class="intro">This is another paragraph.</p>
<div class="main_div">
<p class="intro2" >This is a paragraph.</p>
<p class="intro1">This is another paragraph.</p>
</div>
<button>Click me</button>
</body>
</html>