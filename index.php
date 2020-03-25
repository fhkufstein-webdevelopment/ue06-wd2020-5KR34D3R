<?php

    require_once ('includes/classes/Database.php');
    define('DB_HOST','localhost');
    define('DB_NAME','testdatabase');
    define('DB_USER','testuser');
    define('DB_PASS','testpass');

    $db=new Database();


    // password_hash(); zum password_hashing
    // password wird gehasht mit algorythmus BCCRYPT // für den benutzer
    $cryptedPassword = password_hash('testpassword',PASSWORD_BCRYPT);
    // benutzername den wir estellen wollen
    $username = "test";

    // Datenbankverbingung aufbauen

    //dass keine sql injection stattfindet / wird methode escapestring der Datebank kalsse verwendet
    // dass im string nicht mehr geährliches enthalten ist
    $cryptedPassword = $db->escapeString($cryptedPassword);
    $username = $db->escapeString($username);

    //zusammenführen von string "Hallo"."Welt"; ist mit einem Punkt
    // escapen von zeichen ` // genutzt für reservierte Schlüsselwörter

    // einfügen in die Datenbank
    $sql = "INSERT INTO user(name,`password`) VALUES ('$username','$cryptedPassword')";
    // delte und uptae funktionierte wie das insert
    //$db->query($sql); // fürt den sql-befehl aus

    // ist um eine Abfrage zu machen, ob der Benutzername vorhanden ist
    $sql = "SELECT * FROM user WHERE name = '$username'";
    $result = $db->query($sql);

    if($db->numRows($result) > 0){ // anzahl zeilen mehr als 0
        //mehrer zeilen herausholen mit while
        // while($row = $db->fetchAssoc($result));
        $row = $db->fetchAssoc($result); // greift auf die spalte zu // aossosiat
        //$row ['spaltenname'];
        //fetchObect // greift auf spalten so zu
        //$row->spaltenname;
        // java js zugriff objektorientiert mittels .(punkt) zu
        //zb. row.spantenname = php ist es anders

        if(password_verify("testpassword",$row['password'])){
            echo "Der Nutzer ".$username." mit der ID ".$row['id']." hat";
            echo " das Passwort testpassword";
        }else{
            echo "Nutzer gefunde aber falsches Passwort!";
        }
    }else{
        echo "Keinen Nutzer gefunden";
    }


    



//@TODO insert your code here

?>