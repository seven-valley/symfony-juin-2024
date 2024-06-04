# TP 03 Créer le formulaire ajouter

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

- Mettre en place le formulaire pour Ajouter Wish

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

La vue twig
Comment utiliser le formulaire ?
```twig
    {{form_start(filmForm)}}

    {{form_widget(filmForm)}}
    <button type="submit" class="btn btn-primary">Valider</button>
    {{form_end(filmForm)}}
```