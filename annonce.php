<?php
require 'pdo.php';




switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
    	
	// Parameter id required
	if(isset($_GET['id_annonce'])){
	    $id = intval($_GET['id_annonce']);
	}else{
	    header('HTTP/1.1 400');
	    echo json_encode(array('status' => 'error', "header" => "400", 'message' => 'Bad request'));
	    return;
	}
	
	// Test if ressource exists
	$stmt = $pdo->prepare('SELECT * FROM annonces WHERE id_annonce = :id_annonce');
	$stmt->bindValue(':id_annonce', $id, PDO::PARAM_INT);
	$stmt->execute();
	$annonce = $stmt->fetch();
	$stmt->closeCursor();
	
	if(empty($annonce->id_annonce)){
	    header('HTTP/1.1 204');
	    echo json_encode(array('status' => 'error', "header" => "204", 'message' => 'ID inexistante en base'));
	    return;
	}
        // cast
        $annonce->id_annonce = intval($annonce->id_annonce);
        header('HTTP/1.1 200');
        echo json_encode(array('annonce' => $annonce, "header" => "200"));
        break;

	case 'PUT':

        if(isset($_GET['id_annonce']) and isset($_GET['marque']) && isset($_GET['modele']) && isset($_GET['prix'])){

            $stmt = $pdo->prepare('UPDATE annonces SET marque = :marque, modele = :modele, prix = :prix WHERE id_annonce = :id_annonce');

            $stmt->bindValue(':id_annonce', $id, PDO::PARAM_INT);
            $stmt->bindValue(':marque', $_GET['marque'], PDO::PARAM_STR);
            $stmt->bindValue(':modele', $_GET['modele'], PDO::PARAM_STR);
            $stmt->bindValue(':prix', $_GET['prix'], PDO::PARAM_INT);
      
        }

        $nb = $stmt->execute();
		
		if ( $nb == 1 )
		{
			header('HTTP/1.1 200 OK');
			echo json_encode(array('status' => 'OK', "header" => "200", 'request' => 'success'));

		}else {

			header('HTTP/1.1 404');
			echo json_encode(array('status' => 'error', "header" => "404", 'request' => 'failed'));

		}
            
            $stmt->closeCursor();
        
        break;


    case 'DELETE':
	
        $nb = $pdo->prepare('DELETE FROM annonces WHERE id_annonce = :id_annonce');
        $nb->bindValue(':id_annonce', $id, PDO::PARAM_INT);
        $nb->execute();
        $nb->closeCursor();
		
        if($nb->execute() == true){
			
          header('HTTP/1.1 200');
		  
          echo json_encode(array('status' => 'OK', "header" => "200", 'message' => 'Annonce supprimé'));
		  
        }
        else{
                header('HTTP/1.1 404');
                echo json_encode(array('status' => 'error', "header" => "404", 'request' => 'failed'));
        }
        break;
}
