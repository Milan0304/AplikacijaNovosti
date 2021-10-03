<!DOCTYPE html>

<head>
    <title>Subscribe</title>
</head>
<body>
    <form action="<?php echo BASE_URL . "subscribe/saveEmail" ?>" method="POST">
        <input type="text" name="email" placeholder="Email" /><br/><br/>
        <input type="hidden" name="target_name" value="<?php echo isset($data['target_name']) ? $data['target_name'] : ''?>" />
        <input type="hidden" name="target_id" value="<?php echo isset($data['target_id']) ? $data['target_id'] : ''?>" />
        <input type="submit" name="Subscribe" value="Subscribe" />
    </form>
    <?php
        if (!empty($data['error'])) {
            echo "<br/><br/><b>" . $data['error'] . "</b>";
        }
    ?>
</body>
</html>

