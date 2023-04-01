<?php

    if(isset($_GET['name']) == true & empty($_GET['name'])){
            exit('該当ページが見つかりません');
        };
        if(isset($_GET['title']) == true & empty($_GET['title'])){
            exit('該当ページが見つかりません');
        };

    if(isset($_GET['name']) == true){
        $nameDbSecurity = $curriculum->securityName($_GET['name']);
        if(!$nameDbSecurity){
            exit('該当の記事がありません');
    }}
    if(isset($_GET['title']) == true){
        $titleDbSecurity = $curriculum->securityTitle($_GET['title']);
        if(!$titleDbSecurity){
            exit('該当の記事がありません');
    }}
?>