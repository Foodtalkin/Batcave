<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
     http_response_code(404);

    include 'functions.php';
    $con = connect($config);
    if(!$con)die("Database connection aborted");
    $con1 = connect1($config);
    if(!$con1)die("Database connection aborted");
    $con2 = connect2($config);
    if(!$con2)die("Database connection aborted");
    $con3 = connect3($config);
    if(!$con3)die("Database connection aborted");
    $con4 = connect4($config);
    if(!$con4)die("Database connection aborted");
    $event_name=$_POST['event1'];
    $counter = 1;
    $values = array();
    $data = gettest('collected_data', $con1 , $event_name);
    foreach ($data as $key) {
        array_push($values, $key);
    }

    outputCSV($values,'event.csv');

    function outputCSV($data,$file_name = 'file.csv') {
       # output headers so that the file is downloaded rather than displayed
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        # Disable caching - HTTP 1.1
        header("Cache-Control: no-cache, no-store, must-revalidate");
        # Disable caching - HTTP 1.0
        header("Pragma: no-cache");
        # Disable caching - Proxies
        header("Expires: 0");
    
        # Start the ouput
        $output = fopen("php://output", "w");
        
         # Then loop through the rows
        foreach ($data as $row) {
            # Add the rows to the body
            fputcsv($output, $row); // here you can change delimiter/enclosure
        }
        # Close the stream off
        fclose($output);
    }
?>
