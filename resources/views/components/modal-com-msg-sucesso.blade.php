@if (session('success'))
    <!-- Modal mensagem de sucesso -->
    <div class="modal fade" id="modal-sucesso" tabindex="-1" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" style="background: rgba(255,255,255, .8);">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content border-0" style="background: #c4c4c4">
                <div class="modal-body py-3">
                    <div class="text-uppercase text-center py-3 px-4">
                        <div class="fs-5">
                            {{ session('success') }}
                        </div>
                        <div class="">
                            <span class="bg-white rounded-1 d-inline-block mt-3">
                                <button type="button"
                                    class="text-uppercase btn-sm py-2 btn btn-outline-primary rounded-1 px-4"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <div class="px-2 small">Fechar</div>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            let myModal = new bootstrap.Modal(document.getElementById('modal-sucesso'))
            myModal.show()
        }
    </script>
@endif
