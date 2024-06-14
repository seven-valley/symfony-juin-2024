# Créer un Controller
```sh
php bin/console make:controller MainController 
```

# Vider le cache
```sh
php bin/console clear:cache 
```
autre :
```sh
php bin/console c:c 
```

# Debugger les routes
```sh
php bin/console debug:router
```

# Créer une Entity et modifier une Entity
```sh
php bin/console make:entity Personne
```
# Créer un formulaire en fonction d'une Entity
```sh
php bin/console make:form 
```

# Créer les tables SQL en fonction des Entity
```sh
php bin/console doctrine:shema:update --force
```

```sh
php bin/console d:s:u -f
```

# la commande interdite :)
```sh
php bin/console make:crud Personne
```
