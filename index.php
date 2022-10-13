<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

  <main class="flex-container vh-100 d-flex justify-content-center align-items-start">
    <!-- Add BOOKS  -->
    <div class="container d-flex justify-content-center align-items-end flex-column p-5">
      <div>
        <button class="btn btn-lg btn-success"  data-bs-toggle="modal" data-bs-target="#addBooks">
          Add
        </button>
          <!-- ADD Modal -->
          <div class="modal fade" id="addBooks" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Book:</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                  <div class="alert alert-warning d-none"></div>
                    <div class="modal-body">
                        <div class="mb-3">
                          <label for="">Title</label>
                          <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for=""> 	ISBN</label>
                          <input type="text" name="isbn" class="form-control">
                        </div>
                        <div class="mb-3">
                        <label for="">AUTHOR</label>
                        <input type="text" name="author" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">PUBLISHER</label>
                        <input type="text" name="publisher" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">YEAR PUBLISHED</label>
                        <input type="text" name="year_published" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">CATEGORY</label>
                        <input type="text" name="category" class="form-control">
                      </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onClick="submitData('insert');" class="btn btn-primary">Add Book</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End of AddModla -->
      </div>
    <div class="container">
      <!-- Table -->
      <table id="bookTable" class="table">
        <thead>
          <tr>
            <th scope="col">TITLE</th>
            <th scope="col">ISBN</th>
            <th scope="col">AUTHOR</th>
            <th scope="col">PUBLISHER</th>
            <th scope="col">YEAR PUBLISHED</th>
            <th scope="col">CATEGORY</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          require 'config.php';
          $query = "SELECT * FROM books";
          $result = mysqli_query($conn, $query);

          if(mysqli_num_rows($result) > 0 )
          {
            foreach($result as $book)
            {
               ?>
               <tr>
                <td><?= $book['title'] ?></td>
                <td><?= $book['isbn'] ?></td>
                <td><?= $book['author'] ?></td>
                <td><?= $book['publisher'] ?></td>
                <td><?= $book['year_published'] ?></td>
                <td><?= $book['category'] ?></td>
                <td>
                  <a href="edituser.php?id=<?php echo $book['id'];?>" class="btn btn-secondary">EDIT</a>
                  <a href="" class="btn btn-secondary" onClick="submitData(<?php echo $book['id']; ?>);">DELETE</a>
                </td>
               </tr>
               <?php
            }
          }
          ?>
        </tbody>
      </table>
  <!-- End of Table -->
    </div>
    </div>
  </main>


    <script script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function submitData(action)
      {
        $(document).ready(function()
        {
          var data = {
            action: action,
            title: $('input[name="title"]').val(),
            isbn: $('input[name="isbn"]').val(),
            author: $('input[name="author"]').val(),
            publisher: $('input[name="publisher"]').val(),
            year_published: $('input[name="year_published"]').val(),
            category: $('input[name="category"]').val()
          };

          $.ajax({
            type: "post",
            url: "saveBook.php",
            data: data,
            success: function (response) {
              alert(response)
              if(response == "Deleted Successfully")
              {
                $('#'+action).css("display", "none");
              }
            }
          });
        })
      }
    </script>
  
  </body>
</html>
