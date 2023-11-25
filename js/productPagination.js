function changePage() {
  document.addEventListener("DOMContentLoaded", function () {
    var list = document.getElementById("productPagination");
    var items = list.getElementsByTagName("li");

    for (var i = 0; i < items.length; i++) {
      items[i].addEventListener("click", function () {
        for (var j = 0; j < items.length; j++) {
          items[j].classList.remove("active");
        }

        this.classList.add("active");
      });
    }
  });
}

function productPagination() {
  var noItem = document.getElementById("itemsPerPage").value;
  var page = $("#productPagination .active").text();
  getProducts(noItem, page - 1);
}

changePage();
