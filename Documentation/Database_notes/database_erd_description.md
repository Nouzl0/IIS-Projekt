# Popis use-case-diagramu

### Stručný opis
Opis Databázy používaný webovou aplikáciou DPMB

## Akcie use-case diagramu
#### Linka
- Entita Linka reprezentuje pravidelnú dopravu DPMB na určenej trase/trás 
- Aby sme mohli popísať reálnu mestskú dopravu, je zaužívané používať linky pri MHD takže potrebujeme tieto dáta aj dať zákazníkom.
- Vlasnosti Číslo linky a Typ vozidla reprezentuje linku ktorá je používaná pri zobrazovaní detailov spoja

#### Trasa
- Trasa reprezentuje spoj, tieto spoje potom tvoria linku napríklad Linka môže byť tvoréná dvoma Trasami tam a naspeť, trasa je vytvorená pre segemntáciu linky, niekedy linku môžu tvoriť viaceré trasy podľa času a zamestnanca, táto segmentácia tiež umožnuje brať do uvahy napríklad dlhšie prestávky na konkrétny zastávkach
- Keď uživatel bude vyhladávať trasu z miesta A do miesta B tak toto sú tie trasy ktoré sa mu budu zobrazovať, nedáva zmysel ukázať celú linku.
- Vlasnosti Meno trasy a Informácie o trase sú len informácie ktoré len špecifikujú trasu. 

#### Plánovaný spoj
- Na určitej trase plánujeme pravidelné spoje.
- V určitý čas a dátum začíname jazdu po trase. 
- Je identifikovaný s databáze podľa jeho ID
- Enitita Aktívna trasa nám ukazuje aktuálne informácie o meškaní, nasledujúcej a posledne navštívenej zastávke.
- Môže nastať situácia že plánovaný spoj bude zrušený kvôli technickým problémom dopravného vozidla alebo trasy. Preto chceme vedieť kedy bol spoj zrušený a z akého dôvodu.
- Entity Aktívny spoj a Zrušený spoj dedia vlastnosti entity Plánovaný spoj.

#### Úsek trasy
- Úsek trasy reprezentuje úsek špecifickej trasy s tým že ten istý úsek môže byť dva viac krát na tej istej trase
- Entita je identifikovatelná cez (ID Úsek-trasy) kompozitný klúč skladajúci sa s klúčov Číslo trasy, ID Úsek a unikátneho čísla. Toto unikátne číslo existuje kvôli tomu že ten istý úsek môže byť viacero-krát na tej istej trase.
- Poradie trasy nám umožňuje zistiť v akom poradí úseky a zástavky pôjdu za sebou na trase. Poradie trasy tiež umožňuje cez rýchly výpočet kedy vozidlo na jeho trase príde na určitú zastávku.
#### Úsek
- Vzdialenosť medzi dvoma zástavkami. V entite úsek sú zapísané iba unikátne úseky ktorý tvoria zoznam všetkých existujúcich úsekov.
- Cez dáta v tejto entite je webová aplikácia schopná výhladať najrýchlešiu cestu/cesty z miesta A do miesta B. Úseky dokopy tvoria graf cez ktorý sme schopný nájsť tieto cesty.
- Vlasnosti Odkiaľ (zastávka) a Kam (zastávka) nám hovoria o smere úseku
- Vlasnosti časová dĺžka a dĺžka úseku umožnujú webovej aplikácií dopočítať dľžku rôznych trás alebo ale aj dĺžku zo zastávky na zastávku na určitej trase.

#### Zastávka
- Miesto kde pravidelne zastavujú prostriedky hromadnej dopravy.
- Na každej zastávke ma hromadná doprava čakaciu dobu pokiaľ cestujúci nastúpia a vystúpia, meno zastávky a jej presnú polohu

#### Pásmo
- Mesto je rozdelené na viaceré zóny, pásma platnosti lístkov. v pásmo je zložené zo zastávok. Pre každé pásmo je potrebné si zakúpiť variantu lístka. 
- Primárny kľúč je jeho ID a má vlastný názov.

#### Varianta lístku
- Rozlišujeme rôzne varianty lístka podľa dĺžky platnosti, (napr. 15min, 30min). 
- Primárny kľúč je ID varianty lístka. Každý lístok platí v určitom pásme, má svoju dĺžku platnosti a svoju cenu.

#### Profil uživateľa
- Každý uživateľ má vlastný profil. 
- Identifakačný kľúč profilu je e-mail. O každom uživatel musí zadať do systému jeho údaje ako meno, prezvisko, telefónne číslo a jeho heslo k profilu. 
- Keď uživateľ patrí do skupiny ľudí ktorí majú právo na zľavnené cestovné tak si po overení podmienok môže kupovať lístky za zľavnené ceny.
  
#### Zakúpený lístok
- Registrovaný uživateľ si vie zakúpiť lístky v systéme. 
- Zakúpené lístky rozlišujeme podľa ID lístka a uchovávame ich cenu, dátum zakúpenia a dátum vypršania platnosti

