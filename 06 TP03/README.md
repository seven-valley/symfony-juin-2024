# TP 03 Créer le formulaire ajouter
- Mettre en place le formulaire pour Ajouter Wish
  
  

### ETAPE 1 Générer le formulaire
symfony console make:form Wish 
```php
 $builder
            ->add('title')
            ->add('annee')
            ->add('realisateur')
        ;
```

```php
 $builder
            ->add('title',null,['mapped'=>false])
            ->add('annee')
            ->add('realisateur')
        ;
```
**null** : je prends le type par default de l'attribut 'string'
pour générer un <input type="text">  
['mapped'=>false]  désactive l'Hydration automatique de l'Entity  

### ETAPE 2 Ajouter le css boostrap 5


**ajouter boostrap 5 aux formutlaires**  
    
config>pakages> twig.yaml  
  
ajouter cette ligne :  
```yaml
 form_themes: ['bootstrap_5_layout.html.twig']
```


```yaml
twig:
    file_name_pattern: '*.twig'
    form_themes: ['bootstrap_5_layout.html.twig']
when@test:
    twig:
        strict_variables: true
```
### ETAPE 3 Créer le controller "ajouter"
```php
#[Route('/ajouter', name: 'main_ajouter')]
    public function ajouter(EntityManagerInterface $em,Request $request)
    {
        
        $film = new Film(); // 1 je crée l'Entity Fil
        // 2 je relie le formulaire  $filmForm (FilmType)<=> Film Entity
        $filmForm = $this->createForm(FilmType::class,$film);
        // 3 J'hydrate avec le formulaire    $filmForm (FilmType)<=> Request
        $filmForm->handleRequest($request);
        // si le form SUBMIT
        if ($filmForm->isSubmitted() && $filmForm->isValid()){
            $film->setValid(true);
            $em->persist($film);
            $em->flush();
            return $this->redirectToRoute("main_home");
        }
        return $this->render('main/ajouter.html.twig', [
            'titre' => 'Ajouter',
            'filmForm'=> $filmForm->createView(),
        ]);
    }
```

### ETAPE 4 Mettre en place le formulaire dans la vue
La vue twig
Comment utiliser le formulaire ?
```twig
    {{form_start(filmForm)}}

    {{form_widget(filmForm)}}
    <button type="submit" class="btn btn-primary">Valider</button>
    {{form_end(filmForm)}}
```