<?php
class Arret
{
  private $_NomArretDebut;
  private $_HeureDebut;
  private $_NomArretFin;
  private $_HeureFin;
  private $_count = 0;
        
  public function __construct($nomArretDebut, $heureDebut,$nomArretFin, $heureFin) // Constructeur demandant 2 paramètres
    {
    echo 'Nouvel Arret'; // Message s'affichant une fois que tout objet est créé.
    $this->setNomArretDebut($nomArretDebut); // Initialisation du Nom de l'arret de début
    $this->setHeureDebut($heureDebut); // Initialisation de l'heure du début de service.
    $this->setNomArretFin($nomArretFin); // Initialisation du Nom de l'arret de fin
    $this->setHeureDebut($heureDebut); // Initialisation de l'heure du fin de service.
    $this->setCount(); //Ajoute un élément dans un count.
    }
  public function getCount()
  {
    $this->_count;
  }
  public function setCount()
  {
    $this->_count = $this->_count + 1;
  }
  public function setNomArretDebut($nomArretDebut)
  {
    if (!is_string($nomArretDebut)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('Le nom de l\'arret n\'est pas un String.', E_USER_WARNING);
      return;
    }
    $this->_NomArretDebut = $nomArretDebut;
  }
  public function setHeureDebut($heureDebut)
  {
    if (!is_string($heureDebut)) // S'il ne s'agit pas d'un String.
    {
      trigger_error('L\'Heure n\'est pas une heure.', E_USER_WARNING);
      return;
    }
    $this->_HeureDebut = $heureDebut;
  }
  public function setNomArretFin($nomArretFin)
  {
    if (!is_string($nomArretFin)) // S'il ne s'agit pas d'un String.
    {
      trigger_error('Le nom de l\'arret n\'est pas un String.', E_USER_WARNING);
      return;
    }
    $this->_NomArretFin = $nomArretFin;
  }
  public function setHeureFin($heureFin)
  {
    if (!is_string($heureFin)) // S'il ne s'agit pas d'un String.
    {
      trigger_error('L\'Heure n\'est pas une heure.', E_USER_WARNING);
      return;
    }
    $this->_HeureFin = $heureFin;
  }
}
?>