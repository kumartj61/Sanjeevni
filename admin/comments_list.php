<!DOCKTYPE html>

<html lang="en">
<head title="cms">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title >Admin</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a3d26f126d.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="./Editor/editor.js"></script>
<script>
  $(document).ready(function() {
    $("#txtEditor").Editor();
  });
</script>
<link href="./Editor/editor.css" type="text/css" rel="stylesheet"/>

</head>
<body>
  <?php include "includes/header.php"?>
  <div class="row">
    <?php include "includes/aside.php"


    ?>
    <div class="col-sm-10">

      <div class="container-fluid">
        <div class="row mt-2">
          <div class="card col-sm-12">
            <div class="card-header bg-primary text-white">Latest Comments</div>
            <div class="card-body" >
              <table class="table table-striped">
                <thead>
                  <th>Sno.</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Email</th>
                  <th>Posts</th>
                  <th>Comment</th>
                  <th>Status</th>
                  <th>Delete</th>


                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>21/04/2000</td>
                    <td>Tushar</td>
                    <td>kumartj.61@yahoo.com</td>
                    <td>5</td>
                    <td>Very nice post</td>
                    <td>Approved</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>21/04/2000</td>
                    <td>Tushar</td>
                    <td>kumartj.61@yahoo.com</td>
                    <td>5</td>
                    <td>Very nice post</td>
                    <td>Approved</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>21/04/2000</td>
                    <td>Tushar</td>
                    <td>kumartj.61@yahoo.com</td>
                    <td>5</td>
                    <td>Very nice post</td>
                    <td><a href="#" class="btn btn-warning btn-sm">Approve</a></td>
                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>21/04/2000</td>
                    <td>Tushar</td>
                    <td>kumartj.61@yahoo.com</td>
                    <td>5</td>
                    <td>Very nice post</td>
                    <td>Approved</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
</body>
