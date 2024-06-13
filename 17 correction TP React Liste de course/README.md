# Correction liste de courses

![liste](liste.jpg)

# Partie Back end : symfony
ENTITY Item :
- nom (string)  
- isBuy (boolean)

## méthode : POST ajouter un item
```php
#[Route('/api/item', name: 'api_post_item', methods: ['POST'])]
    public function ajouter(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {      
        $item = $serializer->deserialize($request->getContent(), Item::class, 'json');
        $item->setBuy(false);
        $em->persist($item);
        $em->flush();
        return $this->json($item); // avec id = renseigner
    }
```
## méthode : GET afficher les liste des items
```php
 #[Route('/api/item', name: 'api_get_item', methods: ['GET'])]
    public function afficher(ItemRepository $repo): Response
    {
        return $this->json($repo->findAll());
    }
```

## méthode : PATCH modifier un item
```php
  #[Route('/api/item/{id}', name: 'api_patch_film', methods: ['PATCH'])]
    public function modifier(Item $item,EntityManagerInterface $em): Response
    {
        $item->setBuy(!$item->isBuy());
        $em->flush();
        return $this->json($item);
        
    }
```

## méthode : DELETE supprimer un item
```php
#[Route('/api/item/{id}', name: 'api_delete_film', methods: ['DELETE'])]
public function enlever(Item $item,EntityManagerInterface $em): Response
{
    $em->remove($item);
    $em->flush();
    return $this->json($item);
}
```