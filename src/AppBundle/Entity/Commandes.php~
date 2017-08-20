<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commandes
 *
 * @ORM\Table(name="commandes", indexes={@ORM\Index(name="fk_commandes_user1_idx", columns={"user_id"})})
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\CommandesRepository")
 */
class Commandes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;


    /**
     * @var integer
     *
     * @ORM\Column(name="totaltva", type="integer")
     */
    private $totaltva;




     /**
     * @var integer
     *
     * @ORM\Column(name="ht", type="integer")
     */
    private $ht;


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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Commandes
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set totaltva
     *
     * @param integer $totaltva
     *
     * @return Commandes
     */
    public function setTotaltva($totaltva)
    {
        $this->totaltva = $totaltva;

        return $this;
    }

    /**
     * Get totaltva
     *
     * @return integer
     */
    public function getTotaltva()
    {
        return $this->totaltva;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Commandes
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
     * @return Commandes
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
     * @return Commandes
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Commandes
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ht
     *
     * @param integer $ht
     *
     * @return Commandes
     */
    public function setHt($ht)
    {
        $this->ht = $ht;

        return $this;
    }

    /**
     * Get ht
     *
     * @return integer
     */
    public function getHt()
    {
        return $this->ht;
    }
}
