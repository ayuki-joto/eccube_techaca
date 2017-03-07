<?php
//データベース操作クラス
class dbmanage
{
    //    post用メソッド
    public function post($userid, $text) {
        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try {
            $db = new PDO($dsn,$user,$password);
            $stmt = $db->prepare('INSERT INTO post(contents,user_id)VALUES(:contents,:user_id)');
            $stmt->bindParam(':user_id', $userid, PDO::PARAM_STR);
            $stmt->bindParam(':contents', $text, PDO::PARAM_STR);
            // クエリの実行
            $stmt->execute();
            return "ok";
        }
        catch (PDOException $e) {
            die ('エラー:' . $e->getMessage());
        }
    }



    //    全投稿内容取得用メソッド
    public function post_list(){
        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try{
            $db = new PDO($dsn,$user,$password);
            $stt = $db->query('SELECT * FROM post ORDER BY id DESC');
            $stt->execute();
            $post_list = $stt->fetchAll();
            if ($post_list !=null){
                return $post_list;
            }
            else{
                return null;
            }
        }
        catch(PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
    }

    //    投稿内容取得用メソッド
    public function post_contents($content_id){
        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';
        $id = $content_id;

        try{
            $db = new PDO($dsn,$user,$password);
            $sql = "SELECT * FROM post WHERE id = $id";
            $stt = $db->query($sql);
            $post_contents = $stt->fetchAll();
            if ($post_contents !=null){
                return $post_contents;
            }
            else{
                return null;
            }
        }
        catch(PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }
    }

    //  投稿更新用メソッド
    public function update($id, $text) {
        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try {
            $db = new PDO($dsn,$user,$password);
            $stmt = $db->prepare('UPDATE post SET contents=:contents WHERE id=:id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':contents', $text, PDO::PARAM_STR);
            // クエリの実行
            $stmt->execute();
            return "ok";
        }
        catch (PDOException $e) {
            die ('エラー:' . $e->getMessage());
        }
    }


    //  投稿削除用メソッド
    public function delete ($id){
        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try {
            $db = new PDO($dsn,$user,$password);
            $stmt = $db->prepare('delete from post where id=:id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // クエリの実行
            $stmt->execute();
            return "ok";
        }
        catch (PDOException $e) {
            die ('エラー:' . $e->getMessage());
        }
    }

}