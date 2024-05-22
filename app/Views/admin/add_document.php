<!DOCTYPE html>
<html>
<head>
    <title>Add Document</title>
</head>
<body>
    <h1>Add Document</h1>
    <form action="<?= base_url('admin/addDocument') ?>" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"></textarea><br>
        <button type="submit">Add Document</button>
    </form>
</body>
</html>
