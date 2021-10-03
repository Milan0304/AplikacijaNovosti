<!DOCTYPE html>  
    <head>  
        <title>Post</title>
    </head>  
    <body>
        <?php
            echo "<h1> " . $data['new']->title . "</h1>";
            echo "<h3> " . $data['new']->highlight . "</h3>";
            echo "<h4> " . $data['new']->description . "</h4>";
            echo "<a href='" . BASE_URL . "subscribe/index/posts/" . $data['new']->id . "'>Subscribe</a>&nbsp;&nbsp;";
            echo "<a href='" . BASE_URL . "subscribe/index/categories/" . $data['new']->category_id . "'>Subscribe to category</a>";
            echo "<hr/>";        
        ?>
  </body>  
</html>  
