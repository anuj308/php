<?php

class User {
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function displayDetails() {
        return "ID: " . $this->id . ", Name: " . $this->name . ", Email: " . $this->email;
    }
}

?>