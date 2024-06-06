# TP04 Relation

•	Créer l'entité Category avec la commande make:entity  
•	Dans le wizard…  
  o	Ajouter le champ name, de type string  
  o	Ajouter le champ wishes, de type OneToMany  
  o	Accepter la création de propriété dans Wish  
•	Mettre à jour la base de données  
•	Dans WishType.php :   
  o	Ajouter un ->add('category') de type EntityType, en renseignant bien les options class et choice_label  
•	Dans les fichiers Twig de detail et list :   
  o	Afficher la catégorie des idées avec {{ wish.category.name }}  
•	Idéalement, créer une requête personnalisée sur la page de list pour éviter les multiples requêtes à la base de données  
  
liste des catégories
- Voyage cette année
- Voyage pour plus tard
- Voyage improbable
- Voyage avec les copains


la maquette :
https://seven-valley.github.io/my-bucket-list-template/

le code html de la maquette:
https://github.com/seven-valley/my-bucket-list-template