## 1.Uvod
### 1.1. Svrha dokumenta

Svrha ovog dokumenta je dati potpuni prikaz zahtjeva web aplikacije za promociju i praćenje 
omiljenih klubova. Prikaz je dan u tekstualnom obliku dodatno potkrijepljen različitim grafičkim 
materijalom. 

### 1.2. Cilj

Cilj ovog projekta je razvoj web aplikacije koja će krajnjem korisniku omogućiti niz 
funkcionalnosti u svrhu oglašavanja vlastitih i praćenja omiljenih klubova, ovisno o korisničkoj grupi 
kojoj korisnik pripada. Aplikacija definira dvije korisničke grupe vlasnika i registriranog korisnika, 
kojima nudi nekoliko funkcionalnosti koje su zajedničke ili pak karakteristične za pojedinu grupu 
korisnika. 

## 2. O aplikaciji

### 2.1. Korištene tehnologije (dodati verzije)

Za razvoj web aplikacije koristiti će se u najvećoj mjeri PHP programski jezik i Phalcon 
razvojni okvir, u kombinacije s potrebnim HTML-om, CSS-om i JavaScript. Za skladištenje podataka 
koristiti će se MySQL baza podataka.

### 2.2. Klase korisnika

Sama aplikacija definira dvije skupine korisnika: vlasnika kluba i registriranog. Skupine su 
odvojene prema funkcionalnostima koje su im na raspolaganju ali i ulozi. Naime vlasnik kluba 
promovira vlastiti klub i događaje koje organizira u istom, dok je na registriranom korisniku da 
oglase(događaje, klubove) ocjenjuje, komentira ili pak rezervira svoje mjesto na nadolazećem 
događaju.

### 2.3. Funkcionalnosti

Kako je već navedeno u prethodnom poglavlju aplikacija nudi više funkcionalnosti koje su 
karakteristične za pojedinu skupinu korisnika. U ovome poglavlju funkcionalnosti su samo navedene 
te dodijeljene pojedinim korisničkim skupinama, dok se iste detaljnije opisuju u slijedećem poglavlju.

|Broj|Funkcija|Vlasnik|Korisnik|
|----|--------|-------|--------|
|1.| Registracija |X|X|
|2.| Prijava |X|X|
|3.| Odjava |X|X|
|4.| Pregled klubova |X|X|
|5.| Pregled događaja |X|X|
|6.| Dodavanje klubova |X||
|7.| Dodavanje događaja |X||
|8.| Pretplata na klub |X|X|
|9.| Rezervacija na događaj |X|X|
|10.| Komentiranje |X|X|
|11.| Ocjenjivanje |X|X|

## 3.Opis funkcionalnosti

U ovom poglavlju predstavljene su sve mogućnosti web aplikacije koje su poredane logički te
prema prioritetu implementacije.

### 3.1. Registracija 

Kako bi korisnik iskoristio sve mogućnosti web aplikacije potrebno je stvaranje osobnog 
profila što je omogućeno direktno ispunjavanjem forme na web aplikaciji ili jednostavnije putem 
Facebook korisničkog računa. U oba slučaja potrebno je dohvatiti nekoliko informacija koje su 
potreban za ispravan rad sustava:

* E-mail adresa
* Password
* Ime i prezime 
* Korisničko ime
* Vrsta korisnika (vlasnik ili  obični korisnik)
* Spol

Ako je odabrana vrsta korisnika vlasnik potrebno je odmah prilikom registracije od njega zatražiti 
unos prvog kluba, a za istog potrebno je od vlasnika zatražiti:

* Ime kluba
* Adresa
* Tip glazbe
* Kratak opis
* Slike(max 5-10)

### 3.2.  Login

Obije skupine korisnika moraju imati mogućnost prijave na web aplikaciji ako imaju 
pravovaljan korisnički račun. 

### 3.3. Odjava

Odjavljivanje korisnika.

### 3.4. Pregled oglašenih klubova

Svim korisnicima nudi se mogućnost pregleda ranije oglašenih klubova u obliku popisa na 
više stranica. Svakom klubu potrebno je dodijeliti karticu u kojoj će biti prikazana pripadajuća slika, 
naziv, adresa, ocjena i kratki opis, dok se klikom na naziv otvara posebna web stranica na kojoj će  uz 
već navedene atribute biti omogućeno komentiranje, ocjenjivanje, popis događaja vezan uz klub i 
lokacija kafića na Google Maps karti. 

### 3.5. Pregled događaja

Kao što je navedeno u prethodnom poglavlju istovjetno vrijedi i za događaje koje ćemo 
prikazivati u obliku popisa. Također nudi se mogućnost da se korisnici rezerviraju na event tako da 
dobivaju ažurne obavijesti o istom.

### 3.6. Dodavanje događaja

Vlasniku kluba nudi se mogućnost objavljivanje organiziranih događaja u vlastitom objektu u 
svrhu promoviranja istih.  Objava je moguća putem forme na web aplikaciji ili jednostavnim unosom 
Facebook ID određenog eventa. U oba slučaja potrebno je dohvatiti:
* Naslov događaja
* Opis događaja
* Datum
* "Akcija"
**// Dodavanje s naše app na FB**

### 3.7. Dodavanje kluba

Vlasnicima klubova osim dodavanja  prvog kluba prilikom registracije omogućena je i kasnija
objava drugih klubova. Također potrebno je uzeti iste podatke kao i prilikom registracije.

### 3.8. Pretplata na klub

Svim korisnici imaju mogućnost pretplate na omiljene klubove te mogu primati informacije 
na vlastiti mail o događajima koji se organiziraju u njima.

### 3.9. Rezervacija na događaj

Ova funkcionalnost korisnika dodaje na popis gostiju  koji će posjetiti određeni event.

### 3.10. Komentiranje

Korisnicima se nudi mogućnost komentiranja događaja i klubova.

### 3.11. Ocjenjivanje

Korisnicima se nudi mogućnost ocjenjivanja komentara i klubova.

**PODJELA POSLOVA, BAZA**











