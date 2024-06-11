# Mise en place de requete Ajax avec Symfony

## Créer un route qui retourn du JSON
```php
 #[Route('/personne/liste2', name: 'personne_liste_2')]
    public function liste2(PersonneRepository $repo): Response
    {
           return $this->json($repo->findAll());
    }
```

## dans twig intérroger cette route

```html
<div id="demo">code ici</div>
<
<script>
async function go (){
let response = await fetch('http://127.0.0.1:8000/personne/liste2');
let users = await response.json();
console.log(users);
for (let u of users){
    let p = document.createElement('p');
    p.innerHTML = u.prenom; // <p>Bob<p>
    document.getElementById('demo').appendChild(p);
    console.log(u.prenom);
}
}
go();
</script>
```

## le Créateur de Coktail
  
  ![tp](tp.png)
   
Créer 3 Entity  
- **Cocktail**  
  - nom
  - fruit
    
- **Fruit**  
  - nom
  - couleur  

- **Couleur**
  - nom    

![diagramme](diagramme.webp)
  
### Objectif
- Ajouter le menu deroulant des couleurs
Afin de filtrer le menu déroulant des fruits

- Créer une requete Ajax pour récupérer le tableau de fruits avec sa couleur
- Lorsque je selectionne une couleur 
Reconstruire le menu deroulant des fruits en JavaScript


