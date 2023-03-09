<?php
include_once('./database/db.php');

class hadith{

    public function getSpecificHadith($collection, $number){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM hadith WHERE collection= :collection AND hadithNumber= :number");
            $stmt->execute([
                'collection'=>$collection,
                'number'=>$number
            ]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }

    public function getAllHadith($collection, $number){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM hadith WHERE collection= :collection AND chapter_number= :number ORDER BY hadithNumber");
            $stmt->execute([
                'collection'=>$collection,
                'number'=>$number
            ]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }

    public function getRandomHadith(){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT * FROM hadith ORDER BY RAND() LIMIT 1");
            $stmt->execute();
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }
    public function getHadithChapters($collection){
        try{
            $db = new database();
            $stmt = $db->conn->prepare("SELECT DISTINCT chapter,chapter_number FROM hadith WHERE collection= :collection ORDER BY chapter_number");
            $stmt->execute(['collection'=>$collection]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }

    public function searchHadith($search){
        try{
            $db = new database();
            $stmt = $db->conn->prepare('SELECT * FROM hadith WHERE text AND Text_en AND transmiter LIKE "%?%" ');
            $stmt->execute([$search]);
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }
    public function getAllBooks(){
        try{
            $db = new database();
            $stmt = $db->conn->prepare('SELECT DISTINCT collection FROM hadith ORDER BY collection ASC');
            $stmt->execute();
            $data = ['statusCode'=>200,'statusMessage'=>'Ok','data'=> $stmt->fetchAll(PDO::FETCH_ASSOC), 'timestamp'=>time()];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }catch (Exception $e){
            print_r($e);
        }
    }
}
