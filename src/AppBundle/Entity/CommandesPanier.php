<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * CommandesPanier
 *
 * @ORM\Table(name="commandes_panier", indexes={@ORM\Index(name="fk_commandes_has_panier_panier1_idx", columns={"panier_id"}), @ORM\Index(name="fk_commandes_has_panier_commandes1_idx", columns={"commandes_id"}), @ORM\Index(name="IDX_15E78CFD8BF5C2E6", columns={"commandes_id"})})
 * @ORM\Entity
 */
class CommandesPanier
{
     /**
     * @var \AppBundle\Entity\Panier
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Panier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="panier_id", referencedColumnName="id")
     * })
     */
    private $panier;

    /**
     * @var \AppBundle\Entity\Commandes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commandes_id", referencedColumnName="id")
     * })
     */
    private $commandes;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CommandesPanier
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
     * @return CommandesPanier
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
     * @return CommandesPanier
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
     * Set panier
     *
     * @param \AppBundle\Entity\Panier $panier
     *
     * @return CommandesPanier
     */
    public function setPanier(\AppBundle\Entity\Panier $panier = null)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier
     *
     * @return \AppBundle\Entity\Panier
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * Set commandes
     *
     * @param \AppBundle\Entity\Commandes $commandes
     *
     * @return CommandesPanier
     */
    public function setCommandes(\AppBundle\Entity\Commandes $commandes = null)
    {
        $this->commandes = $commandes;

        return $this;
    }

    /**
     * Get commandes
     *
     * @return \AppBundle\Entity\Commandes
     */
    public function getCommandes()
    {
        return $this->commandes;
    }
}
