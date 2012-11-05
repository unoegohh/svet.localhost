<?php
namespace Unoegohh\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class ProductCategory
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->getTitle();
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

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function getEnabled()
    {
        return $this->enabled;
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