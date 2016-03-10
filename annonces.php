<?php
require 'pdo.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['start']) && isset($_GET['end'])){
            $start = intval($_GET['start']);
            $end = intval($_GET['end']);
            $nb = $end - $start;
        }else{
            header('HTTP/1.1 400');
            break;
        }

        $stmt = $pdo->prepare ('SELECT marque, modele, avatar, prix, etat, telephone, commentaire, id_annonce, date_annonce, id_membre FROM annonces ORDER BY id_annonce ASC LIMIT :start, :nb');
        $stmt->bindValue(':start', $start-1, PDO::PARAM_INT);
        $stmt->bindValue(':nb', $nb , PDO::PARAM_INT);
        $stmt->execute();
        $annonces = $stmt->fetchAll();
        $stmt->closeCursor();
        // cast
        foreach($annonces as $annonce){
            $annonce->id_annonce = intval($annonce->id_annonce);
            $annonce->prix = intval($annonce->prix);
            $annonce->telephone = intval($annonce->telephone);
            $annonce->id_membre = intval($annonce->id_membre);
        }
        header('HTTP/1.1 200');
        echo json_encode(array('annonce' => $annonces));

        break;

    case 'POST' :
        if(isset($_GET['id_annonce']) && isset($_GET['marque']) && isset($_GET['modele']) && isset($_GET['avatar']) && isset($_GET['prix']) && isset($_GET['etat']) && isset($_GET['telephone']) && isset($_GET['commentaire']) && isset($_GET['date_annonce']) && isset($_GET['id_membre']))
        {
            $id_annonce = intval($_GET['id_annonce']);
            $prix = intval($_GET['prix']);
            $tel = intval($_GET['telephone']);
            $id_membre = intval($_GET['id_membre']);
        }else{
            header('HTTP/1.1 400');
            echo json_encode(array('status' => 'error', 'message' => 'manque d\'éléments'));
            break;
        }
        $stmt = $pdo->prepare ('INSERT INTO annonces (marque, modele, avatar, prix, etat, telephone, commentaire, id_annonce, date_annonce, id_membre) VALUES :marque, :modele, :avatar, :prix, :etat, :telephone, :commentaire, :id_annonce, :date_annonce, :id_membre');
        $stmt->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $stmt->bindValue(':marque', $_GET['marque'], PDO::PARAM_STR);
        $stmt->bindValue(':modele', $_GET['modele'], PDO::PARAM_STR);
        $stmt->bindValue(':avatar', $_GET['avatar'], PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix, PDO::PARAM_INT);
        $stmt->bindValue(':etat', $_GET['etat'], PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $tel, PDO::PARAM_INT);
        $stmt->bindValue(':commentaire', $_GET['commentaire'], PDO::PARAM_STR);
        $stmt->bindValue(':date_annonce', $_GET['date_annonce'], PDO::PARAM_STR);
        $stmt->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);
        $stmt->execute();

        if ($nb == true)
        {
            header('HTTP/1.1 200');
            echo json_encode(array('status' => 'OK', 'request' => 'success'));
        }else {
            header('HTTP/1.1 404');
            echo json_encode(array('status' => 'error', 'request' => 'failed'));
        }
        $stmt->closeCursor();

        break;
}
