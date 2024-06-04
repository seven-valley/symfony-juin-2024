# TP 03 Créer le formulaire ajouter
```
symfony console make:form Wish
```

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
