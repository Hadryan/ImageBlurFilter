Student : Popa Ramona Cristina	
Grupa   : 341C2

Descriere :

- Tema implementeaza aplicarea a douo variante de filtru blur pe imagini in format PGM P5.
- Aceste doua variante sunt:
• Mean filter
• Weighted average filter 
- “Blurarea” unei imagini consta in realizarea unei tranzitii de la o culoare la alta foarte lin luand in considerare  pentru fiecare pixel in parte culoare pixelilor vecini.

Continut arhiva:

- Tema contine doua fisiere de cod in PHP si este testata folosind imagini PGM P5 de dimensiuni diferite.
- Fisierul pgm.php contine clasa PGM in care se implementeaza doua functii de baza : 
• loadPGM -> folosita pentru a incarca o imagine in format PGM, imagine ce urmeaza sa fie blurata.
• savePGM -> salveaza imaginea in format PGM.
- Fisierul index.php contime implementarea efectiva a celor doua variante de blur :
• Mean filter 
• Weighted average filter
- Tot in aceasta arhiva am atasat si doua imagini de test de diferite dimensiuni, impreuna cu rezultatul obtinut pentru ultimul test realizat.

Mod de testare si rulare:

• Pasul I -> Prima data este necesara instalarea unui server de PHP. 
- Eu am folosit "EasyPHP DevServer 14.1 V" si este recomantat pentru testare folosirea aceleiasi versiuni deoarece este ultima aparuta.
- Aceasta se poate descarca de la urmatoarea adresa : http://www.easyphp.org/download.php
• Pasul II -> Se copiaza cele doua fisiere ce cod impreuna cu imaginea numita image.pgm pe care dorim sa o bluram in locatia unde am instalat serverul de PHP, mai exact in folderul localWeb.
- Standard aceasta locatie este urmatoarea : C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\data\localweb
- Daca dorim sa testam si cu imaginea mai mare (image1.pgm) nu trebuie decat sa redenumim aceasta inagine image.pgm.
• Pasul III -> Se posneste serverul 
- O instanta a serverului este in bara de start in dreapta sau in caz contrar clic pe butonul de start unde ar trebui sa apara sau sa putem cauta EasyPHP. Click pe acesta sa porneasca.
- Se da apoi click dreapta pe instanta pornita in bara de start in dreapta si se selecteaza optiunea "Local web".
- De obicei se deschide browserul. Daca nu, deschidem browserul folosit si in pagina deschisa, in chenarul unde se scrie URL-ul se pune IP-ul 127.0.0.1
- Se da refresh la pagina in cazul in care nu porneste aplicatia.
- Pagina ramane alba ceea ce inseamna ca nu sunt erori. 
- In locatia in care am copiat sursele -> C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\data\localweb vor aparea cele doua imagini blurate obtinute ca rezultat :
• image_mean.php  -> pentru Mean filter
• image_weight.php-> pentru Weighted average filter
- Cele doua imagini se pot deschide cel mai usor pe un sistem de operare Windows folosind Photoshop. 
- Pe Linux formatul imaginilor este recunoscut automat si acestea se deschid cu un simplu click pe ele.
- Alaturat acestui Readme am atasat si rezultatele obtinute la ultimul meu test, pentru valori diferite date ca intrare celor doua filtre.


Rezultate si performanta: 

- Timpi de rulare obtinuti pe calculatorul personal pentru fiecare imagine in parte sunt urmatorii:
-> Timp de executie algoritm Mean filter ->
• pentru imagine de dimensiune 400x250  -> Real : 0m5.842s - user : 0m5.862s - sys : 0m5.921s
• pentru imagine de dimensiune 1920x1200-> Real : 0m17.644s - user : 0m17.684s - sys:0m17.047s
-> Timp de executie algoritm Weighted average filter ->
• pentru o imagine de dimensiune 400x250  -> Real : 0m5.848s - user : 0m5.874s - sys : 0m5.931s
• pentru o imagine de dimensiune 1920x1200-> Real : 0m17.662s - user : 0m17.688s - sys : 0m17.050s
-Implementarile folosite au deci timpi de rulare asemanatori, diferentele fiind nesemnificarive.
- Varianta Weighted average filter face totusi mai multe calcule dar diferenta de timp nu este cu mult mai mare asa cum se poate observa din timpii obtinuti si atasati mai sus.
- Pentru date de intrade echivalente cele doua variante de blur returneaza rezultate identice ( imaginile blurate pe care le obtin sunt identice ).

Mod de implementare : 

• Fisierul pgm.php -> 
- Functia loadPGM deschide fisierul/imaginea de intrare si apoi citeste din ea dimensiunea imaginii (width si height), formatul imaginii (magicNumber), si valuarea de gri a fiecarui pixel (care este intre 0 si 255).
- Functia savePGM deschide fisierul pentru scriere si pe primul rand scrie formatul imaginii (adica acel magicNumber care este P5). 
  Pe randul doi se scrie dimensiunea imaginii (width si height).
  Apoi pe randul trei valoarea maxima de gri a pixelilor, care este 255. In final se scrie matricea de pixeli. 
• Fisierul index.php -> 
- Initial setam limitele mentru memorie si pentru timpul rularii. Apoi importam fisierul pgm.php. In continuare gasim implementarea celor doi algoritmi.
- Algoritmul Mean filter :
- parcurge imaginea si pentru fiecare pixel in parte face media aritmetica a pixelilor invecinati. 
- In aceasta abordare folosim si pixelul curent in calculul mediei. 
- Pentru a varia gradul de blurare variem numarul de pixeli vecini cu pixelul curent (range-ul) pe care ii luam in considerare la calculul mediei.
- Algoritmul Weighted average filter :
- Algoritmul parcurge imaginea si pentru fiecare pixel in parte face media aritmetica a pixelilor invecinati.
- In aceasta abordare pixelul curent nu este folosit in calculul mediei.
- Pixelul curent are o pondere diferita in calculul mediei in cazul Weighted average filter si aceasta pondere este salvata in variabila "center_pixel_weight". Aceasta va trebui variata pentru a testa cu diferite ponderi.
- Ponderea are valori intre "0" si "1" si reprezinta cat de mult conteaza pixelul curent
































