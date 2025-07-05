export function renderTable(data: any[], container: HTMLElement) {
  if (data.length === 0) {
    container.innerHTML = "<p>Aucune donnée disponible.</p>";
    return;
  }

  const table = document.createElement("table");
  table.className = "table table-striped table-bordered";

  const thead = document.createElement("thead");
  const headerRow = document.createElement("tr");

  Object.keys(data[0]).forEach((col) => {
    const th = document.createElement("th");
    th.textContent = col;
    headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  const tbody = document.createElement("tbody");
  data.forEach((row) => {
    const tr = document.createElement("tr");
    Object.values(row).forEach((cell) => {
      const td = document.createElement("td");
      td.textContent = String(cell);
      tr.appendChild(td);
    });
    tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  container.appendChild(table);
}
