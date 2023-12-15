export class Popup {
    constructor(trigger, name, submitLabel, submitAction, fields) {
        this.trigger = trigger;
        this.selector = undefined;
        this.name = name;
        this.submitLabel = submitLabel;
        this.submitAction = submitAction;
        this.fields = fields;
        this.fieldsSelector = [];
        this.body = document.querySelector("#idsbody");
        this.active = false;
        this.generate();
    }

    fieldTextHtml(name = "", label = "", placeholder = "", value = "") {
        let html = `<div class="popup-action_input">`;
        const id = `${this.name}-input-${name}`;
        html += `<label for="${id}">${label} :</label>`;
        html += `<input type="text" id="${id}" name="${name}" placeholder="${placeholder}" value="${value}">`;
        html += `</div>`;
        this.fieldsSelector.push(id);
        return html;
    }

    fieldSelectHtml(name = "", label = "", placeholder = "", value = "", populate = []) {
        let html = `<div class="popup-action_input">`;
        const id = `${this.name}-input-${name}`;
        html += `<label for="${id}">${label} :</label>`;
        html += `<select id="${id}" name="${name}">`;
        populate.forEach((e) => {
            html += `<option value="${e.value}"${value === e.value ? "selected" : ""}>${e.text}</option>`;
        });
        html += `</select>`;
        html += `</div>`;
        this.fieldsSelector.push(id);
        return html;
    }

    fieldFileHtml(name = "", label = "", placeholder = "", value = "") {
        let html = `<div class="popup-action_input">`;
        const id = `${this.name}-input-${name}`;
        html += `<label for="${id}">${label} :</label>`;
        html += `<input type="file" id="${id}" name="${name}" placeholder="${placeholder}">`;
        html += `</div>`;
        this.fieldsSelector.push(id);
        return html;
    }

    generate() {
        const current = this.body.querySelector(`#popup-${this.name}`);
        if (current) current.remove();

        const popup = document.createElement('div');
        let popupHtml = "";
        popup.id = `#popup-${this.name}`;
        popup.className = "popup-action";
        popupHtml = `<div class="popup-action_background"></div><div class="popup-action_container">`;

        this.fields.forEach((field) => {
            const fieldType = field[0];
            const fieldName = field[1];
            const fieldLabel = field[2];
            const fieldPlaceholder = field[3];
            const fieldValue = field[4];
            const fieldPopulate = field[5];

            if (fieldType === "text") {
                popupHtml += this.fieldTextHtml(fieldName, fieldLabel, fieldPlaceholder, fieldValue);
            }

            if (fieldType === "file") {
                popupHtml += this.fieldFileHtml(fieldName, fieldLabel, fieldPlaceholder, fieldValue);
            }

            if (fieldType === "select") {
                popupHtml += this.fieldSelectHtml(fieldName, fieldLabel, fieldPlaceholder, fieldValue, fieldPopulate);
            }
        });

        popupHtml += `<button class="popup-action_action">${this.submitLabel}</button></div>`;
        popup.innerHTML = popupHtml;
        this.body.appendChild(popup);
        this.selector = popup;

        this.events();
    }

    events() {
        this.trigger.addEventListener("click", () => {
            if (!this.active) {
                this.selector.classList.add("active");
            } else {
                this.selector.classList.remove("active");
            }
            this.active = !this.active;
        });

        this.selector.querySelector(".popup-action_background").addEventListener("click", () => {
            this.active = false;
            this.selector.classList.remove("active");
        });

        this.selector.querySelector(".popup-action_action").addEventListener("click", () => {
            this.post();
        });
    }

    async post() {
        const formData = new FormData();
        this.fieldsSelector.forEach((selector) => {
            const field = this.selector.querySelector(`#${selector}`);
            if (field.type === "file") {
                if (!field.files.length) {
                    return;
                }
                const file = field.files[0];
                formData.append(`file__${field.name}`, file);
            } else {
                formData.append(field.name, field.value);
            }
        });

        const request = await fetch(`/wp-json/ekhos/${this.submitAction}`, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        try {
            const response = await request.json();
            if (response.status !== "success") {
                alert("Une erreur est survenue avec le traitement");
                return;
            }
            this.active = false;
            this.selector.classList.remove("active");
            this.clearFields();
            return;
        } catch (error) {
        }

        alert("Une erreur est survenue avec le traitement");
    }

    clearFields() {
        this.fieldsSelector.forEach((selector) => {
            const field = this.selector.querySelector(`#${selector}`);
            field.value = "";
        });
    }
}

export default function () {
    const linkedButton = document.querySelector("button#idslinked_button");
    const linkedPopup = new Popup(
        linkedButton,
        "linked",
        "Lier un son",
        "get",
        [
            ["select", "page", "Page", "", "Value 1", [{text: "Name 0", value: "Value 0"}, {
                text: "Name 1",
                value: "Value 1"
            }]],
            ["text", "section", "Section", "#header", ""],
            ["select", "sound", "Son personnage", "", "Value 1", [{text: "Name 0", value: "Value 0"}, {
                text: "Name 1",
                value: "Value 1"
            }]]
        ]
    );

    const characterButton = document.querySelector("button#idscharacter_button");
    const characterPopup = new Popup(
        characterButton,
        "character",
        "Ajouter un personnage",
        "character/add",
        [
            ["text", "name", "Nom du personnage", "Nom", ""],
            ["select", "sound", "Son principal", "", "null", [
                {
                    text: "Aucun son",
                    value: "null"
                },
                {
                    text: "Name 0",
                    value: "Value 0"
                },
                {
                    text: "Name 1",
                    value: "Value 1"
                }
            ]]
        ]
    );

    const soundButton = document.querySelector("button#idssound_button");
    const soundPopup = new Popup(
        soundButton,
        "character",
        "Ajouter un personnage",
        "/update/id",
        [
            ["text", "name", "Nom du son", "Cri", ""],
            ["file", "audio", "Fichier audio", "", ""]
        ]
    );
}
