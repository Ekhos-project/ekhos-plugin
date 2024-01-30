<div id="idscharacter" style="display: none">
    <div class="idscharacter_action">
        <button class="starticon" id="idscharacter_button">Ajouter un personnage</button>
    </div>
    <div class="idscharacter_items">
        <div class="idscharacter_items_name">
            <div class="idscharacter_items_name_id">
                <span>ID</span>
            </div>
            <div class="idscharacter_items_name_name">
                <span>Nom</span>
            </div>
            <div class="idscharacter_items_name_sound">
                <span>Son principal</span>
            </div>
            <div class="idscharacter_items_name_actions">
                <span>Actions</span>
            </div>
        </div>
    </div>
</div>

<div id="idscharacter">

    <div class="idscharacter_modals">
        <!-- NEW MODAL -->
        <dialog id="idscharacter_modal_new" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="container flex flex-col gap-3">
                    <h3 class="font-bold text-lg">Nouveau personnage</h3>
                    <label class="form-control w-full">
                        <span class="label-text pb-1">Nom du personnage :</span>
                        <input type="text" placeholder="Nom" class="input input-bordered input-sm w-full"/>
                    </label>
                    <label class="form-control w-full">
                        <span class="label-text pb-1">Son principal :</span>
                        <select class="select select-bordered input-sm max-w-full-select">
                            <option disabled selected>Who shot first?</option>
                            <option>Han Solo</option>
                            <option>Greedo</option>
                        </select>
                    </label>
                    <button class="btn btn-primary mt-2 gap-0">
                        <span class="loading loading-spinner hidden"></span>
                        <span>Ajouter un personnage</span>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- UPDATE MODAL -->
        <dialog id="idscharacter_modal_update" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="container flex flex-col gap-3">
                    <h3 class="font-bold text-lg">Modifier le personnage</h3>
                    <label class="form-control w-full">
                        <span class="label-text pb-1">Nom du personnage :</span>
                        <input type="text" placeholder="Nom" class="input input-bordered input-sm w-full"/>
                    </label>
                    <label class="form-control w-full">
                        <span class="label-text pb-1">Son principal :</span>
                        <select class="select select-bordered input-sm max-w-full-select">
                            <option disabled selected>Who shot first?</option>
                            <option>Han Solo</option>
                            <option>Greedo</option>
                        </select>
                    </label>
                    <button class="btn btn-info mt-2 gap-0">
                        <span class="loading loading-spinner hidden"></span>
                        <span>Modifier le personnage n°<b>1</b></span>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- DELETE MODAL -->
        <dialog id="idscharacter_modal_delete" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="container flex flex-col gap-3">
                    <h3 class="font-bold text-lg">Supprimer le personnage</h3>
                    <p>Êtes-vous sûr de vouloir supprimer le personange n°<b>1</b> (<b>Nom</b>)</p>
                    <button class="btn btn-error mt-2 gap-0">
                        <span class="loading loading-spinner hidden"></span>
                        <span>Supprimer le personnage n°<b>1</b></span>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- ADD AUDIO MODAL -->
        <dialog id="idscharacter_modal_add_audio" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="container flex flex-col gap-3">
                    <h3 class="font-bold text-lg">Lier un son</h3>
                    <select class="select select-bordered input-sm max-w-full-select">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>
                    <button class="btn btn-info mt-2 gap-0">
                        <span class="loading loading-spinner hidden"></span>
                        <span>Lier un son</span>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <!-- DELETE AUDIO MODAL -->
        <dialog id="idscharacter_modal_delete_audio" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <div class="container flex flex-col gap-3">
                    <h3 class="font-bold text-lg">Supprimer la liaison de ce son ?</h3>
                    <button class="btn btn-error mt-2 gap-0">
                        <span class="loading loading-spinner hidden"></span>
                        <span>Supprimer ce son</span>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>

    <div class="idscharacter_new my-8">
        <button class="btn btn-primary" onclick="idscharacter_modal_new.showModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                 viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            Ajouter un personnage
        </button>
    </div>


    <div
            x-data="{
            items: [],
            isLoading: true,

            async getItems () {
                let response = await fetch('/wp-json/ekhos/character/list', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                let data = await response.json();
                this.items = data.items;
                this.isLoading = false;
            }
        }"
            x-init="getItems()"
    >
        <div class="overflow-x-auto">
            <div class="skeleton h-12 w-full" :class="{ 'hidden': !isLoading }"></div>
            <table class="table border hidden" :class="{ 'hidden': isLoading }">
                <!-- head -->
                <thead class="bg-base-100 text-base-content text-lg">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Son principal</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- row -->
                <template x-for="(item, index) in items">
                    <tr :class="index % 2 == 0 ? 'bg-gray-300' : 'bg-gray-200'">
                        <!-- ID -->
                        <th x-text="item.id"></th>
                        <!-- NAME -->
                        <td x-text="item.name"></td>
                        <!-- AUDIO -->
                        <td class="flex items-center gap-2">
                            <audio controls :src="item.sound_url" :class="{'hidden': !item.sound_url}"></audio>
                            <button class="btn btn-circle btn-neutral" :class="{'hidden': !item.sound_url}"
                                    onclick="idscharacter_modal_delete_audio.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-neutral" :class="{'hidden': item.sound_url}"
                                    onclick="idscharacter_modal_add_audio.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                            </button>
                        </td>
                        <!-- ACTIONS -->
                        <td class="lex items-center gap-2">
                            <!-- ACTIONS - edit -->
                            <button class="btn btn-circle btn-neutral" onclick="idscharacter_modal_update.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                            </button>
                            <!-- ACTIONS - delete -->
                            <button class="btn btn-circle btn-neutral" onclick="idscharacter_modal_delete.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</div>