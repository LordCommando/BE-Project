<?php

    $s=$_POST['state'];
    $command = escapeshellcmd("algo.py $s");
    $output = shell_exec($command);
    echo $output;
?>