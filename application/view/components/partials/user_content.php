<? $favorited = Sparticle_Favorite::init()->is_favorite(Laika_User::active()->id, $object->id, $object->type); ?>
<? $c = self::init()->counter; ?>
<? if($c%3==0) echo "<tr>";    ?>
<td>
    <a href="<? echo HTTP_ROOT.'/content?id='.$object->id; ?>">
        <img src="<? echo Laika_Image::api_path($object->path, 'auto', '250' ); ?>" class="thumb"/>
    </a>
    <div class="info">
        <h3><? echo $object->name ?></h3>
        <? echo PICTURE_ICON; ?>&nbsp;
        <? echo Laika_Image::dimensions($object->path); ?>
        <br />
        <? echo CLOUD_ICON; ?>&nbsp;
        <? echo $object->created_to_date(); ?>
        <br />
        <? echo $favorited ? FAVORITE_ICON : UNFAVORITE_ICON; ?>&nbsp;
        <span class = "favorite_count">
        <? echo Sparticle_Favorite::count(array('item'=>$object->id)); ?>
        </span> Favorites 
    </div>
</td>

<? $c++; if($c%3==0) echo "</tr>"; self::init()->counter = $c;?>