# Application Symfony4
Cette application Symfony4 vous permet de gérer des utilisateurs, chantiers et des pointages.

## Installation

1. Clonez le dépôt GitHub sur votre machine locale en utilisant `git clone <url_du_dépôt>`.

2. Utilisez Composer pour installer les dépendances. Dans le répertoire du projet, exécutez :

composer install

3. Créez une copie de votre fichier `.env` et renommez-le en `.env.local`. Mettez à jour ce fichier avec les détails de votre base de données.

4. Créez la base de données avec la commande suivante :

php bin/console doctrine:database:create

5. Exécutez les migrations avec la commande suivante :

php bin/console doctrine:migrations:migrate

6. Lancez le serveur Symfony avec la commande suivante :

symfony server:start

7. Ouvrez votre navigateur et accédez à `http://localhost:8000` pour commencer à utiliser l'application.
