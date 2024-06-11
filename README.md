# JOUR 1
__lundi 3 juin__
- Créer un projet symfony 7
- Prise en main des maker
- Création d'un controller
- Twig afficher des variables
- Twig afficher un tableau
## :mortar_board: TP 01 Idées voyages 
- Créer plusieurs routes
- Afficher un tableau avec Twig


# JOUR 2
__mardi 4 juin__
- Démo Doctrine
- Créer une Entity
- Afficher une liste de films
- Afficher un film dans une page avec un **id**
- Ajouter un film avec EntityManager  
### :movie_camera: vidéo 01 - Symfony 7 demo création Entity avec Doctrine
## :mortar_board: TP 02 Idées voyages 
- Créer une Entity Wish
- Créer la table wish en base avec ( d:s:u -f)
- Afficher la page avec la liste des idées (wish)
- Utiliser **findBy** pour afficher que les isValid et par date DESC
- Afficher un page details pour notre wish avec **id**

- Démo du C de CRUD CREATE
- Mise en place de la route pour créer un Film
- Démo Création du Formulaire  FilmType
- Mise en place d'un formulaire dans twig

## :mortar_board: TP 03 Idées voyages 
- Ajouter un Wish
- Création de la route
- Création du formulaire wishType
- création du fichier twig

# JOUR 3
__mercredi 5 juin__
## :mortar_board: TP 04 VIP Cocktail
- Création de l'Entity Personne
- Création du controller
- Création du formulaire
- creation de la page twig
- Afficher la liste des personnes
- Ajouter une personne


# JOUR 4
__jeudi 6 juin__
- Création d'une 2eme Entity Categ pour les catégories
- Mise en place d'une relation **oneToMany**
- Afficher un menu deroulant dans le formulaire ('choice_label')
- Découverte de la commande **"interdite"** make:crud Entity

## :mortar_board: TP 05 Idées voyages 
- Création d'une 2eme Entity Categ pour les catégories
- Mise en place d'une relation **oneToMany**
- Afficher un menu deroulant dans le formulaire ('choice_label')
- Afficher les Idées en fonction des catégory sur la home page
- Faire le CRUD de Categ

# JOUR 5
__vendredi 7 juin__
**Mise en place de l'Authentification**
- Création de l'Entity User avec **make:user**
- Création de la page login avec **make:auth**
- Création du formulaire d'ajout de USER avec encodage du mot de passe **make:registration-form**
- Mise en place du fichier **security.yaml**
- Récupérer sur twig les informations de l'utilisateur NOM / Admin ou user
- Filtrer sur twig si la personne est ADMIN : les liens
## :mortar_board: TP 06 Idées voyages avec Back Office et Auth.
- Ajouter une Entity User
- Mettre en place le login
- Securiser les routes du back Office
- ajouter un Utilisateur


# Semaine 2

# JOUR 6
- création d'une relation ManyToMany sur l'entité Category
- utilisation d'un plugin select 2 pour le menu dans le formulaire 

## :mortar_board: TP 07 Créé des cocktail avec des ingrédients
- Créer une entity Cocktail
- Créer une entity Ingrédient
- Relier les Entity avec manytoMany
- installer select2 pour ajouter des ingrédients

## :mortar_board: TP 08 Le Team Builder
- Créer une Entity Equipe
- Créer une Entity Personne
- Relier les Entity avec manyToMany
- Ajouter une Equipes
- Ajouter une Personne dans une Equipes
- Supprimer une Equipe
- Supprimer une Personne
- Ajouter une personne de la liste des employées dans une equipe

# JOUR 7
- mise en place de requete AJAX
- Utilisation de JavaScript avec twig 

## :mortar_board: TP 09 Le Créateur de cocktails
- mettre en place une requete AJAX pour récupérer la liste des cocktails
- Filtre Javascript sur les couleur :
 - Utiliser javaScript sur la balise <select> 
 pour filtrer les cocktail en fct des couleur



# Semaine 2
- Mettre en place le **manyToMany** avec le Team Builder  
- Ajouter le plugin **select2** pour un manyToMany  
- La Validation de formulaire  
- les fixures 
- query builder ?? quezako
- Mettre en place des requetes **AJAX** avec Symfony avec Vanilla JS et fetch  
- Créer une **API** avec Symfony et la tester avec POSTMAN  
- Mettre en place React avec Symfony







# Les raccourcis VS CODE

## dupliquer une ligne
<kbd>Alt</kbd> + <kbd>Shift</kbd> + <kbd>fleche</kbd> (fleche haut et bas)

## deplacer la ligne ou un bloque
<kbd>Alt</kbd> +  <kbd>fleche</kbd>

## Modifier plusieurs occurance
Je met surbrillance puis x le nombre d'occurance  
<kbd>Ctrl</kbd> +  <kbd>D</kbd>  

## supprimer la ligne
<kbd>Ctrl</kbd> +  <kbd>Shift</kbd>  +  <kbd>k</kbd>  

## Ré indenter le code
<kbd>Shift</kbd> +  <kbd>Alt</kbd>  +  <kbd>f</kbd>  

## Rechercher dans tous les fichiers
<kbd>Ctrl</kbd> +  <kbd>Shift</kbd>  +  <kbd>f</kbd> 

# mettre en commentaire plusieurs lignes
<kbd>Ctrl</kbd> +  <kbd>/</kbd>

# Emmet
## Activer emmet
file > preferences > settings  
je tape "emmet"  
j'active trigger on tab  

# structure HTML
!+ <kbd>tab</kbd>

.container  
```html 
<div class="container"></div> 
 ```
.toto  
```html 
<div class="toto"></div> 
``` 
#titre
```html   
<div id="titre"></div>  
```

les tableaux :
```
table>thead>tr>th*6 
```

```
tbody>tr*2>td*3
````

```
table>thead>tr>th*3^^tbody>tr*2>td*3
```
Les tableaux
```html
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>0</td>
            <td>Brad</td>
            <td>PITT</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Tom</td>
            <td>Cruise</td>
        </tr>
    </tbody>
</table>
```

# Liens sympa
Admin panel  
https://themeforest.net/category/site-templates/admin-templates

Maquettes bootstrap  
https://startbootstrap.com/templates/landing-pages
https://startbootstrap.com/template/small-business

changer le themes de bootstrap  
https://bootswatch.com/




