// Routing simple : chaque page gère elle-même ses données
const routes: Record<string, () => Promise<void>> = {
  "/": () => import("./pages/index").then((m) => m.default()),
  "/is2024": () => import("./pages/is2024").then((m) => m.default()),
  "/bilan": () => import("./pages/bilan").then((m) => m.default()),
  "/fiscalite": () => import("./pages/fiscalite").then((m) => m.default()),
  "/portefeuille": () => import("./pages/portefeuille").then((m) => m.default()),
  "/suivi-prod": () => import("./pages/suiviProd").then((m) => m.default()),
  "/tva": () => import("./pages/tva").then((m) => m.default()),
};

const path = window.location.pathname;
routes[path]?.();



