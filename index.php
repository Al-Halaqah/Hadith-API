<?php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
include_once('./database/hadith.php');
include_once('./database/quran.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$router = new \Bramus\Router\Router();

$router->set404(function () {
   print_r("404");
});

$router->get('/', function(){
    $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> 'https://github.com/Al-Halaqah/Hadith-API', 'timestamp'=>time()];
    print_r(json_encode($data));
});

$router->mount('/api', function() use ($router) {

    $router->mount('/hadith', function () use ($router) {

        $router->get('/collection/{collection}/hadith/{number}', function ($collection, $number) {
            $info = new hadith();
            print_r($info->getSpecificHadith($collection, $number));
        });

        $router->get('/collection/{collection}/chapter/{number}', function ($collection, $number) {
            $info = new hadith();
            print_r($info->getAllHadith($collection, $number));
        });

        $router->get('/random', function () {
            $info = new hadith();
            print_r($info->getRandomHadith());
        });

        $router->get('/chapter/{collection}', function ($collection) {
            $info = new hadith();
            print_r($info->getHadithChapters($collection));
        });

        $router->get('/collection', function () {
            $info = new hadith();
            print_r($info->getAllBooks());
        });
        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new hadith();
            print_r($info->searchHadith($search));
        });

    });

    $router->mount('/quran', function () use ($router) {

        $router->get('/surah/{number}', function ($number) {
            $info = new Quran();
            print_r($info->getWholeSurah($number));
        });

        $router->get('/random', function () {
            $info = new Quran();
            print_r($info->getRandomVerse());
        });

        $router->get('/chapter', function () {
            $info = new Quran();
            print_r($info->getChapters());
        });

        $router->get('/verse_key/{verse_key}', function ($verse_key) {
            $info = new Quran();
            print_r($info->getVersekey($verse_key));
        });

        $router->post('/search', function () {
            $search = $_POST['search'];
            $info = new Quran();
            print_r($info->searchVerse($search));
        });

    });
});

// Run the routing system
$router->run(header('Content-Type: application/json'));



