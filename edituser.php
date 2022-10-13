<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
            <div >
              <div >
                <div >
                  <h1>Edit Book:</h1>
                 
                </div>
                <form method="post">
                  <?php 
                    require 'config.php';
                    $id = $_GET['id'];
                    $books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM books WHERE id = '$id'"));
                  ?>
                  <div class="alert alert-warning d-none"></div>
                    <div class="modal-body">
                    <div class="mb-3">
                          <input type="hidden" name="id" value="<?php echo $books['id']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="">Title</label>
                          <input type="text" name="title" value="<?php echo $books['title']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for=""> 	ISBN</label>
                          <input type="text" name="isbn"  value="<?php echo $books['isbn']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                        <label for="">AUTHOR</label>
                        <input type="text" name="author"  value="<?php echo $books['author']; ?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">PUBLISHER</label>
                        <input type="text" name="publisher"  value="<?php echo $books['publisher']; ?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">YEAR PUBLISHED</label>
                        <input type="text" name="year_published"  value="<?php echo $books['year_published']; ?>" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">CATEGORY</label>
                        <input type="text" name="category"  value="<?php echo $books['category']; ?>" class="form-control">
                      </div>
                    </div>
                  <div class="modal-footer">
                    <a href="index.php"type="button" class="btn btn-secondary me-3">Go back</a>
                    <button type="submit" onClick="submitData('edit');" class="btn btn-primary">Edit Book</button>
                  </div>
                </form>
              </div>
            </div>
          </div> 

          
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
