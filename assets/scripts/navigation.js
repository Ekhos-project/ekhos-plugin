class Navigation {
    constructor(selector) {
        this.selector = selector;
        this.active = "";
        this.body = document.querySelector("#idsbody");
        this.setActive();
        this.events();
    }

    getItems() {
        return this.selector.querySelectorAll(":scope > a");
    }

    getPages() {
        return this.body.querySelectorAll(":scope > div");
    }

    setDefaultActive() {
        const active = this.getItems()[0].getAttribute("data-page");
        this.active = active;
        return active;
    }

    setActive() {
        if(!this.active) {
            this.setDefaultActive();
        }

        this.getItems().forEach((element) => {
            element.classList.remove("active");
        });

        const activeElement = this.selector.querySelector(`a[data-page="${this.active}"]`);
        activeElement.classList.add("active");
        this.setActivePage();
    }

    setActivePage() {
        this.getPages().forEach((element) => {
            element.classList.remove("active");
        });

        const activeElement = this.body.querySelector(`:scope > #${this.active}`);
        activeElement.classList.add("active");
    }

    events() {
        this.getItems().forEach((element) => {
            element.addEventListener("click", () => {
                this.active = element.getAttribute("data-page");
                this.setActive();
            });
        });
    }
}

export default function () {
    const selector = document.querySelector("nav.idsheader_navigation");
    const navigation = new Navigation(selector);
}