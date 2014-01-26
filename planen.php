<!DOCTYPE HTML>

<html>
    <head>
		<meta charset="utf-8" />
        <title>Plan | Örestad Linux</title>

        <link type="text/css" rel="stylesheet" href="styles.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        <script src="kinetic-v5.0.0.min.js"></script>
		<script type="text/javascript" src="jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="coordinates.js"></script>
        <script src="jquery-ui.min.js"></script>
        <script src="jquery.zoomooz.min.js"></script>

    </head>

    <?php
        // echo "Den nya planlösningen";

        // $files = glob("uploadedImages/*.*");
        // for ($i=0; $i<count($files); $i++) {

        //     $num = $files[$i];
        //     echo '<img src="'.$num.' "  id="allImages" " />'."<br/><br/>";
        // }

        // $images = glob("uploadedImages/*.*");

        // // Echo ut namnen på de upladdade bilderna.
        // foreach($images as $image) {

        //     echo basename($image) , "<br>" ;
        // }
    ?>

    <body>
        <ul id="menutwo" title"">
            <li class="ui-state-disabled"><a href="#">Örestad Linux</a></li>

            <hr>

            <li>
                <a href="#">Visa Plan</a>
                <ul>
                    <div id="backgroundpicker">
                        <select id="backgrounds">
                            <option value="1">Plan 1</option>
                            <option value="2">Plan 2</option>
                            <option value="3">Plan 3</option>
                        </select>
                    </div>
                </ul>
            </li>

            <div id="ladda-upp-plan-txt"><a href="upload_file.php">Ladda upp Plan</a></div>

            <div><a href="javascript:window.print()">Printa Plan</a></div>

            <div id="logout-link"><a href="login-system/logout.php">Logga ut</a></div>
        </ul>

        <div class="zoomViewport">
            <div class="zoomContainer">
                <img id="bilderna" src="plan1.jpg" />

                <div id="container" class="container"></div>

               <!--  class="zoomTarget" data-targetsize="1.2" -->

                <!-- <a href="#" id="target">rum 1</a>
                <div id="dialog"><img src="http://static.adzerk.net/Advertisers/d003fae081674b67aa74e6d19e289d40.png"/></div> -->

                <!-- <div id="testar"></div> -->

            </div>
        </div>

        <ul id="menu" class="menu" title="">

            <li class="ui-state-disabled"><a href="#">Objekt namn: <div id="objektnamn" title=""></div></a></li>

            <hr>

            <li>
                <a href="#">Flytta Sensor</a>
                <ul>
                    <li>
                        <a href="#"><div id="flyttaobjektnamn" title=""></div></a>
                        <ul>
                            <li><a href="#">Plan 1</a></li>
                            <li><a href="#">Plan 2</a></li>
                            <li><a href="#">Plan 3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">Inställningar</a>
                <ul>
                    <li>
                        <a href="#">Aktiv</a>
                        <ul id="activeToggle"></ul>
                    </li>

                    <li>
                        <a href="#"><span id="currenttype" title=""></span></a>
                        <ul id="changetotypes"></ul>
                    </li>

                    <li>
                        <a href="#"><span id="currentinterval" title""></span></a>
                        <ul id="changetointerval"></ul>
                    </li>
                </ul>
            </li>

            <hr>

            <li class="ui-state-disabled">
                <a href="#">Temperatur:</a>
                <div id="grader">
                    <span id="temperature"></span>
                </div>
            </li>

            <hr>

            <a href="#"><div id="zoom" title"Zoom"></div></a>

            <hr>

            <li>
                <a href="#"><button>Larm:</button></a>
                <ul>
                    <li>
                        <a href="#">
                            <span id="statuslarm" title=""></span>
                        </a>
                        <ul id="chan"></ul>
                    </li>
                </ul>
            </li>

            <!-- <li>
            <div id="buttons">
                <a href="#"><input type="button" id="start" value="Start"></a>
                <a href="#"><input type="button" id="stop" value="Stop"></a>
            </div>
            </li> -->


           <!--  <li class="ui-state-disabled"><a href="#">Visa temperatur vid objektet:</a><div id="" title=""></div></li>
            <li><input type="submit" value="Temperatur"></li> -->

            <!-- <li class="ui-state-disabled">
                <li class="ui-state-disabled"><a href="#">Visa temperatur vid objektet:</a></li>
                <div id="temp-btn">
                    <input type="button" value="Temperatur" id="temperatur-btn">
                    <li><a href="#"></a><li>
                </div>
            </li> -->

        <!--     <li>
                <li class="ui-state-disabled"><a href="#">Visa temperatur vid objektet:</a></li>
                <div id="tempeperatur-btn">
                    <input type="button" value="Temperatur">
                </div>
            </li> -->

            <!--    <div id="logout-link"><a href="login-system/logout.php">Logga ut</a></div> -->

        </ul>
    </body>
</html>
