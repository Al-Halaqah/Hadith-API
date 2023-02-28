<?php
include_once('./database/db.php');

class Quran{

    public function getWholeSurah($number){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM quran WHERE surah=? ORDER BY ayah");
            $stmt->execute([$number]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }

    public function getRandomVerse(){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM quran ORDER BY RAND() LIMIT 1");
            $stmt->execute();
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }
    public function getVersekey($number){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM quran WHERE verse_key=? ORDER BY ayah");
            $stmt->execute([$number]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }

    public function getChapters(){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT DISTINCT surah,chapter,chapter_ar FROM quran");
            $stmt->execute();
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }

    public function getVerse($surah, $verse){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM quran WHERE surah= :surah AND ayah= :ayah ORDER BY ayah");
            $stmt->execute([
                'surah'=>$surah,
                'ayah'=>$verse,
            ]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }
    public function searchVerse($search){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM quran WHERE verse_en LIKE '%?%' OR verse_ar LIKE '%?%' OR verse_ar_harakat LIKE '%?%';");
            $stmt->execute([$search]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            echo $e;
        }
    }

}