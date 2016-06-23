<?php
class Voiture
{
    public $_ServiceAgent;
    public $_HeureDebut;
    public $_HeureFin;
    public $_NumVoiture1;
    public $_NumVoiture2;
    public $_NumVoiture3;
    public $_NumVoiture4;
    public $_NumVoiture5;
    public $_HeureDebutCoupe1;
    public $_HeureFinCoupe1;
    public $_HeureDebutCoupe2;
    public $_HeureFinCoupe2;
    public $_HeureDebutCoupe3;
    public $_HeureFinCoupe3;
    public $_HeureDebutCoupe4;
    public $_HeureFinCoupe4;
    public $_HeureDebutCoupe5;
    public $_HeureFinCoupe5;
    public $_nbCoupe = 0;
    public $_ServiceDouble;
    public $_HeureService;
        
    public function __construct($serviceAgent, $heureDebut, $heureFin) // Constructeur demandant 2 paramètres
    {
        //echo 'Nouvelle Voiture'; // Message s'affichant une fois que tout objet est créé.
        $this->setServiceAgent($serviceAgent); // Initialisation du service agent.
        $this->setHeureDebut($heureDebut); // Initialisation de l'heure du début de service.
        $this->setHeureFin($heureFin); // Initialisation de l'heure du fin de service.
    }
    public function getHeureDebut()
    {
        return $this->_HeureDebut;
    }
    public function getServiceDouble()
    {
        return $this->_ServiceDouble;
    }
    public function getHeureFin()
    {
        return $this->_HeureFin;
    }
    public function setServiceAgent($serviceAgent)
    {
        if (!is_int($serviceAgent)) // S'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('Le service Agent n\'est pas un nombre entier.', E_USER_WARNING);
            return;
        }
        $this->_ServiceAgent = $serviceAgent;
    }
    public function setServiceDouble($Service)
    {
        if (!is_int($Service)) // S'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('Le service Double n\'est pas un nombre entier.', E_USER_WARNING);
            return;
        }
        echo self::$Service;
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
    public function setHeureFin($heureFin)
    {
        if (!is_string($heureFin)) // S'il ne s'agit pas d'un String.
        {
            trigger_error('L\'Heure n\'est pas une heure.', E_USER_WARNING);
            return;
        }
        $this->_HeureFin = $heureFin;
    }
    public function addCoupe($heureDebut,$heureFin, $numVoiture){
        if($this->_nbCoupe == 0){
            $this->_HeureDebutCoupe1 = $heureDebut;
            $this->_HeureFinCoupe1 = $heureFin;
            $this->_NumVoiture1 = $numVoiture;
        }
        if($this->_nbCoupe == 1){
            $this->_HeureDebutCoupe2 = $heureDebut;
            $this->_HeureFinCoupe2 = $heureFin;  
            $this->_NumVoiture2 = $numVoiture;          
        }
        if($this->_nbCoupe == 2){
            $this->_HeureDebutCoupe3 = $heureDebut;
            $this->_HeureFinCoupe3 = $heureFin; 
            $this->_NumVoiture3 = $numVoiture;           
        }
        if($this->_nbCoupe == 3){
            $this->_HeureDebutCoupe4 = $heureDebut;
            $this->_HeureFinCoupe4 = $heureFin; 
            $this->_NumVoiture4 = $numVoiture;           
        }
        if($this->_nbCoupe == 4){
            $this->_HeureDebutCoupe5 = $heureDebut;
            $this->_HeureFinCoupe5 = $heureFin; 
            $this->_NumVoiture5 = $numVoiture;           
        }
        $this->_nbCoupe = $this->_nbCoupe + 1;
    }
    public function getHeureDebutCoupe1()
    {
        echo self::$_HeureDebutCoupe1;
    }
    public function getHeureDebutCoupe2()
    {
        echo self::$_HeureDebutCoupe2;
    }
    public function getHeureDebutCoupe3()
    {
        echo self::$_HeureDebutCoupe3;
    }
    public function getHeureDebutCoupe4()
    {
        echo self::$_HeureDebutCoupe4;
    }
    public function getHeureDebutCoupe5()
    {
        echo self::$_HeureDebutCoupe5;
    }
    public function getHeureFinCoupe1()
    {
        echo self::$_HeureFinCoupe1;
    }
    public function getHeureFinCoupe2()
    {
        echo self::$_HeureFinCoupe2;
    }
    public function getHeureFinCoupe3()
    {
        echo self::$_HeureFinCoupe3;
    }
    public function getHeureFinCoupe4()
    {
        echo self::$_HeureFinCoupe4;
    }
    public function getHeureFinCoupe5()
    {
        echo self::$_HeureFinCoupe5;
    }
}
?>