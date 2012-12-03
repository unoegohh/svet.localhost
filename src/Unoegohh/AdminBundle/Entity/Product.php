<?php

namespace Unoegohh\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 */

class Product {

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected  $enabled;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $descr;

    /**
     * @ORM\Column(type="text")
     */
    protected $descr_small;

    /**
     * @ORM\Column(type="integer")
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="ProductPhoto",mappedBy="product",cascade={"persist", "remove"},orphanRemoval=true)
     */
    protected $photos;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $date_in;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    public function getDescr()
    {
        return $this->descr;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setdescrSmall($descr_small)
    {
        $this->descr_small = $descr_small;
    }

    public function getdescrSmall()
    {
        return $this->descr_small;
    }

    public function addPhoto($photo)
    {
        $photo->setProduct($this);
        $this->photos[] = $photo;
    }
    public function setPhoto($photos)
    {
        $this->photos = new ArrayCollection();
        foreach ($photos as $photo) {
            $this->addPhoto($photo);
        }
    }

    public function addPhotos($photos)
    {
        $this->addPhoto($photos);
    }

    public function removePhoto($photo)
    {
        $this->photos->removeElement($photo);
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function setDateIn($date_in)
    {
        $this->date_in = $date_in;
    }

    public function getDateIn()
    {
        return $this->date_in;
    }

}