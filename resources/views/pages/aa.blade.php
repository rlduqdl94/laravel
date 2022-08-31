

<?php
date_default_timezone_set('Asia/Seoul');

// $serverName = "211.250.242.31,1455";
// $serverName = "10.0.0.2,1433";

$con = mysqli_connect(
    'localhost',
    'root',
    'jyhlee8133!',
    'leelee');


$search_data = $aaaa;
$date_len = strlen($search_data);

if ($date_len < 9) {
    $date_val = $search_data;
    $sql = "SELECT * FROM notice WHERE LEFT(date_time,7) LIKE '$date_val%'";
}else{
    $search_data = trim($search_data);
    $date_val = explode("-",$search_data);
    $start_date = $date_val[0].'-'.$date_val[1].'-'.$date_val[2];
    $start_date = trim($start_date);
    $end_date = $date_val[3].'-'.$date_val[4].'-'.$date_val[5];
    $end_date = trim($end_date);
    $sql = "SELECT * FROM notice WHERE date_time BETWEEN '$start_date' AND '$end_date'";
}

    // $sql = "SELECT * FROM notice";
    // 1. 데이터베이스에서 데이터를 가져옴
    if ($result = mysqli_query($con, $sql)) {
        // 2. 데이터베이스로부터 반환된 데이터를
        // 객체 형태로 가공함
        $o = array();
        while ($row = mysqli_fetch_object($result)) {
            $t = new stdClass();
            $t->title = $row->title;
            $t->content = $row->content;
            $t->date_time = $row->date_time;
            $t->writer = $row->writer;
            $t->file = $row->file;
            $o[] = $t;
            unset($t);
        }
    } else {
        $o = array( 0 => 'empty');
    }

echo json_encode($o);
?>