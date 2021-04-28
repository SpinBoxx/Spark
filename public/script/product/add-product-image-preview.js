var counter = 0;
const max_img = 3;
const img = [1,2,3];
const img1 = [];


document.getElementById("add_img").addEventListener("click", function()
{
    if(img1.length < 3) {

        let difference = img.filter(x => !img1.includes(x));
        var template = $( "#image-0" ).clone();
        template.attr("id","image-" + difference[0]);
        template.find("input").attr('id','product_picture_product-'+ difference[0]);
        template.find("label").attr('for','product_picture_product-'+ difference[0]);
        template.find(".preview").empty();
        template.find("input").change(previewImages);
        template.find(".erase_image").click(eraseImage);
        template.find( "label" ).removeAttr('hidden');
        template.find( "#erase_image" ).attr('hidden',true);
        template.find( "#hide_image" ).attr('hidden',true);
        template.find('label').before('<i class="far fa-times-circle"></i>');
        template.find('.far').click(removeField);
        template.find('input').val('');

        $("#image-button-list").append(template);


        img1.push(difference[0]);
        console.log(img1)
        //counter ++;
    }

});$

function previewImages() {

    if($(this).val() != null){
        var $preview = $(this).siblings( ".preview" );
        var $label = $(this).siblings( "label" );
        $label.attr('hidden',true)
        console.log($preview);
        if (this.files) $.each(this.files, readAndPreview);
        function readAndPreview(i, file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                return alert(file.name +" is not an image");
            } // else...
            var reader = new FileReader();
            $(reader).on("load", function() {
                var img = $preview.append($("<img/>", {src:this.result, height:100, class:"image-preview"}));

            });
            reader.readAsDataURL(file);
        }
        $(this).siblings( "#erase_image" ).removeAttr('hidden');
    }

}
function eraseImage() {

    $(this).attr('hidden',true);
    $(this).siblings('input').val('');
    $(this).siblings('.preview').empty();
    $(this).siblings( "label" ).removeAttr('hidden');

}
function removeField() {

    var id = $(this).parent().attr('id');
    id = id.substr(id.length - 1);
    console.log(id);
    var index = img1.indexOf(parseInt(id));
    console.log(index , "le index");
    console.log("element delete : ",img1.splice(index,1));
    console.log(img1);
    $(this).parent().remove();

    // counter--;
}


$('#product_picture_product-0').on("change", previewImages);
$('.erase_image').click(eraseImage);