<div>
    <h1>Upload Image</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button>upload</button>
    </form>
</div>