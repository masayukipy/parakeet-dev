<?PHP

require_once('env.php');

class Subject{

    protected $name;
    protected $table;

    function __construct($name,$table){
        $this->name = $name;
        $this->table = $table;
    }

    function getName(){
        return $this->name;
    }
    function getTable(){
        return $this->table;
    }

    private function dbConnect(){
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "mysql:host=$host; dbname=$dbname; charset=utf8;";
        
        try{
        $dbh = new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
        ]);

        }catch(PDOException $e){
            echo '接続失敗'.$e->getMessage();
            exit();
        }
        return $dbh;
    }




    

// -------------------------------(listページ)-----------------------------------------------------

    //topページから受け取った値をどのクラスか判断するメソッド 
    static function findByName($subjects,$name){
        if($name == null){
            exit("該当のページが見つかりません");
        }
        foreach($subjects as $subject){
            if($subject->getName() == $name){
                return $subject;
            }
        }
    }

    function getTitleCountDb($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT count(`title`) from blog where subject = :title");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getNameCountDb($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT count(`title`) from blog where curriculum = :title");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // 【$_GET['name']】の場合。titleとlengthを取得。idの昇順で並べてる
    function getNameSingleDb($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT title,length
                                FROM blog
                                WHERE curriculum = :title
                                ORDER BY id
                                ASC
                                LIMIT 10");
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // 再生時間の合計(name)
    function getNameLength($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT
                                sum( time_to_sec(length)) as total_sec,
                                sec_to_time(sum( time_to_sec(length))) as total_time
                                FROM blog
                                WHERE curriculum = :title");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // 再生時間の合計(title)
    function getTitleLength($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT
                                sum( time_to_sec(length)) as total_sec,
                                sec_to_time(sum( time_to_sec(length))) as total_time
                                FROM blog
                                WHERE subject = :title");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // カテゴリナンバーとカテゴリネームを取得　ポイント:データが何もなくnull値でもnullと判定されていないかnullではない事になってる為 != '' このコードにしてる
    function getCategory($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT DISTINCT category_number,category_name
                                FROM blog
                                WHERE subject = :title AND category_number != ''");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // category別に➀合計曲数➁合計再生時間➂カテゴリナンバー
    function getCategoryGroupTotal($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT category_number,COUNT(title),sum( time_to_sec(length)) as total_sec,sec_to_time(sum( time_to_sec(length))) as total_time
                                FROM `blog`
                                WHERE subject = :title
                                GROUP BY category_number");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // category別に➀タイトル名➁合計再生時間
    function getCategoryGroupSingle($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT category_number,title,sum( time_to_sec(length)) as total_sec, sec_to_time(sum( time_to_sec(length))) as total_time
                                FROM blog
                                WHERE subject = :title
                                GROUP BY category_number,title");
        // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
// ------------------------------ここまでlistページ----------------------------------------------------------



// -------------------------------(allページ)---------------------------------------------------------------

function allPageTitle($title){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT title
                            FROM blog
                            WHERE curriculum = :title");
    // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
    $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function allPageCountTitle($title){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT count(`title`)
                            FROM blog
                            WHERE curriculum = :title");
    // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
    $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function allPageTitleLength($title){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT title,sum( time_to_sec(length)) as total_sec, sec_to_time(sum( time_to_sec(length))) as total_time
                            FROM blog
                            WHERE curriculum = :title
                            GROUP BY title ");
    // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
    $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// -------------------------------ここまでallページ------------------------------------------------------




// -------------------------------(playページ)-----------------------------------------------------

// clickされた【title】の場合(list->play)
function getPlayTitleDb($title){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT * FROM blog WHERE title = :title");
    $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}
// curriculum、subjectも両方のすべて表示のシャッフルボタンが押された時
function getDoubleName($name){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT * FROM blog WHERE curriculum = :name");
    $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        $stmt = $dbh ->prepare("SELECT * FROM blog WHERE subject = :name");
        $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}
// curriculum、subjectも両方のすべて表示の順番に再生が押された時
function getDoubleOrderName($name){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT * FROM blog WHERE curriculum = :name ORDER BY id ASC");
    $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        $stmt = $dbh ->prepare("SELECT * FROM blog WHERE subject = :name ORDER BY category_number ASC");
        $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}
// listページからカテゴリ別にクリックされた時
function getIdentificationCategory($name,$category){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT * FROM blog WHERE subject = :name AND category_number = :category ORDER BY id ASC");
    $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
    $stmt -> bindValue(':category',$category,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}
function getMixNext($name){
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT * FROM blog WHERE curriculum = :name ORDER BY id ASC");
    $stmt -> bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}

// ------------------------------ここまで------------------------------------------------------------










// -------------------------------(searchページ)----------------------------------------------------

// 検索結果の数をまとめてカウントして降順でソートしてるSQL
function getSearchDb($searchName){
    if(empty($searchName)){
        exit('該当ページが見つかりません');
    }
    $dbh = $this->dbConnect();
    $stmt = $dbh ->prepare("SELECT title,count(`title`) FROM blog
                            WHERE concat(article,title) LIKE :searchName
                            GROUP BY title
                            HAVING count(title)>0
                            ORDER BY COUNT(`title`) DESC");
    // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
    $stmt -> bindValue(':searchName','%'.$searchName.'%',PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$result){
        exit('該当の記事がありません');
    }
    return $result;
}




// ------------------------------ここまで------------------------------------------------------------





// -------------------------------(セキュリティ)----------------------------------------------------
    // セキュリティの為だけのコード。security.phpに繋がってる
    function securityName($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT title
                                FROM blog
                                WHERE curriculum = :title");
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // セキュリティの為だけのコード。security.phpに繋がってる
    function securityTitle($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT title
                                FROM blog
                                WHERE subject = :title");
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

// ------------------------------ここまで------------------------------------------------------------




// ------------------------------後に使う可能性のある関数けど今は使っていない---------------------------
    // clickされた【name】の場合(top->list)
    // function getNameDb($curriculum){
    //     if(empty($curriculum)){
    //         exit('該当ページが見つかりません');
    //     }
    //     $dbh = $this->dbConnect();
    //     $stmt = $dbh ->prepare("SELECT title from blog where curriculum = :curriculum");
    //     $stmt -> bindValue(':curriculum',$curriculum,PDO::PARAM_STR);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     if(!$result){
    //         exit('該当のデータがありません');
    //     }
    //     return $result;
    // }
    // // play/index.phpで任意の値を受け取る関数。今の所使わない。10/18時点
    // function getById($id){
    //     if(empty($id)){
    //         exit('idが不正です');
    //     }

    //     $dbh = $this->dbConnect();
    //     $stmt = $dbh ->prepare("SELECT * from blog where id = :id");
    //     $stmt -> bindValue(':id',(int)$id,PDO::PARAM_INT);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if(!$result){
    //         exit('該当の記事がありません');
    //     }
    //     return $result;
    // }

    // // clickされた【name】のID取得していないtitleのみの場合(top->list)
    //     function getNameOnly($curriculum){
    //         if(empty($curriculum)){
    //             exit('教科名が不正です');
    //         }
    //         $dbh = $this->dbConnect();
    //         $stmt = $dbh ->prepare("SELECT DISTINCT title from blog where curriculum = :curriculum");
    //         $stmt -> bindValue(':curriculum',$curriculum,PDO::PARAM_STR);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         if(!$result){
    //             exit('該当のデータがありません');
    //         }
    //         return $result;
    //     }

    // // clickされた【title】のID取得していないtitleのみの場合(top->list)
    //     function getTitleOnly($title){
    //         if(empty($title)){
    //             exit('教科名が不正です');
    //         }
    //         $dbh = $this->dbConnect();
    //         $stmt = $dbh ->prepare("SELECT DISTINCT title from blog where subject = :title");
    //         $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         if(!$result){
    //             exit('該当の記事がありません');
    //         }
    //         return $result;
    //     }

        // 【$_GET['name']】の場合。受けとった&_GETでグループされたtitleを2個以上あるデータのみをカウントして降順でソートしてる
        function getNameSortDb($title){
            $dbh = $this->dbConnect();
            $stmt = $dbh ->prepare("SELECT title,count(`title`),sum( time_to_sec(length)) as total_sec,sec_to_time(sum( time_to_sec(length))) as total_time
                                    FROM blog
                                    WHERE curriculum = :title
                                    GROUP BY title
                                    HAVING count(title)>1
                                    ORDER BY COUNT(`title`)
                                    DESC");
            $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

            // 【$_GET['title']】の場合。受けとった&_GETでグループされたtitleを2個以上あるデータのみをカウントして降順でソート
    function getTitleSortDb($title){
        $dbh = $this->dbConnect();
        $stmt = $dbh ->prepare("SELECT title,count(`title`),sum( time_to_sec(length)) as total_sec,sec_to_time(sum( time_to_sec(length))) as total_time
                                FROM blog
                                WHERE subject = :title
                                GROUP BY title
                                HAVING count(title)>1
                                ORDER BY count(`title`)
                                DESC");
        $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
        // category別に➀2個以上のタイトル名➁2個以上のタイトル数➂2個以上の合計再生時間
        function getCategoryGroupMultiple($title){
            $dbh = $this->dbConnect();
            $stmt = $dbh ->prepare("SELECT category_number,title,count('title'),sum( time_to_sec(length)) as total_sec, sec_to_time(sum( time_to_sec(length))) as total_time
                                    FROM blog
                                    WHERE subject = :title
                                    GROUP BY category_number,title
                                    HAVING COUNT(title)>1");
            // bindValue('プレースホルダ名', '実際にバインドするデータ', 'データの型');
            $stmt -> bindValue(':title',$title,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
// SQLで取得したデータを加工、ソートして実現しようとしたがSQLで実行した方が簡単でコードも少なく済んだので不要になった変数リスト

// DBから取得したtitleカラムをarray_columnで連想配列からtitleのみの連想配列に変換している
    // $array = array_column($single, "title");
// array_count_valuesで重複している値の数を取得、$vは！があるか無いかで重複のデータか重複していないデータ化を決めているarray_filterで重複しているデータのみに加工
    // $kiwi = array_filter(array_count_values($array), function($v){return --$v;});
// 重複している値を削除
    // $hello = array_unique($array);
// 値をキーに変換
    // $green = array_keys($kiwi);
// $helloと$greenの配列の差を返り値する（重複している値と重複していない値の差）
    // $red = array_diff($hello,$green);
// 配列同士を結合。一つ目の引数がキーになる
// 個別に$green,$kiwiをarsortで降順にソート
    // $grape = arsort($green);
    // $coconut = arsort($kiwi);

// ------------------------------ここまで----------------------------------------------------------


}

function h($s){
    return htmlspecialchars($s,ENT_QUOTES,"utf-8");
}