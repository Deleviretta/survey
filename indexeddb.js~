/**
 * Created by deleviretta on 27.05.16.
 */

var idbSupported = false;
var db;

function load() {
    if ("indexedDB" in window) {
        idbSupported = true;
    }
    else {
        concole.log("IndexedDB nieobsługiwana");
    }

    if (idbSupported) {
        var openRequest = window.indexedDB.open("baza", 3);
        openRequest.onupgradeneeded = function (e) {
            console.log("running onupgradeneeded");
            var thisDB = e.target.result;

            if (!thisDB.objectStoreNames.contains("ankiety")) {
                var baza = thisDB.createObjectStore("ankiety", {autoIncrement:true});
                baza.createIndex("płeć", "plec", {unique:false});
                baza.createIndex("wiek", "wiek", {unique:false});
                baza.createIndex("godziny", "godziny", {unique:false});
                baza.createIndex("użycie", "uzycie", {unique:false});
                baza.createIndex("date", "date", {unique:false});
            }

        }

        openRequest.onsuccess = function (e) {
            console.log("Success!");
            db = e.target.result;
            document.querySelector("#wyslij").addEventListener("click", send, false);
        }

        openRequest.onerror = function (e) {
            console.log("Error");
            console.dir(e);
        }
    }
}

function send(e) {
    var transaction = db.transaction(["ankiety"], "readwrite");
    var store = transaction.objectStore("ankiety");
    var plec = $('input[name="gender"]:checked').val();
    var wiek = $('input[id="wiek"]').val();
    var godziny = $('input[id="godziny"]').val();

    var inputElements = document.getElementsByClassName('check');
    var ilosc = 0;
    for(var i=0; inputElements[i]; ++i){
        if(inputElements[i].checked){
            ilosc+=1;
        }
    }
    var checkedValue = new Array(ilosc);
    var iterator = 0;
    for(var i=0; inputElements[i]; i++){
        if(inputElements[i].checked){
            checkedValue[iterator] = inputElements[i].value;
            iterator+=1;
        }
    }

    console.log(checkedValue);

    var ankieta = {
        płeć: plec,
        wiek: wiek,
        godziny: godziny,
        użycie: checkedValue,
        date: new Date()
    };

    var request = store.add(ankieta);

    request.onerror = function (e) {
        console.log("Error", e.target.error.name);
        //some type of error handler
    };

    request.onsuccess = function (e) {
        console.log("Rekord dodany do bazy poprawnie");
	alert("Rekord dodany poprawnie");
    }
}


function read() {
    var s = "";

    db.transaction(["ankiety"], "readonly").objectStore("ankiety").openCursor().onsuccess = function(e) {
        var cursor = e.target.result;
        if(cursor) {
            s += "<h2>Numer ankiety "+cursor.key+"</h2><p>";
            for(var field in cursor.value) {
                s+= field+"="+cursor.value[field]+"<br/>";
            }
            s+="</p>";
            cursor.continue();
        }
        document.getElementById('input').innerHTML = s;
    }

}
