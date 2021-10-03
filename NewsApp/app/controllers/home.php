<?php

class Home extends Controller {

    function index($request) {
        $db = new Database();

        $categories = $db->read("SELECT * FROM categories;");

        $category_id = null;
        $category_name = isset($request[0]) ? strtolower($request[0]) : null;
        if (isset($category_name)) {
            $category = $db->read("SELECT * FROM categories WHERE LOWER(name) = '" . addslashes($category_name) . "';");
            if (!empty($category)) {
                $category_id = intval($category[0]->id);

            }

        }
        $sql = "SELECT * FROM news";
        if (isset($category_id)) {
            $sql .= " WHERE category_id = " . $category_id;

        }
        $sql .= " ORDER BY created_at DESC";
        $news = $db->read($sql);
        foreach ($news as $new) {
            $new->category_name = '';
            foreach ($categories as $category) {
                if ($new->category_id == $category->id) {
                    $new->category_name = $category->name;
                }
            }
        }

        $this->view("home", [
            'news' => $news,
            'categories' => $categories,
        ]);
    }

    function news($request) {
        $db = new Database();

        $id = null;
        $id = isset($request[0]) ? intval($request[0]) : null;
        $new = $db->read("SELECT * FROM news WHERE id= '" . $id . "';");
        if (empty($new)) {
            echo "error";die;
        }

        $this->view("new", [
            'new' => $new[0]
        ]);
    }

    function login($request) {
        if (!empty($request['Login'])) {
            $db = new Database();

            $username = isset($request['username']) ? $request['username'] : null;
            if (empty($username)) {
                return $this->view("login", ['error' => 'Empty username']);
            }
            $password = isset($request['password']) ? $request['password'] : null;
            //Napravljena je hesovana sifra preko sledece f-je, ukoliko treba novi admin, onda bi se odkomentarisala sl linija koda
            //$hashed_password = password_hash($password, PASSWORD_BCRYPT);
            //var_dump($hashed_password);die;
            $admin = $db->read("SELECT * FROM admins WHERE username = '" . addslashes($username) . "';");
            if (!empty($admin)) {
                if (!password_verify($password, $admin[0]->password)) {
                    return $this->view("login", ['error' => 'Invalid username or password']);
                }
                $_SESSION['admin'] = $admin[0]->username;
                header('Location: ' . BASE_URL . 'admin');

            } else {
                return $this->view("login", ['error' => 'Invalid username or password']);
            }
        }
        $this->view("login", []);
    }
}
