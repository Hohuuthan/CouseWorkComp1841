<?php

function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function reviewCount($pdo){
    $sql = "
        SELECT COUNT(*) 
        FROM review r
        INNER JOIN user u ON r.user_id = u.id
        INNER JOIN film f ON r.film_id = f.id
    ";
    $query = query($pdo, $sql);
    $row = $query->fetch();
    return $row[0] ?? 0;
}

function getAllReviews($pdo) {
    $sql = "
        SELECT 
            review.id,
            review.reviewtext,
            review.reviewdate,
            review.image,
            review.user_id,           -- Quan trọng: phải có dòng này
            user.username,
            film.title AS film_title   
        FROM review
        INNER JOIN user ON review.user_id = user.id
        INNER JOIN film ON review.film_id = film.id
        ORDER BY review.reviewdate DESC
    ";
    return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getreview($pdo, $id){
    $sql = "
        SELECT 
            r.id,
            r.reviewtext,
            r.reviewdate,
            r.image AS review_image,
            r.user_id,
            r.film_id,
            u.username,
            f.title AS film_title,
            f.image AS film_image,
            f.genre,
            f.release_year,
            f.description
        FROM review r
        INNER JOIN user u ON r.user_id = u.id
        INNER JOIN film f ON r.film_id = f.id
        WHERE r.id = :id
    ";
    
    $parameters = [':id' => $id];
    
    $query = query($pdo, $sql, $parameters);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    return $result ?: false;
}

function addreview($pdo, $reviewtext, $userid, $filmid, $image){
    $sql = "INSERT INTO review SET
            reviewtext = :reviewtext,
            reviewdate = CURDATE(),
            user_id = :userid,
            film_id = :filmid,
            image = :image";

    $parameters = [
        ':reviewtext' => $reviewtext,
        ':userid'     => $userid,
        ':filmid'     => $filmid,
        ':image'      => $image
    ];

    query($pdo, $sql, $parameters);
}

function updatereview($pdo, $reviewid, $reviewtext){
    $sql = "UPDATE review SET reviewtext = :reviewtext WHERE id = :id";
    $parameters = [
        ':reviewtext' => $reviewtext,
        ':id'         => $reviewid
    ];
    query($pdo, $sql, $parameters);
}

function deletereview($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM review WHERE id = :id', $parameters);
}

function addcontact($pdo, $content, $user_id = null) {
    $sql = "INSERT INTO contact SET 
            content = :content, 
            user_id = :user_id";
    
    $parameters = [
        ':content' => $content,
        ':user_id' => $user_id
    ];

    query($pdo, $sql, $parameters);
}

// ====================== USER MANAGEMENT FUNCTIONS ======================

// Take all User
function allUsers($pdo) {
    $sql = "SELECT id, username, email, created_at FROM user ORDER BY id DESC";
    return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getUser($pdo, $id) {
    $sql = "SELECT id, username, email FROM user WHERE id = :id";
    $parameters = [':id' => $id];
    $query = query($pdo, $sql, $parameters);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function insertUser($pdo, $name, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO user (username, email, password, role, created_at) 
            VALUES (:name, :email, :password, 'user', CURDATE())";
    
    $parameters = [
        ':name'     => $name,
        ':email'    => $email,
        ':password' => $hashedPassword
    ];
    
    query($pdo, $sql, $parameters);
}

function updateUser($pdo, $id, $name, $email) {
    $sql = "UPDATE user SET username = :username, email = :email WHERE id = :id";
    $parameters = [
        ':username'  => $name,
        ':email' => $email,
        ':id'    => $id
    ];
    query($pdo, $sql, $parameters);
}

function deleteUser($pdo, $id) {
    $sql = "DELETE FROM user WHERE id = :id";
    $parameters = [':id' => $id];
    query($pdo, $sql, $parameters);
}

function allFilms($pdo) {
    $sql = "SELECT id, title, genre, release_year, image, created_at 
            FROM film 
            ORDER BY id DESC";
    return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
}

function insertFilm($pdo, $title, $genre = null, $release_year = null, $image = null) {
    $sql = "INSERT INTO film (title, genre, release_year, image, created_at) 
            VALUES (:title, :genre, :release_year, :image, NOW())";
    
    $parameters = [
        ':title'        => $title,
        ':genre'        => $genre,
        ':release_year' => $release_year,
        ':image'        => $image
    ];
    
    query($pdo, $sql, $parameters);
}

function getFilm($pdo, $id) {
    $sql = "SELECT id, title, genre, release_year, image 
            FROM film 
            WHERE id = :id";
    
    $parameters = [':id' => $id];
    $query = query($pdo, $sql, $parameters);
    
    return $query->fetch(PDO::FETCH_ASSOC);
}

function updateFilm($pdo, $id, $title, $image = null) {
    if ($image !== null) {
        // Có hình mới → cập nhật cả image
        $sql = "UPDATE film SET title = :title, image = :image WHERE id = :id";
        $parameters = [
            ':title' => $title,
            ':image' => $image,
            ':id'    => $id
        ];
    } else {
   
        $sql = "UPDATE film SET title = :title WHERE id = :id";
        $parameters = [
            ':title' => $title,
            ':id'    => $id
        ];
    }
    query($pdo, $sql, $parameters);
}


function deleteFilm($pdo, $id) {
    $sql = "DELETE FROM film WHERE id = :id";
    $parameters = [':id' => $id];
    query($pdo, $sql, $parameters);
}

function deleteContact($pdo, $id) {
    $sql = "DELETE FROM contact WHERE id = :id";
    $parameters = [':id' => $id];
    query($pdo, $sql, $parameters);
}