# Vlastný autoloading

Pri práci s projektmi je dobré udržať si peknú štruktúru súborov.

## PSR-4

Základná aplikácia obsahuje `PSR-4 autoloading`, teda štruktúra je nasledujúca:

```
   App/
      Controller/
         HelloWorld.php -> 1.
```

1. Obsahuje triedu `HelloWorld` s `namespace App\Controller;`, absolutný namespace s triedou je potom:
   `App\Controller\HelloWorld`, názvy musia byť totožné s `CamelCase`.
