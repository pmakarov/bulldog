@extends('layouts.app')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css">

<style>
  #mapid { height: 460px; width: 100%; }
</style>
@section('content')
<div class="container">
    <div class="columns is-centered">
      <!-- <div class="column is-3">
        <aside class="menu">
          <p class="menu-label">
            General
          </p>
          <ul class="menu-list">
            <li><a class="is-active">Dashboard</a></li>
            <li><a>Customers</a></li>
          </ul>
          <p class="menu-label">
            Administration
          </p>
          <ul class="menu-list">
            <li><a>Team Settings</a></li>
            <li>
              <a>Manage Your Team</a>
              <ul>
                <li><a>Members</a></li>
                <li><a>Plugins</a></li>
                <li><a>Add a member</a></li>
              </ul>
            </li>
            <li><a>Invitations</a></li>
            <li><a>Cloud Storage Environment Settings</a></li>
            <li><a>Authentication</a></li>
          </ul>
          <p class="menu-label">
            Transactions
          </p>
          <ul class="menu-list">
            <li><a>Payments</a></li>
            <li><a>Transfers</a></li>
            <li><a>Balance</a></li>
          </ul>
        </aside>
      </div> -->
      <div class="column is-9">
        <!-- <nav class="breadcrumb" aria-label="breadcrumbs">
          <ul>
            <li><a href="../">Bulma</a></li>
            <li><a href="../">Templates</a></li>
            <li><a href="../">Examples</a></li>
            <li class="is-active"><a href="#" aria-current="page">Admin</a></li>
          </ul>
        </nav>
         <section class="hero is-info welcome is-small">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Hello, Admin.
              </h1>
              <h2 class="subtitle">
                I hope you are having a great day!
              </h2>
            </div>
          </div>
        </section> -->

        <!-- stats bar component -->
        <section class="info-tiles">
          <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent">
              <article class="tile is-child box">
                <p class="title">43</p>
                <p class="subtitle">Tasks</p>
              </article>
            </div>
            <div class="tile is-parent">
              <article class="tile is-child box">
                <p class="title">593</p>
                <p class="subtitle">Areas</p>
              </article>
            </div>
            <div class="tile is-parent">
              <article class="tile is-child box">
                <p class="title">7</p>
                <p class="subtitle">Models</p>
              </article>
            </div>
            <div class="tile is-parent">
              <article class="tile is-child box">
                <p class="title">19</p>
                <p class="subtitle">Errors</p>
              </article>
            </div>
          </div>
        </section>

        <section id="new_task" class="section">
        
        </section>
        
        <!-- New Task Form -->
        <section class="section" id="form" style="display:none;">
          <h1 class="Title">New Task</h1>
          <hr>

          <h4 class="subtitle">1. Create Areas of Interest</h4>
          <!-- Map Component -->
          <div class="field">
            <div id="mapid" class="card-content">
              MAP
            </div>
          </div>  <!-- end field -->
          <!-- end Map Component -->
            
          <!-- Areas Table -->
          <div class="field">
            <div class="card events-card">
              <header class="card-header">
                <p class="card-header-title">
                  Areas of Interest
                </p>
                <a id="delete_all_areas" class="card-header-icon">
                <span class="tag is-danger"> Delete All &nbsp;&nbsp;
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </span>
                </a>
                <a id="area_colapse" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-2x fa-angle-up" aria-hidden="true"></i>
                  </span>
                </a>
              </header>
                <div class="card-table" id="book">
                  <div class="content">
                    <table id="area_table" class="table is-fullwidth is-striped">
                      <tbody>
                        <tr><td>Please add an area...</td></tr>
                      </tbody>
                    </table>
                  </div>  <!-- end content -->
                </div>  <!-- end card-table -->
                <footer class="card-footer">
                  <a href="#" class="card-footer-item">View All</a>
                </footer>
              </div> <!-- end card events-card -->
            </div> <!-- end field -->
            <!-- end Areas Table -->

            <!-- form controls -->
            <div class="field is-horizontal is-pulled-right">
                <div class="field-body">
                  <div class="field is-grouped">
                    <!-- Delete Button -->
                    <div class="control">
                     
                    </div>  <!-- end control -->
                    <!-- Submit Button -->
                    <div class="control">
                      <!-- <button type="submit" id="export" class="button is-success is-medium">
                          <span>Submit</span>
                      </button> -->
                    </div>  <!-- end control -->

                  </div>   <!-- end field -->
                </div>   <!-- end field-body -->
              </div>    <!-- end field -->


          <hr>
          <h4 class="subtitle">2. Add Machine Learning Models</h4>

          <!-- <div class="field">
            <label class="label">Name</label>
            <p class="control">
              <input id="machine_learning_model_name" class="input" type="text" placeholder="SSD Car">
            </p>
          </div> -->
          <div class="card">
          <div class="field">
          <table id="model_table" class="table is-striped is-fullWidth">
              <thead>
                <tr>
                  <th></th>
                  <th> Name </th>
                  <th> Object </th>
                  <th> Algorithm </th>
                  <th></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <!-- <span class="icon is-large"><i class="fa fa-2x fa-hashtag"></i></span> -->
                  </td>
                  <td> 
                    <p class="control">
                      <input id="ml_model_name" class="input" type="text" placeholder="name">
                    </p> 
                  </td>
                  <td> 
                    <p class="control">
                      <input id="ml_model_object" class="input" type="text" placeholder="object">
                    </p> 
                  </td>
                  <td> 
                   
                    <span class="select is-fullWidth">
                      <select id="algorithm_select">
                        <option value="" disabled selected>Select Algorithm</option>
                        <option>detectnet</option>
                        <option>ssd</option>
                        <option>segment_fcn</option>
                        <option>yolo</option>
                        <option>mask_rcnn</option>
                      </select>
                    </span> 
                  </td>
                  <td>
                    <button id="add_model_button" class="button is-pulled-right" id="">
                      <span class="icon is-large"> <i class="fa fa-plus"> </i> </span>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
         <div class="field">&nbsp;&nbsp;</div>
         
         <hr>
          <h4 class="subtitle">3. Additional Parameters</h4>


        <div class="card">
          <div class="card-content">
          <div class="field">
            <label class="label">Task Name</label>
              <p class="control">
                <input class="input" id="task_name" type="text" name="task_name" placeholder="Your task name" required>
              </p>
          </div>

          <div class="field">
          <label class="label">Start Date</label>
            <p class="control">
              <input class="input" id="start_date" type="date" name="start_date" required>
            </p>
          </div>

          <div class="field">
          <label class="label">End Date <span class="has-text-danger">*</span><label>
            <p class="control">
              <input class="input" id="end_date" type="date" name="end_date">
            </p>
          </div>

          <div class="field">
            <div class="control">
              <label class="radio">
                <input id="play_btn" type="radio" name="question" checked>
                Play
              </label>
              <label class="radio">
                <input type="radio" name="question">
                Paused
              </label>
            </div>
          </div>

          <div class="content">
            <p> <small>* Not setting a value for End Date will indicate that the task should be ongoing.</small></p>
          </div>

          <!-- <div class="field">&nbsp;&nbsp;</div> -->

          <div class="field">
            <p class="control is-fullWidth">
              <button type="submit" id="submit_task_btn" class="button is-success is-medium is-fullWidth">
                <span>Submit</span>
              </button>
            </p>
          </div>

          <div>
          </div> <!-- end card -->

        </section> <!-- end section -->

   
      </div> <!-- end column is-9 -->
    </div> <!-- end columns -->
  </div> <!-- end container -->



  <!-- <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js"></script> -->
  <!-- <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script> -->
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
   integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
   crossorigin=""></script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
  <script type="text/javascript">
      var mymap = L.map('mapid').setView([20, 0], 2);

      var baseMaps = {
            'mapbox streets' : L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoicG1ha2Fyb3YiLCJhIjoiY2plb3pzajFrMnZtcjJ4bWVubWpxc3ZkaiJ9.kphC_Jwolsdx1zKMGMB0mA'
            }).addTo(mymap),
            'mapbox satellite' : L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.satellite',
                accessToken: 'pk.eyJ1IjoicG1ha2Fyb3YiLCJhIjoiY2plb3pzajFrMnZtcjJ4bWVubWpxc3ZkaiJ9.kphC_Jwolsdx1zKMGMB0mA'
            }),
            'mapbox streets-satellite' : L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.streets-satellite',
                accessToken: 'pk.eyJ1IjoicG1ha2Fyb3YiLCJhIjoiY2plb3pzajFrMnZtcjJ4bWVubWpxc3ZkaiJ9.kphC_Jwolsdx1zKMGMB0mA'
            }),
            'Open Street Maps' : L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                //attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		            id: 'osm.streets'
	          }),
            'google street' : L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
              maxZoom: 20,
              subdomains:['mt0','mt1','mt2','mt3']
          }),
            'google satellite' : L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            }),
            'google terrain' : L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            }),
            'WMS Countries': L.tileLayer.wms('https://demo.boundlessgeo.com/geoserver/ows?', {
                layers: 'ne:ne_10m_admin_0_countries'
            }),
            'WMS Boundaries': L.tileLayer.wms('https://demo.boundlessgeo.com/geoserver/ows?', {
                layers: 'ne:ne_10m_admin_0_boundary_lines_land'
            }),
            'WMS Countries, then boundaries': L.tileLayer.wms('https://demo.boundlessgeo.com/geoserver/ows?', {
                layers: 'ne:ne_10m_admin_0_countries,ne:ne_10m_admin_0_boundary_lines_land'
            }),
            'WMS nasa': L.tileLayer.wms('https://demo.boundlessgeo.com/geoserver/ows?', {
                layers: 'nasa:bluemarble'
            })
        };

      var overlayMaps =  {
        'WMS nasa': L.tileLayer.wms('https://demo.boundlessgeo.com/geoserver/ows?', {
                layers: 'nasa:bluemarble',
                opacity: 0.5
        }),
          "DENSITY: all": L.tileLayer('https://s3.amazonaws.com/nyctlc-data/heatmap/all/{z}/{x}/{y}.png', {
          minNativeZoom: 11,
          maxNativeZoom: 14,
          opacity: 0.8
        }),
        //   'DENSITY: weekday late v weekend late': L.tileLayer('https://s3.amazonaws.com/nyctlc-data/heatmap/weekday_late-vs-weekend_late/{z}/{x}/{y}.png', {
        //   minNativeZoom: 11,
        //   maxNativeZoom: 14,
        //   opacity: 0.8
        //   })
      };
      
      L.control.layers(baseMaps, overlayMaps).addTo(mymap);
      
      var editableLayers = new L.FeatureGroup();
      mymap.addLayer(editableLayers);
      var drawControl = new L.Control.Draw({
        draw: {

             circle: false,
             marker: false,
             polyline: false,
             polygon: {
              showArea: true,
              drawError: {
                //color: '#b00b00',
                timeout: 1000
              },
              shapeOptions: {
              //  color: '#bada55'
              }
             }
         },
          edit: {
              featureGroup: editableLayers,
              edit: true
          }
      });
      mymap.addControl(drawControl);
      mymap.on(L.Draw.Event.CREATED, function (e) {
      var type = e.layerType,
          layer = e.layer;
          // if (type === 'polygon') {
          //     // Do marker specific actions
          //     console.log("drawing polygon");
          // }
      // 1. Add layer to Map
      editableLayers.addLayer(layer);

      //2. Add row to area table
      addRowToAreaTable(
        {
          'layer': layer,
          'zoom' : mymap.getZoom()
        });

      //TODO: move to center of polygon
      //mymap.flyTo(editableLayers.getLayers()[0].getBounds().getCenter(),5);
    });

    mymap.on('draw:edited', function (e) {
         var layers = e.layers;
         layers.eachLayer(function (layer) {
             //do whatever you want; most likely save back to db
             console.log("draw on EDIT");
         });
     });

     mymap.on('draw:deleted', function (e) {
        var layers = e.layers;
          layers.eachLayer(function (layer) {
              //do whatever you want; most likely save back to db
              console.log("Deleted an item");
              
              $("table#area_table tr#"+layer._leaflet_id).remove();
              renumberTableRows($("table#area_table tr"));
              if($("#area_table > tbody > tr").length === 0) {
                drawDefaultTableRow();
              }
          });
     });

      // document.getElementById('export').onclick = function(e) {

      //       // Extract GeoJson from featureGroup
      //       var map_data = editableLayers.toGeoJSON();
      //       // if no data, DO not submit
      //       if (map_data["features"].length === 0) {
      //         return;
      //       }

      //       $("export").addClass("is-loading");
      //       // Stringify the GeoJson
      //       var convertedData = 'text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(map_data));

      //       // Create export
      //       // document.getElementById('export').setAttribute('href', 'data:' + convertedData);
      //       // document.getElementById('export').setAttribute('download','data.geojson');

      //       let geo_data = {
      //         'areas' : map_data
      //       }
      //     console.log(geo_data);
      //     $.ajax('/api/v1/area', {
      //       data : JSON.stringify(map_data),
      //       contentType : 'application/json',
      //       type : 'POST',
      //       success: function (data) {
      //         console.log(data); 
      //         $("export").removeClass("is-loading");
      //       },
      //       error: function(XMLHttpRequest, textStatus, errorThrown) { 
      //         console.log("Message:" + XMLHttpRequest.responseJSON.message);
      //         console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
      //         $("export").removeClass("is-loading");
      //       }  
      //     });
      //   }

        //Delete all Areas from Map
        document.getElementById('delete_all_areas').onclick = function(e) {
          
          editableLayers.clearLayers();

          $("#area_table").find("tr").remove();
          // $('#area_table > tbody:last-child').append(
          //   '<tr>'// need to change closing tag to an opening `<tr>` tag.
          //   +'<td><input type="checkbox" checked="true"></td>'
          //   +'<td>name</td>'
          //   +'<td>lat/long</td>'
          //   +'<td><button id="loeschen">löschen</button></td>'
          //   +'</tr>');

          drawDefaultTableRow();
        }
        // Import button
        // document.getElementById('import').onclick = function(e) {

        //   $("import").addClass("is-loading");
        

        //   $.ajax('/api/v1/area', {
        //   data : null,
        //   contentType : 'application/json',
        //   type : 'GET',
        //   success: function (data) {

        //     var polyLayers = [];

        //     for (var value of data) {
        //       //console.log(value.polygon.coordinates);
        //       var polygon = L.polygon(value.polygon.coordinates);
        //       polyLayers.push(polygon);
        //     }
        //     //console.log(data); 
        //     $("import").removeClass("is-loading");

        //     // Add the layers to the drawnItems feature group 
        //     for(layer of polyLayers) {
        //       editableLayers.addLayer(layer); 
        //     }

        //   },
        //   error: function(XMLHttpRequest, textStatus, errorThrown) { 
        //     console.log("Message:" + XMLHttpRequest.responseJSON.message);
        //     console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        //     $("import").removeClass("is-loading");
        //   }  
        //   });
        // }

        document.getElementById('add_model_button').onclick = function (e) {

          //guard against empty fields

          var name = $("#ml_model_name").val();
          var object = $("#ml_model_object").val();
          var algorithm_id = $("#algorithm_select").val();
          var algorithm_text = $("#algorithm_select option:selected").text();

          if (object === "" || algorithm_text === "") 
            return

          if ($('#model_table > tbody > tr:first > td').text() === "Please add a model..."){
            $("#model_table").find("tr").remove();
          }
          //console.log(editableLayers.getLayer(editableLayers.getLayerId(data.layer)).getBounds().getCenter());
          var layer_id = 5;
          var table_length = $("#model_table > tbody > tr").length;
          $('#model_table > tbody:last-child').append(
            '<tr id="' + table_length + '" data-name="'+name+'" data-object="'+object+'" data-algorithm="'+algorithm_id+'" >'
           // +'<td><span class="icon is-small is-right"><i class="fa fa-check"></i></span></td>'
            +'<td>'+ table_length + '.</td>'
            +'<td><span class="tag is-light">'+ name + '<span></td>'
           // +'<td><a onclick="mymap.flyTo('+center_point+','+5+'););" class="link">lat/long</a></td>'
            +'<td><span class="tag is-light">' + object +'</span></td>'
            +'<td><span class="tag is-light">' + algorithm_text +'</td>'
            +'<td><a class="button is-pulled-right" onclick="removeRowFromModelTable('+table_length+');">'
            +'<span class="icon is-large"> <i class="fa fa-trash"> </i> </span></a></td>'
            +'</tr>');
        }


        function addRowToAreaTable(data) {
          
          // if we have the default row i.e. no data - we must purge that row
          // before we append a legit row
          if ($('#area_table > tbody > tr:first > td').text() === "Please add an area..."){
            $("#area_table").find("tr").remove();
          }
          //console.log(data.layer.getLatLngs()[0]);
          var is_poly = data.layer instanceof L.Polygon;
          var shape = (data.layer.getLatLngs()[0].length > 4) ? "polygon" : "box";
          var layer_id = editableLayers.getLayerId(data.layer);
          var table_length = editableLayers.getLayers().length;
          $('#area_table > tbody:last-child').append(
            '<tr id="' + layer_id + '">'
           // +'<td><span class="icon is-small is-right"><i class="fa fa-check"></i></span></td>'
            +'<td>' + table_length +'.</td>'
            +'<td>' + shape + '</td>'
            +'<td><a onclick="moveMap('+layer_id+',' + data.zoom+')" class="link">View</a></td>'
            +'<td><a onclick="removeAreaFromMapAndTable('+layer_id+')" class="button is-small is-pulled-right" id="delete_area_item">'
            + '<span class="icon is-small"><i class="fa  fa-trash"></i>'
            + '</span></a></td>'
            +'</tr>');
        }

        function removeAreaFromMapAndTable(id) {

          $("table#area_table tr#"+id).remove();
          editableLayers.removeLayer(editableLayers.getLayer(id));
          
          if($("#area_table > tbody > tr").length === 0) {
            drawDefaultTableRow();
          }
        }
        function removeRowFromModelTable(id) {

          $("table#model_table tr#"+id).remove();
          renumberTableRows($('#model_table tr:not(:first-child)'));
         
        }

        function moveMap(c, z) {
         var center_point =  editableLayers.getLayer(c).getBounds().getCenter();
         mymap.flyTo(center_point, z);
        }

        function drawDefaultTableRow() {
          $('#area_table > tbody:last-child').append(
            '<tr><td>Please add an area...</td></tr>'
          );
        }

        function renumberTableRows(elem) {
          
          $(elem).each(function(i) {
            $(this).children("td:first").text(i+1+'.');
          });
        }
   </script>
@endsection
