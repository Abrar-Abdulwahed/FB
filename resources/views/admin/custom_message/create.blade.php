<form method="POST">
    @csrf
</form>
<input type="text" name="code" placeholder="code">
<select name="type">
    <option value="email">email</option>
    <option value="sms">sms</option>
</select>
<select name="language">
    <option value="ar">عربية</option>
    <option value="en">إنجليزية</option>
</select>
<textarea name="text">
    your message
</textarea>
