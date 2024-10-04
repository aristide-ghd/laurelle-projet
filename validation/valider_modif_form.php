<?php

// fichier: valider_modif_form.php
include("../connexion.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (optionnel) pour les fonctionnalités JavaScript) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?
// fichier: Produit.php
class Produit {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $nom, $description, $prix, $cout) {
        // Vérifications des valeurs
        if (empty($nom) || empty($description) || !isset($prix) || !isset($cout)) {
            throw new InvalidArgumentException('Nom, Description, Prix et Coût ne peuvent pas être vides.');
        }

        // Validation de la longueur du nom
        if (strlen($nom) < 1 || strlen($nom) > 100) {
            throw new InvalidArgumentException('Le nom du produit doit contenir entre 1 et 100 caractères.');
        }

        // Validation de la description
        if (strlen($description) < 1 || strlen($description) > 255) {
            throw new InvalidArgumentException('La description du produit doit contenir entre 1 et 255 caractères.');
        }

        // Validation des prix et coûts
        if (!is_numeric($prix) || $prix < 0) {
            throw new InvalidArgumentException('Le prix de vente doit être un nombre positif.');
        }

        if (!is_numeric($cout) || $cout < 0) {
            throw new InvalidArgumentException('Le coût unitaire doit être un nombre positif.');
        }

        $req = "UPDATE produits SET NomProduit = :nom, DescriptionProduit = :description, PrixVente = :prix, CoutUnitaire = :cout WHERE idProduit = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':nom' => $nom,
                ':description' => $description,
                ':prix' => $prix,
                ':cout' => $cout
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }

        return $stmt->rowCount() > 0;
    }
}


// fichier: Fournisseur.php
class Fournisseur {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $nom, $adresse, $coordonnees) {
        // Vérifications des valeurs
        if (empty($nom) || empty($adresse) || empty($coordonnees)) {
            throw new InvalidArgumentException('Nom, Adresse et Coordonnées ne peuvent pas être vides.');
        }

        // Validation de la longueur du nom (par exemple, entre 1 et 100 caractères)
        if (strlen($nom) < 1 || strlen($nom) > 100) {
            throw new InvalidArgumentException('Le nom du fournisseur doit contenir entre 1 et 100 caractères.');
        }

        // Validation de l'adresse (peut-être appliquer une limite de longueur)
        if (strlen($adresse) < 1 || strlen($adresse) > 255) {
            throw new InvalidArgumentException('L\'adresse du fournisseur doit contenir entre 1 et 255 caractères.');
        }

        // Validation des coordonnées (par exemple, vérifier le format d'un numéro de téléphone ou d'un email)
        // Ici, vous pouvez ajouter une logique de validation personnalisée selon le format attendu.

        $req = "UPDATE fournisseurs SET NomFournisseur = :nom, AdresseFournisseur = :adresse, CoordonneesFournisseur = :coordonnees WHERE idFournisseur = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':nom' => $nom,
                ':adresse' => $adresse,
                ':coordonnees' => $coordonnees
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }

        return $stmt->rowCount() > 0;
    }
}


// fichier: Vente.php
class Vente {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $date, $quantite, $montantTotal, $produit, $modePaiement) {
        // Vérifications des valeurs
        if (empty($date) || empty($quantite) || empty($montantTotal) || empty($produit) || empty($modePaiement)) {
            throw new InvalidArgumentException('Date, Quantité, Montant Total, Produit et Mode de Paiement ne peuvent pas être vides.');
        }

        // Validation de la date
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObj || $dateObj->format('Y-m-d') !== $date) {
            throw new InvalidArgumentException('Format de date invalide, attendu Y-m-d.');
        }

        // Validation de la quantité (doit être un entier positif)
        if (!is_numeric($quantite) || $quantite <= 0) {
            throw new InvalidArgumentException('La quantité doit être un nombre entier positif.');
        }

        // Validation du montant total (doit être un nombre positif)
        if (!is_numeric($montantTotal) || $montantTotal < 0) {
            throw new InvalidArgumentException('Le montant total doit être un nombre positif.');
        }

        $req = "UPDATE ventes SET DateVente = :date, QuantiteVendue = :quantite, MontantTotal = :montantTotal, idProduit = :produit, idModePaiement = :modePaiement WHERE idVente = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':date' => $date,
                ':quantite' => $quantite,
                ':montantTotal' => $montantTotal,
                ':produit' => $produit,
                ':modePaiement' => $modePaiement
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }
        
        return $stmt->rowCount() > 0;
    }
}


// fichier: Recette.php

class Recette {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $montant, $date, $description, $modePaiement) {
        // Vérifications des valeurs
        if (empty($montant) || empty($date) || empty($modePaiement)) {
            throw new InvalidArgumentException('Montant, Date et Mode de Paiement ne peuvent pas être vides.');
        }

        // Validation de la date
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateObj || $dateObj->format('Y-m-d') !== $date) {
            throw new InvalidArgumentException('Format de date invalide, attendu Y-m-d.');
        }

        $req = "UPDATE recettes SET MontantRecette = :montant, DateRecette = :date, DescriptionRecette = :description, idModePaiement = :modePaiement WHERE idRecette = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':montant' => $montant,
                ':date' => $date,
                ':description' => $description,
                ':modePaiement' => $modePaiement
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }
        
        return $stmt->rowCount() > 0;
    }
}


// fichier: Depense.php
class Depense {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $montant, $date, $description, $modePaiement) {
        // Vérification des valeurs
        if (empty($montant) || !is_numeric($montant)) {
            throw new InvalidArgumentException('Le montant doit être un nombre valide.');
        }

        if (empty($date)) {
            throw new InvalidArgumentException('La date ne peut pas être vide.');
        }

        // Validation de la date au format attendu (ex: YYYY-MM-DD)
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
            throw new InvalidArgumentException('La date doit être au format YYYY-MM-DD.');
        }

        if (strlen($description) > 255) {
            throw new InvalidArgumentException('La description ne peut pas dépasser 255 caractères.');
        }

        $req = "UPDATE depenses SET MontantDepense = :montant, DateDepense = :date, DescriptionDepense = :description, idModePaiement = :modePaiement WHERE idDepense = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':montant' => $montant,
                ':date' => $date,
                ':description' => $description,
                ':modePaiement' => $modePaiement
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }

        return $stmt->rowCount() > 0;
    }
}


// fichier: ModePaiement.php
class ModePaiement {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function update($id, $nom) {
        // Vérifications des valeurs
        if (empty($nom)) {
            throw new InvalidArgumentException('Le nom du mode de paiement ne peut pas être vide.');
        }

        // Validation de la longueur du nom
        if (strlen($nom) < 1 || strlen($nom) > 100) {
            throw new InvalidArgumentException('Le nom du mode de paiement doit contenir entre 1 et 100 caractères.');
        }

        $req = "UPDATE modepaiement SET NomModePaiement = :nom WHERE idModePaiement = :id";
        $stmt = $this->db->prepare($req);
        
        try {
            $stmt->execute([
                ':id' => $id,
                ':nom' => $nom
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; // Retourne false en cas d'erreur
        }

        return $stmt->rowCount() > 0;
    }
}


$db = new Database();
$produit = new Produit($db);
$fournisseur = new Fournisseur($db);
$vente = new Vente($db);
$recette = new Recette($db);
$depense = new Depense($db);
$modePaiement = new ModePaiement($db);

// Récupération des données avec filter_input
$matricule = filter_input(INPUT_POST, 's_numero', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 's_nomproduit', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 's_descriptionproduit', FILTER_SANITIZE_STRING);
$prix = filter_input(INPUT_POST, 's_prixvente', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$deviseprixvente = filter_input(INPUT_POST, 's_deviseprixvente', FILTER_SANITIZE_STRING);
$cout = filter_input(INPUT_POST, 's_coutunit', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$devisecoutunit = filter_input(INPUT_POST, 's_devisecoutunit', FILTER_SANITIZE_STRING);
$nomfournisseur = filter_input(INPUT_POST, 's_nomfournisseur', FILTER_SANITIZE_STRING);
$adressefournisseur = filter_input(INPUT_POST, 's_adressefournisseur', FILTER_SANITIZE_STRING);
$coordonneesfournisseur = filter_input(INPUT_POST, 's_coordonneesfournisseur', FILTER_SANITIZE_STRING);
$datevente = filter_input(INPUT_POST, 's_datevente', FILTER_SANITIZE_STRING);
$quantitevendue = filter_input(INPUT_POST, 's_quantitevendue', FILTER_SANITIZE_NUMBER_INT);
$montanttotal = filter_input(INPUT_POST, 's_montanttotal', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$devisemontanttotal = filter_input(INPUT_POST, 's_devisemontanttotal', FILTER_SANITIZE_STRING);
$produit_id = filter_input(INPUT_POST, 's_produit', FILTER_SANITIZE_NUMBER_INT);
$modepaiement_id = filter_input(INPUT_POST, 's_modepaiement', FILTER_SANITIZE_NUMBER_INT);
$montantrecette = filter_input(INPUT_POST, 's_montantrecette', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$devisemontantrecette = filter_input(INPUT_POST, 's_devisemontantrecette', FILTER_SANITIZE_STRING);
$daterecette = filter_input(INPUT_POST, 's_daterecette', FILTER_SANITIZE_STRING);
$descriptionrecette = filter_input(INPUT_POST, 's_descriptionrecette', FILTER_SANITIZE_STRING);
$montantdepense = filter_input(INPUT_POST, 's_montantdepense', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$devisemontantdepense = filter_input(INPUT_POST, 's_devisemontantdepense', FILTER_SANITIZE_STRING);
$datedepense = filter_input(INPUT_POST, 's_datedepense', FILTER_SANITIZE_STRING);
$descriptiondepense = filter_input(INPUT_POST, 's_descriptiondepense', FILTER_SANITIZE_STRING);
$nom_modepaiement = filter_input(INPUT_POST, 's_nom_modepaiement', FILTER_SANITIZE_STRING);


// Concaténation des montants avec les devises
$prixventefinal = $prix . ' ' . $deviseprixvente;
$coutunitfinal = $cout . ' ' . $devisecoutunit;
$montanttotalfinal = $montanttotal . ' ' . $devisemontanttotal;
$montantrecettefinal = $montantrecette . ' ' . $devisemontantrecette;
$montantdepensefinal = $montantdepense . ' ' . $devisemontantdepense;

// Fonction pour afficher un message de succès ou d'erreur avec Bootstrap
function updateAndHandle($object, $method, $params, $successMessage, $errorMessage) {
    try {
        if (call_user_func_array([$object, $method], $params)) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . 
                 $successMessage . 
                 '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                 '</div>';
        } else {
            throw new Exception($errorMessage);
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . 
             $e->getMessage() . 
             '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
             '</div>';
    }
}

// Appels aux méthodes de mise à jour
updateAndHandle($produit, 'update', [$matricule, $nom, $description, $prixventefinal, $coutunitfinal], 
                "Produit mis à jour avec succès.", 
                "Erreur lors de la mise à jour du produit.");

updateAndHandle($fournisseur, 'update', [$matricule, $nomfournisseur, $adressefournisseur, $coordonneesfournisseur], 
                "Fournisseur mis à jour avec succès.", 
                "Erreur lors de la mise à jour du fournisseur.");

updateAndHandle($vente, 'update', [$matricule, $datevente, $quantitevendue, $montanttotalfinal, $produit_id, $modepaiement_id], 
                "Vente mise à jour avec succès.", 
                "Erreur lors de la mise à jour de la vente.");

updateAndHandle($recette, 'update', [$matricule, $montantrecettefinal, $daterecette, $descriptionrecette, $modepaiement_id], 
                "Recette mise à jour avec succès.", 
                "Erreur lors de la mise à jour de la recette.");

updateAndHandle($depense, 'update', [$matricule, $montantdepensefinal, $datedepense, $descriptiondepense, $modepaiement_id], 
                "Dépense mise à jour avec succès.", 
                "Erreur lors de la mise à jour de la dépense.");

updateAndHandle($modePaiement, 'update', [$matricule, $nom_modepaiement], 
                "Mode de paiement mis à jour avec succès.", 
                "Erreur lors de la mise à jour du mode de paiement.");
