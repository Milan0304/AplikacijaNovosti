<?php

class Subscribe extends Controller {

    function index($request) {
        $db = new Database();

        $target_name = isset($request[0]) ? strval($request[0]) : null;
        $target_id = isset($request[1]) ? strval($request[1]) : null;

        $this->view("subscribe", [
            'target_name' => $target_name,
            'target_id' => $target_id,
        ]);
    }

    function saveEmail($request) {
        $db = new Database();


        $email = isset($request['email']) ? strval($request['email']) : null;

        $target_name = isset($request['target_name']) ? strval($request['target_name']) : null;
        $target_id = !empty($request['target_id']) ? (int)$request['target_id'] : null;

        $exists = $db->read("SELECT * FROM subscriptions WHERE "
            . "email = '" . addslashes($email) . "' AND "
            . "target_name = '" . addslashes($target_name) . "' AND "
            . "target_id = '" . addslashes($target_id) . "';");
        if (empty($exists)) {
            $created = $db->write("INSERT INTO subscriptions (email, target_name, target_id, created_at, updated_at) VALUES ("
            . "'" . addslashes($email) . "', "
            . "'" . addslashes($target_name) . "', "
            . "'" . addslashes($target_id) . "', "
            . "CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);");
            if (empty($created)) {
                return $this->view("subscribe", [
                    'error' => 'Db error'
                ]);
            }
        }
        header('Location: ' . BASE_URL . 'home');
    }

}