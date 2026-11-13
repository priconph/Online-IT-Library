<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locked Screen</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #lockScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-family: Arial, sans-serif;
            z-index: 99999;
            display: none;
        }
    </style>
</head>
<body>

    <div id="lockScreen">🔒 System Locked</div>

    <script>
        function checkLockStatus() {
            $.get("api/check-lock?pc_name=A-ISS-37-0919", function(response) {
                if (response.locked) {
                    $("#lockScreen").fadeIn();
                    enterFullscreen();
                    blockKeysAndMouse();
                    preventClosing();
                } else {
                    $("#lockScreen").fadeOut();
                    exitFullscreen();
                }
            });
        }

        function enterFullscreen() {
            let elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { // Firefox
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { // IE/Edge
                elem.msRequestFullscreen();
            }
        }

        function exitFullscreen() {
            if (document.fullscreenElement) {
                document.exitFullscreen()
                    .catch(err => console.error("Exit fullscreen failed:", err));
            } else if (document.webkitFullscreenElement) { // Safari
                document.webkitExitFullscreen();
            } else if (document.mozFullScreenElement) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.msFullscreenElement) { // IE/Edge
                document.msExitFullscreen();
            } else {
                console.log("Not in fullscreen mode.");
            }
        }

        function blockKeysAndMouse() {
            $(document).keydown(function(e) {
                if (["Escape", "F11"].includes(e.key) || (e.ctrlKey && e.altKey)) {
                    e.preventDefault();
                }
            });

            $(document).on("contextmenu", function(e) {
                e.preventDefault();
            });
        }

        function preventClosing() {
            window.onbeforeunload = function() {
                return "You cannot close this window while locked!";
            };
        }

        // setInterval(checkLockStatus, 5000); // Check every 5 seconds
    </script>

</body>
</html>