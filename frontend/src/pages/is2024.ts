import axios from 'axios';
// Définition locale de l'interface Is2024
export interface Is2024 {
  code: string;
  nom: string;
  ville: string;
}

export default async function fetchIs2024Data(): Promise<void> {
  const apiUrl = `${import.meta.env.VITE_API_URL}/is2024s`;

  try {
    const response = await axios.get<{ 'hydra:member': Is2024[] }>(apiUrl);
    const data = response.data['hydra:member'] ?? [];

    const table = document.createElement('table');
    table.className = 'table table-striped table-bordered';
    const headerRow = document.createElement('tr');
    headerRow.innerHTML = '<th>Code</th><th>Nom</th><th>Ville</th>';
    table.appendChild(headerRow);

    data.forEach((item) => {
      const row = document.createElement('tr');
      row.innerHTML = `<td>${item.code}</td><td>${item.nom}</td><td>${item.ville}</td>`;
      table.appendChild(row);
    });

    document.getElementById('app')?.appendChild(table);
  } catch (error) {
    console.error('Erreur API :', error);
    document.getElementById('app')!.innerHTML = '<p>Erreur lors du chargement des données.</p>';
  }
}
