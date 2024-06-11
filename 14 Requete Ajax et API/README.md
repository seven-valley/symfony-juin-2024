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

## Bloquer circular reference
**#[Ignore]**

```php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]

class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Equipe>
     */
    #[Ignore]
    #[ORM\ManyToMany(targetEntity: Equipe::class, inversedBy: 'personnes')]
    private Collection $equipes;
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


