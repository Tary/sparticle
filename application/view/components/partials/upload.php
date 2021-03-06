<? $uid = md5(uniqid(mt_rand())); ?>
<? self::scripts('jquery.form','jquery.MetaData','jquery.MultiFile','jquery.blockUI','upload_progress'); ?>

<div id="ui-container">
    <form enctype="multipart/form-data" action="<? self::path_to('/upload'); ?>" method="POST" id="upload-form" >        
        <input type="hidden" name="UPLOAD_IDENTIFIER" value="<? echo $uid; ?>" id="uid" />
        <input type="hidden" name="MAX_FILE_SIZE"     value="<? echo MAX_FILE_SIZE; ?>" />
        <div class="controls lite upper">
            <input name="upload[]" type="file" class="multi" id="upload" />        
            <div id="browse">
                <div id="browse_button" class="button blue medium">Select File</div>
            <!--<input type=text id="file_selected" />-->
            </div>
        </div>
        <div id="upload-list"></div>
        <div id="progress-bar"></div>
        <iframe id="upload-frame" name="upload-frame"></iframe>
        <div class="controls lite lower">
            <input type="submit" value="Upload Files" class="button blue medium"/>
        </div>
    </form>
</div>