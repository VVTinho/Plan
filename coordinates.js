var jsonObjects = [];
var jsonObjectsLoaded = [];
var imagesObj = {};
var kinImages = [];
var stage;
var layer = new Kinetic.Layer();
var currentPlan = 1;
var availableTypes = [];
var availableIntervals = [];
var availableNames = [];
var kinGroups = [];
var currentObject = {};
var radiusToggle = false;
var kinCircles = [];
var kinCirclesRed = [];

function createCircles(currentKinImage) {

    var circle = new Kinetic.Circle({

        x: currentKinImage.getX(),
        y: currentKinImage.getY(),
        width: currentKinImage.getWidth(),
        height: currentKinImage.getHeight(),
        radius: 55,
        fill: 'green',
        stroke: 'yellow',
        opacity: 0.2,
        strokeWidth: 20
    });
    kinCircles.push(circle);

    var circlered = new Kinetic.Circle({

        x: currentKinImage.getX(),
        y: currentKinImage.getY(),
        width: currentKinImage.getWidth(),
        height: currentKinImage.getHeight(),
        radius: 80,
        stroke: 'red',
        opacity: 0.2,
        strokeWidth: 30
    });
    kinCirclesRed.push(circlered);
}

window.onload = function() {

    $( "#menu" ).menu();
    loadObjectsFromExt();
}

function loadObjectsFromExt() {

    $.getJSON('net.json', function(response) {

        $.each( response, function( key, val ) {

            jsonObjects.push(val);
        });
        populateTypes();
        populateIntervals();
        loadPlanObjects(currentPlan);
        populateNames();
    });
}

function populateTypes() {

    for(i = 0; i < jsonObjects.length; i++) {

        if(availableTypes.indexOf(jsonObjects[i].type) < 0) {

            availableTypes.push(jsonObjects[i].type);
            $("#changetotypes").append('<li><a href="#" onclick="changeType(\'' + jsonObjects[i].type + '\')">' + jsonObjects[i].type + '</a></li>');
        }
    }
}

function changeType(type) {

    $( "#currenttype" ).html("Aktuell Typ: " + currentObject.type);
}

function populateIntervals() {

    for(i = 0; i < jsonObjects.length; i++) {

        if(availableIntervals.indexOf(jsonObjects[i].interval) < 0) {

            availableIntervals.push(jsonObjects[i].interval);
            $("#changetointerval").append('<li><a href="#" onclick="changeInterval(' + jsonObjects[i].interval + ')">' + jsonObjects[i].interval + '</a></li>');
        }
    }
}

function changeInterval(interval) {

    $( "#currentinterval" ).html("Aktuell Interval: " + currentObject.interval);
}

function populateNames() {

    for(i = 0; i < jsonObjects.length; i++) {

        if(availableNames.indexOf(jsonObjects[i].name) < 0) {

            availableNames.push(jsonObjects[i].name);
            $("#chan").append('<li><a href="#">' + jsonObjects[i].name + '</a></li>');
        }
    }
}

function loadPlanObjects(planId) {

    jsonObjectsLoaded = [];
    kinImages = [];
    imagesObj = {};

    for(i = 0; i < jsonObjects.length; i++) {

        if(jsonObjects[i].plan == planId) {

            console.log(jsonObjects[i]);
            jsonObjectsLoaded.push(jsonObjects[i]);
        }
        else {

            console.log("nooo");
        }
    }
    createStage();
}

function createStage() {

    stage = new Kinetic.Stage({

        container: 'container',
        width: 1400,
        height: 800
    });
    setupJsonImages(-1);
}

function setupJsonImages(index) {

    index++;
    var objName = jsonObjectsLoaded[index].name;
    imagesObj[objName] = new Image();
    imagesObj[objName].src = jsonObjectsLoaded[index].img;
    imagesObj[objName].id = objName;

    imagesObj[objName].onload = function() {

        setupKinetic(index, imagesObj[objName]);
    }
}

function setupKinetic(index, theImage) {

    kinImages[index] = new Kinetic.Image({

        image: theImage,
        x: jsonObjectsLoaded[index].x,
        y: jsonObjectsLoaded[index].y,
        name: jsonObjectsLoaded[index].name,
        width: 0,
        height: 0
    });

    kinGroups[index] = new Kinetic.Group({

        draggable:true,
        name: jsonObjectsLoaded[index].name
    });

    var text = new Kinetic.Text({

        x: kinImages[index].getX(),
        y: kinImages[index].getY(),
        width: kinImages[index].getWidth(),
        height: kinImages[index].getHeight(),
        fontFamily: 'Calibri',
        fontSize: 16,
        text: '',
        fill: 'black'
    });

    kinGroups[index].add(kinImages[index]);
    createCircles(kinImages[index]);

    layer.add(kinGroups[index]);
    layer.draw();

    function writeMessage(message) {

        text.setText(message);
        layer.draw();
    }

    kinGroups[index].on('click', function() {

        for(i=0; i<jsonObjects.length; i++) {

            if(kinGroups[index].getName() == jsonObjects[i].name) {

                setInterval(function () {

                    onUpdateTextTemperature()
                }, 8000);

                function onUpdateTextTemperature() {

                    text.setText("");
                    text.getLayer().draw();
                }

                kinGroups[index].add(text);

                writeMessage(jsonObjects[i].value);

                var hamtaNamn = kinGroups[index].getName();
                $( "#objektnamn" ).html(hamtaNamn);
                $( "#flyttaobjektnamn" ).html(hamtaNamn);

                $( "#currenttype" ).html("Aktuell Typ: " + jsonObjects[i].type);
                $( "#currentinterval" ).html("Aktuell Interval: " + jsonObjects[i].interval);
                $("#temperature").html(jsonObjects[i].value);

                if(jsonObjects[i].active == true) {

                    $("#activeToggle").html('<li><a href="#" onclick="toggleActive(jsonObjects[i], false)">Av</a></li>');

                    showZoom();

                    sensorOFF();
                }
                else {

                    $("#activeToggle").html('<li><a href="#" onclick="toggleActive(jsonObjects[i], true)">På</a></li>');

                    sensorON();

                    hideZoom();
                }
                break;
            }
        }
        deleteSensor();
    });

    function deleteSensor() {

        document.onkeydown = checkKey;

        function checkKey(e) {

            e = e || window.event;

            if (e.keyCode == '8') {

              alert("ta bort det klickade objektet");
              kinGroups[index].hide();
            }
        }

    }

    function hideZoom() {

        $("#zoom").hide()
    }

    function showZoom() {

        $("#zoom").append('<div id="zoom-text-title">Zoom:</div><span class="ui-icon ui-icon-zoomin" onclick="zoomfunction(); return false;"></span> <span class="ui-icon ui-icon-zoomout" onclick="zoomfunction(); return false;"></span>');
    }

    function sensorOFF() {

        var textAV = new Kinetic.Text({

            x: kinImages[index].getX() - 50,
            y: kinImages[index].getY() + 60,
            fontFamily: 'Calibri',
            fontSize: 16,
            text: 'Sensorn är AV',
            fill: 'red'
        });

        textAV.on('mouseover', function() {

            this.stroke('red');
            this.strokeWidth(1);
            this.fontSize(18);
            layer.draw();
        });

        textAV.on('mouseout', function() {

            this.stroke('red');
            this.strokeWidth(1);
            this.fontSize(16);
            layer.draw();
        });

        setInterval(function () {

            onUpdateTextOff()
        }, 3000);

        function onUpdateTextOff() {

            textAV.setText("");
            textAV.getLayer().draw();
        }

        kinGroups[index].add(textAV);

        layer.draw();
    }

    function sensorON() {

        var textON = new Kinetic.Text({

            x: kinImages[index].getX() - 50,
            y: kinImages[index].getY() + 60,
            fontFamily: 'Calibri',
            fontSize: 16,
            text: 'Sensorn är PÅ',
            fill: 'green'
        });

        textON.on('mouseover', function() {

            this.stroke('green');
            this.strokeWidth(1);
            this.fontSize(18);
            layer.draw();
        });

        textON.on('mouseout', function() {

            this.stroke('green');
            this.strokeWidth(1);
            this.fontSize(16);
            layer.draw();
        });

        setInterval(function () {

            onUpdateTextOn()
        }, 3000);

        function onUpdateTextOn() {

            textON.setText("");
            textON.getLayer().draw();
        }

        kinGroups[index].add(textON);

        layer.draw();
    }

    function alarmOFF() {

        var alarmcircle = new Kinetic.Circle({

            x: kinImages[index].getX(),
            y: kinImages[index].getY(),
            width: kinImages[index].getWidth(),
            height: kinImages[index].getHeight(),
            radius: 18,
            fill: 'green',
            stroke: 'black',
            opacity: 1,
            strokeWidth: 1
        });

        kinGroups[index].add(alarmcircle);

        layer.draw();
    }

    function alarmON() {

        var alarmcircle = new Kinetic.Circle({

            x: kinImages[index].getX(),
            y: kinImages[index].getY(),
            width: kinImages[index].getWidth(),
            height: kinImages[index].getHeight(),
            radius: 18,
            fill: 'red',
            stroke: 'black',
            opacity: 1,
            strokeWidth: 1
        });

        kinGroups[index].add(alarmcircle);

        layer.draw();
    }

    showAlarm();

    function showAlarm() {

        for(i=0; i<jsonObjects.length; i++) {

            if(kinGroups[index].getName() == jsonObjects[i].name) {

                if(jsonObjects[i].alarm == true) {

                    $("#alarmToggle").html('<li><a href="#" onclick="toggleAlarm(jsonObjects[i], false)">Av</a></li>');

                        alarmOFF();
                    }
                    else {

                        $("#alarmToggle").html('<li><a href="#" onclick="toggleAlarm(jsonObjects[i], true)">På</a></li>');

                        alarmON();
                    }
            }
        }
    }


    // var angularSpeed = 360 / 4;

    // var anim = new Kinetic.Animation(function(frame) {

    //     var angleDiff = frame.timeDiff * angularSpeed / 1000;
    //     circle.rotate(angleDiff);
    // }, layer);

    // anim.start();

    // settings = {

    //     // zoomed size relative to the container element
    //     // 0.0-1.0
    //     targetsize: 1.4,

    //     // scale content to screen based on their size
    //     // "width"|"height"|"both"
    //     scalemode: "both",

    //     // animation duration
    //     duration: 450,

    //     // easing of animation, similar to css transition params
    //     // "linear"|"ease"|"ease-in"|"ease-out"|"ease-in-out"|[p1,p2,p3,p4]
    //     // [p1,p2,p3,p4] refer to cubic-bezier curve params
    //     easing: "ease",

    //     // use browser native animation in webkit, provides faster and nicer
    //     // animations but on some older machines, the content that is zoomed
    //     // may show up as pixelated.
    //     nativeanimation: true,

    //     // root element to zoom relative to
    //     // (this element needs to be positioned)
    //     root: $("document.body"),

    //     // show debug points in element corners. helps
    //     // at debugging when zoomooz positioning fails
    //     debug: false,

    //     // this function is called with the element that is zoomed to in this
    //     // when animation ends
    //     animationendcallback: null,

    //     // this specifies, that clicking an element that is zoomed to zooms
    //     // back out
    //     closeclick: true,

    //     // don't reset scroll before zooming. less jaggy zoom starts and ends on
    //     // mobile browsers, but causes issues when zooming to elements when scrolled
    //     // to a specific distance in document, typically around 2000px on webkit.
    //     preservescroll: false
    // }

    // // settings can be set for both the zoomTo and zoomTarget calls:
    // $("#container").zoomTarget(settings);

    $("button").click(function() {

        for(i=0; i<jsonObjects.length; i++) {

            if(kinGroups[index].getName() == jsonObjects[i].name) {

                $( "#statuslarm" ).html("Aktuella larm:");
            }
        }
    });

    kinGroups[index].on('dragend',function() {

        $.ajax({

            type: "POST",
            url: 'receiver.php',
            contentType: 'application/json; charset=utf-8',
            async: true,
            data: JSON.stringify({ objectname:(this).getName(), xcoord: (this).getPosition().x, ycoord : (this).getPosition().y })
        });
    });

    if(index < jsonObjectsLoaded.length -1) {

        setupJsonImages(index);
    }
    else {

        finishStage();
    }
}

function finishStage() {

    stage.add(layer);
    stage.draw();
}

function toggleRadius() {

    console.log("toggle radius: " + radiusToggle);

    radiusToggle = !radiusToggle;
    if(radiusToggle == true) {

        for(i=0; i < kinGroups.length; i++) {

            kinGroups[i].add(kinCircles[i]);
            kinGroups[i].add(kinCirclesRed[i]);
        }
    }
    else {

        for(i=0; i < kinGroups.length; i++) {

            kinCircles[i].remove();
            kinCirclesRed[i].remove();
        }
    }
    layer.draw();
}

function toggleActive(clickedObject, active) {

    console.log("active: " + active + " clickedobj " + jsonObjects[i].name + " " + clickedObject.name + " orgobj active:" + jsonObjects[i].active);
    clickedObject.active = active;
    console.log("jsonactive:" + jsonObjects[i].active + " , clickedactive:" + clickedObject.active);

    if(clickedObject.active == true) {

        $("#activeToggle").html('<li><a href="#" onclick="toggleActive(clickedObject, false)">Av</a></li>');
    }
    else {

        $("#activeToggle").html('<li><a href="#" onclick="toggleActive(clickedObject, true)">På</a></li>');
    }
}

function toggleAlarm(clickedObject, alarm) {

    console.log("alarm: " + alarm + " clickedobj " + jsonObjects[i].alarm + " " + clickedObject.alarm + " orgobj alarm:" + jsonObjects[i].alarm);
    clickedObject.alarm = alarm;
    console.log("jsonalarm:" + jsonObjects[i].alarm + " , clickedalarm" + clickedObject.alarm);

    if(clickedObject.active == true) {

        $("#activeToggle").html('<li><a href="#" onclick="toggleAlarm(clickedObject, false)">Av</a></li>');
    }
    else {

        $("#activeToggle").html('<li><a href="#" onclick="toggleAlarm(clickedObject, true)">På</a></li>');
    }
}

$(document).ready(function() {

    var body = $("#bilderna");

    $('#backgrounds').bind('change', function(event) {

    // vid plan byte gör nedan:
    // ta bort radie-cirklar
    // sätt jsonobjects från förra plan till radie=false

        var plan = $(this).val();
        var prevPlan = currentPlan;
        currentPlan = plan;

        for(i = 0; i < jsonObjectsLoaded.length; i++) {

            kinImages[i].remove();
            // rensa img från minne? webbläsares garbage hantering?
        }

        if(plan == null || typeof plan === 'undefined' || $.trim(plan) === '') {

            body.css('background-image', '');
        }
        else {

            console.log("plan: " +plan);
            //body.css('background-image', "url('plan" + plan + ".jpg')");
            body.attr("src", "plan" + plan +".jpg");
            loadPlanObjects(plan);
            // unloada previous bg-image (från minnet)...? drar resurer?     kinetics som drar resurser?
        }
    });
});
