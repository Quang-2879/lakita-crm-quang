<!--<!DOCTYPE html>
<html>
    <head>
        <title>Adaptive Streaming in HTML5</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="https://cdn.dashjs.org/latest/dash.all.min.js"></script>
        <script>
            function setupVideo() {
                var url = "http://wams.edgesuite.net/media/MPTExpressionData02/BigBuckBunny_1080p24_IYUV_2ch.ism/manifest(format=mpd-time-csf)";
                var context = new Dash.di.DashContext();
                var player = new MediaPlayer(context);
                player.startup();
                player.attachView(document.querySelector("#videoplayer"));
                player.attachSource(url);
            }
        </script>
    </head>
    <body>
        <h1>Adaptive Streaming with HTML5</h1>
        <video data-dashjs-player autoplay 
               src="http://171.244.19.161:1935/vod/mp4:2017/04/15/em100-bai-1-1-mp4-1041695291ChuyenPN.mp4/manifest.mpd" controls></video>
         <video data-dashjs-player
               src="http://lakita.vn:1935/vod/_definst_/mp4:2017/04/15/em100-bai-1-1-mp4-1041695291ChuyenPN.mp4/manifest.mpd" controls></video>
     html5 player (start) 
        <script src="https://lakita.vn/styles/html5/build/mediaelement-and-player.min.js"></script>
        <link rel="stylesheet" href="https://lakita.vn/styles/html5/build/mediaelementplayer.min.css" />
        <script>
//            $('audio,video').mediaelementplayer({
//                success: function (player, node) {
//                    $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
//                }
//            });
        </script>

         html5 player (end) 
    </body>
</html>-->


<!DOCTYPE html>
<!--
*
* Copyright (C) 2016, bitmovin GmbH, All Rights Reserved
*
* Created on: 2015-07-25 11:35:04
* Author:     bitmovin GmbH <dash-player@bitmovin.com>
*
* This source code and its use and distribution, is subject to the terms
* and conditions of the applicable license agreement.
*
-->
<html lang="en">
    <head>
        <title>bitdash SDK</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="js-video widescreen" style="width: 60%">
                <div id="mediaspace"></div>
                <script type="text/javascript" src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
                <script>
                    $(function () {
                        jwplayer('mediaspace').setup({
                            file: 'http://lakita.vn:1935/vod/_definst_/mp4:2017/04/15/em100-bai-1-1-mp4-1041695291ChuyenPN.mp4/manifest.mpd',
                            autostart: 'true',
                            width: "100%",
                            aspectratio: "16:9",
                            stretching: 'fill',
                            abouttext: "Lakita.vn",
                            aboutlink: "https://lakita.vn",
                            primary: "flash",
                            skin: "https://lakita.vn/plugin/jwplayer/skins/lakita.xml",
                            image: "https://lakita.vn/styles/images/play.jpg",
                        });
                    });
                </script>
            </div>
    </body>
</html>