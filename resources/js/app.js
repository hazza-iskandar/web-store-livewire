import "./bootstrap";
import { initFlowbite } from "flowbite";
import "flowbite";

document.addEventListener("livewire:navigated", () => {
    initFlowbite();
});
