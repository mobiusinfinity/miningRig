<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- For making responsive layouts work on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Making compatible with ms edge browser -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- update this for description -->
    <!-- <meta name="Description" content="This is a template -- update this text"> -->
    <!-- update this for favicon -->
    <!-- <link rel="icon" href="/favicon.ico" type="image/x-icon"> -->
    <!-- link to normalizer/ cross browser css styles -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <!-- link to local css stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>

    <!-- JAVASCRIPT START -->
    <!-- Personal JS file -->
    <script src="js/script.js"></script>
    <!-- Babel ECMASCRIPT Translater -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.29/browser.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>



    <!-- BOOTSTRAP START -->
    <!-- Latest compiled and minified CSS -->
    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <title>Title</title>
</head>
<nav class="navbar bg-inverse navbar-inverse navbar-toggleable-md sticky-top">
  <div class="container">
    <a href="index.php" class="navbar-brand">
        <img src="./assets/logo.png" width="60" style="text">
        Miner Settings
    </a>
    <button class="navbar-toggler navbar-toggler-right-sm float-right mt-2" type="button" data-toggle="collapse" data-target="#myContent">
      <span class="navbar-toggler-icon"></span>
    </button>

   <div class="collapse navbar-collapse" id="myContent">
    <div class="navbar-nav navbar mr-auto">
       <a href="index.php" class="nav-item nav-link active">Home</a>
        <a href="#" class="nav-item nav-link">Contact</a>
        <a href="#" class="nav-item nav-link">About</a>
        <a href="login.php" class="nav-item nav-link">Login</a>
     </div><!-- end navbar-nav navbar -->

     <form class="navbar-form navbar-right form-group" style="margin-top: 10px">

      <div class="input-group">
        <input class="form-control" type="text" name="search" id="search" placeholder="Search for...">
        <span class="input-group-btn">
          <button class="btn btn-outline-success">GO</button>
        </span>
      </div>

     </form>
    </div>  <!-- end collapse -->

  </div> <!-- end container -->
</nav>

<div class="jumbotron jumbotron-fluid text-center bg-success text-white">
  <h1>Cryptocurrency Mining Rig Settings</h1>
  <p>Configure your rig to maximise performace and mine more coins!</p>
</div>
<div class="container text-center col-6">

      <form action="./index.php" method="get" class="form">
        <div id="formGroup" class="form-group">
          <h2 class="form-signin-heading">Please enter your Ethos ID</h2>
          <label for="id" class="sr-only">Ethos ID</label>
          <input type="text" id="id" name="id" class="form-control" placeholder="Your Ethos ID" minlength="6" maxlength="6" required autofocus>
          <button id="submit" class="btn btn-primary btn-block mt-2" type="submit" disabled>Sign in</button>
        </div>
      </form>

    </div> <!-- /container -->

<div id="div1"></div>

    <!-- end bootstrap container -->
    <!-- bootstrap js files start -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <!-- bootstrap js files end -->

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
            xhttp.open("GET", "curl.php?id="+ idValue, true);
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

</body>
</html>