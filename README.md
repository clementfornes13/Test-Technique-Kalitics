<a name="readme-top"></a>

<br />
<div align="center">
  <a href="https://github.com/clementfornes13/Kalitics">
  </a>
  <h3 align="center">Kalitics</h3>

  <p align="center">
    Test technique
    <br />
  </p>
</div>


<!-- SOMMAIRE -->
<details>
  <summary>Sommaire</summary>
  <ol>
    <li>
      <a href="#a-propos">A propos</a>
    </li>
    <li>
      <a href="#mise-en-place">Mise en place</a>
      <ul>
        <li><a href="#prerequis">Pré-requis</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#utilisation">Utilisation</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#ressources">Ressources utilisés</a></li>
  </ol>
</details>


<!-- A propos -->
## A propos


Ce projet Symfony permet de gérer les utilisateurs, les chantiers et les pointages associés. Il offre des fonctionnalités de création, lecture, mise à jour et suppression (CRUD) pour ces entités. 
Les données sont validées selon des contraintes spécifiques.

<p align="right">(<a href="#readme-top">Revenir en haut</a>)</p>


<!-- Mise en place -->
## Mise en place

### Pré-requis

    PHP
    Composer
    Symfony

* PHP
  ```sh
  https://www.php.net/downloads.php
  ```
* Composer
  ```sh
  https://getcomposer.org/download/
  ```
* Symfony
  ```sh
  https://symfony.com/download
  ```

### Installation

1. Cloner le dépôt
   ```sh
   git clone https://github.com/clementfornes13/Kalitics.git
   ```
2. Accédez au répertoire du projet :
   ```sh
   cd kalitics
   ```
3. Installez les dépendances du projet à l'aide de Composer :
   ```sh
   composer install
   ```
4. Configurez la base de données dans le fichier `.env` en spécifiant les informations de connexion appropriées.
   ```sh
   Exemple : DATABASE_URL=mysql://root:clement@127.0.0.1:3306/Kalitics
   ```
5. Créez la base de données en exécutant la commande suivante :
   ```sh
   php bin/console doctrine:database:create
   ```
6. Exécutez les migrations pour créer les tables de base de données :
   ```sh
   php bin/console doctrine:migrations:migrate
   ```
7. Lancez le serveur de développement Symfony :
   ```sh
   symfony server:start
   ```
8. Accédez à l'application dans votre navigateur à l'adresse suivante :
   ```sh
   http://localhost:8000
   ```
<p align="right">(<a href="#readme-top">Revenir en haut</a>)</p>


<!-- Exemples -->
## Utilisation

L'application offre les fonctionnalités suivantes :

- Gestion des utilisateurs :
- Création, lecture, mise à jour et suppression des utilisateurs.
- Gestion des chantiers :
- Création, lecture, mise à jour et suppression des chantiers.
- Affichage du nombre de personnes différentes ayant été pointées sur chaque chantier.
- Affichage du nombre d'heures cumulées pointées sur chaque chantier.
- Gestion des pointages :
- Liste des pointages existants.
- Création de nouveaux pointages sur un chantier.
- Validation des données :
 - Un utilisateur ne peut pas être pointé deux fois le même jour sur le même chantier.
 - La somme des durées des pointages d'un utilisateur pour une semaine ne peut pas dépasser 35 heures.


<p align="right">(<a href="#readme-top">Revenir en haut</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [x] Page Utilisateurs
- [x] Page Chantiers
- [x] Page Pointages
- [x] Respect du CRUD
- [x] Validation des données
- [x] Interface facile d'utilisation

<p align="right">(<a href="#readme-top">Revenir en haut</a>)</p>

<!-- Ressources utilisées -->
## Ressources

* [Symfony Documentation](https://symfony.com/doc/current/index.html)
* [Stack Overflow](https://stackoverflow.com/)
* [GitHub Copilot](https://github.com/features/copilot)

<p align="right">(<a href="#readme-top">Revenir en haut</a>)</p>

