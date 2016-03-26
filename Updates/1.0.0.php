<?php
	echo json_encode(array(
		"MkDir" => array(
			"AppDirs" => array(
				
			),
			"SystemDirs" => array(
				
			)
		),
		"SourceFiles" => array(
			"AppFiles" => array(
				/* Ex : array(
					"Source" => "http://localhost/MSMVC/Updates/1.0.0/App/Config/Test.txt",
					"Target" => "Config/Test.php"
					)
				)*/
				array(
					"Source" => "http://localhost/MSMVC/Updates/1.0.0/App/Config/Test.txt",
					"Target" => "Config/Test.php"
				)
			),
			"SystemFiles" => array()
		)
	));
?>