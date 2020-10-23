function searchForm() {
    const addButton = document.querySelector(".add-button");
    const searchForm = document.querySelector(".search-form");

    console.log('Coucou');

    addButton.addEventListener("click", function(event) {
        event.preventDefault();
        searchForm.classList.remove("off");
        searchForm.classList.add("on");
    });
}