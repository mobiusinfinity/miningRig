<?php



// if ($post != "") {


		if (@$_FILES["configFile"]["type"]=="text/plain"){

			if (!is_dir("configFiles")) {
				    mkdir("configFiles", 0777, true);

				}

					move_uploaded_file(@$_FILES["configFile"]["tmp_name"], "configFiles/config.txt");

					// $configFile_name = @$_FILES["configFile"]["name"];


		}


?>