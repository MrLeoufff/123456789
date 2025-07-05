import { defineConfig } from 'vite';

export default defineConfig({
  server: {
    proxy: {
      '/api': 'http://symfony_backend',
    },
    host: true,       // Permet l'accès externe
    port: 5173,       // Fixe bien le port
    strictPort: true, // Fait échouer si le port est occupé
  },
});
