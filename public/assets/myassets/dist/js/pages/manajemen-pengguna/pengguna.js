$(function () {
    const konfigurasiDataTable = {
        scrollX: true,
        scrollCollapse: true,
        scrollY: '56.9vh'
    };

    const indexTarget = target('Menu');
    if (indexTarget >= 0) {
        konfigurasiDataTable.columnDefs = [{
            targets: indexTarget, orderable: false, searchable: false
        }];
    };

    const dataTable = $("#table-pengguna").DataTable(konfigurasiDataTable);
    const request = '/manajemen-pengguna/pengguna/';

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        tampilkanLoading(modalId);
        ambilData(id, modalId);
    });

    function target(key) {
        return $('table th').map(function () {
            return $(this).text().trim();
        }).get().indexOf(key);
    };

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
        const { id, name, email, roles } = response;
        const actions = {
            '#modal-reset': () => {
                modal.find('form').attr('action', url(`${request}reset-password/${id}`));
            },
            '#modal-detail': () => {
                modal.find('#id').text(id);
                modal.find('#name').text(name);
                modal.find('#email').text(email);
                modal.find('#peran').html(roles.map(role => `<span class="badge badge-light">${role.name}</span>`).join(' '));
            },
            '#modal-ubah': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="name"]').val(name);
                modal.find('[name="email"]').val(email);
                modal.find('[name="peran[]"]').val(roles.map(role => role.name)).trigger('change');
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

    $(document).on('shown.bs.modal', '#modal-ubah', function () {
        $(this).find('select.select2bs4').trigger('change');
    });
});
