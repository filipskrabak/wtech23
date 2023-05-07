# WTECH - Dokumentácia k projektu

Vypracovali: Filip Škrabák, Patrik Prizbul, Samuel Krempaský

# Zadanie

Vytvorte webovú aplikáciu - eshop, ktorá komplexne rieši nižšie definované prípady použitia vo vami zvolenej doméne (napr. elektro, oblečenie, obuv, nábytok). Presný rozsah a konkretizáciu prípadov použitia si dohodnete s vašim vyučujúcim.****

**Téma projektu:** Obchod s oblečením

# Fyzicky dátový model

[https://dbdiagram.io/d/641ccebd296d97641d8a5e31](https://dbdiagram.io/d/641ccebd296d97641d8a5e31)


![Copy_of_Copy_of_Copy_of_WTECH_(1)](https://user-images.githubusercontent.com/36561335/236700522-be273381-9428-4987-bb4d-f0625a4a7eab.png)

### Zmeny v návrhu

V pôvodnom návrhu sme mali tabuľku “Variant”, ktorá reprezentovala jednotlivé produkty v databáze. Pre jednoduchosť sme túto tabuľku vypustili. Ešte sme pridali tabuľku “card_products”, kde sa nachádza tovar v košíku. Inak zostal návrh nezmenený.

# Návrhové rozhodnutia

## Adresa - vytváranie objednávky

Pri editácii konta sa overuje zadaná adresa, tak aby sa nachádzala v databáze. Pokiaľ sa nenachádza, vráti to užívateľovi chybu. Avšak v prípade košíka, uvažovali sme s prípadom, kedy užívateľ zadá adresu, ktorá nie je v zozname. Nakoľko by sme neradi prišli o takéhoto zákazníka, web mu túto adresu akceptuje a dovolí vytvoriť objednávku. Vďaka dátovému modelu, kde ku každej objednávke ukladáme aj adresu objednávky ako text, môžeme uložiť akúkoľvek adresu, aj ak sa nenachádza v DB. Aby sme však minimalizovali chybovosť, pridali sme suggestions. Pri písaní sa na pozadí po každej zmene odošle cez fetch API request na `/checkout/street` alebo `/checkout/postcode` a server vráti 10 suggestions z DB. Tie sa zobrazia užívateľovi a po kliknutí na jedno z nich sa tieto dáta vyplnia vo formulári.

Potom už ostáva na administrátorovi eshopu, aby raz za čas overil všetky adresy ktoré sa nenachádzajú v DB, či naozaj existujú a nie sú v DB, a ak naozaj existujú, môže ich do tejto DB pridať.

## Admin rola

Admin účet je riešený ako rola v databáze. 0 pre obyčajného používateľa a 1 pre admina. Pre oprávnenia sme vytvorili `UserPolicy` kde sa nachádza funkcia `admin(User)` . Tá vráti rolu používateľa, teda pre admina je to 1 ako `true` . Všetky endpoints sú verifikované pomocou `Auth\Middleware\Authorize::class` ktorý je implementovaný v laraveli a volá sa `middleware('can:admin, App\Models\User')` . Vložený `User` model sa automaticky spáruje s `UserPolicy` pomocou dodržiavania konvencií názvov. V prípade ak je potrebná verifikácia v `blade.php` súbore, používame `@can()` direktívu, napríklad pri zobrazovaní admin dashboard možnosti v profile menu.

## Admin panel

Administratíva bola vytváraná tak, aby sme čo najviac eliminovali chybovosť ľudského faktoru. Preto všetky tlačidlá sú rôznych farieb, podľa toho akú funkciu vykonávajú. Takisto každé tlačidlo obsahuje ikonku ktorá napovedá o aký prípad použitia ide a čo robí. Admin menu je tiež viditeľne oddelené od používateľského menu. 

![7ceb1dfbfec33844ead9b76657999521](https://user-images.githubusercontent.com/36561335/236700571-9c8c376f-cb91-42f2-af12-8c56d3cedbea.png)


# Opis implementácie vybraných prípadov použitia

## Zmena množstva pre daný produkt

Po kliknutí na tlačidlá +/- v košíku je volaná funkcia `increasePcs()` / `decreasePcs()`, ktoré načítajú aktuálny stav, zmenia ho podľa požiadavky a odošlú do funkcie `updateCart()`. Tá odošle požiadavku metódou `PUT` na endpoint `/cart/${productId}`.

Ak je response OK, volá funkciu `updateContent()` ktorá si cez fetch API načíta aktualizovaný obsah elementu `<main>` a ten na stránke aktualizuje.

Podobne pre tlačidlo X (odobratie produktu z košíka) je volaná funkcia `removeCartItem()`, ktorá volá endpoint `/cart/${id}?size=${size}` a ak je response OK, volá funkciu `updateContent()` .

## Prihlásenie

Na prihlásenie sme použili vlastné riešenie, namiesto Laravel Breeze. Implementovať ho nie je zložité, avšak treba myslieť na tokeny. Pri prihlásení treba použiť `regenerate()` . Pri odhlásení je potrebné token invalidovať a znova vygenerovať. Pri registrácií používame na zahashovanie hesla funkciu `bcrypt` ******.****** 

## Vyhľadávanie

Vyhľadávanie medzi produktmi je realizované priamo v `ProductsController` v `index` metóde. 

```php
if($searchReq) {
	$products = Product::query()->whereFullText(['name', 'description'], $searchReq);
}
```

Teda v prípade, že je prítomný GET parameter “search”, tak sa vyfiltrujú produkty pomocou full-text searchu v databáze. Hľadá sa v názvoch produktov a ich popise (description).

## Pridanie produktu do košíka

Po stlačení “Add to Cart” je formulár s počtom ks a vybranou veľkosťou odoslaný na `/cart/{{$product->id}}` . Tento request je spracovaný v `CartProductController`. Ten implementuje všetky metódy CRUD. Rozlišuje medzi prihláseným užívateľom a neprihláseným. Pre prihláseného vytvára nový objekt modelu `CartProduct` (resp. pripočítava k už existujúcemu) a ukladá do DB, pre neprihláseného vytvára tento objekt no ukladá ho od SessionStorage.

V prípade, že mal užívateľ niečo v košíku ako neprihlásený a potom sa prihlási, je volaná pri logine funkica `saveCart()` v `UserController`, ktorá prečíta Session Storage a produkty odtiaľ vloží do DB pre prihláseného užívateľa a následne vymaže Session Storage. Funkcia je volaná aj pri registrácii.

## Stránkovanie

Stránkovanie máme riešené cez `pagination` balík ktorý je dostupný v Laraveli. Teda v controlleroch len použijeme `paginate()` a vo views máme jednoduchý kód:

```php
{{ $products->withQueryString()->links() }}
```

`withQueryString()` zabezpečí, že pri prepínaní stránok sa zachovajú GET parametre, inak by sme naše filtre stratili.

## Základné filtrovanie

Filtrovanie sme riešili pomocou GET parametrov a select formulárov na stránke produktov. V dvoch `foreach` cykloch prechádzam filtre, ktoré sa nachádzajú v GET parametroch a filtre z databázy. Pokiaľ sa nezhodujú, tak stránka vyhodí chybu. Filtrovanie máme teda spravené dynamicky, do databázy je možné pridať nové atribúty a ich hodnoty (attribute values). 4 základné filtre sú hardcode-nuté do stránky a to sú pohlavie, kategória, veľkosť, farba. Taktiež je možné filtrovať na základe ceny od-do. 

Zoraďovať je možné od najnovšieho, najstaršieho, najnižšej ceny alebo najvyššej ceny.

## Editácia konta

Editácia konta pozostáva s dvoch častí. Prvá je zmena osobných údajov ako email, meno alebo adresa. Po kliknutí tlačidla na uloženie údajov sa zavolá funkcia `editDetails()` v `UserController` . Všetky údaje sú korektne validované pomocou `validate()` a všetky majú možnosť byť `nullable` . Je to preto aby si používateľ mohol vybrať ktoré údaje chce uložiť a ktoré nie. Pomocou `array_filter` sú potom `null` hodnoty vyfiltrované. Pri poštovom čísle a ulice sa overí či zadaná hodnota už existuje v databáze, aby používatelia vkladali len reálne hodnoty, nie náhodné slová.

Pri zmene hesla sa len overí či zadané hesla sú rovnaké, vytvorí sa z neho hash a uloží sa do databázy. Toto rieši funkcia `editPassword()`.

## Admin panel - products

Jednoduchá tabuľka ukazujúca všetky produkty ktoré sa nachádzajú v databáze. Admin má niekoľko možností ktoré môže vykonať. Veľké zelené tlačidlo nás prenesie na `/dashboard/products/create` , kde môže admin vytvoriť úplne nový produkt. Modré tlačidlo View prenesie admina na `/product/{product:slug}` , normálne zobrazenie produktu na stránke, ktoré sa ukazuje aj bežnému používateľovi. Žlté tlačidlo prenesie admina na `/dashboard/products/{product:slug}/edit` , kde môže editovať konkrétny produkt, pridať obrázky alebo zmeniť údaje. Posledné červené tlačidlo je na vymazanie produktu, ktoré zavolá `DELETE` metódu na `/dashboard/products/{product:slug}` . Tá sa postará o kompletné vymazanie produktu, aj s obrázkami, z databázy.

## Admin panel - users

V admin panely - users, je pri každom používateľovi tlačidlo na zmenu roli. Pri obyčajnom účte toto tlačidlo zmení účet s administratívnymi právami a opačne. Tieto tlačidlá sú samozrejme odlíšiteľné od seba pomocou farby a ikonky.  To zavolá funkciu `changeRole()` v `UserController` , ktorá inverzne rolu pre konkrétneho používateľa a uloží túto zmenu v databáze. V panely, pri zázname práve prihláseného admina, toto, a ani tlačidlo na odstránenie používateľa nie je.

# Snímky obrazoviek

## Detail produktu

![screencapture-82-208-16-43-product-red-hoodie-2023-05-07-10_35_34](https://user-images.githubusercontent.com/36561335/236700627-d5897d25-055b-45f6-be9f-fe6470cc4826.png)

## Prihlásenie

![screencapture-82-208-16-43-login-2023-05-07-10_36_27](https://user-images.githubusercontent.com/36561335/236700639-50085b26-a6ca-49c6-97d0-33ae9c5de186.png)

## Príklad vyhľadávania

![search](https://user-images.githubusercontent.com/36561335/236700653-a0d08c80-f054-4d1e-9fb5-9e9e0cd0ae1a.png)

## Homepage

![screencapture-82-208-16-43-2023-05-07-10_36_58](https://user-images.githubusercontent.com/36561335/236700658-e1abd8aa-9aac-4c9b-956f-bb0831cd44be.png)

## Nákupný košík s vloženým produktom

![screencapture-82-208-16-43-cart-2023-05-07-10_38_55](https://user-images.githubusercontent.com/36561335/236700674-67c15264-721d-4a44-86cb-30a4f24c8998.png)

## Základne filtrovanie (veľkosť S a čierna farba)

![filter](https://user-images.githubusercontent.com/36561335/236700687-6035ac46-a245-4a75-ad0b-334d57f7952a.png)

## Editácia konta

![edit](https://user-images.githubusercontent.com/36561335/236700694-bc2cddfa-d036-4c17-a03d-0fb91c32544b.png)

## Admin panel - products

![products](https://user-images.githubusercontent.com/36561335/236700703-84fd9cb3-9cb2-47ce-9d9b-01e2d6c3b2a8.png)

## Admin - edit product

![editpro](https://user-images.githubusercontent.com/36561335/236700711-73c39168-6106-4b2c-a01e-6c8bb0243185.png)

## Admin panel - users

![users](https://user-images.githubusercontent.com/36561335/236700718-e2f3a953-e0d6-4177-98d6-b1081a4f6978.png)
