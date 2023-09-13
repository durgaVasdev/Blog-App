// public/js/search.js

$(document).ready(function () {
    $('#search-form').submit(function (e) {
        e.preventDefault();
        let search = $('#search').val();

        $.ajax({
            type: 'GET',
            url: '{{ route('users.index') }}',
            data: { search: search },
            success: function (data) {
                $('#user-list').html(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
