<html><form action="{{ route('posts.update', $post['id']) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $post['title'] }}">
    </div>

    <div>
        <label for="Posted By">Posted By</label>
        <select name="Posted By">
            <!-- Assuming you have an array or list of users to populate the dropdown -->
            <option value="Ahmed" {{ $post['Posted By'] == 'Ahmed' ? 'selected' : '' }}>Ahmed</option>
            <option value="Sara" {{ $post['Posted By'] == 'Sara' ? 'selected' : '' }}>Sara</option>
            <option value="Omar" {{ $post['Posted By'] == 'Omar' ? 'selected' : '' }}>Omar</option>
            <option value="Laila" {{ $post['Posted By'] == 'Laila' ? 'selected' : '' }}>Laila</option>
        </select>
    </div>

    <div>
        <label for="Created At">Created At</label>
        <input type="text" name="Created At" value="{{ $post['Created At'] }}">
    </div>

    <button type="submit">Update Post</button>
</form>
</html>