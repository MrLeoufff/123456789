import { fetchIs2024Data } from "../components/dataTable";
import type { Is2024 } from "../components/dataTable";

// Composant d'affichage réutilisable (générique si besoin)
export function renderTable(data: Is2024[], container: HTMLElement) {
  container.innerHTML = ""; // Reset

  if (data.length === 0) {
    container.innerHTML = "<p>Aucune donnée disponible.</p>";
    return;
  }

  const table = document.createElement("table");
  table.className = "table table-striped table-bordered";

  const thead = document.createElement("thead");
  const headerRow = document.createElement("tr");

  const displayedColumns: (keyof Is2024)[] = [
    "code", "nom", "ville", "telFixe", "telPortable", "siren",
  ];

  displayedColumns.forEach((col) => {
    const th = document.createElement("th");
    th.textContent = col;
    headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  const tbody = document.createElement("tbody");
  data.forEach((row) => {
    const tr = document.createElement("tr");
    displayedColumns.forEach((col) => {
      const td = document.createElement("td");
      td.textContent = row[col] ?? "";
      tr.appendChild(td);
    });
    tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  container.appendChild(table);
}

// Fonction principale de la page IS2024
export default async function initIS2024Page() {
  const container = document.getElementById("app")!;
  try {
    const data = await fetchIs2024Data();
    renderTable(data, container);
  } catch (e) {
    container.innerHTML = "<p>Erreur lors du chargement des données.</p>";
  }
}
