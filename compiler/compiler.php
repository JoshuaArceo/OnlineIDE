
<?php

    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
	$dir = 'temp';
	if ( !file_exists($dir) ) {
     		mkdir ($dir, 0744);
	 }


    $random = substr(md5(mt_rand()), 0, 7);
	file_put_contents($dir.'/'.$random.'.'.$language, $code);

    $filePath = $dir.'/'.$random.".".$language;
//     $programFile = fopen($filePath, "w");
//     fwrite($programFile, $code);
//     fclose($programFile);
//     echo("test");
//     echo getcwd();

    if($language == "java") {
        $output = shell_exec("/usr/bin/java $filePath 2>&1");
        echo $output;
    }
    if($language == "python") {
        $output = shell_exec("python3 $filePath 2>&1");
        echo $output;
    }
    if($language == "javascript") {
        rename($filePath, $filePath.".js");
        $output = shell_exec("node $filePath 2>&1");
        echo $output;
    }
    if($language == "c") {
        $outputExe = "temp/".$random;
        $output = shell_exec("gcc $filePath -o $outputExe");
        $output = shell_exec("./$outputExe");
        echo $output;
    }
    if($language == "cpp") {
        $outputExe = "temp/".$random;
        shell_exec("g++ $filePath -o $outputExe");
        $output = shell_exec("./$outputExe");
        echo $output;
    }
?>


