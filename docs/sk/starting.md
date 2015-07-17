# Nastavujeme prvú aplikáciu
## so skeletonom pri PSR-4

Po uspešnej inštalácií možeme prejsť k nastaveniu a spusteniu Aurory.
Celé to začneme v priečinku `App/Config`
V tomto priečinku nájdeme nasledujúci obsah:

* config.php   -> Konfigurácia aurory
* routes.php   -> Cesty pre router
* services.php -> Nastavenie závislostí a parametrov

Podľa základných nastavení sú načítané konfiguračné súbory vo formáte PHP, cez pridanie niekoľkých riadkov je možné načítať akýkoľvek podporovaný formát napr. `JSON`.

### Nastavenie Aurory (config.ext)

Všetky konfiguračné nastavenia, ktoré Aurora potrebuje sa nachádzajú v tomto súbore.

Pri PHP formáte je nastavenie nasledujúce, pozrime sa na časť o aplikácii:

```php
'application'	=> [
	"baseURI"           => "/",
],
```

Pre zjednoduchšenie sa zamerajme len na posledný klúč, tento klúč nám odstráni špecifickú základnú adresu, aby sme získali relatívny `uri`.

## Nastavenie routra (router.ext)

Router určuje kedy, čo a kam odoslať, napríklad.

Pri PHP formáte je nastavenie nasledujúce:

```php
$Router->any('/?{user}', ["App\Controller\Welcome", "sayHello"]);
```
Táto route ak zaznamená adresy:
```
/
/john
/hocico
```
a `HTTP` metody: `GET, POST, PUT, PATCH, DELETE, OPTIONS`
presmeruje na controler s `App\Controller\Welcome` s akciou `sayHello` a parametrom, ktorý je len doplnkový ako napr. `john` alebo `hocico`.

Viac príkladov je možné nájsť na repozitáry Routra v priečinku `Docs/sk`.

## Nastavenie DI (Dependency Injection) (services.ext)

O to aby každá trieda získala svoje triedy, ktoré potrebuje sa stará `Dependency Injection`(vysvetlenie nájdete tu).

Pri PHP formáte je nastavenie nasledujúce:
```php
$Injector->define("Aurora\\Http\\Request", [
	":GET" => $_GET,
	":POST" => $_POST,
	":COOKIE" => $_COOKIE,
	":FILES" => $_FILES,
	":SERVER" => $_SERVER,
]);
```
Táto definícia je podobná syntaxu DI Resolvera Auryn, ak ste s ním spriaznený nebude pre Vás problém nastaviť tento DI Resolver.

Vysvetlenie:
Pri inicializácií triedy `Aurora\Http\Request`, sú potrebné parametre
`GET, POST, COOKIE, FILES, SERVER` -> jedná sa o parametre, ktoré sú prefixnuté znakom `:`, ak by sa jednalo o triedu, potom tento prefix vypadáva.

Príklad definície s triedami:
```php
$Injector->define("A", [
	"B" => new B(),
]);
```
Tento príklad vytvorí triedu `A` s triedou `B` v konstruktore.
