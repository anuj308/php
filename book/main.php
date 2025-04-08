<?php

require_once 'Library.php';
require_once 'Book.php';
require_once 'User.php';

$library = new Library();

while (true) {
    echo "\nLibrary Management System\n";
    echo "1. Display All Books\n";
    echo "2. Display Available Books\n";
    echo "3. Display Borrowed Books\n";
    echo "4. Borrow Book (by ISBN and User ID)\n";
    echo "5. Return Book (by ISBN and User ID)\n";
    echo "6. Add User\n";
    echo "7. Update User Details (by ID)\n";
    echo "8. Display All Users\n";
    echo "9. Add Book\n";
    echo "10. Exit\n";
    echo "Enter your choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1':
            $library->displayAllBooks();
            break;
        case '2':
            $library->displayAvailableBooks();
            break;
        case '3':
            $library->displayBorrowedBooks();
            break;
        case '4':
            echo "Enter ISBN of the book to borrow: ";
            $isbnToBorrow = trim(fgets(STDIN));
            echo "Enter User ID: ";
            $userIdBorrow = trim(fgets(STDIN));
            $library->borrowBook($isbnToBorrow, $userIdBorrow);
            break;
        case '5':
            echo "Enter ISBN of the book to return: ";
            $isbnToReturn = trim(fgets(STDIN));
            echo "Enter User ID: ";
            $userIdReturn = trim(fgets(STDIN));
            $library->returnBook($isbnToReturn, $userIdReturn);
            break;
        case '6':
            echo "Enter user name: ";
            $userName = trim(fgets(STDIN));
            echo "Enter user email: ";
            $userEmail = trim(fgets(STDIN));
            $library->addUser($userName, $userEmail);
            break;
        case '7':
            echo "Enter User ID to update: ";
            $userIdUpdate = trim(fgets(STDIN));
            echo "Enter new name (leave blank to skip): ";
            $newName = trim(fgets(STDIN));
            echo "Enter new email (leave blank to skip): ";
            $newEmail = trim(fgets(STDIN));
            $library->updateUser($userIdUpdate, $newName ?: null, $newEmail ?: null);
            break;
        case '8':
            $library->displayAllUsers();
            break;
        case '9':
            echo "Enter book title: ";
            $bookTitle = trim(fgets(STDIN));
            echo "Enter book author: ";
            $bookAuthor = trim(fgets(STDIN));
            echo "Enter book ISBN: ";
            $bookISBN = trim(fgets(STDIN));
            $newBook = new Book($bookTitle, $bookAuthor, $bookISBN);
            $library->addBook($newBook);
            break;
        case '10':
            $library->closeConnection();
            echo "Exiting the system. Goodbye!\n";
            exit;
        default:
            echo "Invalid choice. Please try again.\n";
    }
}

?>