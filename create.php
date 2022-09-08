<?php 
try{
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($pdo->exec('DROP DATABASE IF EXISTS dbSalle_sport')!== false){
        if ($pdo->exec('CREATE DATABASE dbSalle_sport') !== false){
            $dbSalle_sport = new PDO('mysql:dbname=dbSalle_sport;host=localhost', 'root', '');
            if($dbSalle_sport->exec('CREATE TABLE Api_client(
                client_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                client_secret VARCHAR(250) NOT NULL,
                client_name VARCHAR(250) NOT NULL,
                client_email VARCHAR(250) NOT NULL,
                client_address VARCHAR(250) NOT NULL,
                active BOOLEAN NOT NULL,
                short_description TEXT NOT NULL,
                full_description TEXT NOT NULL,
                logo_url VARCHAR(250) NOT NULL,
                client_url VARCHAR(250) NOT NULL,
                dpo VARCHAR(250) NOT NULL,
                technical_contact VARCHAR(250) NOT NULL,
                commercial_contact VARCHAR(250) NOT NULL
            )')!==false){
                if($dbSalle_sport->exec('CREATE TABLE Api_salle(
                    salle_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    client_id INT(11) NOT NULL,
                    salle_name VARCHAR(250) NOT NULL,
                    salle_address VARCHAR(250) NOT NULL,
                    FOREIGN KEY (client_id) REFERENCES Api_client(client_id)
                )') !==false){
                    if($dbSalle_sport->exec('CREATE TABLE Api_zone(
                        zone_id INT(11) PRIMARY KEY AUTO_INCREMENT,
                        salle_id INT(11),
                        zone_name VARCHAR(250),
                        FOREIGN  KEY (salle_id) REFERENCES Api_salle(salle_id)
                    )') !==false){
                        if($dbSalle_sport->exec('CREATE TABLE Api_branch(
                            branch_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            salle_id INT(11),
                            branch_name VARCHAR(250) NOT NULL,
                            FOREIGN KEY (salle_id) REFERENCES Api_salle(salle_id)
                        )') !==false){
                            if($dbSalle_sport->exec('CREATE TABLE Api_install_perms(
                                perms_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                salle_id INT(11) NOT NULL,
                                members_read BOOLEAN NOT NULL,
                                members_write BOOLEAN NOT NULL,
                                members_add BOOLEAN NOT NULL,
                                members_products_add BOOLEAN NOT NULL,
                                members_payment_schedules_read BOOLEAN NOT NULL,
                                members_statistiques_read BOOLEAN NOT NULL,
                                members_subscription_read BOOLEAN NOT NULL,
                                payment_schedules_read BOOLEAN NOT NULL,
                                payment_schedules_write BOOLEAN NOT NULL,
                                payment_day_read BOOLEAN NOT NULL,
                                FOREIGN KEY (salle_id) REFERENCES Api_salle(salle_id)
                            )') !==false){
                                if($dbSalle_sport->exec('CREATE TABLE Api_grants(
                                grants_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                perms_id INT(11) NOT NULL,
                                client_id INT(11) NOT NULL,
                                salle_id INT(11) NOT NULL,
                                perms TEXT,
                                active BOOLEAN NOT NULL,
                                FOREIGN KEY (perms_id) REFERENCES Api_install_perms(perms_id),
                                FOREIGN KEY (client_id) REFERENCES Api_client(client_id)
                                )') !==false){
                                    if($dbSalle_sport->exec('CREATE TABLE Api_salleClient(
                                        client_id INT(11) NOT NULL,
                                        client_name VARCHAR(250) NOT NULL,
                                        salle_name VARCHAR(250) NOT NULL,
                                        FOREIGN KEY (client_id) REFERENCES API_client(client_id)
                                    )') !==false){
                                        echo 'Installation réussie !';
                                    }else{
                                        echo 'Impossible de créer Table Api_salleClient<br>';
                                    }  
                                }else {
                                    echo 'Impossible de créer Table Api_grants<br>';
                                }
                            }else{
                                echo 'Impossible de créer Table Api_install_perms<br>';
                            }
                        } else {
                            echo 'Impossible de créer Table Api_branch<br>';
                        }
                    }else {
                        echo 'Impossible de créer Table Api_zone<br>';
                    }
                }else{
                    echo 'Impossible de créer Table Api_salle<br>';
                }
            }else {
                echo 'Impossible de créer Table Api_client<br>';
            }
        }
    }
}catch (PDOException $exception){
    die($exception->getMessage());
};

