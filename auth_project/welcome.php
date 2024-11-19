<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rno = $_POST['rno'];
    $name = $_POST['name'];
    $npm = $_POST['npm'];
    $ooad = $_POST['ooad'];
    $cns = $_POST['cns'];
    $es = $_POST['es'];
    $web_technology = $_POST['web_technology'];
    $uid = $_POST['uid'];

    $sql = "INSERT INTO students (rno, name, npm, ooad, cns, es, web_technology, uid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiiiii", $rno, $name, $npm, $ooad, $cns, $es, $web_technology, $uid);

    if ($stmt->execute()) {
        $message = "Student details registered successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style type="text/css">
        body { color: blue; font-family: courier; text-align: center; background-color:blue;}
        form { display: inline-block; text-align: left; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin: 5px 0; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 10px; background-color: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>
    <h2>Student Registration</h2>
    <hr/>
    <?php if (isset($message)) { echo "<p style='color:green;'>$message</p>"; } ?>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="rno">Registration Number:</label>
        <input type="text" id="rno" name="rno" required /><br/>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required /><br/>

        <label for="npm">NPM:</label>
        <input type="number" id="npm" name="npm" required /><br/>

        <label for="ooad">OOAD:</label>
        <input type="number" id="ooad" name="ooad" required /><br/>

        <label for="cns">CNS:</label>
        <input type="number" id="cns" name="cns" required /><br/>

        <label for="es">ES:</label>
        <input type="number" id="es" name="es" required /><br/>

        <label for="web_technology">Web Technology:</label>
        <input type="number" id="web_technology" name="web_technology" required /><br/>

        <label for="uid">UID:</label>
        <input type="number" id="uid" name="uid" required /><br/>

        <input type="submit" value="Register Student" />
    </form>
    <br/>
    <a href="logout.php">Logout</a>
</body>
</html>
