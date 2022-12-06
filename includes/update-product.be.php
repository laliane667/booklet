<?php

require_once 'dbh.be.php';
require_once 'functions.be.php';

if(isset($_POST["submit-save"])){
    
    $bookId = $_POST['bookid'];
    $priceId = $_POST['priceid'];
    if(filter_has_var(INPUT_POST,'book-name')) {
        if(!empty($_POST["book-name"])){
            updateBookElem($conn, $bookId, $_POST["book-name"], "booksName");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-author')) {
        if(!empty($_POST["book-author"])){
            updateBookElem($conn, $bookId, $_POST["book-author"], "booksAuthor");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-version')) {
        if(!empty($_POST["book-version"])){
            updateBookElem($conn, $bookId, $_POST["book-version"], "booksVersion");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-versionTitle')) {
        if(!empty($_POST["book-versionTitle"])){
            updateBookElem($conn, $bookId, $_POST["book-versionTitle"], "booksVersionTitle");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-price')) {
        if(!empty($_POST["book-price"])){
            updateBookPrice($conn, $priceId, $_POST["book-price"], "priceValue");
        }
    }
    if(filter_has_var(INPUT_POST,'book-discount')) {
        if(!empty($_POST["book-discount"])){
            updateBookPrice($conn, $priceId, $_POST["book-discount"], "priceDiscount");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-book')) {
        if(!empty($_POST["book-book"])){
            updateBookElem($conn, $bookId, $_POST["book-book"], "booksDesc");
        }
    } 
    if(filter_has_var(INPUT_POST,'book-grade')) {
        if(!empty($_POST["book-grade"])){
            updateBookElem($conn, $bookId, $_POST["book-grade"], "booksGrade");
        }
    } 
    header("location: ../table.php?mode=edit");
    exit();
}
else{
    header("location: ../table.php");
    exit();
}
