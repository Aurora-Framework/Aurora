# Vitajte v Aurore
Docs (~1.0)

#####Aurora je moderný framework, ktorý je skalárny a veľmi jednoduchý pre žačiatočníkov.

Aurora ako aj iné frameworky, funguje na architektúre MVC (vysvetlenie architektúry nájdete tu[](#Add link)),
vnútro frameworku je silne objektovo orientované, preto sa kládol dôraz na správne postupy a možnosť rozšírenia.
K frameworku je neodmysliteľnou súčasťou aj Composer[](#Add link), ten Aurore dovoľuje jednoduchosť autoloadingu,
zároveň je odľahčená o svoju vlastnú knižnicu pre autoloading.
Tento framework je prispôsobený pre rozhranie `HTTP`.

## Inštalácia Aurory

Inštalovať Auroru je možné niekoľkými spôsobmi:

* Composer cez CLI (Konzolu)
* Composer cez json
* Stiahnutie z Git repozitára

Niektoré spôsoby vytvárajú aj štruktúru, teda skelet aplikácie.

### Composer cez CLI

Všetky príkazy vkladajte do konzoly, pričom sa ráta s tým, že composer,
je dostupný globálne cez konzolu.

#### So štruktúrou

Inštalovať Auroru je možné niekoľkými spôsobmi, jedným z nich je inštalácia cez composer, ktorá
je rýchla a veľmi jednoduchá je vhodná pre okamžité nahodenie aplikácie do behu.

```terminal
composer create-project aurora-framework/app <Názov Aplikácie>
```

#### Bez štruktúry

Pre tento spôsob stačí do konzole zadať príkaz:

```terminal
composer require "aurora-framework/aurora: ~1.0"
```
Následne je možné upraviť `composer.json`, pridaním autoloadingu, pre aplikáciu.
Napríklad:

```json
{
   /... Zvyšok composeru - Nekopírovať .../
   "autoload": {
      "psr-4": {
         "App\\": "App//"
      }
   }
}
```

Posledným a teda aj finálnym príkazom je:

```
composer install
```
Tento príkaz nainštaluje všetky sub-knižnice aplikácie, PS: Neviem či si stihnete dôjsť po kávičku, je to rýchle.


### Composer cez json bez štruktúry

Pri tomto spôsobe je nutné vytvoriť súbor, s názvom `composer.json` tento súbor musí obsahovať nasledujúci obsah:

```json
{
   "require": {
      "aurora-framework/aurora": "~1.0"
   }
}
```

Následne môžeme pridať autoloading:
```json
{
   /... Zvyšok composeru - Nekopírovať .../
   "autoload": {
      "psr-4": {
         "App\\": "App//"
      }
   }
}
```

Posledným a teda aj finálnym príkazom je:

```
composer install
```
Tento príkaz nainštaluje všetky sub-knižnice aplikácie, PS: Neviem či si stihnete dôjsť po kávičku, je to rýchle.

### Stiahnutie z Git repozitára so štruktúrou

Zazipované súbory je možné nájsť na: (#Add link)
Po extrakcií stačí spustiť:

```
composer install
```
Tento príkaz nainštaluje všetky sub-knižnice aplikácie, PS: Neviem či si stihnete dôjsť po kávičku, je to rýchle.
