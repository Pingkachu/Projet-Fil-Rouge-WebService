<?php
require 'pdo.php';
require 'emulatePut.php';

// Parameter id required
if(isset($_GET['id_annonce'])){
    $id = intval($_GET['id_annonce']);
}else{
    header('HTTP/1.1 400');
    echo json_encode(array('status' => 'error', 'message' => 'Bad request'));
    return;
}

// Test if ressource exists
$stmt = $pdo->prepare('SELECT id_annonce FROM annonces  WHERE id_annonce = :id_annonce');
$stmt->bindValue(':id_annonce', $id, PDO::PARAM_INT);
$stmt->execute();
$annonce = $stmt->fetch();
$stmt->closeCursor();
if(empty($annonce->id_annonce)){
    header('HTTP/1.1 204');
    echo json_encode(array('status' => 'error', 'message' => 'ID inexistante en base'));
    return;
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // cast
        $annonce->id_annonce = intval($annonce->id_annonce);
        header('HTTP/1.1 200');
        echo json_encode(array('annonce' => $annonce));
        break;

    case 'PUT':
        if(isset($_PUT['id_annonce']) and isset($_PUT['id_membre'])){
            $stmt = $pdo->prepare('UPDATE annonces SET marque = :marque, modele = :modele, avatar = :avatar, prix = :prix, etat = :etat, telephone = :telephone, commentaire = :commentaire, id_annonce = :id_annonce, date_annonce = :date_annonce, id_membre = :id_membre WHERE id_annonce = :id');
            $stmt->bindValue(':id_annonce', $id, PDO::PARAM_INT);
            $stmt->bindValue(':marque', $_PUT['marque'], PDO::PARAM_STR);
            $stmt->bindValue(':modele', $_PUT['modele'], PDO::PARAM_STR);
            $stmt->bindValue(':avatar', $_PUT['avatar'], PDO::PARAM_STR);
            $stmt->bindValue(':prix', $_PUT['prix'], PDO::PARAM_INT);
            $stmt->bindValue(':etat', $_PUT['etat'], PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $_PUT['telephone'], PDO::PARAM_INT);
            $stmt->bindValue(':commentaire', $_PUT['commentaire'], PDO::PARAM_STR);
            $stmt->bindValue(':date_annonce', $_PUT['date_anno  nce'], PDO::PARAM_sTR);
            $stmt->bindValue(':id_membre', $_PUT['id_membre'], PDO::PARAM_INT);
        }
        $stmt->execute();
        break;

    case 'DELETE':
        $nb = $pdo->prepare('DELETE FROM annonces WHERE id_annonce = :id_annonce');
        $nb->bindValue(':id_annonce', $id, PDO::PARAM_INT);
        $nb->execute();
        $nb->closeCursor();
        if($nb->execute() == true){
          header('HTTP/1.1 200');
          echo json_encode(array('status' => 'OK', 'message' => 'Annonce supprimé'));
        }
        else{
                header('HTTP/1.1 404');
                echo json_encode(array('status' => 'error', 'request' => 'failed'));
            }
        break;
}
