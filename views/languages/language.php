<?php
session_start();

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';  // Default language
}

$lang = $_SESSION['lang'];
$lang_file = __DIR__ . "/../languages/" . $lang . ".php"; // Use absolute path

if (file_exists($lang_file)) {
    $translations = include($lang_file);
    if (!is_array($translations)) {
        $translations = include(__DIR__ . "/../languages/eng.php"); // Fallback to English
    }
} else {
    $translations = include(__DIR__ . "/../languages/eng.php"); // Fallback to English
}
?>