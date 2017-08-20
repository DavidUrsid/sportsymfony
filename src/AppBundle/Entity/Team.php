<?php

namespace AppBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Team
 *
 * @ORM\Table(name="team", indexes={@ORM\Index(name="fk_team_league1_idx", columns={"league_id"})})
 * @UniqueEntity(fields="libelle", message="Cette équipe existe déjà.")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 * @Vich\Uploadable
 */
class Team
{   
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=45, nullable=true)
     */
    private $image;


    /**
     * @Vich\UploadableField(mapping="team_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=false)
     * @Assert\Length(min=10, minMessage="Votre message est trop petit.")
     */
    private $commentaire;



    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=45, nullable=true, unique=true)
     * @Assert\Length(min=10, minMessage="Votre message est trop petit.")
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="_status", type="smallint", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\League
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\League")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     * })
     */
    private $league;


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Team
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Team
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Team
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Team
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
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
     * Set league
     *
     * @param \AppBundle\Entity\League $league
     *
     * @return Team
     */
    public function setLeague(\AppBundle\Entity\League $league = null)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return \AppBundle\Entity\League
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Team
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
           
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Team
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
