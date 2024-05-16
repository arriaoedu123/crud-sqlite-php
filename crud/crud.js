const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

function formatarNumero() {
  const input = document.getElementById("telefone");
  const numero = input.value;

  const digitsOnly = numero.replace(/\D/g, "");

  let numeroFormatado = "";
  if (digitsOnly.length <= 2) {
    numeroFormatado = digitsOnly;
  } else if (digitsOnly.length <= 6) {
    numeroFormatado = `(${digitsOnly.slice(0, 2)}) ${digitsOnly.slice(2)}`;
  } else if (digitsOnly.length <= 10) {
    numeroFormatado = `(${digitsOnly.slice(0, 2)}) ${digitsOnly.slice(
      2,
      6
    )}-${digitsOnly.slice(6)}`;
  } else {
    numeroFormatado = `(${digitsOnly.slice(0, 2)}) ${digitsOnly.slice(
      2,
      7
    )}-${digitsOnly.slice(7, 11)}`;
  }

  input.value = numeroFormatado;
}
