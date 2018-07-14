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
    <body class="grey lighten-4">
        <div class="activity" id="home">
            <div class="container">
                <br><br>
                <div class="card">
                    <div class="card-content">
                        <div class="input-field">
                            <input type="text" id="first_name">
                            <label for="first_name">First Name</label> 
                        </div>
                        <div class="input-field">
                            <input type="text" id="last_name">
                            <label for="last_name">Last Name</label> 
                        </div>
                        <div class="input-field">
                            <input type="text" id="username">
                            <label for="username">Username</label> 
                        </div>
                        <div class="input-field">
                            <input type="password" id="password">
                            <label for="password">Password</label> 
                        </div>
                        <br><br>
                        <button id="add" class="btn btn-large yellow darken-3 black-text">Add Admin</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $("#add").click(()=>{
        var fn = $("#first_name").val();
        var ln = $("#last_name").val();
        var u = $("#username").val();
        var p = $("#password").val();

        $.ajax({
            type:'POST',
            cache:'false',
            url:'/api/v1/Admin/add.php',
            data: {
                first_name:fn,
                last_name:ln,
                username:u,
                password:p
            },
            success: res=>{
                alert(res.message);
            }
        }).fail(()=>{
            alert("An error occurred");
        });
    });
</script>