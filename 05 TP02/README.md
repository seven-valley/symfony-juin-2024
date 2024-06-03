•	Configurer la base de données dans le fichier .env.local  
•	Créer la base de données avec php bin/console   doctrine:database:create  
•	S'assurer que l'interclassement de la base de donnée est en UTF8 dans PHPMyAdmin  
•	Générer l'entité Wish avec make dans l'invite de commande, avec les propriétés demandées  
•	Mettre à jour la base de données avec doctrine:schema:update –force
•	Dans WishController, dans la méthode list :   
  o	Récupérer les idées avec la méthode $repo->findBy()  
  o	Passer les idées à Twig avec le 2e argument de la fonction render()  
  
•	Dans list.html.twig :  
  o	utiliser une boucle pour afficher les idées une par une  
  o	ajouter une balise <a> autours de chaque idée, menant à la page détails  
  o	pour générer la bonne URL dans le href, utiliser la fonction path() avec ses 2 arguments  
•	Dans WishController, dans la méthode detail :   
  o	Récupérer l'idée en fonction de son identifiant avec la méthode $repo->find()  
  o	Passer l'idée à Twig  
•	Dans detail.html.twig :   
  o	Inutile de faire une boucle  
  o	Afficher tous les détails de l'idée  
