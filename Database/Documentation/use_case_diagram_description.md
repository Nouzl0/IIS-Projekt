# Popis use-case-diagramu

## Akcie use-case diagramu
#### Registrovať sa
Pre užívateľov ktorý chcú nakupovať lístky na mobilnej aplikácií DPBM a nemajú účet DPBM musia sa zaregistrovať aby používali túto funkcionalitu.

#### Overiť totožnosť
Overenie totožnosti slúži pre identifikáciu užívateľa v databáze DPBM tak aby nedošlo k zneužitiu. Keby užívateľ tiež chcel využívať zľavy, musí navyše užívateľ dokázať svoju identitu cez identifikačný preukaz.
Takže napr. študent musí dokázať svoju totožnosť cez ISIC ak chce využiť študentské zľavy pri kúpe časového lístku.

#### Prihlásiť sa
Ak už užívateľ má overený účet v databáze DPBM tak sa môže prihlásiť a využiť rozšírenú funkcionalitu aplikácie DPBM. Ak sa užívateľ prihlásil raz tak si aplikácia zapamätá prihlasovacie údaje a automaticky ich doplní.

#### Pozrieť profil zákazníka
Ak je užívateľ prihlásený môže využiť túto funkcionalitu.
Užívateľ si môže prezrieť svoju históriu zakúpených lístkov.
Tiež si môže pozrieť aktívne časové lístky

#### Kúpiť časový lístok
Ak je užívateľ prihlásený môže využiť túto funkcionalitu.
Užívateľ si môže kúpiť časový lístok z variant ktoré bude DPBM poskytovať
Keby užívateľ chcel nakúpiť viacero lístkov napr. pre priateľa nemôže, časový lístok je priamo viazaný len na kupujúci účet DPBM.
Zľavy budú aplikované podľa účtu DPBM.

#### Overiť kúpu lístku
Ak užívateľ zaklikne na kúpu lístku tak prehodí na platiaci portál kde zaplatí cenu lístka. Po platbe centrála DPMB preverí či dostala zaplatenú platbu. Ak nákup prebehne úspešne, nákup sa zapíše do databázy DPMB

#### Vyhľadať trasu
Užívateľ si bude môcť vyhľadať spoj/cestu zo zástavky A do B.
Po tom čo boli zástavky vyplnené tak aplikácia nájde najrýchlejšie trasy. Trasy sa užívateľovi zobrazia do zoznamu. V zozname trás si užívateľ môže kliknúť na jednu z nich keby chcel vedieť viacej informácií.
Informácie o trasách/linkách/zástavkách budú uložené v databáze DPBM a z nich vytvorí spomenutý zoznam.

#### Pozrieť detaily spoja
Po tom čo si užívateľ zaklikol na jednu trasu tak sa mu ukážu detaily trasy, plánovaný odjazd/príjazd na zástavku, keby už spoj bol na ceste tak sa na aplikácií ukáže, kde sa nachádza, meškanie, čas príchodu. Keby bol spoj zrušený tak sa uživatelovi úkaže kedy bol zrušený a dôvod jeho zrušenia

![usecase](use_case_diagram_final.png)
