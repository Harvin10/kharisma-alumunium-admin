<?php
// $conn = new mysqli("sql105.epizy.com", "epiz_27719916", "JLlFVEoRB5", "epiz_27719916_shop");
date_default_timezone_set('Asia/Jakarta');
$conn = new mysqli("localhost", "root", "", "kharisma2");

function read($sql)
{
    global $conn;
    if (!$item = $conn->query($sql)) {
        echo $conn->error;
    }
    $database = [];
    while ($data = $item->fetch_assoc()) {
        $database[] = $data;
    }

    return $database;
}

function write($sql)
{
    global $conn;
    if (!$conn->query($sql)) {
        return $conn->error;
    }
    return $conn->insert_id;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
