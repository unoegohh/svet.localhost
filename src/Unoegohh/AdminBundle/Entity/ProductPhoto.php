<?php
namespace Unoegohh\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductPhoto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $url;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="Product",inversedBy="photos")
     * @ORM\JoinColumn(name="product_id",referencedColumnName="id")
     */
    protected $product;


    public function __toString(){
        return $this->getUrl();
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }


}