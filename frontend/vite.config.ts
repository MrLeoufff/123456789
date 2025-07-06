import { defineConfig, loadEnv } from 'vite';

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd()); // Charge les variables d'env

  return {
    define: {
      'import.meta.env': env,
    },
    server: {
      // proxy: {
      //   '/api': {
      //     target: env.VITE_API_URL, // Proxy Docker (backend)
      //     changeOrigin: true,
      //   },
      // },
      host: true,       // Permet l'accès depuis l'extérieur (docker ou réseau local)
      port: 5173,       // Fixe le port de dev
      strictPort: true, // Fait échouer si le port est déjà pris
    },
  };
});
