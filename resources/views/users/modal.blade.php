<div class="modal fade"
     id="userModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-lg); background: #ffffff;">

            <div class="modal-header border-0 pb-0 pt-4 px-4">

                <h5 class="modal-title fw-bold text-dark" style="font-size: 18px;">
                    Form User
                </h5>

                <button type="button"
                        class="btn-close shadow-none"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        style="font-size: 12px;">
                </button>

            </div>

            <form id="userForm">

                @csrf

                <div class="modal-body px-4 py-3">

                    <input type="hidden"
                           id="user_id"
                           name="user_id">

                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold mb-1" style="font-size: 13px;">
                            Username
                        </label>

                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control px-3 py-2 custom-input"
                               placeholder="Masukkan username"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold mb-1" style="font-size: 13px;">
                            Nama
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control px-3 py-2 custom-input"
                               placeholder="Masukkan nama lengkap"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold mb-1" style="font-size: 13px;">
                            Email
                        </label>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control px-3 py-2 custom-input"
                               placeholder="contoh@email.com"
                               required>

                    </div>

                    <div class="mb-2">

                        <label class="form-label text-secondary fw-semibold mb-1" style="font-size: 13px;">
                            Password
                        </label>

                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control px-3 py-2 custom-input"
                               placeholder="••••••••">

                    </div>
                    
                    <div class="d-flex gap-2 align-items-start px-1">
                        <i class="bi bi-info-circle text-muted" style="font-size: 12px; margin-top: 2px;"></i>
                        <small class="text-muted d-block" style="font-size: 12px; line-height: 1.4;">
                            Kosongkan saat edit jika tidak ingin mengubah password
                        </small>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-2 pb-4 px-4 d-flex justify-content-end gap-2">

                    <button type="button"
                            class="btn btn-light px-4 py-2 text-muted"
                            data-bs-dismiss="modal"
                            style="border-radius: var(--radius-md); font-size: 14px; font-weight: 500;">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-primary px-4 py-2"
                            style="background-color: var(--primary-color); border-color: var(--primary-color); border-radius: var(--radius-md); font-size: 14px; font-weight: 500;">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

<style>
    .custom-input {
        border-radius: var(--radius-md) !important;
        border-color: var(--border-color);
        font-size: 14px;
        color: var(--text-main);
        transition: var(--transition);
    }
    .custom-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px var(--primary-light);
        color: var(--text-main);
    }
    .custom-input::placeholder {
        color: #cbd5e1;
    }
</style>