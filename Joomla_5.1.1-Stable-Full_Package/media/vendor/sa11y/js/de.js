
/*!
  * Sa11y, the accessibility quality assurance assistant.
  * @version 3.1.3
  * @author Adam Chaboryk
  * @license GPL-2.0-or-later
  * @copyright © 2020 - 2024 Toronto Metropolitan University.
  * @contact adam.chaboryk@torontomu.ca
  * GitHub: git+https://github.com/ryersondmp/sa11y.git | Website: https://sa11y.netlify.app
  * For all acknowledgements, please visit: https://sa11y.netlify.app/acknowledgements/
  * The above copyright notice shall be included in all copies or substantial portions of the Software.
**/
var de = {
  // German
  strings: {
    LANG_CODE: 'de',
    MAIN_TOGGLE_LABEL: 'Barrierefreiheit prüfen',
    CONTAINER_LABEL: 'Barrierefreiheits-Checker',
    ERROR: 'Fehler',
    ERRORS: 'Fehler',
    WARNING: 'Warnung',
    WARNINGS: 'Warnungen',
    GOOD: 'Gut',
    ON: 'An',
    OFF: 'Aus',
    ALERT_TEXT: 'Alarm',
    ALERT_CLOSE: 'Schließen',
    OUTLINE: 'Seitenumriss',
    PAGE_ISSUES: 'Seitenprobleme',
    SETTINGS: 'Einstellungen',
    CONTRAST: 'Kontrast',
    FORM_LABELS: 'Formular Label',
    LINKS_ADVANCED: 'Links (Fortgeschritten)',
    DARK_MODE: 'Dark mode',
    SHORTCUT_SCREEN_READER: 'Zum Eintrag springen. Keyboard shortcut: Alt Punkt',
    SHORTCUT_TOOLTIP: 'Zum Eintrag springen',
    NEW_TAB: 'Öffnet neuen Tab',
    PANEL_HEADING: 'Barrierefreiheits-Check',
    PANEL_STATUS_NONE: 'Keine Fehler gefunden.',
    PANEL_ICON_WARNINGS: 'Warnungen gefunden.',
    PANEL_ICON_TOTAL: 'Einträge insgesamt gefunden.',
    NOT_VISIBLE_ALERT: 'Das Element, das Sie anzeigen möchten, ist nicht sichtbar; es ist möglicherweise ausgeblendet oder befindet sich in einer Akkordeon- oder Registerkartenkomponente. Hier ist eine Vorschau:',
    ERROR_MISSING_ROOT_TARGET: 'Die gesamte Seite wurde auf Barrierefreiheit geprüft, da der Zielbereich <code>%(root)</code> nicht existiert.',
    HEADING_NOT_VISIBLE_ALERT: 'Die Überschrift ist nicht sichtbar; sie kann ausgeblendet sein oder sich innerhalb einer Akkordeon- oder Registerkartenkomponente befinden.',
    SKIP_TO_PAGE_ISSUES: 'Zu Seitenproblemen springen',
    CONSOLE_ERROR_MESSAGE: 'Leider liegt ein Problem mit der Barrierefreiheitsprüfung auf dieser Seite vor. Können Sie es bitte <a href="%(link)">über dieses Formular</a> oder auf <a href="%(link)">GitHub</a> melden?',

    // Dismiss
    PANEL_DISMISS_BUTTON: 'Zeige %(dismissCount) ignorierte Warnungen',
    DISMISS: 'Ignorieren',
    DISMISSED: 'Ignorierte Warnungen',
    DISMISS_REMINDER: 'Bitte beachten Sie, dass Warnungen nur <strong>vorübergehend</strong> ignoriert werden. Das Löschen des Browserverlaufs und der Cookies stellt alle zuvor ignorierten Warnungen auf allen Seiten wieder her.',

    // Export
    DATE: 'Datum',
    PAGE_TITLE: 'Seitentitel',
    RESULTS: 'Ergebnisse',
    EXPORT_RESULTS: 'Ergebnisse exportieren',
    GENERATED: 'Ergebnisse generiert mit %(tool).',
    PREVIEW: 'Vorschau',
    ELEMENT: 'Element',
    PATH: 'Pfad',

    // Color filters
    COLOUR_FILTER: 'Farbfilter',
    PROTANOPIA: 'Protanopie',
    DEUTERANOPIA: 'Deuteranopie',
    TRITANOPIA: 'Tritanopie',
    MONOCHROMACY: 'Monochromie',
    COLOUR_FILTER_MESSAGE: 'Suchen Sie nach Elementen, die schwer wahrnehmbar oder von anderen Farben zu unterscheiden sind.',
    RED_EYE: 'Rotblindheit',
    GREEN_EYE: 'Grünblindheit',
    BLUE_EYE: 'Blaublindheit',
    MONO_EYE: 'Rot-, Grün- und Blaublindheit.',
    COLOUR_FILTER_HIGH_CONTRAST_MESSAGE: 'Farbfilter funktionieren nicht im Hochkontrastmodus.',

    // Alternative text stop words
    SUSPICIOUS_ALT_STOPWORDS: ['image', 'graphic', 'picture', 'photo', 'foto', 'bild'],
    PLACEHOLDER_ALT_STOPWORDS: ['alt', 'image', 'photo', 'foto', 'bild', 'decorative', 'placeholder', 'platzhalter', 'placeholder image', 'platzhalter bild', 'platzhalter foto', 'platzhalter photo', 'spacer', 'abstand'],
    PARTIAL_ALT_STOPWORDS: [
      'click',
      'klick',
      'click here',
      'hier klicken',
      'click here for more',
      'hier für mehr klicken',
      'click here to learn more',
      'hier klicken um mehr zu erfahren',
      'clicking here',
      'check out',
      'detailed here',
      'download',
      'herunterladen',
      'download here',
      'hier herunterladen',
      'find out',
      'herausfinden',
      'find out more',
      'mehr herausfinden',
      'form',
      'formular',
      'here',
      'hier',
      'info',
      'information',
      'link',
      'learn',
      'learn more',
      'mehr erfahren',
      'learn to',
      'more',
      'mehr',
      'page',
      'seite',
      'paper',
      'papier',
      'read more',
      'mehr lesen',
      'lesen',
      'read this',
      'dies lesen',
      'this',
      'dies',
      'this page',
      'diese seite',
      'this website',
      'diese website',
      'view',
      'anschauen',
      'view our',
      'website',
    ],
    WARNING_ALT_STOPWORDS: ['click here', 'hier klicken'],
    NEW_WINDOW_PHRASES: ['external', 'extern', 'new tab', 'neuer tab', 'new window', 'neues fenster', 'pop-up', 'pop up'],
    FILE_TYPE_PHRASES: ['dokument', 'document', 'spreadsheet', 'tabelle', 'worksheet', 'arbeitsblatt', 'tabellenkalkulation', 'berechnungstabelle', 'komprimierte datei', 'archivierte Datei', 'arbeitsblatt', 'powerpoint', 'präsentation', 'installieren', 'video', 'audio', 'pdf'],

    // Readability
    LANG_READABILITY: 'Lesbarkeit',
    LANG_AVG_SENTENCE: 'Durchschnittliche Wörter pro Satz:',
    LANG_COMPLEX_WORDS: 'Komplexe Wörter:',
    LANG_TOTAL_WORDS: 'Wörter:',
    LANG_VERY_DIFFICULT: 'Sehr schwierig',
    LANG_DIFFICULT: 'Schwierig',
    LANG_FAIRLY_DIFFICULT: 'Ziemlich schwierig',
    LANG_GOOD: 'Gut',
    READABILITY_NO_P_OR_LI_MESSAGE: 'Die Lesbarkeitsbewertung kann nicht berechnet werden. Kein Absatz- <code>&lt;p&gt;</code> oder Listeninhalt <code>&lt;li&gt;</code> gefunden.',
    READABILITY_NOT_ENOUGH_CONTENT_MESSAGE: 'Nicht genügend Inhalt für die Berechnung der Lesbarkeitsbewertung.',

    // Headings
    HEADING_NON_CONSECUTIVE_LEVEL: 'Nicht-konsekutive Überschriftenebene verwendet. Überschriften sollten niemals Ebenen überspringen oder von <strong>Überschrift %(prevLevel)</strong> zu <strong {r}>Überschrift %(level)</strong> gehen.',
    HEADING_EMPTY: 'Leere Überschrift gefunden! Um dies zu beheben, löschen Sie diese Zeile oder ändern Sie ihr Format von <strong {r}>Überschrift %(level)</strong> zu <strong>Normal</strong> oder <strong>Absatz (p)</strong>.',
    HEADING_LONG: 'Die Überschrift ist lang! Überschriften sollten dazu dienen, den Inhalt zu gliedern und eine Struktur zu vermitteln. Sie sollten kurz, informativ und eindeutig sein. Überschriften sollten nicht länger als 160 Zeichen sein (nicht länger als ein Satz). <hr> Zeichen Anzahl: <strong {r}>%(headingLength)</strong>',
    HEADING_FIRST: 'Die erste Überschrift auf einer Seite sollte in der Regel Überschrift 1 oder Überschrift 2 sein. Überschrift 1 sollte der Beginn des Hauptinhaltsabschnitts sein und ist die Hauptüberschrift, die den allgemeinen Zweck der Seite beschreibt. Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/page-structure/headings/">Überschriften-Struktur.</a>',
    HEADING_MISSING_ONE: 'Fehlende Überschrift 1: Überschrift 1 sollte am Anfang des Hauptinhaltsbereichs stehen und ist die Hauptüberschrift, die den allgemeinen Zweck der Seite beschreibt. Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/page-structure/headings/">Überschriften-Struktur.</a>',
    HEADING_EMPTY_WITH_IMAGE: 'Die Überschrift hat keinen Text, enthält aber ein Bild. Wenn es sich nicht um eine Überschrift handelt, ändere das Format von <strong {r}>Überschrift %(level)</strong> zu <strong>Normal</strong> oder <strong>Absatz (p)</strong>. Andernfalls füge bitte einen Alt-Text zum Bild hinzu, wenn es nicht dekorativ ist.',
    PANEL_HEADING_MISSING_ONE: 'Fehlende Überschrift 1!',
    PANEL_NO_HEADINGS: 'Keine Überschriften gefunden.',

    // Links
    LINK_EMPTY: 'Entferne leere Links ohne Text.',
    LINK_EMPTY_LINK_NO_LABEL: 'Der Link hat keinen erkennbaren Text, der für Bildschirmleser und andere unterstützenden Technologien sichtbar ist. Zu beheben: <ul><li>Füge einen kurzen Text hinzu, der beschreibt, wohin der Link führt.</li><li>Wenn es ein <a href="https://a11y-101.com/development/icons-and-links">Icon Link oder ein SVG ist,</a> ist es sehr wahrscheinlich, dass ein beschreibendes Label fehlt.</li><li>Wenn Du glaubst, dass dieser Link aufgrund eines Kopier-/Einfügefehlers fehlerhaft ist, solltest Du ihn löschen.</li></ul>',
    LINK_LABEL: '<strong>Link Label:</strong> %(sanitizedText)',
    LINK_STOPWORD: 'Der Linktext ist ohne Kontext möglicherweise nicht aussagekräftig genug: <strong {r}>%(error)</strong><hr><strong>Tipp!</strong>Der Linktext sollte immer klar, eindeutig und aussagekräftig sein. Vermeide gängige Wörter wie &quot;hier klicken&quot; oder &quot;mehr erfahren&quot;',
    LINK_BEST_PRACTICES: 'Erwäge, den Linktext zu ersetzen: <strong {r}>%(error)</strong><hr><ul><li>&quot;Hier klicken&quot; legt den Schwerpunkt auf die Mausmechanik, obwohl viele Menschen keine Maus benutzen oder diese Website möglicherweise auf einem mobilen Gerät betrachten. Erwäge die Verwendung eines anderen Verbs, das sich auf die Aufgabe bezieht.</li><li>Vermeide die Verwendung von HTML-Symbolen als Aktionsaufrufe, es sei denn, sie sind für unterstützende Technologien verborgen.</li></ul>',
    LINK_URL: 'Längere, weniger verständliche URLs, die als Linktext verwendet werden, könnten beim Zugriff mit Hilfe von Hilfsmitteln schwer zu verstehen sein. In den meisten Fällen ist es besser, anstelle der URL einen von Menschen lesbaren Text zu verwenden. Kurze URLs (z. B. die Homepage einer Website) sind in Ordnung.<hr><strong>Tipp!</strong> Der Linktext sollte immer klar, eindeutig und aussagekräftig sein, damit er auch ohne Kontext verstanden werden kann.',
    LINK_DOI: 'Für Webseiten oder reine Online-Ressourcen empfiehlt der <a href="https://apastyle.apa.org/style-grammar-guidelines/paper-format/accessibility/urls#:~:text=descriptive%20links">APA Style guide</a> die Verwendung von deskriptiven Links, indem die URL oder DOI des Werks um den Titel herumgeschrieben wird. Längere, weniger verständliche URLs, die als Linktext verwendet werden, könnten beim Zugriff mit Hilfe von Hilfsmitteln schwer zu verstehen sein.',

    // Links advanced
    NEW_TAB_WARNING: 'Der Link öffnet sich in einem neuen Tab oder einem neuen Fenster ohne Warnung. Dies kann verwirrend sein, insbesondere für Menschen, die Schwierigkeiten haben, visuelle Inhalte wahrzunehmen. Zweitens ist es nicht immer eine gute Praxis, die Erfahrungen der anderen zu kontrollieren oder für sie Entscheidungen zu treffen. Gib im Linktext an, dass der Link in einem neuen Fenster geöffnet wird. <hr><strong>Tipp!</strong> Lerne bewährte Praktiken kennen: <a href="https://www.nngroup.com/articles/new-browser-windows-and-tabs/">Öffnen von Links in neuen Browserfenstern und Tabs.</a>',
    FILE_TYPE_WARNING: 'Der Link verweist ohne Warnung auf eine PDF- oder herunterladbare Datei (z. B. MP3, Zip, Word Doc). Gib den Dateityp im Linktext an. Wenn es sich um eine große Datei handelt, solltest Du die Dateigröße angeben.<hr><strong>Beispiel:</strong> Bericht der Geschäftsführung (PDF, 3MB)',
    LINK_IDENTICAL_NAME: 'Der Link hat den gleichen Text wie ein anderer Link, obwohl er auf eine andere Seite verweist. Mehrere Links mit demselben Text können bei Personen, die Bildschirmlesegeräte verwenden, zu Verwirrung führen.<hr>Erwäge, den folgenden Link beschreibender zu gestalten, um ihn von anderen Links zu unterscheiden: <strong {r}>%(sanitizedText)</strong>',

    // Images
    MISSING_ALT_LINK_BUT_HAS_TEXT_MESSAGE: 'Das Bild wird als Link mit umliegendem Text verwendet, obwohl das alt-Attribut als dekorativ oder null markiert sein sollte.',
    MISSING_ALT_LINK_MESSAGE: 'Das Bild wird als Link verwendet, aber es fehlt der Alt-Text! Bitte stellen Sie sicher, dass der Alt-Text beschreibt, wohin der Link Dich führt.',
    MISSING_ALT_MESSAGE: 'Fehlender Alt text! Wenn das Bild eine Geschichte, eine Stimmung oder eine wichtige Information vermittelt - beschreibe das Bild unbedingt.',
    LINK_ALT_HAS_FILE_EXTENSION: 'Dateierweiterung im Alt-Text gefunden. Achte darauf, dass der Alt-Text das Ziel des Links beschreibt und nicht eine wörtliche Beschreibung des Bildes ist. Entferne: <strong {r}>%(error)</strong>.<hr><strong>Alt text:</strong> %(altText)',
    LINK_IMAGE_PLACEHOLDER_ALT_MESSAGE: 'Nicht beschreibender oder Platzhalter-Alt-Text innerhalb eines verlinkten Bildes gefunden. Achte darauf, dass der Alt-Text das Ziel des Links beschreibt und nicht eine wörtliche Beschreibung des Bildes ist. Replace the following alt text: <strong {r}>%(altText)</strong>',
    LINK_IMAGE_SUS_ALT_MESSAGE: 'Assistive Technologien zeigen bereits an, dass es sich um ein Bild handelt, so dass &quot;<strong {r}>%(error)</strong>&quot; möglicherweise überflüssig ist. Achte darauf, dass der Alt-Text das Ziel des Links beschreibt und nicht eine wörtliche Beschreibung des Bildes ist. <hr> <strong>Alt text:</strong> %(altText)',
    ALT_HAS_FILE_EXTENSION: 'Dateierweiterung im Alt-Text gefunden. Wenn das Bild eine Geschichte, eine Stimmung oder eine wichtige Information vermittelt - beschreibe das Bild unbedingt. Entferne: <strong {r}>%(error)</strong>.<hr><strong>Alt text:</strong> %(altText)',
    ALT_PLACEHOLDER_MESSAGE: 'Nicht-beschreibender oder Platzhalter-Alt-Text gefunden. Ersetze den folgenden Alt-Text durch einen aussagekräftigeren Text: <strong {r}>%(altText)</strong>',
    ALT_HAS_SUS_WORD: 'Assistive Technologien zeigen bereits an, dass es sich um ein Bild handelt, so dass &quot;<strong {r}>%(error)</strong>&quot; möglicherweise überflüssig ist. <hr> <strong>Alt text:</strong> %(altText)',
    LINK_HIDDEN_FOCUSABLE: 'Der Link hat <code>aria-hidden=&quot;true&quot;</code>, ist aber trotzdem tastaturfokussierbar. Wenn du beabsichtigst, einen überflüssigen oder doppelten Link zu verbergen, füge auch <code>tabindex=&quot;-1&quot;</code> hinzu.',
    LINK_IMAGE_NO_ALT_TEXT: 'Das Bild innerhalb des Links ist als dekorativ gekennzeichnet und es gibt keinen Linktext. Bitte füge dem Bild einen Alt-Text hinzu, der das Ziel des Links beschreibt.',
    LINK_IMAGE_HAS_TEXT: 'Das Bild ist als dekorativ gekennzeichnet, obwohl der Link den umgebenden Text als beschreibende Bezeichnung verwendet.',
    LINK_IMAGE_LONG_ALT: 'Alt-Text-Beschreibung auf einem verlinkten Bild ist <strong>zu lang</strong>. Der Alt-Text von verlinkten Bildern sollte beschreiben, wohin der Link führt, und nicht eine wörtliche Beschreibung des Bildes enthalten. <strong>Erwäge, den Titel der Seite, auf die verlinkt wird, als Alt-Text zu verwenden.</strong> <hr> <strong>Alt text (<span {r}>%(altLength)</span> characters):</strong> %(altText)',
    LINK_IMAGE_ALT_WARNING: 'Der Bildlink enthält einen Alt-Text. <strong>Beschreibt der Alt-Text, wohin der Link Sie führt?</strong> Erwägen Sie, den Titel der Seite, zu der der Link führt, als Alt-Text zu verwenden. <hr> <strong>Alt text:</strong> %(altText)',
    LINK_IMAGE_ALT_AND_TEXT_WARNING: 'Der Bildlink enthält <strong>beide Alt-Texte und den umgebenden Linktext.</strong> Wenn dieses Bild dekorativ ist und als funktionaler Link zu einer anderen Seite verwendet wird, sollte das Bild als dekorativ oder nichtig gekennzeichnet werden - der umgebende Linktext sollte ausreichen. <hr> <strong>Alt text:</strong> %(altText) <hr> <strong>Link Label:</strong> %(sanitizedText)',
    IMAGE_FIGURE_DECORATIVE: 'Das Bild ist als <strong>dekorativ</strong> gekennzeichnet und wird von Hilfsmitteln ignoriert. <hr> Obwohl eine <strong>Beschriftung</strong> angegeben wurde, sollte das Bild in den meisten Fällen auch einen Alt-Text haben. <ul><li>Der Alt-Text sollte eine prägnante Beschreibung des Bildes enthalten.</li><li>Die Bildunterschrift sollte in der Regel einen Zusammenhang zwischen dem Bild und dem umgebenden Inhalt herstellen oder auf eine bestimmte Information hinweisen.</li></ul>Erfahre mehr: <a href="https://thoughtbot.com/blog/alt-vs-figcaption#the-figcaption-element">alt versus figcaption.</a>',
    IMAGE_FIGURE_DUPLICATE_ALT: 'Verwende nicht genau dieselben Wörter für den Alt-Text und die Überschrift. Bildschirmlesegeräte melden die Informationen doppelt. <ul><li>Der Alt-Text sollte eine prägnante Beschreibung des Bildes enthalten.</li><li>Die Bildunterschrift sollte in der Regel einen Zusammenhang zwischen dem Bild und dem umgebenden Inhalt herstellen oder auf eine bestimmte Information hinweisen.</li></ul> Erfahre mehr: <a href="https://thoughtbot.com/blog/alt-vs-figcaption#the-figcaption-element">alt versus figcaption.</a> <hr> <strong>Alt text:</strong> %(altText)',
    IMAGE_DECORATIVE: 'Das Bild ist als <strong>dekorativ</strong> gekennzeichnet und wird von Hilfsmitteln ignoriert. Wenn das Bild eine Geschichte, eine Stimmung oder wichtige Informationen vermittelt - füge unbedingt einen Alt-Text hinzu.',
    IMAGE_ALT_TOO_LONG: 'Die Beschreibung des Alt-Textes ist <strong>zu lang</strong>. Der Alt-Text sollte prägnant, aber aussagekräftig wie ein <em>Tweet</em> sein (etwa 100 Zeichen). Wenn es sich um ein komplexes Bild oder eine Grafik handelt, sollten Sie erwägen, die lange Beschreibung des Bildes in den Text darunter oder in eine Akkordeonkomponente zu integrieren. <hr> <strong>Alt text (<span {r}>%(altLength)</span> Zeichen):</strong> %(altText)',
    IMAGE_PASS: '<strong>Alt text:</strong> %(altText)',

    // Labels
    LABELS_MISSING_IMAGE_INPUT_MESSAGE: 'Bildschaltfläche fehlt Alt-Text. Bitte füge alternativen Text hinzu, um einen barrierefreien Namen bereitzustellen. Zum Beispiel: <em>Suchen</em> oder <em>Senden</em>.',
    LABELS_INPUT_RESET_MESSAGE: 'Reset-Buttons sollten <strong>nicht</strong> verwendet werden, es sei denn, dies wird ausdrücklich benötigt, da sie leicht versehentlich aktiviert werden können. <hr> <strong>Tipp!</strong> Erfahre, warum <a href="https://www.nngroup.com/articles/reset-and-cancel-buttons/">Zurücksetzen- und Abbrechen-Schaltflächen Probleme mit der Benutzerfreundlichkeit aufwerfen.< /a>',
    LABELS_ARIA_LABEL_INPUT_MESSAGE: 'Die Eingabe hat einen zugänglichen Namen, stelle bitte trotzdem sicher, dass es auch ein sichtbares Label gibt. <hr> <strong>Eingabelabel:</strong> %(sanitizedText)',
    LABELS_NO_FOR_ATTRIBUTE_MESSAGE: 'Dieser Eingabe ist kein Label zugeordnet. Füge dem Label ein <code>for</code>-Attribut hinzu, das der <code>id</code> dieser Eingabe entspricht. <hr> Die ID für diese Eingabe lautet: <strong>id=&#34;%(id)&#34;</strong>',
    LABELS_MISSING_LABEL_MESSAGE: 'Dieser Eingabe ist kein Label zugeordnet. Bitte füge dieser Eingabe eine <code>id</code> hinzu und füge dem Label ein passendes <code>for</code>-Attribut hinzu.',

    // Embedded content
    EMBED_VIDEO: 'Bitte stelle sicher, dass <strong>alle Videos Untertitel haben.</strong> Das Bereitstellen von Untertiteln für alle Audio- und Videoinhalte ist eine obligatorische Anforderung der Stufe-A. Bildunterschriften unterstützen Menschen, die Taub oder schwerhörig sind.',
    EMBED_AUDIO: 'Bitte stelle sicher, dass Du ein <strong>Transkript für alle Podcasts bereitstellst.</strong> Das Bereitstellen von Transkripten für Audioinhalte ist eine obligatorische Anforderung der Stufe-A. Transkripte unterstützen Menschen, die gehörlos oder schwerhörig sind, können aber allen zugute kommen. Erwäge, das Transkript unter- oder innerhalb eines Akkordeonfelds zu platzieren.',
    EMBED_DATA_VIZ: 'Datenvisualisierungs-Widgets wie dieses sind oft problematisch für Menschen, die eine Tastatur oder einen Bildschirmleser zum Navigieren verwenden, und können für Menschen mit Sehbehinderung oder Farbenblindheit erhebliche Schwierigkeiten darstellen. Es wird empfohlen, dieselben Informationen in einem alternativen (Text- oder Tabellen-)Format unterhalb des Widgets bereitzustellen. <hr> Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/images/complex">komplexe Bilder.</a>',
    EMBED_MISSING_TITLE: 'Eingebetteter Inhalt erfordert einen zugänglichen Namen, der seinen Inhalt beschreibt. Bitte gib ein eindeutiges <code>title</code>- oder <code>aria-label</code>-Attribut für das <code>iframe</code>-Element an. Erfahre mehr über <a href="https://web.dev/learn/accessibility/more-html#iframes">iFrames.</a>',
    EMBED_GENERAL_WARNING: 'Eingebetteter Inhalt kann nicht überprüft werden. Bitte stelle sicher, dass Bilder Alt-Text haben, Videos Untertitel haben, Text einen ausreichenden Kontrast hat und interaktive Komponenten <a href="https://webaim.org/techniques/keyboard/">mit der Tastatur zugänglich sind.</a>',
    EMBED_UNFOCUSABLE: '<code>&lt;iframe&gt;</code> mit nicht fokussierbaren Elementen sollte kein <code>tabindex="-1"</code> haben. Der eingebettete Inhalt wird nicht mit der Tastatur erreichbar sein.',

    // Quality assurance
    QA_BAD_LINK: 'Ungültiger Link gefunden. Link scheint auf eine Entwicklungsumgebung zu verweisen. <hr> Dieser Link verweist auf: <br> <strong {r}>%(el)</strong>',
    QA_BAD_ITALICS: 'Fett- und Kursiv-Tags haben semantische Bedeutung und sollten <strong>nicht</strong> verwendet werden, um ganze Absätze hervorzuheben. Fettgedruckter Text sollte verwendet werden, um ein Wort oder einen Ausdruck stark <strong>zu betonen</strong>. Kursiv sollte verwendet werden, um Eigennamen (z. B. Buch- und Artikeltitel), Fremdwörter, Zitate hervorzuheben. Lange Zitate sollten als Blockquote formatiert werden.',
    QA_PDF: 'PDFs können nicht auf Barrierefreiheit geprüft werden. PDFs gelten als Webinhalte und müssen ebenfalls zugänglich gemacht werden. PDFs enthalten oft Probleme für Personen, die Screenreader verwenden (fehlende Struktur-Tags oder fehlende Beschriftungen von Formularfeldern) und Personen mit Sehbehinderung (Text umfließt beim Vergrößern nicht ). <ul><li>Wenn es sich um ein Formular handelt, solltest Du alternativ ein barrierefreies HTML-Formular verwenden.</li><li>Wenn es sich um ein Dokument handelt, solltest Du es in eine Webseite umwandeln.</li></ul > Andernfalls überprüfe bitte <a href="https://helpx.adobe.com/acrobat/using/create-verify-pdf-accessibility.html">PDF für Barrierefreiheit in Acrobat DC.</a>',
    QA_DOCUMENT: 'Das Dokument kann nicht auf Zugänglichkeit geprüft werden. Verknüpfte Dokumente gelten als Webinhalte und müssen ebenfalls zugänglich gemacht werden. Bitte überprüfen Sie dieses Dokument manuell. <ul><li>Machen Sie Ihr <a href="https://support.google.com/docs/answer/6199477?hl=de">Google Workspace-Dokument oder Ihre Präsentation besser zugänglich.</a></li><li>Machen Sie Ihre <a href="https://support.microsoft.com/de-de/office/create-accessible-office-documents-868ecfcd-4f00-4224-b881-a65537a7c155">Office-Dokumente besser zugänglich.</a></li></ul>',
    QA_PAGE_LANGUAGE: 'Seitensprache nicht angegeben! Bitte <a href="https://www.w3.org/International/questions/qa-html-language-declarations">deklariere die Sprache im HTML-Tag.</a>',
    QA_PAGE_TITLE: 'Seitentitel fehlt! Bitte gib einen <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/title">Seitentitel</a> an.',
    QA_BLOCKQUOTE_MESSAGE: 'Ist das eine Überschrift? <strong {r}>%(sanitizedText)</strong> <hr> Blockquotes sollten nur für Zitate verwendet werden. Wenn dies eine Überschrift sein soll, ändere dieses Blockquote in eine semantische Überschrift (z. B. Überschrift 2 oder Überschrift 3).',
    QA_FAKE_HEADING: 'Ist das eine Überschrift? <strong {r}>%(boldtext)</strong> <hr> Eine Zeile mit fettem Text mag wie eine Überschrift aussehen, aber jemand, der einen Bildschirmleser verwendet, kann nicht erkennen, dass sie wichtig ist, oder zu ihrem Inhalt springen. Fettgedruckter Text sollte niemals semantische Überschriften ersetzen (Überschrift 2 bis Überschrift 6).',
    QA_SHOULD_BE_LIST: 'Versuchst Du, eine Liste zu erstellen? Mögliches gefundenes Listenelement: <strong {r}>%(firstPrefix)</strong> <hr> Stelle sicher, dass Du semantische Listen verwendest, indem Du stattdessen eine Aufzählungsliste formatierst (Zahlen oder Bullet-Points). Bei der Verwendung einer semantischen Liste sind Hilfstechnologien in der Lage, Informationen wie die Gesamtzahl der Elemente und die relative Position jedes Elements in der Liste zu übermitteln. Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/page-structure/content/#lists">semantische Listen.</a>',
    QA_UPPERCASE_WARNING: 'Text in Großbuchstaben gefunden. Einige Screenreader interpretieren Text in Großbuchstaben möglicherweise als Akronym und lesen jeden Buchstaben einzeln. Außerdem finden manche Leute, dass Großbuchstaben schwieriger zu lesen sind, und es kann den Anschein erwecken, als würden man SCHREIEN.',
    QA_DUPLICATE_ID: '<strong>Doppelte ID</strong> gefunden. Doppelte ID-Fehler verursachen bekanntermaßen Probleme für Hilfstechnologien, wenn man versucht, mit Inhalten zu interagieren. <hr> Bitte entferne oder ändere die folgende ID: <strong {r}>%(id)</strong>',
    QA_TEXT_UNDERLINE_WARNING: 'Unterstrichener Text kann mit Links verwechselt werden. Erwäge die Verwendung eines anderen Stils wie <code>&lt;strong&gt;</code><strong>starke Wichtigkeit</strong><code>&lt;/strong&gt;</code> oder <code>&lt;em&gt;</code ><em>Hervorhebung</em><code>&lt;/em&gt;</code>.',
    QA_SUBSCRIPT_WARNING: 'Die Formatierungsoptionen für tiefgestellten und hochgestellten Text sollten nur verwendet werden, um die Textposition für typografische Konventionen oder Standards zu ändern. Es sollte <strong>nicht</strong> ausschließlich zu Präsentations- oder Erscheinungszwecken verwendet werden. Das Formatieren ganzer Sätze wirft Lesbarkeitsprobleme auf. Geeignete Anwendungsfälle wären die Anzeige von Exponenten, Ordnungszahlen wie 4<sup>th</sup> anstelle von 4 und chemischen Formeln (z. B. H<sub>2</sub>O).',

    // Tables
    TABLES_MISSING_HEADINGS: 'Fehlende Tabellenüberschriften! Barrierefreie Tabellen benötigen eine HTML-Auszeichnung, die Kopfzellen und Datenzellen kennzeichnet und ihre Beziehung zueinander definiert. Diese Informationen liefern den Kontext für Menschen, die Hilfsmittel verwenden. Tabellen sollten nur für tabellarische Daten verwendet werden. <hr> Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/tables/">barrierefreie Tabellen.</a>',
    TABLES_SEMANTIC_HEADING: 'Semantische Überschriften wie Überschrift 2 oder Überschrift 3 sollten nur für Abschnitte des Inhalts verwendet werden; <strong>not</strong> in HTML-Tabellen. Gebe Tabellenüberschriften stattdessen mit dem <code>&lt;th&gt;</code> Element an. <hr> Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/tables/">barrierefreie Tabellen.</a>',
    TABLES_EMPTY_HEADING: 'Leerer Tabellenkopf gefunden! Tabellenüberschriften sollten <strong>niemals</strong> leer sein. Es ist wichtig, Zeilen- und/oder Spaltenüberschriften zu benennen, um ihre Beziehung zu verdeutlichen. Diese Informationen bieten Menschen, die Hilfsmittel verwenden, einen Kontext. Bitte beachte, dass Tabellen nur für tabellarische Daten verwendet werden sollten. <hr> Erfahre mehr über <a href="https://www.w3.org/WAI/tutorials/tables/">barrierefreie Tabellen.</a>',

    // Contrast
    CONTRAST_ERROR: 'Dieser Text hat nicht genügend Kontrast zum Hintergrund. Das Kontrastverhältnis sollte mindestens 4,5:1 für normalen Text und 3:1 für großen Text betragen. <hr> Das Kontrastverhältnis beträgt <strong {r}>%(cratio)</strong> für den folgenden Text: <strong {r}>%(sanitizedText)</strong>',
    CONTRAST_WARNING: 'Der Kontrast dieses Textes ist unbekannt und muss manuell überprüft werden. Stelle sicher, dass der Text und der Hintergrund einen starken Farbkontrast aufweisen. Das Kontrastverhältnis sollte mindestens 4,5:1 für normalen Text und 3:1 für großen Text betragen. <hr> <strong>Bitte überprüfen:</strong> %(sanitizedText)',
    CONTRAST_INPUT_ERROR: 'Der Text in dieser Eingabe hat nicht genügend Kontrast zum Hintergrund. Das Kontrastverhältnis sollte mindestens 4,5:1 für normalen Text und 3:1 für großen Text betragen. <hr> Kontrastverhältnis: <strong {r}>%(cratio)</strong>',
  },
};

export { de as default };
