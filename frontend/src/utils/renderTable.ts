export function renderApiTable(data: any[], container: HTMLElement) {
  if (!data || data.length === 0) {
    container.innerHTML = "<p>Aucune donnée trouvée.</p>";
    return;
  }

  const table = document.createElement('table');
  table.className = 'table table-bordered table-striped';

  const headerRow = document.createElement('tr');
  Object.keys(data[0]).forEach((key) => {
    const th = document.createElement('th');
    th.textContent = key;
    headerRow.appendChild(th);
  });
  table.appendChild(headerRow);

  data.forEach((item) => {
    const row = document.createElement('tr');
    Object.values(item).forEach((val) => {
      const td = document.createElement('td');
      td.textContent = val !== null ? String(val) : '';
      row.appendChild(td);
    });
    table.appendChild(row);
  });

  container.appendChild(table);
}

