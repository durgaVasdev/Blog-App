<!DOCTYPE html>
<html>
<head>
    <title>AJAX CRUD Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container mt-5">
    <h2>Posts</h2>
    
    <!-- Form for creating new post -->
    <form id="create-form" class="mb-3">
        @csrf
        <div class="mb-2">
            <input type="text" name="title" placeholder="Title" class="form-control">
        </div>
        <div class="mb-2">
            <textarea name="content" placeholder="Content" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create Post</button>
    </form>
    
    <!-- Display posts -->
    <ul id="post-list" class="list-group"></ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Load posts on page load
        loadPosts();

        // Create post using AJAX
        $('#create-form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            
            $.ajax({
                url: '/posts',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    loadPosts();
                    $('#create-form')[0].reset();
                }
            });
        });

        // Load posts using AJAX
        function loadPosts() {
            $.ajax({
                url: '/posts',
                type: 'GET',
                success: function(response) {
                    var posts = response;
                    var postList = $('#post-list');
                    postList.empty();
                    posts.forEach(function(post) {
                        postList.append('<li class="list-group-item">' + post.title + ' - ' + post.content +
                            ' <button class="edit-btn btn btn-sm btn-primary" data-id="' + post.id + '">Edit</button>' +
                            ' <button class="delete-btn btn btn-sm btn-danger" data-id="' + post.id + '">Delete</button></li>');
                    });
                }
            });
        }

        // Edit post using AJAX
        $(document).on('click', '.edit-btn', function() {
            var postId = $(this).data('id');
            // Implement your edit logic here
        });

        // Delete post using AJAX
        $(document).on('click', '.delete-btn', function() {
            var postId = $(this).data('id');
            $.ajax({
                url: '/posts/' + postId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    loadPosts();
                }
            });
        });
    });
</script>

</body>
</html>
