<h3>Upload a file</h3>
<div id="body">
    <code>{msg}</code>

    <code>
        {upload_data}
    </code>

    <img scr="{upload_data['full_path']}">

    <?php echo form_open_multipart('uploadfile/upload_it');?>

    <input type="file" name="userfile" size="20" />

    <br /><br />

    <input type="submit" value="upload" />

    </form>
</div>

    