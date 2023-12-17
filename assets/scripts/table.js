import {populateCharacter, Popup} from "./popup.js";

export class Table {
    constructor(selector, name, endpoint) {
        this.selector = selector;
        this.name = name;
        this.endpoint = endpoint;
        this.clear();
    }

    async populate() {
        const request = await fetch(`/wp-json/ekhos/${this.endpoint}/list`, {
            method: 'POST',
            credentials: 'same-origin'
        });
        try {
            const response = await request.json();
            if (response.status !== "success") {
                return;
            }
            this.selector.innerHTML += response.html;
            this.deleteItemsEvents();
            this.updateItemsEvents();
            return this.selector;
        } catch (error) {
            return;
        }
    }

    getItems() {
        return this.selector.querySelectorAll(`.${this.name}_item`);
    }

    clear() {
        this.getItems().forEach((item) => {
            item.remove();
        });
    }

    updateItemsEvents() {
        this.getItems().forEach((item) => {
            const id = item.getAttribute("data-id");
            const name = item.getAttribute("data-name");
            const trigger = item.querySelector(`.${name}_edit`);

            if(name === "idscharacter_item") {
                const itemPopup = new Popup(
                    trigger,
                    `${name}_${id}`,
                    `Modifier le personnage N°${id}`,
                    `character/update/${id}`,
                    [
                        ["text", "name", "Nom du perssonage", "Nom", item.querySelector(".idscharacter_item_name span").innerText],
                        ["select", "sound", "Son principal", "", "null", populateCharacter]
                    ],
                    this
                );
            }
        });
    }

    deleteItemsEvents() {
        this.getItems().forEach((item) => {
            const itemID = item.getAttribute("data-id");
            item.querySelector(`.${this.name}_item_delete`).addEventListener("click", async () => {
                item.remove();
                const formData = new FormData();
                formData.append("id", itemID);
                const request = await fetch(`/wp-json/ekhos/${this.endpoint}/delete`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                });
                const response = await request.json();
            });
        });
    }
}


export default function () {
}
