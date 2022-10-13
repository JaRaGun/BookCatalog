<?php 
require 'config.php'; 

 if(isset($_POST['action']))
 {
    if($_POST['action'] == "insert")
    {
        insert();
    }
    else if($_POST['action'] == "edit")
    {
        edit();
    }
    else if($_POST['action'] == "delete")
    {
        delete();
    }
 }

 function insert()
 {
    global $conn;

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $year_published = mysqli_real_escape_string($conn, $_POST['year_published']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    if( $title==NULL || $isbn == NULL || $author == NULL || $publisher == NULL || $year_published == NULL || $category == NULL)
    {
       $res = [
            'status' => 422,
            'message' => 'Please fill all fields'
       ];

       echo json_encode($res);
       return false;
    }
    else
    {
        $sql = "INSERT INTO books (title, isbn, author, publisher, year_published, category) VALUES ('$title', '$isbn', '$author', '$publisher', '$year_published', '$category')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $res = [
                'status' => 200,
                'message' => 'Book added successfully'
           ];
    
           echo json_encode($res);
           return false;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Something went wrong'
           ];
    
           echo json_encode($res);
           return false;
        }
    }
 }

 function edit()
 {
    global $conn;
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $year_published = mysqli_real_escape_string($conn, $_POST['year_published']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "UPDATE books SET title = '$title', isbn = '$isbn', author = '$author', publisher = '$publisher', year_published = '$year_published', category = '$category' WHERE id = {$_POST['id']}";
    mysqli_query($conn,$query);
    $res = [
        'status' => 200,
        'message' => 'Book updated successfully'
    ];
 }

 function delete()
 {
    global $conn;

    $id = $_POST["action"];
    $query = "DELETE FROM books WHERE id = $id";
    mysqli_query($conn,$query);
    $res = [
        'status' => 200,
        'message' => 'Book deleted successfully'
    ];
 }
?>