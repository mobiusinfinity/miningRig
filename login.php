<?php
session_start();
?>

<?php require './inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid text-center bg-success text-white">
  <h1>Cryptocurrency Mining Rig Settings</h1>
  <p>Configure your rig to maximise performace and mine more coins!</p>
</div>
<div class="container text-center col-6">

      <form action="./index.php" method="post" class="form">
        <div id="formGroup" class="form-group">
          <h2 class="form-signin-heading">Please enter your Ethos ID</h2>
          <label for="id" class="sr-only">Ethos ID</label>
          <input type="text" id="id" name="id" class="form-control" placeholder="Your Ethos ID" minlength="6" maxlength="6" required autofocus>
          <button id="submit" class="btn btn-primary btn-block mt-2" type="submit" disabled>Sign in</button>
        </div>
      </form>

    </div> <!-- /container -->

<div id="div1"></div>
<script type="text/javascript">

  $("#id").on("change paste keyup blur", function() {

      var submit = document.querySelector("#submit");
      var formGroup = document.querySelector("#formGroup");
      var idInput = document.querySelector("#id");
      var idValue = idInput.value;
      var idLength = idValue.length;
      if (idLength === 6) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

             // document.querySelector("#div1").innerHTML = this.response;

              if (this.response !== "Error") {

                  if (formGroup.classList.contains("has-danger")){
                     formGroup.classList.remove("has-danger");
                  }
                  formGroup.classList.add("has-success");
                  idInput.classList.add("form-control-success");
                  submit.disabled = false;
                } else if (formGroup.classList.contains("has-success")){
                  submit.disabled = true;
                  formGroup.classList.remove("has-success");
                  formGroup.classList.add("has-danger");
                } else if (idInput.classList.contains("form-control-success")){
                  submit.disabled = true;
                  idInput.classList.remove("form-control-success");
                  idInput.classList.add("form-control-danger");
                } else {
                  submit.disabled = true;
                  formGroup.classList.add("has-danger");
                  idInput.classList.add("form-control-danger");
                }
            }
        };
        xhttp.open("GET", "./curl.php?id="+ idValue, true);
        xhttp.send();

    } else if (formGroup.classList.contains("has-success")){
        submit.disabled = true;
        formGroup.classList.remove("has-success");
        idInput.classList.remove("form-control-success");
    } else if (formGroup.classList.contains("has-danger")){
        submit.disabled = true;
        formGroup.classList.remove("has-danger");
        idInput.classList.remove("form-control-danger");
    }

  });

</script>

    <!-- end bootstrap container -->
    <!-- bootstrap js files start -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <!-- bootstrap js files end -->



</body>
</html>