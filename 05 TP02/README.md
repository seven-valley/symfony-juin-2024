•	Configurer la base de données dans le fichier .env.local  
•	Créer la base de données avec **phpMyAdmin**
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

# Détails de la  base
Il ne manque plus que des idées de choses à faire avant de mourir à ce site ! Il est maintenant temps de créer l'entité qui représente une idée. Cette entité (nommée Wish) doit avoir les propriétés suivantes : 
    
•	**title** (l'idée en tant que telle, 250 caractères max. Requis.)  
•	**description** (texte suivi décrivant l'idée plus en détail)  
•	**author** (pseudo de l'auteur. 50 caractères max. Requis.)  
•	**isPublished** (valeur booléenne indiquant si l'idée est actuellement visible sur le site)  
•	**dateCreated** (date et heure de création de l'idée)  
Configurez votre connexion à la base de données, créez-la et mettez-la à jour.  
  
Directement dans PHPMyAdmin, ajoutez 3 ou 4 idées, pour tester OU mieux, créez-vous une nouvelle route dans le WishController, et créez-y quelques instances de Wish avant de les sauvegarder avec l’EntityManager.   
  
Sur la page de liste d'idées, affichez le titre de toutes les idées publiées, de la plus récente à la plus ancienne. En cliquant sur une idée, l'utilisateur doit être mené à la page de détail de celle-ci. Dans Twig, vous aurez besoin des 2 arguments de la fonction path() pour générer ces liens.
  
La page de détails doit afficher le titre, la description, l'auteur et la date de création de l'idée. 
  
