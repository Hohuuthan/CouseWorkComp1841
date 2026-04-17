<h2>Add New Film</h2>

<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label for="title">Film Name:</label><br>
        <input type="text" name="title" id="title" required style="width: 400px; padding: 8px;">
    </p>
    <p>
        <label for="genre">Genre (optional):</label><br>
        <input type="text" name="genre" id="genre" style="width: 400px; padding: 8px;">
    </p>
    <p>
        <label for="release_year">Release Year (optional):</label><br>
        <input type="number" name="release_year" id="release_year" style="width: 400px; padding: 8px;">
    </p>
    <p>
        <label for="image">Film Poster (optional):</label><br>
        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/gif">
    </p>
    <p>
        <input type="submit" value="Add Film" 
               style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
    </p>
</form>