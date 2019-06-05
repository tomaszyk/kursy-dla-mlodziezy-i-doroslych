<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Daty
 *
 * @ORM\Table(name="daty")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DatyRepository")
 */
class Daty
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="PierD", type="integer")
     */
    private $pierD;

    /**
     * @var int
     *
     * @ORM\Column(name="PierM", type="integer")
     */
    private $pierM;

    /**
     * @var int
     *
     * @ORM\Column(name="PierR", type="integer")
     */
    private $pierR;

    /**
     * @var int
     *
     * @ORM\Column(name="DrugiD", type="integer")
     */
    private $drugiD;

    /**
     * @var int
     *
     * @ORM\Column(name="DrugiM", type="integer")
     */
    private $drugiM;

    /**
     * @var int
     *
     * @ORM\Column(name="DrugiR", type="integer")
     */
    private $drugiR;

    /**
     * @var int
     *
     * @ORM\Column(name="TrzeciD", type="integer")
     */
    private $trzeciD;

    /**
     * @var int
     *
     * @ORM\Column(name="TrzeciM", type="integer")
     */
    private $trzeciM;

    /**
     * @var int
     *
     * @ORM\Column(name="TrzeciR", type="integer")
     */
    private $trzeciR;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pierD
     *
     * @param integer $pierD
     *
     * @return Daty
     */
    public function setPierD($pierD)
    {
        $this->pierD = $pierD;

        return $this;
    }

    /**
     * Get pierD
     *
     * @return int
     */
    public function getPierD()
    {
        return $this->pierD;
    }

    /**
     * Set pierM
     *
     * @param integer $pierM
     *
     * @return Daty
     */
    public function setPierM($pierM)
    {
        $this->pierM = $pierM;

        return $this;
    }

    /**
     * Get pierM
     *
     * @return int
     */
    public function getPierM()
    {
        return $this->pierM;
    }

    /**
     * Set pierR
     *
     * @param integer $pierR
     *
     * @return Daty
     */
    public function setPierR($pierR)
    {
        $this->pierR = $pierR;

        return $this;
    }

    /**
     * Get pierR
     *
     * @return int
     */
    public function getPierR()
    {
        return $this->pierR;
    }

    /**
     * Set drugiD
     *
     * @param integer $drugiD
     *
     * @return Daty
     */
    public function setDrugiD($drugiD)
    {
        $this->drugiD = $drugiD;

        return $this;
    }

    /**
     * Get drugiD
     *
     * @return int
     */
    public function getDrugiD()
    {
        return $this->drugiD;
    }

    /**
     * Set drugiM
     *
     * @param integer $drugiM
     *
     * @return Daty
     */
    public function setDrugiM($drugiM)
    {
        $this->drugiM = $drugiM;

        return $this;
    }

    /**
     * Get drugiM
     *
     * @return int
     */
    public function getDrugiM()
    {
        return $this->drugiM;
    }

    /**
     * Set drugiR
     *
     * @param integer $drugiR
     *
     * @return Daty
     */
    public function setDrugiR($drugiR)
    {
        $this->drugiR = $drugiR;

        return $this;
    }

    /**
     * Get drugiR
     *
     * @return int
     */
    public function getDrugiR()
    {
        return $this->drugiR;
    }

    /**
     * Set trzeciD
     *
     * @param integer $trzeciD
     *
     * @return Daty
     */
    public function setTrzeciD($trzeciD)
    {
        $this->trzeciD = $trzeciD;

        return $this;
    }

    /**
     * Get trzeciD
     *
     * @return int
     */
    public function getTrzeciD()
    {
        return $this->trzeciD;
    }

    /**
     * Set trzeciM
     *
     * @param integer $trzeciM
     *
     * @return Daty
     */
    public function setTrzeciM($trzeciM)
    {
        $this->trzeciM = $trzeciM;

        return $this;
    }

    /**
     * Get trzeciM
     *
     * @return int
     */
    public function getTrzeciM()
    {
        return $this->trzeciM;
    }

    /**
     * Set trzeciR
     *
     * @param integer $trzeciR
     *
     * @return Daty
     */
    public function setTrzeciR($trzeciR)
    {
        $this->trzeciR = $trzeciR;

        return $this;
    }

    /**
     * Get trzeciR
     *
     * @return int
     */
    public function getTrzeciR()
    {
        return $this->trzeciR;
    }
}
