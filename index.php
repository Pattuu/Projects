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
                        <a class="btn btn-primary" href="reg.php" role="button">Rekister??idy</a>
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
        <p>T????lt?? l??ytyy joitakin tekemi?? projekteja. Osan olen tehnyt opiskelujen takia ja toiset taas omalla vapaa-ajalla oppiakseni.
            <br><br>
            Itseasiassa t??m??n sivuston olen alunperin tehnyt kouluprojektina. Kaikki l??hti siit??, kun aloitin web-ohjelmoinnin opettelun ja tein ensimm??isen staattisen sivuni.
            Siit?? l??htien olen tehnyt t??lle sivustolle eri projekteja. Aluksi tein staattisia sivuja, joilla opettelin html:n ja css:n alkeet, hiljalleen siirtyen responsiivisuuteen ja 
            saavutettavuuteen liittyviin asioihin.
            Seuraavaksi mukaan tuli javascript ja sill?? tein aluksi pieni?? projekteja, kuten lomakkeen validointia ja erilaisten laskureiden tekoa. N??m?? projektit olen jo aikoja sitten poistanut sivustolta 
            vaikka j??lkik??teen olen ajatellut, ett?? olisi ollut ihan mukava idea tehd?? arkistosivu niille projekteille, joita olisin voinut sitten tulevaisuudessa katsella.
            <br><br>
            Kehitys jatkui ja otin mukaan jQueryn ja bootstrapin. Sivustoni alkoi hiljalleen saamaan toimivuutta. Olen aina pit??nyt eri toiminnallisuuksien toteuttamisesta ja alussa se veikin suurimman osan keskittymisest??ni. J??lkik??teen ajatellen olisin voinut jo opetteluni alussa voinut k??ytt???? 
            enemm??n aikaa css:n ja etenkin bootstrapin harjoitteluun. Olen kuitenkin niidenkin osalta tajunnut my??hemmin skarpata. Vaikka olenkin yritt??nyt t??m??n sivuston ulkoasua parantaa, on selv??sti 
            n??ht??viss?? viel?? ongelmia, jotka olen sivuston alkuaikoina aiheuttanut, kun en esimerkiksi k??ytt??nyt bootstrappia niin paljon kuin olisi pit??nyt. 
            <br><br>
            Sitten mukaan tuli PHP ja backendin ohjelmointi. PHP:ll?? tekeminen on ollut t??h??n asti ehk?? miellytt??vin ohjelmointikieli mihin olen t??rm??nnyt. Monet eiv??t tykk???? siit?? ja sen 
            syntaksista, mutta koska se tuli minulle vastaan aikalailla alussa, eik?? minulla ollut kokemusta kovinkaan monesta eri kielest??, en osannut n??ist?? asioista valittaa. Enk?? kyll?? valita 
            nytk????n vaikka olen tutustunut jo moniin muihinkin eri ohjelmointikieliin. T??m??n sivuston ensimm??inen suurempi p??ivitys tuli, kun aloitin PHP:n opettelemisen. Minun piti muuttaa kaikki aikaisempi koodini hy??dynt??m????n PHP:t??. 
            T??ll??in min?? ensimm??ist?? kertaa poistin useita projektejani sivustolta.
            <br><br>
            Nyt t??t?? teksti?? kirjoittaessa olen saanut suoritettua suuren ulkoasun p??ivityksen sivustolleni. Minulla on edelleen vanhan sivuston l??hdekoodi tallessa ja vaikka t??ll?? uudella sivustolla on omat vikansa ja ongelmansa, kun vertailen 
            vanhaa ja uutta niin olen eritt??in tyytyv??inen lopputulokseeni. T??m?? ei kuitenkaan tarkoita ettenk?? aikoisi jatkaa t??m??n sivuston tekemist??. 
            Olen varma, ett?? tulen tekem????n t??nne jatkossa viel?? monia projekteja. Luultavasti joudun my??s useamman kerran p??ivitt??m????n sivun kokonaan,
             niinkuin olen nytkin tehnyt. Mutta pid??n t??m??n sivun kehitt??misest?? ja oppimiseni kannalta t??ll?? on ollut ja tulee olemaan iso rooli.

        </p>
    </div>
    <div class="container col-8 col-lg-5 bg-dark bg-gradient p-5 mt-5 text-light">
        <h3 class="mb-3">Mit?? projekteja sivustolta l??ytyy t??ll?? hetkell???</h3>
        <h6>Klikkaamalla otsikoita p????set projektin sivulle. Lis??ksi linkit projekteihin l??ytyy my??s navigaatiopalkista ylh????ll??.</h6>
        <br>
        <h6>Klikkaamalla Github-linkist?? projektejen otsikon vieress??, p????set katsomaan Githubista l??ytyv???? repoa, jossa on l??hdekoodit.</h6>

        <ul>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="#">Sivusto itsess????n</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Sivusto itsess????n on projekti, joka pit???? sis??ll????n toisia projekteja. Esimerkiksi kirjautumis/rekister??itymis toiminto on osa sivustoa ja se vaikuttaa useampaan alempana
                    olevaan projektiin.
                </p>
                <ul>
                    <li>Kirjautuminen ja rekister??ityminen</li>
                    <li>Sivujen v??lill?? liikkuminen</li>
                    <li>L??hes kaikki lomakkeet sivustolla validoidaan ensin clientin puolella jQueryll?? ja validointi menee l??pi, 
                        validoidaan lomakkeen kent??t viel?? serverin puolellakin ennenkuin ne tallennetaan tietokantaan tai tiedostoon</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/pelikone/slotmachine.php">Pelikone</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/pelikone">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">T??m?? oli yksi ensimm??isit?? projekteistani, miss?? hy??dynsin jQuery??. T??m?? on oiva esimerkki siit??, miten aluksi en k??ytt??nyt tarpeeksi aikaa bootstrapin harjoitteluun 
                    ja j??lkik??teen en ole jaksanut sivun ulkoasua p??ivitt????, koska jollain kierolla tavalla tykk????n siit?? milt?? se n??ytt???? t??ll?? hetkell??.
                    Kuvat olen itse piirt??nyt paint:iss??, joten toivon ett?? ette siit?? anna miinusta ulkoasulle :)
                </p>
                <ul>
                    <li>Panoksen valinta</li>
                    <li>Kolikoiden m????r??n vaihtaminen k??ytt??liittym??ss?? reaaliajassa</li>
                    <li>Kuvien esitt??minen k??ytt??liittym??ss?? sek?? niiden vaihtaminen kun k??ytt??j?? py??r??ytt????</li>
                    <li>Voiton lasku ja sen lis????minen kolikoiden m????r??n tai jos k??ytt??j?? ei voita panoksen miinustus kolikoista</li>
                    <li>Rullien lukitseminen ja niiden s????nn??t eli milloin k??ytt??j?? voi lukita rullia, milloin ei voi lukita rullia ja monta rullaa voi lukita</li>
                    <li>Py??r??ytt??miseen aikalukitus, jotta k??ytt??j?? ei voi klikkailla vain py??rityst?? nopeasti</li>
                    <li>Kaikkien ilmoitusten esitt??minen k??ytt??j??n k??ytt??liittym??ss??</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/sikanoppa/pigdice.php">Sikanoppa</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/sikanoppa">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">Sikanoppa peli kahdelle pelaajalle. Toinen projektini, mink?? toteutin alunperin pelk??ll?? javascriptill??, mutta my??hemmin p??ivitin sen toimimaan jQueryll??.</p>
                <ul>
                    <li>Pelaajat voivat vaihtaa s????nt??j??</li>
                    <li>Kun k??ytt??j?? heitt???? noppia n??ytet????n numeroiden mukaiset nopat k??ytt??liittym??ss??</li>
                    <li>Sikanoppa pelin s????nt??jen mukainen toiminta eli milloin vaihtuu vuoro yms.</li>
                    <li>Kun toisen pelaajan pisteet ovat saman verran tai ylitt??v??t voittoon vaaditun pistem????r??n ilmoitetaan siit?? suoraan. Eli k??ytt??j??n ei tarvitse painaa hold-nappia voittaakseen.</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/projects/projects.php">Projektien tallennus</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/projects">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">T??m??n projektin tarkoituksena oli tutustua XML-tiedostojen kanssa toimimiseen.</p>
                <ul>
                    <li>Sivu, jolle haetaan XML-tiedostosta tallennetut projektit ja esitet????n ne k??ytt??j??lle</li>
                    <li>Projektit on mahdollista piilottaa kaikilta muilta paitsi admineilta</li>
                    <li>Admin voi lis??t?? uusia projekteja k??ytt??liittym??n kautta, jotka tallennetaan XML-tiedostoon</li>
                    <li>Admin voi muokata olemassa olevia projekteja k??ytt??liittym??n kautta ja muutokset tallennetaan XML-tiedostoon vanhojen tietojen tilalle</li>
                    <li>Admin voi poistaa projekteja k??ytt??liittym??n kautta, jolloin ne poistetaan XML-tiedostosta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/vieraskirja/guestbook.php">Vieraskirja</a><a class="ms-5 text-light" href="">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">T??m??n projektin tein, kun harjoittelin tietokantaan tallentamista, sielt?? tiedon hakemista sek?? sen esitt??mist?? k??ytt??j??n k??ytt??liittym??ss?? ja tietokannasta poistamista k??ytt??liittym??n kautta</p>
                <ul>
                    <li>K??ytt??j?? voi l??hett???? vieraskirjaan viestin, joka tallennetaan tietokantaan</li>
                    <li>Jos k??ytt??j?? on kirjautunut tulee lomakkeen nimi-kentt????n automaattisesti k??ytt??j??n nimi, mutta k??ytt??j?? voi itse vaihtaa sen jos ei halua l??hett????, sill?? nimell?? viesti??</li>
                    <li>K??ytt??jien l??hett??m??t viestit n??ytet????n kaikille</li>
                    <li>Admin voi poistaa viestej?? tietokannasta k??ytt??liittym??n kautta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="projektit/chatti/livechat.php">Chatti</a><a class="ms-5 text-light" href="https://github.com/Pattuu/Projects/tree/master/projektit/vieraskirja">Github<i class="bi bi-github"></i></a></p>
                <p class="mb-0">T??m??n projektin p????tarkoitus oli harjoitella sivun vain yhden osan automaattista p??ivitt??mist??. 
                    En tehnyt t??t?? alunperin osaksi t??t?? sivustoa, jonka takia aulassa valitaa ensin ollaanko vieraita vai menn????nk?? chattiin salasanan kanssa adminina.
                </p>
                <ul>
                    <li>Tietokannasta haetaan kaikki viestit ja ne esitet????n k??ytt??j??lle k??ytt??liittym??ss??</li>
                    <li>Jos vieras laittaa viestin, pit???? admin hyv??ksy?? se ennen kuin se n??ytet????n muille k??ytt??jille</li>
                    <li>Jos viesti on piilotettu lukee siin?? vieraille, ett?? admin ei ole sit?? viel?? hyv??ksynyt</li>
                    <li>Admin voi my??hemmin my??s piilottaa viestej??, jos haluaa</li>
                    <li>Admin voi poistaa viestej??</li>
                    <li>K??ytt??liittym??n chatti osuus p??ivittyy automaattisesti kolmen sekunnin v??lein. T??ll??in haetaan viestit tietokannasta</li>
                </ul>
            </li>
            <li>
                <p class="fw-bold mb-0 mt-5"><a class="text-light" href="#">CodeIgniter-sivusto</a><a class="ms-5 text-light" href="https://github.com/Pattuu/CodeIgniter">Github<i class="bi bi-github"></i></a></p>
                <span>T??m?? projekti ei valitettavasti ole miss????n pystyss??, joten sit?? ei p????se kuin minun koneeltani k??ytt??m????n.</span>
                <p class="mb-0">T??m?? ei ole t??m??n sivuston projekti, mutta lis????n t??nne selityksen kuitenkin. 
                    T??m?? on ensimm??inen pieni tutustumisprojektini, kun aloitin harjoittelemaan CodeIgniter:in k??ytt????. T??nne on erillinen kirjautumis/rekister??itymis-j??rjestelm??.</p>
                <ul>
                    <li>Kirjautuminen/rekister??ityminen</li>
                    <li>Blogi, jossa n??ytet????n k??ytt??jien lis????m??t postaukset</li>
                    <li>K??ytt??j??t voivat upvotea tai downvotea postauksia, mutta yksi k??ytt??j?? voi ????nest???? vain kerran per postaus</li>
                    <li>K??ytt??j??t voivat kommentoida toisten postauksia</li>
                    <li>K??ytt??j??t voivat muokata tai poistaa omia postauksiaan ja kommenttejaan</li>
                    <li>K??ytt??j??t voivat lis??t?? uusia kategorioita ja voivat valita kategorioita postauksilleen</li>
                    <li>Bugien seuranta, joka toimii melkein samalla tavalla kuin blogikin</li>
                    <li>Bugien kategoriat, jotka toimii samalla tavalla kuin blogin kategoriat</li>
                    <li>Bugeilla on muutama asia, jotka vaikuttavat miten ja miss?? ne esitet????n k??ytt??j??lle, mutta muuten oikeastaan samanlainen kuin blogikin</li>
                </ul>
            </li>
            <li>
                <p class="mt-5">Siin?? on muutama projektini lueteltuna ja t????ll?? sivustolla niihin p????see tutustumaan paremmin, mutta olen tehnyt todella paljon muitakin pienimpi?? ja my??s v??h??n suurempia projekteja. Joitain projekteja minulla ei en???? ole tai en voi niit?? esitell?? t????ll?? sivustolla.
            </li>
        </ul>
    </div>

</main>





<?php require_once "inc/incfiles/footer.php"; ?>
</body>
</html>