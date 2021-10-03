<!DOCTYPE html>  

    <head>  
        <title>Home</title>
    </head>  
    <body>
        <?php
        echo "| <a href='" . BASE_URL . "home/'>Home</a> | ";
        foreach ($data['categories'] as $category) {
            echo "<a href='" . BASE_URL . "home/index/" . $category->name . "'>" . $category->name . "</a> | ";
        }
        ?>
        <br/>
        <?php
        foreach ($data['news'] as $news) {
            echo "<h1> <a href='" . BASE_URL . "home/news/" . $news->id . "'>" . $news->title ."</a></h1>";
            echo "<h3> " . $news->highlight . "</h3>";
            echo "<p>Category: " . $news->category_name . "</p>";
            echo "<a href='" . BASE_URL . "subscribe/index/news/" . $news->id . "'>Subscribe</a>&nbsp;&nbsp;";
            echo "<a href='" . BASE_URL . "subscribe/index/categories/" . $news->category_id . "'>Subscribe to category</a>";
            echo "<hr/>";
        }
        ?>
  </body>  
</html>  
