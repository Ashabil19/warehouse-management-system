<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Save</button>
    </form>
</body>
</html>
