<!DOCTYPE html>
<html>
<head>
<script language="javascript" type="text/javascript" src="graf/examples/lib/jquery-1.7.1.min.js"></script>
</head>
<body>
<style>
.containerdiv { float: left; position: relative; } 
.object { position: absolute; width: 200px;
    height: 400px;
    top: 0px;
    right: -200px; } 
.temp { background-color: #00FF00; padding: 0.1em } 
}
#c3004 { position: absolute; width: 28px;
    height: 28px;
    top: 272px;
    left: 705px; } 
#r3000 { position: absolute; width: 28px;
    height: 28px;
    top: 302px;
    left: 205px; } 
#r3008 { position: absolute; width: 28px;
    height: 28px;
    top: 253px;
    left: 252px; } 
#oid1  { position: absolute; 
	/*width: 28px;
    height: 28px;*/
    top: 28px;
    left: 752px; }
// 253, 252
</style>
<div id="x"></div>
<div class="containerdiv" id="plan">
<img src="Uppsala-Micro-plan3.png" usemap="#sensors">
<!--
<map name="sensors">
<area shape="rect" coords="700,202,755,305" href="map-and-area-elements.htm" alt="Left" title="Left">
<area shape="rect" coords="50,0,100,50" href="map-and-area-elements.htm" alt="Right" title="Right">
</map>
    <a href="map-and-area-elements.htm">
    <img class="dator" id="c3004" border="0" src="figure1.png" alt="Dator" ></a>
    <img class="router" id="r3000" border="0" src="figure1.png" alt="">
    <img class="router" id="r3008" border="0" src="figure1.png" alt="">
-->
	<div class="temp" id="oid1" title="inkubator">20&deg;C</div>
</div>
<div class="object">Add: <input type="text" id="new" value="">
	Selected <span id="selected"></span>
<span></span><span></span>
</div>
<script>
    $("#plan").mousemove(function(e){
      var pageCoords = "( " + e.pageX + ", " + e.pageY + " )";
      var clientCoords = "( " + e.clientX + ", " + e.clientY + " )";
      $("span:first").text("( e.pageX, e.pageY ) - " + pageCoords);
      $("span:last").text("( e.clientX, e.clientY ) - " + clientCoords);
    });
     $(".router").mouseover(function(e){
      $("#new").val(this.id);
      //.text("( e.offsetX, e.offsetY ) - " + e.offsetX+", "+e.offsetY);
    });
     $(".router").click(function(e){
      $("#selected").text("Router"); 
      $("#new").val(this.id);
      //.text("( e.offsetX, e.offsetY ) - " + e.offsetX+", "+e.offsetY);
    });
     $(".rlist").click(function(e){
      //$("#selected").text("Router"); 
      $("#new").val(this.text	);
      //.text("( e.offsetX, e.offsetY ) - " + e.offsetX+", "+e.offsetY);
    });
    $("#plan").click(function(e){
      var pageCoords = "( " + e.pageX + ", " + e.pageY + " )";
      var clientCoords = "( " + e.offsetX + ", " + e.offsetY + " )";
      $("#x").text("( e.pageX, e.pageY ) - " + pageCoords)
      .text("( X, Y ) - " + clientCoords);
      var mydiv = $("#new").val();
      if( $('#new').val().length != 0 ) {
      		if ( $("#"+mydiv).length == 0 ) {	
      			$("#plan").append("<img class='router' id='"+mydiv+"' border='0' src='figure1.png' alt=''>"); }
      		$("#"+mydiv).css({"position": "absolute", "width": "28px",
    		"height": "28px",
    		"top": e.offsetY,
    		"left": e.offsetX});}
    });
//$("div:first").text("hje");

$.getJSON('net.json', function(data) {
  var items = [];
 
  $.each(data, function(key, val) {
    items.push('<li class="rlist" id="' + key + '">' + val.name + '</li>');
    $("#plan").append("<img class='router' id='"+key+"' border='0' src='figure1.png' alt='"+ val.name +"' title='"+ val.name +"'>"); 
    $("#"+key).css({"position": "absolute", "width": "28px",
    		"height": "28px",
    		"top": val.y,
    		"left": val.x});
  });
 
  $('<ul/>', {
    'class': 'my-new-list',
    html: items.join('')
  }).appendTo('.object');
});

$.getJSON('objects.json', function(data) {
 
  $.each(data, function(key, val) {
    $("#plan").append('<div class="temp" id="oid'+key+'" title="'+val.name+'">' + val.value + val.type + '</div>'); 
      		$("#oid"+key).css({"position": "absolute", 
    		"top": val.y,
    		"left": val.x});
  });
 

});

</script>


</body>
</html>