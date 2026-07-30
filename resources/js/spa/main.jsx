import { createRoot } from "react-dom/client";
import App from "./App";
import "../../css/app.css";
import "flag-icons/css/flag-icons.min.css";

const container = document.getElementById("app");

if (container) {
    createRoot(container).render(<App />);
}
