<!Doctype html>
<html>
    <head>
        <title>Mission Control</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    </head>
    <body class="blue-grey darken-4">
        <div class="activity" id="login">
            <div class="container">
                <br><br>
                <center>
                    <h3 class="white-text">
                        <b>Rail</b>Time
                    </h3>
                    <h5 class="white-text">
                        Mission Control
                    </h5>
                </center>
                <br>
                <div class="card">
                    <div class="card-content">
                        <div class="input-field">
                            <input type="text" id="username">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field">
                            <input type="password" id="password">
                            <label for="password">Password</label>
                        </div>
                        <br><br>
                        <button class="btn btn-large yellow darken-3 black-text">Enter</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="/missioncontrol/auth.js" type="text/javascript"></script>