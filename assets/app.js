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

document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.querySelector(".add-button");
    const searchForm = document.querySelector(".search-form");

    addButton.addEventListener("click", function (event) {
        if (searchForm.classList.contains("off")) {
            event.preventDefault();
            searchForm.classList.remove("off");
            searchForm.classList.add("d-flex");
        } else {
            event.preventDefault();
            searchForm.classList.remove("d-flex");
            searchForm.classList.add("off");
        }
    });
});

document.addEventListener("DOMContentLoaded", function (event) {
    const searchForm = document.querySelector(".search-form");
    let parent = document.getElementById("result");
    let search = document.getElementById("search").value;

    fetch("/movies/search?search=Star+Wars").then(function (response) {
        if (response.ok) {
            response.json().then(function (json) {
                let total = json.results.reduce(function(accumulator, element){return accumulator + buildSearchCard(element)}, "");
                parent.innerHTML = total;
            });
        } else {
            console.log('Network request for products.json failed with response ' + response.status + ': ' + response.statusText);
        }
    });
});

function buildSearchCard(media) {
    let parent = document.body;
    let template =
        `
            <div class="card media-card mb-4">
                <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/${media.poster_path}">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">${media.title}</h5>
                </div>
            </div>
        `;
    return template;
}

