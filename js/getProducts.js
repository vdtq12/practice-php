function getProducts(noItem, page) {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var xmlDoc = xhttp.responseXML;

      var products = xmlDoc.getElementsByTagName("product");
      var total_products = xmlDoc.getElementsByTagName("total_products")[0].textContent;
      var productTable = document.getElementById("productTable");

      // build table
      var tableHtml = "<table border='1'>"; 
      tableHtml += "<tr><th>productId</th><th>productName</th><th>prices</th></tr>";
      for (i = 0; i < products.length; i++) {
        tableHtml += "<tr><td>";
        tableHtml +=
          products[i].getElementsByTagName("productId")[0].childNodes[0]
            .nodeValue;
        tableHtml += "</td><td>";
        tableHtml +=
          products[i].getElementsByTagName("productName")[0].childNodes[0]
            .nodeValue;
        tableHtml += "</td><td>";
        tableHtml +=
          products[i].getElementsByTagName("prices")[0].childNodes[0].nodeValue;
        tableHtml += "</td></tr>";
      }
      tableHtml += "</table>";

      // build pagination
      var countLast
      var pagination = document.getElementById("productPagination");
      var paginationHtml = `<li class='page-item' ${page==0 && 'disable'}><a class='page-link'><span aria-hidden='true' href=''>&laquo;</span></a></li>`
      for (i=1; i < total_products / noItem + 1; i++){
        countLast = i;
        paginationHtml += `<li class="page-item ${page+1==i && 'active'}"><a class="page-link" href="" onclick="productPagination()">${i}</a></li>`
      }
      paginationHtml += `<li class='page-item' ${page+1==countLast && 'disable'}><a class='page-link'><span aria-hidden='true' href=''>&raquo;</span></a></li>`

      // append
      productTable.innerHTML = tableHtml;
      pagination.innerHTML = paginationHtml;
    }
  };
  var url = "action/get_products.php?noItem=" + encodeURIComponent(noItem)+"&page=" + encodeURIComponent(page);
  xhttp.open("GET", url, true);
  xhttp.setRequestHeader("Content-Type", "text/xml");
  xhttp.send();
}
