<?php

class Book {
    public $title;
    public $author;
    public $isbn;
    public $isBorrowed = false;

    public function __construct($title, $author, $isbn) {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }

    public function borrowBook() {
        if (!$this->isBorrowed) {
            $this->isBorrowed = true;
            return true;
        }
        return false; // Book already borrowed
    }

    public function returnBook() {
        if ($this->isBorrowed) {
            $this->isBorrowed = false;
            return true;
        }
        return false; // Book not borrowed
    }

    public function displayDetails() {
        return "Title: " . $this->title . ", Author: " . $this->author . ", ISBN: " . $this->isbn . ", Status: " . ($this->isBorrowed ? "Borrowed" : "Available");
    }
}

?>