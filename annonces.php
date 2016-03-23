<?php
require 'pdo.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
    case 'GET':

        if(isset($_GET['start']) && isset($_GET['end'])){
            $start = intval($_GET['start']);
            $end = intval($_GET['end']);
            $nb = $end - $start;
        }else{
			
			//Parametre par default si nous n'avons pas d'intervalle donné par l'utilisateur
			$start = 1 ;
			$end = 100 ;
			$nb=99;

            break;
        }

        $stmt = $pdo->prepare ('SELECT marque, modele, avatar, prix, etat, telephone, commentaire, id_annonce, date_annonce, id_membre FROM annonces ORDER BY id_annonce ASC LIMIT :start, :nb');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':nb', $nb , PDO::PARAM_INT);
        $stmt->execute();
        $annonces = $stmt->fetchAll();
        $stmt->closeCursor();
        
		if( !empty( $annonces ) ){
		
			header( 'HTTP/1.1 200 OK' );
			
			echo json_encode( array(
				"header" => "200",
				"annonce" => $annonces
			));
			
		}else{
			
			header( 'HTTP/1.1 400 Erreur' );
			echo json_encode( array( 
				"Erreur" => "Il n'y a pas d'article"
			));
			
		}
 
        break;

 case 'POST' :
    
    
        if( isset($_POST['marque']) && isset($_POST['modele']) && isset($_POST['avatar']) && isset($_POST['prix']) && isset($_POST['etat']) && isset($_POST['tel']) && isset($_POST['com']) && isset($_POST['id_membre']))
        {

            $stmt = $pdo->prepare ( 'INSERT INTO annonces ( id_annonce, avatar, marque, modele, prix, etat, telephone, commentaire, id_membre ) VALUES (NULL, :avatar, :marque, :modele, :prix , :etat, :tel, :com, :id_membre )' ) ;

            $stmt->bindValue(':marque', $_POST['marque'], PDO::PARAM_STR);
            $stmt->bindValue(':modele', $_POST['modele'], PDO::PARAM_STR);
            $stmt->bindValue(':avatar', $_POST['avatar'], PDO::PARAM_STR);
            $stmt->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
            $stmt->bindValue(':etat', $_POST['etat'], PDO::PARAM_STR);
            $stmt->bindValue(':tel', $_POST['tel'], PDO::PARAM_INT);
            $stmt->bindValue(':com', $_POST['com'], PDO::PARAM_STR);
            $stmt->bindValue(':id_membre', $_POST['id_membre'], PDO::PARAM_INT);
            
            $nb = $stmt->execute();


            if ( $nb == 1 )
            {
                header('HTTP/1.1 200 OK');
                echo json_encode(array('status' => 'OK', 'request' => 'success'));

            }else {

                header('HTTP/1.1 404');
                echo json_encode(array('status' => 'error', 'request' => 'failed'));

            }
            
            $stmt->closeCursor();

            break;

        }else{

            header('HTTP/1.1 400');
            echo json_encode(array('status' => 'error', 'message' => 'manque d\'éléments'));

            break;

        }
     
}