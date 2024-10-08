var modal = document.getElementById("modal");
var modalNome = document.getElementById("modal-nome");
var modalDescricao = document.getElementById("modal-descricao");
var modalCategoria = document.getElementById("modal-categoria");
var modalTamanho = document.getElementById("modal-tamanho");
var modalMainImage = document.getElementById("modal-main-image");
var currentSlide = 0;
var images = [];

function openModal(nome, descricao, categoria, tamanho, imgs) {
    modal.style.display = "block";
    modalNome.textContent = nome;
    modalDescricao.textContent = descricao;
    modalCategoria.textContent = "Categoria: " + categoria;
    modalTamanho.textContent = "Tamanho: " + tamanho;
    images = imgs.filter(img => img && img !== ''); 
    currentSlide = 0;
    showSlide(currentSlide);
}

function closeModal() {
    modal.style.display = "none";
}

function changeSlide(n) {
    currentSlide += n;
    if (currentSlide >= images.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = images.length - 1;
    }
    showSlide(currentSlide);
}

function showSlide(n) {
    modalMainImage.src = images[n];
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}