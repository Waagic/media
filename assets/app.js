/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

//Apparition formulaire de recherche

document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.querySelectorAll('.add-button');
    addButton.forEach(item => item.addEventListener("click", event => {
        let searchForm = item.nextElementSibling;
        console.log(searchForm);
        if (searchForm.classList.contains("off")) {
            event.preventDefault();
            searchForm.classList.remove("off");
            searchForm.classList.add("d-flex");
        } else {
            event.preventDefault();
            searchForm.classList.remove("d-flex");
            searchForm.classList.add("off");
        }
    }));
});

// Requete AJAX + affichage modale résultats recherche

document.addEventListener("DOMContentLoaded", function (event) {
    let parent = document.getElementById("result");
    let searchBtn = document.getElementsByClassName("search-btn");

    searchBtn.forEach(item => item.addEventListener("click", event => {
        let form = item.closest('.form-search');
        let value = form.querySelector('.search').value;
        let type = form.querySelector('.search').getAttribute("data-media-type");
        parent.innerHTML = "";
        fetch(`/${type}/search?search=${value}`).then(function (response) {
            if (response.ok) {
                response.json().then(function (json) {
                    console.log(json);
                    let total = json.results.reduce(function (accumulator, element) {
                        return accumulator + buildSearchCard(element, type)
                    }, "");
                    parent.innerHTML = total;
                });
            } else {
                console.log('Network request for products.json failed with response ' + response.status + ': ' + response.statusText);
            }
        });
    }));
});

// Cartes résultats modale

function buildSearchCard(media, type) {
    let parent = document.body;
    let template =
        `
            <div class="card media-card results-card mb-4 mx-2">
            <form action="/${type}/new" method="post">
                <input type="hidden" id="title" name="title" value="${media.title}">
                <input type="hidden" id="poster" name="poster" value="${media.poster}">
                <input type="submit" value="Ajouter" class="ml-2 btn btn-outline-success">
            </form>
                <img class="card-img-top" src="${media.poster}">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">${media.title}</h5>
                </div>
            </div>
        `;
    return template;
}

