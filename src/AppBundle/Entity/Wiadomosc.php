<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Wiadomosc
 *
 * @ORM\Table(name="wiadomosc")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WiadomoscRepository")
 */
class Wiadomosc
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
     * @ORM\Column(name="Imie", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Wiadomosc", type="text")
     * @Assert\NotBlank(message = "To pole nie może być puste")
     */
    private $wiadomosc;

    /**
     * @var array
     *
     * @ORM\Column(name="Zgoda", type="array")
     * @Assert\NotBlank(message = "Zaznacz to pole")
     */
    private $zgoda;


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
     * Set imie
     *
     * @param string $imie
     *
     * @return Wiadomosc
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Wiadomosc
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set wiadomosc
     *
     * @param string $wiadomosc
     *
     * @return Wiadomosc
     */
    public function setWiadomosc($wiadomosc)
    {
        $this->wiadomosc = $wiadomosc;

        return $this;
    }

    /**
     * Get wiadomosc
     *
     * @return string
     */
    public function getWiadomosc()
    {
        return $this->wiadomosc;
    }

    /**
     * Set zgoda
     *
     * @param array $zgoda
     *
     * @return Wiadomosc
     */
    public function setZgoda($zgoda)
    {
        $this->zgoda = $zgoda;

        return $this;
    }

    /**
     * Get zgoda
     *
     * @return array
     */
    public function getZgoda()
    {
        return $this->zgoda;
    }
}

