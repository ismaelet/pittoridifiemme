<x-layouts.main header-color="dark">
    @push('assets')
        @vite(['resources/css/pages/home.css', 'resources/js/pages/home.ts'])
    @endpush

    <div id="load-cont" class="bgr-c1">
        <div id="load-ico"></div>
    </div>

    <div class="bgr" style="background-image: url({{ Vite::image('home/bgr.jpg') }});"></div>

    <div id="body">
        <section id="artists-sec">
            <div class="anchor" id="art"></div>

            <div class="wrap pado4">
                <h1 id="artists-title" class="txt-lef inlb load ld-rig">
                    P<span class="txt-thin">ittori di </span>F<span class="txt-thin">iemme</span>
                </h1>

                <div id="title-line" class="line mart5px marb3 load ld-lef ld-del3"></div>

                <div id="artists" class="grid-flow" data-columns="15rem" data-column-spacing="400">
                    @foreach ($artists as $artist)
                        <div class="artist-box marb2 load ld-bot ld-del{{ $loop->index % 5 }}">
                            <a class="artist blk" href="{{ url('/artist?id='.$artist->ID) }}">
                                <div
                                    class="artist-img"
                                    style="background-image: url({{ $artist->images->first()->mediumUrl() }});"
                                ></div>

                                <div class="art-data">
                                    <h1 class="art txt-11rem">{{ $artist->full_name }}</h1>
                                    <p class="art-desc txt-09rem txt-ita txt-aaa">{{ $artist->details }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="sect_hist">
            <div class="achor" id="hist"></div>
            <div>
                <h1 id="titl_hist" class="txt-bold txt-aaa load ld-bot">La Scuola Pittorica di Fiemme</h1>

                <div class="bgr-wht">
                    <p id="hist-txt" class="load ld-bot ld-del3">
                        Tra gli avvenimenti storico-artistici più rilevanti del XVII secolo si ricorda la nascita della
                        Scuola pittorica di Fiemme, caso unico in tutto il Trentino per formazione, diffusione
                        geografica dei discepoli e qualità dei contributi.<br />
                        Il suo primo importante precursore fu Orazio Giovanelli ( 1588 ca- 1639ca) componente di una
                        facoltosa famiglia di Notai della Valle di Fiemme, seguito da Zeni Antonio ( 1606-1690).<br />
                        Il consolidamento dell'economia locale diede vita ad un crescente interesse, in termini di
                        collezionismo, verso le opere d'arte: nel XVII secolo le commissioni di alcuni signorotti della
                        zona diventarono infatti sempre più numerose ed esigenti. Cristoforo Unterperger, commerciante
                        di legname e padre di quella stupenda generazione di pittori d'indiscussa fama e prestigio, si
                        avvicinò all'arte sia come decoratore sia come collezionista.<br />
                        Ma il vero promotore della scuola fu Giuseppe Alberti (1640-1716), originario di Tesero, che
                        dopo alcuni anni di apprendistato a Venezia nella bottega di Pietro Liberi (1605-1687), aggiornò
                        il proprio linguaggio a Roma, dove scoprì la tecnica dell’affresco e acquisì nozioni di
                        architettura. Ricevette importanti commissioni, come pittore e architetto, dal principe vescovo
                        di Trento Francesco Alberti Poja (1610-1689). Tra queste gli affreschi della Giunta albertiana
                        al Castello del Buonconsiglio, e il progetto della monumentale Cappella del Crocefisso nel duomo
                        cittadino. La morte dell’illustre mecenate e l’avanzare dell’età suggerirono all’Alberti il
                        ritorno in patria.<br />
                        A Cavalese aprì la propria casa a giovani desiderosi di apprendere l’arte pittorica. Tra questi
                        si annoverano don Martino Gabrielli di Moena (1681-1742), Domenico Bonora (1685-1758) e
                        Michelangelo Unterperger (1695-1758), entrambi di Cavalese, e l’altoatesino Paul Troger
                        (1698-1762).<br />
                        Alla morte del maestro, avvenuta nel 1716, la scuola non cessò di esistere ma venne
                        continuamente aggiornata dai fratelli Unterperger, Francesco Sebaldo e Michelangelo. Si deve
                        soprattutto al genio di quest’ultimo la fama della famiglia: attivo principalmente in territorio
                        austriaco, nel 1751 venne nominato rettore dell’Accademia delle Arti figurative a Vienna.<br />
                        Gli allievi forgiati nell'atelier dell'Alberti portarono avanti, rinnovandola, la tradizione
                        figurativa del maestro, che poneva le proprie fondamenta nel tardo manierismo veneziano.<br />
                        La persona che venne maggiormente avvantaggiata da questo importante ruolo fu il nipote
                        Cristoforo Unterperger (1732-1798) che frequentò per alcuni anni l’istituto. Nel 1757 si
                        trasferì a Roma presso la corte papale, dove fu uno tra i più grandi promotori del
                        neoclassicismo. Altra importante personalità della scuola fiemmese fu Valentino Rovisi
                        (1715-1783) di Moena che durante due soggiorni veneziani conobbe, verosimilmente frequentandone
                        la bottega, Giambattista Tiepolo (1696-1770).<br />
                        L’attività della scuola tra la fine del Settecento e l’inizio del secolo successivo fu legata ad
                        Antonio Longo (1742-1820) e ai pittori Vanzo. Il primo affiancò i fratelli Ignazio e Cristoforo
                        Unterperger a Roma per un lungo periodo. Tornato in valle dopo il 1798, divenne vice parroco a
                        Varena e continuò la sua carriera di pittore a fresco e su tela.<br />
                        I Vanzo vengono ricordati come una famiglia di copisti, ispirati da artisti di livello
                        internazionale e dai loro predecessori della tradizione fiemmese, in particolare dagli
                        Unterperger.<br />
                        Attualmente il nucleo più significativo di questa straordinaria tradizione pittorica si conserva
                        negli ambienti restaurati del Palazzo della Magnifica Comunità di Fiemme. Tale allestimento
                        soddisfa il desiderio anelato da alcuni degli stessi artisti della scuola fiemmese, tra questi
                        Carlo Vanzo (1824-1893) che nel suo testamento, datato 29 ottobre 1893, riporta quanto segue:
                        “…Riguardo ai dipinti (…) sarebbe un onor per la Valle di Fiemme se ci fosse una raccolta (…)
                        dei migliori artisti di detta Valle, conservata nei locali della Comunità Generale (oggi
                        Magnifica Comunità di Fiemme)”. ( a cura di Francesca Dagostin e Roberto Daprà)
                    </p>
                </div>
            </div>
        </section>

        <section id="sect_cred">
            <div class="wrap">
                <p class="cred">
                    Curatore <strong>Giacomo Dellasega</strong><br />
                    <a href="http://www.palazzomagnifica.eu/" target="_blank">http://www.palazzomagnifica.eu/</a><br />
                    <a href="http://storiadifiemme.it/" target="_blank">http://storiadifiemme.it/</a><br /><br />

                    Sito web realizzato da Ismaele Tuffanelli<br />
                    <a class="link txt-reg" href="mailto:ismaele.tuffanelli@gmail.com">ismaele.tuffanelli@gmail.com</a>
                </p>
            </div>
        </section>
    </div>
</x-layouts.main>
