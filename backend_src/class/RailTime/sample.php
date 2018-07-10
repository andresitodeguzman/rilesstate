<?php
// Declare mo mga var
$name = ""; $address = "";
$email = ""; $nameErr = "";
$addressErr = ""; $emailErr = "";

if(empty($_POST['name'])){
    $nameErr = "Name is Required";
} else {
    $name = $_POST['name'];
}

if(empty($_POST['address'])){
    $addressErr = "Address is Required";
} else {
    $address = $_POST['address'];
}

if(empty($_POST['email'])){
    $emailErr = "Email is Required";
} else {
    $email = $_POST['email'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <h1><center>Welcome to SLAF Webpage</center></h1>
    <form method="post">
        Name: <input type="text" value="<?php echo $name; ?>" placeholder="Name" name="name">
        <span class="error"><?php echo $nameErr; ?></span>
        Address: <input type="text" value="<?php echo $address; ?>" placeholder="Address" name="address">
        <span class="error"><?php echo $addressErr; ?></span>
        Name: <input type="email" value="<?php echo $email; ?>" placeholder="Email" name="email">
        <span class="error"><?php echo $emailErr; ?></span>
        <button type="submit">Submit</button>
    </form>
    <hr>
    <?php
        if(!empty($name)) echo "$name<br>";
        if(!empty($address)) echo "$address<br>";
        if(!empty($email)) echo "$email<br>";
    ?>
</body>
</html>