# Création d'une API
- Création d'une Entity **Film**

Film
 - title  
 - annee  
   

## les routes

 <code>POST</code> <code><b>/</b>api<b>/</b>film</code>  Ajouter un film     `{"title":"The Matrix","annee":"1999"}`   
<code>GET</code> <code><b>/</b>api<b>/</b>film</code> Afficher la liste    
<code>PUT</code> <code><b>/</b>api<b>/</b>film<b>/{id}</b></code> Modifier un film `{"title":"The Matrix","annee":"2009"}`  
<code>DELETE</code> <code><b>/</b>api<b>/</b>film<b>/{id}</b></code> Effacer un film  

## Méthode POST
### Ajouter un film 
**POST**
le controller
```php
 #[Route('/api/film', name: 'api_post_film', methods: ['POST'])]
    public function ajouter(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        // permet de desrialiser et d'hydrater
        $film = $serializer->deserialize($request->getContent(), Personne::class, 'json');
        $film->setIsComing(true);
        $em->persist($film);
        $em->flush();
        return $this->json($film);
    }
```
la vue en vanilla JavaScript
```html

```


## Lister les Films
```php

```
