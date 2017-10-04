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
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <title>Title</title>
</head>
    <nav class="navbar bg-inverse navbar-inverse navbar-toggleable-md sticky-top">
      <div class="container">
        <a href="#" class="navbar-brand">
            <img src="./assets/logo.png" width="60" style="text">
            Miner Settings
        </a>
        <button class="navbar-toggler navbar-toggler-right-sm float-right mt-2" type="button" data-toggle="collapse" data-target="#myContent">
          <span class="navbar-toggler-icon"></span>
        </button>

       <div class="collapse navbar-collapse" id="myContent">
        <div class="navbar-nav navbar mr-auto">
           <a href="#" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">Contact</a>
            <a href="#" class="nav-item nav-link">About</a>
         </div><!-- end navbar-nav navbar -->

         <form class="navbar-form navbar-right" style="margin-top: 10px">
           <input type="form-control" name="search" placeholder="Search">
           <button class="btn btn-outline-success">GO</button>
         </form>
        </div>  <!-- end collapse -->

      </div> <!-- end container -->
    </nav>

    <div class="jumbotron jumbotron-fluid text-center bg-success text-white">
      <h1>Cryptocurrency Mining Rig Settings</h1>
      <p>I aint saying shes a gold digger...</p>
    </div>

    <!-- start bootstrap container // insert all content within here -->

  <div class="container-fluid mb-5">

     <div class="table-responsive">
       <table class="table table-striped">
         <thead>
           <tr>
             <th>Miner ID</th>
             <th>Driver</th>
             <th>Voltage</th>
             <th>Power</th>
             <th>Memory</th>
             <th>Miner</th>
             <th>Flag</th>
             <th>Fan</th>
           </tr>
         </thead>
         <tbody>
          <tr>
            <td><input class="form-control  font-weight-bold" id="miner1_MinerID" type="text" value="f1810f" disabled></td>
            <td>
              <div class="form-group">
                <select class="form-control" style="min-width: 100px;" id="miner1_Driver">
                  <option>Nvidia</option>
                  <option>Radeon</option>
                </select>
              </div>
            </td>
            <td><input class="form-control" id="miner1_vlt" type="text" value="1000 1000 1000 1000 1000"></td>
            <td><input class="form-control" id="miner1_pwr" type="text" value="9 9 9 9 9">
            <td><input class="form-control" id="miner1_mem" type="text" value="5000 5000 5000 5000 5000"></td>
            <td><input class="form-control" id="miner1_miner" type="text" value="ewbf-zcash"></td>
            <td><input class="form-control" id="miner1_flg" type="text" value="--cl-local-work 256 --cl-global-work 8192 --farm-recheck 200"></td>
            <td><input class="form-control" id="miner1_fan" type="text" value="90 90 90 90 90"></td>
          </tr>
          <tr>
            <td><input class="form-control font-weight-bold" id="miner2_MinerID" type="text" value="0004f6" disabled></td>
            <td>
              <div class="form-group">
                <select class="form-control" style="min-width: 100px;" id="miner2_Driver">
                  <option>Nvidia</option>
                  <option>Radeon</option>
                </select>
              </div>
            </td>
            <td><input class="form-control" id="miner2_vlt" type="text" value="2000 2000 2000 2000 2000"></td>
            <td><input class="form-control" id="miner2_pwr" type="text" value="9 9 9 9 9"></td>
            <td><input class="form-control" id="miner2_mem" type="text" value="4200 4200 4200 4200 4200"></td>
            <td><input class="form-control" id="miner2_miner" type="text" value="ewbf-zcash"></td>
            <td><input class="form-control" id="miner2_flg" type="text" value="--cl-local-work 256 --cl-global-work 8192 --farm-recheck 200"></td>
            <td><input class="form-control" id="miner2_fan" type="text" value="80 80 80 80 80"></td>
           </tr>
           <tr>
             <td><input class="form-control font-weight-bold" id="miner3_MinerID" type="text" value="f1810f" disabled></td>
             <td>
               <div class="form-group">
                 <select class="form-control" style="min-width: 100px;" id="miner3_Driver">
                   <option selected>Nvidia</option>
                   <option>Radeon</option>
                 </select>
               </div>
             </td>
             <td><input class="form-control" id="miner3_vlt" type="text" value="3000 3000 3000 3000 3000"></td>
             <td><input class="form-control" id="miner3_pwr" type="text" value="9 9 9 9 9"></td>
             <td><input class="form-control" id="miner3_mem" type="text" value="3200 3200 3200 3200 3200"></td>
             <td><input class="form-control" id="miner3_miner" type="text" value="claymore-zcash"></td>
             <td><input class="form-control" id="miner3_flg" type="text" value="--cl-local-work 256 --cl-global-work 8192 --farm-recheck 200"></td>
             <td><input class="form-control" id="miner3_fan" type="text" value="100 100 100 100 100"></td>
           </tr>
         </tbody>
       </table>
       </div>
   <div class="container text-center mt-4">
    <button class="btn btn-primary" onclick="config()">Download Config File</button>
     <div class="form-group mt-4">
         <label for="exampleTextarea">Text output</label>
         <textarea class="form-control" id="outputText" rows="3"></textarea>
     </div>

   </div>
      <form action="#" method="post">
          <table>
            <th></th>
          </table>
      </form>
    </div>

    <!-- end bootstrap container -->
    <!-- bootstrap js files start -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- bootstrap js files end -->

</body>
</html>