<?php
    if (empty($_SESSION['admin'])) {
        header('Location: ' . BASE_URL . 'home');
    }
?>
<!DOCTYPE html>

    <head>  
        <title>Admin</title>
    </head>  
    <body>
    <form action="<?= BASE_URL . "admin/saveNews" ?>" method="POST">
        <label><?php echo isset($data['update_news']->title) ? 'Update' : 'Create'; ?> news</label><br/><br/>
        <input type="text" name="title" placeholder="Title" value="<?php echo isset($data['update_news']->title) ? $data['update_news']->title : ''; ?>" /><br/><br/>
        <input type="text" name="highlight" placeholder="Highlight" value="<?php echo isset($data['update_news']->highlight) ? $data['update_news']->highlight : ''; ?>" /><br/><br/>
        <input type="text" name="description" placeholder="Description" value="<?php echo isset($data['update_news']->description) ? $data['update_news']->description : ''; ?>" /><br/><br/>
        <select name="category_id">
            <?php
            foreach ($data['categories'] as $category) {
                echo "<option value='" . $category->id . "' " . (isset($data['update_news']->category_id) && $data['update_news']->category_id == $category->id ? 'selected' : '') . ">" . $category->name . "</option>";
            }
            ?>
        </select><br/><br/>
        <input type="hidden" name="id" value="<?php echo isset($data['update_news']->id) ? $data['update_news']->id : ''; ?>" />
        <input type="submit" name="save" value="Save" />
    </form>
    <br/>
    <?php
    foreach ($data['news'] as $news) {
        echo "<h1>Title: " . $news->title . "</h1>";
        echo "<h3>Highlight: " . $news->highlight . "</h3>";
        echo "<p>Category: " . $news->category_name . "</p>";
        echo "<a href='" . BASE_URL . "admin/index/" . $news->id . "'>Update</a>";
        echo "<hr/>";
    }
    ?>
    </br>
    <?php
        echo "<h1>SUBSCRIPTIONS LIST</h1>";
        foreach ($data['subscriptions'] as $subscriptions) {           
            echo "<p> " . $subscriptions->email . "</h1>";
            echo "<hr/>";
        }
    ?> 
    </body>  
</html>  