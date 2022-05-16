var adios = document.getElementById("salir");

if (adios) {
  adios.addEventListener("click", (e) => {
    e.preventDefault();
    alert("hasta pronto :)");
    window.location = "../index.php";
  });
}
