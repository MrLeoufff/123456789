import axios from 'axios';

export interface Is2024 {
  code: string;
  nom: string;
  ville: string;
  telFixe: string;
  telPortable: string;
  siren: string;
}

type ApiResponse = {
  member?: Is2024[];
  'hydra:member'?: Is2024[];
};

// Fonction pour récupérer les données (sans afficher)
export async function fetchIs2024Data(): Promise<Is2024[]> {
  const apiUrl = `${import.meta.env.VITE_API_URL}/is2024s`;

  try {
    const response = await axios.get<ApiResponse>(apiUrl);
    const data = response.data.member ?? response.data['hydra:member'] ?? [];
    console.log("Réponse API complète :", response.data);
    return data;
  } catch (error) {
    console.error('Erreur API :', error);
    throw error;
  }
}
