<style>
    #cropModal .modal-body {
        max-height: 70vh; /* Fixed height to ensure modal stays in the viewport */
        overflow-y: auto; /* Scrollable if content exceeds height */
    }
   #cropModal .img-container {
        max-height: 70vh; /* Ensure image container does not exceed modal height */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .cropper-view-box,
    .cropper-face {
        border-radius: 50%; /* Make crop box circular if desired */
    }
</style>

    <div class="pt-4 text-center">
        <div class="form-group">
            <img id="profile_pic_preview" src="<?= base_url('images/profile/profile.png') ?>" alt="Profile Picture Placeholder" style="max-width: 200px; max-height: 200px;" />
        </div>
        <div class="form-group">
            <label for="profile_pic">Profile Picture</label>
            <input type="file" name="profile_pic" value=""  class="form-control" id="profile_pic">
        </div>
    </div>


<!-- Modal for cropping -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="" alt="Image for cropping">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    $(document).ready(function() {
        var cropper;
        var image = document.getElementById('image');

        $('#profile_pic').change(function(event) {
            var files = event.target.files;
            var done = function(url) {
                image.src = url;
                $('#cropModal').modal('show');
            };
            var reader;
            var file;
            
            if (files && files.length > 0) {
                file = files[0];
                
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $('#cropModal').on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                viewMode: 1,
                dragMode: 'move',
                aspectRatio: 1,
                autoCropArea: 1,
                cropBoxResizable: true,
                cropBoxMovable: true,
                minContainerWidth: 400,
                minContainerHeight: 400,
                ready: function () {
                    cropper.setCropBoxData({ width: 196, height: 196 });
                }
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            var canvas = cropper.getCroppedCanvas({
                width: 196,
                height: 196
            });
            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob); 
                reader.onloadend = function() {
                    var base64data = reader.result; 
                    $('#profile_pic_preview').attr('src', base64data);
                    $('#cropModal').modal('hide');
                };
            });
        });

        $('#zoomIn').click(function() {
            if (cropper) {
                cropper.zoom(0.1);
            }
        });

        $('#zoomOut').click(function() {
            if (cropper) {
                cropper.zoom(-0.1);
            }
        });

        $('#reset').click(function() {
            if (cropper) {
                cropper.reset();
            }
        });
    });
</script>