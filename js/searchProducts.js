function searchProducts(searchTerm) {
  var results = document.getElementById("searchResults");

  if (searchTerm) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var products = JSON.parse(xhttp.responseText);
        var resultHtml = "<ul class='list-group position-absolute top-4 bg-white border border-top-0 w-25'>";
        for (var i = 0; i < products.length; i++) {
          resultHtml +=
            "<li class='p-2' ><a role='button' onclick='toProductDetailPage(" + products[i].productId + ")'>" + products[i].productName + "</a></li>";
        }
        if (!resultHtml) resultHtml += "No product founded!";
        results.innerHTML = resultHtml + "</ul>";
      }
    };
    xhttp.open("POST", "action/search_products.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("searchTerm=" + encodeURIComponent(searchTerm));
  } else {
    results.innerHTML = "";
  }
}
