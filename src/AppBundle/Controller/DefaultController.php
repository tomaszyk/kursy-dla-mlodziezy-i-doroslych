<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ceny;
use AppBundle\Entity\Daty;
use AppBundle\Entity\Terminy;
use AppBundle\Entity\Wiadomosc;
use AppBundle\Entity\Zapis;
use Mpdf\Mpdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Akcja ustala termin startu nowej grupy, ilość wolnych miejsc w grupie
     * oraz odpowiednią cenę za udział w kursie
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //Sesja
        $session = $request->getSession();

        //Pobranie tabeli wszystkich kursantów
        $kursanci = $this->getDoctrine()->getRepository(Zapis::class)->findAll();

        $i = 0;

        //Liczenie kursantów
        foreach ($kursanci as $kursant) {
            $i++;
        }

        //Ustalenie, do której grupy prowadzony jest nabór (grupa liczy maksymalnie 8 kursantów)
        $grupa = intval($i / 8) + 1;

        //Ilu jest kursantów w grupie, do której trwa nabór
        $liczbaKursantow = $i % 8;

        //Aktualny czas
        $czas = time();

        //Tabela daty zawiera jeden rekord. Kolejne kolumny to daty, które ustalają zakończenie
        //kolejnych propocji cenowych za udział w kursie
        $data = $this->getDoctrine()->getRepository(Daty::class)->findOneById(1);

        //Data zakończenia promocji ($pokazDate) jest uzależniona od aktualnego czasu ($czas)
        //Zmienna k pomoże pobrać odpowiednią cenę z bazy dostosowaną do daty
        if ($czas < mktime(0, 0, 0, $data->getPierM(), $data->getPierD(), $data->getPierR())) {
            $k = 1;
            $pokazDate = $data->getPierD() . '.' . $data->getPierM() . '.' . $data->getPierR();
        }

        if ($czas > mktime(0, 0, 0, $data->getPierM(), $data->getPierD(), $data->getPierR()) &&
            $czas < mktime(0, 0, 0, $data->getDrugiM(), $data->getDrugiD(), $data->getDrugiR())) {
            $k = 2;
            $pokazDate = $data->getDrugiD() . '.' . $data->getDrugiM() . '.' . $data->getDrugiR();
        }

        if ($czas > mktime(0, 0, 0, $data->getDrugiM(), $data->getDrugiD(), $data->getDrugiR()) &&
            $czas < mktime(0, 0, 0, $data->getTrzeciM(), $data->getTrzeciD(), $data->getTrzeciR())) {
            $k = 3;
            $pokazDate = $data->getTrzeciD() . '.' . $data->getTrzeciM() . '.' . $data->getTrzeciR();
        }

        //Jeżeli jest to nowa grupa cena udziału w kursie jest najniższa
        if ($i % 8 == 0) {
            $k = 1;
        }

        //Zależnie od grupy (pierwsza, druga...) na stronie pokazują sięodpowiednie daty początku i końca kursu
        $termin = $this->getDoctrine()->getRepository(Terminy::class)->findOneById($grupa);

        //Zależnie od aktualnej daty na tronie pojawia się odpowiednia cena za udział w kursie
        $cena = $this->getDoctrine()->getRepository(Ceny::class)->findOneBy(['id' => $k]);

        //Wartości potrzebne do wygenerowania umowy
        $session->set('cena', $cena);
        $session->set('trener', $termin->getTrener());
        $session->set('lokalizacja', $termin->getLokalizacja());
        $session->set('poczatekKursu', $termin->getPoczatek());
        $session->set('data', $pokazDate);
        $session->set('grupa', $grupa);
        $session->set('indexPromocji', $k);

        //Plik widoku z odpowiednimi danymi
        return $this->render('default/index.html.twig', ['pokazDate' => $pokazDate, 'termin' => $termin, 'cena' => $session->get('cena'), 'liczbaKursantow' => $liczbaKursantow]);
    }

    /**
     * Formularz zapisu na kurs pobiera dane osoby zapisującej na kurs oraz kursanta, dane są potrzebne do sporządenia umowy
     *
     * @Route("/formularz", name="formularz")
     */
    public function formularzAction(Request $request)
    {
        //Sesja
        $session = $request->getSession();

        //Obiek kursanta
        $kursant = new Zapis();

        //Formularz pobierze od użytkownika dane, które są potrzebne dla obiektu kursanta
        $form = $this->createFormBuilder($kursant)

            ->add('nazwa_kursanta', TextType::class, ['label' => 'Imię i Nazwisko Kursanta'])

            ->add('dataUrodzeniaKursanta', DateType::class, ['widget' => 'choice',
                'placeholder' => ['year' => 'Rok', 'month' => 'Miesiąc', 'day' => 'Dzień'],
                'years' => ['1945', '1946', '1947', '1948', '1949', '1950', '1951', '1952', '1953', '1954', '1955', '1956', '1957', '1958', '1959', '1960', '1961', '1962', '1963', '1964', '1965', '1966', '1967', '1968', '1969', '1970', '1971', '1972', '1973', '1974', '1975', '1976', '1977', '1978', '1979', '1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019'],
                'format' => 'dd-MM-yyyy',
                'label' => 'Data Urodzenia Kursanta',
            ])
        //Cztery pola HiddenType: z24_id_sprzedawca, z24_crc, z24_return_url, z24_language są wymagane przez system do płatnoci,
        //pole z24_return_url określa adres strony do przekierowania po zapłacie
            ->add('z24_id_sprzedawcy', HiddenType::class, ['data' => 'xxxxx'])

            ->add('z24_crc', HiddenType::class, ['data' => '5ebc7348'])

            ->add('z24_return_url', HiddenType::class, ['data' => 'http://szybkieczytanie-poznan.pl/app.php/dziekuje'])

            ->add('z24_language', HiddenType::class, ['data' => 'pl'])

            ->add('k24_nazwa', TextType::class, ['label' => 'Imię i Nazwisko osoby wysyłającej zgłoszenie'])

            ->add('k24_miasto', TextType::class, ['label' => 'Miasto'])

            ->add('k24_kod', TextType::class, ['label' => 'Kod Pocztowy'])

            ->add('k24_ulica', TextType::class, ['label' => 'Ulica'])

            ->add('k24_numer_dom', TextType::class, ['label' => 'Numer Domu'])

            ->add('k24_numer_lok', NumberType::class, ['label' => 'Numer Lokalu'])

            ->add('k24_email', EmailType::class, ['label' => 'Email'])

            ->add('telefon', TextType::class, ['label' => 'Telefon'])

            ->add('dataUrodzenia', DateType::class, ['widget' => 'choice',
                'placeholder' => ['year' => 'Rok', 'month' => 'Miesiąc', 'day' => 'Dzień'],
                'years' => ['1945', '1946', '1947', '1948', '1949', '1950', '1951', '1952', '1953', '1954', '1955', '1956', '1957', '1958', '1959', '1960', '1961', '1962', '1963', '1964', '1965', '1966', '1967', '1968', '1969', '1970', '1971', '1972', '1973', '1974', '1975', '1976', '1977', '1978', '1979', '1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019'],
                'format' => 'dd-MM-yyyy',
                'label' => 'Data Urodzenia',
            ])

            ->add('uwagi', TextareaType::class, ['label' => 'Uwagi'])

            ->add('regulamin', CheckboxType::class, ['label' => 'Akceptuje regulamin i politykę prywatności', 'required' => true])

            ->add('save', SubmitType::class, ['label' => 'Zapisuje się na kurs'])

            ->getForm();

        //Gdy formularz został wysłany dane z niego są przypisywane do obiektu kursant
        $form->handleRequest($request);

        //Jeżeli dane są poprawne zostaną przypisane do zmiennych sesyjnych (potrzebne do umowy)
        // i kursant zostaje przekierowany do strony z opłatą rezerwacyjną (płace)
        //Jeżeli dane są nie poprawne w przeglądarce pojawi się formularz z komunikatami o błędach
        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('kursant', $form->getData());
            $session->set('nazwa_kursanta', $form->get('nazwa_kursanta')->getData());
            $session->set('nazwa', $form->get('k24_nazwa')->getData());
            $session->set('miasto', $form->get('k24_miasto')->getData());
            $session->set('kod', $form->get('k24_kod')->getData());
            $session->set('ulica', $form->get('k24_ulica')->getData());
            $session->set('nrDomu', $form->get('k24_numer_dom')->getData());
            $session->set('nrLokalu', $form->get('k24_numer_lok')->getData());
            if ($session->get('nrLokalu') == "") {$session->set('nrLokalu', 0);}
            $session->set('email', $email = $form->get('k24_email')->getData());
            $session->set('telefon', $telefon = $form->get('telefon')->getData());

            return $this->redirectToRoute('place');

        }
        //Widok formularza
        return $this->render('default/formularz.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/place", name="place")
     */
    public function placeAction()
    {
        return $this->render('default/place.html.twig');
    }

    /**
     *
     * Akcja generuje umowę udziału w kursie, zapisuje dane kursanta do bazy i wysyła maila z potwierdzeniem
     *
     * @Route("/dziekuje", name="dziekuje")
     */
    public function dziekujeAction(Request $request)
    {
        //Sesja
        $session = $request->getSession();

        //Jeżeli użytkownik nie podał numeru lokalu to w to miejsce pojawi się pusty string
        if ($session->get('nrLokalu') == 0) {
            $session->set('nrLokalu', '');
        }

        //Z sesji pobierana jest wartość indexPromocji (ustalona w akcji index), która określa cenę za udział w kursie
        //odpowiednia wartośc jest pobierana z bazy
        $cena1 = $this->getDoctrine()->getRepository(Ceny::class)->findOneBy(['id' => $session->get('indexPromocji')]);

        //Cena oprócz daty zapisu jest  też zależna od sposobu płatności
        $cenaDoUmowy = $cena1->getCena();
        $rata1 = $cena1->getRata1();
        $rata2 = $cena1->getRata2();
        $rezerwacja = $cena1->getRezerwacja();
        $cenaCal = $cena1->getCenaCal();

        //Obiekt, który wygeneryje umowę w formie pliku pdf wypełnioną danymi kursanta podanymi w formularzu,
        //odpowiednią ceną i odpowiednim terminem rozpoczęcia kursu
        $mpdf = new Mpdf();

        $mpdf->WriteHTML($this->render('default/umowa.html.twig',
            [
                'imieNazwisko' => $session->get('nazwa'),
                'miasto' => $session->get('miasto'),
                'kod' => $session->get('kod'),
                'ulica' => $session->get('ulica'),
                'nrDomu' => $session->get('nrDomu'),
                'nrLokalu' => $session->get('nrLokalu'),
                'email' => $session->get('email'),
                'telefon' => $session->get('telefon'),
                'nazwaKursanta' => $session->get('nazwa_kursanta'),
                'cenaDoUmowy' => $cenaDoUmowy,
                'rata1' => $rata1,
                'rata2' => $rata2,
                'rezerwacja' => $rezerwacja,
                'cenaCal' => $cenaCal,
                'dataPromocji' => $session->get('data'),
                'startKursu' => $session->get('poczatekKursu'),
                'lokalizacja' => $session->get('lokalizacja'),
                'trener' => $session->get('trener'),
            ]));

        //Zapis pliku do odpowiedniej lokalizacji i pod odpowiednią nazwą
        $mpdf->Output('../app/umowy/Umowa - ' . $session->get('nazwa') . '.pdf');

        //Zapis kursanta do bazy
        $em = $this->getDoctrine()->getManager();
        $em->persist($session->get('kursant'));
        $em->flush();

        //Wysyłka maila z potwierdzeniem rejestracji i z załączoną umową

        //Z bazy pobierane są szczegółówe dane początku kursu, znajdą się w treści maila
        $kursy = $this->getDoctrine()->getRepository(Terminy::class)->findOneById($session->get('grupa'));

        //Tworzenie maila
        $message = (new \Swift_Message('Potwierdzenie miejsca na kursie szybkiego czytania i technik pamięciowych'));

        $message->setFrom('szybkieczytaniepoznan@gmail.com')
            ->setTo($session->get('email'))
            ->addPart('

        <p>Witaj ' . $session->get('nazwa') . ',</p>
        <p>Cieszę się, że nasz kurs wzbudził Twoje zainteresowanie. W załączniku znajduje się wzór naszej umowy o udział w kursie. Plik jest do wglądu, proszę nie drukować umowy. Na pierwszych  zajęciach otrzymasz dwa egzemplarze do podpisu, jeden będzie dla Ciebie a drugi dla szkoły. Gdyby pojawiły się jakieś wątpliwości, zachęcam do kontaktu. Zapraszam na pierwsze spotkanie ' . $kursy->getPoczatek() . ' (' . $kursy->getDzien() . ') na godz.' . $kursy->getGodzina() . ', miejsce zajęć to ' . $session->get('lokalizacja') . '.</p>
        --

        <p>Pozdrawiam<br>
        Tomasz Mlastek<br>
        EDU Poznań<br>
        Tel. 787 620 114<br>
        E-mail: poznan@akademiaedukacji.pl<br>
        www.szybkieczytanie-poznan.pl<br>
        www.czytaniedladzieci.pl', 'text/html'
            )

        //Zalącznik (plik z umową)
            ->attach(\Swift_Attachment::fromPath('../app/umowy/Umowa - ' . $session->get('nazwa') . '.pdf'));
        $this->get('mailer')->send($message);

        return $this->render('default/dziekuje.html.twig');
    }

    /**
     * @Route("/dowodySkutecznosci", name="dowodySkutecznosci")
     */
    public function dowodySkutecznosciAction()
    {
        return $this->render('default/dowodySkutecznosci.html.twig');
    }

    /**
     * @Route("/dysleksja", name="dysleksja")
     */
    public function dysleksjaAction()
    {
        return $this->render('default/dysleksja.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction()
    {
        return $this->render('default/faq.html.twig');
    }

    /**
     * Akcja tworzy formularz kontaktowy
     * @Route("/kontakt", name="kontakt")
     */
    public function kontaktAction(Request $request)
    {
        //Obiekt wiadomosci
        $wiadomosc = new Wiadomosc();

        //Formularz
        $form = $this->createFormBuilder($wiadomosc)
            ->add('imie', TextType::class, ['label' => 'Imię'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('wiadomosc', TextareaType::class, ['label' => 'Wiadomość'])
            ->add('zgoda', CheckboxType::class, ['label' => '* Wyrażam zgodę na przetwarzanie danych osobowych w celu odpowiedzi na mojego e-maila. Podane dane mogą być wykorzystywane w celach marketingowych, jeśli będzie wymagała tego odpowiedź. W każdym momencie możesz się wypisać. Więcej informacji w Polityce prywatności.', 'required' => true])
            ->add('submit', SubmitType::class, ['label' => 'Wyślij wiadomość'])

            ->getForm();

        $session = $request->getSession();

        $session->set('recaptcha', " ");

        //Jeżeli formularz został wysłany to wartoci z poł zostają przypisane do obiektu wiadomość
        $form->handleRequest($request);

        //Sprawdzenie czy formularz został wysłany i czy dane są poprawne
        if ($form->isSubmitted() && $form->isValid()) {
            //Wartości z formularza przypisywane są do zmiennej sesyjnej
            $session->set('kontakt', $form->getData());

            //Z formularza wyciągane są wartości z poszczególnych pól
            $imie = $form->get('imie')->getData();
            $email = $form->get('email')->getData();
            $wiadomosc = $form->get('wiadomosc')->getData();
            $zgoda = $form->get('zgoda')->getData();

            //Mechanizm recaptcha
            $sprawdz = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lc_54kUAAAAAD1HbFcgQFISpNXw8Mla9W3prCN8&response=" . $_POST['g-recaptcha-response']);

            $odpowiedz = json_decode($sprawdz);

            //Jeżeli użytkownik nie zazznaczył recaptcha przegladarka pokaże formularz ponownie z odpowiednim komunikatem
            if ($odpowiedz->success == false) {

                $session->set('recaptcha', "Potwierdz, że nie jesteś robotem");

                return $this->render('default/kontakt.html.twig', ['form' => $form->createView(), 'recaptcha' => $session->get('recaptcha')]);
            }

            //Jeżeli formularz jest wypełniony poprawnie użytkownik przechodzi do akcji wiadomość
            return new RedirectResponse($this->generateUrl('wiadomosc', ['imie' => $imie, 'email' => $email, 'wiadomosc' => $wiadomosc, 'zgoda' => $zgoda]));

        }
        //Plik widoku formularza
        return $this->render('default/kontakt.html.twig', ['form' => $form->createView(), 'recaptcha' => $session->get('recaptcha')]);
    }

    /**
     * @Route("/programKursu", name="programKursu")
     */
    public function programKursuAction()
    {
        return $this->render('default/programKursu.html.twig');
    }

    /**
     * @Route("/regulamin", name="regulamin")
     */
    public function regulaminAction()
    {
        return $this->render('default/regulamin.html.twig');
    }

    /**
     *
     * Akcja zapisuje wiadomość do bazy oraz wysyła ją na skrzynkę email
     *
     * @Route("/wiadomosc/{imie}/{email}/{wiadomosc}/{zgoda}", name="wiadomosc")
     */

    public function wiadomoscAction($imie, $email, $wiadomosc, Request $request)
    {
        $session = $request->getSession();

        //Zapis do bazy
        $em = $this->getDoctrine()->getManager();
        $em->persist($session->get('kontakt'));
        $em->flush();

        //WGenerowanie wiadomości
        $message = (new \Swift_Message('Wiadomość za strony'));

        $message->setFrom($email)
            ->setTo('poznan@szybkieczytanie-poznan.pl')
            ->setBody('wiadomość ze strony szybkieczytanie-poznan.pl. Nadawaca ' . $imie . ' email ' . $email . ' treść ' . $wiadomosc);

        $this->get('mailer')->send($message);

        return $this->render('default/wiadomosc.html.twig');
    }

}
