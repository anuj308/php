<?php

require_once 'Book.php';

class Library {
    private $conn;
    private $db_host = 'localhost'; 
    private $db_user = 'root';      
    private $db_pass = '';      
    private $db_name = 'library'; 

    public function __construct() {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function addBook(Book $book) {
        $stmt = $this->conn->prepare("INSERT INTO books (isbn, title, author) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $book->isbn, $book->title, $book->author);
        if ($stmt->execute()) {
            echo "Book '" . $book->title . "' added successfully.\n";
        } else {
            echo "Error adding book: " . $this->conn->error . "\n";
        }
        $stmt->close();
    }

    public function findBookByISBN($isbn) {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE isbn = ?");
        $stmt->bind_param("s", $isbn);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $book = new Book($row['title'], $row['author'], $row['isbn']);
            $book->isBorrowed = (bool) $row['is_borrowed'];
            return $book;
        }
        return null;
    }

    public function borrowBook($isbn, $userId) {
        $book = $this->findBookByISBN($isbn);
        $user = $this->findUserById($userId);

        if (!$user) {
            echo "User with ID '" . $userId . "' not found.\n";
            return false;
        }

        if ($book) {
            if (!$book->isBorrowed) {
                $this->conn->begin_transaction(); // Start transaction for atomicity

                $stmt1 = $this->conn->prepare("UPDATE books SET is_borrowed = TRUE WHERE isbn = ?");
                $stmt1->bind_param("s", $isbn);
                $updateResult = $stmt1->execute();
                $stmt1->close();

                $stmt2 = $this->conn->prepare("INSERT INTO borrowed_books (book_isbn, user_id) VALUES (?, ?)");
                $stmt2->bind_param("si", $isbn, $userId);
                $borrowResult = $stmt2->execute();
                $stmt2->close();

                if ($updateResult && $borrowResult) {
                    $this->conn->commit();
                    echo "Book '" . $book->title . "' borrowed successfully by User ID " . $userId . ".\n";
                    return true;
                } else {
                    $this->conn->rollback();
                    echo "Error recording borrow action: " . $this->conn->error . "\n";
                    return false;
                }
            } else {
                echo "Book '" . $book->title . "' is already borrowed.\n";
                return false;
            }
        } else {
            echo "Book with ISBN '" . $isbn . "' not found.\n";
            return false;
        }
    }

    public function returnBook($isbn, $userId) {
        $book = $this->findBookByISBN($isbn);
        $user = $this->findUserById($userId);

        if (!$user) {
            echo "User with ID '" . $userId . "' not found.\n";
            return false;
        }

        if ($book) {
            if ($book->isBorrowed) {
                $this->conn->begin_transaction(); // Start transaction for atomicity

                $stmt1 = $this->conn->prepare("UPDATE books SET is_borrowed = FALSE WHERE isbn = ?");
                $stmt1->bind_param("s", $isbn);
                $updateResult = $stmt1->execute();
                $stmt1->close();

                $stmt2 = $this->conn->prepare("DELETE FROM borrowed_books WHERE book_isbn = ? AND user_id = ?");
                $stmt2->bind_param("si", $isbn, $userId);
                $returnResult = $stmt2->execute();
                $stmt2->close();

                if ($updateResult && $returnResult) {
                    $this->conn->commit();
                    echo "Book '" . $book->title . "' returned successfully by User ID " . $userId . ".\n";
                    return true;
                } else {
                    $this->conn->rollback();
                    echo "Error recording return action: " . $this->conn->error . "\n";
                    return false;
                }
            } else {
                echo "Book '" . $book->title . "' was not borrowed.\n";
                return false;
            }
        } else {
            echo "Book with ISBN '" . $isbn . "' not found.\n";
            return false;
        }
    }

    public function displayAvailableBooks() {
        echo "\n--- Available Books ---\n";
        $result = $this->conn->query("SELECT * FROM books WHERE is_borrowed = FALSE");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $book = new Book($row['title'], $row['author'], $row['isbn']);
                echo $book->displayDetails() . "\n";
            }
            $result->free();
        } else {
            echo "Error retrieving available books: " . $this->conn->error . "\n";
        }
        echo "-----------------------\n";
    }

    public function displayBorrowedBooks() {
        echo "\n--- Borrowed Books ---\n";
        $query = "
            SELECT b.title, b.author, b.isbn, u.name AS borrower_name, bb.borrow_date
            FROM borrowed_books bb
            JOIN books b ON bb.book_isbn = b.isbn
            JOIN users u ON bb.user_id = u.id
        ";
        $result = $this->conn->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "Title: " . $row['title'] . ", Author: " . $row['author'] . ", ISBN: " . $row['isbn'] . ", Borrowed by: " . $row['borrower_name'] . " on: " . $row['borrow_date'] . "\n";
            }
            $result->free();
        } else {
            echo "Error retrieving borrowed books: " . $this->conn->error . "\n";
        }
        echo "-----------------------\n";
    }

    public function displayAllBooks() {
        echo "\n--- All Books ---\n";
        $result = $this->conn->query("SELECT * FROM books");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $book = new Book($row['title'], $row['author'], $row['isbn']);
                $book->isBorrowed = (bool) $row['is_borrowed'];
                echo $book->displayDetails() . "\n";
            }
            $result->free();
        } else {
            echo "Error retrieving all books: " . $this->conn->error . "\n";
        }
        echo "-------------------\n";
    }

    // User Management Functions
    public function addUser($name, $email) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        if ($stmt->execute()) {
            echo "User '" . $name . "' added successfully with ID: " . $this->conn->insert_id . "\n";
            $stmt->close();
            return $this->conn->insert_id;
        } else {
            echo "Error adding user: " . $this->conn->error . "\n";
            $stmt->close();
            return false;
        }
    }

    public function findUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    public function updateUser($id, $name = null, $email = null) {
        $user = $this->findUserById($id);
        if (!$user) {
            echo "User with ID '" . $id . "' not found.\n";
            return false;
        }

        $updates = [];
        $types = "";
        $params = [];

        if ($name !== null) {
            $updates[] = "name = ?";
            $types .= "s";
            $params[] = $name;
        }
        if ($email !== null) {
            $updates[] = "email = ?";
            $types .= "s";
            $params[] = $email;
        }

        if (empty($updates)) {
            echo "No updates provided for user ID '" . $id . "'.\n";
            return true;
        }

        $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters dynamically
        $stmt->bind_param($types . "i", ...array_merge($params, [$id]));

        if ($stmt->execute()) {
            echo "User with ID '" . $id . "' updated successfully.\n";
            $stmt->close();
            return true;
        } else {
            echo "Error updating user: " . $this->conn->error . "\n";
            $stmt->close();
            return false;
        }
    }

    public function displayAllUsers() {
        echo "\n--- All Users ---\n";
        $result = $this->conn->query("SELECT * FROM users");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Email: " . $row['email'] . "\n";
            }
            $result->free();
        } else {
            echo "Error retrieving users: " . $this->conn->error . "\n";
        }
        echo "-------------------\n";
    }
}

?>