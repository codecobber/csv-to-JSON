<?php
if (($handle = fopen("csvFile.csv", "r")) !== FALSE) {
    $csvs = [];
    $datas = [];
    $column_names = [];

    //add an array for each line
    while(! feof($handle)) {
       $csvs[] = fgetcsv($handle);
    }

    // add column names to column_names array
    foreach ($csvs[0] as $single_csv) {
        $column_names[] = $single_csv;
    }

    //
    foreach ($csvs as $key => $csv) {

        if ($key === 0 || $csv == null) {
            continue;
        }
        foreach ($column_names as $column_key => $column_name) {
            $datas[$key-1][$column_name] = $csv[$column_key];
        }
    }
    $json = json_encode($datas,JSON_PRETTY_PRINT);
    file_put_contents("newJson.json",$json);
    fclose($handle);
    print_r($json);
}
?>
