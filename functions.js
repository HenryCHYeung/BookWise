let list_books = [];

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

function addToCart(book_name, book_price, isbn) {
    var cart_button = document.getElementById("cart" + isbn);
    cart_button.disabled = true;
    cart_button.innerHTML = "Added to Cart";
    cart_button.style.cursor = "default";
    list_books.push({bookName: book_name, price: book_price});
}

function loadCart() {
    sessionStorage.setItem('list_of_books', JSON.stringify(list_books));
    window.location.href = "cart.html";
}

function showCart() {
    var got_list = JSON.parse(sessionStorage.getItem('list_of_books'));
    cart_list = "";
    total_price = 0;
    price_display = document.getElementById("totalPrice");
    book_display = document.getElementById("bookList");
    for (i = 0; i < got_list.length; i++) {
        total_price += got_list[i].price;
        cart_list = cart_list + got_list[i].bookName + "<br/>";
    }
    price_display.innerHTML = "Total Price: $" + total_price.toFixed(2);
    book_display.innerHTML = cart_list;
}

function showShopModal() {
    var shop_modal = document.getElementById("shopModal");
    shop_modal.style.display = "block";
}

function closeShopModal() {
    var shop_modal = document.getElementById("shopModal");
    shop_modal.style.display = "none";
}