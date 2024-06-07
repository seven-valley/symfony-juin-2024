# Authentification

## La creation de l'entité User
**make:user**
Générer l'Entity User  
```
symfony console make:user
```
1 choisir default [User]  
2 default[yes] perstence en data base avec doctrine  
3 default [email] unique  
4 default encode password  

```
symfony console d:s:u -f
```
  
**make:auth**  
```
symfony console make:auth
```
Génerer le controller de Login  
Génerer la page twig de login  

[1] login  
AppCustomAuthenticator  
SecurityController  
[yes] logout  
[yes] remember me  


**make:registration-form**  
```
symfony console make:registration-form
```
[yes] unique entity  
[no] attention ! ne pas envoyer le mot de passe  
[no] pas de login apres ajout  
[lien] de la page de redirection après ajout  
[no] pas de test unitaire  

allez sur la route /register  
pour ajouter un Utilisateur  
  
Préparer la page Home du back office ou dashboard  
AppCustomAuthenticator ligne 49 rediriger vers la route du dashboard  
  
Securiser les routes par lots  
config>package>security.yaml  