var labelType, useGradients, nativeTextSupport, animate, json;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};

function showHint(user,topic,day)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
	xmlhttp.open("GET","init.php?user="+user+"&topic="+topic+"&day="+day,false);
	xmlhttp.send();
    //json = xmlhttp.responseText;
	//document.getElementById("inner-details").innerHTML = json;
	//json = { "id": "347_0", "name": "Nine Inch Nails", "children": [] } ;
	json_str = xmlhttp.responseText;
	json = eval("(" + json_str + ')');
 
};

function init(topic,user,day,postid){
    //init data
     //json = {};
	//user = "Farshid";
	showHint(user,topic,day);
    var infovis = document.getElementById('infovis');
    var w = infovis.offsetWidth - 50, h = infovis.offsetHeight - 50;
    
    //init Hypertree
    var ht = new $jit.Hypertree({
      //id of the visualization container
      injectInto: 'infovis',
      //canvas width and height
      width: w,
      height: h,
      //Change node and edge styles such as
      //color, width and dimensions.
      Node: {
          dim: 7,
          color: "#00F",
		  type: 'circle' 
      },
      Edge: {
          lineWidth: 2,
          color: "#088",
		  type: 'hyperline'
      },
      onBeforeCompute: function(node){
          Log.write("centering");
      },
      //Attach event handlers and add text to the
      //labels. This method is only triggered on label
      //creation
      onCreateLabel: function(domElement, node){
//          domElement.innerHTML = node.name;

// 	Farshid show id or name on labels 	
          domElement.innerHTML = node.name.substring(0,25);
		  if (node.name.length > 25) {
		  domElement.innerHTML += "...";
		  }
		  
// Farshid add read in DB 	
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	

          $jit.util.addEvent(domElement, 'click', function () {
			ht.onClick(node.id);
			// Farshid mark flag nodes as read
			node.data['read'] = true; 
			xmlhttp.open("GET","read.php?user="+user+"&id="+node.id,false);
			xmlhttp.send();
			html2 = xmlhttp.responseText;			

});
      },
      //Change node styles when labels are placed
      //or moved.
      onPlaceLabel: function(domElement, node){
          var style = domElement.style;
          style.display = '';
          style.cursor = 'pointer';
          if (node._depth <= 1) {
              style.fontSize = "0.8em";
              style.color = "#000";
			  //style.color = "#ddd";
//			  node.color = "#FFF";

          } else if(node._depth == 2){
              style.fontSize = "0.7em";
              style.color = "#555";

          } else {
              style.display = 'none';
          }

          var left = parseInt(style.left);
          var w = domElement.offsetWidth;
          style.left = (left - w / 2) + 'px';
      },
      
      onAfterCompute: function(){
          
          //Build the right column relations list.
          //This is done by collecting the information (stored in the data property) 
          //for all the nodes adjacent to the centered node.
          var node = ht.graph.getClosestNodeToOrigin("current");
          var html = "<br><font size=+1><b>" + node.name + "</b><br></font> By " + node.data.author + ", " + node.data.date + "</font><br><br>";
          html += node.data.body;// + "<ul>";
          
		  Log.write("<a href=\"forum.php?user="+user+"&topic="+topic+"&day="+day+"&id=0"+"\">Reset</a>&nbsp;&nbsp;&nbsp; <a href=\"forum.php?user="+user+"&topic="+topic+"&day="+day+"&id="+node.id+"\">Refresh</a>");
		  
		  node.eachAdjacency(function(adj){
              var child = adj.nodeTo;
              //if (child.data) {
               //   var rel = (child.data.band == node.name) ? child.data.relation : node.data.relation;
                //  html += "<li>" + child.name + " " + "<div class=\"relation\">(relation: " + rel + ")</div></li>";
              //}
          });
          //html += "</ul>";
          $jit.id('inner-details').innerHTML = html;
		  $jit.id('reply').innerHTML = " Reply to: <b>" + node.name.substring(0,25) + "</b>";
		  if (node.name.length > 25) {
		  	$jit.id('reply').innerHTML += "...";
		  }
		  $jit.id('reply2').innerHTML = " Reply to: <b>" + node.name + "</b> <br> (or navigate to another post and continue composing your reply)";

		  //$jit.id('author').value = username; //node.data.author;
		  //$jit.id('subject').value = "Re:"+node.name;
		  $jit.id('id').value = node.id;
		  
      }
    });
	
    //load JSON data.
    ht.loadJSON(json);
    //compute positions and plot.
    ht.refresh();
    //end
    ht.controller.onAfterCompute();
 ht.onClick(postid);
}
