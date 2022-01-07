<?php
session_start();


require_once "inc/incfiles/startFile.php";
?>
<title>Etusivu</title>
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h2 class="text-warning">Patrik Laamanen</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Etusivu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Projektini</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="projektit/pelikone/slotmachine.php">Pelikone</a></li>
                            <li><a class="dropdown-item" href="projektit/sikanoppa/pigdice.php">Sikanoppa</a></li>
                            <li><a class="dropdown-item" href="projektit/projects/projects.php">Projektien tallennus</a></li>
                            <li><a class="dropdown-item" href="projektit/vieraskirja/guestbook.php">Vieraskirja</a></li>
                            <li><a class="dropdown-item" href="projektit/chatti/livechat.php">Chatti</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://patriklaamanen.com">CV</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
                    <div class="d-flex">
                        <h3 class="me-3 text-info">Hei <?php echo $_SESSION['username']; ?>!</h3>
                        <a class="btn btn-danger" href="inc/incfiles/logout.php" role="button">Kirjaudu ulos</a>
                    </div>
                <?php else: ?>
                    <form class="d-flex">                    
                        <a class="btn btn-primary" href="reg.php" role="button">Rekisteröidy</a>
                        <a class="btn btn-primary ms-1" href="log.php" role="button">Kirjaudu</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
<main class="d-flex flex-column flex-lg-row justify-content-evenly pt-4 pb-4">
    <div class="container col-8 col-lg-5 bg-dark bg-gradient p-5 mt-5 text-light">
        <h3 class="mb-3">Sivuston tarkoitus ja synty</h3>
        <p>Täältä löytyy joitakin tekemiä projekteja. Osan olen tehnyt opiskelujen takia ja toiset taas omalla vapaa-ajalla oppiakseni.
            <br><br>
            Itseasiassa tämän sivuston olen alunperin tehnyt kouluprojektina. Kaikki lähti siitä, kun aloitin web-ohjelmoinnin opettelun ja tein ensimmäisen staattisen sivuni.
            Siitä lähtien olen tehnyt tälle sivustolle eri projekteja. Aluksi tein staattisia sivuja, joilla opettelin html:n ja css:n alkeet, hiljalleen siirtyen responsiivisuuteen ja 
            saavutettavuuteen liittyviin asioihin.
            Seuraavaksi mukaan tuli javascript ja sillä tein aluksi pieniä projekteja, kuten lomakkeen validointia ja erilaisten laskureiden tekoa. Nämä projektit olen jo aikoja sitten poistanut sivustolta 
            vaikka jälkikäteen olen ajatellut, että olisi ollut ihan mukava idea tehdä arkistosivu niille projekteille, joita olisin voinut sitten tulevaisuudessa katsella.
            <br><br>
            Kehitys jatkui ja otin mukaan jQueryn ja bootstrapin. Sivustoni alkoi hiljalleen saamaan toimivuutta. Olen aina pitänyt eri toiminnallisuuksien toteuttamisesta ja alussa se veikin suurimman osan keskittymisestäni. Jälkikäteen ajatellen olisin voinut jo opetteluni alussa voinut käyttää 
            enemmän aikaa css:n ja etenkin bootstrapin harjoitteluun. Olen kuitenkin niidenkin osalta tajunnut myöhemmin skarpata. Vaikka olenkin yrittänyt tämän sivuston ulkoasua parantaa, on selvästi 
            nähtävissä vielä ongelmia, jotka olen sivuston alkuaikoina aiheuttanut, kun en esimerkiksi käyttänyt bootstrappia niin paljon kuin olisi pitänyt. 
            <br><br>
            Sitten mukaan tuli PHP ja backendin ohjelmointi. PHP:llä tekeminen on ollut tähän asti ehkä miellyttävin ohjelmointikieli mihin olen törmännyt. Monet eivät tykkää siitä ja sen 
            syntaksista, mutta koska se tuli minulle vastaan aikalailla alussa, eikä minulla ollut kokemusta kovinkaan monesta eri kielestä, en osannut näistä asioista valittaa. Enkä kyllä valita 
            nytkään vaikka olen tutustunut jo moniin muihinkin eri ohjelmointikieliin. Tämän sivuston ensimmäinen suurempi päivitys tuli, kun aloitin PHP:n opettelemisen. Minun piti muuttaa kaikki aikaisempi koodini hyödyntämään PHP:tä. 
            Tällöin minä ensimmäistä kertaa poistin useita projektejani sivustolta.
            <br><br>
            Nyt tätä tekstiä kirjoittaessa olen saanut suoritettua suuren ulkoasun päivityksen sivustolleni. Minulla on edelleen vanhan sivuston lähdekoodi tallessa ja vaikka tällä uudella sivustolla on omat vikansa ja ongelmansa, kun vertailen 
            vanhaa ja uutta niin olen erittäin tyytyväinen lopputulokseeni. Tämä ei kuitenkaan tarkoita ettenkö aikoisi jatkaa tämän sivuston tekemistä. 
            Olen varma, että tulen tekemään tänne jatkossa vielä monia projekteja. Luultavasti joudun myös useamman kerran päivittämään sivun kokonaan,
             niinkuin olen nytkin tehnyt. Mutta pidän tämän sivun kehittämisestä ja oppimiseni kannalta tällä on ollut ja tulee olemaan iso rooli.

        </p>
    </div>
    <div class="container col-8 col-lg-5 bg-dark bg-gradient p-5 mt-5 text-light">
        <h3 class="mb-3">Mitä projekteja sivustolta löytyy tällä hetkellä?</h3>
        <h6>Klikkaamalla otsikoita pääset projektin sivulle. Lisäksi linkit projekteihin löytyy myös navigaatiopalkista ylhäällä.</h6>
        <br>
        <h6>Klikkaamalla Github-linkistä projektejen otsikon vieressä, pääset katsomaan Githubista löytyvää repoa, jossa on lähdekoodit.</h6>

        <ul>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="#">Sivusto itsessään</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Sivusto itsessään on projekti, joka pitää sisällään toisia projekteja. Esimerkiksi kirjautumis/rekisteröitymis toiminto on osa sivustoa ja se vaikuttaa useampaan alempana
                    olevaan projektiin.
                </p>
                <ul>
                    <li>Kirjautuminen ja rekisteröityminen</li>
                    <li>Sivujen välillä liikkuminen</li>
                    <li>Lähes kaikki lomakkeet sivustolla validoidaan ensin clientin puolella jQueryllä ja validointi menee läpi, 
                        validoidaan lomakkeen kentät vielä serverin puolellakin ennenkuin ne tallennetaan tietokantaan tai tiedostoon</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/pelikone/slotmachine.php">Pelikone</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/pelikone">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Tämä oli yksi ensimmäisitä projekteistani, missä hyödynsin jQueryä. Tämä on oiva esimerkki siitä, miten aluksi en käyttänyt tarpeeksi aikaa bootstrapin harjoitteluun 
                    ja jälkikäteen en ole jaksanut sivun ulkoasua päivittää, koska jollain kierolla tavalla tykkään siitä miltä se näyttää tällä hetkellä.
                    Kuvat olen itse piirtänyt paint:issä, joten toivon että ette siitä anna miinusta ulkoasulle :)
                </p>
                <ul>
                    <li>Panoksen valinta</li>
                    <li>Kolikoiden määrän vaihtaminen käyttöliittymässä reaaliajassa</li>
                    <li>Kuvien esittäminen käyttöliittymässä sekä niiden vaihtaminen kun käyttäjä pyöräyttää</li>
                    <li>Voiton lasku ja sen lisääminen kolikoiden määrän tai jos käyttäjä ei voita panoksen miinustus kolikoista</li>
                    <li>Rullien lukitseminen ja niiden säännöt eli milloin käyttäjä voi lukita rullia, milloin ei voi lukita rullia ja monta rullaa voi lukita</li>
                    <li>Pyöräyttämiseen aikalukitus, jotta käyttäjä ei voi klikkailla vain pyöritystä nopeasti</li>
                    <li>Kaikkien ilmoitusten esittäminen käyttäjän käyttöliittymässä</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/sikanoppa/pigdice.php">Sikanoppa</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/sikanoppa">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Sikanoppa peli kahdelle pelaajalle. Toinen projektini, minkä toteutin alunperin pelkällä javascriptillä, mutta myöhemmin päivitin sen toimimaan jQueryllä.</p>
                <ul>
                    <li>Pelaajat voivat vaihtaa sääntöjä</li>
                    <li>Kun käyttäjä heittää noppia näytetään numeroiden mukaiset nopat käyttöliittymässä</li>
                    <li>Sikanoppa pelin sääntöjen mukainen toiminta eli milloin vaihtuu vuoro yms.</li>
                    <li>Kun toisen pelaajan pisteet ovat saman verran tai ylittävät voittoon vaaditun pistemäärän ilmoitetaan siitä suoraan. Eli käyttäjän ei tarvitse painaa hold-nappia voittaakseen.</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/projects/projects.php">Projektien tallennus</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/projects">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Tämän projektin tarkoituksena oli tutustua XML-tiedostojen kanssa toimimiseen.</p>
                <ul>
                    <li>Sivu, jolle haetaan XML-tiedostosta tallennetut projektit ja esitetään ne käyttäjälle</li>
                    <li>Projektit on mahdollista piilottaa kaikilta muilta paitsi admineilta</li>
                    <li>Admin voi lisätä uusia projekteja käyttöliittymän kautta, jotka tallennetaan XML-tiedostoon</li>
                    <li>Admin voi muokata olemassa olevia projekteja käyttöliittymän kautta ja muutokset tallennetaan XML-tiedostoon vanhojen tietojen tilalle</li>
                    <li>Admin voi poistaa projekteja käyttöliittymän kautta, jolloin ne poistetaan XML-tiedostosta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/vieraskirja/guestbook.php">Vieraskirja</a><a class="ms-5 text-light" href="">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Tämän projektin tein, kun harjoittelin tietokantaan tallentamista, sieltä tiedon hakemista sekä sen esittämistä käyttäjän käyttöliittymässä ja tietokannasta poistamista käyttöliittymän kautta</p>
                <ul>
                    <li>Käyttäjä voi lähettää vieraskirjaan viestin, joka tallennetaan tietokantaan</li>
                    <li>Jos käyttäjä on kirjautunut tulee lomakkeen nimi-kenttään automaattisesti käyttäjän nimi, mutta käyttäjä voi itse vaihtaa sen jos ei halua lähettää, sillä nimellä viestiä</li>
                    <li>Käyttäjien lähettämät viestit näytetään kaikille</li>
                    <li>Admin voi poistaa viestejä tietokannasta käyttöliittymän kautta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/chatti/livechat.php">Chatti</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/vieraskirja">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Tämän projektin päätarkoitus oli harjoitella sivun vain yhden osan automaattista päivittämistä. 
                    En tehnyt tätä alunperin osaksi tätä sivustoa, jonka takia aulassa valitaa ensin ollaanko vieraita vai mennäänkö chattiin salasanan kanssa adminina.
                </p>
                <ul>
                    <li>Tietokannasta haetaan kaikki viestit ja ne esitetään käyttäjälle käyttöliittymässä</li>
                    <li>Jos vieras laittaa viestin, pitää admin hyväksyä se ennen kuin se näytetään muille käyttäjille</li>
                    <li>Jos viesti on piilotettu lukee siinä vieraille, että admin ei ole sitä vielä hyväksynyt</li>
                    <li>Admin voi myöhemmin myös piilottaa viestejä, jos haluaa</li>
                    <li>Admin voi poistaa viestejä</li>
                    <li>Käyttöliittymän chatti osuus päivittyy automaattisesti kolmen sekunnin välein. Tällöin haetaan viestit tietokannasta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="#">CodeIgniter-sivusto</a><a class="ms-5 text-light" href="https://github.com/Pattuu/CodeIgniter">Github<i class="bi bi-github"></i></a></p>
                <span>Tämä projekti ei valitettavasti ole missään pystyssä, joten sitä ei pääse kuin minun koneeltani käyttämään.</span>
                <p class="mb-0">Tämä ei ole tämän sivuston projekti, mutta lisään tänne selityksen kuitenkin. 
                    Tämä on ensimmäinen pieni tutustumisprojektini, kun aloitin harjoittelemaan CodeIgniter:in käyttöä. Tänne on erillinen kirjautumis/rekisteröitymis-järjestelmä.</p>
                <ul>
                    <li>Kirjautuminen/rekisteröityminen</li>
                    <li>Blogi, jossa näytetään käyttäjien lisäämät postaukset</li>
                    <li>Käyttäjät voivat upvotea tai downvotea postauksia, mutta yksi käyttäjä voi äänestää vain kerran per postaus</li>
                    <li>Käyttäjät voivat kommentoida toisten postauksia</li>
                    <li>Käyttäjät voivat muokata tai poistaa omia postauksiaan ja kommenttejaan</li>
                    <li>Käyttäjät voivat lisätä uusia kategorioita ja voivat valita kategorioita postauksilleen</li>
                    <li>Bugien seuranta, joka toimii melkein samalla tavalla kuin blogikin</li>
                    <li>Bugien kategoriat, jotka toimii samalla tavalla kuin blogin kategoriat</li>
                    <li>Bugeilla on muutama asia, jotka vaikuttavat miten ja missä ne esitetään käyttäjälle, mutta muuten oikeastaan samanlainen kuin blogikin</li>
                </ul>
            </li>
            <li>
                <p class="mt-5">Siinä on muutama projektini lueteltuna ja täällä sivustolla niihin pääsee tutustumaan paremmin, mutta olen tehnyt todella paljon muitakin pienimpiä ja myös vähän suurempia projekteja. Joitain projekteja minulla ei enää ole tai en voi niitä esitellä täällä sivustolla.
            </li>
        </ul>
    </div>

</main>





<?php require_once "inc/incfiles/footer.php"; ?>
</body>
</html>