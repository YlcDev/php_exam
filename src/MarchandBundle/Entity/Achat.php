<?php

namespace MarchandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 */
class Achat
{
    /**
     * @var int
     */
    private $id;


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
     * @var \MarchandBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \MarchandBundle\Entity\User $user
     *
     * @return Achat
     */
    public function setUser(\MarchandBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MarchandBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \MarchandBundle\Entity\User
     */
    private $fruit;


    /**
     * Set fruit
     *
     * @param \MarchandBundle\Entity\User $fruit
     *
     * @return Achat
     */
    public function setFruit(\MarchandBundle\Entity\User $fruit = null)
    {
        $this->fruit = $fruit;

        return $this;
    }

    /**
     * Get fruit
     *
     * @return \MarchandBundle\Entity\User
     */
    public function getFruit()
    {
        return $this->fruit;
    }
}
