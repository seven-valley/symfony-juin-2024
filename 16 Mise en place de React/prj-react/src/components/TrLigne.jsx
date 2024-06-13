export default function TrLigne({film,indice}) {
    return(
        <>
        <h2>{indice} - {film.title} {film.annee}</h2>
        </>
    )
}