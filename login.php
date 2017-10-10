
<?php require './inc/header.php'; ?>

<?php require './inc/jumbotron.php'; ?>

<div class="container text-center col-6">

      <form action="./index.php" method="post" class="form">
        <div id="formGroup" class="form-group">
          <h2 class="form-signin-heading">Please enter your Ethos ID</h2>
          <label for="id" class="sr-only">Ethos ID</label>
          <div class="inner-addon right-addon">
            <i id="spinner" class="fa fa-spinner text-primary" aria-hidden="true"></i>
            <input type="text" id="id" name="id" class="form-control" placeholder="Your Ethos ID" minlength="6" maxlength="6" required autofocus>
          </div>
          <button id="submit" class="btn btn-primary btn-block mt-2" type="submit" disabled>Sign in</button>


        </div>
      </form>

    </div> <!-- /container -->



<?php require './inc/footer.php'; ?>