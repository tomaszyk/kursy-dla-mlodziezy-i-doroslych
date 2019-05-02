<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Terminy
 *
 * @ORM\Table(name="terminy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TerminyRepository")
 */
class Terminy
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
     * @var string
     *
     * @ORM\Column(name="poczatek", type="string", length=255)
     */
    private $poczatek;

    /**
     * @var string
     *
     * @ORM\Column(name="godzina", type="string", length=255)
     */
    private $godzina;

    /**
     * @var string
     *
     * @ORM\Column(name="koniec", type="string", length=255)
     */
    private $koniec;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lokalizacja", type="string", length=255)
     */
    private $lokalizacja;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dzien", type="string", length=255)
     */
    private $dzien;
    
    /**
     * @var string
     *
     * @ORM\Column(name="trener", type="string", length=255)
     */
    private $trener;
    


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
     * Set poczatek
     *
     * @param string $poczatek
     *
     * @return Terminy
     */
    public function setPoczatek($poczatek)
    {
        $this->poczatek = $poczatek;

        return $this;
    }

    /**
     * Get poczatek
     *
     * @return string
     */
    public function getPoczatek()
    {
        return $this->poczatek;
    }

    /**
     * Set godzina
     *
     * @param string $godzina
     *
     * @return Terminy
     */
    public function setGodzina($godzina)
    {
        $this->godzina = $godzina;

        return $this;
    }

    /**
     * Get godzina
     *
     * @return string
     */
    public function getGodzina()
    {
        return $this->godzina;
    }

    /**
     * Set koniec
     *
     * @param string $koniec
     *
     * @return Terminy
     */
    public function setKoniec($koniec)
    {
        $this->koniec = $koniec;

        return $this;
    }

    /**
     * Get koniec
     *
     * @return string
     */
    public function getKoniec()
    {
        return $this->koniec;
    }
    
    
    /**
     * Setlokalizacja
     *
     * @param string lokalizacja
     *
     * @return Terminy
     */
    public function setLokalizacja($lokalizacja)
    {
        $this->lokalizacja = $lokalizacja;

        return $this;
    }

    /**
     * Getlokalizacja
     *
     * @return string
     */
    public function getLokalizacja()
    {
        return $this->lokalizacja;
}
    
     /**
     * Setdzien
     *
     * @param string dzien
     *
     * @return Terminy
     */
    public function setDzien($dzien)
    {
        $this->dzien = $dzien;

        return $this;
    }

    /**
     * Getdzien
     *
     * @return string
     */
    public function getDzien()
    {
        return $this->dzien;
}
    
     /**
     * Settrener
     *
     * @param string trener
     *
     * @return Terminy
     */
    public function setTrener($trener)
    {
        $this->trener = $trener;

        return $this;
    }

    /**
     * Gettrener
     *
     * @return string
     */
    public function getTrener()
    {
        return $this->trener;
}
}

