<!-- resources/views/firebase/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Firebase Data</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>IRIGASI OTOMATIS</h1>
    <table border="1" id="firebase-data-table">
        <tr>
            <th>Parameter</th>
            <th>Nilai</th>
        </tr>
    </table>
    <script>
        function fetchData() {
            $.ajax({
                url: "{{ url('/firebase-data') }}",
                type: "GET",
                success: function(data) {
                    $('#firebase-data-table').find("tr:gt(0)").remove();
                    $.each(data, function(key, item) {
                        if (typeof item === 'object') {
                            $.each(item, function(subKey, subItem) {
                                $('#firebase-data-table').append('<tr><td>' + key + ' - ' + subKey + '</td><td>' + (typeof subItem === 'boolean' ? (subItem ? 'true' : 'false') : subItem) + '</td></tr>');
                            });
                        } else {
                            $('#firebase-data-table').append('<tr><td>' + key + '</td><td>' + (typeof item === 'boolean' ? (item ? 'true' : 'false') : item) + '</td></tr>');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            fetchData(); // Fetch data on page load
            setInterval(fetchData, 10); // Fetch data every 5 seconds
        });
    </script>
</body>
</html>
