<?php

  if (isset($_GET['id'])) {
    $ethos_id = $_GET['id'];
  } else {
    header("location:./login.php");
    exit();
  }

?>

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

<div class="container-fluid mb-5">

    <!-- Modified by Alex to add dynimac data from CURL-->

    <?php
    //first fetch main miner address from GET parameter if present in URL and show config table with the rest of the page
    //otherwise - display message Cannot find specified ETHOS ID

    // $ethos_id = isset($_GET['id']) ? $_GET['id'] : '165d38';

    if($ethos_id){

      // $ethos_id = "165d38";
    //ok, so now lets make API call to fetch the data.

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://".$ethos_id.".ethosdistro.com/?json=yes",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);



    curl_close($curl);
    //ideally we need first make a call and see if ethosID is valid, and/or we're not getting errors, but for now I'll omit this part
    if ($err) {
      echo "<div class='container text-center'>
                       <p>cURL Error #:" . $err . "</p>
               </div>";
      exit();
    } else {

      //add square brackets to response so that silly PHP can expplode jason data into array
        $alldata = json_decode('['.$response.']', true);

      //   jason data translates into following data/arrays
      //   alldata[0] - array containg entire response
      //   alldata[0][rigs] - 2 dimensional array [rig name][rig statistics]
      //   alldata[0][total_hash] - value
      //   alldata[0][alive_gpus]  - value
      //   alldata[0][total_gpus] - value
      //   alldata[0][alive_rigs] - value
      //   alldata[0][total_rigs] - value
      //   alldata[0][current_version] - value
      //   alldata[0][avg_temp] - value
      //   alldata[0][capacity] - value
      //   alldata[0][per_info] - 2 dimensional array [miner name][miner statistics]

      // echo raw jason
      // echo $response;
        if (!$alldata || $err) {
          echo "
                <div class='container text-center'>
                       <p>ERROR! cannot find ethos id</p>
               </div>
          ";
          exit();
        }

    }
  }
  //for now I'm just spitting raw HTML inside php, but we should rather have proper HTML wraping
  else{
    echo "Cannot find your ethOS ID! Please make sure you have added it to URL.";
  }
  ?>
  <div class="summary_wrapper row">

    <!-- start bootstrap container // insert all content within here -->
    <?php
        //summary - per_info

      if ($alldata) {
        # code...
        $summary = $alldata[0]["per_info"];

      foreach($summary as $algo_miner=>$sum_info){
    ?>
      <div class="col row-item summary_block_<?= ($algo_miner) ?>">
        <h3 class="miner_summary_head_<?= $algo_miner; ?>"><?= ($algo_miner=='claymore'||$algo_miner=='ethermine'?'Ethereum':'ZCash'); ?> </h3>
        <h5>Total Hash: <?= $sum_info["hash"]." ".($algo_miner=='claymore'?'MH/s':'Sol/s'); ?></h5>
        <h5>Total Rigs: <?= $sum_info["per_total_rigs"]; ?></h5>
        <h5>Offline: <?= $sum_info["per_total_rigs"]-$sum_info["per_alive_rigs"]; ?></h5>
        <span>Checked at: <?= date('H:i d/m', $sum_info["current_time"]); ?></span>
      </div> <!-- block summary end -->

    <?php
      }

      }
    ?>
  </div> <!-- summary wrapper end -->

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
               <!-- Display Rigs Info insid e table -->
        <?php
        if ($alldata) {
  $allrigs = $alldata[0]["rigs"];
  // display all rig stats in the long list
  foreach($allrigs as $rigname=>$rigstats){ ?>
    <tr>
      <td><input class="form-control font-weight-bold" id="<?= $rigname ?>_MinerID" type="text" value="<?= $rigname ?>" disabled></td>
      <td><input class="form-control" id="<?= $rigname ?>_driver" type="text" value="<?= $rigstats["driver"] ?>"> </td>
      <td><input class="form-control" id="<?= $rigname ?>_vlt" type="text" value="<?= $rigstats["voltage"] ?>"></td>
      <td><input class="form-control" id="<?= $rigname ?>_pwr" type="text" value="<?= $rigstats["powertune"] ?>">
      <td><input class="form-control" id="<?= $rigname ?>_mem" type="text" value="<?= $rigstats["mem"] ?>"></td>
      <td><input class="form-control" id="<?= $rigname ?>_miner" type="text" value="<?= $rigstats["miner"] ?>"></td>
      <td><input class="form-control" id="<?= $rigname ?>_flg" type="text" value="<?= $rigstats["core"] ?>"></td>
      <td><input class="form-control" id="<?= $rigname ?>_fan" type="text" value="<?= $rigstats["fanrpm"] ?>"></td>
    </tr>

  <?php }
    }
   ?>

     </tbody>
   </table>
   </div>
</div>
   <div class="container text-center mt-4">
    <button class="btn btn-primary" onclick="config()">Download Config File</button>
     <div class="form-group mt-4">
         <label for="exampleTextarea">Text output</label>
         <textarea class="form-control" id="outputText" rows="3"></textarea>
     </div>
    </div>

    <!-- end bootstrap container -->
    <!-- bootstrap js files start -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- bootstrap js files end -->

</body>
</html>