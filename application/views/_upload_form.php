<h3>Upload a file</h3>
<div id="body">
    <code>{msg}</code>

    <code>
        {upload_data}
    </code>

    {avatar}
    
    <form action="uploadfile/upload_it" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <input type="file" name="userfile" size="20" />

        <br /><br />

        <input type="submit" value="upload" />

    </form>
</div>

    