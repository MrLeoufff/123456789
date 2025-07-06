import axios from 'axios';

// Définition locale de l'interface Is2024 (si tu veux conserver le typage, sinon tu peux enlever Is2024 ici)
export interface Is2024 {
  [key: string]: any; // Permet d'accepter toutes les propriétés
}

type ApiResponse = {
  member?: Is2024[];
  'hydra:member'?: Is2024[];
};

export default async function fetchIs2024Data(): Promise<void> {
  const apiUrl = `${import.meta.env.VITE_API_URL}/is2024s`;

  try {
    const response = await axios.get<ApiResponse>(apiUrl);
    const data = response.data.member ?? response.data['hydra:member'] ?? [];

    console.log("Réponse API complète :", response.data);

    if (data.length === 0) {
      document.getElementById('app')!.innerHTML = '<p>Aucune donnée disponible.</p>';
      return;
    }

    const table = document.createElement('table');
    table.className = 'table table-striped table-bordered';

    // Générer l'en-tête dynamiquement à partir des clés du premier objet
    const headerRow = document.createElement('tr');
    Object.keys(data[0]).forEach((key) => {
      const th = document.createElement('th');
      th.textContent = key;
      headerRow.appendChild(th);
    });
    table.appendChild(headerRow);

    // Remplir les lignes du tableau
    data.forEach((item) => {
      const row = document.createElement('tr');
      Object.values(item).forEach((val) => {
        const td = document.createElement('td');
        td.textContent = val !== null ? String(val) : '';
        row.appendChild(td);
      });
      table.appendChild(row);
    });

    document.getElementById('app')?.appendChild(table);
  } catch (error) {
    console.error('Erreur API :', error);
    document.getElementById('app')!.innerHTML = '<p>Erreur lors du chargement des données.</p>';
  }
}
