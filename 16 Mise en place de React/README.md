# Module 16

**Mise en place de la liste de course avec React**


## le CRUD Versus API

```tsx
import axios, { AxiosResponse } from 'axios'

function App() {
  // a modifier
  const urlFire ='https://vip-eni-default-rtdb.europe-west1.firebasedatabase.app/';
  const ajouter = async()=>{
    let url =`${urlFire}personne.json`;
    let p:any ={prenom:'Brad',nom:'PITT'};
    const response = await axios.post<any>(url,p);
    console.log(response.data);
    console.log('id :'+ response.data.name)
  }
  const lecture = async()=>{
    let url =`${urlFire}personne.json`; // a modifier
    const response = await axios.get<any>(url);
    console.log(response.data);
    
    //-------------------------------------------
    let objet =response.data;
    // let attribut
    let personnes = [];
    for (let attribut in objet){
      console.log(attribut);
      let id = attribut
      // un objet est aussi un tableau (array)
      let personne = objet[id];
      personne.id = attribut;
      personnes.push(personne);
      console.log(personne);
    }
    console.log(personnes);
    //-------------------------------------------
  }
  const modifier = async()=>{
    let id = '-NyVqQdJrKVpXHF6PPUU'; // a modifier
    let obj ={nom:'CRUISE'}
    let url =`${urlFire}personne/${id}.json`;
    const response = await axios.patch<any>(url,obj);
    console.log(response.data);

    
  }
  const effacer = async()=>{
    let id = '-NyVqQdJrKVpXHF6PPUU'; // a modifier
    let url =`${urlFire}personne/${id}.json`;
    const response = await axios.delete<any>(url);
    console.log(response.data);
  }
  return (
    <>
    <button onClick={ajouter}>Ajouter</button><br /><br />
    <button onClick={lecture}>Lecture</button><br /><br />
    <button onClick={modifier}>Modifier</button><br /><br />
    <button onClick={effacer}>Effacer</button><br /><br />
    </>
  )
}

export default App
```