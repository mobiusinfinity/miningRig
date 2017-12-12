<?php
  session_start();
  $ethos_id = $_SESSION["id"];

  if (!isset($_SESSION["id"])) {
    header("location:./login.php");
    exit();
  }
?>

<?php require './inc/header.php'; ?>

<?php require './inc/jumbotron.php'; ?>

<div class="container-fluid">

    <!-- Modified by Alex to add dynimac data from CURL-->

    <?php

    // first fetch main miner address from GET parameter if present in URL and show config table with the rest of the page
    // otherwise - display message Cannot find specified ETHOS ID

    // $ethos_id = isset($_GET['id']) ? $_GET['id'] : '165d38';

    if($ethos_id){

    // $ethos_id = "165d38";
    // ok, so now lets make API call to fetch the data.

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
  <div class="summary_wrapper row text-center">

    <!-- start bootstrap container // insert all content within here -->
    <?php
        //summary - per_info

      if ($alldata) {
        # code...
        $summary = $alldata[0]["per_info"];

      foreach($summary as $algo_miner=>$sum_info){
    ?>
      <div class="card col m-4 bg-warning">
        <div class="card-block summary_block_<?= ($algo_miner) ?>">
              <h3 class="card-title miner_summary_head_<?= $algo_miner; ?>"><?= ($algo_miner=='claymore'||$algo_miner=='ethermine'?'Ethereum':'ZCash'); ?> </h3>
              <h5>Total Hash: <?= $sum_info["hash"]." ".($algo_miner=='claymore'?'MH/s':'Sol/s'); ?></h5>
              <h5>Total Rigs: <?= $sum_info["per_total_rigs"]; ?></h5>
              <h5>Offline: <?= $sum_info["per_total_rigs"]-$sum_info["per_alive_rigs"]; ?></h5>
              <span>Checked at: <?= date('H:i d/m', $sum_info["current_time"]); ?></span>
            </div> <!-- block summary end -->


        </div>

    <?php
      }

      }
    ?>
  </div> <!-- summary wrapper end -->

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" id="myBtn" onclick="globals()">Globals</button>


  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Global Settings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="result-modal">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveGlobals">Save changes</button>
        </div>
      </div>
    </div>
  </div>




  <div id="result"> </div>
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
      <td><input class="form-control font-weight-bold" id="<?= $rigname ?>_MinerID" type="text" value="<?= $rigname ?>" style="float: left; width: 60%; margin-right: 10px;" disabled><button class='minerSettings' id='<?= $rigname ?>' data-toggle="modal" data-target="#modalMiner" onclick="miners(this.id)">Settings</button></td>
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
   <!-- Modal -->
   <div class="modal fade bd-example-modal-lg" id="modalMiner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">Miner Settings</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body" id="result-modal-miner">

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id="saveMiners">Save changes</button>
         </div>
       </div>
     </div>
   </div>
</div>
   <div class="container text-center mt-4">
    <button class="btn btn-primary" onclick="config()">Download Config File</button>
     <div class="form-group mt-4">
         <label for="exampleTextarea">Text output</label>
         <textarea class="form-control" id="outputText" rows="3"></textarea>
     </div>
    </div>



    <script type="text/javascript">


      $(document).on('click', '.close', function() {
        $(this).closest("tr").remove();
      });

      $(document).on('click', '.minerSettings', function() {
        // $(this).closest("tr").remove();
        var minerID = $(this).attr('id');
        // alert(minerID);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {

                  var resp = this.response;

                }
            };
            xhttp.open("GET", "./curl.php?minerID="+ minerID, true);
            xhttp.send();
      });



      $(document).on('click', '.add', function() {
        if ($(this).parent().hasClass('global')) {
          $(this).parent().after("<tr class='global'><td><select class='form-control select'><option value='globalminer'>globalminer</option><option value='maxgputemp'>maxgputemp</option><option value='stratumproxy'>stratumproxy</option><option value='proxywallet'>proxywallet</option><option value='proxypool1'>proxypool1</option><option value='proxypool2'>proxypool2</option><option value='poolpass1'>poolpass1</option><option value='poolpass2'>poolpass2</option><option value='flags'>flags</option><option value='globalcore'>globalcore</option><option value='globalmem'>globalmem</option><option value='globalfan'>globalfan</option><option value='globalpowertune'>globalpowertune</option><option value='autoreboot'>autoreboot</option><option value='custompanel'>custompanel</option><option value='lockscreen'>lockscreen</option><option value='globaldesktop'>globaldesktop</option></select></td><td><label>Global</label></td><td><input type='text' class='form-control settingsInput' value=''></td><td class='add'>+</td><td class='close'>X</td></tr>");
        }
        if ($(this).parent().hasClass('worker')) {
          $(this).parent().after("<tr class='worker "+ $(this).parent().attr('class').split(' ')[1] + "'><td><select class='form-control select'><option value='driver'>driver</option><option value='miner'>miner</option><option value='flg'>flg</option><option value='mxt'>mxt</option><option value='reb'>reb</option><option value='loc'>loc</option><option value='sel'>sel</option><option value='off'>off</option><option value='wallet'>wallet</option><option value='driverless'>driverless</option><option value='desktop'>desktop</option><option value='globalminer'>globalminer</option><option value='cor'>cor</option><option value='mem'>mem</option><option value='fan'>fan</option><option value='pwr'>pwr</option><option value='vlt'>vlt</option></select></td><td><label>" + $(this).parent().attr('class').split(' ')[1] + "</label></td><td><input type='text' class='form-control settingsInput' value=''></td><td class='add'>+</td><td class='close'>X</td></tr>");
        }
      });






      $("#saveGlobals").click(function(){
          // alert($().innerHTML);

          var configString = "";

          $('#result-modal > table > tbody > tr').children().each(function() {


           if (($(this).hasClass("add")) || ($(this).hasClass("close") == "X")) {
                       configString += "\r\n";
                       // return;
              }

             $(this).children().each(function() {

               if ($(this).is("label") && $(this).hasClass("comment")) {
                  configString += "\r\n" + "#" + this.innerHTML + " ";
               }
               else if ($(this).is("label")) {

                 if (this.innerHTML != "Global") {

                  if (this.innerHTML == "proxypool1" || this.innerHTML == "proxypool2" || this.innerHTML == "proxywallet" || this.innerHTML == "poolpass1" || this.innerHTML == "poolpass2") {
                   configString = configString.slice(0, -1);
                   configString += "=" + this.innerHTML + " ";
                  }
                  else {
                    configString += this.innerHTML + " ";
                  }
                 }

               }
               else if (($(this).is("input")) || ($(this).is("select"))) {

               configString += this.value + " ";
               }

             });

          });
          var string = encodeURIComponent(configString);

          $.ajax({url: "save.php?string=" + string, success: function(result){
            alert("Saved!");
            // downloadURI("configFiles/config.txt","config.txt");
             }});

      });



      $("#saveMiners").click(function(){
          // alert($().innerHTML);

          var configString = "";

          $('#result-modal-miner > table > tbody > tr').children().each(function() {


           if (($(this).hasClass("add")) || ($(this).hasClass("close") == "X")) {
                       configString += "\r\n";
                       // return;
              }

             $(this).children().each(function() {

               if ($(this).is("label") && $(this).hasClass("comment")) {
                  configString += "\r\n" + "#" + this.innerHTML + " ";
               }
               else if ($(this).is("label")) {

                 if (this.innerHTML != "Global") {

                  if (this.innerHTML == "proxypool1" || this.innerHTML == "proxypool2" || this.innerHTML == "proxywallet" || this.innerHTML == "poolpass1" || this.innerHTML == "poolpass2") {
                   configString = configString.slice(0, -1);
                   configString += "=" + this.innerHTML + " ";
                  }
                  else {
                    configString += this.innerHTML + " ";
                  }
                 }

               }
               else if (($(this).is("input")) || ($(this).is("select"))) {

               configString += this.value + " ";
               }

             });

          });
          var string = encodeURIComponent(configString);

          $.ajax({url: "save.php?string=" + string, success: function(result){
            alert("Saved!");
            // downloadURI("configFiles/config.txt","config.txt");
             }});

      });
    </script>
<?php require './inc/footer.php'; ?>