export default function TrLigne({ item,modifier,enlever,indice }) {
  return (
    <tr className={`table-${  item.buy ? 'danger':'success'}`}>
      <td>{item.nom}</td>
      <td>
        <button className="btn btn-danger" onClick={()=> enlever(indice)}>
          <i className="fa fa-trash"></i>
        </button>
      </td>
      <td>
        <button className="btn btn-warning" onClick={()=> modifier(indice)}>
          <i className="fa fa-check"></i>
        </button>
      </td>
    </tr>
  );
}
