<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <form action="/register" method="post">
        @csrf
        <label>Business Name</label>
        <input type="text" name="business_name">
        <br />
        <label>Reg No</label>
        <input type="text" name="reg_no">
        <br>
        <label>Delay</label>
        <input type="checkbox" name="delay">
        <br>
        <input type="submit">
    </form>
</body>
</html>
