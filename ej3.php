<?php

include __DIR__.'/etc/conf.php';

if(isset( $_POST['op'])) {

    
    
    if(!isset($_COOKIE['op'])) {
        echo "No habia favoritos marcados.";
        setcookie('favoritosSerializado',serialize($producto['op']),time()+600);
        setcookie('hashFavoritosSerializado',hash('sha56',serialize($producto['op'])),time()+600);
    } else {
        
        if (hash('sha256',$_COOKIE['favoritosSerializado'])===$_COOKIE['hashFavoritosSerializado'])
        {
            $mensaje="cookie verificada";
            $datos=unserialize($_COOKIE['favoritosSerializado']);
        }
        else
        {
            $mensaje="La verificación fallo, por lo que se borran las cookies";
            setcookie('favoritosSerializado',serialize($producto['op']),time()-600);
            setcookie('hashFavoritosSerializado',hash('sha56',serialize($producto['op'])),time()-600);
    }


}

}
$favoritos=['A01','A03'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="css/styles.css">
<link href="assets/fontawesome/css/all.min.css" rel="stylesheet"  type="text/css">
<body>
    <?php include __DIR__.'/extra/mensajes.php'; ?>
<table>
    <thead>
        <tr>
            <th>
                Favoritos
            </th>
            <th>
                Código producto
            </th>   
            <th>
                Descripción
            </th>   
            <th>
                Precio
            </th>   
        </tr>
    </thead>
    <tbody>
        <?php foreach($productos as $cod=>$datos): ?>
        <tr>
            <td style="text-align:center">
                <form action="" method="post">
                    <?php if(in_array($cod,$favoritos)): ?>
                        <button type="submit" class="flat"><i class="fa-solid fa-star fa-lg"></i></button>                        
                        <input type="hidden" name="op" value="unfav">
                    <?php else: ?>
                        <button type="submit" class="flat"><i class="fa-regular fa-star fa-lg"></i></button>                                              
                        <input type="hidden" name="op" value="fav">
                    <?php endif; ?>
                    <input type="hidden" name="producto" value="<?=$cod?>">
                </form>                
            </td>
            <td>
                <?=$cod?>
            </td>   
            <td>
                <?=$datos['descripcion']?>
            </td>   
            <td>
                <?=$datos['precio_unidad']?>
            </td>   
        </tr>        
        <?php endforeach; ?>
    </tbody>        
</table>

</body>
</html>
