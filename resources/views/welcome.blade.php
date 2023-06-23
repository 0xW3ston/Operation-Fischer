<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>hEEY</h1>
    <form method="POST" enctype="multipart/form-data">
        <input name="img" type="file"/>
        @csrf
        <input type="submit" value="hello"/>
    </form>
    <script type="module">
        console.log(toastr)
        showNotification('hello');
    </script>
</body>
</html>