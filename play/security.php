<?php

    if(isset($_GET['title']) == true & empty($_GET['title'])){
        exit('該当ページが見つかりません');
    }
    if(isset($_GET['mixName']) == true & empty($_GET['mixName'])){
            exit('該当ページが見つかりません');
    }
    if(isset($_GET['orderName']) == true & empty($_GET['orderName'])){
        exit('該当ページが見つかりません');
    }
    if(isset($_GET['category']) == true & empty($_GET['category'])){
        exit('該当ページが見つかりません');
    }



    // if(isset($_GET['name']) == true){
    //     $nameDbSecurity = $curriculum->securityName($_GET['name']);
    //     if(!$nameDbSecurity){
    //         exit('該当の記事がありません');
    // }}
    // if(isset($_GET['title']) == true){
    //     $titleDbSecurity = $curriculum->securityTitle($_GET['title']);
    //     if(!$titleDbSecurity){
    //         exit('該当の記事がありません');
    // }}
?>