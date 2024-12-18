console.log("connect");

const formSearch = document.forms.search;

//plan A
// const url = document.querySelector("#spanurl").dataset.url;

// plan B
console.log(url);
formSearch.addEventListener("submit", (e)=>{
    e.preventDefault();
    const valeur = formSearch.valeur.value;
    const champ = formSearch.champ.value;
    const limit = formSearch.limit.value;
    console.log(valeur, champ, limit);
    //path
    fetch(`${url}?value=${valeur}&limit=${limit}&champ=${champ}`)
    .then(response=>response.json())
    .then(result=>console.dir(result));
})