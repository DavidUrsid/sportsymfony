<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * SizeProduct
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SizeProductRepository")
 * @ORM\Table(name="size_product", indexes={@ORM\Index(name="fk_size_has_product_product1_idx", columns={"product_id"}), @ORM\Index(name="fk_size_has_product_size1_idx", columns={"size_id"})})
 */
class SizeProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="Le prix doit être un chiffre.")
     */
    private $stock;

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
     * @var \AppBundle\Entity\Size
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Size")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="size_id", referencedColumnName="id")
     * })
     */
    private $size;

    /**
     * @var \AppBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;


    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return SizeProduct
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SizeProduct
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
     * @return SizeProduct
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
     * @return SizeProduct
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
     * Set size
     *
     * @param \AppBundle\Entity\Size $size
     *
     * @return SizeProduct
     */
    public function setSize(\AppBundle\Entity\Size $size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \AppBundle\Entity\Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return SizeProduct
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }


    public function __toString() {
    return $this->getSize();
}


}
