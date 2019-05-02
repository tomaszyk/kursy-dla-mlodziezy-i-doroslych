<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ceny
 *
 * @ORM\Table(name="ceny")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CenyRepository")
 */
class Ceny
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
     * @ORM\Column(name="cena", type="integer")
     */
    private $cena;

    /**
     * @var int
     *
     * @ORM\Column(name="rata1", type="integer")
     */
    private $rata1;

    /**
     * @var int
     *
     * @ORM\Column(name="rata2", type="integer")
     */
    private $rata2;

    /**
     * @var int
     *
     * @ORM\Column(name="rezerwacja", type="integer")
     */
    private $rezerwacja;
    
    /**
     * @var int
     *
     * @ORM\Column(name="cenaCal", type="integer")
     */
    private $cenaCal;


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
     * Set cena
     *
     * @param integer $cena
     *
     * @return Ceny
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return int
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set rata1
     *
     * @param integer $rata1
     *
     * @return Ceny
     */
    public function setRata1($rata1)
    {
        $this->rata1 = $rata1;

        return $this;
    }

    /**
     * Get rata1
     *
     * @return int
     */
    public function getRata1()
    {
        return $this->rata1;
    }

    /**
     * Set rata2
     *
     * @param integer $rata2
     *
     * @return Ceny
     */
    public function setRata2($rata2)
    {
        $this->rata2 = $rata2;

        return $this;
    }

    /**
     * Get rata2
     *
     * @return int
     */
    public function getRata2()
    {
        return $this->rata2;
    }

    /**
     * Set rezerwacja
     *
     * @param integer $rezerwacja
     *
     * @return Ceny
     */
    public function setRezerwacja($rezerwacja)
    {
        $this->rezerwacja = $rezerwacja;

        return $this;
    }

    /**
     * Get rezerwacja
     *
     * @return int
     */
    public function getRezerwacja()
    {
        return $this->rezerwacja;
    }
    
    
    /**
     * Set cenaCal
     *
     * @param integer $cenaCal
     *
     * @return Ceny
     */
    public function setCenaCal($cenaCal)
    {
        $this->cenaCal = $cenaCal;

        return $this;
    }

    /**
     * Get cenaCal
     *
     * @return int
     */
    public function getCenaCal()
    {
        return $this->cenaCal;
    }
}

