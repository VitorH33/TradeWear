// Abrir e fechar 
const heartIcon = document.querySelector("#heart-icon");
const heart = document.querySelector(".heart");
const closeheart = document.querySelector("#heart-close");

heartIcon.addEventListener("click", () => {
  heart.classList.add("active");
});

closeheart.addEventListener("click", () => {
  heart.classList.remove("active");
});

// Começar quando o site carregar
if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", start);
} else {
  start();
}

function start() {
  addEvents();
}

function update() {
  addEvents();
  updateTotal();
}

function addEvents() {
  // Remover produto
  let heartRemove_btns = document.querySelectorAll(".heart-remove");
  console.log(heartRemove_btns);
  heartRemove_btns.forEach((btn) => {
    btn.addEventListener("click", handle_removeheartItem);
  });

  // Adicionar produto
  let addheart_btns = document.querySelectorAll(".add-heart");
  addheart_btns.forEach((btn) => {
    btn.addEventListener("click", handle_addheartItem);
  });

  const buy_btn = document.querySelector(".btn-buy");
  buy_btn.addEventListener("click", handle_buyOrder);
}

let itemsAdded = [];

function handle_addheartItem() {
  let product = this.parentElement;
  let title = product.querySelector(".product-title").innerHTML;
  let des = product.querySelector(".product-des").innerHTML;
  let imgSrc = product.querySelector(".product-img").src;
  console.log(title, des, imgSrc);

  let newToAdd = {
    title,
    des,
    imgSrc,
  };

  // Item já existe
  if (itemsAdded.find((el) => el.title == newToAdd.title)) {
    alert("Este item já foi adicionado");
    return;
  } else {
    itemsAdded.push(newToAdd);
  }

  // Adicionar produto
  let heartBoxElement = heartBoxComponent(title, des, imgSrc);
  let newNode = document.createElement("div");
  newNode.innerHTML = heartBoxElement;
  const heartContent = heart.querySelector(".heart-content");
  heartContent.appendChild(newNode);

  update();
}

function handle_removeheartItem() {
  this.parentElement.remove();
  itemsAdded = itemsAdded.filter(
    (el) =>
      el.title !=
      this.parentElement.querySelector(".heart-product-title").innerHTML
  );

  update();
}
// HTML
function heartBoxComponent(title, des, imgSrc) {
  return `
    <div class="heart-box">
        <img src=${imgSrc} alt="" class="heart-img">
        <div class="detail-box">
            <div class="heart-product-title">${title}</div>
            <div class="heart-des">${des}</div>
        </div>
        <i class='bx bxs-trash-alt heart-remove'></i>
    </div>`;
}
