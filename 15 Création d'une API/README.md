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


# la route pour afficher twig pour le JavsScript
```php
#[Route('/', name: 'home', methods: ['GET'])]
    public function home(){
        return $this->render('home.html.twig');
    }
```
## Méthode POST
### Ajouter un film 
**POST**
le controller
```php
 #[Route('/api/film', name: 'api_post_film', methods: ['POST'])]
    public function ajouter(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        // le body : $request->getContent()
        // permet de deserialiser et d'hydrater
        // setTitle
        // setAnnee
        // setWatched attention true != 'true'
        $film = $serializer->deserialize($request->getContent(), Film::class, 'json');
        $em->persist($film);
        $em->flush();
        return $this->json($film); // avec id = renseigner
    }

```
la vue en vanilla JavaScript
```html
    <input id="title" placeholder="Titre">
    <br><br>
    <input id="annee" placeholder="Titre">
    <br><br>
    <button id="btnAjouter">Ajouter</button>
    <!-- le cdn de axios -->
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let films =[];
    const url ='http://localhost:8000/api/film';
    
    //document.getElementById('btnAjouter').onclick=function (){
    document.getElementById('btnAjouter').onclick= async()=>{
        // lecture des champs input
        const title =  document.getElementById('title').value;
        document.getElementById('title').value=''; // vider le champ input
        const annee =  document.getElementById('annee').value;
        document.getElementById('annee').value=''; // vider
        const film ={}; // créer un objet
        film.title =title;
        film.annee = annee;
        const response =  await axios.post(url,film);
        const newFilm = response.data;
        films.push(newFilm);
        afficherFilms();
        //console.log(response.data);
    }
</script>
```

## Méthode GET
**GET**
## Lister les Films
```php
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Annee</th>
        </tr>
    </thead>
    <tbody id="tbody">
    <!--
        <tr>
            <td>The Matrix</td>
            <td>The Matrix</td>
            <td>The Matrix</td>
        </tr>
    -->
    </tbody>
    </table>
     <template id="ligneTr">
        <tr data-toto="abc" data-id="42">
            <td>1</td>
            <td>The Matrix</td>
            <td>1999</td>
            <td>
                <button class="del">DELETE</button>
            </td>
        </tr>
    </template>
    <!-- [...] -->
    <script>
    //[...]
    const  afficherFilms=()=>{
        const tbody = document.getElementById('tbody');
        tbody.innerHTML =''; // vider le tableau HTML
        const template = document.getElementById('ligneTr');
        for (let film of films){
            // je clone le template
            const clone = template.content.cloneNode(true);
            let td = clone.querySelectorAll("td");
            let tr = clone.querySelector("tr");
            //tr.setAttribute('data-id',film_id); // ajouter id
            td[0].textContent = film.id;
            td[1].textContent = film.title;
            td[2].textContent = film.annee;
            let btnDel = clone.querySelector(".del");
            btnDel.onclick = async (evt)=>{
                // axios delete
               // let id =  evt.target.closest('tr').dataset.id
                let url2 = url +'/' +film.id;
                const response = await axios.delete(url2);
                console.log(response.data);
                loadFilm();
            }
            tbody.appendChild(clone);
        }
    }
    // async function loadFilm  (){
    const loadFilm = async ()=>{
        const response = await axios.get(url);
        films = response.data;
        // afficher le tab js ds le tableau
        afficherFilms();
    }
    loadFilm();
    </script>
```
