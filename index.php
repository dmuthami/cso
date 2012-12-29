<!DOCTYPE HTML>
<?php
/*
 * Comment code below since the database is not set up yet.
    include('db/connection.php');
    $q=$_GET["q"];  
*/ 
?>
  <html>  
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7,IE=9" />
    <!--The viewport meta tag is used to improve the presentation and behavior of the samples 
      on iOS devices-->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
	<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
    <title> 
    </title> 

	<!-- Style element goes here -->
    <link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/3.0/js/dojo/dijit/themes/claro/claro.css">    
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <!--link rel="stylesheet" type="text/css" href="css/div3.css"-->
	<link rel="stylesheet" type="text/css" href="css/jah.css">
	<!-- ArcGIS Javascript Stylesheets -->    
	
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.5/js/esri/dijit/css/Popup.css"/>
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.0/js/dojo/dojox/grid/resources/Grid.css">
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.0/js/dojo/dojox/grid/resources/tundraGrid.css">
	<link rel="stylesheet" type="text/css" href="http://serverapi.arcgisonline.com/jsapi/arcgis/2.5/js/dojo/dijit/themes/claro/claro.css">
		
    <script type="text/javascript"> 
      var djConfig = {
        parseOnLoad: true,
		baseUrl: './',
					  modulePaths: {
						// if use local copy, make sure the path reference is relative to 'baseUrl', e.g.:
						//'agsjs': '../build/agsjs'
						// use absolute path for online version. Note sometimes googlecode.com can be slow.
						'agsjs': 'http://gmaps-utility-gis.googlecode.com/svn/tags/agsjs/1.07/build/agsjs'
					  }		
      };
    </script> 
		
	
	<!--link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script-->
	
	<!-- ArcGIS Javascript API's -->	
    <!--<script type="text/javascript" src="http://serverapi.arcgisonline.com/jsapi/arcgis/?v=3.1"></script> -->
   
	<script type="text/javascript" src="http://serverapi.arcgisonline.com/jsapi/arcgis/?v=2.5"></script>
	
	<!-- Load external scripts -->
	<script type="text/javascript" src="js/csoMap.js"></script>		
	<script type="text/javascript" src="js/csoWin.js"></script>
	<script type="text/javascript" src="js/csoSearch.js"></script>
		<script type="text/javascript" src="js/jah.js"></script>	

	<!-- Load jQuery and jQuery UI via Google AJAX Libraries API-->
	<link rel="stylesheet" href="js/themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.mouse.js"></script>
	<script src="js/ui/jquery.ui.sortable.js"></script>
	<script src="js/ui/jquery.ui.accordion.js"></script>
	
    <script type="text/javascript"> 
		dojo.require("dijit.dijit"); // optimize: load dijit layer
		dojo.require("dijit.layout.BorderContainer");
		dojo.require("dijit.layout.ContentPane");
		dojo.require("esri.map");
		dojo.require("esri.virtualearth.VETiledLayer");
		dojo.require("dijit.TitlePane");
		dojo.require("esri.dijit.BasemapGallery");
		dojo.require("esri.arcgis.utils");
		dojo.require("agsjs.layers.GoogleMapsLayer");	
		dojo.require("esri.layers.FeatureLayer");
		
		//Required for WMS support
		dojo.require("dijit.layout.AccordionContainer");
		dojo.require("esri.geometry");
		dojo.require("esri.layers.wms");

      //show map on load 
      dojo.addOnLoad(initBaseMap);
    </script> 
	
	<script>
	$(function() {
		$( "#accordion" )
			.accordion({
				header: "> div > h3"
			})
			.sortable({
				axis: "y",
				handle: "h3",
				stop: function( event, ui ) {
					// IE doesn't register the blur when sorting
					// so trigger focusout handlers to remove .ui-state-focus
					ui.item.children( "h3" ).triggerHandler( "focusout" );
				}
			});
	});
	</script>
	<script type="text/javascript">
                $(function() {
                $(".btmiddle").click(function() {
                    if ($(".btmiddle").hasClass("bt")) {
                        $(".btmiddle").removeClass("bt");
                        $(".btmiddle").addClass("clicked");
                        $("#menu").show();
                    } else {
                        $(".btmiddle").removeClass("clicked");
                        $(".btmiddle").addClass("bt");
                        $("#menu").hide();
                    }
                });
            });
			
			$(function() {
                $(".btright").click(function() {
                    if ($(".btright").hasClass("bt")) {
                        $(".btright").removeClass("bt");
                        $(".btright").addClass("clicked");
                        $("#gallery").show();
                    } else {
                        $(".btright").removeClass("clicked");
                        $(".btright").addClass("bt");
                        $("#gallery").hide();
                    }
                });
            });
        </script>
  </head> 

  <body class="claro"> 
	<!-- Map area-->  
    <div id="base" dojotype="dijit.layout.BorderContainer" design="headline" gutters="false" style="width:100%;height:100%;margin:0;">
		<div id="map" dojotype="dijit.layout.ContentPane" addarcgisbasemaps="true" region="center" style="border:1px solid #000;padding:0;">
		  <!--div style="position:absolute; right:20px; top:10px; z-Index:999;">
			<div dojoType="dijit.TitlePane" title="Switch Basemap" closable="false"  open="false">
			  <div dojoType="dijit.layout.ContentPane" style="width:380px; height:280px; overflow:auto;">
			  <div id="basemapGallery" ></div></div>
			</div>
		  </div-->
		  
		  <div id="box"  style="position:absolute; right:30%;  z-Index:999;">
    <input type="text" name="searchz" id="searchz"><a href="javascript: searchz();" class="bt btleft"><span>&#9734;</span> Search</a>
    <a href="#" class="bt btmiddle">Reports <span>&#9660;</span></a>
    <a href="#" class="bt btmiddle1">Share this <span>&#9660;</span></a>
	<a href="#" class="bt btright">Switch Basemap <span>&#9660;</span></a>
	
</div>
<div id="menu" style="position:absolute; left:40%; top:15%; z-Index:999;">
    <div id="triangle"></div>
    <div id="tooltip_menu">
        <a href="#" class="menu_top">
            <img src="img/1.png"/>
            Graphs
        </a>
        <a href="#">
            <img src="img/2.png"/>
            Charts
        </a>
        <a href="#" class="menu_bottom">
            <img src="img/3.png"/>
            Tabular
        </a>
    </div>
</div>


<div id="gallery" dojoType="dijit.layout.ContentPane" style="position:absolute; width:55%; top:20%; left:20%; height:auto; z-Index:999; overflow:auto;">
<div id="basemapGallery" ></div></div>

<div style="position:absolute; right:10px; top:10px; z-Index:999;">
<div id="accordion" STYLE="font-family: Arial Black; width:auto; font-size: 10px; color: black">
	<div class="group">
		<h3><a href="#">Search By Category</a></h3>
		<div>
		 <form>
	<select name="typo" id="typo" onchange="jin_ajax_loop()">
	<option value="">Select Category</option>
	<?php
  $query = "SELECT * FROM `tbl_typology`;";
$result = mysql_query($query); 


while ($row = mysql_fetch_array($result)){
?>
<font face="verdana" size ="0.5" color="green">
<option value="<?php echo $row['CSOTypeID']; ?>"><?php echo $row['CSOTypeName']; ?></a> </option>
</font>
<?php
}
?>
</select>

</form>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Search By Sector</a></h3>
		<div>
	<select name="secta" id="secta" onchange="secta()">
	<option value="">Select Sector</option>
	<?php
  $query2 = "SELECT * FROM `tbl_sector`;";
$result2 = mysql_query($query2); 


//create combo box for webform
while ($row2 = mysql_fetch_array($result2)){
?>

<font face="verdana" size ="0.5" color="green">
<option value="<?php echo $row2['ID']; ?>"><?php echo $row2['Name']; ?> </option>
</font>
<?php
}
?>
</select>
		</div>
	</div>
	
	
</div>
</div>

</div>
		</div>
    </div>
	
  </body> 

  </html>