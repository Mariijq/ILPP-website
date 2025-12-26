// resources/backend/js/backend.js

$(document).ready(function() {

    const $hamburger = $('.hamburger');
    const $sidebar = $('.backend-sidebar');
    const $main = $('.backend-main');

    // Sidebar toggle
    $hamburger.on('click', function() {
        $sidebar.toggleClass('active');
        $main.toggleClass('shifted');
        $hamburger.toggle(!$sidebar.hasClass('active'));
    });

    $(document).on('click', function(e) {
        if ($sidebar.hasClass('active') &&
            !$(e.target).closest($sidebar).length &&
            !$(e.target).closest($hamburger).length) {

            $sidebar.removeClass('active');
            $main.removeClass('shifted');
            $hamburger.show();
        }
    });

    // CKEditor init
    const editors = document.querySelectorAll('.ckeditor');
    editors.forEach(editor => {
        ClassicEditor.create(editor)
            .catch(error => console.error(error));
    });

    // Delete confirmation
    $(document).on('click', '.delete-form button', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#26a6a0',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });

});
