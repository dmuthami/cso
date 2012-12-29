function getGeodata(url,target){

featureCollection = {
"layerDefinition": null,
"featureSet": {
"features": [],
"geometryType": "esriGeometryPoint"
}
};

var httpc= new XMLHttpRequest();
var params='';
httpc.open("POST",url,true);
httpc.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
httpc.setRequestHeader("Content-Length",params.length);
httpc.send(null);
httpc.onreadystatechange=function(){
if(httpc.readyState==4 && httpc.status==200){
//alert(httpc.responseText);
var jsonResult = httpc.responseText;
result=eval('(' + jsonResult + ')');













//get the data from the Json Objects
var features = [];


//loop through the json data;
dojo.forEach(result,function(item,i){
var attr = {};

	attr["description"] ="<b>cso_name:</b>  <i>"+ item.name +"</i>" +
								"<hr><b>registrationnum.:</b>  <i>"+item.regn	+"</i>" +
								"<hr><b>csotype.:</b>  <i>"+item.typo	+"</i>" +					
								"<hr><b>mailaddress:</b> <i> <a href="+"'mailto:"+item.mail+"'"+">"+item.mail+"</a></i>"+
								"<hr><b>street:</b> <i> "+item.street+"</i>"+
								"<hr><b>building:</b> <i> "+item.building+"</i>"+
								"<hr><b>telephone:</b> <i> "+item.fone+"</i>"+
								"<hr><b>cell_phone:</b> <i> "+item.simu+"</i>"+
								"<hr><b>website :</b> <i> <a href="+"'http://"+item.site+"'"+">"+item.site+"</a></i>"+
								"<hr><b>respondent:</b> <i> "+item.res+"</i>"+
								"<hr><b>Date:</b> <i> "+item.tarehe+"</i>";
								
                                 


attr["photo"]=item.photo;
attr["pic"]=item.picha;
//icons[i]=item.icon;
 attr["picha"]=item.simu;
 //attr["mwenyewe"]=item.Ownership

var geometry = esri.geometry.geographicToWebMercator(new esri.geometry.Point(item.Longitude, item.Latitude, map.spatialReference)); //setting to the

graphic = new esri.Graphic(geometry);
graphic.setAttributes(attr);
features.push(graphic); //adding to features array

});
featureLayer.applyEdits(features, null, null);
}

};


//alert(icons[1]);
featureCollection.layerDefinition = {
"geometryType": "esriGeometryPoint",
"objectIdField": "ObjectID",
"drawingInfo": {
"renderer": {
"type": "simple",
"symbol": {
"type": "esriPMS",
"url": "./images/point.png",
"contentType": "image/gif",
"width": 8,
"height": 8
}
}
},
"fields": [{
"name": "ObjectID",
"alias": "ObjectID",
"type": "esriFieldTypeOID"
},{
"name": "description",
"alias": "Description",
"type": "esriFieldTypeString"
},{
"name": "title",
"alias": "Title",
"type": "esriFieldTypeString"
}]
};

//setTimeout("jin_ajax_loop()", 5000);
}
//end of the function for communicating with the php script;


function searchz(){
var typoz2 = document.getElementById('searchz');
var typo2 = typoz2.value;
if (!!typo2)
  {
	featureLayer.clear();
  //document.getElementById("typo").innerHTML="";
  getGeodata('db/search.php?q='+typo2, 'map');
  //return;
  } 
  else {
   getGeodata("db/load.php?q=CSO_TypeID", "map");
  }

}

function secta(){
var typoz1 = document.getElementById('secta');
var typo1 = typoz1.value;
if (!!typo1)
  {
	featureLayer.clear();
  //document.getElementById("searchz").innerHTML="";
  //document.getElementById("typo").innerHTML="";
  getGeodata("db/secta.php?q="+typo1, "map");
  //return;
  } else{
   getGeodata("db/load.php?q=CSO_TypeID", "map");
  }
}

function jin_ajax_loop() {
// url and target
var typoz = document.getElementById('typo');
var typo = typoz.value;


  if (!!typo)
  {
	featureLayer.clear();
  //document.getElementById("searchz").innerHTML="";
  getGeodata("db/load.php?q="+typo, "map");
  //return;
  } 
  else{
   getGeodata("db/load.php?q=CSO_TypeID", "map");
  }


}