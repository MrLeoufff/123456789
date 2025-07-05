import axios from 'axios';

interface Is2024 {
  id: number;
  code: string;
  nom: string;
  ville: string;
  telFixe: string;
  telPortable: string;
  siren: string;
  rfN2: number;
  rfN1: number;
  isN1: number;
  liquid: number;
}

export default async function fetchIs2024Data(): Promise<void> {
  const apiUrl =
    import.meta.env.MODE === 'development'
      ? 'http://localhost:8080/api/is2024s'
      : 'http://symfony_backend/api/is2024s';

  try {
    const response = await axios.get<{ member: Is2024[] }>(apiUrl);
    const data = response.data.member;
    console.log("Réponse API brute :", response.data);

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
