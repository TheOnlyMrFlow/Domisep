<?php 

session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Preset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/createpreset2.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
</head>

<body>

    <p>
        <input id="NamePreset" type="text" name="Name of the preset" placeholder="Name of the preset">
        <br /><br />
    </p>

    <div id="MainDiv">
        <nav id="DropdownDiv">
            <ul>
                <div id="CapteursDiv">Smart Sensors
                    <ul id="CapteursListe">
                        <li class="li-sensor" id="1">Sensor A</li>
                        <li class="li-sensor" id="2">Sensor B</li>
                        <li class="li-sensor" id="3">Sensor C</li>
                        <li class="li-sensor" id="4">Sensor D</li>
                    </ul>
                </div>
            </ul>
        </nav>
        <div id="addedZone">

        </div>
    </div>



    <div id="SaveZone">
        <input id="Save" type="button" value="Save the preset">
    </div>

    <i class="fa fa-arrow-left"></i>


</body>

<script src="scripts/createpreset2.js"></script>

</html>

<!--https://www.w3schools.com/howto/howto_css_dropdown.asp  Super lien pour créer menu dropdown-->