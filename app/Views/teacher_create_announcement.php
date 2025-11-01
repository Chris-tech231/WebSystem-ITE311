<!DOCTYPE html>
<html>
<head>
    <title>Create Announcement</title>
</head>
<body>
    <h1>Create New Announcement</h1>
    <form action="/teacher/store" method="post">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Body:</label><br>
        <textarea name="body" required></textarea><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
