const stage = document.querySelector("#stage");
const wrap = document.querySelector("#canvas-wrap");
const toast = document.querySelector("#toast");
const topRuler = document.querySelector("#top-ruler");
const leftRuler = document.querySelector("#left-ruler");
const tools = document.querySelectorAll(".tool");
const objectCount = document.querySelector("#object-count");
const cursorPosition = document.querySelector("#cursor-position");
const selectedLabel = document.querySelector("#selected-label");
const propX = document.querySelector("#prop-x");
const propY = document.querySelector("#prop-y");
const propW = document.querySelector("#prop-w");
const propH = document.querySelector("#prop-h");
const propText = document.querySelector("#prop-text");
const propColor = document.querySelector("#prop-color");
const zoomRange = document.querySelector("#zoom-range");
const zoomLabel = document.querySelector("#zoom-label");
const printerStatus = document.querySelector("#printer-status");
const taskText = document.querySelector("#task-text");
const taskCount = document.querySelector("#task-count");
const importFile = document.querySelector("#import-file");
const importModal = document.querySelector("#import-modal");
const closeImport = document.querySelector("#close-import");
const sampleImport = document.querySelector("#sample-import");
const mockFileGrid = document.querySelector("#mock-file-grid");

const tasks = [
  { text: "Crie um retangulo dentro da area da etiqueta.", type: "rect" },
  { text: "Adicione um texto de exemplo para praticar etiqueta.", type: "text" },
  { text: "Selecione um objeto e altere X ou Y no painel de propriedades.", type: "moved" },
  { text: "Clique em Simular para treinar o envio sem usar a impressora.", type: "simulated" }
];

let activeTool = "select";
let selectedId = null;
let drawing = null;
let dragging = null;
let zoom = 1;
let changedByPanel = false;
let simulated = false;
let taskIndex = 0;
let history = [];
let historyIndex = -1;
let objectClipboard = null;
let showTransparent = false;
let suppressMouseUntil = 0;

const baseObjects = [
  { id: crypto.randomUUID(), type: "rect", x: 805, y: 140, w: 26, h: 68, color: "#e7edf6", text: "" },
  { id: crypto.randomUUID(), type: "text", x: 792, y: 230, w: 86, h: 30, color: "#ffffff", text: "AMOSTRA" }
];
let objects = structuredClone(baseObjects);

function renderRulers() {
  topRuler.innerHTML = "";
  leftRuler.innerHTML = "";
  for (let i = 0; i <= 1300; i += 80) {
    const mark = document.createElement("span");
    mark.className = "ruler-mark";
    mark.style.left = `${i * zoom}px`;
    mark.textContent = i;
    topRuler.appendChild(mark);
  }
  for (let i = 0; i <= 720; i += 80) {
    const mark = document.createElement("span");
    mark.className = "ruler-mark";
    mark.style.top = `${i * zoom}px`;
    mark.textContent = i;
    leftRuler.appendChild(mark);
  }
}

function render() {
  stage.querySelectorAll(".object").forEach((node) => node.remove());
  stage.style.transform = `scale(${zoom})`;
  stage.style.width = "1400px";
  stage.style.height = "780px";
  stage.classList.toggle("show-transparent", showTransparent);

  objects.forEach((object) => {
    const node = document.createElement("div");
    node.className = `object ${object.type}${object.group ? " grouped" : ""}`;
    node.dataset.id = object.id;
    node.style.left = `${object.x}px`;
    node.style.top = `${object.y}px`;
    node.style.width = `${object.w}px`;
    node.style.height = `${object.h}px`;
    node.style.background = object.type === "text" ? "transparent" : object.color;
    node.style.borderColor = object.color === "#ffffff" ? "#f7fafc" : object.color;
    if (object.type === "line") {
      node.style.transform = "rotate(-18deg)";
    }
    if (object.type === "text") {
      node.textContent = object.text || "Texto";
      node.style.color = object.color;
    }
    if (object.type === "image") {
      node.style.backgroundImage = `url("${object.src}")`;
    }
    if (object.id === selectedId) {
      node.classList.add("selected");
    }
    stage.appendChild(node);
  });

  objectCount.textContent = `Objetos: ${objects.length}`;
  zoomLabel.textContent = `${Math.round(zoom * 100)}%`;
  zoomRange.value = Math.round(zoom * 100);
  renderRulers();
  syncInspector();
}

function currentObject() {
  return objects.find((item) => item.id === selectedId);
}

function syncInspector() {
  const object = currentObject();
  const disabled = !object;
  [propX, propY, propW, propH, propText, propColor].forEach((input) => {
    input.disabled = disabled;
  });

  if (!object) {
    selectedLabel.textContent = "Nada selecionado";
    propX.value = "";
    propY.value = "";
    propW.value = "";
    propH.value = "";
    propText.value = "";
    return;
  }

  selectedLabel.textContent = object.type;
  propX.value = Math.round(object.x);
  propY.value = Math.round(object.y);
  propW.value = Math.round(object.w);
  propH.value = Math.round(object.h);
  propText.value = object.text || "";
  propText.disabled = object.type !== "text";
  propColor.value = object.color;
}

function setTool(tool) {
  activeTool = tool;
  document.querySelector(".training-app").dataset.tool = tool;
  tools.forEach((button) => button.classList.toggle("active", button.dataset.tool === tool));
  wrap.style.cursor = tool === "select" ? "default" : tool === "zoom" ? "zoom-in" : "crosshair";
}

function pointFromEvent(event) {
  const rect = stage.getBoundingClientRect();
  return {
    x: Math.max(0, (event.clientX - rect.left) / zoom),
    y: Math.max(0, (event.clientY - rect.top) / zoom)
  };
}

function selectObject(id) {
  selectedId = id;
  render();
}

function makeObject(type, x, y, options = {}) {
  const object = {
    id: crypto.randomUUID(),
    type,
    x,
    y,
    w: type === "text" ? 84 : 8,
    h: type === "text" ? 32 : 8,
    color: type === "text" ? "#ffffff" : "#e7edf6",
    text: type === "text" ? "Texto" : "",
    ...options
  };
  if (type === "line") {
    object.w = options.w || 80;
    object.h = 3;
  }
  if (type === "pen") {
    object.w = options.w || 54;
    object.h = options.h || 12;
    object.color = options.color || "#d69b37";
  }
  return object;
}

function importImage(src, name = "imagem-importada", placement = {}) {
  const imageObject = makeObject("image", 700, 120, {
    w: placement.w || 170,
    h: placement.h || 130,
    x: placement.x || 700,
    y: placement.y || 120,
    src,
    color: "#ffffff",
    text: name
  });
  objects.push(imageObject);
  selectedId = imageObject.id;
  setTool("select");
  pushHistory();
  render();
  closeImportModal();
  showToast("Imagem importada para o trabalho.");
}

function sampleSvgData(kind) {
  const samples = {
    "patch-yellow": ["#f2b84b", "#222a35", "UV"],
    "patch-green": ["#4f9d69", "#ffffff", "R"],
    "patch-blue": ["#5f8fd9", "#ffffff", "IN"],
    "logo-white": ["#f8fafc", "#303746", "LOGO"],
    "label-red": ["#d86666", "#ffffff", "HOT"]
  };
  const [fill, ink, text] = samples[kind] || samples["patch-yellow"];
  const svg = [
    "<svg xmlns='http://www.w3.org/2000/svg' width='240' height='180' viewBox='0 0 240 180'>",
    "<rect width='240' height='180' fill='transparent'/>",
    `<path d='M42 28h116l40 34v90H42z' fill='${fill}' stroke='${ink}' stroke-width='8'/>`,
    `<path d='M158 28v38h40' fill='none' stroke='${ink}' stroke-width='8'/>`,
    `<text x='120' y='112' text-anchor='middle' font-family='Arial' font-size='44' font-weight='800' fill='${ink}'>${text}</text>`,
    "</svg>"
  ].join("");
  return `data:image/svg+xml;charset=utf-8,${encodeURIComponent(svg)}`;
}

function importSelectedMockFiles() {
  const selected = Array.from(document.querySelectorAll(".mock-file.selected"));
  if (!selected.length) {
    showToast("Selecione uma imagem para importar.");
    return;
  }
  const strip = document.querySelector("#print-strip");
  const startX = strip.offsetLeft - 6;
  const startY = strip.offsetTop + 12;
  const itemW = 38;
  const itemH = 34;
  selected.forEach((button, index) => {
    const sample = button.dataset.sample;
    const name = button.querySelector("span:last-child").textContent;
    const imageObject = makeObject("image", startX + index * (itemW + 4), startY, {
      w: itemW,
      h: itemH,
      src: sampleSvgData(sample),
      color: "#ffffff",
      text: name
    });
    objects.push(imageObject);
    selectedId = imageObject.id;
  });
  setTool("select");
  pushHistory();
  render();
  closeImportModal();
  showToast(`${selected.length} imagem(ns) importada(s) para treino.`);
}

function openImportModal() {
  importModal.hidden = false;
  importModal.classList.add("show");
}

function closeImportModal() {
  importModal.classList.remove("show");
  importModal.hidden = true;
}

function pushHistory() {
  history = history.slice(0, historyIndex + 1);
  history.push(JSON.stringify(objects));
  historyIndex = history.length - 1;
}

function restoreHistory(index) {
  if (index < 0 || index >= history.length) return;
  historyIndex = index;
  objects = JSON.parse(history[index]);
  selectedId = null;
  render();
}

function showToast(message) {
  toast.textContent = message;
  toast.classList.add("show");
  window.clearTimeout(showToast.timer);
  showToast.timer = window.setTimeout(() => toast.classList.remove("show"), 2400);
}

function updateTask() {
  taskText.textContent = tasks[taskIndex].text;
  taskCount.textContent = `${taskIndex + 1}/${tasks.length}`;
}

function checkCurrentTask() {
  const task = tasks[taskIndex];
  const passed = task.type === "moved"
    ? changedByPanel
    : task.type === "simulated"
      ? simulated
      : objects.some((object) => object.type === task.type);
  showToast(passed ? "Exercicio concluido. Pode avancar." : "Ainda falta esse passo no treino.");
  return passed;
}

tools.forEach((button) => {
  button.addEventListener("click", () => setTool(button.dataset.tool));
});

function beginCanvasAction(event) {
  const targetObject = event.target.closest(".object");
  const point = pointFromEvent(event);

  if (targetObject) {
    selectObject(targetObject.dataset.id);
    const object = currentObject();
    dragging = {
      id: object.id,
      dx: point.x - object.x,
      dy: point.y - object.y
    };
    return;
  }

  selectedId = null;
  if (activeTool === "zoom") {
    zoom = Math.min(1.6, zoom + 0.1);
    render();
    return;
  }

  if (activeTool === "select") {
    render();
    return;
  }

  const object = makeObject(activeTool, point.x, point.y);
  objects.push(object);
  selectedId = object.id;
  drawing = activeTool === "line" || activeTool === "text" || activeTool === "pen" ? null : { id: object.id, start: point };
  pushHistory();
  render();
}

function moveCanvasAction(event) {
  const point = pointFromEvent(event);
  cursorPosition.textContent = `X: ${point.x.toFixed(2)} Y: ${point.y.toFixed(2)}`;

  if (drawing) {
    const object = objects.find((item) => item.id === drawing.id);
    object.w = Math.max(8, point.x - drawing.start.x);
    object.h = Math.max(8, point.y - drawing.start.y);
    render();
  }

  if (dragging) {
    const object = objects.find((item) => item.id === dragging.id);
    object.x = Math.max(0, point.x - dragging.dx);
    object.y = Math.max(0, point.y - dragging.dy);
    render();
  }
}

function endCanvasAction() {
  if (drawing || dragging) {
    pushHistory();
  }
  drawing = null;
  dragging = null;
}

stage.addEventListener("pointerdown", (event) => {
  suppressMouseUntil = Date.now() + 500;
  beginCanvasAction(event);
});

stage.addEventListener("pointermove", moveCanvasAction);
window.addEventListener("pointerup", endCanvasAction);

stage.addEventListener("mousedown", (event) => {
  if (Date.now() < suppressMouseUntil) return;
  beginCanvasAction(event);
});

stage.addEventListener("mousemove", (event) => {
  if (Date.now() < suppressMouseUntil) return;
  moveCanvasAction(event);
});

window.addEventListener("mouseup", () => {
  if (Date.now() < suppressMouseUntil) return;
  endCanvasAction();
});

[propX, propY, propW, propH, propText, propColor].forEach((input) => {
  input.addEventListener("input", () => {
    const object = currentObject();
    if (!object) return;
    object.x = Number(propX.value || object.x);
    object.y = Number(propY.value || object.y);
    object.w = Math.max(4, Number(propW.value || object.w));
    object.h = Math.max(4, Number(propH.value || object.h));
    object.text = propText.value;
    object.color = propColor.value;
    changedByPanel = true;
    render();
  });
  input.addEventListener("change", pushHistory);
});

document.querySelector("#delete-selected").addEventListener("click", () => {
  if (!selectedId) return;
  objects = objects.filter((object) => object.id !== selectedId);
  selectedId = null;
  pushHistory();
  render();
});

document.querySelector("#new-job").addEventListener("click", () => {
  objects = [];
  selectedId = null;
  simulated = false;
  changedByPanel = false;
  pushHistory();
  render();
  showToast("Novo trabalho de treino criado.");
});

document.querySelector("#save-job").addEventListener("click", () => {
  localStorage.setItem("riin-training-job", JSON.stringify(objects));
  showToast("Treino salvo neste navegador.");
});

document.querySelector("#load-job").addEventListener("click", () => {
  const saved = localStorage.getItem("riin-training-job");
  if (!saved) {
    showToast("Nenhum treino salvo ainda.");
    return;
  }
  objects = JSON.parse(saved);
  selectedId = null;
  pushHistory();
  render();
  showToast("Treino salvo carregado.");
});

document.querySelector("#undo").addEventListener("click", () => restoreHistory(historyIndex - 1));
document.querySelector("#redo").addEventListener("click", () => restoreHistory(historyIndex + 1));

document.querySelector("#zoom-in").addEventListener("click", () => {
  zoom = Math.min(1.6, zoom + 0.1);
  render();
});

document.querySelector("#zoom-out").addEventListener("click", () => {
  zoom = Math.max(0.5, zoom - 0.1);
  render();
});

zoomRange.addEventListener("input", () => {
  zoom = Number(zoomRange.value) / 100;
  render();
});

document.querySelector("#simulate-print").addEventListener("click", () => {
  simulated = true;
  printerStatus.textContent = "RIP RIIN treino: simulacao concluida sem impressora";
  showToast("Simulacao RIP feita com sucesso. Este prototipo nao conecta na impressora.");
});

document.querySelector("#cmd-new").addEventListener("click", () => document.querySelector("#new-job").click());
document.querySelector("#cmd-save").addEventListener("click", () => document.querySelector("#save-job").click());
document.querySelector("#cmd-print").addEventListener("click", () => document.querySelector("#simulate-print").click());
document.querySelector("#cmd-undo").addEventListener("click", () => document.querySelector("#undo").click());
document.querySelector("#cmd-redo").addEventListener("click", () => document.querySelector("#redo").click());
document.querySelector("#cmd-delete").addEventListener("click", () => document.querySelector("#delete-selected").click());

document.querySelector("#cmd-import").addEventListener("click", openImportModal);
closeImport.addEventListener("click", closeImportModal);
importModal.addEventListener("click", (event) => {
  if (event.target === importModal) {
    closeImportModal();
  }
});
mockFileGrid.addEventListener("click", (event) => {
  const fileButton = event.target.closest(".mock-file");
  if (!fileButton) return;
  fileButton.classList.toggle("selected");
});

importFile.addEventListener("change", () => {
  const file = importFile.files?.[0];
  if (!file) return;
  if (!file.type.startsWith("image/")) {
    showToast("Escolha um arquivo de imagem.");
    importFile.value = "";
    return;
  }
  const reader = new FileReader();
  reader.addEventListener("load", () => {
    importImage(reader.result, file.name);
  });
  reader.readAsDataURL(file);
  importFile.value = "";
});

sampleImport.addEventListener("click", () => {
  importSelectedMockFiles();
});

document.querySelector("#cmd-copy").addEventListener("click", () => {
  const object = currentObject();
  if (!object) {
    showToast("Selecione um objeto para copiar.");
    return;
  }
  objectClipboard = { ...object };
  showToast("Objeto copiado.");
});

document.querySelector("#cmd-paste").addEventListener("click", () => {
  if (!objectClipboard) {
    showToast("Copie um objeto antes de colar.");
    return;
  }
  const pasted = {
    ...objectClipboard,
    id: crypto.randomUUID(),
    x: objectClipboard.x + 24,
    y: objectClipboard.y + 24,
    group: null
  };
  objects.push(pasted);
  selectedId = pasted.id;
  pushHistory();
  render();
  showToast("Objeto colado.");
});

document.querySelector("#cmd-group").addEventListener("click", () => {
  const object = currentObject();
  if (!object) {
    showToast("Selecione um objeto para marcar como grupo.");
    return;
  }
  object.group = object.group || crypto.randomUUID();
  pushHistory();
  render();
  showToast("Grupo criado para treino.");
});

function ungroupSelectedObject() {
  const object = currentObject();
  if (!object || !object.group) {
    showToast("Selecione um objeto agrupado para separar.");
    return;
  }
  object.group = null;
  pushHistory();
  render();
  showToast("Grupo separado.");
}

document.querySelector("#cmd-ungroup").addEventListener("click", ungroupSelectedObject);
document.querySelector("#cmd-split").addEventListener("click", ungroupSelectedObject);

document.querySelector("#cmd-fill").addEventListener("click", () => {
  const object = currentObject();
  if (!object || object.type === "image") {
    showToast("Selecione uma forma ou texto para alterar a cor.");
    return;
  }
  const colors = ["#e7edf6", "#f2b84b", "#51a3a3", "#d86666", "#ffffff"];
  const index = colors.indexOf(object.color);
  object.color = colors[(index + 1) % colors.length];
  pushHistory();
  render();
  showToast("Cor alterada.");
});

document.querySelector("#cmd-layout").addEventListener("click", () => {
  const object = currentObject();
  if (!object) {
    showToast("Selecione um objeto para centralizar na area.");
    return;
  }
  const strip = document.querySelector("#print-strip");
  object.x = strip.offsetLeft + (strip.offsetWidth - object.w) / 2;
  object.y = strip.offsetTop + (strip.offsetHeight - object.h) / 2;
  changedByPanel = true;
  pushHistory();
  render();
  showToast("Objeto centralizado na area de trabalho.");
});

document.querySelector("#cmd-show").addEventListener("click", () => {
  showTransparent = !showTransparent;
  render();
  showToast(showTransparent ? "Fundo transparente ligado." : "Fundo estreito ligado.");
});

document.querySelector("#cmd-tools").addEventListener("click", () => {
  document.querySelector(".inspector").classList.toggle("hidden-panel");
  showToast("Painel de treino alternado.");
});

document.querySelector("#zoom-out").addEventListener("dblclick", () => {
  zoom = 1;
  render();
  showToast("Preview ajustado para 100%.");
});

document.querySelector("#check-task").addEventListener("click", checkCurrentTask);
document.querySelector("#next-task").addEventListener("click", () => {
  if (taskIndex < tasks.length - 1) {
    taskIndex += 1;
    updateTask();
  } else {
    showToast("Sequencia de treino concluida.");
  }
});

document.querySelectorAll("[data-command]").forEach((button) => {
  button.addEventListener("click", () => {
    showToast("Ferramenta visual liberada para treino nesta versao.");
  });
});

pushHistory();
updateTask();
render();
