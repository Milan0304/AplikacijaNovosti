<?php

class Admin extends Controller {

    function index($request) {
        $db = new Database();

        $categories = $db->read("SELECT * FROM categories;");

        $news = $db->read("SELECT * FROM news ORDER BY created_at DESC");
        foreach ($news as $new) {
            $new->category_name = '';
            foreach ($categories as $category) {
                if ($new->category_id == $category->id) {
                    $new->category_name = $category->name;
                }
            }
        }

        $update_news = null;
        $news_id = isset($request[0]) ? intval($request[0]) : null;
        if (!empty($news_id)) {
            $_update_news = $db->read("SELECT * FROM news WHERE id = " . $news_id);
            if (!empty($_update_news)) {
                $update_news = $_update_news[0];
            }
        }

        $subscriptions = $db->read("SELECT * FROM subscriptions");

        $this->view("admin", [
            'news' => $news,
            'categories' => $categories,
            'update_news' => $update_news,
            'subscriptions' => $subscriptions,
        ]);
    }


    function saveNews($request) {
        $db = new Database();

        $title = isset($request['title']) ? $request['title'] : null;
        $highlight = isset($request['highlight']) ? $request['highlight'] : null;
        $description = isset($request['description']) ? $request['description'] : null;
        $category_id = isset($request['category_id']) ? (int)$request['category_id'] : null;

        $id = !empty($request['id']) ? (int)$request['id'] : null;

        if (empty($id)) {
            // slati mail za kategoriju( nije uradjeno :( )
            $created = $db->write("INSERT INTO news (category_id, title, highlight, description, created_at, updated_at) VALUES ("
                . $category_id . ', ' // category_id
                . "'" . addslashes($title) . "', " //title
                . "'" . addslashes($highlight) . "', " //highlight
                . "'" . addslashes($description) . "', " //description
                . "CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);"); // created_at, updated_at
            if (!$created) {

            }
        } else {
            // uzeti red sa $id iz baze
            // uporedjuje se svaki value-a da li postoji izmena
            // ako postoji promena, slati mailove ( nije uradjeno :( )
            $updated = $db->update("UPDATE news SET "
                . "category_id = " . $category_id . ", "
                . "title = '" . addslashes($title) . "', "
                . "highlight = '" . addslashes($highlight) . "', "
                . "description = '" . addslashes($description) . "' "
                . "WHERE id = " . $id);
            if (!$updated) {
                // error handling
            }
        }

        return $this->index($request);
    }



}

