import apiClient from "../api/apiClient";
import { renderTable } from "../components/dataTable";

const container = document.getElementById("app")!;

apiClient.get("/is2024s").then((res) => {
  renderTable(res.data["hydra:member"], container);
});
