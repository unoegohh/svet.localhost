<?php

namespace Unoegohh\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Page {

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
     * @ORM\Column(type="string")
     */
    protected $header;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $position;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $menuTop;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $menuLeft;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMenuLeft($menuLeft)
    {
        $this->menuLeft = $menuLeft;
    }

    public function getMenuLeft()
    {
        return $this->menuLeft;
    }

    public function setMenuTop($menuTop)
    {
        $this->menuTop = $menuTop;
    }

    public function getMenuTop()
    {
        return $this->menuTop;
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