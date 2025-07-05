
# Application Web de Comptabilité (MySQL + Symfony + Vanilla JS)

## 📝 Présentation

Cette application web reprend la structure de votre fichier Excel pour la transformer en une solution full-stack :
- Back-end : Symfony 7, API Platform, MySQL, PhpSpreadsheet.
- Front-end : Vanilla JS (Vite).
- Tests, CI/CD, import Excel, CRUD API, doc OpenAPI intégrés.

## ⚙️ Installation (locale)

### Pré-requis
- Docker & Docker Compose
- Git

### Étapes

1. Clonez le projet :
```bash
git clone <URL_DU_DEPOT> mon-projet-compta
cd mon-projet-compta
```

2. Lancez la stack :
```bash
docker-compose up -d --build
```

3. Installez Symfony (dans le conteneur backend) :
```bash
docker exec -it symfony_backend bash
cd /var/www/html
composer create-project symfony/skeleton .
composer require api platform orm annotations symfony/validator symfony/maker-bundle phpoffice/phpspreadsheet
```

4. Créez et configurez la base de données dans `.env` :
```
DATABASE_URL="mysql://compta_user:compta_pass@db:3306/compta_db"
```

5. Lancez les migrations :
```bash
php bin/console doctrine:migrations:migrate
```

6. Installez les dépendances front :
```bash
docker exec -it vanilla_frontend sh
npm create vite@latest frontend -- --template vanilla
cd frontend
npm install axios
npm run dev
```

## 🔗 API & Doc
L’API expose des endpoints JSON, la documentation est générée automatiquement (Swagger / OpenAPI accessible via `/api` une fois l'app démarrée).

## 🏗️ Structure
- `backend/` → Symfony + API Platform (back-end)
- `frontend/` → Vanilla JS + Vite (front-end)
- `docker/` → Config Docker (MySQL)
- `.github/` → CI/CD

## ✅ Tests
- Tests back : `php bin/phpunit`
- Tests front : `npm run test`

## 📦 Déploiement
Configurer un serveur Docker (ou utiliser un VPS avec la même stack).
