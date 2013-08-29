=== Crazy Lazy ===
Contributors: sergej.mueller
Tags: lazy, load, loading, performance, images
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5RDDW9FEHGLG6
Requires at least: 3.6
Tested up to: 3.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



Lazy load images. Simple to use: Activate, done. Search engine and noscript user friendly.



== Description ==

*Crazy Lazy* übernimmt die effiziente Anzeige der Artikelbilder im WordPress-Blog. Um die Performance der Blogseiten zu steigern, werden nicht alle Bilder sofort vom Server angefordert, sondern nach Bedarf: Erst beim Erreichen der Scroll-Position lädt *Crazy Lazy* das entsprechende Bild nach.

Durch die Nachlade-Technik lassen sich Ladezeiten verkürzen und der Traffic reduzieren.

Das Lazy Load Plugin ist simpel aufgebaut und benötigt keinerlei Einstellungen: Aktivieren, läuft. Je nach Theme bzw. die jQuery-Nutzung verwendet *Crazy Lazy* wahlweise das [Unveil.js](https://github.com/luis-almeida/unveil) jQuery Plugin oder die JavaScript-native Bibliothek [lazyload.js](https://gist.github.com/miloplacencia/3931803).


= Formatierung =

Bilder-Platzhalter können via CSS dekoriert werden. Einige Beispiele:
`img[src*='data:image/gif;base64'] {
    border: 1px dashed #dbdbdb;
}`

`img.crazy_lazy {
    background: url(/wp-includes/images/wpspin-2x.gif) no-repeat center center;
    background-size: 16px 16px;
}`


= Video =
[youtube http://www.youtube.com/watch?v=tMv5tl3Q4Aw]


= Hinweise =

* Berücksichtigt werden alle über die Mediathek eingebundene Bilder inkl. Beitragsbild.
* Das Template `footer.php` muss den WordPress-Funktionsaufruf `wp_footer()` beinhalten.
* Es handelt sich um meine eigene Weiterentwicklung von [Unveil.js für WordPress](https://github.com/sergejmueller/unveil-wordpress-plugin).
* Funktioniert mit jedem Caching-Plugin - auch mit [Cachify](http://cachify.de).


= Unterstützung =
* Per [Flattr](https://flattr.com/t/1323822)
* Per [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5RDDW9FEHGLG6)


= Autor =
* [Twitter](https://twitter.com/wpSEO)
* [Google+](https://plus.google.com/110569673423509816572)
* [Plugins](http://wpcoder.de)




== Installation ==

1. Plugin aktivieren.
1. Fertig.




== Changelog ==

= 0.0.5 =
* Fallback aus purem JavaScript
* Umzug to WordPress.org