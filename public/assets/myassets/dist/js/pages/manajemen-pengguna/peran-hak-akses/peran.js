$(function () {
    const konfigurasiDataTable = {
        scrollX: true,
        scrollCollapse: true,
        scrollY: '56.9vh',
        columnDefs: [
            { targets: [2], orderable: false, searchable: false }
        ]
    };

    const dataTable = $("#table-peran").DataTable(konfigurasiDataTable);
    const request = '/manajemen-pengguna/peran-hak-akses/peran/';

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        tampilkanLoading(modalId);
        ambilData(id, modalId);
    });

    const ambilData = (id, modalId) => {
        $.ajax({
            url: url(`${request}${id}`),
            type: 'GET',
            success: (response) => isiModal(modalId, response),
            error: () => tampilkanError(modalId),
            complete: () => hilangkanLoading(modalId)
        });
    };

    const isiModal = (modalId, response) => {
        const modal = $(modalId);
        const { id, name, guard_name, permissions } = response;
        const actions = {
            '#modal-kelola-hak-akses': () => {
                modal.find('form').attr('action', url(`${request}kelola-hak-akses/${id}`));
                modal.find('#name').text(name);
                $.each(permissions, function (index, item) {
                    modal.find(`[name="hak_akses[]"][value="${item.name}"]`).prop('checked', true);
                });
            },
            '#modal-detail': () => {
                modal.find('#id').text(id);
                modal.find('#nama_peran').text(name);
                modal.find('#nama_pengaman').text(guard_name);
            },
            '#modal-ubah': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="name"]').val(name);
            },
            '#modal-hapus': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('#name').text(name);
            }
        };

        actions[modalId]?.();
    };

    const tampilkanLoading = (modalId) => {
        $(modalId).find('.modal-content').prepend('<div class="overlay"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
    };

    const hilangkanLoading = (modalId) => {
        $(modalId).find('.overlay').remove();
    };

    const tampilkanError = (modalId) => {
        $(modalId).find('.modal-body').html('<p class="m-0">Terjadi kesalahan. Silakan coba lagi.</p>');
        $(modalId).find('.modal-footer').remove();
    };

    const modalUbah = $('#modal-ubah');
    if (modalUbah.find('.is-invalid').length) {
        const id = modalUbah.find('[name="id"]').val();
        modalUbah.find('form').attr('action', url(`${request}${id}`));
        setTimeout(() => modalUbah.modal('show'), 500);
    }
});
