const formulario = document.getElementById("formulario");
const enviar = document.getElementById("enviar");
const contenido = document.getElementById("contenido");

if (enviar) {
  enviar.addEventListener("click", (e) => {
    e.preventDefault();

    const datos = new FormData(formulario);

    fetch("photo/updatephoto.php", {
      method: "POST",
      body: datos,
    })
      .then((res) => res.text())
      .then((info) => {
        if (info == "") {
          alert("fallo al subir");
        } else {
          alert("subida corectamente");
        }
      });
  });
}
