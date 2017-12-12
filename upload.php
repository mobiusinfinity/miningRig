<?php

if (file_exists('configFiles/config.txt')) {
  $lines = file('configFiles/config.txt');
} else {
  $lines = "";
}
$config = [];
$globalKey = [];
$globalValue = [];
$match1 = [];
$match2 = [];
$match3 = [];

$poolKey1 = [];
$poolKey2 = [];
$poolValue = [];

$globalFlags = [];

if (file_exists('configFiles/config.txt')) {
  foreach ($lines as $l) {

      // globals
      preg_match("/^(?<globalKey>(globalminer|maxgputemp|stratumproxy|proxywallet|proxypool1|proxypool2|poolpass1|poolpass2|flags|globalcore|globalmem|globalfan|globalpowertune|autoreboot|custompanel|lockscreen|globaldesktop)) (?<globalValue>.*)/i", $l, $global_matches);
      if (isset($global_matches['globalKey'])) {
          $globalKey[] = trim($global_matches['globalKey']);
      }
      if (isset($global_matches['globalValue'])) {
          $globalValue[] = trim($global_matches['globalValue']);
      }

      // miners
      preg_match("/^(?<match1>(driver|cor|mem|fan|pwr|vlt|miner|flg|mxt|reb|loc|sel|off|driverless|desktop)) (?<match2>\w{6}\b) (?<match3>.*)/i", $l, $matches);
      if (isset($matches['match1'])) {
          $match1[] = trim($matches['match1']);
      }
      if (isset($matches['match2'])) {
          $match2[] = trim($matches['match2']);
      }
      if (isset($matches['match3'])) {
          $match3[] = trim($matches['match3']);
      }

      // pools
      preg_match("/^(?<poolKey1>(claymore\-zcash|ewbf\-zcash))=(?<poolKey2>\w+\b) (?<poolValue>.*)/i", $l, $pool_matches);
      if (isset($pool_matches['poolKey1'])) {
          $poolKey1[] = trim($pool_matches['poolKey1']);
      }
      if (isset($pool_matches['poolKey2'])) {
          $poolKey2[] = trim($pool_matches['poolKey2']);
      }
      if (isset($pool_matches['poolValue'])) {
          $poolValue[] = trim($pool_matches['poolValue']);
      }

  }
}


$comboArrayGlobals = array_combine($globalKey, $globalValue);

if (isset($comboArrayGlobals['flags'])) {
 $globalFlags = explode(" ",$comboArrayGlobals['flags']);
}



foreach ($match3 as $key) {
    $match4[] = explode(" ",$key);
}

// $comboArray = array($match1, $match2, $match3);

?>
<?php require './inc/header.php'; ?>

<?php require './inc/jumbotron.php'; ?>

<div class="container-fluid" id="containerUpload">

  <form action="" method="POST" id="uploadForm" enctype="multipart/form-data" runat="server">
    <input type="file" name="configFile" accept=".txt" id="file">
    <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-primary" onclick()>

    <button type="button" id="save" class="btn btn-success">Save</button>
    <div name="textarea" id="textarea"></div>
  </form>
<br>

<div id="uploadDiv" class="form-group">

   <table class="table table-striped" style='width: 850px'>

     <thead>
      <col width="10%">
      <col width="20%">
      <col width="70%">
       <tr>

         <th>Key</th>
         <th>Miner</th>
         <th colspan="3">Value</th>
       </tr>
     </thead>
     <tbody>

      <?php

      for ($i = 0; $i < count($globalKey); $i++) {
       echo "<tr  id='" .$globalKey[$i] ."_global' class='global'>
              <th> <label>". $globalKey[$i] ."</label></th>
              <td> <label>Global</label></td>
              <td>";
                  if ($globalKey[$i] == "globalpowertune") {
                    echo "<input type='number' min='0' max='10' class='". $globalKey[$i] ." settingsInput globalInput form-control' value='" . $globalValue[$i] ."' >";
                  } else if (($globalKey[$i] == "maxgputemp") || ($globalKey[$i] == "globalfan")) {
                    echo "<input type='number' min='0' max='100' step='10' class='". $globalKey[$i] ." settingsInput globalInput form-control' value='" . $globalValue[$i] ."' >";
                  } else if (($globalKey[$i] == "stratumproxy") || ($globalKey[$i] == "lockscreen") || ($globalKey[$i] == "globaldesktop")) {
                    echo "<select class='form-control select '". $globalKey[$i] ."''>
                            <option value='enabled'";
                            if (trim($globalValue[$i]) == "enabled") {
                                echo "selected";
                              };

                           echo  ">enabled</option>
                            <option value='disabled'";
                             if (trim($globalValue[$i]) == "disabled") {
                                 echo "selected";
                               };

                            echo  ">disabled</option>
                          </select>";
                  } else if ($globalKey[$i] == "autoreboot") {
                    echo "<select class='form-control select '". $globalKey[$i] ."''>
                            <option value='true'";
                            if (trim($globalValue[$i]) == "true") {
                                echo "selected";
                              };

                           echo  ">true</option>
                            <option value='false'";
                             if (trim($globalValue[$i]) == "false") {
                                 echo "selected";
                               };

                            echo  ">false</option>
                          </select>";
                  } else if (($globalKey[$i] == "globalcore") || ($globalKey[$i] == "globalmem")) {
                    echo "<input type='number' min='0' max='10000' step='50' class='". $globalKey[$i] ." settingsInput globalInput form-control' value='" . $globalValue[$i] ."' >";
                  } else if ($globalKey[$i] == "flags") {

                    foreach ($globalFlags as $flags) {
                      echo "<input type='text' class='". $globalKey[$i] ." settingsInput globalInput form-control' value='". $flags ."' >";
                    }
                    // print_r($globalFlags);

                  } else {
                   echo "<input type='text' class='". $globalKey[$i] ." settingsInput globalInput form-control' value='". $globalValue[$i]."'>";
                  }

         echo     "</td>
         <td class='add'>+</td>
         <td class='close'>X</td>
            </tr>";
      }

      $minerGroup = "";

      for ($i = 0; $i < count($match1); $i++) {

        if ($minerGroup != $match2[$i]) {
          echo "<tr style='font-weight:bold' class='worker'>
                <td><label class='comment'>-". $match2[$i] ."-</label></td><td><label>---- ". $match2[$i] ." ----</label></td><td><label>-------------- ". $match2[$i] ." ----------------</label></td><td class='add'>+</td><td class='close'>X</td>
               </tr>";
        }

       echo "<tr id='" .$match1[$i] ."_". $match2[$i] ."' class='worker ". $match2[$i] ." '>
              <th> <label>". $match1[$i] ."</label></th>
              <td> <label>". $match2[$i] ."</label></td>
              <td>";


                foreach ($match4[$i] as $keysir) {
                  if (($match1[$i] == "pwr") || ($match1[$i] == "fan") || ($match1[$i] == "mxt") || ($match1[$i] == "sel")) {
                    echo "<input type='number' min='0' max='100' class='settingsInput ". $match1[$i] ." form-control' value='". trim($keysir) ."' >";
                  }
                  else if (($match1[$i] == "mem") || ($match1[$i] == "vlt") || ($match1[$i] == "reb") || ($match1[$i] == "cor")) {
                    echo "<input type='number' min='0' max='10000' class='settingsInput ". $match1[$i] ." form-control' value='". trim($keysir) ."' >";
                  } else if ($match1[$i] == "driver") {
                    echo "<select class='form-control select'>
                            <option value='amdgpu'";
                            if (trim($match3[$i]) == "amdgpu") {
                                echo "selected";
                              };

                            echo  ">amdgpu</option>
                            <option value='nvidia'";
                             if (trim($match3[$i]) == "nvidia") {
                                 echo "selected";
                               };

                            echo  ">nvidia</option>
                          </select>";
                  } else if (($match1[$i] == "driverless") || ($match1[$i] == "desktop")) {
                    echo "<select class='form-control select'>
                            <option value='enabled'";
                            if (trim($match3[$i]) == "enabled") {
                                echo "selected";
                              };

                           echo  ">enabled</option>
                            <option value='disabled'";
                             if (trim($match3[$i]) == "disabled") {
                                 echo "selected";
                               };

                            echo  ">disabled</option>
                          </select>";
                  }
                   else {
                    echo "<input type='text' class='settingsInput form-control ". $match1[$i] ."' value='" . $keysir ."'>";
                  }

              };

             echo "</td>
             <td class='add'>+</td>
             <td class='close'>X</td>
            </tr>";
            $minerGroup = $match2[$i];
      }
      // claymore zcash
      $poolgroup = "";

      for ($i = 0; $i < count($poolKey1); $i++) {
        if ($poolgroup != $poolKey1[$i]) {
          echo "<tr style='font-weight:bold'>
                <td><label class='comment'>-". $poolKey1[$i] ."-</label></td><td><label>-". $poolKey1[$i] ."-</label></td><td><label>-------------- ". $poolKey1[$i] ." ----------------</label></td><td class='add'>+</td><td class='close'>X</td>
               </tr>";
        }

       echo "<tr id='" .$poolKey1[$i] ."_". $poolKey2[$i] ."' class='". $poolKey2[$i] ."'>
              <th> <label>". $poolKey1[$i] ."</label></th>
              <td> <label>". $poolKey2[$i] ."</label></td>
              <td>";
                  if ($poolValue[$i] == "x") {
                    echo "<input type='text' class='settingsInput poolInput x form-control' value='" . $poolValue[$i] ."'>";
                  }
                   else {
                    echo "<input type='text' class='settingsInput poolInput form-control' value='" . $poolValue[$i] ."'>";
                  }

         echo     "</td>
         <td class='add'>+</td>
         <td class='close'>X</td>
            </tr>";

            $poolgroup = $poolKey1[$i];
      }
      ?>

     </tbody>
   </table>

</div>

</div>
  <script>

  //////////////// function for upload start ////////////////
  document.getElementById("uploadForm").addEventListener("submit", function(e){
     e.preventDefault();


    var formData = new FormData(this);


    if( document.getElementById("file").files.length != 0 ){
          var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


                location.reload();

           }
        };
        xhttp.open("POST", "uploadForm.php", true);
        xhttp.send(formData);
    }


  });
  //////////////// function for upload end ////////////////

  //////////////// function for upload start ////////////////

  function downloadURI(uri, name)
  {
      var link = document.createElement("a");
      link.download = name;
      link.href = uri;
      link.click();
  }


  $("#save").click(function(){
      // alert("The paragraph was clicked.");

      var configString = "";

      $('tr').children().each(function() {
       // console.log($(this).children().children().innerHTML);

       if (($(this).hasClass("add")) || ($(this).hasClass("close") == "X")) {
                   configString += "\r\n";
                   // return;
          }

         $(this).children().each(function() {
           // console.log(this.value);
           if ($(this).is("label") && $(this).hasClass("comment")) {
              configString += "\r\n" + "#" + this.innerHTML + " ";
           }
           else if ($(this).is("label")) {
           // console.log(this.innerHTML);
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
        // alert('config file saved');
        downloadURI("configFiles/config.txt","config.txt");
         }});

  });
  //////////////// function for upload end ////////////////

  $(document).on('click', '.close', function() {
    $(this).closest("tr").remove();
  });

  $(document).on('click', '.add', function() {
    if ($(this).parent().hasClass('global')) {
      $(this).parent().after("<tr><td><select class='form-control select'><option value='globalminer'>globalminer</option><option value='maxgputemp'>maxgputemp</option><option value='stratumproxy'>stratumproxy</option><option value='proxywallet'>proxywallet</option><option value='proxypool1'>proxypool1</option><option value='proxypool2'>proxypool2</option><option value='poolpass1'>poolpass1</option><option value='poolpass2'>poolpass2</option><option value='flags'>flags</option><option value='globalcore'>globalcore</option><option value='globalmem'>globalmem</option><option value='globalfan'>globalfan</option><option value='globalpowertune'>globalpowertune</option><option value='autoreboot'>autoreboot</option><option value='custompanel'>custompanel</option><option value='lockscreen'>lockscreen</option><option value='globaldesktop'>globaldesktop</option></select></td><td>Global</td><td><input type='text' class='form-control settingsInput' value=''></td><td class='add'> </td><td class='close'>X</td></tr>");
    }
    if ($(this).parent().hasClass('worker')) {
      $(this).parent().after("<tr><td><select class='form-control select'><option value='driver'>driver</option><option value='miner'>miner</option><option value='flg'>flg</option><option value='mxt'>mxt</option><option value='reb'>reb</option><option value='loc'>loc</option><option value='sel'>sel</option><option value='off'>off</option><option value='wallet'>wallet</option><option value='driverless'>driverless</option><option value='desktop'>desktop</option><option value='globalminer'>globalminer</option><option value='cor'>cor</option><option value='mem'>mem</option><option value='fan'>fan</option><option value='pwr'>pwr</option><option value='vlt'>vlt</option></select></td><td>" + $(this).parent().attr('class').split(' ')[1] + "</td><td><input type='text' class='form-control settingsInput' value=''></td><td class='add'> </td><td class='close'>X</td></tr>");
    }
  });
  </script>