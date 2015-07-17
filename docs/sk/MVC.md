# MVC v skratke

Architektúra MVC spočíva v jednoduchosti a prehľadnosti.

## Uri

Uri je relatívna požiadavka prehliadača, napríklad po adrese:

```
Adresa -> Uri pri určení zakladného adresára -> Controler::Metoda(Parameter)
localhost/mojprojekt/               -> /              -> Home::index
localhost/mojprojekt/songs          -> /songs         -> Song::overview
localhost/mojprojekt/song/view/1    -> /song/view/1   -> Song::view(1)
localhost/mojprojekt/song/edit/1    -> /song/edit/1   -> Song::edit(1)
localhost/mojprojekt/song/delete/1  -> /song/delete/1 -> Song::delete(1)
```

## MVC

```
*        Model
*      /        \
*   View  -->  Controller
```

Predstavme si stránku, ktorá má za účel zobraziť pesničky.

Aplikácia má určené, že pri `uri: /`(zistená požiadavka z adresy), načíta controller `Songs::Index`,
tu sa zavolá Model `Song`, ktorým získame všetky pesničky a pošleme ich do view, `songs/overview`.

Aurora zatiaľ nedisponuje pred nastaveným Routrom, ktorý by
automaticky zadeľoval tieto `uri` do controlerov a metod.
