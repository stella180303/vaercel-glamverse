<?php
// Debug
if (!file_exists(__DIR__.'/../public/index.php')) {
    die('Tidak ditemukan public/index.php di ' . realpath(__DIR__.'/../public/index.php'));
}

require __DIR__.'/../public/index.php';
