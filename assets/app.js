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

document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".add-button");
    const searchForm = document.querySelector(".search-form");

    addButton.addEventListener("click", function(event) {
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