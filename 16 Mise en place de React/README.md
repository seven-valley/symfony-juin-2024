# Module 16

**Mise en place de la liste de course avec React**

## Ajouter Bootstrap au projet React
 ```
 npm i react-bootstrap bootstrap
 ```
### le catalogue bootstrap
https://getbootstrap.com/docs/5.3/components/buttons/
   
## Ajouter Font Awesome au projet React
```
npm install --save-dev @fortawesome/fontawesome-free
```

### Importer Boostrap et Font  Awesome
  
**Main.tsx***  
  
```ts
import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App.tsx'
import './index.css'

import 'bootstrap/dist/css/bootstrap.min.css'; // ici 
import '@fortawesome/fontawesome-free/css/all.min.css'; // ici on ajoute

ReactDOM.createRoot(document.getElementById('root')!).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
)
```

### le catalogue Font Awesome
https://fontawesome.com/search


## Lancer le projet React
```
npm run dev
```



  

**App.jsx**
```jsx
import axios from 'axios';
import { useEffect, useState } from 'react'
import TrLigne from './components/TrLigne.jsx';

export default function App() {
  const url = 'http://localhost:8000/api/film';
  const [films,setFilms] = useState([]) ;
  const [info,setInfo] = useState('') ;// useState('')  valeur par default
  const loadData =async ()=>{
    const response = await axios.get(url);
    console.log(response.data);
    setFilms(response.data);
  }
  useEffect(()=>{
    console.log('abac');
    loadData();
  },[]); //[] excuté 1 fois au demarrage

  const ajouter = async (e)=>{
    e.preventDefault(); //je bloque l envoie du formulaire
    const title = e.target.title.value;
    const annee = e.target.annee.value;
    setInfo(title+' '+annee);
    //console.log(info); ''
    const film ={}; // créer un objet
    film.title =title;
    film.annee = annee;
    const response =  await axios.post(url,film);
    const newFilm = response.data;
    console.log(newFilm);
    films.push(newFilm);
  }

  return (
    <>
      <h1>Hello world !</h1>
      <form method="post" onSubmit={ajouter}>
        <input type="text" name="title" placeholder="Titre"/>
        <br /><br />
        <input type="text" name="annee" placeholder="Année"/>
        <br /><br />
        <button type="submit">GO</button>
      </form>
      <h1>{info}</h1>
      {
        films && films.map((film,i)=> <TrLigne key={i} film={film} indice={i}/>)
      }
    </>
  )
}
```
**TrLigne.jsx**
```jsx
export default function TrLigne({film,indice}) {
    return(
        <>
        <h2>{indice} - {film.title} {film.annee}</h2>
        </>
    )
}
```