var resul = window.confirm("Deseas imprimir tu factura?");
if (resul == true) {
  window.location = "generarFac.php";
} else {
  alert("Ok ten buen dia :)");
}
