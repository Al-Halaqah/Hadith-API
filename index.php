<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
include_once('./database/hadith.php');
include_once('./database/quran.php');
$router = new \Bramus\Router\Router();

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404';
});

$router->mount('/api', function() use ($router) {

    $router->mount('/hadith', function () use ($router) {

        $router->get('/collection/{collection}/hadith/{number}', function ($collection, $number) {
            $info = new hadith();
            echo $info->getSpecificHadith($collection, $number);
        });

        $router->get('/collection/{collection}/chapter/{number}', function ($collection, $number) {
            $info = new hadith();
            echo $info->getAllHadith($collection, $number);
        });

        $router->get('/random', function () {
            $info = new hadith();
            echo $info->getRandomHadith();
        });

        $router->get('/chapter/{collection}', function ($collection) {
            $info = new hadith();
            echo $info->getHadithChapters($collection);
        });

        $router->get('/collection', function () {
            $info = new hadith();
            echo $info->getAllBooks();
        });
        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new hadith();
            echo $info->searchHadith($search);
        });

    });

    $router->mount('/quran', function () use ($router) {

        $router->get('/surah/{number}', function ($number) {
            $info = new Quran();
            echo $info->getWholeSurah($number);
        });

        $router->get('/surah/{surah}/verse/{verse}', function ($surah, $verse) {
            $info = new Quran();
            echo $info->getVerse($surah, $verse);
        });

        $router->get('/random', function () {
            $info = new Quran();
            echo $info->getRandomVerse();
        });

        $router->get('/chapter', function () {
            $info = new Quran();
            echo $info->getChapters();
        });

        $router->get('/verse_key/{verse_key}', function ($verse_key) {
            $info = new Quran();
            echo $info->getVersekey($verse_key);
        });

        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new Quran();
            echo $info->searchVerse($search);
        });

    });
});

// Run the routing system
$router->run(header('Content-Type: application/json'));



