var cart = document.getElementById("cart");
var a = document.getElementById("acart");

a.addEventListener("mouseenter", function () {
    cart.classList.replace("bi-cart-fill", "bi-cart");
});

a.addEventListener("mouseleave", function () {
    cart.classList.replace("bi-cart", "bi-cart-fill");
});
