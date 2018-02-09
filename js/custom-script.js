$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.addable-wrapper'); //Input field wrapper
    var fieldHTML = '<div class="addable"><a href="javascript:void(0);" class="btn btn-danger btn-flat pull-right remove_button" title="Remove this form"><i class="fa fa-times"></i> Remove form</a><div class="form-group"><label for="title">Title</label> <input type="text" class="form-control" id="title" placeholder="Title" name="title[]"></div><div class="form-group"><label for="desc">Description</label><textarea class="form-control mceEditor" id="desc" placeholder="Description" style="height:150px;" name="desc[]"></textarea></div><div class="form-group"><?php $types = $controller->getdata("newstypes", "id", "asc");?><label class="control-label" for="newstype">News type <span class="required">*</span></label><select name="newstype[]" class="select2 form-control" required id="newstype" required><option value="">Select Option</option><?php foreach($types as $type){?><option value="<?php echo $type->id;?>"></option><?php }?></select></div><div class="form-group"><?php $times = $controller->getdata("newstime", "id", "asc");?><label class="control-label" for="time">News time <span class="required">*</span></label><select name="time[]" class="select2 form-control" required id="time"><option value="">Select Option</option><?php foreach($times as $tm){?><option value="<?php echo $tm->id;?>" ></option><?php }?></select></div><div class="form-group"><label for="pic">Picture</label><input type="file" class="form-control" name="pic[]" id="pic"></div><div class="form-group"><label for="audio">Audio</label><input type="file" class="form-control" name="audio[]" id="audio"></div><div class="form-group"><label for="video">Video</label><input type="file" class="form-control" name="video[]" id="video"></div><div class="clearfix"></div><hr></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x <= maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});