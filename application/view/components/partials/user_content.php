<? $c = self::init()->counter; ?>
<? if($c%3==0) echo "<tr>";    ?>

<td>
    <a href="<? echo HTTP_ROOT.'/content?id='.$object->id; ?>">
        <img src="<? echo Laika_Image::api_path($object->path, 'auto', '250' ); ?>" class="thumb"/>
    </a>
</td>

<? $c++; if($c%3==0) echo "</tr>"; self::init()->counter = $c;?>