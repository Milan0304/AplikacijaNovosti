<!DOCTYPE html>

<head>
    <title>Login</title>
</head>
<body>
<?php if (empty($_SESSION['admin'])) { ?>
    <form action="<?php BASE_URL . "home/login" ?>" method="POST">
        <input type="text" name="username" placeholder="Username" /><br/><br/>
        <input type="password" name="password" placeholder="Password" /><br/><br/>
        <input type="submit" name="Login" value="Login" />
    </form>
    <?php
        if (!empty($data['error'])) {
            echo "<br/><br/><b>" . $data['error'] . "</b>";
        }
    ?>
<?php } else {
    header('Location: ' . BASE_URL . 'admin');
}
?>
</body>
</html>
