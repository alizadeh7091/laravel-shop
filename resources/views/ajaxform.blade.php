<!DOCTYPE html>
<html>
<head>
    <title>Ajax Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>Ajax Form</h2>
<form id="ajaxForm">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <button type="submit">Submit</button>
</form>

<div id="response"></div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('submit.form') }}",
                method: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#response').html('<p>' + response.message + '</p>');
                },
                error: function(xhr) {
                    $('#response').html('<p>An error occurred: ' + xhr.responseText + '</p>');
                }
            });
        });
    });
</script>
</body>
</html>
