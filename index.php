<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
include_once('./database/hadith.php');
include_once('./database/quran.php');
$router = new \Bramus\Router\Router();

$router->set404(function () {
   print_r("404");
});

$router->mount('/api', function() use ($router) {

    $router->mount('/hadith', function () use ($router) {

        $router->get('/collection/{collection}/hadith/{number}', function ($collection, $number) {
            $info = new hadith();
            return $info->getSpecificHadith($collection, $number);
        });

        $router->get('/collection/{collection}/chapter/{number}', function ($collection, $number) {
            $info = new hadith();
            return $info->getAllHadith($collection, $number);
        });

        $router->get('/random', function () {
            $info = new hadith();
            return $info->getRandomHadith();
        });

        $router->get('/chapter/{collection}', function ($collection) {
            $info = new hadith();
            return $info->getHadithChapters($collection);
        });

        $router->get('/collection', function () {
            $info = new hadith();
            return $info->getAllBooks();
        });
        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new hadith();
            return $info->searchHadith($search);
        });

    });

    $router->mount('/quran', function () use ($router) {

        $router->get('/surah/{number}', function ($number) {
            $info = new Quran();
            return $info->getWholeSurah($number);
        });

        $router->get('/surah/{surah}/verse/{verse}', function ($surah, $verse) {
            $info = new Quran();
            return $info->getVerse($surah, $verse);
        });

        $router->get('/random', function () {
            $info = new Quran();
            return $info->getRandomVerse();
        });

        $router->get('/chapter', function () {
            $info = new Quran();
            return $info->getChapters();
        });

        $router->get('/verse_key/{verse_key}', function ($verse_key) {
            $info = new Quran();
            return $info->getVersekey($verse_key);
        });

        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new Quran();
            return $info->searchVerse($search);
        });

    });
});

// Run the routing system
$router->run(header('Content-Type: application/json'));



