<?php
function d($value) {
    echo '<pre>' . print_r($value, true) . '</pre>';
}
/*$dir = __DIR__;
d($dir); */

function ext($filename) {
    return strtolower(end(explode('.', $filename)));
}

function enc($filename) {
    $onlyEng = preg_match('/^[a-zA-Z0-9\._]+$/', $filename);
    if ($onlyEng) {
        return $filename;
    } else {
        return iconv('windows-1251', 'utf-8', $filename);
    }
}

function getGps($exifCoord, $hemi) {

    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

}

function gps2Num($coordPart) {

    $parts = explode('/', $coordPart);

    if (count($parts) <= 0)
        return 0;

    if (count($parts) == 1)
        return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
}

function relocate($absSrcFile, $absDstDir) {
    $fileName = end(explode('/', $absSrcFile));
    rename($absSrcFile, $absDstDir . '/' . $fileName);
}

function viewTableData($tableName) {
    $query = 'SELECT * FROM ' . $tableName ;
    $result = mysql_query($query) or die("Invalid query: " . mysql_error());
    $numResults = mysql_num_rows($result);
    for ($i = 0; $i < $numResults; $i++) {
        $rowSet[] = mysql_fetch_assoc($result);
    }
    return $rowSet;
}

function viewById($tablename, $id) {
    $query = 'SELECT * FROM ' . $tablename . ' WHERE `id` = ' . $id ;
    if ($result = mysql_query($query)) {
        $rowSet = mysql_fetch_assoc($result);
        return $rowSet;
    } else {
        d("Invalid query: " . mysql_error());
        die();
    }
}




