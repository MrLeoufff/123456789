import axios from 'axios';

export default async function fetchBilanData(): Promise<void> {
  const apiUrl =
  import.meta.env.MODE === 'development'
    ? 'http://localhost:8080/api/fiscalites'
    : 'http://symfony_backend/api/fiscalites';


  try {
    const response = await axios.get<{ 'hydra:member': any[] }>(apiUrl);
    const data = response.data['hydra:member'];

    const table = document.createElement('table');
    table.className = 'table table-striped table-bordered';
    const headerRow = document.createElement('tr');

    Object.keys(data[0] || {}).forEach((key) => {
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

    document.getElementById('app')!.innerHTML = '';
    document.getElementById('app')!.appendChild(table);
  } catch (error) {
    console.error('Erreur API :', error);
  }
}
