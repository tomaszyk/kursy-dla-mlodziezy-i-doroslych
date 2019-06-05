<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Zapis
 *
 * @ORM\Table(name="zapis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZapisRepository")
 */
class Zapis
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
     * @ORM\Column(name="nazwa_kursanta", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/^[A-ZĄĘŚŻŹĆÓŁŃ][a-zA-ZĄĘŚĆŻŹÓŁŃąęśćżźółń(0-9)*]{2,}/",
     *                  message = "Imię musi zaczynać się wielką literą"
     *                  )
     *
     *
     *
     * @Assert\Regex(
     *                  pattern = "/[ ][A-ZĄĘŚŻŹĆÓŁŃ][a-zA-ZĄĘŚĆŻŹÓŁŃąęśćżźółń(0-9)*\-]{2,}$/",
     *                  message = "Nazwisko musi zaczynać się wielką literą"
     *                  )
     *
     * @Assert\Regex(
     *                  pattern="/\d/",
     *                  match=false,
     *                  message="To pole może zawierać cyfr"
     *                  )
     *
     *
     */
    private $nazwa_kursanta;

    /**
     * @var string
     *
     * @ORM\Column(name="z24_id_sprzedawcy", type="string", length=255)
     *
     */
    private $z24IdSprzedawcy;

    //  /**
    //  * @var string
    //  *
    //  * @ORM\Column(name="etykieta", type="string", length=255)
    //  *
    //  */
    // private $etykieta;

    /**
     * @var string
     *
     * @ORM\Column(name="z24_crc", type="string", length=255)
     */
    private $z24Crc;

    /**
     * @var string
     *
     * @ORM\Column(name="z24_return_url", type="string", length=255)
     */
    private $z24ReturnUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="z24_language", type="string", length=255)
     */
    private $z24Language;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_nazwa", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     *  @Assert\Regex(
     *                  pattern = "/^[A-ZĄĘŚŻŹĆÓŁŃ][a-zA-ZĄĘŚĆŻŹÓŁŃąęśćżźółń(0-9)*]{2,}/",
     *                  message = "Imię musi zaczynać się wielką literą"
     *                  )
     *
     * @Assert\Regex(
     *                  pattern = "/[ ][A-ZĄĘŚŻŹĆÓŁŃ][a-zA-ZĄĘŚĆŻŹÓŁŃąęśćżźółń(0-9)*]{2,}$/",
     *                  message = "Nazwisko musi zaczynać się wielką literą"
     *                  )
     *
     * @Assert\Regex(
     *                  pattern="/\d/",
     *                  match=false,
     *                  message="To pole może zawierać cyfr"
     *                  )
     */
    private $k24_nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_miasto", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/[A-ZŚŻŹŁ][a-zA_ZĄĘŚĆŻŹÓŁŃąęśćżźółń\- ]+/",
     *                  message = "Nazwa miasta musi się zaczynać wielką literą")
     *
     *
     *
     */
    private $k24_miasto;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_kod", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/^[0-9]{2}[ ]*-[ ]*[0-9]{3}$/",
     *                  message = "Kod pocztowy musi zawierać same cyfry w następującym formacie XX-XXX"
     *                  )
     */
    private $k24_kod;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_ulica", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/^[A-ZĄĘŚŻŹĆÓŁŃ][A-ZĄĘŚŻŹĆÓŁŃa-zA-ZĄĘŚĆŻŹÓŁŃąęśćżźółń\. ]/",
     *                  message = "Nazwa ulicy musi się zaczynać wielką literą")
     */
    private $k24_ulica;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_numer_dom", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/^[0-9]+([A-ZĄĘŚŻŹĆÓŁŃ]{1})*$/",
     *                  message = "Numer domu musi zawierać tylko cyfry i pojedynczą wielką literę")
     */
    private $k24_numer_dom;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_numer_lok", type="string", length=255)
     * @Assert\Regex(
     *                  pattern = "/^[0-9]+$/",
     *                  message = "Numer lokalu musi zawierać tylko cyfry")
     */
    private $k24_numer_lok;

    /**
     * @var string
     *
     * @ORM\Column(name="k24_email", type="string", length=255)
     * @Assert\Email(message = "Niepoprawny adres email")
     * @Assert\NotBlank(message = "To pole nie może być puste")
     */
    private $k24_email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefon", type="string", length=255)
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\Regex(
     *                  pattern = "/^[0-9]{3}[ -]*[0-9]{3}[ -]*[0-9]{3}$/",
     *                  message = "Niepoprawny format numeru telefonu")
     *
     */
    private $telefon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUrodzenia", type="date")
     * @Assert\Date(message = "To pole nie może być puste")
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\LessThan(value = "-18 years", message = "Osoba wypełniająca zgłoszenie musi być pełnoletnia")
     */
    private $dataUrodzenia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUrodzeniaKursanta", type="date")
     * @Assert\Date(message = "To pole nie może być puste")
     * @Assert\NotBlank(message = "To pole nie może być puste")
     * @Assert\LessThan(value = "-13 years", message = "Kursant musi mieć co najmniej 13 lat")
     */
    private $dataUrodzeniaKursanta;

    /**
     * @var string
     *
     * @ORM\Column(name="uwagi", type="string", length=255)
     */
    private $uwagi;

    /**
     * @var array
     *
     * @ORM\Column(name="regulamin", type="array")
     * @Assert\NotBlank(message = "Musisz zaznaczyć to pole")
     */
    private $regulamin;

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
     * Set nazwa_kursanta
     *
     * @param string $nazwa_kursanta
     *
     * @return Zapis
     */
    public function setNazwaKursanta($nazwa_kursanta)
    {
        $this->nazwa_kursanta = $nazwa_kursanta;

        return $this;
    }

    /**
     * Get nazwa_kursanta
     *
     * @return string
     */
    public function getNazwaKursanta()
    {
        return $this->nazwa_kursanta;
    }

    /**
     * Set z24IdSprzedawcy
     *
     * @param string $z24IdSprzedawcy
     *
     * @return Zapis
     */
    public function setZ24IdSprzedawcy($z24IdSprzedawcy)
    {
        $this->z24IdSprzedawcy = $z24IdSprzedawcy;

        return $this;
    }

    /**
     * Get z24IdSprzedawcy
     *
     * @return string
     */
    public function getZ24IdSprzedawcy()
    {
        return $this->z24IdSprzedawcy;
    }

    /**
     * Set z24Crc
     *
     * @param string $z24Crc
     *
     * @return Zapis
     */
    public function setZ24Crc($z24Crc)
    {
        $this->z24Crc = $z24Crc;

        return $this;
    }

    /**
     * Get z24Crc
     *
     * @return string
     */
    public function getZ24Crc()
    {
        return $this->z24Crc;
    }

    /**
     * Set z24ReturnUrl
     *
     * @param string $z24ReturnUrl
     *
     * @return Zapis
     */
    public function setZ24ReturnUrl($z24ReturnUrl)
    {
        $this->z24ReturnUrl = $z24ReturnUrl;

        return $this;
    }

    /**
     * Get z24ReturnUrl
     *
     * @return string
     */
    public function getZ24ReturnUrl()
    {
        return $this->z24ReturnUrl;
    }

    /**
     * Set z24Language
     *
     * @param string $z24Language
     *
     * @return Zapis
     */
    public function setZ24Language($z24Language)
    {
        $this->z24Language = $z24Language;

        return $this;
    }

    /**
     * Get z24Language
     *
     * @return string
     */
    public function getZ24Language()
    {
        return $this->z24Language;
    }

    /**
     * Set k24_nazwa
     *
     * @param string $k24_nazwa
     *
     * @return Zapis
     */
    public function setK24Nazwa($k24_nazwa)
    {
        $this->k24_nazwa = $k24_nazwa;

        return $this;
    }

    /**
     * Get k24_nazwa
     *
     * @return string
     */
    public function getK24Nazwa()
    {
        return $this->k24_nazwa;
    }

    /**
     * Set k24_miasto
     *
     * @param string $k24_miasto
     *
     * @return Zapis
     */
    public function setK24Miasto($k24_miasto)
    {
        $this->k24_miasto = $k24_miasto;

        return $this;
    }

    /**
     * Get k24_miasto
     *
     * @return string
     */
    public function getK24Miasto()
    {
        return $this->k24_miasto;
    }

    /**
     * Set k24_kod
     *
     * @param string $k24_kod
     *
     * @return Zapis
     */
    public function setK24Kod($k24_kod)
    {
        $this->k24_kod = $k24_kod;

        return $this;
    }

    /**
     * Get k24_kod
     *
     * @return string
     */
    public function getK24Kod()
    {
        return $this->k24_kod;
    }

    /**
     * Set k24_ulica
     *
     * @param string $k24_ulica
     *
     * @return Zapis
     */
    public function setK24Ulica($k24_ulica)
    {
        $this->k24_ulica = $k24_ulica;

        return $this;
    }

    /**
     * Get k24_ulica
     *
     * @return string
     */
    public function getK24Ulica()
    {
        return $this->k24_ulica;
    }

    /**
     * Set k24_numer_dom
     *
     * @param string $k24_numer_dom
     *
     * @return Zapis
     */
    public function setK24NumerDom($k24_numer_dom)
    {
        $this->k24_numer_dom = $k24_numer_dom;

        return $this;
    }

    /**
     * Get k24_numer_dom
     *
     * @return string
     */
    public function getK24NumerDom()
    {
        return $this->k24_numer_dom;
    }

    /**
     * Set k24_numer_lok
     *
     * @param string $k24_numer_lok
     *
     * @return Zapis
     */
    public function setK24NumerLok($k24_numer_lok)
    {
        $this->k24_numer_lok = $k24_numer_lok;

        return $this;
    }

    /**
     * Get k24_numer_lok
     *
     * @return string
     */
    public function getK24NumerLok()
    {
        return $this->k24_numer_lok;
    }

    /**
     * Set k24_email
     *
     * @param string $k24_email
     *
     * @return Zapis
     */
    public function setK24Email($k24_email)
    {
        $this->k24_email = $k24_email;

        return $this;
    }

    /**
     * Get k24_email
     *
     * @return string
     */
    public function getK24Email()
    {
        return $this->k24_email;
    }

    /**
     * Set telefon
     *
     * @param string $telefon
     *
     * @return Zapis
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set dataUrodzenia
     *
     * @param \DateTime $dataUrodzenia
     *
     * @return Zapis
     */
    public function setDataUrodzenia($dataUrodzenia)
    {
        $this->dataUrodzenia = $dataUrodzenia;

        return $this;
    }

    /**
     * Get dataUrodzenia
     *
     * @return \DateTime
     */
    public function getDataUrodzenia()
    {
        return $this->dataUrodzenia;
    }

    /**
     * Set dataUrodzeniaKursanta
     *
     * @param \DateTime $dataUrodzeniaKursanta
     *
     * @return Zapis
     */
    public function setDataUrodzeniaKursanta($dataUrodzeniaKursanta)
    {
        $this->dataUrodzeniaKursanta = $dataUrodzeniaKursanta;

        return $this;
    }

    /**
     * Get dataUrodzeniaKursanta
     *
     * @return \DateTime
     */
    public function getDataUrodzeniaKursanta()
    {
        return $this->dataUrodzeniaKursanta;
    }

    /**
     * Set uwagi
     *
     * @param string $uwagi
     *
     * @return Zapis
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    /**
     * Get uwagi
     *
     * @return string
     */
    public function getUwagi()
    {
        return $this->uwagi;
    }

    /**
     * Set regulamin
     *
     * @param array $regulamin
     *
     * @return Zapis
     */
    public function setRegulamin($regulamin)
    {
        $this->regulamin = $regulamin;

        return $this;
    }

    /**
     * Get regulamin
     *
     * @return array
     */
    public function getRegulamin()
    {
        return $this->regulamin;
    }

    //  /**
    //  * Set etykieta
    //  *
    //  * @param string $etykieta
    //  *
    //  * @return Zapis
    //  */
    // public function setEtykieta($etykieta)
    // {
    //     $this->etykieta = $etykieta;
    //
    //     return $this;
    // }
    //
    // /**
    //  * Get etykieta
    //  *
    //  * @return string
    //  */
    // public function getEtykieta()
    // {
    //     return $this->etykieta;
    // }

}
