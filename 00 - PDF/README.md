# Installation

**Installer le CLI**
Command Line Interface de Symfony  
https://symfony.com/download  

**créer un projet**  
https://symfony.com/doc/current/setup.html  


Création d'un projet : **premier**
```
symfony new premier --webapp
```

On va dans le reprtoire du projet créé
```
cd premier
code .
```

On lance le serveur :  
```
symfony server:start
```

# Vider le cache
```
symfony console cache:clear
```
```
symfony console c:c
```

# Afficher les routes
```
symfony console debug:router
```

# Créer une Entity 
```
symfony console make:entity
```
Autre possibilité
```
symfony console make:entity Film
```

# Créer une table en SQL à partir des Entities
 ```
symfony console doctrine:shema:update --force
```
 ```
symfony console d:s:u -f
```

# Création de formulaire
```
symfony console make:form Film
```

