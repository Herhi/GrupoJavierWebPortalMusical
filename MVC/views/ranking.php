<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Raquel Alcázar">
        <title>Portal Musical</title>
    </head>
    <body>
	   <h1>Ranking</h1>
          <table border="1" style="text-align: center">
            <tr>
                <th>Downloads</th>
                <th>TrackId</th>
                <th>Name</th>
                <th>Album Id</th>
                <th>Media Type Id</th>
                <th>Genre Id</th>
                <th>Composer</th>
                <th>Miliseconds</th>
                <th>Bytes</th>
                <th>Unit Price</th>
            </tr>
        <?php
            for($i=0; $i<count($canciones); $i++){
                   
                echo "<tr>
                        <td>" .$canciones[$i]["Descargas"] ."</td>
                        <td>" .$canciones[$i]["TrackId"] ."</td>
                        <td>" .$canciones[$i]["Name"] ."</td>
                        <td>" .$canciones[$i]["AlbumId"] ."</td>
                        <td>" .$canciones[$i]["MediaTypeId"] ."</td>
                        <td>" .$canciones[$i]["GenreId"] ."</td>
                        <td>" .$canciones[$i]["Composer"] ."</td>
                        <td>" .$canciones[$i]["Milliseconds"] ."</td>
                        <td>" .$canciones[$i]["Bytes"] ."</td>
                        <td>" .$canciones[$i]["UnitPrice"] ."</td>
                    </tr>";
            }

        ?>
    </table>
    </body>
</html>
