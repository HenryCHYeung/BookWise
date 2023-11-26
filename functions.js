function searchModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function openBookModal(isbn) {
    var isbn_modal = document.getElementById(isbn);
    isbn_modal.style.display = "block";
}

function closeBookModal(isbn) {
    var isbn_modal = document.getElementById(isbn);
    isbn_modal.style.display = "none";
}