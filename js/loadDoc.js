function loadDoc() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    console.log('hi loads:', xhttp);
    document.getElementById("doc").innerHTML = this.responseText;
  };
  xhttp.open("GET", "public/files/example.txt");
  xhttp.send();
}


