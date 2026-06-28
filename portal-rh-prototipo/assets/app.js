const titles = {
  inicio: "Resumo do funcionario",
  perfil: "Meu perfil",
  horas: "Banco de horas",
  folha: "Folha de pagamento",
  atestados: "Historico de atestados",
  ferias: "Ferias"
};

const menuButtons = document.querySelectorAll("[data-section]");
const sections = document.querySelectorAll(".section");
const pageTitle = document.querySelector("#page-title");
const toast = document.querySelector("#toast");

function openSection(sectionId) {
  sections.forEach((section) => {
    section.classList.toggle("active", section.id === sectionId);
  });

  document.querySelectorAll(".menu-item").forEach((button) => {
    button.classList.toggle("active", button.dataset.section === sectionId);
  });

  pageTitle.textContent = titles[sectionId] || "Portal RH";
  window.scrollTo({ top: 0, behavior: "smooth" });
}

menuButtons.forEach((button) => {
  button.addEventListener("click", () => openSection(button.dataset.section));
});

document.querySelector("#download-payslip").addEventListener("click", () => {
  const payslipText = [
    "Portal RH - Previa de Folha de Pagamento",
    "Funcionario: Mariana Souza",
    "Competencia: Junho/2026",
    "Liquido previsto: R$ 3.842,90",
    "",
    "Arquivo demonstrativo gerado pelo prototipo front-end."
  ].join("\n");

  const file = new Blob([payslipText], { type: "text/plain;charset=utf-8" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(file);
  link.download = "previa-folha-mariana-souza.txt";
  link.click();
  URL.revokeObjectURL(link.href);

  toast.classList.add("visible");
  setTimeout(() => toast.classList.remove("visible"), 2600);
});

const vacationStart = new Date("2026-07-16T08:00:00");
const today = new Date("2026-06-19T08:00:00");
const diffTime = vacationStart.getTime() - today.getTime();
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

document.querySelector("#vacation-countdown").textContent = diffDays;
