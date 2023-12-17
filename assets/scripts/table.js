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
            return this.selector;
        } catch (error) {
            return;
        }
    }

    clear() {
        this.selector.querySelectorAll(`.${this.name}_item`).forEach((item) => {
            item.remove();
        });
    }

    deleteItemsEvents() {
        this.selector.querySelectorAll(`.${this.name}_item`).forEach((item) => {
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
                console.log(response)
            });
        });
    }
}


export default function () {
}
