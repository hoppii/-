
    //結果を非表示にする
    function hide(){
        var results = document.getElementsByClassName('result');
        for(var i = 0; i < results.length; i++) {
        results[i].style.display = "none";
        }
    }

    
    
    
    hide();



    //ボタンがクリックされた時
    document.getElementById("button").onclick = function() {
    
    //問題数を取得
    var qNum = document.getElementsByTagName("li").length;
     
    if( $("ul li input:checked").length < qNum ){
    //全てチェックしていなかったらアラートを出す
    alert("未回答の問題があります");
    } else {
    $("#osusume").fadeIn();

    var typeA = document.getElementById("typeA");
    if (typeA.checked) {
        $(".resultA").fadeIn();
    } else {
        ;
    }

    var typeB = document.getElementById("typeB");
    if (typeB.checked) {
        $(".resultB").fadeIn();
    } else {
        ;
    }

    var typeC = document.getElementById("typeC");
    if (typeC.checked) {
        $(".resultC").fadeIn();
    } else {
        ;
    }

    var typeD = document.getElementById("typeD");
    if (typeD.checked) {
        $(".resultD").fadeIn();
    } else {
        ;
    }

    var typeE = document.getElementById("typeE");
    if (typeE.checked) {
        $(".resultE").fadeIn();
    } else {
        ;
    }

    var typeF = document.getElementById("typeF");
    if (typeF.checked) {
        $(".resultF").fadeIn();
    } else {
        ;
    }

    var typeG = document.getElementById("typeG");
    if (typeG.checked) {
        $(".resultG").fadeIn();
    } else {
        ;
    }

    var typeH = document.getElementById("typeH");
    if (typeH.checked) {
        $(".resultH").fadeIn();
    } else {
        ;
    }

    var typeI = document.getElementById("typeI");
    if (typeI.checked) {
        $(".resultI").fadeIn();
    } else {
        ;
    }

    var typeJ = document.getElementById("typeJ");
    if (typeJ.checked) {
        $(".resultJ").fadeIn();
    } else {
        ;
    }

    var typeK = document.getElementById("typeK");
    if (typeK.checked) {
        $(".resultK").fadeIn();
    } else {
        ;
    }

    var typeL = document.getElementById("typeL");
    if (typeL.checked) {
        $(".resultL").fadeIn();
    } else {
        ;
    }

    var typeM = document.getElementById("typeM");
    if (typeM.checked) {
        $(".resultM").fadeIn();
    } else {
        ;
    }

    } 


    };