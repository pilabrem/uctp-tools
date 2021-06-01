
## UCTP Tools

### Installation

Veuillez suivre les étapes suivantes pour installer et configurer ces outils de l'UCTP

- Vous devez avoir au préalable un environnement de développement fonctionnel : WAMP, XAMP, LAMP, Easy PHP, Laragon, ...
- Vous devez installer **Composer** et **Git**
- Créer une base de données MySQL
- Cloner le projet depuis Github sur votre machine
- Dupliquer le fichier *.env.example* avec le nom *.env*
    Dans le fichier *.env*, 
    - Mettre le nom de la base de données dans le champ **DB_DATABASE=**
    - Mettre le nom d'utilisateur de la base de données dans le champ **DB_USERNAME=**
    - Mettre le mot de passe de l'utilisateur dans le champ **DB_PASSWORD=**
- Exécuter la commande : **composer update** dans le dossier du projet. Cette commande va installer et mettre à jour les dépendances.
- Exécuter la commande : **php artisan migrate** dans le dossier du projet. Cette commande va créer les tables dans la base de données
- Et pour tester l'application, lancez la commande **php artisan serve** et allez sur votre navigateur à l'adresse **http://127.0.0.1:8000**

