
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});


$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "/api/v1/task",
        dataType: "json",
        success: function (data) {
            console.log(data);
            if (data.length === 0) {
                $("#task_table div:first").remove();
                $("#task_table").append('<div class="panel-block">You currently do not have any tasks...</div>');

            }
            else {
                $("#task_table div:first").remove();
                var html_string = '';
                for (var i =0; i < data.length; i++) {

                    html_string += `<div class="panel-block">
                          <div class="panel-item">
                            <span class="icon"> <i class="fa fa-pause"></i> </span>
                          </div>
                          <div class="panel-item item-name" > ${data[i].name}
                          </div>
                          <div class="panel-item is-hidden-touch" ><span class="icon"> <i class="fa fa-map"></i> </span> ${data[i].geometries.length} Areas of Interest
                          </div>
                          <div class="panel-item is-hidden-touch" > `
                    
                        for (var j = 0; j < data[i].machine_learning_models.length; j++) {
                            html_string += `<div class="tag is-primary">${ data[i].machine_learning_models[j].object }</div>`
                        }

                    html_string +=`</div>
                          <div class="container"> 
                            <div class="is-pulled-right">
                              <a onclick="showTaskDetails(${i})" class="has-text-grey-dark">
                              <div class="tags has-addons">
                              <span class="tag is-dark is-hidden-touch">Details</span>
                              <span class="tag is-info">14</span>
                              <span class="tag is-white"> <i class="fa fa-chevron-right"></i> </span>
                              </div>
                                
                              </a>
                            </div>
                          </div>
                        </div><div id="task_details" style="display:none;">${data[i]}</div>`
                }

                $("#task_table").append(html_string);                
            
            }

        }
    });

    $("#add_task_btn").click(function (){

        $("#form").toggle();
        mymap.invalidateSize();
        // $('html, body').animate({
        //     scrollTop: $("#form").offset().top
        // }, 1000)

        $("#add_task_btn > i").toggleClass("fa-plus");
        $("#add_task_btn > i").toggleClass("fa-minus");
    });


    $("#area_colapse").click(function () {

        $("#book").slideToggle("fast", function () {
            // animation complete
            if ($("#book").is(':visible') === false) {
                $('#area_colapse > span > i').removeClass("fa-angle-up");
                $('#area_colapse > span > i').addClass("fa-angle-down");
            }
            else {
                $('#area_colapse > span > i').removeClass("fa-angle-down");
                $('#area_colapse > span > i').addClass("fa-angle-up");
            }

        });
    });

    $.ajax({
        type: "GET",
        url: "/api/v1/algorithm",
        dataType: "json",
        success: function (data) {
            // Get select
            var select = document.getElementById('algorithm_select');

            // clear default options
            $("#algorithm_select > option").remove();

            // Add options
            for (var i in data) {
                $(select).append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
            }

            // Set selected value
            $(select).val(data[1]);
            $("#algorithm_select > option:first").prop('selected', 'selected');
        }
    });

    $("#submit_task_btn").click(function () {

        //TODO: write validation intercept for JS components

        // Extract GeoJson from featureGroup
        let map_data = editableLayers.toGeoJSON().features;
        let model_data = { 
            "type": "ModelCollection",
            "models": [] 
        };
        $('#model_table tr:not(:first-child)').each(function(i) { 
                
                 model_data.models.push({
                     'name': $(this)[0].dataset.name,
                     'object': $(this)[0].dataset.object,
                     'algorithm': $(this)[0].dataset.algorithm,
                 });
        });

        let start_date = $("#start_date").val();
        let end_date = $("#end_date").val();
        let play_pause = ($("#play_btn").val() === "on") ? 'playing' : 'paused';
        let task_name = $("#task_name").val();
        
        // if no data, DO not submit
        if (map_data.length === 0 || model_data.length === 0) {
            return;
        }

        $("submit_task_btn").addClass("is-loading");
        


        let task_data = {
            'name': task_name,
            'areas': map_data,
            'models': model_data,
            'start_date' : start_date,
            'end_date' : end_date,
            'status' : play_pause
        }
        
        //console.log(task_data);

        $.ajax('/api/v1/task', {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify(task_data),
            contentType: 'application/json',
            type: 'POST',
            success: function (data) {
                console.log(data);
                $("submit_task_btn").removeClass("is-loading");
                //TODO: 1. clear form feilds and reset
                // 2. add Task row
                $("#delete_all_areas").trigger("click");
                $("#start_date").val(0);
                $("#end_date").val(0);
                //$("#play_btn").prop("")
                $("#task_name").val("");
                $('#model_table tr:not(:first-child)').remove();
                $("#ml_model_name").val("");
                $("#ml_model_object").val("");
                $("#algorithm_select > option:first").prop('selected', 'selected');
                $("#add_task_btn").trigger("click");

                var html_string ="";
                html_string += `<div class="panel-block">
                          <div class="panel-item">
                            <span class="icon"> <i class="fa fa-pause"></i> </span>
                          </div>
                          <div class="panel-item item-name" > ${task_data.name}
                          </div>
                          <div class="panel-item is-hidden-touch" ><span class="icon"> <i class="fa fa-map"></i> </span> ${task_data.areas.length} Areas of Interest
                          </div>
                          <div class="panel-item is-hidden-touch"> `
                    
                        for (var j = 0; j < task_data.models.models.length; j++) {
                            html_string += `<div class="tag is-primary">${ task_data.models.models[j].object }</div>`
                        }

                    html_string +=`</div>
                          <div class="container"> 
                            <div class="is-pulled-right">
                              <a onclick="showTaskDetails(0)" class="has-text-grey-dark">
                              <div class="tags has-addons">
                              <span class="tag is-dark is-hidden-touch">Details</span>
                              <span class="tag is-info">14</span>
                              <span class="tag is-white"> <i class="fa fa-chevron-right"></i> </span>
                              </div>
                                
                              </a>
                            </div>
                          </div>
                        </div><div id="task_details" style="display:none;">${task_data}</div>`


                $("#task_table").prepend(html_string);



            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Message:" + XMLHttpRequest.responseJSON.message);
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
                $("submit_task_btn").removeClass("is-loading");
            }
        });
    });

    
});


