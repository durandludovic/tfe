<?php

namespace TFE\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use TFE\LibrairieBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TFE\UserBundle\Entity\UtilisateurRepository")
 *
 * @UniqueEntity(fields="username", message="Cette username est déjà pris !")
 * @UniqueEntity(fields="email", message="Cette email est déjà pris !")
 */
class Utilisateur implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=12, unique=true)
     * @Assert\NotBlank(message = "Veuillez remplir ce champ.")
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt = "";

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array('ROLE_USER');

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=25)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInscription", type="datetime")
     */
    private $dateInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="codeActivation", type="string", length=255, nullable=true)
     */
    private $codeActivation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inscriptionValide", type="boolean")
     */
    private $inscriptionValide = false;

    /**
     * @var \TFE\LibrairieBundle\Entity\Adresse
     *
     * @ORM\ManyToOne(targetEntity="TFE\LibrairieBundle\Entity\Adresse", inversedBy="utilisateurs", cascade={"persist"})
     */
    private $adresse;

    /**
     * @var \TFE\LibrairieBundle\Entity\Sexe
     *
     * @ORM\ManyToOne(targetEntity="TFE\LibrairieBundle\Entity\Sexe", inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sexe;

    /**
     * @var \TFE\LibrairieBundle\Entity\Commentaire
     *
     * @ORM\OneToMany(targetEntity="TFE\LibrairieBundle\Entity\Commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    /**
     * @var \TFE\LibrairieBundle\Entity\News
     *
     * @ORM\OneToMany(targetEntity="TFE\LibrairieBundle\Entity\News", mappedBy="utilisateur")
     */
    private $news;

    /**
     * @var \TFE\LibrairieBundle\Entity\Note
     *
     * @ORM\OneToMany(targetEntity="TFE\LibrairieBundle\Entity\Note", mappedBy="utilisateur")
     */
    private $notes;

    /**
     * @var \TFE\LibrairieBundle\Entity\Commande
     *
     * @ORM\OneToMany(targetEntity="TFE\LibrairieBundle\Entity\Commande", mappedBy="utilisateur")
     */
    private $commandes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateInscription = new \DateTime();
        $this->commentaires = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Utilisateur
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return Utilisateur
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return Utilisateur
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set inscriptionValide
     *
     * @param boolean $inscriptionValide
     * @return Utilisateur
     */
    public function setInscriptionValide($inscriptionValide)
    {
        $this->inscriptionValide = $inscriptionValide;

        return $this;
    }

    /**
     * Get inscriptionValide
     *
     * @return boolean 
     */
    public function getInscriptionValide()
    {
        return $this->inscriptionValide;
    }

    /**
     * Set adresse
     *
     * @param \TFE\LibrairieBundle\Entity\Adresse $adresse
     * @return Utilisateur
     */
    public function setAdresse(\TFE\LibrairieBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \TFE\LibrairieBundle\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set sexe
     *
     * @param \TFE\LibrairieBundle\Entity\Sexe $sexe
     * @return Utilisateur
     */
    public function setSexe(\TFE\LibrairieBundle\Entity\Sexe $sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return \TFE\LibrairieBundle\Entity\Sexe 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Add commentaires
     *
     * @param \TFE\LibrairieBundle\Entity\Commentaire $commentaires
     * @return Utilisateur
     */
    public function addCommentaire(\TFE\LibrairieBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \TFE\LibrairieBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\TFE\LibrairieBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add news
     *
     * @param \TFE\LibrairieBundle\Entity\News $news
     * @return Utilisateur
     */
    public function addNews(\TFE\LibrairieBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \TFE\LibrairieBundle\Entity\News $news
     */
    public function removeNews(\TFE\LibrairieBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add notes
     *
     * @param \TFE\LibrairieBundle\Entity\Note $notes
     * @return Utilisateur
     */
    public function addNote(\TFE\LibrairieBundle\Entity\Note $notes)
    {
        $this->notes[] = $notes;

        return $this;
    }

    /**
     * Remove notes
     *
     * @param \TFE\LibrairieBundle\Entity\Note $notes
     */
    public function removeNote(\TFE\LibrairieBundle\Entity\Note $notes)
    {
        $this->notes->removeElement($notes);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add commandes
     *
     * @param \TFE\LibrairieBundle\Entity\Commande $commandes
     * @return Utilisateur
     */
    public function addCommande(\TFE\LibrairieBundle\Entity\Commande $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \TFE\LibrairieBundle\Entity\Commande $commandes
     */
    public function removeCommande(\TFE\LibrairieBundle\Entity\Commande $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * Set codeActivation
     *
     * @param string $codeActivation
     * @return Utilisateur
     */
    public function setCodeActivation($codeActivation)
    {
        $this->codeActivation = $codeActivation;

        return $this;
    }

    /**
     * Get codeActivation
     *
     * @return string 
     */
    public function getCodeActivation()
    {
        return $this->codeActivation;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->getInscriptionValide();
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }
}
