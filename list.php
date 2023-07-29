<?php
// X dizinini belirleyin (mutlak yolu kullanın)
$x_directory = './';

// Tarama sonuçlarını saklamak için boş bir dizi oluşturun
$file_info_array = array();

// X dizininin var olup olmadığını ve izinlerini kontrol edin
if (!is_dir($x_directory) || !is_readable($x_directory)) {
    die("X dizini bulunamadı veya okunabilir değil.");
}

// X dizinini tarayın
$dir_iterator = new RecursiveDirectoryIterator(realpath($x_directory));
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
foreach ($iterator as $file) {
    if ($file->isFile()) {
        $file_path = $file->getPathname();
        $file_info = array(
            'path' => $file_path,
            'size' => $file->getSize(),
            'last_modified' => $file->getMTime(),
            //"hash_calc_algorithm" => " size + last_modified"
        );
        // Dosyanın içeriğine göre hash oluşturun (örn. SHA256 kullanalım)
        $file_info['hash'] = hash_file('sha256', $file_path);
        $file_info_array[] = $file_info;
    }
}

// Elde edilen bilgileri JSON formatına dönüştürün ve y dizinine kaydedin
$json_data = json_encode($file_info_array, JSON_PRETTY_PRINT);
file_put_contents('./file_info.json', $json_data);