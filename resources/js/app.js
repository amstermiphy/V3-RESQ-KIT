import "./bootstrap";

import { Chart, registerables } from "chart.js";
Chart.register(...registerables);

import { createIcons, icons } from "lucide";

window.Chart = Chart;

// Lucide butuh dipanggil ulang tiap kali ada elemen data-lucide baru
// (misalnya setelah Alpine x-show/x-if merender ulang bagian tertentu).
function renderIcons() {
    createIcons({ icons });
}

window.renderIcons = renderIcons;

document.addEventListener("DOMContentLoaded", renderIcons);
document.addEventListener("alpine:init", renderIcons);
