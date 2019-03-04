<?php
if(isset($_SESSION["UserID"]))
{
    if($data){
?>
<?php
    $bool=false;
foreach ($data as $cle => $bouteille) {
    if($bool==false){
?>
      
<?php
        $bool=true;
    }
?>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <main class="mdl-layout__content">
        <div class="mdl-grid">
            <div class="mdl-card mdl-cell mdl-cell--6-col-phone mdl-cell--6-col-tablet mdl-cell--10-col-desktop mdl-shadow--2dp">
                <figure class="mdl-card__media">
                <?php
                    if($bouteille['image_bouteille_cellier'] != "" && $bouteille['image_bouteille_cellier'] != "imageNONdeposer" ){
                           /**Condition qui regarde si le lien de l'image reçu provient de la SAQ ou seulement de l'usager */
                        if (strpos($bouteille['image_bouteille_cellier'], '//s7d9') === 0) {
                ?>
                           <img id="imgBouteille" src="<?php echo $bouteille['image_bouteille_cellier'] ?>" height="100" width="100">
                <?php
                        }else{
                            ?>
                      <img id="imgBouteille" src="/vino/<?php echo $bouteille['image_bouteille_cellier'] ?>" height="100" width="100">
                            <?php 
                        }
                    }else{
                ?>
                    <a href='index.php?requete=pageAjoutPhotoBouteille&id_bouteille_cellier=<?php echo $bouteille['id_bouteille_cellier'];?>&id_Cellier=<?php echo $bouteille['id_cellier'];?>' class="mdl-button"><i class="material-icons">add_a_photo</i></a>      
                <?php
                    }
                 ?>
                </figure>
                <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text"><?php echo $bouteille['nom_bouteille_cellier'] ?></h1>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul>
                    <li class="quantite" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>" >Quantité : <?php echo $bouteille['quantite'] ?></li>
                        <li>Code SAQ : <?php echo $bouteille['code_saq_cellier'] ?></li>
                        <li>Pays : <?php echo $bouteille['pays_cellier'] ?></li>
                        <li>Prix à l'achat : <?php echo $bouteille['prix_a_lachat'] ?></li>
                        <li>Format : <?php echo $bouteille['format_bouteille_cellier'] ?></li>
                        <li>Date d'achat : <?php echo $bouteille['date_achat'] ?></li>
                        <li>Expiration : <?php echo $bouteille['expiration'] ?></li>
                        <li>Millesime : <?php echo $bouteille['millesime'] ?></li>
                        <li>  <div class="ConteneurCommentaire" >
                <div>            
            <?php 
                if($bouteille['commentaire'])
                {
                   echo "<p>";
                   echo "Votre  commentaire : ".$bouteille['commentaire'];
                   echo "</p>"; 
                }
                else{
                     echo "<p>vous n'avez pas de commentaire!!</p>";
                }
            ?>
                </div>
                Votre nouveau commentaire : <input type="text" classe="textecommentaire" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
            <button class='envoyerComm'data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">envoyer</button>
                <input type="hidden" name="valeurIdCellier" data-id="<?php echo $bouteille['id_cellier'] ?>">
            </div></li>
                    </ul>
                </div>
                 <div class="mdl-card__actions mdl-card--border" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>" >
                   
                    <a class="bouton btnAjouter mdl-js-button mdl-button--fab mdl-button--mini-fab" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>"><i class="material-icons">add</i></a>
                    <a class="btnBoire mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>"><i class="material-icons">remove</i></a>
                     
                     
                      <a id="btnEdit" class="mdl-button mdl-button--colored" href='index.php?requete=pageModifierBouteilleCellier&idBouteille=<?php echo $bouteille['id_bouteille_cellier'] ?>' ><i class="material-icons">
edit
</i></a>
                    <a class="bouton supprimerBouteille mdl-button" type='button'  data-id-bouteille="<?php echo $bouteille['id_bouteille_cellier'] ?>" data-id-cellier="<?php echo $bouteille['id_cellier'] ?>"  ><i class="material-icons" data-id-bouteille="<?php echo $bouteille['id_bouteille_cellier'] ?>" data-id-cellier="<?php echo $bouteille['id_cellier'] ?>">delete</i></a>
                </div>
            </div>
        </div>    
<?php

        }
    }
    else{
        echo $_GET["id_cellier"]."<br>";
        echo "<a href='index.php?requete=ajouterNouvelleBouteilleCellier&id_cellier=".$_GET["id_cellier"]."'>Ajouter une bouteille au cellier</a>";
        echo "<h1>vous n avez aucune bouteille dans votre cellier</h1>";
    }
}
?>	
        
       
