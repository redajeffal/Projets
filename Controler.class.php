<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			switch ($_GET['requete']) {
				case 'listeBouteille':
					$this->listeBouteille();
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':
					$this->boireBouteilleCellier();
					break;
				case 'pageModifierBouteilleCellier':
					$this->pageModifierBouteilleCellier();
					break;
				case 'modifierBouteilleCellier':
					$this->modifierBouteilleCellier();
					break;	
				default:
					$this->accueil();
					break;
			}
		}
		//Récupérer les informations de la bouteille nécessaires
		private function pageModifierBouteilleCellier(){
			$bte = new Bouteille();
			$data = $bte->getBouteilleParID($_GET["idBouteille"]);
			include("vues/entete.php");
			include("vues/modifieroeuvre.php");
			include("vues/pied.php");
		}
		//Après avoir récuperer les info il faudra les envoyer pour les ajout dans la BD
		private function modifierBouteilleCellier(){
			$body = json_decode(file_get_contents('php://input'));
			if(!empty($body)){
				$bte = new Bouteille();
				$data = json_decode($_REQUEST['data']);
				$resultat = $bte->modifierLaBouteilleAuCellier($body);
			}
			else{
				include("vues/entete.php");
				include("vues/modifieroeuvre.php");
				include("vues/pied.php");
			}
			
		}
		private function accueil()
		{
			$bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier("engjell");
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}
		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();
            
            echo json_encode($cellier);
                  
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}
		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				//var_dump($_POST['data']);
				
				//var_dump($data);
				$resultat = $bte->ajouterBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
			
            
		}
		
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}
		
}
?>















