import axios from "axios";
import { useEffect, useState } from "react";
import TrLigne from "./components/TrLigne.jsx";

export default function App() {
  const url = "http://localhost:8000/api/item";
  const [items, setItems] = useState([]);
  const loadData = async () => {
    const response = await axios.get(url);
    console.log(response.data);
    setItems(response.data);
  };
  useEffect(() => {
     loadData();
  }, []); //[] excuté 1 fois au demarrage
  const modifier = async (indice) => {
    const response = await axios.patch(`${url}/${items[indice].id}`);
    items[indice] = response.data;
    console.log(response.data);
    setItems([...items]);
  }
  const enlever = async (indice) => {
    const response = await axios.delete(`${url}/${items[indice].id}`);
    items.splice(indice,1);
    setItems([...items]);
  }
  const ajouter = async (e) => {
    e.preventDefault(); //je bloque l envoie du formulaire
    const nom = e.target.nom.value;
    const item = {}; // créer un objet
    item.nom = nom;
    const response = await axios.post(url, item);
    const newItem = response.data;
    items.push(newItem);
    setItems([...items]);
    e.target.reset();
  };

  return (
    <>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="container">
          <a className="navbar-brand" href="#">
            <i className="fa-solid fa-cart-shopping me-4"></i>
            Liste de courses
          </a>
        </div>
      </nav>
      <div className="container">
        <form method="post" onSubmit={ajouter}>
          <div className="row">
            <div className="col-8">
              <div className="bg-gris p-4">
                <div className="row">
                  <div className="col-4">
                    <input type="text" name="nom" className="form-control" placeholder="Item" />
                  </div>

                  <div className="col-1">
                    <button type="submit" className="btn btn-success">
                      <i className="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div className="row">
          <div className="col-4">
            <table className="table table-striped mt-4">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Item</th>

                  <th colSpan="2">Actions</th>
                </tr>
              </thead>
              <tbody>
                {items &&
                  items.map((item, i) => (
                    <TrLigne key={i} item={item} indice={i} modifier={modifier} enlever={enlever}/>
                  ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <footer className="py-5 bg-dark">
        <div className="container px-4 px-lg-5">
          <p className="m-0 text-center text-white">
            Copyright &copy; Seven Valley 2023
          </p>
        </div>
      </footer>
      
    </>
  );
}
