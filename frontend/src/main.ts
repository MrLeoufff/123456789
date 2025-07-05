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

const apiUrl =
  import.meta.env.MODE === 'development'
    ? 'http://localhost:8080/api/is2024s'
    : 'http://symfony_backend/api/is2024s';
    
async function fetchData(): Promise<void> {
  try {
    const response = await axios.get<{ 'hydra:member': Is2024[] }>(apiUrl);
    const data = response.data['hydra:member'];

    const table = document.createElement('table');
    table.border = '1';
    const headerRow = document.createElement('tr');
    headerRow.innerHTML = '<th>Code</th><th>Nom</th><th>Ville</th>';
    table.appendChild(headerRow);

    data.forEach((item) => {
      const row = document.createElement('tr');
      row.innerHTML = `<td>${item.code}</td><td>${item.nom}</td><td>${item.ville}</td>`;
      table.appendChild(row);
    });

    document.body.appendChild(table);
  } catch (error) {
    console.error('Erreur API :', error);
  }
}

const routes: Record<string, () => Promise<any>> = {
  "/": () => import("./pages/index"),
  "/is2024": () => import("./pages/is2024"),
  "/bilan": () => import("./pages/bilan"),
  "/fiscalite": () => import("./pages/fiscalite"),
  "/portefeuille": () => import("./pages/portefeuille"),
  "/suivi-prod": () => import("./pages/suiviProd"),
  "/tva": () => import("./pages/tva"),
};

const path = window.location.pathname;
routes[path]?.();


fetchData();
