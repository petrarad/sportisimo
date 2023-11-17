Cílem je tento grafický návrh naprogramovat jako funkční aplikaci v PHP za pomoci Nette frameworku, databáze MySQL, SASS a knihovny Materialize (http://materializecss.com).
Samozřejmě je možné, že některé z technologií nebudete přímo znát. Pro nás je hlavně důležité, jestli jste schopen se případně o dané technologii něco doučit a pokusit se použít.
Požadované funkce (implementovat vlastním kódem, bez použití volně šiřitelných gridů apod.):

1. Vylistování všech značek
   a. Řazení pomocí názvu značky (vzestupně, sestupně)
   b. Stránkování (včetně změny počtu položek na stránku)
   c. Editace značky – jednoduchý popup (není součástí návrhu, nechám na Vás)
   d. Smazání značky
2. Přidání nové značky – jednoduchý popup (není součástí návrhu, nechám na Vás)
   Očekávané výstupy:
1. Návrh databáze – v čitelné podobě (ideálně ER diagram) – png, pdf
2. SQL pro vytvoření a iniciální naplnění databáze
3. Zdrojové kódy aplikace + composer.json soubor popisující závislosti aplikace
4. CSS knihovna frameworku Materialize CSS, připojená do aplikace
5. SASS soubor s vlastními styly (přizpůsobení prvků knihovny Materialize)
6. Přeložený SASS soubor ve formě CSS, připojený do aplikace
   
Ve Vašem případě, protože se ucházíte o post team leadera, nebudeme brát příliš zřetel na body 4.-6., ale i tak by mělo výsledné řešení nějak vypadat 😊.

Záleží na Vašem volném čase, který je nutný k vypracování úkolu věnovat. Spíše se věnujte čistotě kódu, jeho bezpečnosti a udržitelnosti, které jsou pro nás důležitějším kritériem nežli čas. :) Klademe důraz na bezpečnost a čistotu kódu jako když jde do produkce resp. neměl by padat v chybách. Vnímáme i ošetření krajních stavů...


---


1. Nastaveni Dockerfile

https://github.com/dyarleniber/docker-php

docker-compose build app

docker-compose up -d

2. Stažení nette   

git clone https://github.com/nette/web-project

3. Composer install
 
sudo apt-get install zip unzip php5.6-zip

docker-compose exec app composer install

---

Failed to execute 

git clone --no-checkout '/root/.composer/cache/vcs/https---github.com-nette-web-project.git/' '/var/www/test' --dissociate --reference '/root/.composer/cache/vcs/https---github.com-nette-web-project.git/' && cd '/var/www/test' && git remote set-url origin -- 'https://github.com/nette/web-project.git' && git remote add composer -- 'https://github.com/nette/web-project.git'


git clone --no-checkout '/root/.composer/cache/vcs/https---github.com-nette-latte.git/' '/var/www/nette/vendor/latte/latte' --dissociate --reference '/root/.composer/cache/vcs/https---github.com-nette-latte.git/' && cd '/var/www/nette/vendor/latte/latte' && git remote set-url origin -- 'https://github.com/nette/latte.git' && git remote add composer -- 'https://github.com/nette/latte.git'