<div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
    <div class="tm-product-img-dummy mx-auto">
        <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('gallery-photo-add').click();"></i>
    </div>

    {{--                    <input type="file" name="image[]" multiple id="gallery-photo-add" form="upload-form">--}}
    <div>
        <label for="gallery-photo-add" class="form-label">بارگذاری عکس</label>
        <input  name="images[]" form="upload-form" multiple id="gallery-photo-add" type="file" hidden>
        <div class="card" style="min-height: 100px" onclick="document.getElementById('gallery-photo-add').click();">
            <div class="gallery img-fluid" id="gallery"></div>
        </div>
    </div>

</div>

<script>
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img class="img-size-64 m-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#gallery-photo-add').on('change', function() {
            document.getElementById("gallery").innerHTML = "";
            imagesPreview(this, 'div.gallery');
        });
    });
</script>
